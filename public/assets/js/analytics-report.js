document.addEventListener('alpine:init', () => {

    // Dark Light Theme Controller
    Alpine.store('report', {

        columns: ['name', 'impressions', 'clicks', 'ctr', 'revenue'],
        adunits: [],
        apps: [],
        days: [],
        token: '',
        loading: true,
        group: 'apps',
        data: [],

        getData() {
            this.token = Alpine.store('token')
            this.loading = true
            this.rangeDate = document.getElementById('dateRange').value;
            this.startDate = this.rangeDate.split('  To  ')[0];
            this.endDate = this.rangeDate.split('  To  ')[1];

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


            Alpine.store('table_paginator').all_data = data
            Alpine.store('table_paginator').reset_paginator()

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

            Alpine.store('table_paginator').all_data = data
            Alpine.store('table_paginator').reset_paginator()

            this.loading = false

        },


    })
})


