function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
  }
}


document.addEventListener('alpine:init', () => {

  // Dark Light Theme Controller
  Alpine.store('dark', {
    on: (() => {

      let status = window.localStorage.getItem('dark')

      // theme mode already saved in local storage
      if (status) {
        return JSON.parse(status)
      }

      // theme mode is not saved in local storage
      window.localStorage.setItem('dark', false)
      return false

    })(),

    toggle() {
      this.on = !this.on
      window.localStorage.setItem('dark', this.on)
    }

  })

  // Main Menu Controller
  Alpine.store('is_main_menu_open', {
    on: false,

    toggle() {
      this.on = !this.on
    }
  })

  // Notification Menu Controller
  Alpine.store('notification_menu', {
    on: false,

    toggle() {
      this.on = !this.on
    }
  })

  // Profile Menu Controller
  Alpine.store('profile_menu', {
    on: false,

    toggle() {
      this.on = !this.on
    }
  })

  // Pages Menu Controller
  Alpine.store('pages_menu', {
    on: false,

    toggle() {
      this.on = !this.on
    }
  })

  // Paginator Controller
  Alpine.store('table_paginator', {
    pre_btn: false,
    nex_btn: true,

    pager: 1,
    first_item: 0,
    last_item: 1,

    all_data: [],
    listed_data: [],


    initial_paginator() {
      // slice data
      this.listed_data = this.all_data.slice(this.first_item, this.last_item)

      if (this.first_item == 0) { this.pre_btn = false }
      if (this.first_item > 0) { this.pre_btn = true }

      if (this.last_item >= this.all_data.length) { this.nex_btn = false }
      if (this.last_item < this.all_data.length) { this.nex_btn = true }
    },

    next() {
      this.first_item = this.first_item + this.pager
      this.last_item = this.last_item + this.pager

      this.initial_paginator()
    },
    prev() {
      this.first_item = this.first_item - this.pager
      this.last_item = this.last_item - this.pager

      this.initial_paginator()
    },
    reset_paginator() {
      // reset
      this.first_item = 0
      this.last_item = this.pager

      this.initial_paginator()
    }

  })

})


function report(token) {
  return {

    columns: ['name', 'impressions', 'clicks', 'ctr', 'revenue'],
    adunits: [],
    apps: [],
    days: [],
    token: token,
    loading: true,
    group: 'apps',
    data: [],


    getData() {
      this.loading = true
      this.rangeDate = document.getElementById('dateRange').value;
      this.startDate = this.rangeDate.split('  To  ')[0];
      this.endDate = this.rangeDate.split('  To  ')[1];

      console.log(this.startDate);

      fetch('/report', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          startDate: this.startDate,
          endDate: this.endDate,
          group: this.group,
          _token: this.token,
        })
      })
        .then((response) => response.json())
        .then((data) => {
          if (this.group == 'apps') {
            this.updateAppsTable(data)
          } else if (this.group == 'adunits') {
            this.updateAdunitsTable(data)
          } else if (this.group == 'days') {
            //
          }

        })

    },

    updateAdunitsTable(data) {
      //console.log('hellooooo' + adunit.name);
      //console.log('hellooooo' + data);
      // tableData.value = [];
      data.forEach(adunit => {
        //console.log(adunit.reports[0]['revenue']);

        // let name = adunit.name;
        adunit.impressions = 0;
        adunit.clicks = 0;
        adunit.revenue = 0;

        adunit.reports.forEach(report => {
          adunit.impressions += report.impressions;
          adunit.clicks += report.clicks;
          adunit.revenue += report.revenue;
        });

        adunit.ctr = adunit.clicks * 100 / adunit.impressions || 0;

        adunit.ctr = adunit.ctr.toFixed(2)
        // tableData.value.push([name, impressions, clicks, ctr.toFixed(2) + ' %', '$ ' + revenue.toFixed(2)])
      })
      this.all_data = data
      this.reset_paginator()

      this.loading = false
    },

    updateAppsTable(data) {

      data.forEach(app => {
        app.impressions = 0;
        app.clicks = 0;
        app.revenue = 0;

        app.adunits.forEach(adunit => {
          adunit.reports.forEach(report => {
            app.impressions += report.impressions;
            app.clicks += report.clicks;
            app.revenue += report.revenue;
          })
        })

        app.ctr = app.clicks * 100 / app.impressions || 0;
        app.ctr = app.ctr.toFixed(2)

      })

      this.all_data = data
      this.reset_paginator()

      this.loading = false

    },


  }
}


function paginator() {
  return {

    pre_btn: false,
    nex_btn: true,

    pager: 1,
    first_item: 0,
    last_item: 1,

    all_data: [],
    listed_data: [],

    initial_paginator() {

      console.log(this.first_item, this.last_item);

      // slice data
      this.listed_data = this.all_data.slice(this.first_item, this.last_item)

      if (this.first_item == 0) { this.pre_btn = false }
      if (this.first_item > 0) { this.pre_btn = true }

      if (this.last_item >= this.all_data.length) { this.nex_btn = false }
      if (this.last_item < this.all_data.length) { this.nex_btn = true }
    },

    next() {
      this.first_item = this.first_item + this.pager
      this.last_item = this.last_item + this.pager

      this.initial_paginator()
    },
    prev() {
      this.first_item = this.first_item - this.pager
      this.last_item = this.last_item - this.pager
      this.initial_paginator()
    },
    reset_paginator() {
      // this.pager = pager || 20
      // this.first_item = 0
      // this.last_item = this.pager
      // this.listed_items = items.slice(this.first_item, this.last_item)

      // reset
      this.first_item = 0
      this.last_item = this.pager

      this.initial_paginator()
    }


  }
}