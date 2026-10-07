!(function (t, e) {
  "object" == typeof exports && "undefined" != typeof module
    ? (module.exports = e())
    : "function" == typeof define && define.amd
    ? define(e)
    : (t.tippy = e());
})(this, function () {
  "use strict";
  var t = "undefined" != typeof window,
    e = t && /MSIE |Trident\//.test(navigator.userAgent),
    i = {};
  t &&
    ((i.supported = "requestAnimationFrame" in window),
    (i.supportsTouch = "ontouchstart" in window),
    (i.usingTouch = !1),
    (i.dynamicInputDetection = !0),
    (i.iOS = /iPhone|iPad|iPod/.test(navigator.platform) && !window.MSStream),
    (i.onUserInputChange = function () {}));
  var n = {
      POPPER: ".tippy-popper",
      TOOLTIP: ".tippy-tooltip",
      CONTENT: ".tippy-content",
      BACKDROP: ".tippy-backdrop",
      ARROW: ".tippy-arrow",
      ROUND_ARROW: ".tippy-roundarrow",
      REFERENCE: "[data-tippy]",
    },
    o = {
      placement: "top",
      livePlacement: !0,
      trigger: "mouseenter focus",
      animation: "shift-away",
      html: !1,
      animateFill: !0,
      arrow: !1,
      delay: [0, 20],
      duration: [350, 300],
      interactive: !1,
      interactiveBorder: 2,
      theme: "dark",
      size: "regular",
      distance: 10,
      offset: 0,
      hideOnClick: !0,
      multiple: !1,
      followCursor: !1,
      inertia: !1,
      updateDuration: 350,
      sticky: !1,
      appendTo: function () {
        return document.body;
      },
      zIndex: 9999,
      touchHold: !1,
      performance: !1,
      dynamicTitle: !1,
      flip: !0,
      flipBehavior: "flip",
      arrowType: "sharp",
      arrowTransform: "",
      maxWidth: "",
      target: null,
      allowTitleHTML: !0,
      popperOptions: {},
      createPopperInstanceOnInit: !1,
      onShow: function () {},
      onShown: function () {},
      onHide: function () {},
      onHidden: function () {},
    },
    a = i.supported && Object.keys(o);
  function r(t) {
    return "[object Object]" === {}.toString.call(t);
  }
  function s(t) {
    return [].slice.call(t);
  }
  function p(t) {
    for (
      var e = ["", "webkit"], i = t.charAt(0).toUpperCase() + t.slice(1), n = 0;
      n < e.length;
      n++
    ) {
      var o = e[n],
        a = o ? o + i : t;
      if (void 0 !== document.body.style[a]) return a;
    }
    return null;
  }
  function l() {
    return document.createElement("div");
  }
  var d = (function () {
      function t(t, e) {
        for (var i = 0; i < e.length; i++) {
          var n = e[i];
          (n.enumerable = n.enumerable || !1),
            (n.configurable = !0),
            "value" in n && (n.writable = !0),
            Object.defineProperty(t, n.key, n);
        }
      }
      return function (e, i, n) {
        return i && t(e.prototype, i), n && t(e, n), e;
      };
    })(),
    c =
      Object.assign ||
      function (t) {
        for (var e = 1; e < arguments.length; e++) {
          var i = arguments[e];
          for (var n in i)
            Object.prototype.hasOwnProperty.call(i, n) && (t[n] = i[n]);
        }
        return t;
      };
  function h(t) {
    var e = function (e) {
      return t.querySelector(e);
    };
    return {
      tooltip: e(n.TOOLTIP),
      backdrop: e(n.BACKDROP),
      content: e(n.CONTENT),
      arrow: e(n.ARROW) || e(n.ROUND_ARROW),
    };
  }
  function u(t) {
    var e = t.getAttribute("title");
    e && t.setAttribute("data-original-title", e), t.removeAttribute("title");
  }
  for (
    var f = "undefined" != typeof window && "undefined" != typeof document,
      m = ["Edge", "Trident", "Firefox"],
      v = 0,
      b = 0;
    b < m.length;
    b += 1
  )
    if (f && navigator.userAgent.indexOf(m[b]) >= 0) {
      v = 1;
      break;
    }
  var g =
    f && window.Promise
      ? function (t) {
          var e = !1;
          return function () {
            e ||
              ((e = !0),
              window.Promise.resolve().then(function () {
                (e = !1), t();
              }));
          };
        }
      : function (t) {
          var e = !1;
          return function () {
            e ||
              ((e = !0),
              setTimeout(function () {
                (e = !1), t();
              }, v));
          };
        };
  function y(t) {
    return t && "[object Function]" === {}.toString.call(t);
  }
  function w(t, e) {
    if (1 !== t.nodeType) return [];
    var i = getComputedStyle(t, null);
    return e ? i[e] : i;
  }
  function x(t) {
    return "HTML" === t.nodeName ? t : t.parentNode || t.host;
  }
  function _(t) {
    if (!t) return document.body;
    switch (t.nodeName) {
      case "HTML":
      case "BODY":
        return t.ownerDocument.body;
      case "#document":
        return t.body;
    }
    var e = w(t),
      i = e.overflow,
      n = e.overflowX,
      o = e.overflowY;
    return /(auto|scroll|overlay)/.test(i + o + n) ? t : _(x(t));
  }
  var k = f && !(!window.MSInputMethodContext || !document.documentMode),
    E = f && /MSIE 10/.test(navigator.userAgent);
  function C(t) {
    return 11 === t ? k : 10 === t ? E : k || E;
  }
  function T(t) {
    if (!t) return document.documentElement;
    for (
      var e = C(10) ? document.body : null, i = t.offsetParent;
      i === e && t.nextElementSibling;

    )
      i = (t = t.nextElementSibling).offsetParent;
    var n = i && i.nodeName;
    return n && "BODY" !== n && "HTML" !== n
      ? -1 !== ["TD", "TABLE"].indexOf(i.nodeName) &&
        "static" === w(i, "position")
        ? T(i)
        : i
      : t
      ? t.ownerDocument.documentElement
      : document.documentElement;
  }
  function O(t) {
    return null !== t.parentNode ? O(t.parentNode) : t;
  }
  function S(t, e) {
    if (!(t && t.nodeType && e && e.nodeType)) return document.documentElement;
    var i = t.compareDocumentPosition(e) & Node.DOCUMENT_POSITION_FOLLOWING,
      n = i ? t : e,
      o = i ? e : t,
      a = document.createRange();
    a.setStart(n, 0), a.setEnd(o, 0);
    var r,
      s,
      p = a.commonAncestorContainer;
    if ((t !== p && e !== p) || n.contains(o))
      return "BODY" === (s = (r = p).nodeName) ||
        ("HTML" !== s && T(r.firstElementChild) !== r)
        ? T(p)
        : p;
    var l = O(t);
    return l.host ? S(l.host, e) : S(t, O(e).host);
  }
  function P(t) {
    var e =
        "top" ===
        (arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "top")
          ? "scrollTop"
          : "scrollLeft",
      i = t.nodeName;
    if ("BODY" === i || "HTML" === i) {
      var n = t.ownerDocument.documentElement;
      return (t.ownerDocument.scrollingElement || n)[e];
    }
    return t[e];
  }
  function A(t, e) {
    var i = "x" === e ? "Left" : "Top",
      n = "Left" === i ? "Right" : "Bottom";
    return (
      parseFloat(t["border" + i + "Width"], 10) +
      parseFloat(t["border" + n + "Width"], 10)
    );
  }
  function I(t, e, i, n) {
    return Math.max(
      e["offset" + t],
      e["scroll" + t],
      i["client" + t],
      i["offset" + t],
      i["scroll" + t],
      C(10)
        ? parseInt(i["offset" + t]) +
            parseInt(n["margin" + ("Height" === t ? "Top" : "Left")]) +
            parseInt(n["margin" + ("Height" === t ? "Bottom" : "Right")])
        : 0
    );
  }
  function L(t) {
    var e = t.body,
      i = t.documentElement,
      n = C(10) && getComputedStyle(i);
    return { height: I("Height", e, i, n), width: I("Width", e, i, n) };
  }
  var N = (function () {
      function t(t, e) {
        for (var i = 0; i < e.length; i++) {
          var n = e[i];
          (n.enumerable = n.enumerable || !1),
            (n.configurable = !0),
            "value" in n && (n.writable = !0),
            Object.defineProperty(t, n.key, n);
        }
      }
      return function (e, i, n) {
        return i && t(e.prototype, i), n && t(e, n), e;
      };
    })(),
    D = function (t, e, i) {
      return (
        e in t
          ? Object.defineProperty(t, e, {
              value: i,
              enumerable: !0,
              configurable: !0,
              writable: !0,
            })
          : (t[e] = i),
        t
      );
    },
    Y =
      Object.assign ||
      function (t) {
        for (var e = 1; e < arguments.length; e++) {
          var i = arguments[e];
          for (var n in i)
            Object.prototype.hasOwnProperty.call(i, n) && (t[n] = i[n]);
        }
        return t;
      };
  function M(t) {
    return Y({}, t, { right: t.left + t.width, bottom: t.top + t.height });
  }
  function X(t) {
    var e = {};
    try {
      if (C(10)) {
        e = t.getBoundingClientRect();
        var i = P(t, "top"),
          n = P(t, "left");
        (e.top += i), (e.left += n), (e.bottom += i), (e.right += n);
      } else e = t.getBoundingClientRect();
    } catch (t) {}
    var o = {
        left: e.left,
        top: e.top,
        width: e.right - e.left,
        height: e.bottom - e.top,
      },
      a = "HTML" === t.nodeName ? L(t.ownerDocument) : {},
      r = a.width || t.clientWidth || o.right - o.left,
      s = a.height || t.clientHeight || o.bottom - o.top,
      p = t.offsetWidth - r,
      l = t.offsetHeight - s;
    if (p || l) {
      var d = w(t);
      (p -= A(d, "x")), (l -= A(d, "y")), (o.width -= p), (o.height -= l);
    }
    return M(o);
  }
  function H(t, e) {
    var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
      n = C(10),
      o = "HTML" === e.nodeName,
      a = X(t),
      r = X(e),
      s = _(t),
      p = w(e),
      l = parseFloat(p.borderTopWidth, 10),
      d = parseFloat(p.borderLeftWidth, 10);
    i && o && ((r.top = Math.max(r.top, 0)), (r.left = Math.max(r.left, 0)));
    var c = M({
      top: a.top - r.top - l,
      left: a.left - r.left - d,
      width: a.width,
      height: a.height,
    });
    if (((c.marginTop = 0), (c.marginLeft = 0), !n && o)) {
      var h = parseFloat(p.marginTop, 10),
        u = parseFloat(p.marginLeft, 10);
      (c.top -= l - h),
        (c.bottom -= l - h),
        (c.left -= d - u),
        (c.right -= d - u),
        (c.marginTop = h),
        (c.marginLeft = u);
    }
    return (
      (n && !i ? e.contains(s) : e === s && "BODY" !== s.nodeName) &&
        (c = (function (t, e) {
          var i =
              arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
            n = P(e, "top"),
            o = P(e, "left"),
            a = i ? -1 : 1;
          return (
            (t.top += n * a),
            (t.bottom += n * a),
            (t.left += o * a),
            (t.right += o * a),
            t
          );
        })(c, e)),
      c
    );
  }
  function $(t) {
    var e = t.nodeName;
    return (
      "BODY" !== e && "HTML" !== e && ("fixed" === w(t, "position") || $(x(t)))
    );
  }
  function W(t) {
    if (!t || !t.parentElement || C()) return document.documentElement;
    for (var e = t.parentElement; e && "none" === w(e, "transform"); )
      e = e.parentElement;
    return e || document.documentElement;
  }
  function B(t, e, i, n) {
    var o = arguments.length > 4 && void 0 !== arguments[4] && arguments[4],
      a = { top: 0, left: 0 },
      r = o ? W(t) : S(t, e);
    if ("viewport" === n)
      a = (function (t) {
        var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
          i = t.ownerDocument.documentElement,
          n = H(t, i),
          o = Math.max(i.clientWidth, window.innerWidth || 0),
          a = Math.max(i.clientHeight, window.innerHeight || 0),
          r = e ? 0 : P(i),
          s = e ? 0 : P(i, "left");
        return M({
          top: r - n.top + n.marginTop,
          left: s - n.left + n.marginLeft,
          width: o,
          height: a,
        });
      })(r, o);
    else {
      var s = void 0;
      "scrollParent" === n
        ? "BODY" === (s = _(x(e))).nodeName &&
          (s = t.ownerDocument.documentElement)
        : (s = "window" === n ? t.ownerDocument.documentElement : n);
      var p = H(s, r, o);
      if ("HTML" !== s.nodeName || $(r)) a = p;
      else {
        var l = L(t.ownerDocument),
          d = l.height,
          c = l.width;
        (a.top += p.top - p.marginTop),
          (a.bottom = d + p.top),
          (a.left += p.left - p.marginLeft),
          (a.right = c + p.left);
      }
    }
    var h = "number" == typeof (i = i || 0);
    return (
      (a.left += h ? i : i.left || 0),
      (a.top += h ? i : i.top || 0),
      (a.right -= h ? i : i.right || 0),
      (a.bottom -= h ? i : i.bottom || 0),
      a
    );
  }
  function F(t, e, i, n, o) {
    var a = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : 0;
    if (-1 === t.indexOf("auto")) return t;
    var r = B(i, n, a, o),
      s = {
        top: { width: r.width, height: e.top - r.top },
        right: { width: r.right - e.right, height: r.height },
        bottom: { width: r.width, height: r.bottom - e.bottom },
        left: { width: e.left - r.left, height: r.height },
      },
      p = Object.keys(s)
        .map(function (t) {
          return Y({ key: t }, s[t], {
            area: ((e = s[t]), e.width * e.height),
          });
          var e;
        })
        .sort(function (t, e) {
          return e.area - t.area;
        }),
      l = p.filter(function (t) {
        var e = t.width,
          n = t.height;
        return e >= i.clientWidth && n >= i.clientHeight;
      }),
      d = l.length > 0 ? l[0].key : p[0].key,
      c = t.split("-")[1];
    return d + (c ? "-" + c : "");
  }
  function R(t, e, i) {
    var n =
      arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null;
    return H(i, n ? W(e) : S(e, i), n);
  }
  function j(t) {
    var e = getComputedStyle(t),
      i = parseFloat(e.marginTop) + parseFloat(e.marginBottom),
      n = parseFloat(e.marginLeft) + parseFloat(e.marginRight);
    return { width: t.offsetWidth + n, height: t.offsetHeight + i };
  }
  function z(t) {
    var e = { left: "right", right: "left", bottom: "top", top: "bottom" };
    return t.replace(/left|right|bottom|top/g, function (t) {
      return e[t];
    });
  }
  function U(t, e, i) {
    i = i.split("-")[0];
    var n = j(t),
      o = { width: n.width, height: n.height },
      a = -1 !== ["right", "left"].indexOf(i),
      r = a ? "top" : "left",
      s = a ? "left" : "top",
      p = a ? "height" : "width",
      l = a ? "width" : "height";
    return (
      (o[r] = e[r] + e[p] / 2 - n[p] / 2),
      (o[s] = i === s ? e[s] - n[l] : e[z(s)]),
      o
    );
  }
  function q(t, e) {
    return Array.prototype.find ? t.find(e) : t.filter(e)[0];
  }
  function V(t, e, i) {
    return (
      (void 0 === i
        ? t
        : t.slice(
            0,
            (function (t, e, i) {
              if (Array.prototype.findIndex)
                return t.findIndex(function (t) {
                  return t[e] === i;
                });
              var n = q(t, function (t) {
                return t[e] === i;
              });
              return t.indexOf(n);
            })(t, "name", i)
          )
      ).forEach(function (t) {
        t.function &&
          console.warn("`modifier.function` is deprecated, use `modifier.fn`!");
        var i = t.function || t.fn;
        t.enabled &&
          y(i) &&
          ((e.offsets.popper = M(e.offsets.popper)),
          (e.offsets.reference = M(e.offsets.reference)),
          (e = i(e, t)));
      }),
      e
    );
  }
  function G() {
    if (!this.state.isDestroyed) {
      var t = {
        instance: this,
        styles: {},
        arrowStyles: {},
        attributes: {},
        flipped: !1,
        offsets: {},
      };
      (t.offsets.reference = R(
        this.state,
        this.popper,
        this.reference,
        this.options.positionFixed
      )),
        (t.placement = F(
          this.options.placement,
          t.offsets.reference,
          this.popper,
          this.reference,
          this.options.modifiers.flip.boundariesElement,
          this.options.modifiers.flip.padding
        )),
        (t.originalPlacement = t.placement),
        (t.positionFixed = this.options.positionFixed),
        (t.offsets.popper = U(this.popper, t.offsets.reference, t.placement)),
        (t.offsets.popper.position = this.options.positionFixed
          ? "fixed"
          : "absolute"),
        (t = V(this.modifiers, t)),
        this.state.isCreated
          ? this.options.onUpdate(t)
          : ((this.state.isCreated = !0), this.options.onCreate(t));
    }
  }
  function Q(t, e) {
    return t.some(function (t) {
      var i = t.name;
      return t.enabled && i === e;
    });
  }
  function K(t) {
    for (
      var e = [!1, "ms", "Webkit", "Moz", "O"],
        i = t.charAt(0).toUpperCase() + t.slice(1),
        n = 0;
      n < e.length;
      n++
    ) {
      var o = e[n],
        a = o ? "" + o + i : t;
      if (void 0 !== document.body.style[a]) return a;
    }
    return null;
  }
  function J() {
    return (
      (this.state.isDestroyed = !0),
      Q(this.modifiers, "applyStyle") &&
        (this.popper.removeAttribute("x-placement"),
        (this.popper.style.position = ""),
        (this.popper.style.top = ""),
        (this.popper.style.left = ""),
        (this.popper.style.right = ""),
        (this.popper.style.bottom = ""),
        (this.popper.style.willChange = ""),
        (this.popper.style[K("transform")] = "")),
      this.disableEventListeners(),
      this.options.removeOnDestroy &&
        this.popper.parentNode.removeChild(this.popper),
      this
    );
  }
  function Z(t) {
    var e = t.ownerDocument;
    return e ? e.defaultView : window;
  }
  function tt(t, e, i, n) {
    var o = "BODY" === t.nodeName,
      a = o ? t.ownerDocument.defaultView : t;
    a.addEventListener(e, i, { passive: !0 }),
      o || tt(_(a.parentNode), e, i, n),
      n.push(a);
  }
  function et(t, e, i, n) {
    (i.updateBound = n),
      Z(t).addEventListener("resize", i.updateBound, { passive: !0 });
    var o = _(t);
    return (
      tt(o, "scroll", i.updateBound, i.scrollParents),
      (i.scrollElement = o),
      (i.eventsEnabled = !0),
      i
    );
  }
  function it() {
    this.state.eventsEnabled ||
      (this.state = et(
        this.reference,
        this.options,
        this.state,
        this.scheduleUpdate
      ));
  }
  function nt() {
    var t, e;
    this.state.eventsEnabled &&
      (cancelAnimationFrame(this.scheduleUpdate),
      (this.state =
        ((t = this.reference),
        (e = this.state),
        Z(t).removeEventListener("resize", e.updateBound),
        e.scrollParents.forEach(function (t) {
          t.removeEventListener("scroll", e.updateBound);
        }),
        (e.updateBound = null),
        (e.scrollParents = []),
        (e.scrollElement = null),
        (e.eventsEnabled = !1),
        e)));
  }
  function ot(t) {
    return "" !== t && !isNaN(parseFloat(t)) && isFinite(t);
  }
  function at(t, e) {
    Object.keys(e).forEach(function (i) {
      var n = "";
      -1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(i) &&
        ot(e[i]) &&
        (n = "px"),
        (t.style[i] = e[i] + n);
    });
  }
  function rt(t, e, i) {
    var n = q(t, function (t) {
        return t.name === e;
      }),
      o =
        !!n &&
        t.some(function (t) {
          return t.name === i && t.enabled && t.order < n.order;
        });
    if (!o) {
      var a = "`" + e + "`",
        r = "`" + i + "`";
      console.warn(
        r +
          " modifier is required by " +
          a +
          " modifier in order to work, be sure to include it before " +
          a +
          "!"
      );
    }
    return o;
  }
  var st = [
      "auto-start",
      "auto",
      "auto-end",
      "top-start",
      "top",
      "top-end",
      "right-start",
      "right",
      "right-end",
      "bottom-end",
      "bottom",
      "bottom-start",
      "left-end",
      "left",
      "left-start",
    ],
    pt = st.slice(3);
  function lt(t) {
    var e = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
      i = pt.indexOf(t),
      n = pt.slice(i + 1).concat(pt.slice(0, i));
    return e ? n.reverse() : n;
  }
  var dt = "flip",
    ct = "clockwise",
    ht = "counterclockwise";
  function ut(t, e, i, n) {
    var o = [0, 0],
      a = -1 !== ["right", "left"].indexOf(n),
      r = t.split(/(\+|\-)/).map(function (t) {
        return t.trim();
      }),
      s = r.indexOf(
        q(r, function (t) {
          return -1 !== t.search(/,|\s/);
        })
      );
    r[s] &&
      -1 === r[s].indexOf(",") &&
      console.warn(
        "Offsets separated by white space(s) are deprecated, use a comma (,) instead."
      );
    var p = /\s*,\s*|\s+/,
      l =
        -1 !== s
          ? [
              r.slice(0, s).concat([r[s].split(p)[0]]),
              [r[s].split(p)[1]].concat(r.slice(s + 1)),
            ]
          : [r];
    return (
      (l = l.map(function (t, n) {
        var o = (1 === n ? !a : a) ? "height" : "width",
          r = !1;
        return t
          .reduce(function (t, e) {
            return "" === t[t.length - 1] && -1 !== ["+", "-"].indexOf(e)
              ? ((t[t.length - 1] = e), (r = !0), t)
              : r
              ? ((t[t.length - 1] += e), (r = !1), t)
              : t.concat(e);
          }, [])
          .map(function (t) {
            return (function (t, e, i, n) {
              var o = t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                a = +o[1],
                r = o[2];
              if (!a) return t;
              if (0 === r.indexOf("%")) {
                return (M("%p" === r ? i : n)[e] / 100) * a;
              }
              if ("vh" === r || "vw" === r)
                return (
                  (("vh" === r
                    ? Math.max(
                        document.documentElement.clientHeight,
                        window.innerHeight || 0
                      )
                    : Math.max(
                        document.documentElement.clientWidth,
                        window.innerWidth || 0
                      )) /
                    100) *
                  a
                );
              return a;
            })(t, o, e, i);
          });
      })),
      l.forEach(function (t, e) {
        t.forEach(function (i, n) {
          ot(i) && (o[e] += i * ("-" === t[n - 1] ? -1 : 1));
        });
      }),
      o
    );
  }
  var ft = {
      shift: {
        order: 100,
        enabled: !0,
        fn: function (t) {
          var e = t.placement,
            i = e.split("-")[0],
            n = e.split("-")[1];
          if (n) {
            var o = t.offsets,
              a = o.reference,
              r = o.popper,
              s = -1 !== ["bottom", "top"].indexOf(i),
              p = s ? "left" : "top",
              l = s ? "width" : "height",
              d = { start: D({}, p, a[p]), end: D({}, p, a[p] + a[l] - r[l]) };
            t.offsets.popper = Y({}, r, d[n]);
          }
          return t;
        },
      },
      offset: {
        order: 200,
        enabled: !0,
        fn: function (t, e) {
          var i = e.offset,
            n = t.placement,
            o = t.offsets,
            a = o.popper,
            r = o.reference,
            s = n.split("-")[0],
            p = void 0;
          return (
            (p = ot(+i) ? [+i, 0] : ut(i, a, r, s)),
            "left" === s
              ? ((a.top += p[0]), (a.left -= p[1]))
              : "right" === s
              ? ((a.top += p[0]), (a.left += p[1]))
              : "top" === s
              ? ((a.left += p[0]), (a.top -= p[1]))
              : "bottom" === s && ((a.left += p[0]), (a.top += p[1])),
            (t.popper = a),
            t
          );
        },
        offset: 0,
      },
      preventOverflow: {
        order: 300,
        enabled: !0,
        fn: function (t, e) {
          var i = e.boundariesElement || T(t.instance.popper);
          t.instance.reference === i && (i = T(i));
          var n = K("transform"),
            o = t.instance.popper.style,
            a = o.top,
            r = o.left,
            s = o[n];
          (o.top = ""), (o.left = ""), (o[n] = "");
          var p = B(
            t.instance.popper,
            t.instance.reference,
            e.padding,
            i,
            t.positionFixed
          );
          (o.top = a), (o.left = r), (o[n] = s), (e.boundaries = p);
          var l = e.priority,
            d = t.offsets.popper,
            c = {
              primary: function (t) {
                var i = d[t];
                return (
                  d[t] < p[t] &&
                    !e.escapeWithReference &&
                    (i = Math.max(d[t], p[t])),
                  D({}, t, i)
                );
              },
              secondary: function (t) {
                var i = "right" === t ? "left" : "top",
                  n = d[i];
                return (
                  d[t] > p[t] &&
                    !e.escapeWithReference &&
                    (n = Math.min(
                      d[i],
                      p[t] - ("right" === t ? d.width : d.height)
                    )),
                  D({}, i, n)
                );
              },
            };
          return (
            l.forEach(function (t) {
              var e =
                -1 !== ["left", "top"].indexOf(t) ? "primary" : "secondary";
              d = Y({}, d, c[e](t));
            }),
            (t.offsets.popper = d),
            t
          );
        },
        priority: ["left", "right", "top", "bottom"],
        padding: 5,
        boundariesElement: "scrollParent",
      },
      keepTogether: {
        order: 400,
        enabled: !0,
        fn: function (t) {
          var e = t.offsets,
            i = e.popper,
            n = e.reference,
            o = t.placement.split("-")[0],
            a = Math.floor,
            r = -1 !== ["top", "bottom"].indexOf(o),
            s = r ? "right" : "bottom",
            p = r ? "left" : "top",
            l = r ? "width" : "height";
          return (
            i[s] < a(n[p]) && (t.offsets.popper[p] = a(n[p]) - i[l]),
            i[p] > a(n[s]) && (t.offsets.popper[p] = a(n[s])),
            t
          );
        },
      },
      arrow: {
        order: 500,
        enabled: !0,
        fn: function (t, e) {
          var i;
          if (!rt(t.instance.modifiers, "arrow", "keepTogether")) return t;
          var n = e.element;
          if ("string" == typeof n) {
            if (!(n = t.instance.popper.querySelector(n))) return t;
          } else if (!t.instance.popper.contains(n))
            return (
              console.warn(
                "WARNING: `arrow.element` must be child of its popper element!"
              ),
              t
            );
          var o = t.placement.split("-")[0],
            a = t.offsets,
            r = a.popper,
            s = a.reference,
            p = -1 !== ["left", "right"].indexOf(o),
            l = p ? "height" : "width",
            d = p ? "Top" : "Left",
            c = d.toLowerCase(),
            h = p ? "left" : "top",
            u = p ? "bottom" : "right",
            f = j(n)[l];
          s[u] - f < r[c] && (t.offsets.popper[c] -= r[c] - (s[u] - f)),
            s[c] + f > r[u] && (t.offsets.popper[c] += s[c] + f - r[u]),
            (t.offsets.popper = M(t.offsets.popper));
          var m = s[c] + s[l] / 2 - f / 2,
            v = w(t.instance.popper),
            b = parseFloat(v["margin" + d], 10),
            g = parseFloat(v["border" + d + "Width"], 10),
            y = m - t.offsets.popper[c] - b - g;
          return (
            (y = Math.max(Math.min(r[l] - f, y), 0)),
            (t.arrowElement = n),
            (t.offsets.arrow = (D((i = {}), c, Math.round(y)), D(i, h, ""), i)),
            t
          );
        },
        element: "[x-arrow]",
      },
      flip: {
        order: 600,
        enabled: !0,
        fn: function (t, e) {
          if (Q(t.instance.modifiers, "inner")) return t;
          if (t.flipped && t.placement === t.originalPlacement) return t;
          var i = B(
              t.instance.popper,
              t.instance.reference,
              e.padding,
              e.boundariesElement,
              t.positionFixed
            ),
            n = t.placement.split("-")[0],
            o = z(n),
            a = t.placement.split("-")[1] || "",
            r = [];
          switch (e.behavior) {
            case dt:
              r = [n, o];
              break;
            case ct:
              r = lt(n);
              break;
            case ht:
              r = lt(n, !0);
              break;
            default:
              r = e.behavior;
          }
          return (
            r.forEach(function (s, p) {
              if (n !== s || r.length === p + 1) return t;
              (n = t.placement.split("-")[0]), (o = z(n));
              var l = t.offsets.popper,
                d = t.offsets.reference,
                c = Math.floor,
                h =
                  ("left" === n && c(l.right) > c(d.left)) ||
                  ("right" === n && c(l.left) < c(d.right)) ||
                  ("top" === n && c(l.bottom) > c(d.top)) ||
                  ("bottom" === n && c(l.top) < c(d.bottom)),
                u = c(l.left) < c(i.left),
                f = c(l.right) > c(i.right),
                m = c(l.top) < c(i.top),
                v = c(l.bottom) > c(i.bottom),
                b =
                  ("left" === n && u) ||
                  ("right" === n && f) ||
                  ("top" === n && m) ||
                  ("bottom" === n && v),
                g = -1 !== ["top", "bottom"].indexOf(n),
                y =
                  !!e.flipVariations &&
                  ((g && "start" === a && u) ||
                    (g && "end" === a && f) ||
                    (!g && "start" === a && m) ||
                    (!g && "end" === a && v));
              (h || b || y) &&
                ((t.flipped = !0),
                (h || b) && (n = r[p + 1]),
                y &&
                  (a = (function (t) {
                    return "end" === t ? "start" : "start" === t ? "end" : t;
                  })(a)),
                (t.placement = n + (a ? "-" + a : "")),
                (t.offsets.popper = Y(
                  {},
                  t.offsets.popper,
                  U(t.instance.popper, t.offsets.reference, t.placement)
                )),
                (t = V(t.instance.modifiers, t, "flip")));
            }),
            t
          );
        },
        behavior: "flip",
        padding: 5,
        boundariesElement: "viewport",
      },
      inner: {
        order: 700,
        enabled: !1,
        fn: function (t) {
          var e = t.placement,
            i = e.split("-")[0],
            n = t.offsets,
            o = n.popper,
            a = n.reference,
            r = -1 !== ["left", "right"].indexOf(i),
            s = -1 === ["top", "left"].indexOf(i);
          return (
            (o[r ? "left" : "top"] =
              a[i] - (s ? o[r ? "width" : "height"] : 0)),
            (t.placement = z(e)),
            (t.offsets.popper = M(o)),
            t
          );
        },
      },
      hide: {
        order: 800,
        enabled: !0,
        fn: function (t) {
          if (!rt(t.instance.modifiers, "hide", "preventOverflow")) return t;
          var e = t.offsets.reference,
            i = q(t.instance.modifiers, function (t) {
              return "preventOverflow" === t.name;
            }).boundaries;
          if (
            e.bottom < i.top ||
            e.left > i.right ||
            e.top > i.bottom ||
            e.right < i.left
          ) {
            if (!0 === t.hide) return t;
            (t.hide = !0), (t.attributes["x-out-of-boundaries"] = "");
          } else {
            if (!1 === t.hide) return t;
            (t.hide = !1), (t.attributes["x-out-of-boundaries"] = !1);
          }
          return t;
        },
      },
      computeStyle: {
        order: 850,
        enabled: !0,
        fn: function (t, e) {
          var i = e.x,
            n = e.y,
            o = t.offsets.popper,
            a = q(t.instance.modifiers, function (t) {
              return "applyStyle" === t.name;
            }).gpuAcceleration;
          void 0 !== a &&
            console.warn(
              "WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!"
            );
          var r = void 0 !== a ? a : e.gpuAcceleration,
            s = T(t.instance.popper),
            p = X(s),
            l = { position: o.position },
            d = {
              left: Math.floor(o.left),
              top: Math.round(o.top),
              bottom: Math.round(o.bottom),
              right: Math.floor(o.right),
            },
            c = "bottom" === i ? "top" : "bottom",
            h = "right" === n ? "left" : "right",
            u = K("transform"),
            f = void 0,
            m = void 0;
          if (
            ((m =
              "bottom" === c
                ? "HTML" === s.nodeName
                  ? -s.clientHeight + d.bottom
                  : -p.height + d.bottom
                : d.top),
            (f =
              "right" === h
                ? "HTML" === s.nodeName
                  ? -s.clientWidth + d.right
                  : -p.width + d.right
                : d.left),
            r && u)
          )
            (l[u] = "translate3d(" + f + "px, " + m + "px, 0)"),
              (l[c] = 0),
              (l[h] = 0),
              (l.willChange = "transform");
          else {
            var v = "bottom" === c ? -1 : 1,
              b = "right" === h ? -1 : 1;
            (l[c] = m * v), (l[h] = f * b), (l.willChange = c + ", " + h);
          }
          var g = { "x-placement": t.placement };
          return (
            (t.attributes = Y({}, g, t.attributes)),
            (t.styles = Y({}, l, t.styles)),
            (t.arrowStyles = Y({}, t.offsets.arrow, t.arrowStyles)),
            t
          );
        },
        gpuAcceleration: !0,
        x: "bottom",
        y: "right",
      },
      applyStyle: {
        order: 900,
        enabled: !0,
        fn: function (t) {
          var e, i;
          return (
            at(t.instance.popper, t.styles),
            (e = t.instance.popper),
            (i = t.attributes),
            Object.keys(i).forEach(function (t) {
              !1 !== i[t] ? e.setAttribute(t, i[t]) : e.removeAttribute(t);
            }),
            t.arrowElement &&
              Object.keys(t.arrowStyles).length &&
              at(t.arrowElement, t.arrowStyles),
            t
          );
        },
        onLoad: function (t, e, i, n, o) {
          var a = R(o, e, t, i.positionFixed),
            r = F(
              i.placement,
              a,
              e,
              t,
              i.modifiers.flip.boundariesElement,
              i.modifiers.flip.padding
            );
          return (
            e.setAttribute("x-placement", r),
            at(e, { position: i.positionFixed ? "fixed" : "absolute" }),
            i
          );
        },
        gpuAcceleration: void 0,
      },
    },
    mt = {
      placement: "bottom",
      positionFixed: !1,
      eventsEnabled: !0,
      removeOnDestroy: !1,
      onCreate: function () {},
      onUpdate: function () {},
      modifiers: ft,
    },
    vt = (function () {
      function t(e, i) {
        var n = this,
          o =
            arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
        !(function (t, e) {
          if (!(t instanceof e))
            throw new TypeError("Cannot call a class as a function");
        })(this, t),
          (this.scheduleUpdate = function () {
            return requestAnimationFrame(n.update);
          }),
          (this.update = g(this.update.bind(this))),
          (this.options = Y({}, t.Defaults, o)),
          (this.state = { isDestroyed: !1, isCreated: !1, scrollParents: [] }),
          (this.reference = e && e.jquery ? e[0] : e),
          (this.popper = i && i.jquery ? i[0] : i),
          (this.options.modifiers = {}),
          Object.keys(Y({}, t.Defaults.modifiers, o.modifiers)).forEach(
            function (e) {
              n.options.modifiers[e] = Y(
                {},
                t.Defaults.modifiers[e] || {},
                o.modifiers ? o.modifiers[e] : {}
              );
            }
          ),
          (this.modifiers = Object.keys(this.options.modifiers)
            .map(function (t) {
              return Y({ name: t }, n.options.modifiers[t]);
            })
            .sort(function (t, e) {
              return t.order - e.order;
            })),
          this.modifiers.forEach(function (t) {
            t.enabled &&
              y(t.onLoad) &&
              t.onLoad(n.reference, n.popper, n.options, t, n.state);
          }),
          this.update();
        var a = this.options.eventsEnabled;
        a && this.enableEventListeners(), (this.state.eventsEnabled = a);
      }
      return (
        N(t, [
          {
            key: "update",
            value: function () {
              return G.call(this);
            },
          },
          {
            key: "destroy",
            value: function () {
              return J.call(this);
            },
          },
          {
            key: "enableEventListeners",
            value: function () {
              return it.call(this);
            },
          },
          {
            key: "disableEventListeners",
            value: function () {
              return nt.call(this);
            },
          },
        ]),
        t
      );
    })();
  function bt(t) {
    return t.getAttribute("x-placement").replace(/-.+/, "");
  }
  function gt(t, e, i, n) {
    return e.length
      ? {
          scale:
            1 === e.length
              ? "" + e[0]
              : i
              ? e[0] + ", " + e[1]
              : e[1] + ", " + e[0],
          translate:
            1 === e.length
              ? n
                ? -e[0] + "px"
                : e[0] + "px"
              : i
              ? n
                ? e[0] + "px, " + -e[1] + "px"
                : e[0] + "px, " + e[1] + "px"
              : n
              ? -e[1] + "px, " + e[0] + "px"
              : e[1] + "px, " + e[0] + "px",
        }[t]
      : "";
  }
  function yt(t, e) {
    if (!t) return "";
    return e ? t : { X: "Y", Y: "X" }[t];
  }
  function wt(t, e, i) {
    var n = bt(t),
      o = "top" === n || "bottom" === n,
      a = "right" === n || "bottom" === n,
      r = function (t) {
        var e = i.match(t);
        return e ? e[1] : "";
      },
      s = function (t) {
        var e = i.match(t);
        return e ? e[1].split(",").map(parseFloat) : [];
      },
      l = /translateX?Y?\(([^)]+)\)/,
      d = /scaleX?Y?\(([^)]+)\)/,
      c = {
        translate: { axis: r(/translate([XY])/), numbers: s(l) },
        scale: { axis: r(/scale([XY])/), numbers: s(d) },
      },
      h = i
        .replace(
          l,
          "translate" +
            yt(c.translate.axis, o) +
            "(" +
            gt("translate", c.translate.numbers, o, a) +
            ")"
        )
        .replace(
          d,
          "scale" +
            yt(c.scale.axis, o) +
            "(" +
            gt("scale", c.scale.numbers, o, a) +
            ")"
        );
    e.style[p("transform")] = h;
  }
  function xt(t) {
    return -(t - o.distance) + "px";
  }
  (vt.Utils = ("undefined" != typeof window ? window : global).PopperUtils),
    (vt.placements = st),
    (vt.Defaults = mt);
  var _t = {};
  if (t) {
    var kt = Element.prototype;
    _t =
      kt.matches ||
      kt.matchesSelector ||
      kt.webkitMatchesSelector ||
      kt.mozMatchesSelector ||
      kt.msMatchesSelector ||
      function (t) {
        for (
          var e = (this.document || this.ownerDocument).querySelectorAll(t),
            i = e.length;
          --i >= 0 && e.item(i) !== this;

        );
        return i > -1;
      };
  }
  var Et = _t;
  function Ct(t, e) {
    return (
      Element.prototype.closest ||
      function (t) {
        for (var e = this; e; ) {
          if (Et.call(e, t)) return e;
          e = e.parentElement;
        }
      }
    ).call(t, e);
  }
  function Tt(t, e) {
    return Array.isArray(t) ? t[e] : t;
  }
  function Ot(t, e) {
    t.forEach(function (t) {
      t && t.setAttribute("data-state", e);
    });
  }
  function St(t, e) {
    t.filter(Boolean).forEach(function (t) {
      t.style[p("transitionDuration")] = e + "ms";
    });
  }
  function Pt(t) {
    var e = window.scrollX || window.pageXOffset,
      i = window.scrollY || window.pageYOffset;
    t.focus(), scroll(e, i);
  }
  var At = {},
    It = (function () {
      function t(e) {
        for (var i in ((function (t, e) {
          if (!(t instanceof e))
            throw new TypeError("Cannot call a class as a function");
        })(this, t),
        e))
          this[i] = e[i];
        var n;
        (this.state = { destroyed: !1, visible: !1, enabled: !0 }),
          (this._ =
            ((n = { mutationObservers: [] }),
            function (t) {
              return t === At && n;
            }));
      }
      return (
        d(t, [
          {
            key: "enable",
            value: function () {
              this.state.enabled = !0;
            },
          },
          {
            key: "disable",
            value: function () {
              this.state.enabled = !1;
            },
          },
          {
            key: "show",
            value: function (t) {
              var e = this;
              if (!this.state.destroyed && this.state.enabled) {
                var i = this.popper,
                  n = this.reference,
                  o = this.options,
                  a = h(i),
                  r = a.tooltip,
                  s = a.backdrop,
                  l = a.content;
                (o.dynamicTitle && !n.getAttribute("data-original-title")) ||
                  n.hasAttribute("disabled") ||
                  (n.refObj || document.documentElement.contains(n)
                    ? (o.onShow.call(i, this),
                      (t = Tt(void 0 !== t ? t : o.duration, 0)),
                      St([i, r, s], 0),
                      (i.style.visibility = "visible"),
                      (this.state.visible = !0),
                      Ht.call(this, function () {
                        if (e.state.visible) {
                          if (
                            (Lt.call(e) || e.popperInstance.scheduleUpdate(),
                            Lt.call(e))
                          ) {
                            e.popperInstance.disableEventListeners();
                            var a = Tt(o.delay, 0),
                              d = e._(At).lastTriggerEvent;
                            d &&
                              e
                                ._(At)
                                .followCursorListener(
                                  a && e._(At).lastMouseMoveEvent
                                    ? e._(At).lastMouseMoveEvent
                                    : d
                                );
                          }
                          St([r, s, s ? l : null], t),
                            s && getComputedStyle(s)[p("transform")],
                            o.interactive && n.classList.add("tippy-active"),
                            o.sticky && Bt.call(e),
                            Ot([r, s], "visible"),
                            Rt.call(e, t, function () {
                              o.updateDuration ||
                                r.classList.add("tippy-notransition"),
                                o.interactive && Pt(i),
                                n.setAttribute(
                                  "aria-describedby",
                                  "tippy-" + e.id
                                ),
                                o.onShown.call(i, e);
                            });
                        }
                      }))
                    : this.destroy());
              }
            },
          },
          {
            key: "hide",
            value: function (t) {
              var e = this;
              if (!this.state.destroyed && this.state.enabled) {
                var i = this.popper,
                  n = this.reference,
                  o = this.options,
                  a = h(i),
                  r = a.tooltip,
                  s = a.backdrop,
                  p = a.content;
                o.onHide.call(i, this),
                  (t = Tt(void 0 !== t ? t : o.duration, 1)),
                  o.updateDuration || r.classList.remove("tippy-notransition"),
                  o.interactive && n.classList.remove("tippy-active"),
                  (i.style.visibility = "hidden"),
                  (this.state.visible = !1),
                  St([r, s, s ? p : null], t),
                  Ot([r, s], "hidden"),
                  o.interactive && o.trigger.indexOf("click") > -1 && Pt(n),
                  Rt.call(this, t, function () {
                    !e.state.visible &&
                      o.appendTo.contains(i) &&
                      (e._(At).isPreparingToShow ||
                        (document.removeEventListener(
                          "mousemove",
                          e._(At).followCursorListener
                        ),
                        (e._(At).lastMouseMoveEvent = null)),
                      e.popperInstance &&
                        e.popperInstance.disableEventListeners(),
                      n.removeAttribute("aria-describedby"),
                      o.appendTo.removeChild(i),
                      o.onHidden.call(i, e));
                  });
              }
            },
          },
          {
            key: "destroy",
            value: function () {
              var t = this,
                e =
                  !(arguments.length > 0 && void 0 !== arguments[0]) ||
                  arguments[0];
              if (!this.state.destroyed) {
                this.state.visible && this.hide(0),
                  this.listeners.forEach(function (e) {
                    t.reference.removeEventListener(e.event, e.handler);
                  }),
                  this.title &&
                    this.reference.setAttribute("title", this.title),
                  delete this.reference._tippy;
                [
                  "data-original-title",
                  "data-tippy",
                  "data-tippy-delegate",
                ].forEach(function (e) {
                  t.reference.removeAttribute(e);
                }),
                  this.options.target &&
                    e &&
                    s(
                      this.reference.querySelectorAll(this.options.target)
                    ).forEach(function (t) {
                      return t._tippy && t._tippy.destroy();
                    }),
                  this.popperInstance && this.popperInstance.destroy(),
                  this._(At).mutationObservers.forEach(function (t) {
                    t.disconnect();
                  }),
                  (this.state.destroyed = !0);
              }
            },
          },
        ]),
        t
      );
    })();
  function Lt() {
    var t = this._(At).lastTriggerEvent;
    return (
      this.options.followCursor && !i.usingTouch && t && "focus" !== t.type
    );
  }
  function Nt(t) {
    var e = Ct(t.target, this.options.target);
    if (e && !e._tippy) {
      var i = e.getAttribute("title") || this.title;
      i &&
        (e.setAttribute("title", i),
        Gt(e, c({}, this.options, { target: null })),
        Dt.call(e._tippy, t));
    }
  }
  function Dt(t) {
    var e = this,
      i = this.options;
    if (($t.call(this), !this.state.visible))
      if (i.target) Nt.call(this, t);
      else if (((this._(At).isPreparingToShow = !0), i.wait))
        i.wait.call(this.popper, this.show.bind(this), t);
      else {
        if (Lt.call(this)) {
          this._(At).followCursorListener || Wt.call(this);
          var n = h(this.popper).arrow;
          n && (n.style.margin = "0"),
            document.addEventListener(
              "mousemove",
              this._(At).followCursorListener
            );
        }
        var o = Tt(i.delay, 0);
        o
          ? (this._(At).showTimeout = setTimeout(function () {
              e.show();
            }, o))
          : this.show();
      }
  }
  function Yt() {
    var t = this;
    if (($t.call(this), this.state.visible)) {
      this._(At).isPreparingToShow = !1;
      var e = Tt(this.options.delay, 1);
      e
        ? (this._(At).hideTimeout = setTimeout(function () {
            t.state.visible && t.hide();
          }, e))
        : this.hide();
    }
  }
  function Mt() {
    var t = this;
    return {
      onTrigger: function (e) {
        t.state.enabled &&
          ((i.supportsTouch &&
            i.usingTouch &&
            ["mouseenter", "mouseover", "focus"].indexOf(e.type) > -1 &&
            t.options.touchHold) ||
            ((t._(At).lastTriggerEvent = e),
            "click" === e.type &&
            "persistent" !== t.options.hideOnClick &&
            t.state.visible
              ? Yt.call(t)
              : Dt.call(t, e)));
      },
      onMouseLeave: function (e) {
        if (
          !(
            ["mouseleave", "mouseout"].indexOf(e.type) > -1 &&
            i.supportsTouch &&
            i.usingTouch &&
            t.options.touchHold
          )
        ) {
          if (t.options.interactive) {
            var o = Yt.bind(t);
            return (
              document.body.addEventListener("mouseleave", o),
              void document.addEventListener("mousemove", function e(i) {
                var a = Ct(i.target, n.REFERENCE),
                  r = Ct(i.target, n.POPPER) === t.popper,
                  s = a === t.reference;
                r ||
                  s ||
                  ((function (t, e, i) {
                    if (!e.getAttribute("x-placement")) return !0;
                    var n = t.clientX,
                      o = t.clientY,
                      a = i.interactiveBorder,
                      r = i.distance,
                      s = e.getBoundingClientRect(),
                      p = bt(e),
                      l = a + r,
                      d = {
                        top: s.top - o > a,
                        bottom: o - s.bottom > a,
                        left: s.left - n > a,
                        right: n - s.right > a,
                      };
                    switch (p) {
                      case "top":
                        d.top = s.top - o > l;
                        break;
                      case "bottom":
                        d.bottom = o - s.bottom > l;
                        break;
                      case "left":
                        d.left = s.left - n > l;
                        break;
                      case "right":
                        d.right = n - s.right > l;
                    }
                    return d.top || d.bottom || d.left || d.right;
                  })(i, t.popper, t.options) &&
                    (document.body.removeEventListener("mouseleave", o),
                    document.removeEventListener("mousemove", e),
                    Yt.call(t, e)));
              })
            );
          }
          Yt.call(t);
        }
      },
      onBlur: function (e) {
        if (e.target === t.reference && !i.usingTouch) {
          if (t.options.interactive) {
            if (!e.relatedTarget) return;
            if (Ct(e.relatedTarget, n.POPPER)) return;
          }
          Yt.call(t);
        }
      },
      onDelegateShow: function (e) {
        Ct(e.target, t.options.target) && Dt.call(t, e);
      },
      onDelegateHide: function (e) {
        Ct(e.target, t.options.target) && Yt.call(t);
      },
    };
  }
  function Xt() {
    var t = this,
      e = this.popper,
      i = this.reference,
      o = this.options,
      a = h(e).tooltip,
      r = o.popperOptions,
      s = "round" === o.arrowType ? n.ROUND_ARROW : n.ARROW,
      p = a.querySelector(s),
      l = c({ placement: o.placement }, r || {}, {
        modifiers: c({}, r ? r.modifiers : {}, {
          arrow: c({ element: s }, r && r.modifiers ? r.modifiers.arrow : {}),
          flip: c(
            {
              enabled: o.flip,
              padding: o.distance + 5,
              behavior: o.flipBehavior,
            },
            r && r.modifiers ? r.modifiers.flip : {}
          ),
          offset: c(
            { offset: o.offset },
            r && r.modifiers ? r.modifiers.offset : {}
          ),
        }),
        onCreate: function () {
          (a.style[bt(e)] = xt(o.distance)),
            p && o.arrowTransform && wt(e, p, o.arrowTransform);
        },
        onUpdate: function () {
          var t = a.style;
          (t.top = ""),
            (t.bottom = ""),
            (t.left = ""),
            (t.right = ""),
            (t[bt(e)] = xt(o.distance)),
            p && o.arrowTransform && wt(e, p, o.arrowTransform);
        },
      });
    return (
      Ft.call(this, {
        target: e,
        callback: function () {
          t.popperInstance.update();
        },
        options: { childList: !0, subtree: !0, characterData: !0 },
      }),
      new vt(i, e, l)
    );
  }
  function Ht(t) {
    var e = this.options;
    if (
      (this.popperInstance
        ? (this.popperInstance.scheduleUpdate(),
          e.livePlacement &&
            !Lt.call(this) &&
            this.popperInstance.enableEventListeners())
        : ((this.popperInstance = Xt.call(this)),
          e.livePlacement || this.popperInstance.disableEventListeners()),
      !Lt.call(this))
    ) {
      var i = h(this.popper).arrow;
      i && (i.style.margin = ""),
        (this.popperInstance.reference = this.reference);
    }
    !(function (t, e, i) {
      var n = t.popper,
        o = t.options,
        a = o.onCreate,
        r = o.onUpdate;
      (o.onCreate = o.onUpdate =
        function () {
          (function (t) {
            t.offsetHeight;
          })(n),
            e && e(),
            r(),
            (o.onCreate = a),
            (o.onUpdate = r);
        }),
        i || t.scheduleUpdate();
    })(this.popperInstance, t, !0),
      e.appendTo.contains(this.popper) || e.appendTo.appendChild(this.popper);
  }
  function $t() {
    var t = this._(At),
      e = t.showTimeout,
      i = t.hideTimeout;
    clearTimeout(e), clearTimeout(i);
  }
  function Wt() {
    var t = this;
    this._(At).followCursorListener = function (e) {
      var i = (t._(At).lastMouseMoveEvent = e),
        n = i.clientX,
        o = i.clientY;
      t.popperInstance &&
        ((t.popperInstance.reference = {
          getBoundingClientRect: function () {
            return {
              width: 0,
              height: 0,
              top: o,
              left: n,
              right: n,
              bottom: o,
            };
          },
          clientWidth: 0,
          clientHeight: 0,
        }),
        t.popperInstance.scheduleUpdate());
    };
  }
  function Bt() {
    var t = this;
    !(function e() {
      t.popperInstance && t.popperInstance.update(),
        (t.popper.style[p("transitionDuration")] =
          t.options.updateDuration + "ms"),
        t.state.visible
          ? requestAnimationFrame(e)
          : (t.popper.style[p("transitionDuration")] = "");
    })();
  }
  function Ft(t) {
    var e = t.target,
      i = t.callback,
      n = t.options;
    if (window.MutationObserver) {
      var o = new MutationObserver(i);
      o.observe(e, n), this._(At).mutationObservers.push(o);
    }
  }
  function Rt(t, e) {
    if (!t) return e();
    var i = h(this.popper).tooltip,
      n = function (t, e) {
        e &&
          i[t + "EventListener"](
            "transition" in document.body.style
              ? "transitionend"
              : "webkitTransitionEnd",
            e
          );
      },
      o = function t(o) {
        o.target === i && (n("remove", t), e());
      };
    n("remove", this._(At).transitionendListener),
      n("add", o),
      (this._(At).transitionendListener = o);
  }
  var jt = 1;
  function zt(t, n) {
    return t.reduce(function (t, o) {
      var r = jt,
        s = (function (t, e) {
          return (
            e.arrow && (e.animateFill = !1),
            e.appendTo &&
              "function" == typeof e.appendTo &&
              (e.appendTo = e.appendTo()),
            "function" == typeof e.html && (e.html = e.html(t)),
            e
          );
        })(
          o,
          n.performance
            ? n
            : (function (t, e) {
                var i = a.reduce(function (i, n) {
                  var o =
                    t.getAttribute("data-tippy-" + n.toLowerCase()) || e[n];
                  return (
                    "false" === o && (o = !1),
                    "true" === o && (o = !0),
                    isFinite(o) && !isNaN(parseFloat(o)) && (o = parseFloat(o)),
                    "target" !== n &&
                      "string" == typeof o &&
                      "[" === o.trim().charAt(0) &&
                      (o = JSON.parse(o)),
                    (i[n] = o),
                    i
                  );
                }, {});
                return c({}, e, i);
              })(o, n)
        ),
        d = o.getAttribute("title");
      if (!(d || s.target || s.html || s.dynamicTitle)) return t;
      o.setAttribute(s.target ? "data-tippy-delegate" : "data-tippy", ""), u(o);
      var f = (function (t, e, i) {
          var n = l();
          n.setAttribute("class", "tippy-popper"),
            n.setAttribute("role", "tooltip"),
            n.setAttribute("id", "tippy-" + t),
            (n.style.zIndex = i.zIndex),
            (n.style.maxWidth = i.maxWidth);
          var o = l();
          o.setAttribute("class", "tippy-tooltip"),
            o.setAttribute("data-size", i.size),
            o.setAttribute("data-animation", i.animation),
            o.setAttribute("data-state", "hidden"),
            i.theme.split(" ").forEach(function (t) {
              o.classList.add(t + "-theme");
            });
          var a = l();
          if ((a.setAttribute("class", "tippy-content"), i.arrow)) {
            var r = l();
            (r.style[p("transform")] = i.arrowTransform),
              "round" === i.arrowType
                ? (r.classList.add("tippy-roundarrow"),
                  (r.innerHTML =
                    '<svg viewBox="0 0 24 8" xmlns="http://www.w3.org/2000/svg"><path d="M3 8s2.021-.015 5.253-4.218C9.584 2.051 10.797 1.007 12 1c1.203-.007 2.416 1.035 3.761 2.782C19.012 8.005 21 8 21 8H3z"/></svg>'))
                : r.classList.add("tippy-arrow"),
              o.appendChild(r);
          }
          if (i.animateFill) {
            o.setAttribute("data-animatefill", "");
            var s = l();
            s.classList.add("tippy-backdrop"),
              s.setAttribute("data-state", "hidden"),
              o.appendChild(s);
          }
          i.inertia && o.setAttribute("data-inertia", ""),
            i.interactive && o.setAttribute("data-interactive", "");
          var d = i.html;
          if (d) {
            var c = void 0;
            d instanceof Element
              ? (a.appendChild(d), (c = "#" + (d.id || "tippy-html-template")))
              : ((a.innerHTML = document.querySelector(d).innerHTML), (c = d)),
              n.setAttribute("data-html", ""),
              o.setAttribute("data-template-id", c),
              i.interactive && n.setAttribute("tabindex", "-1");
          } else a[i.allowTitleHTML ? "innerHTML" : "textContent"] = e;
          return o.appendChild(a), n.appendChild(o), n;
        })(r, d, s),
        m = new It({
          id: r,
          reference: o,
          popper: f,
          options: s,
          title: d,
          popperInstance: null,
        });
      s.createPopperInstanceOnInit &&
        ((m.popperInstance = Xt.call(m)),
        m.popperInstance.disableEventListeners());
      var v = Mt.call(m);
      return (
        (m.listeners = s.trigger
          .trim()
          .split(" ")
          .reduce(function (t, n) {
            return t.concat(
              (function (t, n, o, a) {
                var r = o.onTrigger,
                  s = o.onMouseLeave,
                  p = o.onBlur,
                  l = o.onDelegateShow,
                  d = o.onDelegateHide,
                  c = [];
                if ("manual" === t) return c;
                var h = function (t, e) {
                  n.addEventListener(t, e), c.push({ event: t, handler: e });
                };
                return (
                  a.target
                    ? (i.supportsTouch &&
                        a.touchHold &&
                        (h("touchstart", l), h("touchend", d)),
                      "mouseenter" === t &&
                        (h("mouseover", l), h("mouseout", d)),
                      "focus" === t && (h("focusin", l), h("focusout", d)),
                      "click" === t && h("click", l))
                    : (h(t, r),
                      i.supportsTouch &&
                        a.touchHold &&
                        (h("touchstart", r), h("touchend", s)),
                      "mouseenter" === t && h("mouseleave", s),
                      "focus" === t && h(e ? "focusout" : "blur", p)),
                  c
                );
              })(n, o, v, s)
            );
          }, [])),
        s.dynamicTitle &&
          Ft.call(m, {
            target: o,
            callback: function () {
              var t = h(f).content,
                e = o.getAttribute("title");
              e &&
                ((t[s.allowTitleHTML ? "innerHTML" : "textContent"] = m.title =
                  e),
                u(o));
            },
            options: { attributes: !0 },
          }),
        (o._tippy = m),
        (f._tippy = m),
        (f._reference = o),
        t.push(m),
        jt++,
        t
      );
    }, []);
  }
  function Ut(t) {
    s(document.querySelectorAll(n.POPPER)).forEach(function (e) {
      var i = e._tippy;
      if (i) {
        var n = i.options;
        !(!0 === n.hideOnClick || n.trigger.indexOf("focus") > -1) ||
          (t && e === t.popper) ||
          i.hide();
      }
    });
  }
  var qt = !1,
    Vt = !1;
  function Gt(t, e, a) {
    var p;
    i.supported &&
      !qt &&
      (!(function (t) {
        var e,
          o = function () {
            i.usingTouch ||
              ((i.usingTouch = !0),
              i.iOS && document.body.classList.add("tippy-touch"),
              i.dynamicInputDetection &&
                window.performance &&
                document.addEventListener("mousemove", a),
              i.onUserInputChange("touch"));
          },
          a =
            ((e = void 0),
            function () {
              var t = performance.now();
              t - e < 20 &&
                ((i.usingTouch = !1),
                document.removeEventListener("mousemove", a),
                i.iOS || document.body.classList.remove("tippy-touch"),
                i.onUserInputChange("mouse")),
                (e = t);
            });
        document.addEventListener(
          "click",
          function (t) {
            if (!(t.target instanceof Element)) return Ut();
            var e = Ct(t.target, n.REFERENCE),
              o = Ct(t.target, n.POPPER);
            if (!(o && o._tippy && o._tippy.options.interactive)) {
              if (e && e._tippy) {
                var a = e._tippy.options,
                  r = a.trigger.indexOf("click") > -1,
                  s = a.multiple;
                if ((!s && i.usingTouch) || (!s && r)) return Ut(e._tippy);
                if (!0 !== a.hideOnClick || r) return;
              }
              Ut();
            }
          },
          t
        ),
          document.addEventListener("touchstart", o),
          window.addEventListener("blur", function () {
            var t = document.activeElement;
            t && t.blur && Et.call(t, n.REFERENCE) && t.blur();
          }),
          window.addEventListener("resize", function () {
            s(document.querySelectorAll(n.POPPER)).forEach(function (t) {
              var e = t._tippy;
              e &&
                !e.options.livePlacement &&
                e.popperInstance.scheduleUpdate();
            });
          }),
          i.supportsTouch ||
            (!navigator.maxTouchPoints && !navigator.msMaxTouchPoints) ||
            document.addEventListener("pointerdown", o);
      })(Vt),
      (qt = !0)),
      r(t) &&
        (((p = t).refObj = !0),
        (p.attributes = p.attributes || {}),
        (p.setAttribute = function (t, e) {
          p.attributes[t] = e;
        }),
        (p.getAttribute = function (t) {
          return p.attributes[t];
        }),
        (p.removeAttribute = function (t) {
          delete p.attributes[t];
        }),
        (p.hasAttribute = function (t) {
          return t in p.attributes;
        }),
        (p.addEventListener = function () {}),
        (p.removeEventListener = function () {}),
        (p.classList = {
          classNames: {},
          add: function (t) {
            return (p.classList.classNames[t] = !0);
          },
          remove: function (t) {
            return delete p.classList.classNames[t], !0;
          },
          contains: function (t) {
            return t in p.classList.classNames;
          },
        })),
      (e = c({}, o, e));
    var l = (function (t) {
        if (t instanceof Element || r(t)) return [t];
        if (t instanceof NodeList) return s(t);
        if (Array.isArray(t)) return t;
        try {
          return s(document.querySelectorAll(t));
        } catch (t) {
          return [];
        }
      })(t),
      d = l[0];
    return {
      selector: t,
      options: e,
      tooltips: i.supported ? zt(a && d ? [d] : l, e) : [],
      destroyAll: function () {
        this.tooltips.forEach(function (t) {
          return t.destroy();
        }),
          (this.tooltips = []);
      },
    };
  }
  return (
    (Gt.version = "2.6.0"),
    (Gt.browser = i),
    (Gt.defaults = o),
    (Gt.one = function (t, e) {
      return Gt(t, e, !0).tooltips[0];
    }),
    (Gt.disableAnimations = function () {
      (o.updateDuration = o.duration = 0), (o.animateFill = !1);
    }),
    (Gt.useCapture = function () {
      Vt = !0;
    }),
    (function () {
      var e =
        arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : "";
      if (t && i.supported) {
        var n = document.head || document.querySelector("head"),
          o = document.createElement("style");
        (o.type = "text/css"),
          n.insertBefore(o, n.firstChild),
          o.styleSheet
            ? (o.styleSheet.cssText = e)
            : o.appendChild(document.createTextNode(e));
      }
    })(
      '.tippy-touch{cursor:pointer!important}.tippy-notransition{transition:none!important}.tippy-popper{max-width:350px;-webkit-perspective:700px;perspective:700px;z-index:9999;outline:0;transition-timing-function:cubic-bezier(.165,.84,.44,1);pointer-events:none;line-height:1.4}.tippy-popper[data-html]{max-width:96%;max-width:calc(100% - 20px)}.tippy-popper[x-placement^=top] .tippy-backdrop{border-radius:40% 40% 0 0}.tippy-popper[x-placement^=top] .tippy-roundarrow{bottom:-8px;-webkit-transform-origin:50% 0;transform-origin:50% 0}.tippy-popper[x-placement^=top] .tippy-roundarrow svg{position:absolute;left:0;-webkit-transform:rotate(180deg);transform:rotate(180deg)}.tippy-popper[x-placement^=top] .tippy-arrow{border-top:7px solid #333;border-right:7px solid transparent;border-left:7px solid transparent;bottom:-7px;margin:0 6px;-webkit-transform-origin:50% 0;transform-origin:50% 0}.tippy-popper[x-placement^=top] .tippy-backdrop{-webkit-transform-origin:0 90%;transform-origin:0 90%}.tippy-popper[x-placement^=top] .tippy-backdrop[data-state=visible]{-webkit-transform:scale(6) translate(-50%,25%);transform:scale(6) translate(-50%,25%);opacity:1}.tippy-popper[x-placement^=top] .tippy-backdrop[data-state=hidden]{-webkit-transform:scale(1) translate(-50%,25%);transform:scale(1) translate(-50%,25%);opacity:0}.tippy-popper[x-placement^=top] [data-animation=shift-toward][data-state=visible]{opacity:1;-webkit-transform:translateY(-10px);transform:translateY(-10px)}.tippy-popper[x-placement^=top] [data-animation=shift-toward][data-state=hidden]{opacity:0;-webkit-transform:translateY(-20px);transform:translateY(-20px)}.tippy-popper[x-placement^=top] [data-animation=perspective]{-webkit-transform-origin:bottom;transform-origin:bottom}.tippy-popper[x-placement^=top] [data-animation=perspective][data-state=visible]{opacity:1;-webkit-transform:translateY(-10px) rotateX(0);transform:translateY(-10px) rotateX(0)}.tippy-popper[x-placement^=top] [data-animation=perspective][data-state=hidden]{opacity:0;-webkit-transform:translateY(0) rotateX(90deg);transform:translateY(0) rotateX(90deg)}.tippy-popper[x-placement^=top] [data-animation=fade][data-state=visible]{opacity:1;-webkit-transform:translateY(-10px);transform:translateY(-10px)}.tippy-popper[x-placement^=top] [data-animation=fade][data-state=hidden]{opacity:0;-webkit-transform:translateY(-10px);transform:translateY(-10px)}.tippy-popper[x-placement^=top] [data-animation=shift-away][data-state=visible]{opacity:1;-webkit-transform:translateY(-10px);transform:translateY(-10px)}.tippy-popper[x-placement^=top] [data-animation=shift-away][data-state=hidden]{opacity:0;-webkit-transform:translateY(0);transform:translateY(0)}.tippy-popper[x-placement^=top] [data-animation=scale][data-state=visible]{opacity:1;-webkit-transform:translateY(-10px) scale(1);transform:translateY(-10px) scale(1)}.tippy-popper[x-placement^=top] [data-animation=scale][data-state=hidden]{opacity:0;-webkit-transform:translateY(0) scale(0);transform:translateY(0) scale(0)}.tippy-popper[x-placement^=bottom] .tippy-backdrop{border-radius:0 0 30% 30%}.tippy-popper[x-placement^=bottom] .tippy-roundarrow{top:-8px;-webkit-transform-origin:50% 100%;transform-origin:50% 100%}.tippy-popper[x-placement^=bottom] .tippy-roundarrow svg{position:absolute;left:0;-webkit-transform:rotate(0);transform:rotate(0)}.tippy-popper[x-placement^=bottom] .tippy-arrow{border-bottom:7px solid #333;border-right:7px solid transparent;border-left:7px solid transparent;top:-7px;margin:0 6px;-webkit-transform-origin:50% 100%;transform-origin:50% 100%}.tippy-popper[x-placement^=bottom] .tippy-backdrop{-webkit-transform-origin:0 -90%;transform-origin:0 -90%}.tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=visible]{-webkit-transform:scale(6) translate(-50%,-125%);transform:scale(6) translate(-50%,-125%);opacity:1}.tippy-popper[x-placement^=bottom] .tippy-backdrop[data-state=hidden]{-webkit-transform:scale(1) translate(-50%,-125%);transform:scale(1) translate(-50%,-125%);opacity:0}.tippy-popper[x-placement^=bottom] [data-animation=shift-toward][data-state=visible]{opacity:1;-webkit-transform:translateY(10px);transform:translateY(10px)}.tippy-popper[x-placement^=bottom] [data-animation=shift-toward][data-state=hidden]{opacity:0;-webkit-transform:translateY(20px);transform:translateY(20px)}.tippy-popper[x-placement^=bottom] [data-animation=perspective]{-webkit-transform-origin:top;transform-origin:top}.tippy-popper[x-placement^=bottom] [data-animation=perspective][data-state=visible]{opacity:1;-webkit-transform:translateY(10px) rotateX(0);transform:translateY(10px) rotateX(0)}.tippy-popper[x-placement^=bottom] [data-animation=perspective][data-state=hidden]{opacity:0;-webkit-transform:translateY(0) rotateX(-90deg);transform:translateY(0) rotateX(-90deg)}.tippy-popper[x-placement^=bottom] [data-animation=fade][data-state=visible]{opacity:1;-webkit-transform:translateY(10px);transform:translateY(10px)}.tippy-popper[x-placement^=bottom] [data-animation=fade][data-state=hidden]{opacity:0;-webkit-transform:translateY(10px);transform:translateY(10px)}.tippy-popper[x-placement^=bottom] [data-animation=shift-away][data-state=visible]{opacity:1;-webkit-transform:translateY(10px);transform:translateY(10px)}.tippy-popper[x-placement^=bottom] [data-animation=shift-away][data-state=hidden]{opacity:0;-webkit-transform:translateY(0);transform:translateY(0)}.tippy-popper[x-placement^=bottom] [data-animation=scale][data-state=visible]{opacity:1;-webkit-transform:translateY(10px) scale(1);transform:translateY(10px) scale(1)}.tippy-popper[x-placement^=bottom] [data-animation=scale][data-state=hidden]{opacity:0;-webkit-transform:translateY(0) scale(0);transform:translateY(0) scale(0)}.tippy-popper[x-placement^=left] .tippy-backdrop{border-radius:50% 0 0 50%}.tippy-popper[x-placement^=left] .tippy-roundarrow{right:-16px;-webkit-transform-origin:33.33333333% 50%;transform-origin:33.33333333% 50%}.tippy-popper[x-placement^=left] .tippy-roundarrow svg{position:absolute;left:0;-webkit-transform:rotate(90deg);transform:rotate(90deg)}.tippy-popper[x-placement^=left] .tippy-arrow{border-left:7px solid #333;border-top:7px solid transparent;border-bottom:7px solid transparent;right:-7px;margin:3px 0;-webkit-transform-origin:0 50%;transform-origin:0 50%}.tippy-popper[x-placement^=left] .tippy-backdrop{-webkit-transform-origin:100% 0;transform-origin:100% 0}.tippy-popper[x-placement^=left] .tippy-backdrop[data-state=visible]{-webkit-transform:scale(6) translate(40%,-50%);transform:scale(6) translate(40%,-50%);opacity:1}.tippy-popper[x-placement^=left] .tippy-backdrop[data-state=hidden]{-webkit-transform:scale(1.5) translate(40%,-50%);transform:scale(1.5) translate(40%,-50%);opacity:0}.tippy-popper[x-placement^=left] [data-animation=shift-toward][data-state=visible]{opacity:1;-webkit-transform:translateX(-10px);transform:translateX(-10px)}.tippy-popper[x-placement^=left] [data-animation=shift-toward][data-state=hidden]{opacity:0;-webkit-transform:translateX(-20px);transform:translateX(-20px)}.tippy-popper[x-placement^=left] [data-animation=perspective]{-webkit-transform-origin:right;transform-origin:right}.tippy-popper[x-placement^=left] [data-animation=perspective][data-state=visible]{opacity:1;-webkit-transform:translateX(-10px) rotateY(0);transform:translateX(-10px) rotateY(0)}.tippy-popper[x-placement^=left] [data-animation=perspective][data-state=hidden]{opacity:0;-webkit-transform:translateX(0) rotateY(-90deg);transform:translateX(0) rotateY(-90deg)}.tippy-popper[x-placement^=left] [data-animation=fade][data-state=visible]{opacity:1;-webkit-transform:translateX(-10px);transform:translateX(-10px)}.tippy-popper[x-placement^=left] [data-animation=fade][data-state=hidden]{opacity:0;-webkit-transform:translateX(-10px);transform:translateX(-10px)}.tippy-popper[x-placement^=left] [data-animation=shift-away][data-state=visible]{opacity:1;-webkit-transform:translateX(-10px);transform:translateX(-10px)}.tippy-popper[x-placement^=left] [data-animation=shift-away][data-state=hidden]{opacity:0;-webkit-transform:translateX(0);transform:translateX(0)}.tippy-popper[x-placement^=left] [data-animation=scale][data-state=visible]{opacity:1;-webkit-transform:translateX(-10px) scale(1);transform:translateX(-10px) scale(1)}.tippy-popper[x-placement^=left] [data-animation=scale][data-state=hidden]{opacity:0;-webkit-transform:translateX(0) scale(0);transform:translateX(0) scale(0)}.tippy-popper[x-placement^=right] .tippy-backdrop{border-radius:0 50% 50% 0}.tippy-popper[x-placement^=right] .tippy-roundarrow{left:-16px;-webkit-transform-origin:66.66666666% 50%;transform-origin:66.66666666% 50%}.tippy-popper[x-placement^=right] .tippy-roundarrow svg{position:absolute;left:0;-webkit-transform:rotate(-90deg);transform:rotate(-90deg)}.tippy-popper[x-placement^=right] .tippy-arrow{border-right:7px solid #333;border-top:7px solid transparent;border-bottom:7px solid transparent;left:-7px;margin:3px 0;-webkit-transform-origin:100% 50%;transform-origin:100% 50%}.tippy-popper[x-placement^=right] .tippy-backdrop{-webkit-transform-origin:-100% 0;transform-origin:-100% 0}.tippy-popper[x-placement^=right] .tippy-backdrop[data-state=visible]{-webkit-transform:scale(6) translate(-140%,-50%);transform:scale(6) translate(-140%,-50%);opacity:1}.tippy-popper[x-placement^=right] .tippy-backdrop[data-state=hidden]{-webkit-transform:scale(1.5) translate(-140%,-50%);transform:scale(1.5) translate(-140%,-50%);opacity:0}.tippy-popper[x-placement^=right] [data-animation=shift-toward][data-state=visible]{opacity:1;-webkit-transform:translateX(10px);transform:translateX(10px)}.tippy-popper[x-placement^=right] [data-animation=shift-toward][data-state=hidden]{opacity:0;-webkit-transform:translateX(20px);transform:translateX(20px)}.tippy-popper[x-placement^=right] [data-animation=perspective]{-webkit-transform-origin:left;transform-origin:left}.tippy-popper[x-placement^=right] [data-animation=perspective][data-state=visible]{opacity:1;-webkit-transform:translateX(10px) rotateY(0);transform:translateX(10px) rotateY(0)}.tippy-popper[x-placement^=right] [data-animation=perspective][data-state=hidden]{opacity:0;-webkit-transform:translateX(0) rotateY(90deg);transform:translateX(0) rotateY(90deg)}.tippy-popper[x-placement^=right] [data-animation=fade][data-state=visible]{opacity:1;-webkit-transform:translateX(10px);transform:translateX(10px)}.tippy-popper[x-placement^=right] [data-animation=fade][data-state=hidden]{opacity:0;-webkit-transform:translateX(10px);transform:translateX(10px)}.tippy-popper[x-placement^=right] [data-animation=shift-away][data-state=visible]{opacity:1;-webkit-transform:translateX(10px);transform:translateX(10px)}.tippy-popper[x-placement^=right] [data-animation=shift-away][data-state=hidden]{opacity:0;-webkit-transform:translateX(0);transform:translateX(0)}.tippy-popper[x-placement^=right] [data-animation=scale][data-state=visible]{opacity:1;-webkit-transform:translateX(10px) scale(1);transform:translateX(10px) scale(1)}.tippy-popper[x-placement^=right] [data-animation=scale][data-state=hidden]{opacity:0;-webkit-transform:translateX(0) scale(0);transform:translateX(0) scale(0)}.tippy-tooltip{position:relative;color:#fff;border-radius:4px;font-size:.9rem;padding:.3rem .6rem;text-align:center;will-change:transform;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;background-color:#333}.tippy-tooltip[data-size=small]{padding:.2rem .4rem;font-size:.75rem}.tippy-tooltip[data-size=large]{padding:.4rem .8rem;font-size:1rem}.tippy-tooltip[data-animatefill]{overflow:hidden;background-color:transparent}.tippy-tooltip[data-animatefill] .tippy-content{transition:-webkit-clip-path cubic-bezier(.46,.1,.52,.98);transition:clip-path cubic-bezier(.46,.1,.52,.98);transition:clip-path cubic-bezier(.46,.1,.52,.98),-webkit-clip-path cubic-bezier(.46,.1,.52,.98)}.tippy-tooltip[data-interactive],.tippy-tooltip[data-interactive] path{pointer-events:auto}.tippy-tooltip[data-inertia][data-state=visible]{transition-timing-function:cubic-bezier(.53,2,.36,.85)}.tippy-tooltip[data-inertia][data-state=hidden]{transition-timing-function:ease}.tippy-arrow,.tippy-roundarrow{position:absolute;width:0;height:0}.tippy-roundarrow{width:24px;height:8px;fill:#333;pointer-events:none}.tippy-backdrop{position:absolute;will-change:transform;background-color:#333;border-radius:50%;width:26%;left:50%;top:50%;z-index:-1;transition:all cubic-bezier(.46,.1,.52,.98);-webkit-backface-visibility:hidden;backface-visibility:hidden}.tippy-backdrop:after{content:"";float:left;padding-top:100%}body:not(.tippy-touch) .tippy-tooltip[data-animatefill][data-state=visible] .tippy-content{-webkit-clip-path:ellipse(100% 100% at 50% 50%);clip-path:ellipse(100% 100% at 50% 50%)}body:not(.tippy-touch) .tippy-tooltip[data-animatefill][data-state=hidden] .tippy-content{-webkit-clip-path:ellipse(5% 50% at 50% 50%);clip-path:ellipse(5% 50% at 50% 50%)}body:not(.tippy-touch) .tippy-popper[x-placement=right] .tippy-tooltip[data-animatefill][data-state=visible] .tippy-content{-webkit-clip-path:ellipse(135% 100% at 0 50%);clip-path:ellipse(135% 100% at 0 50%)}body:not(.tippy-touch) .tippy-popper[x-placement=right] .tippy-tooltip[data-animatefill][data-state=hidden] .tippy-content{-webkit-clip-path:ellipse(40% 100% at 0 50%);clip-path:ellipse(40% 100% at 0 50%)}body:not(.tippy-touch) .tippy-popper[x-placement=left] .tippy-tooltip[data-animatefill][data-state=visible] .tippy-content{-webkit-clip-path:ellipse(135% 100% at 100% 50%);clip-path:ellipse(135% 100% at 100% 50%)}body:not(.tippy-touch) .tippy-popper[x-placement=left] .tippy-tooltip[data-animatefill][data-state=hidden] .tippy-content{-webkit-clip-path:ellipse(40% 100% at 100% 50%);clip-path:ellipse(40% 100% at 100% 50%)}@media (max-width:360px){.tippy-popper{max-width:96%;max-width:calc(100% - 20px)}}'
    ),
    Gt
  );
}),
  (function (t, e) {
    if (t.cleanData) {
      var i = t.cleanData;
      t.cleanData = function (e) {
        for (var n, o = 0; null != (n = e[o]); o++)
          try {
            t(n).triggerHandler("remove");
          } catch (t) {}
        i(e);
      };
    } else {
      var n = t.fn.remove;
      t.fn.remove = function (e, i) {
        return this.each(function () {
          return (
            i ||
              (e && !t.filter(e, [this]).length) ||
              t("*", this)
                .add([this])
                .each(function () {
                  try {
                    t(this).triggerHandler("remove");
                  } catch (t) {}
                }),
            n.call(t(this), e, i)
          );
        });
      };
    }
    (t.widget = function (e, i, n) {
      var o,
        a = e.split(".")[0];
      (o = a + "-" + (e = e.split(".")[1])),
        n || ((n = i), (i = t.Widget)),
        (t.expr[":"][o] = function (i) {
          return !!t.data(i, e);
        }),
        (t[a] = t[a] || {}),
        (t[a][e] = function (t, e) {
          arguments.length && this._createWidget(t, e);
        });
      var r = new i();
      (r.options = t.extend(!0, {}, r.options)),
        (t[a][e].prototype = t.extend(
          !0,
          r,
          {
            namespace: a,
            widgetName: e,
            widgetEventPrefix: t[a][e].prototype.widgetEventPrefix || e,
            widgetBaseClass: o,
          },
          n
        )),
        t.widget.bridge(e, t[a][e]);
    }),
      (t.widget.bridge = function (i, n) {
        t.fn[i] = function (o) {
          var a = "string" == typeof o,
            r = Array.prototype.slice.call(arguments, 1),
            s = this;
          return (
            (o = !a && r.length ? t.extend.apply(null, [!0, o].concat(r)) : o),
            (a && "_" === o.charAt(0)) ||
              (a
                ? this.each(function () {
                    var n = t.data(this, i),
                      a = n && t.isFunction(n[o]) ? n[o].apply(n, r) : n;
                    if (a !== n && a !== e) return (s = a), !1;
                  })
                : this.each(function () {
                    var e = t.data(this, i);
                    e
                      ? e.option(o || {})._init()
                      : t.data(this, i, new n(o, this));
                  })),
            s
          );
        };
      }),
      (t.Widget = function (t, e) {
        arguments.length && this._createWidget(t, e);
      }),
      (t.Widget.prototype = {
        widgetName: "widget",
        widgetEventPrefix: "",
        options: { disabled: !1 },
        _createWidget: function (e, i) {
          t.data(i, this.widgetName, this),
            (this.element = t(i)),
            (this.options = t.extend(
              !0,
              {},
              this.options,
              this._getCreateOptions(),
              e
            ));
          var n = this;
          this.element.bind("remove." + this.widgetName, function () {
            n.destroy();
          }),
            this._create(),
            this._trigger("create"),
            this._init();
        },
        _getCreateOptions: function () {
          return t.metadata && t.metadata.get(this.element[0])[this.widgetName];
        },
        _create: function () {},
        _init: function () {},
        destroy: function () {
          this.element
            .unbind("." + this.widgetName)
            .removeData(this.widgetName),
            this.widget()
              .unbind("." + this.widgetName)
              .removeAttr("aria-disabled")
              .removeClass(
                this.widgetBaseClass + "-disabled ui-state-disabled"
              );
        },
        widget: function () {
          return this.element;
        },
        option: function (i, n) {
          var o = i;
          if (0 === arguments.length) return t.extend({}, this.options);
          if ("string" == typeof i) {
            if (n === e) return this.options[i];
            (o = {})[i] = n;
          }
          return this._setOptions(o), this;
        },
        _setOptions: function (e) {
          var i = this;
          return (
            t.each(e, function (t, e) {
              i._setOption(t, e);
            }),
            this
          );
        },
        _setOption: function (t, e) {
          return (
            (this.options[t] = e),
            "disabled" === t &&
              this.widget()
                [e ? "addClass" : "removeClass"](
                  this.widgetBaseClass + "-disabled ui-state-disabled"
                )
                .attr("aria-disabled", e),
            this
          );
        },
        enable: function () {
          return this._setOption("disabled", !1);
        },
        disable: function () {
          return this._setOption("disabled", !0);
        },
        _trigger: function (e, i, n) {
          var o,
            a,
            r = this.options[e];
          if (
            ((n = n || {}),
            ((i = t.Event(i)).type = (
              e === this.widgetEventPrefix ? e : this.widgetEventPrefix + e
            ).toLowerCase()),
            (i.target = this.element[0]),
            (a = i.originalEvent))
          )
            for (o in a) o in i || (i[o] = a[o]);
          return (
            this.element.trigger(i, n),
            !(
              (t.isFunction(r) && !1 === r.call(this.element[0], i, n)) ||
              i.isDefaultPrevented()
            )
          );
        },
      });
  })(jQuery),
  (function (t) {
    t.extend(t.support, {
      orientation: "orientation" in window,
      touch: "ontouchend" in document,
    }),
      t.each(
        "touchstart touchmove touchend orientationchange tap taphold swipe swipeleft swiperight scrollstart scrollstop".split(
          " "
        ),
        function (e, i) {
          t.fn[i] = function (t) {
            return t ? this.bind(i, t) : this.trigger(i);
          };
        }
      );
    var e = t.support.touch,
      i = e ? "touchstart" : "mousedown",
      n = e ? "touchend" : "mouseup",
      o = e ? "touchmove" : "mousemove";
    (t.event.special.scrollstart = {
      enabled: !0,
      setup: function () {
        var e,
          i,
          n = this;
        function o(i, o) {
          e = o;
          var a = i.type;
          (i.type = e ? "scrollstart" : "scrollstop"),
            t.event.dispatch.call(n, i),
            (i.type = a);
        }
        t(n).bind("touchmove scroll", function (n) {
          t.event.special.scrollstart.enabled &&
            (e || o(n, !0),
            clearTimeout(i),
            (i = setTimeout(function () {
              o(n, !1);
            }, 50)));
        });
      },
    }),
      (t.event.special.tap = {
        setup: function () {
          var e = this,
            a = t(e);
          a.bind(i, function (i) {
            if (!i.which || 1 === i.which) {
              var r,
                s,
                p = !1,
                l = !0,
                d = [i.pageX, i.pageY];
              (s = setTimeout(function () {
                l &&
                  !p &&
                  ((r = i.type),
                  (i.type = "taphold"),
                  t.event.dispatch.call(e, i),
                  (i.type = r));
              }, 750)),
                a.one(o, c).one(n, function (i) {
                  a.unbind(o, c),
                    clearTimeout(s),
                    (l = !1),
                    p ||
                      ((r = i.type),
                      (i.type = "tap"),
                      t.event.dispatch.call(e, i),
                      (i.type = r));
                });
            }
            function c() {
              (Math.abs(d[0] - i.pageX) > 10 ||
                Math.abs(d[1] - i.pageY) > 10) &&
                (p = !0);
            }
          });
        },
      }),
      (t.event.special.swipe = {
        setup: function () {
          var e = t(this);
          e.bind(i, function (i) {
            var a,
              r = i.originalEvent.touches ? i.originalEvent.touches[0] : i,
              s = {
                time: new Date().getTime(),
                coords: [r.pageX, r.pageY],
                origin: t(i.target),
              };
            function p(t) {
              if (s) {
                var e = t.originalEvent.touches
                  ? t.originalEvent.touches[0]
                  : t;
                (a = {
                  time: new Date().getTime(),
                  coords: [e.pageX, e.pageY],
                }),
                  Math.abs(s.coords[0] - a.coords[0]) > 10 &&
                    t.preventDefault();
              }
            }
            t(this)
              .bind(o, p)
              .one(n, function (t) {
                e.unbind(o, p),
                  s &&
                    a &&
                    a.time - s.time < 1e3 &&
                    Math.abs(s.coords[0] - a.coords[0]) > 30 &&
                    Math.abs(s.coords[1] - a.coords[1]) < 75 &&
                    s.origin
                      .trigger("swipe")
                      .trigger(
                        s.coords[0] > a.coords[0] ? "swipeleft" : "swiperight"
                      ),
                  (s = a = undefined);
              });
          });
        },
      }),
      (function (t) {
        var e,
          i,
          n,
          o = t(window);
        function a() {
          var t = i();
          t !== n && ((n = t), o.trigger("orientationchange"));
        }
        (t.event.special.orientationchange = e =
          {
            setup: function () {
              if (t.support.orientation) return !1;
              (n = i()), o.bind("resize", a);
            },
            teardown: function () {
              if (t.support.orientation) return !1;
              o.unbind("resize", a);
            },
            add: function (t) {
              var e = t.handler;
              t.handler = function (t) {
                return (t.orientation = i()), e.apply(this, arguments);
              };
            },
          }),
          (e.orientation = i =
            function () {
              var t = document.documentElement;
              return t && t.clientWidth / t.clientHeight < 1.1
                ? "portrait"
                : "landscape";
            });
      })(jQuery),
      t.each(
        {
          scrollstop: "scrollstart",
          taphold: "tap",
          swipeleft: "swipe",
          swiperight: "swipe",
        },
        function (e, i) {
          t.event.special[e] = {
            setup: function () {
              t(this).bind(i, t.noop);
            },
          };
        }
      );
  })(jQuery),
  (function (t) {
    (t.cleverlabels = function (e, i, n) {
      var o = this;
      (o.$el = t(e)),
        (o.el = e),
        (o.labeltext = i),
        o.$el.data("cleverlabels", o),
        (o.init = function () {
          if (
            ((o.override = i),
            (o.options = t.extend({}, t.cleverlabels.defaultOptions, n)),
            void 0 === o.labeltext && (o.labeltext = o.$el.attr("placeholder")),
            (void 0 === o.labeltext || o.labeltext.length < 1) &&
              (o.labeltext = t("#" + o.$el.attr("id") + "_note").text()),
            (void 0 === o.labeltext || o.labeltext.length < 1) &&
              ((o.labeltext = t("label[for=" + o.$el.attr("id") + "]").text()),
              !0 !== o.options.allowAsterisk &&
                (o.labeltext = o.labeltext.replace(/\*/, ""))),
            void 0 !== o.labeltext &&
              (o.labeltext = t("<span>")
                .html(o.labeltext + "&nbsp;")
                .text()),
            t.cleverlabels.html5Support())
          )
            o.$el.attr("placeholder") != o.labeltext &&
              o.$el.attr("placeholder", o.labeltext);
          else {
            if ("password" == o.$el.attr("type")) {
              var e = t(
                  '<input type="text" value="' +
                    o.labeltext +
                    '" class="' +
                    o.options.inputClass +
                    ' cleverlabel"/>'
                ),
                a = 0 === o.$el.outerHeight() ? "auto" : o.$el.outerHeight();
              e.css({ width: o.$el.outerWidth(), height: a }),
                e.focus(function (t) {
                  o.$el.focus();
                }),
                o.$el.wrap('<div class="cleverpassword"></div>'),
                o.$el.before(e),
                (o.clearval = function () {
                  o.$el.css({ opacity: 1 }), e.css({ opacity: 0 });
                }),
                (o.fillval = function () {
                  "" === o.$el.val() &&
                    (o.$el.css({ opacity: 0 }), e.css({ opacity: 1 }));
                });
            }
            o.fillval(),
              o.$el.bind("focus", o.clearval),
              o.$el.bind("blur change", o.fillval),
              o.$el.closest("form").submit(o.clearval);
          }
        }),
        (o.clearval = function () {
          o.$el.val() == o.labeltext &&
            (o.$el.val(""), o.$el.removeClass("cleverlabel"));
        }),
        (o.fillval = function () {
          o.$el.removeClass("cleverlabel"),
            ("" !== o.$el.val() && o.$el.val() !== o.labeltext) ||
              (o.$el.val(o.labeltext), o.$el.addClass("cleverlabel"));
        }),
        o.init();
    }),
      (t.cleverlabels.defaultOptions = {
        allowAsterisk: !1,
        inputClass: "input",
      }),
      (t.cleverlabels.html5Support = function () {
        return (
          void 0 === t.support.placeholder &&
            (t.support.placeholder =
              "placeholder" in document.createElement("input")),
          t.support.placeholder
        );
      }),
      (t.fn.cleverlabels = function (e, i) {
        return this.each(function () {
          new t.cleverlabels(this, e, i);
        });
      }),
      (t.fn.fillcleverlabels = function () {
        return t.cleverlabels.html5Support()
          ? this
          : this.each(function () {
              t(this).data("cleverlabels") &&
                t(this).data("cleverlabels").fillval();
            });
      }),
      (t.fn.clearcleverlabels = function () {
        return t.cleverlabels.html5Support()
          ? this
          : this.each(function () {
              t(this).data("cleverlabels") &&
                t(this).data("cleverlabels").clearval();
            });
      });
  })(jQuery),
  (function (t) {
    var e = {
      options: {
        item: ".grid > *",
        page: !1,
        wrapper: ".grid",
        next: ".slider__next",
        prev: ".slider__prev",
        count: ".slider__count",
        index: ".slider__index",
        nav: ".slider__nav",
        navItem: ".slider__nav__item",
        navActiveClass: "slider__nav__item--active",
        autoplay: !1,
        autostop: !1,
        autodelay: 5e3,
        equalHeights: !1,
        debug: !1,
        removeClasses: !1,
        disableSelect: !0,
        onInitCallback: t.noop,
        onSelectCallback: t.noop,
      },
      _init: function () {
        var e = this;
        if (
          (this._debug("Slider :: INIT"),
          (this.slides = t(this.options.item, this.element)),
          this._debug(this.slides),
          this.options.page &&
            ((this.itemsPerPage = 0),
            (this.wrapper = t(this.options.wrapper, this.element)),
            this._setupPages()),
          this.slides.length > 1)
        ) {
          this.element.addClass("slider--enabled"),
            this.slides.addClass("slider__slide"),
            this._debug("Slider :: INIT", this.slides);
          var i = ["dragstart"];
          this.options.disableSelect && i.push("selectstart"),
            t(this.element).bind(i.join(" "), function (t) {
              t.preventDefault();
            });
          var n = this.slides.filter(".slider__slide--active");
          n.length
            ? (this.active = n.eq(0))
            : (this.active = this.slides
                .eq(0)
                .addClass("slider__slide--active")),
            (this.index = this.slides.index(this.active)),
            (this.playing = !1),
            this.options.next &&
              t(this.options.next, this.element).bind(
                "click",
                t.proxy(this, "next")
              ),
            this.options.prev &&
              t(this.options.prev, this.element).bind(
                "click",
                t.proxy(this, "prev")
              ),
            this.options.nav &&
              (this._initNav(),
              this.options.count &&
                t(this.options.count, this.element).text(this.slides.length),
              this._updateNav()),
            this.options.equalHeights && this._updateHeights(),
            this._bindSwipes(),
            this.options.autoplay &&
              (this.play(),
              this.element.mouseleave(t.proxy(this, "play")),
              this.options.autostop &&
                this.element.mouseenter(t.proxy(this, "stop"))),
            t(window).on("blur", function (i) {
              e.playing && t(window).on("blur", t.proxy(this, "play")),
                t.proxy(this, "stop");
            }),
            e.options.onInitCallback();
        }
      },
      destroy: function () {
        this._debug("Slider :: DESTROY"),
          this.options.removeClasses &&
            (this.element.removeClass("slider--enabled"),
            this.slides.removeClass(function (t, e) {
              return (e.match(/\bslider\S+/g) || []).join(" ");
            })),
          this._unbindSwipes(),
          t(this.options.next, this.element).unbind(
            "click",
            t.proxy(this, "next")
          ),
          t(this.options.prev, this.element).unbind(
            "click",
            t.proxy(this, "prev")
          );
      },
      select: function (t, e) {
        if (
          (this._debug("Slider :: SELECT", t),
          !(this.slides.length <= t || this.index === t))
        ) {
          e || (e = t - this.index);
          var i,
            n,
            o = this,
            a = this.slides.eq(t);
          this._trigger("beforeSlide", null, { index: t, slide: a }),
            e >= 0
              ? ((i = "slider__slide--exit-left"),
                (n = "slider__slide--enter-right"))
              : ((i = "slider__slide--exit-right"),
                (n = "slider__slide--enter-left")),
            o.slides.removeClass(
              "slider__slide--enter-left slider__slide--enter-right slider__slide--exit-left slider__slide--exit-right"
            ),
            a.addClass(n),
            o.active.addClass(i),
            window.setTimeout(function () {
              o.active.removeClass("slider__slide--active"),
                a.addClass("slider__slide--active"),
                (o.active = a),
                (o.index = t),
                o.options.nav && o._updateNav(),
                o._trigger("afterSlide", null, { index: t, slide: a }),
                o.options.onSelectCallback();
            }, 50);
        }
      },
      next: function (t) {
        t.preventDefault(), this.stop(), this._next();
      },
      prev: function (t) {
        t.preventDefault(), this.stop(), this._prev();
      },
      _next: function () {
        this.select((this.index + 1) % this.slides.length, 1);
      },
      _prev: function () {
        this.select(
          (this.index + this.slides.length - 1) % this.slides.length,
          -1
        );
      },
      play: function () {
        this._debug("Slider :: PLAY"),
          this.playing ||
            (this.playing = setInterval(
              t.proxy(this, "_next"),
              this.options.autodelay
            ));
      },
      stop: function () {
        this._debug("Slider :: STOP"),
          this.playing && (clearInterval(this.playing), (this.playing = !1));
      },
      _setupPages: function () {
        this._debug("Slider :: SETUP PAGES");
        var e = Math.round(
          this.wrapper.innerWidth() / this.slides.outerWidth()
        );
        if (e !== this.itemsPerPage && this.itemsPerPage < this.slides.length) {
          var i = t(this.options.page, this.element).first();
          this.itemsPerPage = e;
          var n = this.slides.toArray();
          for (this.wrapper.empty(); n.length > 0; )
            this.wrapper.append(
              i.clone().append(n.splice(0, e)).addClass("slider__slide")
            );
          this.slides = this.wrapper.children();
        }
      },
      _bindSwipes: function () {
        this._debug("Slider :: BIND SWIPES"),
          this.slides.bind("swipeleft", t.proxy(this, "next")),
          this.slides.bind("swiperight", t.proxy(this, "prev"));
      },
      _unbindSwipes: function () {
        this._debug("Slider :: UNBIND SWIPES"),
          this.slides.unbind("swipeleft", t.proxy(this, "next")),
          this.slides.unbind("swiperight", t.proxy(this, "prev"));
      },
      _initNav: function () {
        this._debug("Slider :: INIT NAV");
        var e = this;
        this.options.nav &&
          ((this.nav = t(this.options.nav, this.element)),
          (this.navItems = t(e.options.navItem, this.nav)),
          this.nav.on("click", e.options.navItem, function (i) {
            i.preventDefault();
            var n = t(this).index();
            n !== e.index && (e.stop(), e.select(n));
          }));
      },
      _updateNav: function () {
        this.options.index &&
          t(this.options.index, this.element).text(this.index + 1),
          this.options.nav &&
            (this.navItems.removeClass(this.options.navActiveClass),
            this.navItems.eq(this.index).addClass(this.options.navActiveClass));
      },
      _updateHeights: function () {
        this._debug("Slider :: UPDATE HEIGHTS", this.element.height()),
          this.slides.css("height", "auto"),
          this.slides.css("height", this.element.innerHeight());
      },
      _debug: function () {
        !0 === this.options.debug &&
          window.console &&
          window.console.log &&
          window.console.log.apply(window.console, arguments);
      },
    };
    t.widget("d3r.slider", e);
  })(jQuery),
  (function (t) {
    var e = {
      options: {
        track: ".scrollable__track",
        slide: ".scrollable__slide",
        next: ".scrollable__next",
        prev: ".scrollable__prev",
        count: ".scrollable__count",
        index: ".scrollable__index",
        nav: ".scrollable__nav",
        navItem: ".scrollable__nav__item",
        navActiveClass: "scrollable__nav__item--active",
        disabledClass: "scrollable--disabled",
        activeClass: "scrollable__slide--active",
        hiddenClass: "scrollable__slide--hidden",
        paginate: !1,
        autorefresh: !0,
        autoplay: !1,
        autostop: !1,
        autodelay: 5e3,
        debug: !1,
        beforeSlide: !1,
        afterSlide: !1,
      },
      _init: function () {
        this._debug("Scrollable :: INIT");
        var e = this;
        (this.slides = t(this.options.slide, this.element)),
          (this.track = t(this.options.track, this.element)),
          this._debug(this.slides),
          this.options.page &&
            ((this.itemsPerPage = 0),
            (this.wrapper = t(this.options.wrapper, this.element)),
            this._setupPages()),
          this.slides.length > 1 &&
            (this._debug("Scrollable :: INIT", this.slides),
            t(this.element).bind("dragstart selectstart", function (t) {
              t.preventDefault();
            }),
            (this.active = this.slides.eq(0)),
            (this.index = this.slides.index(this.active)),
            this.options.paginate &&
              (this.perPage = Math.round(
                this.track.outerWidth() / this.active.outerWidth()
              )),
            (this.playing = !1),
            this.options.next &&
              (this.nextButton = t(this.options.next, this.element).on(
                "click",
                t.proxy(this, "next")
              )),
            this.options.prev &&
              (this.prevButton = t(this.options.prev, this.element).on(
                "click",
                t.proxy(this, "prev")
              )),
            this.options.nav &&
              (this._initNav(),
              this.options.count &&
                t(this.options.count, this.element).text(this.slides.length),
              this._updateNav()),
            this.options.autorefresh &&
              t(window).resize(t.proxy(this, "refresh")),
            this._bindSwipes(),
            this._updatePages(),
            this._updateButtons(),
            this._updateHidden(),
            this._updateActive(),
            this.options.autoplay &&
              (this.play(),
              this.element.mouseleave(t.proxy(this, "play")),
              this.options.autostop &&
                this.element.mouseenter(t.proxy(this, "stop"))),
            window.setTimeout(function () {
              e.element.addClass("scrollable--enabled");
            }, 1));
      },
      destroy: function () {
        this._debug("Scrollable :: DESTROY"),
          this.options.next &&
            t(this.options.next, this.element).off(
              "click",
              t.proxy(this, "next")
            ),
          this.options.prev &&
            t(this.options.prev, this.element).off(
              "click",
              t.proxy(this, "prev")
            ),
          this.options.autorefresh &&
            t(window).off("resize", t.proxy(this, "refresh"));
      },
      select: function (e) {
        if ((this._debug("Scrollable :: SELECT", e), this._indexIsValid(e))) {
          (this.active = this.slides.eq(e)), (this.index = e);
          var i = this;
          t.when(
            t.isFunction(this.options.beforeSlide) &&
              this.options.beforeSlide.call(i)
          ).done(function () {
            i.refresh(),
              i._updateNav(),
              i._updateHidden(),
              i._updateActive(),
              t.isFunction(i.options.afterSlide) &&
                i.options.afterSlide.call(i),
              i.options.autoplay && i.play();
          });
        }
      },
      refresh: function () {
        this._debug("Scrollable :: REFRESH");
        var t = this.active.outerWidth() / this.track.outerWidth();
        this.track.css({
          transform: "translateX(-" + 100 * this.index * t + "%)",
        }),
          this._updatePages(),
          this._updateButtons();
      },
      next: function (t) {
        t && t.preventDefault(), this.stop(), this.select(this._nextIndex());
      },
      _nextOrStart: function () {
        this._indexIsValid(this._nextIndex()) ? this.next() : this.select(0);
      },
      _nextIndex: function () {
        var t = this.index + 1;
        return this.options.paginate && (t = this.index + this.itemsPerPage), t;
      },
      prev: function (t) {
        t && t.preventDefault(), this.stop(), this.select(this._prevIndex());
      },
      _prevIndex: function () {
        var t = this.index - 1;
        return (
          this.options.paginate
            ? ((t = this.index - this.itemsPerPage) > 0 &&
                t < this.itemsPerPage &&
                (t = 0),
              t >= this.slides.length && (t = this.slides.length - 1))
            : t > this.slides.length - this.itemsPerPage &&
              (t = this.slides.length - this.itemsPerPage),
          t
        );
      },
      play: function () {
        this._debug("Scrollable :: PLAY"),
          this.playing ||
            (this.playing = setInterval(
              t.proxy(this, "_nextOrStart"),
              this.options.autodelay
            ));
      },
      stop: function () {
        this._debug("Scrollable :: STOP"),
          this.playing && (clearInterval(this.playing), (this.playing = !1));
      },
      _updatePages: function () {
        this._debug("Scrollable :: UPDATE PAGES"),
          (this.itemsPerPage = Math.round(
            this.track.innerWidth() / this.slides.outerWidth()
          ));
      },
      _updateHidden: function () {
        this.slides.removeClass(this.options.hiddenClass),
          this.index > 0 &&
            this.slides.slice(0, this.index).addClass(this.options.hiddenClass),
          this.slides
            .slice(this.index + this.itemsPerPage)
            .addClass(this.options.hiddenClass);
      },
      _updateActive: function () {
        this.slides.removeClass(this.options.activeClass),
          this.active.addClass(this.options.activeClass);
      },
      _bindSwipes: function () {
        this._debug("Scrollable :: BIND SWIPES"),
          this.element.bind("swipeleft", t.proxy(this, "next")),
          this.element.bind("swiperight", t.proxy(this, "prev"));
      },
      _unbindSwipes: function () {
        this._debug("Scrollable :: UNBIND SWIPES"),
          this.element.bind("swipeleft", t.proxy(this, "next")),
          this.element.bind("swiperight", t.proxy(this, "prev"));
      },
      _updateButtons: function () {
        this.prevButton[
          this._indexIsValid(this._prevIndex()) ? "removeClass" : "addClass"
        ](this.options.disabledClass),
          this.nextButton[
            this._indexIsValid(this._nextIndex()) ? "removeClass" : "addClass"
          ](this.options.disabledClass),
          this.element[
            this._indexIsValid(this._nextIndex()) ||
            this._indexIsValid(this._prevIndex())
              ? "removeClass"
              : "addClass"
          ]("scrollable--static");
      },
      _indexIsValid: function (t) {
        return (
          !(t < 0) &&
          (this.options.paginate
            ? t + 1 <= this.slides.length
            : t <= this.slides.length - this.itemsPerPage)
        );
      },
      _initNav: function () {
        this._debug("Scrollable :: INIT NAV");
        var e = this;
        this.options.nav &&
          ((this.nav = t(this.options.nav, this.element)),
          (this.navItems = t(e.options.navItem, this.nav)),
          this.nav.on("click", e.options.navItem, function (i) {
            i.preventDefault();
            var n = t(this).index();
            n !== e.index && (e.stop(), e.select(n));
          }));
      },
      _updateNav: function () {
        this.options.index &&
          t(this.options.index, this.element).text(this.index + 1),
          this.options.nav &&
            (this.navItems.removeClass(this.options.navActiveClass),
            this.navItems.eq(this.index).addClass(this.options.navActiveClass));
      },
      _debug: function () {
        !0 === this.options.debug &&
          window.console &&
          window.console.log &&
          window.console.log.apply(window.console, arguments);
      },
    };
    t.widget("d3r.scrollable", e);
  })(jQuery),
  $(document).on("click", ".d3r-show, .d3r-hide", function (t) {
    var e,
      i = $(this);
    if (
      (i.is("a") && t.preventDefault(),
      i.data("target")
        ? (e = $("#" + i.data("target")))
        : i.attr("href") && "#" == i.attr("href")[0] && (e = $(i.attr("href"))),
      e.length)
    ) {
      var n = i.hasClass("d3r-hide");
      e[n ? "toggleClass" : "addClass"]("d3r-shown"),
        i[n ? "toggleClass" : "addClass"]("d3r-active");
    }
    if (e.hasClass("d3r-shown") && i.hasClass("d3r-autoclose")) {
      var o = function (t) {
        $.contains(e[0], t.target) ||
          (e.hasClass("d3r-shown") &&
            (t.preventDefault(),
            e.removeClass("d3r-shown"),
            i.removeClass("d3r-active")),
          $(document).off("click", o));
      };
      $(document).on("click", o);
    }
  }),
  $(document).on("change", "select.d3r-redirector", function (t) {
    window.location.assign($(this).val());
  }),
  $(document).on("change", "select.d3r-chooser", function (t) {
    var e = $(this),
      i = $(".d3r-chooser-option").filter(
        '[data-chooser="' + e.attr("id") + '"]'
      );
    i.removeClass("d3r-shown");
    var n = ['[data-chooservalue="' + e.val() + '"]'];
    e.val() && n.push("#" + e.val()),
      i.filter(n.join(",")).addClass("d3r-shown");
  }),
  $(document).on("change", "select.d3r-multichooser", function (t) {
    var e = $(this),
      i = $(".d3r-multichooser-option").filter(
        '[data-multichooser="' + e.attr("id") + '"]'
      ),
      n = $("option:selected", this);
    i.removeClass("d3r-shown"),
      $.each(n.data("values").split(" "), function (t, e) {
        var n = ['[data-chooservalue="' + e + '"]'];
        e && n.push("#" + e), i.filter(n.join(",")).addClass("d3r-shown");
      });
  }),
  $(document).on("change", 'input[type="radio"].d3r-chooser', function (t) {
    var e = $(this),
      i = $(".d3r-chooser-option").filter(
        '[data-chooser="' + e.attr("name") + '"]'
      );
    if ((i.removeClass("d3r-shown"), e.is(":checked"))) {
      var n = ['[data-chooservalue="' + e.val() + '"]'];
      e.val() && n.push("#" + e.val()),
        i.filter(n.join(",")).addClass("d3r-shown");
    }
  }),
  $('input[type="radio"].d3r-chooser:checked').trigger("change"),
  $(document).on("click", ".d3r-submit", function (t) {
    var e = $(this);
    (e.closest("form") && !e.closest("form")[0].checkValidity()) ||
      (e.hasClass("d3r-disabled") && t.preventDefault(),
      e.addClass("d3r-disabled"),
      e.is("a") ||
        setTimeout(function () {
          e.prop("disabled", !0);
        }, 0));
  }),
  $(document).on("click", ".d3r-confirm", function (t) {
    var e = $(this),
      i = "Are you sure?";
    e.data("confirm") && (i = e.data("confirm")),
      window.confirm(i) || t.preventDefault();
  }),
  $(document).on("click", ".d3r-scrollto", function (t) {
    var e,
      i = $(this);
    if (
      (i.data("target")
        ? (e = $("#" + i.data("target")))
        : i.attr("href") &&
          "#" == i.attr("href").replace(window.location.pathname, "")[0] &&
          (e = $(i.attr("href").replace(window.location.pathname, ""))),
      e.length)
    ) {
      var n = e.attr("id");
      e.removeAttr("id"),
        $("html,body").animate({ scrollTop: e.offset().top }, 500, function () {
          e.attr("id", n);
        });
    }
  }),
  $(document).on("click", ".d3r-popup", function (t) {
    t.preventDefault();
    var e = $(this),
      i = e.attr("href"),
      n = 600,
      o = 300,
      a = "popup";
    e.data("width") && (n = e.data("width")),
      e.data("height") && (o = e.data("height")),
      e.attr("target") && (a = e.attr("target"));
    var r = window.open(i, a, "height=" + o + ",width=" + n);
    window.focus && r.focus();
  });
//# sourceMappingURL=https://assets.astrolighting.com/static/maps/js/libs/common.js.8b84c.map
