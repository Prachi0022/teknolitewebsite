!(function (e, t) {
  "object" == typeof module && "object" == typeof module.exports
    ? (module.exports = e.document
        ? t(e, !0)
        : function (e) {
            if (!e.document)
              throw new Error("jQuery requires a window with a document");
            return t(e);
          })
    : t(e);
})("undefined" != typeof window ? window : this, function (C, e) {
  var t = [],
    k = C.document,
    c = t.slice,
    g = t.concat,
    a = t.push,
    i = t.indexOf,
    n = {},
    r = n.toString,
    h = n.hasOwnProperty,
    v = {},
    o = "2.2.4",
    j = function (e, t) {
      return new j.fn.init(e, t);
    },
    s = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
    u = /^-ms-/,
    l = /-([\da-z])/gi,
    f = function (e, t) {
      return t.toUpperCase();
    };
  function p(e) {
    var t = !!e && "length" in e && e.length,
      n = j.type(e);
    return (
      "function" !== n &&
      !j.isWindow(e) &&
      ("array" === n ||
        0 === t ||
        ("number" == typeof t && 0 < t && t - 1 in e))
    );
  }
  (j.fn = j.prototype =
    {
      jquery: o,
      constructor: j,
      selector: "",
      length: 0,
      toArray: function () {
        return c.call(this);
      },
      get: function (e) {
        return null != e
          ? e < 0
            ? this[e + this.length]
            : this[e]
          : c.call(this);
      },
      pushStack: function (e) {
        var t = j.merge(this.constructor(), e);
        return (t.prevObject = this), (t.context = this.context), t;
      },
      each: function (e) {
        return j.each(this, e);
      },
      map: function (n) {
        return this.pushStack(
          j.map(this, function (e, t) {
            return n.call(e, t, e);
          })
        );
      },
      slice: function () {
        return this.pushStack(c.apply(this, arguments));
      },
      first: function () {
        return this.eq(0);
      },
      last: function () {
        return this.eq(-1);
      },
      eq: function (e) {
        var t = this.length,
          n = +e + (e < 0 ? t : 0);
        return this.pushStack(0 <= n && n < t ? [this[n]] : []);
      },
      end: function () {
        return this.prevObject || this.constructor();
      },
      push: a,
      sort: t.sort,
      splice: t.splice,
    }),
    (j.extend = j.fn.extend =
      function () {
        var e,
          t,
          n,
          r,
          i,
          o,
          s = arguments[0] || {},
          a = 1,
          u = arguments.length,
          l = !1;
        for (
          "boolean" == typeof s && ((l = s), (s = arguments[a] || {}), a++),
            "object" == typeof s || j.isFunction(s) || (s = {}),
            a === u && ((s = this), a--);
          a < u;
          a++
        )
          if (null != (e = arguments[a]))
            for (t in e)
              (n = s[t]),
                s !== (r = e[t]) &&
                  (l && r && (j.isPlainObject(r) || (i = j.isArray(r)))
                    ? ((o = i
                        ? ((i = !1), n && j.isArray(n) ? n : [])
                        : n && j.isPlainObject(n)
                        ? n
                        : {}),
                      (s[t] = j.extend(l, o, r)))
                    : void 0 !== r && (s[t] = r));
        return s;
      }),
    j.extend({
      expando: "jQuery" + (o + Math.random()).replace(/\D/g, ""),
      isReady: !0,
      error: function (e) {
        throw new Error(e);
      },
      noop: function () {},
      isFunction: function (e) {
        return "function" === j.type(e);
      },
      isArray: Array.isArray,
      isWindow: function (e) {
        return null != e && e === e.window;
      },
      isNumeric: function (e) {
        var t = e && e.toString();
        return !j.isArray(e) && 0 <= t - parseFloat(t) + 1;
      },
      isPlainObject: function (e) {
        var t;
        if ("object" !== j.type(e) || e.nodeType || j.isWindow(e)) return !1;
        if (
          e.constructor &&
          !h.call(e, "constructor") &&
          !h.call(e.constructor.prototype || {}, "isPrototypeOf")
        )
          return !1;
        for (t in e);
        return void 0 === t || h.call(e, t);
      },
      isEmptyObject: function (e) {
        var t;
        for (t in e) return !1;
        return !0;
      },
      type: function (e) {
        return null == e
          ? e + ""
          : "object" == typeof e || "function" == typeof e
          ? n[r.call(e)] || "object"
          : typeof e;
      },
      globalEval: function (e) {
        var t,
          n = eval;
        (e = j.trim(e)) &&
          (1 === e.indexOf("use strict")
            ? (((t = k.createElement("script")).text = e),
              k.head.appendChild(t).parentNode.removeChild(t))
            : n(e));
      },
      camelCase: function (e) {
        return e.replace(u, "ms-").replace(l, f);
      },
      nodeName: function (e, t) {
        return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase();
      },
      each: function (e, t) {
        var n,
          r = 0;
        if (p(e))
          for (n = e.length; r < n && !1 !== t.call(e[r], r, e[r]); r++);
        else for (r in e) if (!1 === t.call(e[r], r, e[r])) break;
        return e;
      },
      trim: function (e) {
        return null == e ? "" : (e + "").replace(s, "");
      },
      makeArray: function (e, t) {
        var n = t || [];
        return (
          null != e &&
            (p(Object(e))
              ? j.merge(n, "string" == typeof e ? [e] : e)
              : a.call(n, e)),
          n
        );
      },
      inArray: function (e, t, n) {
        return null == t ? -1 : i.call(t, e, n);
      },
      merge: function (e, t) {
        for (var n = +t.length, r = 0, i = e.length; r < n; r++) e[i++] = t[r];
        return (e.length = i), e;
      },
      grep: function (e, t, n) {
        for (var r = [], i = 0, o = e.length, s = !n; i < o; i++)
          !t(e[i], i) != s && r.push(e[i]);
        return r;
      },
      map: function (e, t, n) {
        var r,
          i,
          o = 0,
          s = [];
        if (p(e))
          for (r = e.length; o < r; o++)
            null != (i = t(e[o], o, n)) && s.push(i);
        else for (o in e) null != (i = t(e[o], o, n)) && s.push(i);
        return g.apply([], s);
      },
      guid: 1,
      proxy: function (e, t) {
        var n, r, i;
        if (
          ("string" == typeof t && ((n = e[t]), (t = e), (e = n)),
          j.isFunction(e))
        )
          return (
            (r = c.call(arguments, 2)),
            ((i = function () {
              return e.apply(t || this, r.concat(c.call(arguments)));
            }).guid = e.guid =
              e.guid || j.guid++),
            i
          );
      },
      now: Date.now,
      support: v,
    }),
    "function" == typeof Symbol && (j.fn[Symbol.iterator] = t[Symbol.iterator]),
    j.each(
      "Boolean Number String Function Array Date RegExp Object Error Symbol".split(
        " "
      ),
      function (e, t) {
        n["[object " + t + "]"] = t.toLowerCase();
      }
    );
  var d = (function (n) {
    var e,
      h,
      b,
      o,
      i,
      g,
      f,
      v,
      w,
      u,
      l,
      T,
      C,
      s,
      k,
      m,
      a,
      c,
      y,
      j = "sizzle" + 1 * new Date(),
      x = n.document,
      S = 0,
      r = 0,
      p = ie(),
      d = ie(),
      N = ie(),
      E = function (e, t) {
        return e === t && (l = !0), 0;
      },
      A = {}.hasOwnProperty,
      t = [],
      D = t.pop,
      L = t.push,
      q = t.push,
      H = t.slice,
      O = function (e, t) {
        for (var n = 0, r = e.length; n < r; n++) if (e[n] === t) return n;
        return -1;
      },
      M =
        "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
      F = "[\\x20\\t\\r\\n\\f]",
      R = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
      P =
        "\\[" +
        F +
        "*(" +
        R +
        ")(?:" +
        F +
        "*([*^$|!~]?=)" +
        F +
        "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" +
        R +
        "))|)" +
        F +
        "*\\]",
      I =
        ":(" +
        R +
        ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" +
        P +
        ")*)|.*)\\)|)",
      W = new RegExp(F + "+", "g"),
      $ = new RegExp("^" + F + "+|((?:^|[^\\\\])(?:\\\\.)*)" + F + "+$", "g"),
      B = new RegExp("^" + F + "*," + F + "*"),
      _ = new RegExp("^" + F + "*([>+~]|" + F + ")" + F + "*"),
      Q = new RegExp("=" + F + "*([^\\]'\"]*?)" + F + "*\\]", "g"),
      z = new RegExp(I),
      X = new RegExp("^" + R + "$"),
      U = {
        ID: new RegExp("^#(" + R + ")"),
        CLASS: new RegExp("^\\.(" + R + ")"),
        TAG: new RegExp("^(" + R + "|[*])"),
        ATTR: new RegExp("^" + P),
        PSEUDO: new RegExp("^" + I),
        CHILD: new RegExp(
          "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
            F +
            "*(even|odd|(([+-]|)(\\d*)n|)" +
            F +
            "*(?:([+-]|)" +
            F +
            "*(\\d+)|))" +
            F +
            "*\\)|)",
          "i"
        ),
        bool: new RegExp("^(?:" + M + ")$", "i"),
        needsContext: new RegExp(
          "^" +
            F +
            "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" +
            F +
            "*((?:-\\d)?\\d*)" +
            F +
            "*\\)|)(?=[^-]|$)",
          "i"
        ),
      },
      V = /^(?:input|select|textarea|button)$/i,
      J = /^h\d$/i,
      G = /^[^{]+\{\s*\[native \w/,
      Y = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
      K = /[+~]/,
      Z = /'|\\/g,
      ee = new RegExp("\\\\([\\da-f]{1,6}" + F + "?|(" + F + ")|.)", "ig"),
      te = function (e, t, n) {
        var r = "0x" + t - 65536;
        return r != r || n
          ? t
          : r < 0
          ? String.fromCharCode(65536 + r)
          : String.fromCharCode((r >> 10) | 55296, (1023 & r) | 56320);
      },
      ne = function () {
        T();
      };
    try {
      q.apply((t = H.call(x.childNodes)), x.childNodes),
        t[x.childNodes.length].nodeType;
    } catch (e) {
      q = {
        apply: t.length
          ? function (e, t) {
              L.apply(e, H.call(t));
            }
          : function (e, t) {
              for (var n = e.length, r = 0; (e[n++] = t[r++]); );
              e.length = n - 1;
            },
      };
    }
    function re(e, t, n, r) {
      var i,
        o,
        s,
        a,
        u,
        l,
        c,
        f,
        p = t && t.ownerDocument,
        d = t ? t.nodeType : 9;
      if (
        ((n = n || []),
        "string" != typeof e || !e || (1 !== d && 9 !== d && 11 !== d))
      )
        return n;
      if (
        !r &&
        ((t ? t.ownerDocument || t : x) !== C && T(t), (t = t || C), k)
      ) {
        if (11 !== d && (l = Y.exec(e)))
          if ((i = l[1])) {
            if (9 === d) {
              if (!(s = t.getElementById(i))) return n;
              if (s.id === i) return n.push(s), n;
            } else if (p && (s = p.getElementById(i)) && y(t, s) && s.id === i)
              return n.push(s), n;
          } else {
            if (l[2]) return q.apply(n, t.getElementsByTagName(e)), n;
            if (
              (i = l[3]) &&
              h.getElementsByClassName &&
              t.getElementsByClassName
            )
              return q.apply(n, t.getElementsByClassName(i)), n;
          }
        if (h.qsa && !N[e + " "] && (!m || !m.test(e))) {
          if (1 !== d) (p = t), (f = e);
          else if ("object" !== t.nodeName.toLowerCase()) {
            for (
              (a = t.getAttribute("id"))
                ? (a = a.replace(Z, "\\$&"))
                : t.setAttribute("id", (a = j)),
                o = (c = g(e)).length,
                u = X.test(a) ? "#" + a : "[id='" + a + "']";
              o--;

            )
              c[o] = u + " " + he(c[o]);
            (f = c.join(",")), (p = (K.test(e) && pe(t.parentNode)) || t);
          }
          if (f)
            try {
              return q.apply(n, p.querySelectorAll(f)), n;
            } catch (e) {
            } finally {
              a === j && t.removeAttribute("id");
            }
        }
      }
      return v(e.replace($, "$1"), t, n, r);
    }
    function ie() {
      var r = [];
      return function e(t, n) {
        return (
          r.push(t + " ") > b.cacheLength && delete e[r.shift()],
          (e[t + " "] = n)
        );
      };
    }
    function oe(e) {
      return (e[j] = !0), e;
    }
    function se(e) {
      var t = C.createElement("div");
      try {
        return !!e(t);
      } catch (e) {
        return !1;
      } finally {
        t.parentNode && t.parentNode.removeChild(t), (t = null);
      }
    }
    function ae(e, t) {
      for (var n = e.split("|"), r = n.length; r--; ) b.attrHandle[n[r]] = t;
    }
    function ue(e, t) {
      var n = t && e,
        r =
          n &&
          1 === e.nodeType &&
          1 === t.nodeType &&
          (~t.sourceIndex || 1 << 31) - (~e.sourceIndex || 1 << 31);
      if (r) return r;
      if (n) for (; (n = n.nextSibling); ) if (n === t) return -1;
      return e ? 1 : -1;
    }
    function le(t) {
      return function (e) {
        return "input" === e.nodeName.toLowerCase() && e.type === t;
      };
    }
    function ce(n) {
      return function (e) {
        var t = e.nodeName.toLowerCase();
        return ("input" === t || "button" === t) && e.type === n;
      };
    }
    function fe(s) {
      return oe(function (o) {
        return (
          (o = +o),
          oe(function (e, t) {
            for (var n, r = s([], e.length, o), i = r.length; i--; )
              e[(n = r[i])] && (e[n] = !(t[n] = e[n]));
          })
        );
      });
    }
    function pe(e) {
      return e && void 0 !== e.getElementsByTagName && e;
    }
    for (e in ((h = re.support = {}),
    (i = re.isXML =
      function (e) {
        var t = e && (e.ownerDocument || e).documentElement;
        return !!t && "HTML" !== t.nodeName;
      }),
    (T = re.setDocument =
      function (e) {
        var t,
          n,
          r = e ? e.ownerDocument || e : x;
        return (
          r !== C &&
            9 === r.nodeType &&
            r.documentElement &&
            ((s = (C = r).documentElement),
            (k = !i(C)),
            (n = C.defaultView) &&
              n.top !== n &&
              (n.addEventListener
                ? n.addEventListener("unload", ne, !1)
                : n.attachEvent && n.attachEvent("onunload", ne)),
            (h.attributes = se(function (e) {
              return (e.className = "i"), !e.getAttribute("className");
            })),
            (h.getElementsByTagName = se(function (e) {
              return (
                e.appendChild(C.createComment("")),
                !e.getElementsByTagName("*").length
              );
            })),
            (h.getElementsByClassName = G.test(C.getElementsByClassName)),
            (h.getById = se(function (e) {
              return (
                (s.appendChild(e).id = j),
                !C.getElementsByName || !C.getElementsByName(j).length
              );
            })),
            h.getById
              ? ((b.find.ID = function (e, t) {
                  if (void 0 !== t.getElementById && k) {
                    var n = t.getElementById(e);
                    return n ? [n] : [];
                  }
                }),
                (b.filter.ID = function (e) {
                  var t = e.replace(ee, te);
                  return function (e) {
                    return e.getAttribute("id") === t;
                  };
                }))
              : (delete b.find.ID,
                (b.filter.ID = function (e) {
                  var n = e.replace(ee, te);
                  return function (e) {
                    var t =
                      void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                    return t && t.value === n;
                  };
                })),
            (b.find.TAG = h.getElementsByTagName
              ? function (e, t) {
                  return void 0 !== t.getElementsByTagName
                    ? t.getElementsByTagName(e)
                    : h.qsa
                    ? t.querySelectorAll(e)
                    : void 0;
                }
              : function (e, t) {
                  var n,
                    r = [],
                    i = 0,
                    o = t.getElementsByTagName(e);
                  if ("*" !== e) return o;
                  for (; (n = o[i++]); ) 1 === n.nodeType && r.push(n);
                  return r;
                }),
            (b.find.CLASS =
              h.getElementsByClassName &&
              function (e, t) {
                if (void 0 !== t.getElementsByClassName && k)
                  return t.getElementsByClassName(e);
              }),
            (a = []),
            (m = []),
            (h.qsa = G.test(C.querySelectorAll)) &&
              (se(function (e) {
                (s.appendChild(e).innerHTML =
                  "<a id='" +
                  j +
                  "'></a><select id='" +
                  j +
                  "-\r\\' msallowcapture=''><option selected=''></option></select>"),
                  e.querySelectorAll("[msallowcapture^='']").length &&
                    m.push("[*^$]=" + F + "*(?:''|\"\")"),
                  e.querySelectorAll("[selected]").length ||
                    m.push("\\[" + F + "*(?:value|" + M + ")"),
                  e.querySelectorAll("[id~=" + j + "-]").length || m.push("~="),
                  e.querySelectorAll(":checked").length || m.push(":checked"),
                  e.querySelectorAll("a#" + j + "+*").length ||
                    m.push(".#.+[+~]");
              }),
              se(function (e) {
                var t = C.createElement("input");
                t.setAttribute("type", "hidden"),
                  e.appendChild(t).setAttribute("name", "D"),
                  e.querySelectorAll("[name=d]").length &&
                    m.push("name" + F + "*[*^$|!~]?="),
                  e.querySelectorAll(":enabled").length ||
                    m.push(":enabled", ":disabled"),
                  e.querySelectorAll("*,:x"),
                  m.push(",.*:");
              })),
            (h.matchesSelector = G.test(
              (c =
                s.matches ||
                s.webkitMatchesSelector ||
                s.mozMatchesSelector ||
                s.oMatchesSelector ||
                s.msMatchesSelector)
            )) &&
              se(function (e) {
                (h.disconnectedMatch = c.call(e, "div")),
                  c.call(e, "[s!='']:x"),
                  a.push("!=", I);
              }),
            (m = m.length && new RegExp(m.join("|"))),
            (a = a.length && new RegExp(a.join("|"))),
            (t = G.test(s.compareDocumentPosition)),
            (y =
              t || G.test(s.contains)
                ? function (e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e,
                      r = t && t.parentNode;
                    return (
                      e === r ||
                      !(
                        !r ||
                        1 !== r.nodeType ||
                        !(n.contains
                          ? n.contains(r)
                          : e.compareDocumentPosition &&
                            16 & e.compareDocumentPosition(r))
                      )
                    );
                  }
                : function (e, t) {
                    if (t) for (; (t = t.parentNode); ) if (t === e) return !0;
                    return !1;
                  }),
            (E = t
              ? function (e, t) {
                  if (e === t) return (l = !0), 0;
                  var n =
                    !e.compareDocumentPosition - !t.compareDocumentPosition;
                  return (
                    n ||
                    (1 &
                      (n =
                        (e.ownerDocument || e) === (t.ownerDocument || t)
                          ? e.compareDocumentPosition(t)
                          : 1) ||
                    (!h.sortDetached && t.compareDocumentPosition(e) === n)
                      ? e === C || (e.ownerDocument === x && y(x, e))
                        ? -1
                        : t === C || (t.ownerDocument === x && y(x, t))
                        ? 1
                        : u
                        ? O(u, e) - O(u, t)
                        : 0
                      : 4 & n
                      ? -1
                      : 1)
                  );
                }
              : function (e, t) {
                  if (e === t) return (l = !0), 0;
                  var n,
                    r = 0,
                    i = e.parentNode,
                    o = t.parentNode,
                    s = [e],
                    a = [t];
                  if (!i || !o)
                    return e === C
                      ? -1
                      : t === C
                      ? 1
                      : i
                      ? -1
                      : o
                      ? 1
                      : u
                      ? O(u, e) - O(u, t)
                      : 0;
                  if (i === o) return ue(e, t);
                  for (n = e; (n = n.parentNode); ) s.unshift(n);
                  for (n = t; (n = n.parentNode); ) a.unshift(n);
                  for (; s[r] === a[r]; ) r++;
                  return r
                    ? ue(s[r], a[r])
                    : s[r] === x
                    ? -1
                    : a[r] === x
                    ? 1
                    : 0;
                })),
          C
        );
      }),
    (re.matches = function (e, t) {
      return re(e, null, null, t);
    }),
    (re.matchesSelector = function (e, t) {
      if (
        ((e.ownerDocument || e) !== C && T(e),
        (t = t.replace(Q, "='$1']")),
        h.matchesSelector &&
          k &&
          !N[t + " "] &&
          (!a || !a.test(t)) &&
          (!m || !m.test(t)))
      )
        try {
          var n = c.call(e, t);
          if (
            n ||
            h.disconnectedMatch ||
            (e.document && 11 !== e.document.nodeType)
          )
            return n;
        } catch (e) {}
      return 0 < re(t, C, null, [e]).length;
    }),
    (re.contains = function (e, t) {
      return (e.ownerDocument || e) !== C && T(e), y(e, t);
    }),
    (re.attr = function (e, t) {
      (e.ownerDocument || e) !== C && T(e);
      var n = b.attrHandle[t.toLowerCase()],
        r = n && A.call(b.attrHandle, t.toLowerCase()) ? n(e, t, !k) : void 0;
      return void 0 !== r
        ? r
        : h.attributes || !k
        ? e.getAttribute(t)
        : (r = e.getAttributeNode(t)) && r.specified
        ? r.value
        : null;
    }),
    (re.error = function (e) {
      throw new Error("Syntax error, unrecognized expression: " + e);
    }),
    (re.uniqueSort = function (e) {
      var t,
        n = [],
        r = 0,
        i = 0;
      if (
        ((l = !h.detectDuplicates),
        (u = !h.sortStable && e.slice(0)),
        e.sort(E),
        l)
      ) {
        for (; (t = e[i++]); ) t === e[i] && (r = n.push(i));
        for (; r--; ) e.splice(n[r], 1);
      }
      return (u = null), e;
    }),
    (o = re.getText =
      function (e) {
        var t,
          n = "",
          r = 0,
          i = e.nodeType;
        if (i) {
          if (1 === i || 9 === i || 11 === i) {
            if ("string" == typeof e.textContent) return e.textContent;
            for (e = e.firstChild; e; e = e.nextSibling) n += o(e);
          } else if (3 === i || 4 === i) return e.nodeValue;
        } else for (; (t = e[r++]); ) n += o(t);
        return n;
      }),
    ((b = re.selectors =
      {
        cacheLength: 50,
        createPseudo: oe,
        match: U,
        attrHandle: {},
        find: {},
        relative: {
          ">": { dir: "parentNode", first: !0 },
          " ": { dir: "parentNode" },
          "+": { dir: "previousSibling", first: !0 },
          "~": { dir: "previousSibling" },
        },
        preFilter: {
          ATTR: function (e) {
            return (
              (e[1] = e[1].replace(ee, te)),
              (e[3] = (e[3] || e[4] || e[5] || "").replace(ee, te)),
              "~=" === e[2] && (e[3] = " " + e[3] + " "),
              e.slice(0, 4)
            );
          },
          CHILD: function (e) {
            return (
              (e[1] = e[1].toLowerCase()),
              "nth" === e[1].slice(0, 3)
                ? (e[3] || re.error(e[0]),
                  (e[4] = +(e[4]
                    ? e[5] + (e[6] || 1)
                    : 2 * ("even" === e[3] || "odd" === e[3]))),
                  (e[5] = +(e[7] + e[8] || "odd" === e[3])))
                : e[3] && re.error(e[0]),
              e
            );
          },
          PSEUDO: function (e) {
            var t,
              n = !e[6] && e[2];
            return U.CHILD.test(e[0])
              ? null
              : (e[3]
                  ? (e[2] = e[4] || e[5] || "")
                  : n &&
                    z.test(n) &&
                    (t = g(n, !0)) &&
                    (t = n.indexOf(")", n.length - t) - n.length) &&
                    ((e[0] = e[0].slice(0, t)), (e[2] = n.slice(0, t))),
                e.slice(0, 3));
          },
        },
        filter: {
          TAG: function (e) {
            var t = e.replace(ee, te).toLowerCase();
            return "*" === e
              ? function () {
                  return !0;
                }
              : function (e) {
                  return e.nodeName && e.nodeName.toLowerCase() === t;
                };
          },
          CLASS: function (e) {
            var t = p[e + " "];
            return (
              t ||
              ((t = new RegExp("(^|" + F + ")" + e + "(" + F + "|$)")) &&
                p(e, function (e) {
                  return t.test(
                    ("string" == typeof e.className && e.className) ||
                      (void 0 !== e.getAttribute && e.getAttribute("class")) ||
                      ""
                  );
                }))
            );
          },
          ATTR: function (n, r, i) {
            return function (e) {
              var t = re.attr(e, n);
              return null == t
                ? "!=" === r
                : !r ||
                    ((t += ""),
                    "=" === r
                      ? t === i
                      : "!=" === r
                      ? t !== i
                      : "^=" === r
                      ? i && 0 === t.indexOf(i)
                      : "*=" === r
                      ? i && -1 < t.indexOf(i)
                      : "$=" === r
                      ? i && t.slice(-i.length) === i
                      : "~=" === r
                      ? -1 < (" " + t.replace(W, " ") + " ").indexOf(i)
                      : "|=" === r &&
                        (t === i || t.slice(0, i.length + 1) === i + "-"));
            };
          },
          CHILD: function (h, e, t, g, v) {
            var m = "nth" !== h.slice(0, 3),
              y = "last" !== h.slice(-4),
              x = "of-type" === e;
            return 1 === g && 0 === v
              ? function (e) {
                  return !!e.parentNode;
                }
              : function (e, t, n) {
                  var r,
                    i,
                    o,
                    s,
                    a,
                    u,
                    l = m != y ? "nextSibling" : "previousSibling",
                    c = e.parentNode,
                    f = x && e.nodeName.toLowerCase(),
                    p = !n && !x,
                    d = !1;
                  if (c) {
                    if (m) {
                      for (; l; ) {
                        for (s = e; (s = s[l]); )
                          if (
                            x
                              ? s.nodeName.toLowerCase() === f
                              : 1 === s.nodeType
                          )
                            return !1;
                        u = l = "only" === h && !u && "nextSibling";
                      }
                      return !0;
                    }
                    if (((u = [y ? c.firstChild : c.lastChild]), y && p)) {
                      for (
                        d =
                          (a =
                            (r =
                              (i =
                                (o = (s = c)[j] || (s[j] = {}))[s.uniqueID] ||
                                (o[s.uniqueID] = {}))[h] || [])[0] === S &&
                            r[1]) && r[2],
                          s = a && c.childNodes[a];
                        (s = (++a && s && s[l]) || (d = a = 0) || u.pop());

                      )
                        if (1 === s.nodeType && ++d && s === e) {
                          i[h] = [S, a, d];
                          break;
                        }
                    } else if (
                      (p &&
                        (d = a =
                          (r =
                            (i =
                              (o = (s = e)[j] || (s[j] = {}))[s.uniqueID] ||
                              (o[s.uniqueID] = {}))[h] || [])[0] === S && r[1]),
                      !1 === d)
                    )
                      for (
                        ;
                        (s = (++a && s && s[l]) || (d = a = 0) || u.pop()) &&
                        ((x
                          ? s.nodeName.toLowerCase() !== f
                          : 1 !== s.nodeType) ||
                          !++d ||
                          (p &&
                            ((i =
                              (o = s[j] || (s[j] = {}))[s.uniqueID] ||
                              (o[s.uniqueID] = {}))[h] = [S, d]),
                          s !== e));

                      );
                    return (d -= v) === g || (d % g == 0 && 0 <= d / g);
                  }
                };
          },
          PSEUDO: function (e, o) {
            var t,
              s =
                b.pseudos[e] ||
                b.setFilters[e.toLowerCase()] ||
                re.error("unsupported pseudo: " + e);
            return s[j]
              ? s(o)
              : 1 < s.length
              ? ((t = [e, e, "", o]),
                b.setFilters.hasOwnProperty(e.toLowerCase())
                  ? oe(function (e, t) {
                      for (var n, r = s(e, o), i = r.length; i--; )
                        e[(n = O(e, r[i]))] = !(t[n] = r[i]);
                    })
                  : function (e) {
                      return s(e, 0, t);
                    })
              : s;
          },
        },
        pseudos: {
          not: oe(function (e) {
            var r = [],
              i = [],
              a = f(e.replace($, "$1"));
            return a[j]
              ? oe(function (e, t, n, r) {
                  for (var i, o = a(e, null, r, []), s = e.length; s--; )
                    (i = o[s]) && (e[s] = !(t[s] = i));
                })
              : function (e, t, n) {
                  return (r[0] = e), a(r, null, n, i), (r[0] = null), !i.pop();
                };
          }),
          has: oe(function (t) {
            return function (e) {
              return 0 < re(t, e).length;
            };
          }),
          contains: oe(function (t) {
            return (
              (t = t.replace(ee, te)),
              function (e) {
                return -1 < (e.textContent || e.innerText || o(e)).indexOf(t);
              }
            );
          }),
          lang: oe(function (n) {
            return (
              X.test(n || "") || re.error("unsupported lang: " + n),
              (n = n.replace(ee, te).toLowerCase()),
              function (e) {
                var t;
                do {
                  if (
                    (t = k
                      ? e.lang
                      : e.getAttribute("xml:lang") || e.getAttribute("lang"))
                  )
                    return (
                      (t = t.toLowerCase()) === n || 0 === t.indexOf(n + "-")
                    );
                } while ((e = e.parentNode) && 1 === e.nodeType);
                return !1;
              }
            );
          }),
          target: function (e) {
            var t = n.location && n.location.hash;
            return t && t.slice(1) === e.id;
          },
          root: function (e) {
            return e === s;
          },
          focus: function (e) {
            return (
              e === C.activeElement &&
              (!C.hasFocus || C.hasFocus()) &&
              !!(e.type || e.href || ~e.tabIndex)
            );
          },
          enabled: function (e) {
            return !1 === e.disabled;
          },
          disabled: function (e) {
            return !0 === e.disabled;
          },
          checked: function (e) {
            var t = e.nodeName.toLowerCase();
            return (
              ("input" === t && !!e.checked) || ("option" === t && !!e.selected)
            );
          },
          selected: function (e) {
            return (
              e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
            );
          },
          empty: function (e) {
            for (e = e.firstChild; e; e = e.nextSibling)
              if (e.nodeType < 6) return !1;
            return !0;
          },
          parent: function (e) {
            return !b.pseudos.empty(e);
          },
          header: function (e) {
            return J.test(e.nodeName);
          },
          input: function (e) {
            return V.test(e.nodeName);
          },
          button: function (e) {
            var t = e.nodeName.toLowerCase();
            return ("input" === t && "button" === e.type) || "button" === t;
          },
          text: function (e) {
            var t;
            return (
              "input" === e.nodeName.toLowerCase() &&
              "text" === e.type &&
              (null == (t = e.getAttribute("type")) ||
                "text" === t.toLowerCase())
            );
          },
          first: fe(function () {
            return [0];
          }),
          last: fe(function (e, t) {
            return [t - 1];
          }),
          eq: fe(function (e, t, n) {
            return [n < 0 ? n + t : n];
          }),
          even: fe(function (e, t) {
            for (var n = 0; n < t; n += 2) e.push(n);
            return e;
          }),
          odd: fe(function (e, t) {
            for (var n = 1; n < t; n += 2) e.push(n);
            return e;
          }),
          lt: fe(function (e, t, n) {
            for (var r = n < 0 ? n + t : n; 0 <= --r; ) e.push(r);
            return e;
          }),
          gt: fe(function (e, t, n) {
            for (var r = n < 0 ? n + t : n; ++r < t; ) e.push(r);
            return e;
          }),
        },
      }).pseudos.nth = b.pseudos.eq),
    { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }))
      b.pseudos[e] = le(e);
    for (e in { submit: !0, reset: !0 }) b.pseudos[e] = ce(e);
    function de() {}
    function he(e) {
      for (var t = 0, n = e.length, r = ""; t < n; t++) r += e[t].value;
      return r;
    }
    function ge(a, e, t) {
      var u = e.dir,
        l = t && "parentNode" === u,
        c = r++;
      return e.first
        ? function (e, t, n) {
            for (; (e = e[u]); ) if (1 === e.nodeType || l) return a(e, t, n);
          }
        : function (e, t, n) {
            var r,
              i,
              o,
              s = [S, c];
            if (n) {
              for (; (e = e[u]); )
                if ((1 === e.nodeType || l) && a(e, t, n)) return !0;
            } else
              for (; (e = e[u]); )
                if (1 === e.nodeType || l) {
                  if (
                    (r = (i =
                      (o = e[j] || (e[j] = {}))[e.uniqueID] ||
                      (o[e.uniqueID] = {}))[u]) &&
                    r[0] === S &&
                    r[1] === c
                  )
                    return (s[2] = r[2]);
                  if (((i[u] = s)[2] = a(e, t, n))) return !0;
                }
          };
    }
    function ve(i) {
      return 1 < i.length
        ? function (e, t, n) {
            for (var r = i.length; r--; ) if (!i[r](e, t, n)) return !1;
            return !0;
          }
        : i[0];
    }
    function me(e, t, n, r, i) {
      for (var o, s = [], a = 0, u = e.length, l = null != t; a < u; a++)
        (o = e[a]) && ((n && !n(o, r, i)) || (s.push(o), l && t.push(a)));
      return s;
    }
    function ye(d, h, g, v, m, e) {
      return (
        v && !v[j] && (v = ye(v)),
        m && !m[j] && (m = ye(m, e)),
        oe(function (e, t, n, r) {
          var i,
            o,
            s,
            a = [],
            u = [],
            l = t.length,
            c =
              e ||
              (function (e, t, n) {
                for (var r = 0, i = t.length; r < i; r++) re(e, t[r], n);
                return n;
              })(h || "*", n.nodeType ? [n] : n, []),
            f = !d || (!e && h) ? c : me(c, a, d, n, r),
            p = g ? (m || (e ? d : l || v) ? [] : t) : f;
          if ((g && g(f, p, n, r), v))
            for (i = me(p, u), v(i, [], n, r), o = i.length; o--; )
              (s = i[o]) && (p[u[o]] = !(f[u[o]] = s));
          if (e) {
            if (m || d) {
              if (m) {
                for (i = [], o = p.length; o--; )
                  (s = p[o]) && i.push((f[o] = s));
                m(null, (p = []), i, r);
              }
              for (o = p.length; o--; )
                (s = p[o]) &&
                  -1 < (i = m ? O(e, s) : a[o]) &&
                  (e[i] = !(t[i] = s));
            }
          } else (p = me(p === t ? p.splice(l, p.length) : p)), m ? m(null, t, p, r) : q.apply(t, p);
        })
      );
    }
    function xe(e) {
      for (
        var i,
          t,
          n,
          r = e.length,
          o = b.relative[e[0].type],
          s = o || b.relative[" "],
          a = o ? 1 : 0,
          u = ge(
            function (e) {
              return e === i;
            },
            s,
            !0
          ),
          l = ge(
            function (e) {
              return -1 < O(i, e);
            },
            s,
            !0
          ),
          c = [
            function (e, t, n) {
              var r =
                (!o && (n || t !== w)) ||
                ((i = t).nodeType ? u(e, t, n) : l(e, t, n));
              return (i = null), r;
            },
          ];
        a < r;
        a++
      )
        if ((t = b.relative[e[a].type])) c = [ge(ve(c), t)];
        else {
          if ((t = b.filter[e[a].type].apply(null, e[a].matches))[j]) {
            for (n = ++a; n < r && !b.relative[e[n].type]; n++);
            return ye(
              1 < a && ve(c),
              1 < a &&
                he(
                  e
                    .slice(0, a - 1)
                    .concat({ value: " " === e[a - 2].type ? "*" : "" })
                ).replace($, "$1"),
              t,
              a < n && xe(e.slice(a, n)),
              n < r && xe((e = e.slice(n))),
              n < r && he(e)
            );
          }
          c.push(t);
        }
      return ve(c);
    }
    return (
      (de.prototype = b.filters = b.pseudos),
      (b.setFilters = new de()),
      (g = re.tokenize =
        function (e, t) {
          var n,
            r,
            i,
            o,
            s,
            a,
            u,
            l = d[e + " "];
          if (l) return t ? 0 : l.slice(0);
          for (s = e, a = [], u = b.preFilter; s; ) {
            for (o in ((n && !(r = B.exec(s))) ||
              (r && (s = s.slice(r[0].length) || s), a.push((i = []))),
            (n = !1),
            (r = _.exec(s)) &&
              ((n = r.shift()),
              i.push({ value: n, type: r[0].replace($, " ") }),
              (s = s.slice(n.length))),
            b.filter))
              !(r = U[o].exec(s)) ||
                (u[o] && !(r = u[o](r))) ||
                ((n = r.shift()),
                i.push({ value: n, type: o, matches: r }),
                (s = s.slice(n.length)));
            if (!n) break;
          }
          return t ? s.length : s ? re.error(e) : d(e, a).slice(0);
        }),
      (f = re.compile =
        function (e, t) {
          var n,
            r = [],
            i = [],
            o = N[e + " "];
          if (!o) {
            for (t || (t = g(e)), n = t.length; n--; )
              (o = xe(t[n]))[j] ? r.push(o) : i.push(o);
            (o = N(
              e,
              (function (v, m) {
                var y = 0 < m.length,
                  x = 0 < v.length,
                  e = function (e, t, n, r, i) {
                    var o,
                      s,
                      a,
                      u = 0,
                      l = "0",
                      c = e && [],
                      f = [],
                      p = w,
                      d = e || (x && b.find.TAG("*", i)),
                      h = (S += null == p ? 1 : Math.random() || 0.1),
                      g = d.length;
                    for (
                      i && (w = t === C || t || i);
                      l !== g && null != (o = d[l]);
                      l++
                    ) {
                      if (x && o) {
                        for (
                          s = 0, t || o.ownerDocument === C || (T(o), (n = !k));
                          (a = v[s++]);

                        )
                          if (a(o, t || C, n)) {
                            r.push(o);
                            break;
                          }
                        i && (S = h);
                      }
                      y && ((o = !a && o) && u--, e && c.push(o));
                    }
                    if (((u += l), y && l !== u)) {
                      for (s = 0; (a = m[s++]); ) a(c, f, t, n);
                      if (e) {
                        if (0 < u)
                          for (; l--; ) c[l] || f[l] || (f[l] = D.call(r));
                        f = me(f);
                      }
                      q.apply(r, f),
                        i &&
                          !e &&
                          0 < f.length &&
                          1 < u + m.length &&
                          re.uniqueSort(r);
                    }
                    return i && ((S = h), (w = p)), c;
                  };
                return y ? oe(e) : e;
              })(i, r)
            )).selector = e;
          }
          return o;
        }),
      (v = re.select =
        function (e, t, n, r) {
          var i,
            o,
            s,
            a,
            u,
            l = "function" == typeof e && e,
            c = !r && g((e = l.selector || e));
          if (((n = n || []), 1 === c.length)) {
            if (
              2 < (o = c[0] = c[0].slice(0)).length &&
              "ID" === (s = o[0]).type &&
              h.getById &&
              9 === t.nodeType &&
              k &&
              b.relative[o[1].type]
            ) {
              if (!(t = (b.find.ID(s.matches[0].replace(ee, te), t) || [])[0]))
                return n;
              l && (t = t.parentNode), (e = e.slice(o.shift().value.length));
            }
            for (
              i = U.needsContext.test(e) ? 0 : o.length;
              i-- && ((s = o[i]), !b.relative[(a = s.type)]);

            )
              if (
                (u = b.find[a]) &&
                (r = u(
                  s.matches[0].replace(ee, te),
                  (K.test(o[0].type) && pe(t.parentNode)) || t
                ))
              ) {
                if ((o.splice(i, 1), !(e = r.length && he(o))))
                  return q.apply(n, r), n;
                break;
              }
          }
          return (
            (l || f(e, c))(
              r,
              t,
              !k,
              n,
              !t || (K.test(e) && pe(t.parentNode)) || t
            ),
            n
          );
        }),
      (h.sortStable = j.split("").sort(E).join("") === j),
      (h.detectDuplicates = !!l),
      T(),
      (h.sortDetached = se(function (e) {
        return 1 & e.compareDocumentPosition(C.createElement("div"));
      })),
      se(function (e) {
        return (
          (e.innerHTML = "<a href='#'></a>"),
          "#" === e.firstChild.getAttribute("href")
        );
      }) ||
        ae("type|href|height|width", function (e, t, n) {
          if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2);
        }),
      (h.attributes &&
        se(function (e) {
          return (
            (e.innerHTML = "<input/>"),
            e.firstChild.setAttribute("value", ""),
            "" === e.firstChild.getAttribute("value")
          );
        })) ||
        ae("value", function (e, t, n) {
          if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue;
        }),
      se(function (e) {
        return null == e.getAttribute("disabled");
      }) ||
        ae(M, function (e, t, n) {
          var r;
          if (!n)
            return !0 === e[t]
              ? t.toLowerCase()
              : (r = e.getAttributeNode(t)) && r.specified
              ? r.value
              : null;
        }),
      re
    );
  })(C);
  (j.find = d),
    (j.expr = d.selectors),
    (j.expr[":"] = j.expr.pseudos),
    (j.uniqueSort = j.unique = d.uniqueSort),
    (j.text = d.getText),
    (j.isXMLDoc = d.isXML),
    (j.contains = d.contains);
  var m = function (e, t, n) {
      for (var r = [], i = void 0 !== n; (e = e[t]) && 9 !== e.nodeType; )
        if (1 === e.nodeType) {
          if (i && j(e).is(n)) break;
          r.push(e);
        }
      return r;
    },
    y = function (e, t) {
      for (var n = []; e; e = e.nextSibling)
        1 === e.nodeType && e !== t && n.push(e);
      return n;
    },
    x = j.expr.match.needsContext,
    b = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,
    w = /^.[^:#\[\.,]*$/;
  function T(e, n, r) {
    if (j.isFunction(n))
      return j.grep(e, function (e, t) {
        return !!n.call(e, t, e) !== r;
      });
    if (n.nodeType)
      return j.grep(e, function (e) {
        return (e === n) !== r;
      });
    if ("string" == typeof n) {
      if (w.test(n)) return j.filter(n, e, r);
      n = j.filter(n, e);
    }
    return j.grep(e, function (e) {
      return -1 < i.call(n, e) !== r;
    });
  }
  (j.filter = function (e, t, n) {
    var r = t[0];
    return (
      n && (e = ":not(" + e + ")"),
      1 === t.length && 1 === r.nodeType
        ? j.find.matchesSelector(r, e)
          ? [r]
          : []
        : j.find.matches(
            e,
            j.grep(t, function (e) {
              return 1 === e.nodeType;
            })
          )
    );
  }),
    j.fn.extend({
      find: function (e) {
        var t,
          n = this.length,
          r = [],
          i = this;
        if ("string" != typeof e)
          return this.pushStack(
            j(e).filter(function () {
              for (t = 0; t < n; t++) if (j.contains(i[t], this)) return !0;
            })
          );
        for (t = 0; t < n; t++) j.find(e, i[t], r);
        return (
          ((r = this.pushStack(1 < n ? j.unique(r) : r)).selector = this
            .selector
            ? this.selector + " " + e
            : e),
          r
        );
      },
      filter: function (e) {
        return this.pushStack(T(this, e || [], !1));
      },
      not: function (e) {
        return this.pushStack(T(this, e || [], !0));
      },
      is: function (e) {
        return !!T(this, "string" == typeof e && x.test(e) ? j(e) : e || [], !1)
          .length;
      },
    });
  var S,
    N = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
  ((j.fn.init = function (e, t, n) {
    var r, i;
    if (!e) return this;
    if (((n = n || S), "string" != typeof e))
      return e.nodeType
        ? ((this.context = this[0] = e), (this.length = 1), this)
        : j.isFunction(e)
        ? void 0 !== n.ready
          ? n.ready(e)
          : e(j)
        : (void 0 !== e.selector &&
            ((this.selector = e.selector), (this.context = e.context)),
          j.makeArray(e, this));
    if (
      !(r =
        "<" === e[0] && ">" === e[e.length - 1] && 3 <= e.length
          ? [null, e, null]
          : N.exec(e)) ||
      (!r[1] && t)
    )
      return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
    if (r[1]) {
      if (
        ((t = t instanceof j ? t[0] : t),
        j.merge(
          this,
          j.parseHTML(r[1], t && t.nodeType ? t.ownerDocument || t : k, !0)
        ),
        b.test(r[1]) && j.isPlainObject(t))
      )
        for (r in t) j.isFunction(this[r]) ? this[r](t[r]) : this.attr(r, t[r]);
      return this;
    }
    return (
      (i = k.getElementById(r[2])) &&
        i.parentNode &&
        ((this.length = 1), (this[0] = i)),
      (this.context = k),
      (this.selector = e),
      this
    );
  }).prototype = j.fn),
    (S = j(k));
  var E = /^(?:parents|prev(?:Until|All))/,
    A = { children: !0, contents: !0, next: !0, prev: !0 };
  function D(e, t) {
    for (; (e = e[t]) && 1 !== e.nodeType; );
    return e;
  }
  j.fn.extend({
    has: function (e) {
      var t = j(e, this),
        n = t.length;
      return this.filter(function () {
        for (var e = 0; e < n; e++) if (j.contains(this, t[e])) return !0;
      });
    },
    closest: function (e, t) {
      for (
        var n,
          r = 0,
          i = this.length,
          o = [],
          s = x.test(e) || "string" != typeof e ? j(e, t || this.context) : 0;
        r < i;
        r++
      )
        for (n = this[r]; n && n !== t; n = n.parentNode)
          if (
            n.nodeType < 11 &&
            (s
              ? -1 < s.index(n)
              : 1 === n.nodeType && j.find.matchesSelector(n, e))
          ) {
            o.push(n);
            break;
          }
      return this.pushStack(1 < o.length ? j.uniqueSort(o) : o);
    },
    index: function (e) {
      return e
        ? "string" == typeof e
          ? i.call(j(e), this[0])
          : i.call(this, e.jquery ? e[0] : e)
        : this[0] && this[0].parentNode
        ? this.first().prevAll().length
        : -1;
    },
    add: function (e, t) {
      return this.pushStack(j.uniqueSort(j.merge(this.get(), j(e, t))));
    },
    addBack: function (e) {
      return this.add(null == e ? this.prevObject : this.prevObject.filter(e));
    },
  }),
    j.each(
      {
        parent: function (e) {
          var t = e.parentNode;
          return t && 11 !== t.nodeType ? t : null;
        },
        parents: function (e) {
          return m(e, "parentNode");
        },
        parentsUntil: function (e, t, n) {
          return m(e, "parentNode", n);
        },
        next: function (e) {
          return D(e, "nextSibling");
        },
        prev: function (e) {
          return D(e, "previousSibling");
        },
        nextAll: function (e) {
          return m(e, "nextSibling");
        },
        prevAll: function (e) {
          return m(e, "previousSibling");
        },
        nextUntil: function (e, t, n) {
          return m(e, "nextSibling", n);
        },
        prevUntil: function (e, t, n) {
          return m(e, "previousSibling", n);
        },
        siblings: function (e) {
          return y((e.parentNode || {}).firstChild, e);
        },
        children: function (e) {
          return y(e.firstChild);
        },
        contents: function (e) {
          return e.contentDocument || j.merge([], e.childNodes);
        },
      },
      function (r, i) {
        j.fn[r] = function (e, t) {
          var n = j.map(this, i, e);
          return (
            "Until" !== r.slice(-5) && (t = e),
            t && "string" == typeof t && (n = j.filter(t, n)),
            1 < this.length &&
              (A[r] || j.uniqueSort(n), E.test(r) && n.reverse()),
            this.pushStack(n)
          );
        };
      }
    );
  var L,
    q = /\S+/g;
  function H() {
    k.removeEventListener("DOMContentLoaded", H),
      C.removeEventListener("load", H),
      j.ready();
  }
  (j.Callbacks = function (r) {
    r =
      "string" == typeof r
        ? (function (e) {
            var n = {};
            return (
              j.each(e.match(q) || [], function (e, t) {
                n[t] = !0;
              }),
              n
            );
          })(r)
        : j.extend({}, r);
    var n,
      e,
      t,
      i,
      o = [],
      s = [],
      a = -1,
      u = function () {
        for (i = r.once, t = n = !0; s.length; a = -1)
          for (e = s.shift(); ++a < o.length; )
            !1 === o[a].apply(e[0], e[1]) &&
              r.stopOnFalse &&
              ((a = o.length), (e = !1));
        r.memory || (e = !1), (n = !1), i && (o = e ? [] : "");
      },
      l = {
        add: function () {
          return (
            o &&
              (e && !n && ((a = o.length - 1), s.push(e)),
              (function n(e) {
                j.each(e, function (e, t) {
                  j.isFunction(t)
                    ? (r.unique && l.has(t)) || o.push(t)
                    : t && t.length && "string" !== j.type(t) && n(t);
                });
              })(arguments),
              e && !n && u()),
            this
          );
        },
        remove: function () {
          return (
            j.each(arguments, function (e, t) {
              for (var n; -1 < (n = j.inArray(t, o, n)); )
                o.splice(n, 1), n <= a && a--;
            }),
            this
          );
        },
        has: function (e) {
          return e ? -1 < j.inArray(e, o) : 0 < o.length;
        },
        empty: function () {
          return o && (o = []), this;
        },
        disable: function () {
          return (i = s = []), (o = e = ""), this;
        },
        disabled: function () {
          return !o;
        },
        lock: function () {
          return (i = s = []), e || (o = e = ""), this;
        },
        locked: function () {
          return !!i;
        },
        fireWith: function (e, t) {
          return (
            i ||
              ((t = [e, (t = t || []).slice ? t.slice() : t]),
              s.push(t),
              n || u()),
            this
          );
        },
        fire: function () {
          return l.fireWith(this, arguments), this;
        },
        fired: function () {
          return !!t;
        },
      };
    return l;
  }),
    j.extend({
      Deferred: function (e) {
        var o = [
            ["resolve", "done", j.Callbacks("once memory"), "resolved"],
            ["reject", "fail", j.Callbacks("once memory"), "rejected"],
            ["notify", "progress", j.Callbacks("memory")],
          ],
          i = "pending",
          s = {
            state: function () {
              return i;
            },
            always: function () {
              return a.done(arguments).fail(arguments), this;
            },
            then: function () {
              var i = arguments;
              return j
                .Deferred(function (r) {
                  j.each(o, function (e, t) {
                    var n = j.isFunction(i[e]) && i[e];
                    a[t[1]](function () {
                      var e = n && n.apply(this, arguments);
                      e && j.isFunction(e.promise)
                        ? e
                            .promise()
                            .progress(r.notify)
                            .done(r.resolve)
                            .fail(r.reject)
                        : r[t[0] + "With"](
                            this === s ? r.promise() : this,
                            n ? [e] : arguments
                          );
                    });
                  }),
                    (i = null);
                })
                .promise();
            },
            promise: function (e) {
              return null != e ? j.extend(e, s) : s;
            },
          },
          a = {};
        return (
          (s.pipe = s.then),
          j.each(o, function (e, t) {
            var n = t[2],
              r = t[3];
            (s[t[1]] = n.add),
              r &&
                n.add(
                  function () {
                    i = r;
                  },
                  o[1 ^ e][2].disable,
                  o[2][2].lock
                ),
              (a[t[0]] = function () {
                return a[t[0] + "With"](this === a ? s : this, arguments), this;
              }),
              (a[t[0] + "With"] = n.fireWith);
          }),
          s.promise(a),
          e && e.call(a, a),
          a
        );
      },
      when: function (e) {
        var i,
          t,
          n,
          r = 0,
          o = c.call(arguments),
          s = o.length,
          a = 1 !== s || (e && j.isFunction(e.promise)) ? s : 0,
          u = 1 === a ? e : j.Deferred(),
          l = function (t, n, r) {
            return function (e) {
              (n[t] = this),
                (r[t] = 1 < arguments.length ? c.call(arguments) : e),
                r === i ? u.notifyWith(n, r) : --a || u.resolveWith(n, r);
            };
          };
        if (1 < s)
          for (i = new Array(s), t = new Array(s), n = new Array(s); r < s; r++)
            o[r] && j.isFunction(o[r].promise)
              ? o[r]
                  .promise()
                  .progress(l(r, t, i))
                  .done(l(r, n, o))
                  .fail(u.reject)
              : --a;
        return a || u.resolveWith(n, o), u.promise();
      },
    }),
    (j.fn.ready = function (e) {
      return j.ready.promise().done(e), this;
    }),
    j.extend({
      isReady: !1,
      readyWait: 1,
      holdReady: function (e) {
        e ? j.readyWait++ : j.ready(!0);
      },
      ready: function (e) {
        (!0 === e ? --j.readyWait : j.isReady) ||
          ((j.isReady = !0) !== e && 0 < --j.readyWait) ||
          (L.resolveWith(k, [j]),
          j.fn.triggerHandler &&
            (j(k).triggerHandler("ready"), j(k).off("ready")));
      },
    }),
    (j.ready.promise = function (e) {
      return (
        L ||
          ((L = j.Deferred()),
          "complete" === k.readyState ||
          ("loading" !== k.readyState && !k.documentElement.doScroll)
            ? C.setTimeout(j.ready)
            : (k.addEventListener("DOMContentLoaded", H),
              C.addEventListener("load", H))),
        L.promise(e)
      );
    }),
    j.ready.promise();
  var O = function (e, t, n, r, i, o, s) {
      var a = 0,
        u = e.length,
        l = null == n;
      if ("object" === j.type(n))
        for (a in ((i = !0), n)) O(e, t, a, n[a], !0, o, s);
      else if (
        void 0 !== r &&
        ((i = !0),
        j.isFunction(r) || (s = !0),
        l &&
          (t = s
            ? (t.call(e, r), null)
            : ((l = t),
              function (e, t, n) {
                return l.call(j(e), n);
              })),
        t)
      )
        for (; a < u; a++) t(e[a], n, s ? r : r.call(e[a], a, t(e[a], n)));
      return i ? e : l ? t.call(e) : u ? t(e[0], n) : o;
    },
    M = function (e) {
      return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType;
    };
  function F() {
    this.expando = j.expando + F.uid++;
  }
  (F.uid = 1),
    (F.prototype = {
      register: function (e, t) {
        var n = t || {};
        return (
          e.nodeType
            ? (e[this.expando] = n)
            : Object.defineProperty(e, this.expando, {
                value: n,
                writable: !0,
                configurable: !0,
              }),
          e[this.expando]
        );
      },
      cache: function (e) {
        if (!M(e)) return {};
        var t = e[this.expando];
        return (
          t ||
            ((t = {}),
            M(e) &&
              (e.nodeType
                ? (e[this.expando] = t)
                : Object.defineProperty(e, this.expando, {
                    value: t,
                    configurable: !0,
                  }))),
          t
        );
      },
      set: function (e, t, n) {
        var r,
          i = this.cache(e);
        if ("string" == typeof t) i[t] = n;
        else for (r in t) i[r] = t[r];
        return i;
      },
      get: function (e, t) {
        return void 0 === t
          ? this.cache(e)
          : e[this.expando] && e[this.expando][t];
      },
      access: function (e, t, n) {
        var r;
        return void 0 === t || (t && "string" == typeof t && void 0 === n)
          ? void 0 !== (r = this.get(e, t))
            ? r
            : this.get(e, j.camelCase(t))
          : (this.set(e, t, n), void 0 !== n ? n : t);
      },
      remove: function (e, t) {
        var n,
          r,
          i,
          o = e[this.expando];
        if (void 0 !== o) {
          if (void 0 === t) this.register(e);
          else {
            n = (r = j.isArray(t)
              ? t.concat(t.map(j.camelCase))
              : ((i = j.camelCase(t)),
                t in o ? [t, i] : (r = i) in o ? [r] : r.match(q) || []))
              .length;
            for (; n--; ) delete o[r[n]];
          }
          (void 0 === t || j.isEmptyObject(o)) &&
            (e.nodeType ? (e[this.expando] = void 0) : delete e[this.expando]);
        }
      },
      hasData: function (e) {
        var t = e[this.expando];
        return void 0 !== t && !j.isEmptyObject(t);
      },
    });
  var R = new F(),
    P = new F(),
    I = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
    W = /[A-Z]/g;
  function $(e, t, n) {
    var r;
    if (void 0 === n && 1 === e.nodeType)
      if (
        ((r = "data-" + t.replace(W, "-$&").toLowerCase()),
        "string" == typeof (n = e.getAttribute(r)))
      ) {
        try {
          n =
            "true" === n ||
            ("false" !== n &&
              ("null" === n
                ? null
                : +n + "" === n
                ? +n
                : I.test(n)
                ? j.parseJSON(n)
                : n));
        } catch (e) {}
        P.set(e, t, n);
      } else n = void 0;
    return n;
  }
  j.extend({
    hasData: function (e) {
      return P.hasData(e) || R.hasData(e);
    },
    data: function (e, t, n) {
      return P.access(e, t, n);
    },
    removeData: function (e, t) {
      P.remove(e, t);
    },
    _data: function (e, t, n) {
      return R.access(e, t, n);
    },
    _removeData: function (e, t) {
      R.remove(e, t);
    },
  }),
    j.fn.extend({
      data: function (r, e) {
        var t,
          n,
          i,
          o = this[0],
          s = o && o.attributes;
        if (void 0 !== r)
          return "object" == typeof r
            ? this.each(function () {
                P.set(this, r);
              })
            : O(
                this,
                function (t) {
                  var e, n;
                  if (o && void 0 === t)
                    return void 0 !==
                      (e =
                        P.get(o, r) ||
                        P.get(o, r.replace(W, "-$&").toLowerCase()))
                      ? e
                      : ((n = j.camelCase(r)),
                        void 0 !== (e = P.get(o, n))
                          ? e
                          : void 0 !== (e = $(o, n, void 0))
                          ? e
                          : void 0);
                  (n = j.camelCase(r)),
                    this.each(function () {
                      var e = P.get(this, n);
                      P.set(this, n, t),
                        -1 < r.indexOf("-") &&
                          void 0 !== e &&
                          P.set(this, r, t);
                    });
                },
                null,
                e,
                1 < arguments.length,
                null,
                !0
              );
        if (
          this.length &&
          ((i = P.get(o)), 1 === o.nodeType && !R.get(o, "hasDataAttrs"))
        ) {
          for (t = s.length; t--; )
            s[t] &&
              0 === (n = s[t].name).indexOf("data-") &&
              ((n = j.camelCase(n.slice(5))), $(o, n, i[n]));
          R.set(o, "hasDataAttrs", !0);
        }
        return i;
      },
      removeData: function (e) {
        return this.each(function () {
          P.remove(this, e);
        });
      },
    }),
    j.extend({
      queue: function (e, t, n) {
        var r;
        if (e)
          return (
            (t = (t || "fx") + "queue"),
            (r = R.get(e, t)),
            n &&
              (!r || j.isArray(n)
                ? (r = R.access(e, t, j.makeArray(n)))
                : r.push(n)),
            r || []
          );
      },
      dequeue: function (e, t) {
        t = t || "fx";
        var n = j.queue(e, t),
          r = n.length,
          i = n.shift(),
          o = j._queueHooks(e, t);
        "inprogress" === i && ((i = n.shift()), r--),
          i &&
            ("fx" === t && n.unshift("inprogress"),
            delete o.stop,
            i.call(
              e,
              function () {
                j.dequeue(e, t);
              },
              o
            )),
          !r && o && o.empty.fire();
      },
      _queueHooks: function (e, t) {
        var n = t + "queueHooks";
        return (
          R.get(e, n) ||
          R.access(e, n, {
            empty: j.Callbacks("once memory").add(function () {
              R.remove(e, [t + "queue", n]);
            }),
          })
        );
      },
    }),
    j.fn.extend({
      queue: function (t, n) {
        var e = 2;
        return (
          "string" != typeof t && ((n = t), (t = "fx"), e--),
          arguments.length < e
            ? j.queue(this[0], t)
            : void 0 === n
            ? this
            : this.each(function () {
                var e = j.queue(this, t, n);
                j._queueHooks(this, t),
                  "fx" === t && "inprogress" !== e[0] && j.dequeue(this, t);
              })
        );
      },
      dequeue: function (e) {
        return this.each(function () {
          j.dequeue(this, e);
        });
      },
      clearQueue: function (e) {
        return this.queue(e || "fx", []);
      },
      promise: function (e, t) {
        var n,
          r = 1,
          i = j.Deferred(),
          o = this,
          s = this.length,
          a = function () {
            --r || i.resolveWith(o, [o]);
          };
        for (
          "string" != typeof e && ((t = e), (e = void 0)), e = e || "fx";
          s--;

        )
          (n = R.get(o[s], e + "queueHooks")) &&
            n.empty &&
            (r++, n.empty.add(a));
        return a(), i.promise(t);
      },
    });
  var B = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
    _ = new RegExp("^(?:([+-])=|)(" + B + ")([a-z%]*)$", "i"),
    Q = ["Top", "Right", "Bottom", "Left"],
    z = function (e, t) {
      return (
        (e = t || e),
        "none" === j.css(e, "display") || !j.contains(e.ownerDocument, e)
      );
    };
  function X(e, t, n, r) {
    var i,
      o = 1,
      s = 20,
      a = r
        ? function () {
            return r.cur();
          }
        : function () {
            return j.css(e, t, "");
          },
      u = a(),
      l = (n && n[3]) || (j.cssNumber[t] ? "" : "px"),
      c = (j.cssNumber[t] || ("px" !== l && +u)) && _.exec(j.css(e, t));
    if (c && c[3] !== l)
      for (
        l = l || c[3], n = n || [], c = +u || 1;
        (c /= o = o || ".5"),
          j.style(e, t, c + l),
          o !== (o = a() / u) && 1 !== o && --s;

      );
    return (
      n &&
        ((c = +c || +u || 0),
        (i = n[1] ? c + (n[1] + 1) * n[2] : +n[2]),
        r && ((r.unit = l), (r.start = c), (r.end = i))),
      i
    );
  }
  var U = /^(?:checkbox|radio)$/i,
    V = /<([\w:-]+)/,
    J = /^$|\/(?:java|ecma)script/i,
    G = {
      option: [1, "<select multiple='multiple'>", "</select>"],
      thead: [1, "<table>", "</table>"],
      col: [2, "<table><colgroup>", "</colgroup></table>"],
      tr: [2, "<table><tbody>", "</tbody></table>"],
      td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
      _default: [0, "", ""],
    };
  function Y(e, t) {
    var n =
      void 0 !== e.getElementsByTagName
        ? e.getElementsByTagName(t || "*")
        : void 0 !== e.querySelectorAll
        ? e.querySelectorAll(t || "*")
        : [];
    return void 0 === t || (t && j.nodeName(e, t)) ? j.merge([e], n) : n;
  }
  function K(e, t) {
    for (var n = 0, r = e.length; n < r; n++)
      R.set(e[n], "globalEval", !t || R.get(t[n], "globalEval"));
  }
  (G.optgroup = G.option),
    (G.tbody = G.tfoot = G.colgroup = G.caption = G.thead),
    (G.th = G.td);
  var Z,
    ee,
    te = /<|&#?\w+;/;
  function ne(e, t, n, r, i) {
    for (
      var o,
        s,
        a,
        u,
        l,
        c,
        f = t.createDocumentFragment(),
        p = [],
        d = 0,
        h = e.length;
      d < h;
      d++
    )
      if ((o = e[d]) || 0 === o)
        if ("object" === j.type(o)) j.merge(p, o.nodeType ? [o] : o);
        else if (te.test(o)) {
          for (
            s = s || f.appendChild(t.createElement("div")),
              a = (V.exec(o) || ["", ""])[1].toLowerCase(),
              u = G[a] || G._default,
              s.innerHTML = u[1] + j.htmlPrefilter(o) + u[2],
              c = u[0];
            c--;

          )
            s = s.lastChild;
          j.merge(p, s.childNodes), ((s = f.firstChild).textContent = "");
        } else p.push(t.createTextNode(o));
    for (f.textContent = "", d = 0; (o = p[d++]); )
      if (r && -1 < j.inArray(o, r)) i && i.push(o);
      else if (
        ((l = j.contains(o.ownerDocument, o)),
        (s = Y(f.appendChild(o), "script")),
        l && K(s),
        n)
      )
        for (c = 0; (o = s[c++]); ) J.test(o.type || "") && n.push(o);
    return f;
  }
  (Z = k.createDocumentFragment().appendChild(k.createElement("div"))),
    (ee = k.createElement("input")).setAttribute("type", "radio"),
    ee.setAttribute("checked", "checked"),
    ee.setAttribute("name", "t"),
    Z.appendChild(ee),
    (v.checkClone = Z.cloneNode(!0).cloneNode(!0).lastChild.checked),
    (Z.innerHTML = "<textarea>x</textarea>"),
    (v.noCloneChecked = !!Z.cloneNode(!0).lastChild.defaultValue);
  var re = /^key/,
    ie = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
    oe = /^([^.]*)(?:\.(.+)|)/;
  function se() {
    return !0;
  }
  function ae() {
    return !1;
  }
  function ue() {
    try {
      return k.activeElement;
    } catch (e) {}
  }
  function le(e, t, n, r, i, o) {
    var s, a;
    if ("object" == typeof t) {
      for (a in ("string" != typeof n && ((r = r || n), (n = void 0)), t))
        le(e, a, n, r, t[a], o);
      return e;
    }
    if (
      (null == r && null == i
        ? ((i = n), (r = n = void 0))
        : null == i &&
          ("string" == typeof n
            ? ((i = r), (r = void 0))
            : ((i = r), (r = n), (n = void 0))),
      !1 === i)
    )
      i = ae;
    else if (!i) return e;
    return (
      1 === o &&
        ((s = i),
        ((i = function (e) {
          return j().off(e), s.apply(this, arguments);
        }).guid = s.guid || (s.guid = j.guid++))),
      e.each(function () {
        j.event.add(this, t, i, r, n);
      })
    );
  }
  (j.event = {
    global: {},
    add: function (t, e, n, r, i) {
      var o,
        s,
        a,
        u,
        l,
        c,
        f,
        p,
        d,
        h,
        g,
        v = R.get(t);
      if (v)
        for (
          n.handler && ((n = (o = n).handler), (i = o.selector)),
            n.guid || (n.guid = j.guid++),
            (u = v.events) || (u = v.events = {}),
            (s = v.handle) ||
              (s = v.handle =
                function (e) {
                  return void 0 !== j && j.event.triggered !== e.type
                    ? j.event.dispatch.apply(t, arguments)
                    : void 0;
                }),
            l = (e = (e || "").match(q) || [""]).length;
          l--;

        )
          (d = g = (a = oe.exec(e[l]) || [])[1]),
            (h = (a[2] || "").split(".").sort()),
            d &&
              ((f = j.event.special[d] || {}),
              (d = (i ? f.delegateType : f.bindType) || d),
              (f = j.event.special[d] || {}),
              (c = j.extend(
                {
                  type: d,
                  origType: g,
                  data: r,
                  handler: n,
                  guid: n.guid,
                  selector: i,
                  needsContext: i && j.expr.match.needsContext.test(i),
                  namespace: h.join("."),
                },
                o
              )),
              (p = u[d]) ||
                (((p = u[d] = []).delegateCount = 0),
                (f.setup && !1 !== f.setup.call(t, r, h, s)) ||
                  (t.addEventListener && t.addEventListener(d, s))),
              f.add &&
                (f.add.call(t, c), c.handler.guid || (c.handler.guid = n.guid)),
              i ? p.splice(p.delegateCount++, 0, c) : p.push(c),
              (j.event.global[d] = !0));
    },
    remove: function (e, t, n, r, i) {
      var o,
        s,
        a,
        u,
        l,
        c,
        f,
        p,
        d,
        h,
        g,
        v = R.hasData(e) && R.get(e);
      if (v && (u = v.events)) {
        for (l = (t = (t || "").match(q) || [""]).length; l--; )
          if (
            ((d = g = (a = oe.exec(t[l]) || [])[1]),
            (h = (a[2] || "").split(".").sort()),
            d)
          ) {
            for (
              f = j.event.special[d] || {},
                p = u[(d = (r ? f.delegateType : f.bindType) || d)] || [],
                a =
                  a[2] &&
                  new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"),
                s = o = p.length;
              o--;

            )
              (c = p[o]),
                (!i && g !== c.origType) ||
                  (n && n.guid !== c.guid) ||
                  (a && !a.test(c.namespace)) ||
                  (r && r !== c.selector && ("**" !== r || !c.selector)) ||
                  (p.splice(o, 1),
                  c.selector && p.delegateCount--,
                  f.remove && f.remove.call(e, c));
            s &&
              !p.length &&
              ((f.teardown && !1 !== f.teardown.call(e, h, v.handle)) ||
                j.removeEvent(e, d, v.handle),
              delete u[d]);
          } else for (d in u) j.event.remove(e, d + t[l], n, r, !0);
        j.isEmptyObject(u) && R.remove(e, "handle events");
      }
    },
    dispatch: function (e) {
      e = j.event.fix(e);
      var t,
        n,
        r,
        i,
        o,
        s,
        a = c.call(arguments),
        u = (R.get(this, "events") || {})[e.type] || [],
        l = j.event.special[e.type] || {};
      if (
        (((a[0] = e).delegateTarget = this),
        !l.preDispatch || !1 !== l.preDispatch.call(this, e))
      ) {
        for (
          s = j.event.handlers.call(this, e, u), t = 0;
          (i = s[t++]) && !e.isPropagationStopped();

        )
          for (
            e.currentTarget = i.elem, n = 0;
            (o = i.handlers[n++]) && !e.isImmediatePropagationStopped();

          )
            (e.rnamespace && !e.rnamespace.test(o.namespace)) ||
              ((e.handleObj = o),
              (e.data = o.data),
              void 0 !==
                (r = (
                  (j.event.special[o.origType] || {}).handle || o.handler
                ).apply(i.elem, a)) &&
                !1 === (e.result = r) &&
                (e.preventDefault(), e.stopPropagation()));
        return l.postDispatch && l.postDispatch.call(this, e), e.result;
      }
    },
    handlers: function (e, t) {
      var n,
        r,
        i,
        o,
        s = [],
        a = t.delegateCount,
        u = e.target;
      if (
        a &&
        u.nodeType &&
        ("click" !== e.type || isNaN(e.button) || e.button < 1)
      )
        for (; u !== this; u = u.parentNode || this)
          if (1 === u.nodeType && (!0 !== u.disabled || "click" !== e.type)) {
            for (r = [], n = 0; n < a; n++)
              void 0 === r[(i = (o = t[n]).selector + " ")] &&
                (r[i] = o.needsContext
                  ? -1 < j(i, this).index(u)
                  : j.find(i, this, null, [u]).length),
                r[i] && r.push(o);
            r.length && s.push({ elem: u, handlers: r });
          }
      return a < t.length && s.push({ elem: this, handlers: t.slice(a) }), s;
    },
    props:
      "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(
        " "
      ),
    fixHooks: {},
    keyHooks: {
      props: "char charCode key keyCode".split(" "),
      filter: function (e, t) {
        return (
          null == e.which &&
            (e.which = null != t.charCode ? t.charCode : t.keyCode),
          e
        );
      },
    },
    mouseHooks: {
      props:
        "button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(
          " "
        ),
      filter: function (e, t) {
        var n,
          r,
          i,
          o = t.button;
        return (
          null == e.pageX &&
            null != t.clientX &&
            ((r = (n = e.target.ownerDocument || k).documentElement),
            (i = n.body),
            (e.pageX =
              t.clientX +
              ((r && r.scrollLeft) || (i && i.scrollLeft) || 0) -
              ((r && r.clientLeft) || (i && i.clientLeft) || 0)),
            (e.pageY =
              t.clientY +
              ((r && r.scrollTop) || (i && i.scrollTop) || 0) -
              ((r && r.clientTop) || (i && i.clientTop) || 0))),
          e.which ||
            void 0 === o ||
            (e.which = 1 & o ? 1 : 2 & o ? 3 : 4 & o ? 2 : 0),
          e
        );
      },
    },
    fix: function (e) {
      if (e[j.expando]) return e;
      var t,
        n,
        r,
        i = e.type,
        o = e,
        s = this.fixHooks[i];
      for (
        s ||
          (this.fixHooks[i] = s =
            ie.test(i) ? this.mouseHooks : re.test(i) ? this.keyHooks : {}),
          r = s.props ? this.props.concat(s.props) : this.props,
          e = new j.Event(o),
          t = r.length;
        t--;

      )
        e[(n = r[t])] = o[n];
      return (
        e.target || (e.target = k),
        3 === e.target.nodeType && (e.target = e.target.parentNode),
        s.filter ? s.filter(e, o) : e
      );
    },
    special: {
      load: { noBubble: !0 },
      focus: {
        trigger: function () {
          if (this !== ue() && this.focus) return this.focus(), !1;
        },
        delegateType: "focusin",
      },
      blur: {
        trigger: function () {
          if (this === ue() && this.blur) return this.blur(), !1;
        },
        delegateType: "focusout",
      },
      click: {
        trigger: function () {
          if (
            "checkbox" === this.type &&
            this.click &&
            j.nodeName(this, "input")
          )
            return this.click(), !1;
        },
        _default: function (e) {
          return j.nodeName(e.target, "a");
        },
      },
      beforeunload: {
        postDispatch: function (e) {
          void 0 !== e.result &&
            e.originalEvent &&
            (e.originalEvent.returnValue = e.result);
        },
      },
    },
  }),
    (j.removeEvent = function (e, t, n) {
      e.removeEventListener && e.removeEventListener(t, n);
    }),
    (j.Event = function (e, t) {
      if (!(this instanceof j.Event)) return new j.Event(e, t);
      e && e.type
        ? ((this.originalEvent = e),
          (this.type = e.type),
          (this.isDefaultPrevented =
            e.defaultPrevented ||
            (void 0 === e.defaultPrevented && !1 === e.returnValue)
              ? se
              : ae))
        : (this.type = e),
        t && j.extend(this, t),
        (this.timeStamp = (e && e.timeStamp) || j.now()),
        (this[j.expando] = !0);
    }),
    (j.Event.prototype = {
      constructor: j.Event,
      isDefaultPrevented: ae,
      isPropagationStopped: ae,
      isImmediatePropagationStopped: ae,
      isSimulated: !1,
      preventDefault: function () {
        var e = this.originalEvent;
        (this.isDefaultPrevented = se),
          e && !this.isSimulated && e.preventDefault();
      },
      stopPropagation: function () {
        var e = this.originalEvent;
        (this.isPropagationStopped = se),
          e && !this.isSimulated && e.stopPropagation();
      },
      stopImmediatePropagation: function () {
        var e = this.originalEvent;
        (this.isImmediatePropagationStopped = se),
          e && !this.isSimulated && e.stopImmediatePropagation(),
          this.stopPropagation();
      },
    }),
    j.each(
      {
        mouseenter: "mouseover",
        mouseleave: "mouseout",
        pointerenter: "pointerover",
        pointerleave: "pointerout",
      },
      function (e, i) {
        j.event.special[e] = {
          delegateType: i,
          bindType: i,
          handle: function (e) {
            var t,
              n = e.relatedTarget,
              r = e.handleObj;
            return (
              (n && (n === this || j.contains(this, n))) ||
                ((e.type = r.origType),
                (t = r.handler.apply(this, arguments)),
                (e.type = i)),
              t
            );
          },
        };
      }
    ),
    j.fn.extend({
      on: function (e, t, n, r) {
        return le(this, e, t, n, r);
      },
      one: function (e, t, n, r) {
        return le(this, e, t, n, r, 1);
      },
      off: function (e, t, n) {
        var r, i;
        if (e && e.preventDefault && e.handleObj)
          return (
            (r = e.handleObj),
            j(e.delegateTarget).off(
              r.namespace ? r.origType + "." + r.namespace : r.origType,
              r.selector,
              r.handler
            ),
            this
          );
        if ("object" != typeof e)
          return (
            (!1 !== t && "function" != typeof t) || ((n = t), (t = void 0)),
            !1 === n && (n = ae),
            this.each(function () {
              j.event.remove(this, e, n, t);
            })
          );
        for (i in e) this.off(i, t, e[i]);
        return this;
      },
    });
  var ce =
      /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,
    fe = /<script|<style|<link/i,
    pe = /checked\s*(?:[^=]|=\s*.checked.)/i,
    de = /^true\/(.*)/,
    he = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
  function ge(e, t) {
    return j.nodeName(e, "table") &&
      j.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr")
      ? e.getElementsByTagName("tbody")[0] ||
          e.appendChild(e.ownerDocument.createElement("tbody"))
      : e;
  }
  function ve(e) {
    return (e.type = (null !== e.getAttribute("type")) + "/" + e.type), e;
  }
  function me(e) {
    var t = de.exec(e.type);
    return t ? (e.type = t[1]) : e.removeAttribute("type"), e;
  }
  function ye(e, t) {
    var n, r, i, o, s, a, u, l;
    if (1 === t.nodeType) {
      if (
        R.hasData(e) &&
        ((o = R.access(e)), (s = R.set(t, o)), (l = o.events))
      )
        for (i in (delete s.handle, (s.events = {}), l))
          for (n = 0, r = l[i].length; n < r; n++) j.event.add(t, i, l[i][n]);
      P.hasData(e) && ((a = P.access(e)), (u = j.extend({}, a)), P.set(t, u));
    }
  }
  function xe(e, t) {
    var n = t.nodeName.toLowerCase();
    "input" === n && U.test(e.type)
      ? (t.checked = e.checked)
      : ("input" !== n && "textarea" !== n) ||
        (t.defaultValue = e.defaultValue);
  }
  function be(n, r, i, o) {
    r = g.apply([], r);
    var e,
      t,
      s,
      a,
      u,
      l,
      c = 0,
      f = n.length,
      p = f - 1,
      d = r[0],
      h = j.isFunction(d);
    if (h || (1 < f && "string" == typeof d && !v.checkClone && pe.test(d)))
      return n.each(function (e) {
        var t = n.eq(e);
        h && (r[0] = d.call(this, e, t.html())), be(t, r, i, o);
      });
    if (
      f &&
      ((t = (e = ne(r, n[0].ownerDocument, !1, n, o)).firstChild),
      1 === e.childNodes.length && (e = t),
      t || o)
    ) {
      for (a = (s = j.map(Y(e, "script"), ve)).length; c < f; c++)
        (u = e),
          c !== p &&
            ((u = j.clone(u, !0, !0)), a && j.merge(s, Y(u, "script"))),
          i.call(n[c], u, c);
      if (a)
        for (l = s[s.length - 1].ownerDocument, j.map(s, me), c = 0; c < a; c++)
          (u = s[c]),
            J.test(u.type || "") &&
              !R.access(u, "globalEval") &&
              j.contains(l, u) &&
              (u.src
                ? j._evalUrl && j._evalUrl(u.src)
                : j.globalEval(u.textContent.replace(he, "")));
    }
    return n;
  }
  function we(e, t, n) {
    for (var r, i = t ? j.filter(t, e) : e, o = 0; null != (r = i[o]); o++)
      n || 1 !== r.nodeType || j.cleanData(Y(r)),
        r.parentNode &&
          (n && j.contains(r.ownerDocument, r) && K(Y(r, "script")),
          r.parentNode.removeChild(r));
    return e;
  }
  j.extend({
    htmlPrefilter: function (e) {
      return e.replace(ce, "<$1></$2>");
    },
    clone: function (e, t, n) {
      var r,
        i,
        o,
        s,
        a = e.cloneNode(!0),
        u = j.contains(e.ownerDocument, e);
      if (
        !(
          v.noCloneChecked ||
          (1 !== e.nodeType && 11 !== e.nodeType) ||
          j.isXMLDoc(e)
        )
      )
        for (s = Y(a), r = 0, i = (o = Y(e)).length; r < i; r++) xe(o[r], s[r]);
      if (t)
        if (n)
          for (o = o || Y(e), s = s || Y(a), r = 0, i = o.length; r < i; r++)
            ye(o[r], s[r]);
        else ye(e, a);
      return 0 < (s = Y(a, "script")).length && K(s, !u && Y(e, "script")), a;
    },
    cleanData: function (e) {
      for (var t, n, r, i = j.event.special, o = 0; void 0 !== (n = e[o]); o++)
        if (M(n)) {
          if ((t = n[R.expando])) {
            if (t.events)
              for (r in t.events)
                i[r] ? j.event.remove(n, r) : j.removeEvent(n, r, t.handle);
            n[R.expando] = void 0;
          }
          n[P.expando] && (n[P.expando] = void 0);
        }
    },
  }),
    j.fn.extend({
      domManip: be,
      detach: function (e) {
        return we(this, e, !0);
      },
      remove: function (e) {
        return we(this, e);
      },
      text: function (e) {
        return O(
          this,
          function (e) {
            return void 0 === e
              ? j.text(this)
              : this.empty().each(function () {
                  (1 !== this.nodeType &&
                    11 !== this.nodeType &&
                    9 !== this.nodeType) ||
                    (this.textContent = e);
                });
          },
          null,
          e,
          arguments.length
        );
      },
      append: function () {
        return be(this, arguments, function (e) {
          (1 !== this.nodeType &&
            11 !== this.nodeType &&
            9 !== this.nodeType) ||
            ge(this, e).appendChild(e);
        });
      },
      prepend: function () {
        return be(this, arguments, function (e) {
          if (
            1 === this.nodeType ||
            11 === this.nodeType ||
            9 === this.nodeType
          ) {
            var t = ge(this, e);
            t.insertBefore(e, t.firstChild);
          }
        });
      },
      before: function () {
        return be(this, arguments, function (e) {
          this.parentNode && this.parentNode.insertBefore(e, this);
        });
      },
      after: function () {
        return be(this, arguments, function (e) {
          this.parentNode && this.parentNode.insertBefore(e, this.nextSibling);
        });
      },
      empty: function () {
        for (var e, t = 0; null != (e = this[t]); t++)
          1 === e.nodeType && (j.cleanData(Y(e, !1)), (e.textContent = ""));
        return this;
      },
      clone: function (e, t) {
        return (
          (e = null != e && e),
          (t = null == t ? e : t),
          this.map(function () {
            return j.clone(this, e, t);
          })
        );
      },
      html: function (e) {
        return O(
          this,
          function (e) {
            var t = this[0] || {},
              n = 0,
              r = this.length;
            if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
            if (
              "string" == typeof e &&
              !fe.test(e) &&
              !G[(V.exec(e) || ["", ""])[1].toLowerCase()]
            ) {
              e = j.htmlPrefilter(e);
              try {
                for (; n < r; n++)
                  1 === (t = this[n] || {}).nodeType &&
                    (j.cleanData(Y(t, !1)), (t.innerHTML = e));
                t = 0;
              } catch (e) {}
            }
            t && this.empty().append(e);
          },
          null,
          e,
          arguments.length
        );
      },
      replaceWith: function () {
        var n = [];
        return be(
          this,
          arguments,
          function (e) {
            var t = this.parentNode;
            j.inArray(this, n) < 0 &&
              (j.cleanData(Y(this)), t && t.replaceChild(e, this));
          },
          n
        );
      },
    }),
    j.each(
      {
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith",
      },
      function (e, s) {
        j.fn[e] = function (e) {
          for (var t, n = [], r = j(e), i = r.length - 1, o = 0; o <= i; o++)
            (t = o === i ? this : this.clone(!0)),
              j(r[o])[s](t),
              a.apply(n, t.get());
          return this.pushStack(n);
        };
      }
    );
  var Te,
    Ce = { HTML: "block", BODY: "block" };
  function ke(e, t) {
    var n = j(t.createElement(e)).appendTo(t.body),
      r = j.css(n[0], "display");
    return n.detach(), r;
  }
  function je(e) {
    var t = k,
      n = Ce[e];
    return (
      n ||
        (("none" !== (n = ke(e, t)) && n) ||
          ((t = (Te = (
            Te || j("<iframe frameborder='0' width='0' height='0'/>")
          ).appendTo(t.documentElement))[0].contentDocument).write(),
          t.close(),
          (n = ke(e, t)),
          Te.detach()),
        (Ce[e] = n)),
      n
    );
  }
  var Se = /^margin/,
    Ne = new RegExp("^(" + B + ")(?!px)[a-z%]+$", "i"),
    Ee = function (e) {
      var t = e.ownerDocument.defaultView;
      return (t && t.opener) || (t = C), t.getComputedStyle(e);
    },
    Ae = function (e, t, n, r) {
      var i,
        o,
        s = {};
      for (o in t) (s[o] = e.style[o]), (e.style[o] = t[o]);
      for (o in ((i = n.apply(e, r || [])), t)) e.style[o] = s[o];
      return i;
    },
    De = k.documentElement;
  function Le(e, t, n) {
    var r,
      i,
      o,
      s,
      a = e.style;
    return (
      ("" !== (s = (n = n || Ee(e)) ? n.getPropertyValue(t) || n[t] : void 0) &&
        void 0 !== s) ||
        j.contains(e.ownerDocument, e) ||
        (s = j.style(e, t)),
      n &&
        !v.pixelMarginRight() &&
        Ne.test(s) &&
        Se.test(t) &&
        ((r = a.width),
        (i = a.minWidth),
        (o = a.maxWidth),
        (a.minWidth = a.maxWidth = a.width = s),
        (s = n.width),
        (a.width = r),
        (a.minWidth = i),
        (a.maxWidth = o)),
      void 0 !== s ? s + "" : s
    );
  }
  function qe(e, t) {
    return {
      get: function () {
        if (!e()) return (this.get = t).apply(this, arguments);
        delete this.get;
      },
    };
  }
  !(function () {
    var t,
      n,
      r,
      i,
      o = k.createElement("div"),
      s = k.createElement("div");
    function e() {
      (s.style.cssText =
        "-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%"),
        (s.innerHTML = ""),
        De.appendChild(o);
      var e = C.getComputedStyle(s);
      (t = "1%" !== e.top),
        (i = "2px" === e.marginLeft),
        (n = "4px" === e.width),
        (s.style.marginRight = "50%"),
        (r = "4px" === e.marginRight),
        De.removeChild(o);
    }
    s.style &&
      ((s.style.backgroundClip = "content-box"),
      (s.cloneNode(!0).style.backgroundClip = ""),
      (v.clearCloneStyle = "content-box" === s.style.backgroundClip),
      (o.style.cssText =
        "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute"),
      o.appendChild(s),
      j.extend(v, {
        pixelPosition: function () {
          return e(), t;
        },
        boxSizingReliable: function () {
          return null == n && e(), n;
        },
        pixelMarginRight: function () {
          return null == n && e(), r;
        },
        reliableMarginLeft: function () {
          return null == n && e(), i;
        },
        reliableMarginRight: function () {
          var e,
            t = s.appendChild(k.createElement("div"));
          return (
            (t.style.cssText = s.style.cssText =
              "-webkit-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0"),
            (t.style.marginRight = t.style.width = "0"),
            (s.style.width = "1px"),
            De.appendChild(o),
            (e = !parseFloat(C.getComputedStyle(t).marginRight)),
            De.removeChild(o),
            s.removeChild(t),
            e
          );
        },
      }));
  })();
  var He = /^(none|table(?!-c[ea]).+)/,
    Oe = { position: "absolute", visibility: "hidden", display: "block" },
    Me = { letterSpacing: "0", fontWeight: "400" },
    Fe = ["Webkit", "O", "Moz", "ms"],
    Re = k.createElement("div").style;
  function Pe(e) {
    if (e in Re) return e;
    for (var t = e[0].toUpperCase() + e.slice(1), n = Fe.length; n--; )
      if ((e = Fe[n] + t) in Re) return e;
  }
  function Ie(e, t, n) {
    var r = _.exec(t);
    return r ? Math.max(0, r[2] - (n || 0)) + (r[3] || "px") : t;
  }
  function We(e, t, n, r, i) {
    for (
      var o = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0,
        s = 0;
      o < 4;
      o += 2
    )
      "margin" === n && (s += j.css(e, n + Q[o], !0, i)),
        r
          ? ("content" === n && (s -= j.css(e, "padding" + Q[o], !0, i)),
            "margin" !== n && (s -= j.css(e, "border" + Q[o] + "Width", !0, i)))
          : ((s += j.css(e, "padding" + Q[o], !0, i)),
            "padding" !== n &&
              (s += j.css(e, "border" + Q[o] + "Width", !0, i)));
    return s;
  }
  function $e(e, t, n) {
    var r = !0,
      i = "width" === t ? e.offsetWidth : e.offsetHeight,
      o = Ee(e),
      s = "border-box" === j.css(e, "boxSizing", !1, o);
    if (i <= 0 || null == i) {
      if (
        (((i = Le(e, t, o)) < 0 || null == i) && (i = e.style[t]), Ne.test(i))
      )
        return i;
      (r = s && (v.boxSizingReliable() || i === e.style[t])),
        (i = parseFloat(i) || 0);
    }
    return i + We(e, t, n || (s ? "border" : "content"), r, o) + "px";
  }
  function Be(e, t) {
    for (var n, r, i, o = [], s = 0, a = e.length; s < a; s++)
      (r = e[s]).style &&
        ((o[s] = R.get(r, "olddisplay")),
        (n = r.style.display),
        t
          ? (o[s] || "none" !== n || (r.style.display = ""),
            "" === r.style.display &&
              z(r) &&
              (o[s] = R.access(r, "olddisplay", je(r.nodeName))))
          : ((i = z(r)),
            ("none" === n && i) ||
              R.set(r, "olddisplay", i ? n : j.css(r, "display"))));
    for (s = 0; s < a; s++)
      (r = e[s]).style &&
        ((t && "none" !== r.style.display && "" !== r.style.display) ||
          (r.style.display = t ? o[s] || "" : "none"));
    return e;
  }
  function _e(e, t, n, r, i) {
    return new _e.prototype.init(e, t, n, r, i);
  }
  j.extend({
    cssHooks: {
      opacity: {
        get: function (e, t) {
          if (t) {
            var n = Le(e, "opacity");
            return "" === n ? "1" : n;
          }
        },
      },
    },
    cssNumber: {
      animationIterationCount: !0,
      columnCount: !0,
      fillOpacity: !0,
      flexGrow: !0,
      flexShrink: !0,
      fontWeight: !0,
      lineHeight: !0,
      opacity: !0,
      order: !0,
      orphans: !0,
      widows: !0,
      zIndex: !0,
      zoom: !0,
    },
    cssProps: { float: "cssFloat" },
    style: function (e, t, n, r) {
      if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
        var i,
          o,
          s,
          a = j.camelCase(t),
          u = e.style;
        if (
          ((t = j.cssProps[a] || (j.cssProps[a] = Pe(a) || a)),
          (s = j.cssHooks[t] || j.cssHooks[a]),
          void 0 === n)
        )
          return s && "get" in s && void 0 !== (i = s.get(e, !1, r)) ? i : u[t];
        "string" === (o = typeof n) &&
          (i = _.exec(n)) &&
          i[1] &&
          ((n = X(e, t, i)), (o = "number")),
          null != n &&
            n == n &&
            ("number" === o &&
              (n += (i && i[3]) || (j.cssNumber[a] ? "" : "px")),
            v.clearCloneStyle ||
              "" !== n ||
              0 !== t.indexOf("background") ||
              (u[t] = "inherit"),
            (s && "set" in s && void 0 === (n = s.set(e, n, r))) || (u[t] = n));
      }
    },
    css: function (e, t, n, r) {
      var i,
        o,
        s,
        a = j.camelCase(t);
      return (
        (t = j.cssProps[a] || (j.cssProps[a] = Pe(a) || a)),
        (s = j.cssHooks[t] || j.cssHooks[a]) &&
          "get" in s &&
          (i = s.get(e, !0, n)),
        void 0 === i && (i = Le(e, t, r)),
        "normal" === i && t in Me && (i = Me[t]),
        "" === n || n
          ? ((o = parseFloat(i)), !0 === n || isFinite(o) ? o || 0 : i)
          : i
      );
    },
  }),
    j.each(["height", "width"], function (e, s) {
      j.cssHooks[s] = {
        get: function (e, t, n) {
          if (t)
            return He.test(j.css(e, "display")) && 0 === e.offsetWidth
              ? Ae(e, Oe, function () {
                  return $e(e, s, n);
                })
              : $e(e, s, n);
        },
        set: function (e, t, n) {
          var r,
            i = n && Ee(e),
            o =
              n &&
              We(e, s, n, "border-box" === j.css(e, "boxSizing", !1, i), i);
          return (
            o &&
              (r = _.exec(t)) &&
              "px" !== (r[3] || "px") &&
              ((e.style[s] = t), (t = j.css(e, s))),
            Ie(0, t, o)
          );
        },
      };
    }),
    (j.cssHooks.marginLeft = qe(v.reliableMarginLeft, function (e, t) {
      if (t)
        return (
          (parseFloat(Le(e, "marginLeft")) ||
            e.getBoundingClientRect().left -
              Ae(e, { marginLeft: 0 }, function () {
                return e.getBoundingClientRect().left;
              })) + "px"
        );
    })),
    (j.cssHooks.marginRight = qe(v.reliableMarginRight, function (e, t) {
      if (t) return Ae(e, { display: "inline-block" }, Le, [e, "marginRight"]);
    })),
    j.each({ margin: "", padding: "", border: "Width" }, function (i, o) {
      (j.cssHooks[i + o] = {
        expand: function (e) {
          for (
            var t = 0, n = {}, r = "string" == typeof e ? e.split(" ") : [e];
            t < 4;
            t++
          )
            n[i + Q[t] + o] = r[t] || r[t - 2] || r[0];
          return n;
        },
      }),
        Se.test(i) || (j.cssHooks[i + o].set = Ie);
    }),
    j.fn.extend({
      css: function (e, t) {
        return O(
          this,
          function (e, t, n) {
            var r,
              i,
              o = {},
              s = 0;
            if (j.isArray(t)) {
              for (r = Ee(e), i = t.length; s < i; s++)
                o[t[s]] = j.css(e, t[s], !1, r);
              return o;
            }
            return void 0 !== n ? j.style(e, t, n) : j.css(e, t);
          },
          e,
          t,
          1 < arguments.length
        );
      },
      show: function () {
        return Be(this, !0);
      },
      hide: function () {
        return Be(this);
      },
      toggle: function (e) {
        return "boolean" == typeof e
          ? e
            ? this.show()
            : this.hide()
          : this.each(function () {
              z(this) ? j(this).show() : j(this).hide();
            });
      },
    }),
    (((j.Tween = _e).prototype = {
      constructor: _e,
      init: function (e, t, n, r, i, o) {
        (this.elem = e),
          (this.prop = n),
          (this.easing = i || j.easing._default),
          (this.options = t),
          (this.start = this.now = this.cur()),
          (this.end = r),
          (this.unit = o || (j.cssNumber[n] ? "" : "px"));
      },
      cur: function () {
        var e = _e.propHooks[this.prop];
        return e && e.get ? e.get(this) : _e.propHooks._default.get(this);
      },
      run: function (e) {
        var t,
          n = _e.propHooks[this.prop];
        return (
          this.options.duration
            ? (this.pos = t =
                j.easing[this.easing](
                  e,
                  this.options.duration * e,
                  0,
                  1,
                  this.options.duration
                ))
            : (this.pos = t = e),
          (this.now = (this.end - this.start) * t + this.start),
          this.options.step &&
            this.options.step.call(this.elem, this.now, this),
          n && n.set ? n.set(this) : _e.propHooks._default.set(this),
          this
        );
      },
    }).init.prototype = _e.prototype),
    ((_e.propHooks = {
      _default: {
        get: function (e) {
          var t;
          return 1 !== e.elem.nodeType ||
            (null != e.elem[e.prop] && null == e.elem.style[e.prop])
            ? e.elem[e.prop]
            : (t = j.css(e.elem, e.prop, "")) && "auto" !== t
            ? t
            : 0;
        },
        set: function (e) {
          j.fx.step[e.prop]
            ? j.fx.step[e.prop](e)
            : 1 !== e.elem.nodeType ||
              (null == e.elem.style[j.cssProps[e.prop]] && !j.cssHooks[e.prop])
            ? (e.elem[e.prop] = e.now)
            : j.style(e.elem, e.prop, e.now + e.unit);
        },
      },
    }).scrollTop = _e.propHooks.scrollLeft =
      {
        set: function (e) {
          e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now);
        },
      }),
    (j.easing = {
      linear: function (e) {
        return e;
      },
      swing: function (e) {
        return 0.5 - Math.cos(e * Math.PI) / 2;
      },
      _default: "swing",
    }),
    (j.fx = _e.prototype.init),
    (j.fx.step = {});
  var Qe,
    ze,
    Xe,
    Ue,
    Ve,
    Je = /^(?:toggle|show|hide)$/,
    Ge = /queueHooks$/;
  function Ye() {
    return (
      C.setTimeout(function () {
        Qe = void 0;
      }),
      (Qe = j.now())
    );
  }
  function Ke(e, t) {
    var n,
      r = 0,
      i = { height: e };
    for (t = t ? 1 : 0; r < 4; r += 2 - t)
      i["margin" + (n = Q[r])] = i["padding" + n] = e;
    return t && (i.opacity = i.width = e), i;
  }
  function Ze(e, t, n) {
    for (
      var r,
        i = (et.tweeners[t] || []).concat(et.tweeners["*"]),
        o = 0,
        s = i.length;
      o < s;
      o++
    )
      if ((r = i[o].call(n, t, e))) return r;
  }
  function et(o, e, t) {
    var n,
      s,
      r = 0,
      i = et.prefilters.length,
      a = j.Deferred().always(function () {
        delete u.elem;
      }),
      u = function () {
        if (s) return !1;
        for (
          var e = Qe || Ye(),
            t = Math.max(0, l.startTime + l.duration - e),
            n = 1 - (t / l.duration || 0),
            r = 0,
            i = l.tweens.length;
          r < i;
          r++
        )
          l.tweens[r].run(n);
        return (
          a.notifyWith(o, [l, n, t]),
          n < 1 && i ? t : (a.resolveWith(o, [l]), !1)
        );
      },
      l = a.promise({
        elem: o,
        props: j.extend({}, e),
        opts: j.extend(!0, { specialEasing: {}, easing: j.easing._default }, t),
        originalProperties: e,
        originalOptions: t,
        startTime: Qe || Ye(),
        duration: t.duration,
        tweens: [],
        createTween: function (e, t) {
          var n = j.Tween(
            o,
            l.opts,
            e,
            t,
            l.opts.specialEasing[e] || l.opts.easing
          );
          return l.tweens.push(n), n;
        },
        stop: function (e) {
          var t = 0,
            n = e ? l.tweens.length : 0;
          if (s) return this;
          for (s = !0; t < n; t++) l.tweens[t].run(1);
          return (
            e
              ? (a.notifyWith(o, [l, 1, 0]), a.resolveWith(o, [l, e]))
              : a.rejectWith(o, [l, e]),
            this
          );
        },
      }),
      c = l.props;
    for (
      !(function (e, t) {
        var n, r, i, o, s;
        for (n in e)
          if (
            ((i = t[(r = j.camelCase(n))]),
            (o = e[n]),
            j.isArray(o) && ((i = o[1]), (o = e[n] = o[0])),
            n !== r && ((e[r] = o), delete e[n]),
            (s = j.cssHooks[r]) && ("expand" in s))
          )
            for (n in ((o = s.expand(o)), delete e[r], o))
              (n in e) || ((e[n] = o[n]), (t[n] = i));
          else t[r] = i;
      })(c, l.opts.specialEasing);
      r < i;
      r++
    )
      if ((n = et.prefilters[r].call(l, o, c, l.opts)))
        return (
          j.isFunction(n.stop) &&
            (j._queueHooks(l.elem, l.opts.queue).stop = j.proxy(n.stop, n)),
          n
        );
    return (
      j.map(c, Ze, l),
      j.isFunction(l.opts.start) && l.opts.start.call(o, l),
      j.fx.timer(j.extend(u, { elem: o, anim: l, queue: l.opts.queue })),
      l
        .progress(l.opts.progress)
        .done(l.opts.done, l.opts.complete)
        .fail(l.opts.fail)
        .always(l.opts.always)
    );
  }
  (j.Animation = j.extend(et, {
    tweeners: {
      "*": [
        function (e, t) {
          var n = this.createTween(e, t);
          return X(n.elem, e, _.exec(t), n), n;
        },
      ],
    },
    tweener: function (e, t) {
      for (
        var n,
          r = 0,
          i = (e = j.isFunction(e) ? ((t = e), ["*"]) : e.match(q)).length;
        r < i;
        r++
      )
        (n = e[r]),
          (et.tweeners[n] = et.tweeners[n] || []),
          et.tweeners[n].unshift(t);
    },
    prefilters: [
      function (t, e, n) {
        var r,
          i,
          o,
          s,
          a,
          u,
          l,
          c = this,
          f = {},
          p = t.style,
          d = t.nodeType && z(t),
          h = R.get(t, "fxshow");
        for (r in (n.queue ||
          (null == (a = j._queueHooks(t, "fx")).unqueued &&
            ((a.unqueued = 0),
            (u = a.empty.fire),
            (a.empty.fire = function () {
              a.unqueued || u();
            })),
          a.unqueued++,
          c.always(function () {
            c.always(function () {
              a.unqueued--, j.queue(t, "fx").length || a.empty.fire();
            });
          })),
        1 === t.nodeType &&
          ("height" in e || "width" in e) &&
          ((n.overflow = [p.overflow, p.overflowX, p.overflowY]),
          "inline" ===
            ("none" === (l = j.css(t, "display"))
              ? R.get(t, "olddisplay") || je(t.nodeName)
              : l) &&
            "none" === j.css(t, "float") &&
            (p.display = "inline-block")),
        n.overflow &&
          ((p.overflow = "hidden"),
          c.always(function () {
            (p.overflow = n.overflow[0]),
              (p.overflowX = n.overflow[1]),
              (p.overflowY = n.overflow[2]);
          })),
        e))
          if (((i = e[r]), Je.exec(i))) {
            if (
              (delete e[r],
              (o = o || "toggle" === i),
              i === (d ? "hide" : "show"))
            ) {
              if ("show" !== i || !h || void 0 === h[r]) continue;
              d = !0;
            }
            f[r] = (h && h[r]) || j.style(t, r);
          } else l = void 0;
        if (j.isEmptyObject(f))
          "inline" === ("none" === l ? je(t.nodeName) : l) && (p.display = l);
        else
          for (r in (h
            ? "hidden" in h && (d = h.hidden)
            : (h = R.access(t, "fxshow", {})),
          o && (h.hidden = !d),
          d
            ? j(t).show()
            : c.done(function () {
                j(t).hide();
              }),
          c.done(function () {
            var e;
            for (e in (R.remove(t, "fxshow"), f)) j.style(t, e, f[e]);
          }),
          f))
            (s = Ze(d ? h[r] : 0, r, c)),
              r in h ||
                ((h[r] = s.start),
                d &&
                  ((s.end = s.start),
                  (s.start = "width" === r || "height" === r ? 1 : 0)));
      },
    ],
    prefilter: function (e, t) {
      t ? et.prefilters.unshift(e) : et.prefilters.push(e);
    },
  })),
    (j.speed = function (e, t, n) {
      var r =
        e && "object" == typeof e
          ? j.extend({}, e)
          : {
              complete: n || (!n && t) || (j.isFunction(e) && e),
              duration: e,
              easing: (n && t) || (t && !j.isFunction(t) && t),
            };
      return (
        (r.duration = j.fx.off
          ? 0
          : "number" == typeof r.duration
          ? r.duration
          : r.duration in j.fx.speeds
          ? j.fx.speeds[r.duration]
          : j.fx.speeds._default),
        (null != r.queue && !0 !== r.queue) || (r.queue = "fx"),
        (r.old = r.complete),
        (r.complete = function () {
          j.isFunction(r.old) && r.old.call(this),
            r.queue && j.dequeue(this, r.queue);
        }),
        r
      );
    }),
    j.fn.extend({
      fadeTo: function (e, t, n, r) {
        return this.filter(z)
          .css("opacity", 0)
          .show()
          .end()
          .animate({ opacity: t }, e, n, r);
      },
      animate: function (t, e, n, r) {
        var i = j.isEmptyObject(t),
          o = j.speed(e, n, r),
          s = function () {
            var e = et(this, j.extend({}, t), o);
            (i || R.get(this, "finish")) && e.stop(!0);
          };
        return (
          (s.finish = s),
          i || !1 === o.queue ? this.each(s) : this.queue(o.queue, s)
        );
      },
      stop: function (i, e, o) {
        var s = function (e) {
          var t = e.stop;
          delete e.stop, t(o);
        };
        return (
          "string" != typeof i && ((o = e), (e = i), (i = void 0)),
          e && !1 !== i && this.queue(i || "fx", []),
          this.each(function () {
            var e = !0,
              t = null != i && i + "queueHooks",
              n = j.timers,
              r = R.get(this);
            if (t) r[t] && r[t].stop && s(r[t]);
            else for (t in r) r[t] && r[t].stop && Ge.test(t) && s(r[t]);
            for (t = n.length; t--; )
              n[t].elem !== this ||
                (null != i && n[t].queue !== i) ||
                (n[t].anim.stop(o), (e = !1), n.splice(t, 1));
            (!e && o) || j.dequeue(this, i);
          })
        );
      },
      finish: function (s) {
        return (
          !1 !== s && (s = s || "fx"),
          this.each(function () {
            var e,
              t = R.get(this),
              n = t[s + "queue"],
              r = t[s + "queueHooks"],
              i = j.timers,
              o = n ? n.length : 0;
            for (
              t.finish = !0,
                j.queue(this, s, []),
                r && r.stop && r.stop.call(this, !0),
                e = i.length;
              e--;

            )
              i[e].elem === this &&
                i[e].queue === s &&
                (i[e].anim.stop(!0), i.splice(e, 1));
            for (e = 0; e < o; e++)
              n[e] && n[e].finish && n[e].finish.call(this);
            delete t.finish;
          })
        );
      },
    }),
    j.each(["toggle", "show", "hide"], function (e, r) {
      var i = j.fn[r];
      j.fn[r] = function (e, t, n) {
        return null == e || "boolean" == typeof e
          ? i.apply(this, arguments)
          : this.animate(Ke(r, !0), e, t, n);
      };
    }),
    j.each(
      {
        slideDown: Ke("show"),
        slideUp: Ke("hide"),
        slideToggle: Ke("toggle"),
        fadeIn: { opacity: "show" },
        fadeOut: { opacity: "hide" },
        fadeToggle: { opacity: "toggle" },
      },
      function (e, r) {
        j.fn[e] = function (e, t, n) {
          return this.animate(r, e, t, n);
        };
      }
    ),
    (j.timers = []),
    (j.fx.tick = function () {
      var e,
        t = 0,
        n = j.timers;
      for (Qe = j.now(); t < n.length; t++)
        (e = n[t])() || n[t] !== e || n.splice(t--, 1);
      n.length || j.fx.stop(), (Qe = void 0);
    }),
    (j.fx.timer = function (e) {
      j.timers.push(e), e() ? j.fx.start() : j.timers.pop();
    }),
    (j.fx.interval = 13),
    (j.fx.start = function () {
      ze || (ze = C.setInterval(j.fx.tick, j.fx.interval));
    }),
    (j.fx.stop = function () {
      C.clearInterval(ze), (ze = null);
    }),
    (j.fx.speeds = { slow: 600, fast: 200, _default: 400 }),
    (j.fn.delay = function (r, e) {
      return (
        (r = (j.fx && j.fx.speeds[r]) || r),
        (e = e || "fx"),
        this.queue(e, function (e, t) {
          var n = C.setTimeout(e, r);
          t.stop = function () {
            C.clearTimeout(n);
          };
        })
      );
    }),
    (Xe = k.createElement("input")),
    (Ue = k.createElement("select")),
    (Ve = Ue.appendChild(k.createElement("option"))),
    (Xe.type = "checkbox"),
    (v.checkOn = "" !== Xe.value),
    (v.optSelected = Ve.selected),
    (Ue.disabled = !0),
    (v.optDisabled = !Ve.disabled),
    ((Xe = k.createElement("input")).value = "t"),
    (Xe.type = "radio"),
    (v.radioValue = "t" === Xe.value);
  var tt,
    nt = j.expr.attrHandle;
  j.fn.extend({
    attr: function (e, t) {
      return O(this, j.attr, e, t, 1 < arguments.length);
    },
    removeAttr: function (e) {
      return this.each(function () {
        j.removeAttr(this, e);
      });
    },
  }),
    j.extend({
      attr: function (e, t, n) {
        var r,
          i,
          o = e.nodeType;
        if (3 !== o && 8 !== o && 2 !== o)
          return void 0 === e.getAttribute
            ? j.prop(e, t, n)
            : ((1 === o && j.isXMLDoc(e)) ||
                ((t = t.toLowerCase()),
                (i =
                  j.attrHooks[t] || (j.expr.match.bool.test(t) ? tt : void 0))),
              void 0 !== n
                ? null === n
                  ? void j.removeAttr(e, t)
                  : i && "set" in i && void 0 !== (r = i.set(e, n, t))
                  ? r
                  : (e.setAttribute(t, n + ""), n)
                : i && "get" in i && null !== (r = i.get(e, t))
                ? r
                : null == (r = j.find.attr(e, t))
                ? void 0
                : r);
      },
      attrHooks: {
        type: {
          set: function (e, t) {
            if (!v.radioValue && "radio" === t && j.nodeName(e, "input")) {
              var n = e.value;
              return e.setAttribute("type", t), n && (e.value = n), t;
            }
          },
        },
      },
      removeAttr: function (e, t) {
        var n,
          r,
          i = 0,
          o = t && t.match(q);
        if (o && 1 === e.nodeType)
          for (; (n = o[i++]); )
            (r = j.propFix[n] || n),
              j.expr.match.bool.test(n) && (e[r] = !1),
              e.removeAttribute(n);
      },
    }),
    (tt = {
      set: function (e, t, n) {
        return !1 === t ? j.removeAttr(e, n) : e.setAttribute(n, n), n;
      },
    }),
    j.each(j.expr.match.bool.source.match(/\w+/g), function (e, t) {
      var o = nt[t] || j.find.attr;
      nt[t] = function (e, t, n) {
        var r, i;
        return (
          n ||
            ((i = nt[t]),
            (nt[t] = r),
            (r = null != o(e, t, n) ? t.toLowerCase() : null),
            (nt[t] = i)),
          r
        );
      };
    });
  var rt = /^(?:input|select|textarea|button)$/i,
    it = /^(?:a|area)$/i;
  j.fn.extend({
    prop: function (e, t) {
      return O(this, j.prop, e, t, 1 < arguments.length);
    },
    removeProp: function (e) {
      return this.each(function () {
        delete this[j.propFix[e] || e];
      });
    },
  }),
    j.extend({
      prop: function (e, t, n) {
        var r,
          i,
          o = e.nodeType;
        if (3 !== o && 8 !== o && 2 !== o)
          return (
            (1 === o && j.isXMLDoc(e)) ||
              ((t = j.propFix[t] || t), (i = j.propHooks[t])),
            void 0 !== n
              ? i && "set" in i && void 0 !== (r = i.set(e, n, t))
                ? r
                : (e[t] = n)
              : i && "get" in i && null !== (r = i.get(e, t))
              ? r
              : e[t]
          );
      },
      propHooks: {
        tabIndex: {
          get: function (e) {
            var t = j.find.attr(e, "tabindex");
            return t
              ? parseInt(t, 10)
              : rt.test(e.nodeName) || (it.test(e.nodeName) && e.href)
              ? 0
              : -1;
          },
        },
      },
      propFix: { for: "htmlFor", class: "className" },
    }),
    v.optSelected ||
      (j.propHooks.selected = {
        get: function (e) {
          var t = e.parentNode;
          return t && t.parentNode && t.parentNode.selectedIndex, null;
        },
        set: function (e) {
          var t = e.parentNode;
          t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex);
        },
      }),
    j.each(
      [
        "tabIndex",
        "readOnly",
        "maxLength",
        "cellSpacing",
        "cellPadding",
        "rowSpan",
        "colSpan",
        "useMap",
        "frameBorder",
        "contentEditable",
      ],
      function () {
        j.propFix[this.toLowerCase()] = this;
      }
    );
  var ot = /[\t\r\n\f]/g;
  function st(e) {
    return (e.getAttribute && e.getAttribute("class")) || "";
  }
  j.fn.extend({
    addClass: function (t) {
      var e,
        n,
        r,
        i,
        o,
        s,
        a,
        u = 0;
      if (j.isFunction(t))
        return this.each(function (e) {
          j(this).addClass(t.call(this, e, st(this)));
        });
      if ("string" == typeof t && t)
        for (e = t.match(q) || []; (n = this[u++]); )
          if (
            ((i = st(n)),
            (r = 1 === n.nodeType && (" " + i + " ").replace(ot, " ")))
          ) {
            for (s = 0; (o = e[s++]); )
              r.indexOf(" " + o + " ") < 0 && (r += o + " ");
            i !== (a = j.trim(r)) && n.setAttribute("class", a);
          }
      return this;
    },
    removeClass: function (t) {
      var e,
        n,
        r,
        i,
        o,
        s,
        a,
        u = 0;
      if (j.isFunction(t))
        return this.each(function (e) {
          j(this).removeClass(t.call(this, e, st(this)));
        });
      if (!arguments.length) return this.attr("class", "");
      if ("string" == typeof t && t)
        for (e = t.match(q) || []; (n = this[u++]); )
          if (
            ((i = st(n)),
            (r = 1 === n.nodeType && (" " + i + " ").replace(ot, " ")))
          ) {
            for (s = 0; (o = e[s++]); )
              for (; -1 < r.indexOf(" " + o + " "); )
                r = r.replace(" " + o + " ", " ");
            i !== (a = j.trim(r)) && n.setAttribute("class", a);
          }
      return this;
    },
    toggleClass: function (i, t) {
      var o = typeof i;
      return "boolean" == typeof t && "string" == o
        ? t
          ? this.addClass(i)
          : this.removeClass(i)
        : j.isFunction(i)
        ? this.each(function (e) {
            j(this).toggleClass(i.call(this, e, st(this), t), t);
          })
        : this.each(function () {
            var e, t, n, r;
            if ("string" == o)
              for (t = 0, n = j(this), r = i.match(q) || []; (e = r[t++]); )
                n.hasClass(e) ? n.removeClass(e) : n.addClass(e);
            else
              (void 0 !== i && "boolean" != o) ||
                ((e = st(this)) && R.set(this, "__className__", e),
                this.setAttribute &&
                  this.setAttribute(
                    "class",
                    e || !1 === i ? "" : R.get(this, "__className__") || ""
                  ));
          });
    },
    hasClass: function (e) {
      var t,
        n,
        r = 0;
      for (t = " " + e + " "; (n = this[r++]); )
        if (
          1 === n.nodeType &&
          -1 < (" " + st(n) + " ").replace(ot, " ").indexOf(t)
        )
          return !0;
      return !1;
    },
  });
  var at = /\r/g,
    ut = /[\x20\t\r\n\f]+/g;
  j.fn.extend({
    val: function (n) {
      var r,
        e,
        i,
        t = this[0];
      return arguments.length
        ? ((i = j.isFunction(n)),
          this.each(function (e) {
            var t;
            1 === this.nodeType &&
              (null == (t = i ? n.call(this, e, j(this).val()) : n)
                ? (t = "")
                : "number" == typeof t
                ? (t += "")
                : j.isArray(t) &&
                  (t = j.map(t, function (e) {
                    return null == e ? "" : e + "";
                  })),
              ((r =
                j.valHooks[this.type] ||
                j.valHooks[this.nodeName.toLowerCase()]) &&
                "set" in r &&
                void 0 !== r.set(this, t, "value")) ||
                (this.value = t));
          }))
        : t
        ? (r = j.valHooks[t.type] || j.valHooks[t.nodeName.toLowerCase()]) &&
          "get" in r &&
          void 0 !== (e = r.get(t, "value"))
          ? e
          : "string" == typeof (e = t.value)
          ? e.replace(at, "")
          : null == e
          ? ""
          : e
        : void 0;
    },
  }),
    j.extend({
      valHooks: {
        option: {
          get: function (e) {
            var t = j.find.attr(e, "value");
            return null != t ? t : j.trim(j.text(e)).replace(ut, " ");
          },
        },
        select: {
          get: function (e) {
            for (
              var t,
                n,
                r = e.options,
                i = e.selectedIndex,
                o = "select-one" === e.type || i < 0,
                s = o ? null : [],
                a = o ? i + 1 : r.length,
                u = i < 0 ? a : o ? i : 0;
              u < a;
              u++
            )
              if (
                ((n = r[u]).selected || u === i) &&
                (v.optDisabled
                  ? !n.disabled
                  : null === n.getAttribute("disabled")) &&
                (!n.parentNode.disabled ||
                  !j.nodeName(n.parentNode, "optgroup"))
              ) {
                if (((t = j(n).val()), o)) return t;
                s.push(t);
              }
            return s;
          },
          set: function (e, t) {
            for (
              var n, r, i = e.options, o = j.makeArray(t), s = i.length;
              s--;

            )
              ((r = i[s]).selected =
                -1 < j.inArray(j.valHooks.option.get(r), o)) && (n = !0);
            return n || (e.selectedIndex = -1), o;
          },
        },
      },
    }),
    j.each(["radio", "checkbox"], function () {
      (j.valHooks[this] = {
        set: function (e, t) {
          if (j.isArray(t)) return (e.checked = -1 < j.inArray(j(e).val(), t));
        },
      }),
        v.checkOn ||
          (j.valHooks[this].get = function (e) {
            return null === e.getAttribute("value") ? "on" : e.value;
          });
    });
  var lt = /^(?:focusinfocus|focusoutblur)$/;
  j.extend(j.event, {
    trigger: function (e, t, n, r) {
      var i,
        o,
        s,
        a,
        u,
        l,
        c,
        f = [n || k],
        p = h.call(e, "type") ? e.type : e,
        d = h.call(e, "namespace") ? e.namespace.split(".") : [];
      if (
        ((o = s = n = n || k),
        3 !== n.nodeType &&
          8 !== n.nodeType &&
          !lt.test(p + j.event.triggered) &&
          (-1 < p.indexOf(".") && ((p = (d = p.split(".")).shift()), d.sort()),
          (u = p.indexOf(":") < 0 && "on" + p),
          ((e = e[j.expando]
            ? e
            : new j.Event(p, "object" == typeof e && e)).isTrigger = r ? 2 : 3),
          (e.namespace = d.join(".")),
          (e.rnamespace = e.namespace
            ? new RegExp("(^|\\.)" + d.join("\\.(?:.*\\.|)") + "(\\.|$)")
            : null),
          (e.result = void 0),
          e.target || (e.target = n),
          (t = null == t ? [e] : j.makeArray(t, [e])),
          (c = j.event.special[p] || {}),
          r || !c.trigger || !1 !== c.trigger.apply(n, t)))
      ) {
        if (!r && !c.noBubble && !j.isWindow(n)) {
          for (
            a = c.delegateType || p, lt.test(a + p) || (o = o.parentNode);
            o;
            o = o.parentNode
          )
            f.push(o), (s = o);
          s === (n.ownerDocument || k) &&
            f.push(s.defaultView || s.parentWindow || C);
        }
        for (i = 0; (o = f[i++]) && !e.isPropagationStopped(); )
          (e.type = 1 < i ? a : c.bindType || p),
            (l = (R.get(o, "events") || {})[e.type] && R.get(o, "handle")) &&
              l.apply(o, t),
            (l = u && o[u]) &&
              l.apply &&
              M(o) &&
              ((e.result = l.apply(o, t)),
              !1 === e.result && e.preventDefault());
        return (
          (e.type = p),
          r ||
            e.isDefaultPrevented() ||
            (c._default && !1 !== c._default.apply(f.pop(), t)) ||
            !M(n) ||
            (u &&
              j.isFunction(n[p]) &&
              !j.isWindow(n) &&
              ((s = n[u]) && (n[u] = null),
              n[(j.event.triggered = p)](),
              (j.event.triggered = void 0),
              s && (n[u] = s))),
          e.result
        );
      }
    },
    simulate: function (e, t, n) {
      var r = j.extend(new j.Event(), n, { type: e, isSimulated: !0 });
      j.event.trigger(r, null, t);
    },
  }),
    j.fn.extend({
      trigger: function (e, t) {
        return this.each(function () {
          j.event.trigger(e, t, this);
        });
      },
      triggerHandler: function (e, t) {
        var n = this[0];
        if (n) return j.event.trigger(e, t, n, !0);
      },
    }),
    j.each(
      "blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(
        " "
      ),
      function (e, n) {
        j.fn[n] = function (e, t) {
          return 0 < arguments.length
            ? this.on(n, null, e, t)
            : this.trigger(n);
        };
      }
    ),
    j.fn.extend({
      hover: function (e, t) {
        return this.mouseenter(e).mouseleave(t || e);
      },
    }),
    (v.focusin = "onfocusin" in C),
    v.focusin ||
      j.each({ focus: "focusin", blur: "focusout" }, function (n, r) {
        var i = function (e) {
          j.event.simulate(r, e.target, j.event.fix(e));
        };
        j.event.special[r] = {
          setup: function () {
            var e = this.ownerDocument || this,
              t = R.access(e, r);
            t || e.addEventListener(n, i, !0), R.access(e, r, (t || 0) + 1);
          },
          teardown: function () {
            var e = this.ownerDocument || this,
              t = R.access(e, r) - 1;
            t
              ? R.access(e, r, t)
              : (e.removeEventListener(n, i, !0), R.remove(e, r));
          },
        };
      });
  var ct = C.location,
    ft = j.now(),
    pt = /\?/;
  (j.parseJSON = function (e) {
    return JSON.parse(e + "");
  }),
    (j.parseXML = function (e) {
      var t;
      if (!e || "string" != typeof e) return null;
      try {
        t = new C.DOMParser().parseFromString(e, "text/xml");
      } catch (e) {
        t = void 0;
      }
      return (
        (t && !t.getElementsByTagName("parsererror").length) ||
          j.error("Invalid XML: " + e),
        t
      );
    });
  var dt = /#.*$/,
    ht = /([?&])_=[^&]*/,
    gt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
    vt = /^(?:GET|HEAD)$/,
    mt = /^\/\//,
    yt = {},
    xt = {},
    bt = "*/".concat("*"),
    wt = k.createElement("a");
  function Tt(o) {
    return function (e, t) {
      "string" != typeof e && ((t = e), (e = "*"));
      var n,
        r = 0,
        i = e.toLowerCase().match(q) || [];
      if (j.isFunction(t))
        for (; (n = i[r++]); )
          "+" === n[0]
            ? ((n = n.slice(1) || "*"), (o[n] = o[n] || []).unshift(t))
            : (o[n] = o[n] || []).push(t);
    };
  }
  function Ct(t, i, o, s) {
    var a = {},
      u = t === xt;
    function l(e) {
      var r;
      return (
        (a[e] = !0),
        j.each(t[e] || [], function (e, t) {
          var n = t(i, o, s);
          return "string" != typeof n || u || a[n]
            ? u
              ? !(r = n)
              : void 0
            : (i.dataTypes.unshift(n), l(n), !1);
        }),
        r
      );
    }
    return l(i.dataTypes[0]) || (!a["*"] && l("*"));
  }
  function kt(e, t) {
    var n,
      r,
      i = j.ajaxSettings.flatOptions || {};
    for (n in t) void 0 !== t[n] && ((i[n] ? e : r || (r = {}))[n] = t[n]);
    return r && j.extend(!0, e, r), e;
  }
  (wt.href = ct.href),
    j.extend({
      active: 0,
      lastModified: {},
      etag: {},
      ajaxSettings: {
        url: ct.href,
        type: "GET",
        isLocal:
          /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(
            ct.protocol
          ),
        global: !0,
        processData: !0,
        async: !0,
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        accepts: {
          "*": bt,
          text: "text/plain",
          html: "text/html",
          xml: "application/xml, text/xml",
          json: "application/json, text/javascript",
        },
        contents: { xml: /\bxml\b/, html: /\bhtml/, json: /\bjson\b/ },
        responseFields: {
          xml: "responseXML",
          text: "responseText",
          json: "responseJSON",
        },
        converters: {
          "* text": String,
          "text html": !0,
          "text json": j.parseJSON,
          "text xml": j.parseXML,
        },
        flatOptions: { url: !0, context: !0 },
      },
      ajaxSetup: function (e, t) {
        return t ? kt(kt(e, j.ajaxSettings), t) : kt(j.ajaxSettings, e);
      },
      ajaxPrefilter: Tt(yt),
      ajaxTransport: Tt(xt),
      ajax: function (e, t) {
        "object" == typeof e && ((t = e), (e = void 0)), (t = t || {});
        var c,
          f,
          p,
          n,
          d,
          r,
          h,
          i,
          g = j.ajaxSetup({}, t),
          v = g.context || g,
          m = g.context && (v.nodeType || v.jquery) ? j(v) : j.event,
          y = j.Deferred(),
          x = j.Callbacks("once memory"),
          b = g.statusCode || {},
          o = {},
          s = {},
          w = 0,
          a = "canceled",
          T = {
            readyState: 0,
            getResponseHeader: function (e) {
              var t;
              if (2 === w) {
                if (!n)
                  for (n = {}; (t = gt.exec(p)); ) n[t[1].toLowerCase()] = t[2];
                t = n[e.toLowerCase()];
              }
              return null == t ? null : t;
            },
            getAllResponseHeaders: function () {
              return 2 === w ? p : null;
            },
            setRequestHeader: function (e, t) {
              var n = e.toLowerCase();
              return w || ((e = s[n] = s[n] || e), (o[e] = t)), this;
            },
            overrideMimeType: function (e) {
              return w || (g.mimeType = e), this;
            },
            statusCode: function (e) {
              var t;
              if (e)
                if (w < 2) for (t in e) b[t] = [b[t], e[t]];
                else T.always(e[T.status]);
              return this;
            },
            abort: function (e) {
              var t = e || a;
              return c && c.abort(t), u(0, t), this;
            },
          };
        if (
          ((y.promise(T).complete = x.add),
          (T.success = T.done),
          (T.error = T.fail),
          (g.url = ((e || g.url || ct.href) + "")
            .replace(dt, "")
            .replace(mt, ct.protocol + "//")),
          (g.type = t.method || t.type || g.method || g.type),
          (g.dataTypes = j
            .trim(g.dataType || "*")
            .toLowerCase()
            .match(q) || [""]),
          null == g.crossDomain)
        ) {
          r = k.createElement("a");
          try {
            (r.href = g.url),
              (r.href = r.href),
              (g.crossDomain =
                wt.protocol + "//" + wt.host != r.protocol + "//" + r.host);
          } catch (e) {
            g.crossDomain = !0;
          }
        }
        if (
          (g.data &&
            g.processData &&
            "string" != typeof g.data &&
            (g.data = j.param(g.data, g.traditional)),
          Ct(yt, g, t, T),
          2 === w)
        )
          return T;
        for (i in ((h = j.event && g.global) &&
          0 == j.active++ &&
          j.event.trigger("ajaxStart"),
        (g.type = g.type.toUpperCase()),
        (g.hasContent = !vt.test(g.type)),
        (f = g.url),
        g.hasContent ||
          (g.data &&
            ((f = g.url += (pt.test(f) ? "&" : "?") + g.data), delete g.data),
          !1 === g.cache &&
            (g.url = ht.test(f)
              ? f.replace(ht, "$1_=" + ft++)
              : f + (pt.test(f) ? "&" : "?") + "_=" + ft++)),
        g.ifModified &&
          (j.lastModified[f] &&
            T.setRequestHeader("If-Modified-Since", j.lastModified[f]),
          j.etag[f] && T.setRequestHeader("If-None-Match", j.etag[f])),
        ((g.data && g.hasContent && !1 !== g.contentType) || t.contentType) &&
          T.setRequestHeader("Content-Type", g.contentType),
        T.setRequestHeader(
          "Accept",
          g.dataTypes[0] && g.accepts[g.dataTypes[0]]
            ? g.accepts[g.dataTypes[0]] +
                ("*" !== g.dataTypes[0] ? ", " + bt + "; q=0.01" : "")
            : g.accepts["*"]
        ),
        g.headers))
          T.setRequestHeader(i, g.headers[i]);
        if (g.beforeSend && (!1 === g.beforeSend.call(v, T, g) || 2 === w))
          return T.abort();
        for (i in ((a = "abort"), { success: 1, error: 1, complete: 1 }))
          T[i](g[i]);
        if ((c = Ct(xt, g, t, T))) {
          if (((T.readyState = 1), h && m.trigger("ajaxSend", [T, g]), 2 === w))
            return T;
          g.async &&
            0 < g.timeout &&
            (d = C.setTimeout(function () {
              T.abort("timeout");
            }, g.timeout));
          try {
            (w = 1), c.send(o, u);
          } catch (e) {
            if (!(w < 2)) throw e;
            u(-1, e);
          }
        } else u(-1, "No Transport");
        function u(e, t, n, r) {
          var i,
            o,
            s,
            a,
            u,
            l = t;
          2 !== w &&
            ((w = 2),
            d && C.clearTimeout(d),
            (c = void 0),
            (p = r || ""),
            (T.readyState = 0 < e ? 4 : 0),
            (i = (200 <= e && e < 300) || 304 === e),
            n &&
              (a = (function (e, t, n) {
                for (
                  var r, i, o, s, a = e.contents, u = e.dataTypes;
                  "*" === u[0];

                )
                  u.shift(),
                    void 0 === r &&
                      (r = e.mimeType || t.getResponseHeader("Content-Type"));
                if (r)
                  for (i in a)
                    if (a[i] && a[i].test(r)) {
                      u.unshift(i);
                      break;
                    }
                if (u[0] in n) o = u[0];
                else {
                  for (i in n) {
                    if (!u[0] || e.converters[i + " " + u[0]]) {
                      o = i;
                      break;
                    }
                    s || (s = i);
                  }
                  o = o || s;
                }
                if (o) return o !== u[0] && u.unshift(o), n[o];
              })(g, T, n)),
            (a = (function (e, t, n, r) {
              var i,
                o,
                s,
                a,
                u,
                l = {},
                c = e.dataTypes.slice();
              if (c[1])
                for (s in e.converters) l[s.toLowerCase()] = e.converters[s];
              for (o = c.shift(); o; )
                if (
                  (e.responseFields[o] && (n[e.responseFields[o]] = t),
                  !u && r && e.dataFilter && (t = e.dataFilter(t, e.dataType)),
                  (u = o),
                  (o = c.shift()))
                )
                  if ("*" === o) o = u;
                  else if ("*" !== u && u !== o) {
                    if (!(s = l[u + " " + o] || l["* " + o]))
                      for (i in l)
                        if (
                          (a = i.split(" "))[1] === o &&
                          (s = l[u + " " + a[0]] || l["* " + a[0]])
                        ) {
                          !0 === s
                            ? (s = l[i])
                            : !0 !== l[i] && ((o = a[0]), c.unshift(a[1]));
                          break;
                        }
                    if (!0 !== s)
                      if (s && e.throws) t = s(t);
                      else
                        try {
                          t = s(t);
                        } catch (e) {
                          return {
                            state: "parsererror",
                            error: s
                              ? e
                              : "No conversion from " + u + " to " + o,
                          };
                        }
                  }
              return { state: "success", data: t };
            })(g, a, T, i)),
            i
              ? (g.ifModified &&
                  ((u = T.getResponseHeader("Last-Modified")) &&
                    (j.lastModified[f] = u),
                  (u = T.getResponseHeader("etag")) && (j.etag[f] = u)),
                204 === e || "HEAD" === g.type
                  ? (l = "nocontent")
                  : 304 === e
                  ? (l = "notmodified")
                  : ((l = a.state), (o = a.data), (i = !(s = a.error))))
              : ((s = l), (!e && l) || ((l = "error"), e < 0 && (e = 0))),
            (T.status = e),
            (T.statusText = (t || l) + ""),
            i ? y.resolveWith(v, [o, l, T]) : y.rejectWith(v, [T, l, s]),
            T.statusCode(b),
            (b = void 0),
            h && m.trigger(i ? "ajaxSuccess" : "ajaxError", [T, g, i ? o : s]),
            x.fireWith(v, [T, l]),
            h &&
              (m.trigger("ajaxComplete", [T, g]),
              --j.active || j.event.trigger("ajaxStop")));
        }
        return T;
      },
      getJSON: function (e, t, n) {
        return j.get(e, t, n, "json");
      },
      getScript: function (e, t) {
        return j.get(e, void 0, t, "script");
      },
    }),
    j.each(["get", "post"], function (e, i) {
      j[i] = function (e, t, n, r) {
        return (
          j.isFunction(t) && ((r = r || n), (n = t), (t = void 0)),
          j.ajax(
            j.extend(
              { url: e, type: i, dataType: r, data: t, success: n },
              j.isPlainObject(e) && e
            )
          )
        );
      };
    }),
    (j._evalUrl = function (e) {
      return j.ajax({
        url: e,
        type: "GET",
        dataType: "script",
        async: !1,
        global: !1,
        throws: !0,
      });
    }),
    j.fn.extend({
      wrapAll: function (t) {
        var e;
        return j.isFunction(t)
          ? this.each(function (e) {
              j(this).wrapAll(t.call(this, e));
            })
          : (this[0] &&
              ((e = j(t, this[0].ownerDocument).eq(0).clone(!0)),
              this[0].parentNode && e.insertBefore(this[0]),
              e
                .map(function () {
                  for (var e = this; e.firstElementChild; )
                    e = e.firstElementChild;
                  return e;
                })
                .append(this)),
            this);
      },
      wrapInner: function (n) {
        return j.isFunction(n)
          ? this.each(function (e) {
              j(this).wrapInner(n.call(this, e));
            })
          : this.each(function () {
              var e = j(this),
                t = e.contents();
              t.length ? t.wrapAll(n) : e.append(n);
            });
      },
      wrap: function (t) {
        var n = j.isFunction(t);
        return this.each(function (e) {
          j(this).wrapAll(n ? t.call(this, e) : t);
        });
      },
      unwrap: function () {
        return this.parent()
          .each(function () {
            j.nodeName(this, "body") || j(this).replaceWith(this.childNodes);
          })
          .end();
      },
    }),
    (j.expr.filters.hidden = function (e) {
      return !j.expr.filters.visible(e);
    }),
    (j.expr.filters.visible = function (e) {
      return (
        0 < e.offsetWidth || 0 < e.offsetHeight || 0 < e.getClientRects().length
      );
    });
  var jt = /%20/g,
    St = /\[\]$/,
    Nt = /\r?\n/g,
    Et = /^(?:submit|button|image|reset|file)$/i,
    At = /^(?:input|select|textarea|keygen)/i;
  function Dt(n, e, r, i) {
    var t;
    if (j.isArray(e))
      j.each(e, function (e, t) {
        r || St.test(n)
          ? i(n, t)
          : Dt(
              n + "[" + ("object" == typeof t && null != t ? e : "") + "]",
              t,
              r,
              i
            );
      });
    else if (r || "object" !== j.type(e)) i(n, e);
    else for (t in e) Dt(n + "[" + t + "]", e[t], r, i);
  }
  (j.param = function (e, t) {
    var n,
      r = [],
      i = function (e, t) {
        (t = j.isFunction(t) ? t() : null == t ? "" : t),
          (r[r.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t));
      };
    if (
      (void 0 === t && (t = j.ajaxSettings && j.ajaxSettings.traditional),
      j.isArray(e) || (e.jquery && !j.isPlainObject(e)))
    )
      j.each(e, function () {
        i(this.name, this.value);
      });
    else for (n in e) Dt(n, e[n], t, i);
    return r.join("&").replace(jt, "+");
  }),
    j.fn.extend({
      serialize: function () {
        return j.param(this.serializeArray());
      },
      serializeArray: function () {
        return this.map(function () {
          var e = j.prop(this, "elements");
          return e ? j.makeArray(e) : this;
        })
          .filter(function () {
            var e = this.type;
            return (
              this.name &&
              !j(this).is(":disabled") &&
              At.test(this.nodeName) &&
              !Et.test(e) &&
              (this.checked || !U.test(e))
            );
          })
          .map(function (e, t) {
            var n = j(this).val();
            return null == n
              ? null
              : j.isArray(n)
              ? j.map(n, function (e) {
                  return { name: t.name, value: e.replace(Nt, "\r\n") };
                })
              : { name: t.name, value: n.replace(Nt, "\r\n") };
          })
          .get();
      },
    }),
    (j.ajaxSettings.xhr = function () {
      try {
        return new C.XMLHttpRequest();
      } catch (e) {}
    });
  var Lt = { 0: 200, 1223: 204 },
    qt = j.ajaxSettings.xhr();
  (v.cors = !!qt && "withCredentials" in qt),
    (v.ajax = qt = !!qt),
    j.ajaxTransport(function (i) {
      var o, s;
      if (v.cors || (qt && !i.crossDomain))
        return {
          send: function (e, t) {
            var n,
              r = i.xhr();
            if (
              (r.open(i.type, i.url, i.async, i.username, i.password),
              i.xhrFields)
            )
              for (n in i.xhrFields) r[n] = i.xhrFields[n];
            for (n in (i.mimeType &&
              r.overrideMimeType &&
              r.overrideMimeType(i.mimeType),
            i.crossDomain ||
              e["X-Requested-With"] ||
              (e["X-Requested-With"] = "XMLHttpRequest"),
            e))
              r.setRequestHeader(n, e[n]);
            (o = function (e) {
              return function () {
                o &&
                  ((o =
                    s =
                    r.onload =
                    r.onerror =
                    r.onabort =
                    r.onreadystatechange =
                      null),
                  "abort" === e
                    ? r.abort()
                    : "error" === e
                    ? "number" != typeof r.status
                      ? t(0, "error")
                      : t(r.status, r.statusText)
                    : t(
                        Lt[r.status] || r.status,
                        r.statusText,
                        "text" !== (r.responseType || "text") ||
                          "string" != typeof r.responseText
                          ? { binary: r.response }
                          : { text: r.responseText },
                        r.getAllResponseHeaders()
                      ));
              };
            }),
              (r.onload = o()),
              (s = r.onerror = o("error")),
              void 0 !== r.onabort
                ? (r.onabort = s)
                : (r.onreadystatechange = function () {
                    4 === r.readyState &&
                      C.setTimeout(function () {
                        o && s();
                      });
                  }),
              (o = o("abort"));
            try {
              r.send((i.hasContent && i.data) || null);
            } catch (e) {
              if (o) throw e;
            }
          },
          abort: function () {
            o && o();
          },
        };
    }),
    j.ajaxSetup({
      accepts: {
        script:
          "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript",
      },
      contents: { script: /\b(?:java|ecma)script\b/ },
      converters: {
        "text script": function (e) {
          return j.globalEval(e), e;
        },
      },
    }),
    j.ajaxPrefilter("script", function (e) {
      void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET");
    }),
    j.ajaxTransport("script", function (n) {
      var r, i;
      if (n.crossDomain)
        return {
          send: function (e, t) {
            (r = j("<script>")
              .prop({ charset: n.scriptCharset, src: n.url })
              .on(
                "load error",
                (i = function (e) {
                  r.remove(),
                    (i = null),
                    e && t("error" === e.type ? 404 : 200, e.type);
                })
              )),
              k.head.appendChild(r[0]);
          },
          abort: function () {
            i && i();
          },
        };
    });
  var Ht = [],
    Ot = /(=)\?(?=&|$)|\?\?/;
  j.ajaxSetup({
    jsonp: "callback",
    jsonpCallback: function () {
      var e = Ht.pop() || j.expando + "_" + ft++;
      return (this[e] = !0), e;
    },
  }),
    j.ajaxPrefilter("json jsonp", function (e, t, n) {
      var r,
        i,
        o,
        s =
          !1 !== e.jsonp &&
          (Ot.test(e.url)
            ? "url"
            : "string" == typeof e.data &&
              0 ===
                (e.contentType || "").indexOf(
                  "application/x-www-form-urlencoded"
                ) &&
              Ot.test(e.data) &&
              "data");
      if (s || "jsonp" === e.dataTypes[0])
        return (
          (r = e.jsonpCallback =
            j.isFunction(e.jsonpCallback)
              ? e.jsonpCallback()
              : e.jsonpCallback),
          s
            ? (e[s] = e[s].replace(Ot, "$1" + r))
            : !1 !== e.jsonp &&
              (e.url += (pt.test(e.url) ? "&" : "?") + e.jsonp + "=" + r),
          (e.converters["script json"] = function () {
            return o || j.error(r + " was not called"), o[0];
          }),
          (e.dataTypes[0] = "json"),
          (i = C[r]),
          (C[r] = function () {
            o = arguments;
          }),
          n.always(function () {
            void 0 === i ? j(C).removeProp(r) : (C[r] = i),
              e[r] && ((e.jsonpCallback = t.jsonpCallback), Ht.push(r)),
              o && j.isFunction(i) && i(o[0]),
              (o = i = void 0);
          }),
          "script"
        );
    }),
    (j.parseHTML = function (e, t, n) {
      if (!e || "string" != typeof e) return null;
      "boolean" == typeof t && ((n = t), (t = !1)), (t = t || k);
      var r = b.exec(e),
        i = !n && [];
      return r
        ? [t.createElement(r[1])]
        : ((r = ne([e], t, i)),
          i && i.length && j(i).remove(),
          j.merge([], r.childNodes));
    });
  var Mt = j.fn.load;
  function Ft(e) {
    return j.isWindow(e) ? e : 9 === e.nodeType && e.defaultView;
  }
  (j.fn.load = function (e, t, n) {
    if ("string" != typeof e && Mt) return Mt.apply(this, arguments);
    var r,
      i,
      o,
      s = this,
      a = e.indexOf(" ");
    return (
      -1 < a && ((r = j.trim(e.slice(a))), (e = e.slice(0, a))),
      j.isFunction(t)
        ? ((n = t), (t = void 0))
        : t && "object" == typeof t && (i = "POST"),
      0 < s.length &&
        j
          .ajax({ url: e, type: i || "GET", dataType: "html", data: t })
          .done(function (e) {
            (o = arguments),
              s.html(r ? j("<div>").append(j.parseHTML(e)).find(r) : e);
          })
          .always(
            n &&
              function (e, t) {
                s.each(function () {
                  n.apply(this, o || [e.responseText, t, e]);
                });
              }
          ),
      this
    );
  }),
    j.each(
      [
        "ajaxStart",
        "ajaxStop",
        "ajaxComplete",
        "ajaxError",
        "ajaxSuccess",
        "ajaxSend",
      ],
      function (e, t) {
        j.fn[t] = function (e) {
          return this.on(t, e);
        };
      }
    ),
    (j.expr.filters.animated = function (t) {
      return j.grep(j.timers, function (e) {
        return t === e.elem;
      }).length;
    }),
    (j.offset = {
      setOffset: function (e, t, n) {
        var r,
          i,
          o,
          s,
          a,
          u,
          l = j.css(e, "position"),
          c = j(e),
          f = {};
        "static" === l && (e.style.position = "relative"),
          (a = c.offset()),
          (o = j.css(e, "top")),
          (u = j.css(e, "left")),
          (i =
            ("absolute" === l || "fixed" === l) && -1 < (o + u).indexOf("auto")
              ? ((s = (r = c.position()).top), r.left)
              : ((s = parseFloat(o) || 0), parseFloat(u) || 0)),
          j.isFunction(t) && (t = t.call(e, n, j.extend({}, a))),
          null != t.top && (f.top = t.top - a.top + s),
          null != t.left && (f.left = t.left - a.left + i),
          "using" in t ? t.using.call(e, f) : c.css(f);
      },
    }),
    j.fn.extend({
      offset: function (t) {
        if (arguments.length)
          return void 0 === t
            ? this
            : this.each(function (e) {
                j.offset.setOffset(this, t, e);
              });
        var e,
          n,
          r = this[0],
          i = { top: 0, left: 0 },
          o = r && r.ownerDocument;
        return o
          ? ((e = o.documentElement),
            j.contains(e, r)
              ? ((i = r.getBoundingClientRect()),
                (n = Ft(o)),
                {
                  top: i.top + n.pageYOffset - e.clientTop,
                  left: i.left + n.pageXOffset - e.clientLeft,
                })
              : i)
          : void 0;
      },
      position: function () {
        if (this[0]) {
          var e,
            t,
            n = this[0],
            r = { top: 0, left: 0 };
          return (
            "fixed" === j.css(n, "position")
              ? (t = n.getBoundingClientRect())
              : ((e = this.offsetParent()),
                (t = this.offset()),
                j.nodeName(e[0], "html") || (r = e.offset()),
                (r.top += j.css(e[0], "borderTopWidth", !0)),
                (r.left += j.css(e[0], "borderLeftWidth", !0))),
            {
              top: t.top - r.top - j.css(n, "marginTop", !0),
              left: t.left - r.left - j.css(n, "marginLeft", !0),
            }
          );
        }
      },
      offsetParent: function () {
        return this.map(function () {
          for (
            var e = this.offsetParent;
            e && "static" === j.css(e, "position");

          )
            e = e.offsetParent;
          return e || De;
        });
      },
    }),
    j.each(
      { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" },
      function (t, i) {
        var o = "pageYOffset" === i;
        j.fn[t] = function (e) {
          return O(
            this,
            function (e, t, n) {
              var r = Ft(e);
              if (void 0 === n) return r ? r[i] : e[t];
              r
                ? r.scrollTo(o ? r.pageXOffset : n, o ? n : r.pageYOffset)
                : (e[t] = n);
            },
            t,
            e,
            arguments.length
          );
        };
      }
    ),
    j.each(["top", "left"], function (e, n) {
      j.cssHooks[n] = qe(v.pixelPosition, function (e, t) {
        if (t)
          return (t = Le(e, n)), Ne.test(t) ? j(e).position()[n] + "px" : t;
      });
    }),
    j.each({ Height: "height", Width: "width" }, function (o, s) {
      j.each(
        { padding: "inner" + o, content: s, "": "outer" + o },
        function (r, e) {
          j.fn[e] = function (e, t) {
            var n = arguments.length && (r || "boolean" != typeof e),
              i = r || (!0 === e || !0 === t ? "margin" : "border");
            return O(
              this,
              function (e, t, n) {
                var r;
                return j.isWindow(e)
                  ? e.document.documentElement["client" + o]
                  : 9 === e.nodeType
                  ? ((r = e.documentElement),
                    Math.max(
                      e.body["scroll" + o],
                      r["scroll" + o],
                      e.body["offset" + o],
                      r["offset" + o],
                      r["client" + o]
                    ))
                  : void 0 === n
                  ? j.css(e, t, i)
                  : j.style(e, t, n, i);
              },
              s,
              n ? e : void 0,
              n,
              null
            );
          };
        }
      );
    }),
    j.fn.extend({
      bind: function (e, t, n) {
        return this.on(e, null, t, n);
      },
      unbind: function (e, t) {
        return this.off(e, null, t);
      },
      delegate: function (e, t, n, r) {
        return this.on(t, e, n, r);
      },
      undelegate: function (e, t, n) {
        return 1 === arguments.length
          ? this.off(e, "**")
          : this.off(t, e || "**", n);
      },
      size: function () {
        return this.length;
      },
    }),
    (j.fn.andSelf = j.fn.addBack),
    "function" == typeof define &&
      define.amd &&
      define("jquery", [], function () {
        return j;
      });
  var Rt = C.jQuery,
    Pt = C.$;
  return (
    (j.noConflict = function (e) {
      return C.$ === j && (C.$ = Pt), e && C.jQuery === j && (C.jQuery = Rt), j;
    }),
    e || (C.jQuery = C.$ = j),
    j
  );
}),
  (function (l, n, s) {
    l.migrateVersion = "1.4.1";
    var r = {};
    function c(e) {
      var t = n.console;
      r[e] ||
        ((r[e] = !0),
        l.migrateWarnings.push(e),
        t &&
          t.warn &&
          !l.migrateMute &&
          (t.warn("JQMIGRATE: " + e), l.migrateTrace && t.trace && t.trace()));
    }
    function e(e, t, n, r) {
      if (Object.defineProperty)
        try {
          return void Object.defineProperty(e, t, {
            configurable: !0,
            enumerable: !0,
            get: function () {
              return c(r), n;
            },
            set: function (e) {
              c(r), (n = e);
            },
          });
        } catch (e) {}
      (l._definePropertyBroken = !0), (e[t] = n);
    }
    (l.migrateWarnings = []),
      n.console &&
        n.console.log &&
        n.console.log(
          "JQMIGRATE: Migrate is installed" +
            (l.migrateMute ? "" : " with logging active") +
            ", version " +
            l.migrateVersion
        ),
      l.migrateTrace === s && (l.migrateTrace = !0),
      (l.migrateReset = function () {
        (r = {}), (l.migrateWarnings.length = 0);
      }),
      "BackCompat" === document.compatMode &&
        c("jQuery is not compatible with Quirks Mode");
    var a = l("<input/>", { size: 1 }).attr("size") && l.attrFn,
      u = l.attr,
      i =
        (l.attrHooks.value && l.attrHooks.value.get) ||
        function () {
          return null;
        },
      o =
        (l.attrHooks.value && l.attrHooks.value.set) ||
        function () {
          return s;
        },
      f = /^(?:input|button)$/i,
      p = /^[238]$/,
      d =
        /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
      h = /^(?:checked|selected)$/i;
    e(l, "attrFn", a || {}, "jQuery.attrFn is deprecated"),
      (l.attr = function (e, t, n, r) {
        var i = t.toLowerCase(),
          o = e && e.nodeType;
        return r &&
          (u.length < 4 && c("jQuery.fn.attr( props, pass ) is deprecated"),
          e && !p.test(o) && (a ? t in a : l.isFunction(l.fn[t])))
          ? l(e)[t](n)
          : ("type" === t &&
              n !== s &&
              f.test(e.nodeName) &&
              e.parentNode &&
              c("Can't change the 'type' of an input or button in IE 6/7/8"),
            !l.attrHooks[i] &&
              d.test(i) &&
              ((l.attrHooks[i] = {
                get: function (e, t) {
                  var n,
                    r = l.prop(e, t);
                  return !0 === r ||
                    ("boolean" != typeof r &&
                      (n = e.getAttributeNode(t)) &&
                      !1 !== n.nodeValue)
                    ? t.toLowerCase()
                    : s;
                },
                set: function (e, t, n) {
                  var r;
                  return (
                    !1 === t
                      ? l.removeAttr(e, n)
                      : ((r = l.propFix[n] || n) in e && (e[r] = !0),
                        e.setAttribute(n, n.toLowerCase())),
                    n
                  );
                },
              }),
              h.test(i) &&
                c(
                  "jQuery.fn.attr('" +
                    i +
                    "') might use property instead of attribute"
                )),
            u.call(l, e, t, n));
      }),
      (l.attrHooks.value = {
        get: function (e, t) {
          var n = (e.nodeName || "").toLowerCase();
          return "button" === n
            ? i.apply(this, arguments)
            : ("input" !== n &&
                "option" !== n &&
                c("jQuery.fn.attr('value') no longer gets properties"),
              t in e ? e.value : null);
        },
        set: function (e, t) {
          var n = (e.nodeName || "").toLowerCase();
          if ("button" === n) return o.apply(this, arguments);
          "input" !== n &&
            "option" !== n &&
            c("jQuery.fn.attr('value', val) no longer sets properties"),
            (e.value = t);
        },
      });
    var t,
      g,
      v,
      m = l.fn.init,
      y = l.find,
      x = l.parseJSON,
      b = /^\s*</,
      w = /\[(\s*[-\w]+\s*)([~|^$*]?=)\s*([-\w#]*?#[-\w#]*)\s*\]/,
      T = /\[(\s*[-\w]+\s*)([~|^$*]?=)\s*([-\w#]*?#[-\w#]*)\s*\]/g,
      C = /^([^<]*)(<[\w\W]+>)([^>]*)$/;
    for (v in ((l.fn.init = function (e, t, n) {
      var r, i;
      return e &&
        "string" == typeof e &&
        !l.isPlainObject(t) &&
        (r = C.exec(l.trim(e))) &&
        r[0] &&
        (b.test(e) || c("$(html) HTML strings must start with '<' character"),
        r[3] && c("$(html) HTML text after last tag is ignored"),
        "#" === r[0].charAt(0) &&
          (c("HTML string cannot start with a '#' character"),
          l.error("JQMIGRATE: Invalid selector string (XSS)")),
        t && t.context && t.context.nodeType && (t = t.context),
        l.parseHTML)
        ? m.call(
            this,
            l.parseHTML(r[2], (t && t.ownerDocument) || t || document, !0),
            t,
            n
          )
        : ((i = m.apply(this, arguments)),
          e && e.selector !== s
            ? ((i.selector = e.selector), (i.context = e.context))
            : ((i.selector = "string" == typeof e ? e : ""),
              e && (i.context = e.nodeType ? e : t || document)),
          i);
    }),
    (l.fn.init.prototype = l.fn),
    (l.find = function (t) {
      var n = Array.prototype.slice.call(arguments);
      if ("string" == typeof t && w.test(t))
        try {
          document.querySelector(t);
        } catch (e) {
          t = t.replace(T, function (e, t, n, r) {
            return "[" + t + n + '"' + r + '"]';
          });
          try {
            document.querySelector(t),
              c("Attribute selector with '#' must be quoted: " + n[0]),
              (n[0] = t);
          } catch (e) {
            c("Attribute selector with '#' was not fixed: " + n[0]);
          }
        }
      return y.apply(this, n);
    }),
    y))
      Object.prototype.hasOwnProperty.call(y, v) && (l.find[v] = y[v]);
    (l.parseJSON = function (e) {
      return e
        ? x.apply(this, arguments)
        : (c("jQuery.parseJSON requires a valid JSON string"), null);
    }),
      (l.uaMatch = function (e) {
        e = e.toLowerCase();
        var t =
          /(chrome)[ \/]([\w.]+)/.exec(e) ||
          /(webkit)[ \/]([\w.]+)/.exec(e) ||
          /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(e) ||
          /(msie) ([\w.]+)/.exec(e) ||
          (e.indexOf("compatible") < 0 &&
            /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(e)) ||
          [];
        return { browser: t[1] || "", version: t[2] || "0" };
      }),
      l.browser ||
        ((g = {}),
        (t = l.uaMatch(navigator.userAgent)).browser &&
          ((g[t.browser] = !0), (g.version = t.version)),
        g.chrome ? (g.webkit = !0) : g.webkit && (g.safari = !0),
        (l.browser = g)),
      e(l, "browser", l.browser, "jQuery.browser is deprecated"),
      (l.boxModel = l.support.boxModel = "CSS1Compat" === document.compatMode),
      e(l, "boxModel", l.boxModel, "jQuery.boxModel is deprecated"),
      e(
        l.support,
        "boxModel",
        l.support.boxModel,
        "jQuery.support.boxModel is deprecated"
      ),
      (l.sub = function () {
        function r(e, t) {
          return new r.fn.init(e, t);
        }
        l.extend(!0, r, this),
          (r.superclass = this),
          (((r.fn = r.prototype = this()).constructor = r).sub = this.sub),
          (r.fn.init = function (e, t) {
            var n = l.fn.init.call(this, e, t, i);
            return n instanceof r ? n : r(n);
          }),
          (r.fn.init.prototype = r.fn);
        var i = r(document);
        return c("jQuery.sub() is deprecated"), r;
      });
    var k = !(l.fn.size = function () {
      return (
        c("jQuery.fn.size() is deprecated; use the .length property"),
        this.length
      );
    });
    l.swap &&
      l.each(["height", "width", "reliableMarginRight"], function (e, t) {
        var n = l.cssHooks[t] && l.cssHooks[t].get;
        n &&
          (l.cssHooks[t].get = function () {
            var e;
            return (k = !0), (e = n.apply(this, arguments)), (k = !1), e;
          });
      }),
      (l.swap = function (e, t, n, r) {
        var i,
          o,
          s = {};
        for (o in (k || c("jQuery.swap() is undocumented and deprecated"), t))
          (s[o] = e.style[o]), (e.style[o] = t[o]);
        for (o in ((i = n.apply(e, r || [])), t)) e.style[o] = s[o];
        return i;
      }),
      l.ajaxSetup({ converters: { "text json": l.parseJSON } });
    var j = l.fn.data;
    l.fn.data = function (e) {
      var t,
        n,
        r = this[0];
      return !r ||
        "events" !== e ||
        1 !== arguments.length ||
        ((t = l.data(r, e)),
        (n = l._data(r, e)),
        (t !== s && t !== n) || n === s)
        ? j.apply(this, arguments)
        : (c("Use of jQuery.fn.data('events') is deprecated"), n);
    };
    var S = /\/(java|ecma)script/i;
    l.clean ||
      (l.clean = function (e, t, n, r) {
        (t =
          (t = (!(t = t || document).nodeType && t[0]) || t).ownerDocument ||
          t),
          c("jQuery.clean() is deprecated");
        var i,
          o,
          s,
          a,
          u = [];
        if ((l.merge(u, l.buildFragment(e, t).childNodes), n))
          for (
            s = function (e) {
              if (!e.type || S.test(e.type))
                return r
                  ? r.push(e.parentNode ? e.parentNode.removeChild(e) : e)
                  : n.appendChild(e);
            },
              i = 0;
            null != (o = u[i]);
            i++
          )
            (l.nodeName(o, "script") && s(o)) ||
              (n.appendChild(o),
              void 0 !== o.getElementsByTagName &&
                ((a = l.grep(l.merge([], o.getElementsByTagName("script")), s)),
                u.splice.apply(u, [i + 1, 0].concat(a)),
                (i += a.length)));
        return u;
      });
    var N = l.event.add,
      E = l.event.remove,
      A = l.event.trigger,
      D = l.fn.toggle,
      L = l.fn.live,
      q = l.fn.die,
      H = l.fn.load,
      O = "ajaxStart|ajaxStop|ajaxSend|ajaxComplete|ajaxError|ajaxSuccess",
      M = new RegExp("\\b(?:" + O + ")\\b"),
      F = /(?:^|\s)hover(\.\S+|)\b/,
      R = function (e) {
        return "string" != typeof e || l.event.special.hover
          ? e
          : (F.test(e) &&
              c(
                "'hover' pseudo-event is deprecated, use 'mouseenter mouseleave'"
              ),
            e && e.replace(F, "mouseenter$1 mouseleave$1"));
      };
    l.event.props &&
      "attrChange" !== l.event.props[0] &&
      l.event.props.unshift(
        "attrChange",
        "attrName",
        "relatedNode",
        "srcElement"
      ),
      l.event.dispatch &&
        e(
          l.event,
          "handle",
          l.event.dispatch,
          "jQuery.event.handle is undocumented and deprecated"
        ),
      (l.event.add = function (e, t, n, r, i) {
        e !== document &&
          M.test(t) &&
          c("AJAX events should be attached to document: " + t),
          N.call(this, e, R(t || ""), n, r, i);
      }),
      (l.event.remove = function (e, t, n, r, i) {
        E.call(this, e, R(t) || "", n, r, i);
      }),
      l.each(["load", "unload", "error"], function (e, t) {
        l.fn[t] = function () {
          var e = Array.prototype.slice.call(arguments, 0);
          return "load" === t && "string" == typeof e[0]
            ? H.apply(this, e)
            : (c("jQuery.fn." + t + "() is deprecated"),
              e.splice(0, 0, t),
              arguments.length
                ? this.bind.apply(this, e)
                : (this.triggerHandler.apply(this, e), this));
        };
      }),
      (l.fn.toggle = function (n, e) {
        if (!l.isFunction(n) || !l.isFunction(e))
          return D.apply(this, arguments);
        c("jQuery.fn.toggle(handler, handler...) is deprecated");
        var r = arguments,
          t = n.guid || l.guid++,
          i = 0,
          o = function (e) {
            var t = (l._data(this, "lastToggle" + n.guid) || 0) % i;
            return (
              l._data(this, "lastToggle" + n.guid, 1 + t),
              e.preventDefault(),
              r[t].apply(this, arguments) || !1
            );
          };
        for (o.guid = t; i < r.length; ) r[i++].guid = t;
        return this.click(o);
      }),
      (l.fn.live = function (e, t, n) {
        return (
          c("jQuery.fn.live() is deprecated"),
          L
            ? L.apply(this, arguments)
            : (l(this.context).on(e, this.selector, t, n), this)
        );
      }),
      (l.fn.die = function (e, t) {
        return (
          c("jQuery.fn.die() is deprecated"),
          q
            ? q.apply(this, arguments)
            : (l(this.context).off(e, this.selector || "**", t), this)
        );
      }),
      (l.event.trigger = function (e, t, n, r) {
        return (
          n || M.test(e) || c("Global events are undocumented and deprecated"),
          A.call(this, e, t, n || document, r)
        );
      }),
      l.each(O.split("|"), function (e, t) {
        l.event.special[t] = {
          setup: function () {
            var e = this;
            return (
              e !== document &&
                (l.event.add(document, t + "." + l.guid, function () {
                  l.event.trigger(
                    t,
                    Array.prototype.slice.call(arguments, 1),
                    e,
                    !0
                  );
                }),
                l._data(this, t, l.guid++)),
              !1
            );
          },
          teardown: function () {
            return (
              this !== document &&
                l.event.remove(document, t + "." + l._data(this, t)),
              !1
            );
          },
        };
      }),
      (l.event.special.ready = {
        setup: function () {
          this === document && c("'ready' event is deprecated");
        },
      });
    var P = l.fn.andSelf || l.fn.addBack,
      I = l.fn.find;
    if (
      ((l.fn.andSelf = function () {
        return (
          c("jQuery.fn.andSelf() replaced by jQuery.fn.addBack()"),
          P.apply(this, arguments)
        );
      }),
      (l.fn.find = function (e) {
        var t = I.apply(this, arguments);
        return (
          (t.context = this.context),
          (t.selector = this.selector ? this.selector + " " + e : e),
          t
        );
      }),
      l.Callbacks)
    ) {
      var W = l.Deferred,
        $ = [
          [
            "resolve",
            "done",
            l.Callbacks("once memory"),
            l.Callbacks("once memory"),
            "resolved",
          ],
          [
            "reject",
            "fail",
            l.Callbacks("once memory"),
            l.Callbacks("once memory"),
            "rejected",
          ],
          ["notify", "progress", l.Callbacks("memory"), l.Callbacks("memory")],
        ];
      l.Deferred = function (e) {
        var o = W(),
          s = o.promise();
        return (
          (o.pipe = s.pipe =
            function () {
              var i = arguments;
              return (
                c("deferred.pipe() is deprecated"),
                l
                  .Deferred(function (r) {
                    l.each($, function (e, t) {
                      var n = l.isFunction(i[e]) && i[e];
                      o[t[1]](function () {
                        var e = n && n.apply(this, arguments);
                        e && l.isFunction(e.promise)
                          ? e
                              .promise()
                              .done(r.resolve)
                              .fail(r.reject)
                              .progress(r.notify)
                          : r[t[0] + "With"](
                              this === s ? r.promise() : this,
                              n ? [e] : arguments
                            );
                      });
                    }),
                      (i = null);
                  })
                  .promise()
              );
            }),
          (o.isResolved = function () {
            return (
              c("deferred.isResolved is deprecated"), "resolved" === o.state()
            );
          }),
          (o.isRejected = function () {
            return (
              c("deferred.isRejected is deprecated"), "rejected" === o.state()
            );
          }),
          e && e.call(o, o),
          o
        );
      };
    }
  })(jQuery, window);
