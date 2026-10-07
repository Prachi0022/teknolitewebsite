var TRACKING = {
  debug: !1,
  log: function (e) {
    TRACKING.debug &&
      (console.log("TRACKING." + arguments.callee.caller.name + "(): ", e),
      console.log("DATALAYER", window.dataLayer));
  },
  trackEvent: function (e, a, n, t, o) {
    if (
      (void 0 === t && (t = 0),
      void 0 === o && (o = function () {}),
      window.dataLayer)
    ) {
      var r,
        d = o;
      window.google_tag_manager &&
        ((d = function () {
          clearTimeout(r), o();
        }),
        (r = setTimeout(d, 2500))),
        window.dataLayer.push({
          event: "d3r.event",
          eventCategory: e,
          eventAction: a,
          eventLabel: n,
          eventValue: t,
          eventCallback: d,
          eventTimeout: 2e3,
        }),
        window.google_tag_manager || o();
    }
    TRACKING.log([e, a, n, parseInt(t), o]);
  },
  trackPageview: function (e) {
    window.dataLayer &&
      window.dataLayer.push({ event: "d3r.pageview", trackingUrl: e }),
      TRACKING.log(e);
  },
  trackAddProduct: function (e) {
    window.dataLayer &&
      window.dataLayer.push({
        event: "addToCart",
        ecommerce: {
          currencyCode: e.currency,
          add: { products: [e.tracking_item] },
        },
      }),
      TRACKING.log(e.tracking_item);
  },
};
//# sourceMappingURL=https://assets.astrolighting.com/static/maps/js/tracking.js.3da07.map
