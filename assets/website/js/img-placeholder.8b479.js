function D3RPHQ(t) {
  var a = this;
  (this.push = function (t) {
    a.checkImage(t, 1);
  }),
    (this.checkImage = function (e, t) {
      var r;
      e.hasAttribute("data-placeholder") &&
        (((r = document.createElement("img")).onload = function () {
          (r = r.onload = r.onerror = null),
            ["src", "srcset"].forEach(function (t) {
              t in e.dataset &&
                ((e[t] = e.dataset[t]), e.removeAttribute("data-" + t));
            }),
            e.removeAttribute("data-placeholder");
        }),
        (r.onerror = function () {
          (r = r.onload = r.onerror = null),
            setTimeout(function () {
              a.checkImage(e, t + 1);
            }, 1e3 * t);
        }),
        "srcset" in r && e.hasAttribute("data-srcset")
          ? ((r.sizes = e.sizes), (r.srcset = e.dataset.srcset))
          : e.hasAttribute("data-src") && (r.src = e.dataset.src));
    }),
    t.length && t.forEach(this.push);
}
(window.d3r_phq = window.d3r_phq || []),
  window.d3r_phq instanceof D3RPHQ ||
    (window.d3r_phq = new D3RPHQ(window.d3r_phq));
