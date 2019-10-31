Nova.booting((Vue, router, store) => {
    Vue.component('panel-item', require('./components/PanelItem'))
    Vue.component('panel', require('./components/Panel'))
})
