var URN = {
  build: function (r) {
    var n = r.path;
    return (
      (r.querystring = r.querystring.replace("?", "")),
      "" !== r.querystring && (n += "?" + r.querystring),
      (r.hash = r.hash.replace("#", "")),
      "" !== r.hash && (n += "#" + r.hash),
      n
    );
  },
  parts: function (r) {
    var n = r.toString().split("#");
    r = n[0];
    var t = n.length > 1 ? "#" + n[1] : "";
    return {
      path: (n = r.split("?"))[0],
      querystring: n.length > 1 ? n[1] : "",
      hash: t,
    };
  },
  paramsToQueryString: function (r) {
    var n = [];
    for (var t in r) {
      var e = r[t];
      "" != t &&
        null != e &&
        null != e &&
        "" != e &&
        n.push(encodeURIComponent(t) + "=" + encodeURIComponent(r[t]));
    }
    return n.length > 0 ? "?" + n.join("&") : "";
  },
  queryStringToParams: function (r) {
    if (r.indexOf("?") > -1) r = r.split("?")[1];
    var n = r.split("&");
    params = [];
    for (var t = 0; t < n.length; t++) {
      var e = n[t].split("=");
      params[decodeURIComponent(e[0])] = decodeURIComponent(e[1]);
    }
    return params;
  },
  setQueryStringParam: function (r, n, t) {
    var e = this.queryStringToParams(r);
    return null == t ? delete e[n] : (e[n] = t), this.paramsToQueryString(e);
  },
};
//# sourceMappingURL=https://assets.astrolighting.com/static/maps/js/url.js.50e58.map
