/* jQuery v1.9.1 | (c) 2005, 2012 jQuery Foundation, Inc. | jquery.org/license
//@ sourceMappingURL=jquery.min.map
*/
(function(e, t) { var n, r, i = typeof t,
        o = e.document,
        a = e.location,
        s = e.jQuery,
        u = e.$,
        l = {},
        c = [],
        p = "1.9.1",
        f = c.concat,
        d = c.push,
        h = c.slice,
        g = c.indexOf,
        m = l.toString,
        y = l.hasOwnProperty,
        v = p.trim,
        b = function(e, t) { return new b.fn.init(e, t, r) },
        x = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
        w = /\S+/g,
        T = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
        N = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/,
        C = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
        k = /^[\],:{}\s]*$/,
        E = /(?:^|:|,)(?:\s*\[)+/g,
        S = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
        A = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
        j = /^-ms-/,
        D = /-([\da-z])/gi,
        L = function(e, t) { return t.toUpperCase() },
        H = function(e) {
            (o.addEventListener || "load" === e.type || "complete" === o.readyState) && (q(), b.ready()) },
        q = function() { o.addEventListener ? (o.removeEventListener("DOMContentLoaded", H, !1), e.removeEventListener("load", H, !1)) : (o.detachEvent("onreadystatechange", H), e.detachEvent("onload", H)) };
    b.fn = b.prototype = { jquery: p, constructor: b, init: function(e, n, r) { var i, a; if (!e) { return this } if ("string" == typeof e) { if (i = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : N.exec(e), !i || !i[1] && n) { return !n || n.jquery ? (n || r).find(e) : this.constructor(n).find(e) } if (i[1]) { if (n = n instanceof b ? n[0] : n, b.merge(this, b.parseHTML(i[1], n && n.nodeType ? n.ownerDocument || n : o, !0)), C.test(i[1]) && b.isPlainObject(n)) { for (i in n) { b.isFunction(this[i]) ? this[i](n[i]) : this.attr(i, n[i]) } } return this } if (a = o.getElementById(i[2]), a && a.parentNode) { if (a.id !== i[2]) { return r.find(e) } this.length = 1, this[0] = a } return this.context = o, this.selector = e, this } return e.nodeType ? (this.context = this[0] = e, this.length = 1, this) : b.isFunction(e) ? r.ready(e) : (e.selector !== t && (this.selector = e.selector, this.context = e.context), b.makeArray(e, this)) }, selector: "", length: 0, size: function() { return this.length }, toArray: function() { return h.call(this) }, get: function(e) { return null == e ? this.toArray() : 0 > e ? this[this.length + e] : this[e] }, pushStack: function(e) { var t = b.merge(this.constructor(), e); return t.prevObject = this, t.context = this.context, t }, each: function(e, t) { return b.each(this, e, t) }, ready: function(e) { return b.ready.promise().done(e), this }, slice: function() { return this.pushStack(h.apply(this, arguments)) }, first: function() { return this.eq(0) }, last: function() { return this.eq(-1) }, eq: function(e) { var t = this.length,
                n = +e + (0 > e ? t : 0); return this.pushStack(n >= 0 && t > n ? [this[n]] : []) }, map: function(e) { return this.pushStack(b.map(this, function(t, n) { return e.call(t, n, t) })) }, end: function() { return this.prevObject || this.constructor(null) }, push: d, sort: [].sort, splice: [].splice }, b.fn.init.prototype = b.fn, b.extend = b.fn.extend = function() { var e, n, r, i, o, a, s = arguments[0] || {},
            u = 1,
            l = arguments.length,
            c = !1; for ("boolean" == typeof s && (c = s, s = arguments[1] || {}, u = 2), "object" == typeof s || b.isFunction(s) || (s = {}), l === u && (s = this, --u); l > u; u++) { if (null != (o = arguments[u])) { for (i in o) { e = s[i], r = o[i], s !== r && (c && r && (b.isPlainObject(r) || (n = b.isArray(r))) ? (n ? (n = !1, a = e && b.isArray(e) ? e : []) : a = e && b.isPlainObject(e) ? e : {}, s[i] = b.extend(c, a, r)) : r !== t && (s[i] = r)) } } } return s }, b.extend({ noConflict: function(t) { return e.$ === b && (e.$ = u), t && e.jQuery === b && (e.jQuery = s), b }, isReady: !1, readyWait: 1, holdReady: function(e) { e ? b.readyWait++ : b.ready(!0) }, ready: function(e) { if (e === !0 ? !--b.readyWait : !b.isReady) { if (!o.body) { return setTimeout(b.ready) } b.isReady = !0, e !== !0 && --b.readyWait > 0 || (n.resolveWith(o, [b]), b.fn.trigger && b(o).trigger("ready").off("ready")) } }, isFunction: function(e) { return "function" === b.type(e) }, isArray: Array.isArray || function(e) { return "array" === b.type(e) }, isWindow: function(e) { return null != e && e == e.window }, isNumeric: function(e) { return !isNaN(parseFloat(e)) && isFinite(e) }, type: function(e) { return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? l[m.call(e)] || "object" : typeof e }, isPlainObject: function(e) { if (!e || "object" !== b.type(e) || e.nodeType || b.isWindow(e)) { return !1 } try { if (e.constructor && !y.call(e, "constructor") && !y.call(e.constructor.prototype, "isPrototypeOf")) { return !1 } } catch (n) { return !1 } var r; for (r in e) {} return r === t || y.call(e, r) }, isEmptyObject: function(e) { var t; for (t in e) { return !1 } return !0 }, error: function(e) { throw Error(e) }, parseHTML: function(e, t, n) { if (!e || "string" != typeof e) { return null } "boolean" == typeof t && (n = t, t = !1), t = t || o; var r = C.exec(e),
                i = !n && []; return r ? [t.createElement(r[1])] : (r = b.buildFragment([e], t, i), i && b(i).remove(), b.merge([], r.childNodes)) }, parseJSON: function(n) { return e.JSON && e.JSON.parse ? e.JSON.parse(n) : null === n ? n : "string" == typeof n && (n = b.trim(n), n && k.test(n.replace(S, "@").replace(A, "]").replace(E, ""))) ? Function("return " + n)() : (b.error("Invalid JSON: " + n), t) }, parseXML: function(n) { var r, i; if (!n || "string" != typeof n) { return null } try { e.DOMParser ? (i = new DOMParser, r = i.parseFromString(n, "text/xml")) : (r = new ActiveXObject("Microsoft.XMLDOM"), r.async = "false", r.loadXML(n)) } catch (o) { r = t } return r && r.documentElement && !r.getElementsByTagName("parsererror").length || b.error("Invalid XML: " + n), r }, noop: function() {}, globalEval: function(t) { t && b.trim(t) && (e.execScript || function(t) { e.eval.call(e, t) })(t) }, camelCase: function(e) { return e.replace(j, "ms-").replace(D, L) }, nodeName: function(e, t) { return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase() }, each: function(e, t, n) { var r, i = 0,
                o = e.length,
                a = M(e); if (n) { if (a) { for (; o > i; i++) { if (r = t.apply(e[i], n), r === !1) { break } } } else { for (i in e) { if (r = t.apply(e[i], n), r === !1) { break } } } } else { if (a) { for (; o > i; i++) { if (r = t.call(e[i], i, e[i]), r === !1) { break } } } else { for (i in e) { if (r = t.call(e[i], i, e[i]), r === !1) { break } } } } return e }, trim: v && !v.call("\ufeff\u00a0") ? function(e) { return null == e ? "" : v.call(e) } : function(e) { return null == e ? "" : (e + "").replace(T, "") }, makeArray: function(e, t) { var n = t || []; return null != e && (M(Object(e)) ? b.merge(n, "string" == typeof e ? [e] : e) : d.call(n, e)), n }, inArray: function(e, t, n) { var r; if (t) { if (g) { return g.call(t, e, n) } for (r = t.length, n = n ? 0 > n ? Math.max(0, r + n) : n : 0; r > n; n++) { if (n in t && t[n] === e) { return n } } } return -1 }, merge: function(e, n) { var r = n.length,
                i = e.length,
                o = 0; if ("number" == typeof r) { for (; r > o; o++) { e[i++] = n[o] } } else { while (n[o] !== t) { e[i++] = n[o++] } } return e.length = i, e }, grep: function(e, t, n) { var r, i = [],
                o = 0,
                a = e.length; for (n = !!n; a > o; o++) { r = !!t(e[o], o), n !== r && i.push(e[o]) } return i }, map: function(e, t, n) { var r, i = 0,
                o = e.length,
                a = M(e),
                s = []; if (a) { for (; o > i; i++) { r = t(e[i], i, n), null != r && (s[s.length] = r) } } else { for (i in e) { r = t(e[i], i, n), null != r && (s[s.length] = r) } } return f.apply([], s) }, guid: 1, proxy: function(e, n) { var r, i, o; return "string" == typeof n && (o = e[n], n = e, e = o), b.isFunction(e) ? (r = h.call(arguments, 2), i = function() { return e.apply(n || this, r.concat(h.call(arguments))) }, i.guid = e.guid = e.guid || b.guid++, i) : t }, access: function(e, n, r, i, o, a, s) { var u = 0,
                l = e.length,
                c = null == r; if ("object" === b.type(r)) { o = !0; for (u in r) { b.access(e, n, u, r[u], !0, a, s) } } else { if (i !== t && (o = !0, b.isFunction(i) || (s = !0), c && (s ? (n.call(e, i), n = null) : (c = n, n = function(e, t, n) { return c.call(b(e), n) })), n)) { for (; l > u; u++) { n(e[u], r, s ? i : i.call(e[u], u, n(e[u], r))) } } } return o ? e : c ? n.call(e) : l ? n(e[0], r) : a }, now: function() { return (new Date).getTime() } }), b.ready.promise = function(t) { if (!n) { if (n = b.Deferred(), "complete" === o.readyState) { setTimeout(b.ready) } else { if (o.addEventListener) { o.addEventListener("DOMContentLoaded", H, !1), e.addEventListener("load", H, !1) } else { o.attachEvent("onreadystatechange", H), e.attachEvent("onload", H); var r = !1; try { r = null == e.frameElement && o.documentElement } catch (i) {} r && r.doScroll && function a() { if (!b.isReady) { try { r.doScroll("left") } catch (e) { return setTimeout(a, 50) } q(), b.ready() } }() } } } return n.promise(t) }, b.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function(e, t) { l["[object " + t + "]"] = t.toLowerCase() });

    function M(e) { var t = e.length,
            n = b.type(e); return b.isWindow(e) ? !1 : 1 === e.nodeType && t ? !0 : "array" === n || "function" !== n && (0 === t || "number" == typeof t && t > 0 && t - 1 in e) } r = b(o); var _ = {};

    function F(e) { var t = _[e] = {}; return b.each(e.match(w) || [], function(e, n) { t[n] = !0 }), t } b.Callbacks = function(e) { e = "string" == typeof e ? _[e] || F(e) : b.extend({}, e); var n, r, i, o, a, s, u = [],
            l = !e.once && [],
            c = function(t) { for (r = e.memory && t, i = !0, a = s || 0, s = 0, o = u.length, n = !0; u && o > a; a++) { if (u[a].apply(t[0], t[1]) === !1 && e.stopOnFalse) { r = !1; break } } n = !1, u && (l ? l.length && c(l.shift()) : r ? u = [] : p.disable()) },
            p = { add: function() { if (u) { var t = u.length;
                        (function i(t) { b.each(t, function(t, n) { var r = b.type(n); "function" === r ? e.unique && p.has(n) || u.push(n) : n && n.length && "string" !== r && i(n) }) })(arguments), n ? o = u.length : r && (s = t, c(r)) } return this }, remove: function() { return u && b.each(arguments, function(e, t) { var r; while ((r = b.inArray(t, u, r)) > -1) { u.splice(r, 1), n && (o >= r && o--, a >= r && a--) } }), this }, has: function(e) { return e ? b.inArray(e, u) > -1 : !(!u || !u.length) }, empty: function() { return u = [], this }, disable: function() { return u = l = r = t, this }, disabled: function() { return !u }, lock: function() { return l = t, r || p.disable(), this }, locked: function() { return !l }, fireWith: function(e, t) { return t = t || [], t = [e, t.slice ? t.slice() : t], !u || i && !l || (n ? l.push(t) : c(t)), this }, fire: function() { return p.fireWith(this, arguments), this }, fired: function() { return !!i } }; return p }, b.extend({ Deferred: function(e) { var t = [
                    ["resolve", "done", b.Callbacks("once memory"), "resolved"],
                    ["reject", "fail", b.Callbacks("once memory"), "rejected"],
                    ["notify", "progress", b.Callbacks("memory")]
                ],
                n = "pending",
                r = { state: function() { return n }, always: function() { return i.done(arguments).fail(arguments), this }, then: function() { var e = arguments; return b.Deferred(function(n) { b.each(t, function(t, o) { var a = o[0],
                                    s = b.isFunction(e[t]) && e[t];
                                i[o[1]](function() { var e = s && s.apply(this, arguments);
                                    e && b.isFunction(e.promise) ? e.promise().done(n.resolve).fail(n.reject).progress(n.notify) : n[a + "With"](this === r ? n.promise() : this, s ? [e] : arguments) }) }), e = null }).promise() }, promise: function(e) { return null != e ? b.extend(e, r) : r } },
                i = {}; return r.pipe = r.then, b.each(t, function(e, o) { var a = o[2],
                    s = o[3];
                r[o[1]] = a.add, s && a.add(function() { n = s }, t[1 ^ e][2].disable, t[2][2].lock), i[o[0]] = function() { return i[o[0] + "With"](this === i ? r : this, arguments), this }, i[o[0] + "With"] = a.fireWith }), r.promise(i), e && e.call(i, i), i }, when: function(e) { var t = 0,
                n = h.call(arguments),
                r = n.length,
                i = 1 !== r || e && b.isFunction(e.promise) ? r : 0,
                o = 1 === i ? e : b.Deferred(),
                a = function(e, t, n) { return function(r) { t[e] = this, n[e] = arguments.length > 1 ? h.call(arguments) : r, n === s ? o.notifyWith(t, n) : --i || o.resolveWith(t, n) } },
                s, u, l; if (r > 1) { for (s = Array(r), u = Array(r), l = Array(r); r > t; t++) { n[t] && b.isFunction(n[t].promise) ? n[t].promise().done(a(t, l, n)).fail(o.reject).progress(a(t, u, s)) : --i } } return i || o.resolveWith(l, n), o.promise() } }), b.support = function() { var t, n, r, a, s, u, l, c, p, f, d = o.createElement("div"); if (d.setAttribute("className", "t"), d.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>", n = d.getElementsByTagName("*"), r = d.getElementsByTagName("a")[0], !n || !r || !n.length) { return {} } s = o.createElement("select"), l = s.appendChild(o.createElement("option")), a = d.getElementsByTagName("input")[0], r.style.cssText = "top:1px;float:left;opacity:.5", t = { getSetAttribute: "t" !== d.className, leadingWhitespace: 3 === d.firstChild.nodeType, tbody: !d.getElementsByTagName("tbody").length, htmlSerialize: !!d.getElementsByTagName("link").length, style: /top/.test(r.getAttribute("style")), hrefNormalized: "/a" === r.getAttribute("href"), opacity: /^0.5/.test(r.style.opacity), cssFloat: !!r.style.cssFloat, checkOn: !!a.value, optSelected: l.selected, enctype: !!o.createElement("form").enctype, html5Clone: "<:nav></:nav>" !== o.createElement("nav").cloneNode(!0).outerHTML, boxModel: "CSS1Compat" === o.compatMode, deleteExpando: !0, noCloneEvent: !0, inlineBlockNeedsLayout: !1, shrinkWrapBlocks: !1, reliableMarginRight: !0, boxSizingReliable: !0, pixelPosition: !1 }, a.checked = !0, t.noCloneChecked = a.cloneNode(!0).checked, s.disabled = !0, t.optDisabled = !l.disabled; try { delete d.test } catch (h) { t.deleteExpando = !1 } a = o.createElement("input"), a.setAttribute("value", ""), t.input = "" === a.getAttribute("value"), a.value = "t", a.setAttribute("type", "radio"), t.radioValue = "t" === a.value, a.setAttribute("checked", "t"), a.setAttribute("name", "t"), u = o.createDocumentFragment(), u.appendChild(a), t.appendChecked = a.checked, t.checkClone = u.cloneNode(!0).cloneNode(!0).lastChild.checked, d.attachEvent && (d.attachEvent("onclick", function() { t.noCloneEvent = !1 }), d.cloneNode(!0).click()); for (f in { submit: !0, change: !0, focusin: !0 }) { d.setAttribute(c = "on" + f, "t"), t[f + "Bubbles"] = c in e || d.attributes[c].expando === !1 } return d.style.backgroundClip = "content-box", d.cloneNode(!0).style.backgroundClip = "", t.clearCloneStyle = "content-box" === d.style.backgroundClip, b(function() { var n, r, a, s = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;",
                u = o.getElementsByTagName("body")[0];
            u && (n = o.createElement("div"), n.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", u.appendChild(n).appendChild(d), d.innerHTML = "<table><tr><td></td><td>t</td></tr></table>", a = d.getElementsByTagName("td"), a[0].style.cssText = "padding:0;margin:0;border:0;display:none", p = 0 === a[0].offsetHeight, a[0].style.display = "", a[1].style.display = "none", t.reliableHiddenOffsets = p && 0 === a[0].offsetHeight, d.innerHTML = "", d.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", t.boxSizing = 4 === d.offsetWidth, t.doesNotIncludeMarginInBodyOffset = 1 !== u.offsetTop, e.getComputedStyle && (t.pixelPosition = "1%" !== (e.getComputedStyle(d, null) || {}).top, t.boxSizingReliable = "4px" === (e.getComputedStyle(d, null) || { width: "4px" }).width, r = d.appendChild(o.createElement("div")), r.style.cssText = d.style.cssText = s, r.style.marginRight = r.style.width = "0", d.style.width = "1px", t.reliableMarginRight = !parseFloat((e.getComputedStyle(r, null) || {}).marginRight)), typeof d.style.zoom !== i && (d.innerHTML = "", d.style.cssText = s + "width:1px;padding:1px;display:inline;zoom:1", t.inlineBlockNeedsLayout = 3 === d.offsetWidth, d.style.display = "block", d.innerHTML = "<div></div>", d.firstChild.style.width = "5px", t.shrinkWrapBlocks = 3 !== d.offsetWidth, t.inlineBlockNeedsLayout && (u.style.zoom = 1)), u.removeChild(n), n = d = a = r = null) }), n = s = u = l = r = a = null, t }(); var O = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
        B = /([A-Z])/g;

    function P(e, n, r, i) { if (b.acceptData(e)) { var o, a, s = b.expando,
                u = "string" == typeof n,
                l = e.nodeType,
                p = l ? b.cache : e,
                f = l ? e[s] : e[s] && s; if (f && p[f] && (i || p[f].data) || !u || r !== t) { return f || (l ? e[s] = f = c.pop() || b.guid++ : f = s), p[f] || (p[f] = {}, l || (p[f].toJSON = b.noop)), ("object" == typeof n || "function" == typeof n) && (i ? p[f] = b.extend(p[f], n) : p[f].data = b.extend(p[f].data, n)), o = p[f], i || (o.data || (o.data = {}), o = o.data), r !== t && (o[b.camelCase(n)] = r), u ? (a = o[n], null == a && (a = o[b.camelCase(n)])) : a = o, a } } }

    function R(e, t, n) { if (b.acceptData(e)) { var r, i, o, a = e.nodeType,
                s = a ? b.cache : e,
                u = a ? e[b.expando] : b.expando; if (s[u]) { if (t && (o = n ? s[u] : s[u].data)) { b.isArray(t) ? t = t.concat(b.map(t, b.camelCase)) : t in o ? t = [t] : (t = b.camelCase(t), t = t in o ? [t] : t.split(" ")); for (r = 0, i = t.length; i > r; r++) { delete o[t[r]] } if (!(n ? $ : b.isEmptyObject)(o)) { return } }(n || (delete s[u].data, $(s[u]))) && (a ? b.cleanData([e], !0) : b.support.deleteExpando || s != s.window ? delete s[u] : s[u] = null) } } } b.extend({ cache: {}, expando: "jQuery" + (p + Math.random()).replace(/\D/g, ""), noData: { embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0 }, hasData: function(e) { return e = e.nodeType ? b.cache[e[b.expando]] : e[b.expando], !!e && !$(e) }, data: function(e, t, n) { return P(e, t, n) }, removeData: function(e, t) { return R(e, t) }, _data: function(e, t, n) { return P(e, t, n, !0) }, _removeData: function(e, t) { return R(e, t, !0) }, acceptData: function(e) { if (e.nodeType && 1 !== e.nodeType && 9 !== e.nodeType) { return !1 } var t = e.nodeName && b.noData[e.nodeName.toLowerCase()]; return !t || t !== !0 && e.getAttribute("classid") === t } }), b.fn.extend({ data: function(e, n) { var r, i, o = this[0],
                a = 0,
                s = null; if (e === t) { if (this.length && (s = b.data(o), 1 === o.nodeType && !b._data(o, "parsedAttrs"))) { for (r = o.attributes; r.length > a; a++) { i = r[a].name, i.indexOf("data-") || (i = b.camelCase(i.slice(5)), W(o, i, s[i])) } b._data(o, "parsedAttrs", !0) } return s } return "object" == typeof e ? this.each(function() { b.data(this, e) }) : b.access(this, function(n) { return n === t ? o ? W(o, e, b.data(o, e)) : null : (this.each(function() { b.data(this, e, n) }), t) }, null, n, arguments.length > 1, null, !0) }, removeData: function(e) { return this.each(function() { b.removeData(this, e) }) } });

    function W(e, n, r) { if (r === t && 1 === e.nodeType) { var i = "data-" + n.replace(B, "-$1").toLowerCase(); if (r = e.getAttribute(i), "string" == typeof r) { try { r = "true" === r ? !0 : "false" === r ? !1 : "null" === r ? null : +r + "" === r ? +r : O.test(r) ? b.parseJSON(r) : r } catch (o) {} b.data(e, n, r) } else { r = t } } return r }

    function $(e) { var t; for (t in e) { if (("data" !== t || !b.isEmptyObject(e[t])) && "toJSON" !== t) { return !1 } } return !0 } b.extend({ queue: function(e, n, r) { var i; return e ? (n = (n || "fx") + "queue", i = b._data(e, n), r && (!i || b.isArray(r) ? i = b._data(e, n, b.makeArray(r)) : i.push(r)), i || []) : t }, dequeue: function(e, t) { t = t || "fx"; var n = b.queue(e, t),
                r = n.length,
                i = n.shift(),
                o = b._queueHooks(e, t),
                a = function() { b.dequeue(e, t) }; "inprogress" === i && (i = n.shift(), r--), o.cur = i, i && ("fx" === t && n.unshift("inprogress"), delete o.stop, i.call(e, a, o)), !r && o && o.empty.fire() }, _queueHooks: function(e, t) { var n = t + "queueHooks"; return b._data(e, n) || b._data(e, n, { empty: b.Callbacks("once memory").add(function() { b._removeData(e, t + "queue"), b._removeData(e, n) }) }) } }), b.fn.extend({ queue: function(e, n) { var r = 2; return "string" != typeof e && (n = e, e = "fx", r--), r > arguments.length ? b.queue(this[0], e) : n === t ? this : this.each(function() { var t = b.queue(this, e, n);
                b._queueHooks(this, e), "fx" === e && "inprogress" !== t[0] && b.dequeue(this, e) }) }, dequeue: function(e) { return this.each(function() { b.dequeue(this, e) }) }, delay: function(e, t) { return e = b.fx ? b.fx.speeds[e] || e : e, t = t || "fx", this.queue(t, function(t, n) { var r = setTimeout(t, e);
                n.stop = function() { clearTimeout(r) } }) }, clearQueue: function(e) { return this.queue(e || "fx", []) }, promise: function(e, n) { var r, i = 1,
                o = b.Deferred(),
                a = this,
                s = this.length,
                u = function() {--i || o.resolveWith(a, [a]) }; "string" != typeof e && (n = e, e = t), e = e || "fx"; while (s--) { r = b._data(a[s], e + "queueHooks"), r && r.empty && (i++, r.empty.add(u)) } return u(), o.promise(n) } }); var I, z, X = /[\t\r\n]/g,
        U = /\r/g,
        V = /^(?:input|select|textarea|button|object)$/i,
        Y = /^(?:a|area)$/i,
        J = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i,
        G = /^(?:checked|selected)$/i,
        Q = b.support.getSetAttribute,
        K = b.support.input;
    b.fn.extend({ attr: function(e, t) { return b.access(this, b.attr, e, t, arguments.length > 1) }, removeAttr: function(e) { return this.each(function() { b.removeAttr(this, e) }) }, prop: function(e, t) { return b.access(this, b.prop, e, t, arguments.length > 1) }, removeProp: function(e) { return e = b.propFix[e] || e, this.each(function() { try { this[e] = t, delete this[e] } catch (n) {} }) }, addClass: function(e) { var t, n, r, i, o, a = 0,
                s = this.length,
                u = "string" == typeof e && e; if (b.isFunction(e)) { return this.each(function(t) { b(this).addClass(e.call(this, t, this.className)) }) } if (u) { for (t = (e || "").match(w) || []; s > a; a++) { if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(X, " ") : " ")) { o = 0; while (i = t[o++]) { 0 > r.indexOf(" " + i + " ") && (r += i + " ") } n.className = b.trim(r) } } } return this }, removeClass: function(e) { var t, n, r, i, o, a = 0,
                s = this.length,
                u = 0 === arguments.length || "string" == typeof e && e; if (b.isFunction(e)) { return this.each(function(t) { b(this).removeClass(e.call(this, t, this.className)) }) } if (u) { for (t = (e || "").match(w) || []; s > a; a++) { if (n = this[a], r = 1 === n.nodeType && (n.className ? (" " + n.className + " ").replace(X, " ") : "")) { o = 0; while (i = t[o++]) { while (r.indexOf(" " + i + " ") >= 0) { r = r.replace(" " + i + " ", " ") } } n.className = e ? b.trim(r) : "" } } } return this }, toggleClass: function(e, t) { var n = typeof e,
                r = "boolean" == typeof t; return b.isFunction(e) ? this.each(function(n) { b(this).toggleClass(e.call(this, n, this.className, t), t) }) : this.each(function() { if ("string" === n) { var o, a = 0,
                        s = b(this),
                        u = t,
                        l = e.match(w) || []; while (o = l[a++]) { u = r ? u : !s.hasClass(o), s[u ? "addClass" : "removeClass"](o) } } else {
                    (n === i || "boolean" === n) && (this.className && b._data(this, "__className__", this.className), this.className = this.className || e === !1 ? "" : b._data(this, "__className__") || "") } }) }, hasClass: function(e) { var t = " " + e + " ",
                n = 0,
                r = this.length; for (; r > n; n++) { if (1 === this[n].nodeType && (" " + this[n].className + " ").replace(X, " ").indexOf(t) >= 0) { return !0 } } return !1 }, val: function(e) { var n, r, i, o = this[0]; if (arguments.length) { return i = b.isFunction(e), this.each(function(n) { var o, a = b(this);
                    1 === this.nodeType && (o = i ? e.call(this, n, a.val()) : e, null == o ? o = "" : "number" == typeof o ? o += "" : b.isArray(o) && (o = b.map(o, function(e) { return null == e ? "" : e + "" })), r = b.valHooks[this.type] || b.valHooks[this.nodeName.toLowerCase()], r && "set" in r && r.set(this, o, "value") !== t || (this.value = o)) }) } if (o) { return r = b.valHooks[o.type] || b.valHooks[o.nodeName.toLowerCase()], r && "get" in r && (n = r.get(o, "value")) !== t ? n : (n = o.value, "string" == typeof n ? n.replace(U, "") : null == n ? "" : n) } } }), b.extend({ valHooks: { option: { get: function(e) { var t = e.attributes.value; return !t || t.specified ? e.value : e.text } }, select: { get: function(e) { var t, n, r = e.options,
                        i = e.selectedIndex,
                        o = "select-one" === e.type || 0 > i,
                        a = o ? null : [],
                        s = o ? i + 1 : r.length,
                        u = 0 > i ? s : o ? i : 0; for (; s > u; u++) { if (n = r[u], !(!n.selected && u !== i || (b.support.optDisabled ? n.disabled : null !== n.getAttribute("disabled")) || n.parentNode.disabled && b.nodeName(n.parentNode, "optgroup"))) { if (t = b(n).val(), o) { return t } a.push(t) } } return a }, set: function(e, t) { var n = b.makeArray(t); return b(e).find("option").each(function() { this.selected = b.inArray(b(this).val(), n) >= 0 }), n.length || (e.selectedIndex = -1), n } } }, attr: function(e, n, r) { var o, a, s, u = e.nodeType; if (e && 3 !== u && 8 !== u && 2 !== u) { return typeof e.getAttribute === i ? b.prop(e, n, r) : (a = 1 !== u || !b.isXMLDoc(e), a && (n = n.toLowerCase(), o = b.attrHooks[n] || (J.test(n) ? z : I)), r === t ? o && a && "get" in o && null !== (s = o.get(e, n)) ? s : (typeof e.getAttribute !== i && (s = e.getAttribute(n)), null == s ? t : s) : null !== r ? o && a && "set" in o && (s = o.set(e, r, n)) !== t ? s : (e.setAttribute(n, r + ""), r) : (b.removeAttr(e, n), t)) } }, removeAttr: function(e, t) { var n, r, i = 0,
                o = t && t.match(w); if (o && 1 === e.nodeType) { while (n = o[i++]) { r = b.propFix[n] || n, J.test(n) ? !Q && G.test(n) ? e[b.camelCase("default-" + n)] = e[r] = !1 : e[r] = !1 : b.attr(e, n, ""), e.removeAttribute(Q ? n : r) } } }, attrHooks: { type: { set: function(e, t) { if (!b.support.radioValue && "radio" === t && b.nodeName(e, "input")) { var n = e.value; return e.setAttribute("type", t), n && (e.value = n), t } } } }, propFix: { tabindex: "tabIndex", readonly: "readOnly", "for": "htmlFor", "class": "className", maxlength: "maxLength", cellspacing: "cellSpacing", cellpadding: "cellPadding", rowspan: "rowSpan", colspan: "colSpan", usemap: "useMap", frameborder: "frameBorder", contenteditable: "contentEditable" }, prop: function(e, n, r) { var i, o, a, s = e.nodeType; if (e && 3 !== s && 8 !== s && 2 !== s) { return a = 1 !== s || !b.isXMLDoc(e), a && (n = b.propFix[n] || n, o = b.propHooks[n]), r !== t ? o && "set" in o && (i = o.set(e, r, n)) !== t ? i : e[n] = r : o && "get" in o && null !== (i = o.get(e, n)) ? i : e[n] } }, propHooks: { tabIndex: { get: function(e) { var n = e.getAttributeNode("tabindex"); return n && n.specified ? parseInt(n.value, 10) : V.test(e.nodeName) || Y.test(e.nodeName) && e.href ? 0 : t } } } }), z = { get: function(e, n) { var r = b.prop(e, n),
                i = "boolean" == typeof r && e.getAttribute(n),
                o = "boolean" == typeof r ? K && Q ? null != i : G.test(n) ? e[b.camelCase("default-" + n)] : !!i : e.getAttributeNode(n); return o && o.value !== !1 ? n.toLowerCase() : t }, set: function(e, t, n) { return t === !1 ? b.removeAttr(e, n) : K && Q || !G.test(n) ? e.setAttribute(!Q && b.propFix[n] || n, n) : e[b.camelCase("default-" + n)] = e[n] = !0, n } }, K && Q || (b.attrHooks.value = { get: function(e, n) { var r = e.getAttributeNode(n); return b.nodeName(e, "input") ? e.defaultValue : r && r.specified ? r.value : t }, set: function(e, n, r) { return b.nodeName(e, "input") ? (e.defaultValue = n, t) : I && I.set(e, n, r) } }), Q || (I = b.valHooks.button = { get: function(e, n) { var r = e.getAttributeNode(n); return r && ("id" === n || "name" === n || "coords" === n ? "" !== r.value : r.specified) ? r.value : t }, set: function(e, n, r) { var i = e.getAttributeNode(r); return i || e.setAttributeNode(i = e.ownerDocument.createAttribute(r)), i.value = n += "", "value" === r || n === e.getAttribute(r) ? n : t } }, b.attrHooks.contenteditable = { get: I.get, set: function(e, t, n) { I.set(e, "" === t ? !1 : t, n) } }, b.each(["width", "height"], function(e, n) { b.attrHooks[n] = b.extend(b.attrHooks[n], { set: function(e, r) { return "" === r ? (e.setAttribute(n, "auto"), r) : t } }) })), b.support.hrefNormalized || (b.each(["href", "src", "width", "height"], function(e, n) { b.attrHooks[n] = b.extend(b.attrHooks[n], { get: function(e) { var r = e.getAttribute(n, 2); return null == r ? t : r } }) }), b.each(["href", "src"], function(e, t) { b.propHooks[t] = { get: function(e) { return e.getAttribute(t, 4) } } })), b.support.style || (b.attrHooks.style = { get: function(e) { return e.style.cssText || t }, set: function(e, t) { return e.style.cssText = t + "" } }), b.support.optSelected || (b.propHooks.selected = b.extend(b.propHooks.selected, { get: function(e) { var t = e.parentNode; return t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex), null } })), b.support.enctype || (b.propFix.enctype = "encoding"), b.support.checkOn || b.each(["radio", "checkbox"], function() { b.valHooks[this] = { get: function(e) { return null === e.getAttribute("value") ? "on" : e.value } } }), b.each(["radio", "checkbox"], function() { b.valHooks[this] = b.extend(b.valHooks[this], { set: function(e, n) { return b.isArray(n) ? e.checked = b.inArray(b(e).val(), n) >= 0 : t } }) }); var Z = /^(?:input|select|textarea)$/i,
        et = /^key/,
        tt = /^(?:mouse|contextmenu)|click/,
        nt = /^(?:focusinfocus|focusoutblur)$/,
        rt = /^([^.]*)(?:\.(.+)|)$/;

    function it() { return !0 }

    function ot() { return !1 } b.event = { global: {}, add: function(e, n, r, o, a) { var s, u, l, c, p, f, d, h, g, m, y, v = b._data(e); if (v) { r.handler && (c = r, r = c.handler, a = c.selector), r.guid || (r.guid = b.guid++), (u = v.events) || (u = v.events = {}), (f = v.handle) || (f = v.handle = function(e) { return typeof b === i || e && b.event.triggered === e.type ? t : b.event.dispatch.apply(f.elem, arguments) }, f.elem = e), n = (n || "").match(w) || [""], l = n.length; while (l--) { s = rt.exec(n[l]) || [], g = y = s[1], m = (s[2] || "").split(".").sort(), p = b.event.special[g] || {}, g = (a ? p.delegateType : p.bindType) || g, p = b.event.special[g] || {}, d = b.extend({ type: g, origType: y, data: o, handler: r, guid: r.guid, selector: a, needsContext: a && b.expr.match.needsContext.test(a), namespace: m.join(".") }, c), (h = u[g]) || (h = u[g] = [], h.delegateCount = 0, p.setup && p.setup.call(e, o, m, f) !== !1 || (e.addEventListener ? e.addEventListener(g, f, !1) : e.attachEvent && e.attachEvent("on" + g, f))), p.add && (p.add.call(e, d), d.handler.guid || (d.handler.guid = r.guid)), a ? h.splice(h.delegateCount++, 0, d) : h.push(d), b.event.global[g] = !0 } e = null } }, remove: function(e, t, n, r, i) { var o, a, s, u, l, c, p, f, d, h, g, m = b.hasData(e) && b._data(e); if (m && (c = m.events)) { t = (t || "").match(w) || [""], l = t.length; while (l--) { if (s = rt.exec(t[l]) || [], d = g = s[1], h = (s[2] || "").split(".").sort(), d) { p = b.event.special[d] || {}, d = (r ? p.delegateType : p.bindType) || d, f = c[d] || [], s = s[2] && RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), u = o = f.length; while (o--) { a = f[o], !i && g !== a.origType || n && n.guid !== a.guid || s && !s.test(a.namespace) || r && r !== a.selector && ("**" !== r || !a.selector) || (f.splice(o, 1), a.selector && f.delegateCount--, p.remove && p.remove.call(e, a)) } u && !f.length && (p.teardown && p.teardown.call(e, h, m.handle) !== !1 || b.removeEvent(e, d, m.handle), delete c[d]) } else { for (d in c) { b.event.remove(e, d + t[l], n, r, !0) } } } b.isEmptyObject(c) && (delete m.handle, b._removeData(e, "events")) } }, trigger: function(n, r, i, a) { var s, u, l, c, p, f, d, h = [i || o],
                    g = y.call(n, "type") ? n.type : n,
                    m = y.call(n, "namespace") ? n.namespace.split(".") : []; if (l = f = i = i || o, 3 !== i.nodeType && 8 !== i.nodeType && !nt.test(g + b.event.triggered) && (g.indexOf(".") >= 0 && (m = g.split("."), g = m.shift(), m.sort()), u = 0 > g.indexOf(":") && "on" + g, n = n[b.expando] ? n : new b.Event(g, "object" == typeof n && n), n.isTrigger = !0, n.namespace = m.join("."), n.namespace_re = n.namespace ? RegExp("(^|\\.)" + m.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, n.result = t, n.target || (n.target = i), r = null == r ? [n] : b.makeArray(r, [n]), p = b.event.special[g] || {}, a || !p.trigger || p.trigger.apply(i, r) !== !1)) { if (!a && !p.noBubble && !b.isWindow(i)) { for (c = p.delegateType || g, nt.test(c + g) || (l = l.parentNode); l; l = l.parentNode) { h.push(l), f = l } f === (i.ownerDocument || o) && h.push(f.defaultView || f.parentWindow || e) } d = 0; while ((l = h[d++]) && !n.isPropagationStopped()) { n.type = d > 1 ? c : p.bindType || g, s = (b._data(l, "events") || {})[n.type] && b._data(l, "handle"), s && s.apply(l, r), s = u && l[u], s && b.acceptData(l) && s.apply && s.apply(l, r) === !1 && n.preventDefault() } if (n.type = g, !(a || n.isDefaultPrevented() || p._default && p._default.apply(i.ownerDocument, r) !== !1 || "click" === g && b.nodeName(i, "a") || !b.acceptData(i) || !u || !i[g] || b.isWindow(i))) { f = i[u], f && (i[u] = null), b.event.triggered = g; try { i[g]() } catch (v) {} b.event.triggered = t, f && (i[u] = f) } return n.result } }, dispatch: function(e) { e = b.event.fix(e); var n, r, i, o, a, s = [],
                    u = h.call(arguments),
                    l = (b._data(this, "events") || {})[e.type] || [],
                    c = b.event.special[e.type] || {}; if (u[0] = e, e.delegateTarget = this, !c.preDispatch || c.preDispatch.call(this, e) !== !1) { s = b.event.handlers.call(this, e, l), n = 0; while ((o = s[n++]) && !e.isPropagationStopped()) { e.currentTarget = o.elem, a = 0; while ((i = o.handlers[a++]) && !e.isImmediatePropagationStopped()) {
                            (!e.namespace_re || e.namespace_re.test(i.namespace)) && (e.handleObj = i, e.data = i.data, r = ((b.event.special[i.origType] || {}).handle || i.handler).apply(o.elem, u), r !== t && (e.result = r) === !1 && (e.preventDefault(), e.stopPropagation())) } } return c.postDispatch && c.postDispatch.call(this, e), e.result } }, handlers: function(e, n) { var r, i, o, a, s = [],
                    u = n.delegateCount,
                    l = e.target; if (u && l.nodeType && (!e.button || "click" !== e.type)) { for (; l != this; l = l.parentNode || this) { if (1 === l.nodeType && (l.disabled !== !0 || "click" !== e.type)) { for (o = [], a = 0; u > a; a++) { i = n[a], r = i.selector + " ", o[r] === t && (o[r] = i.needsContext ? b(r, this).index(l) >= 0 : b.find(r, this, null, [l]).length), o[r] && o.push(i) } o.length && s.push({ elem: l, handlers: o }) } } } return n.length > u && s.push({ elem: this, handlers: n.slice(u) }), s }, fix: function(e) { if (e[b.expando]) { return e } var t, n, r, i = e.type,
                    a = e,
                    s = this.fixHooks[i];
                s || (this.fixHooks[i] = s = tt.test(i) ? this.mouseHooks : et.test(i) ? this.keyHooks : {}), r = s.props ? this.props.concat(s.props) : this.props, e = new b.Event(a), t = r.length; while (t--) { n = r[t], e[n] = a[n] } return e.target || (e.target = a.srcElement || o), 3 === e.target.nodeType && (e.target = e.target.parentNode), e.metaKey = !!e.metaKey, s.filter ? s.filter(e, a) : e }, props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "), fixHooks: {}, keyHooks: { props: "char charCode key keyCode".split(" "), filter: function(e, t) { return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode), e } }, mouseHooks: { props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function(e, n) { var r, i, a, s = n.button,
                        u = n.fromElement; return null == e.pageX && null != n.clientX && (i = e.target.ownerDocument || o, a = i.documentElement, r = i.body, e.pageX = n.clientX + (a && a.scrollLeft || r && r.scrollLeft || 0) - (a && a.clientLeft || r && r.clientLeft || 0), e.pageY = n.clientY + (a && a.scrollTop || r && r.scrollTop || 0) - (a && a.clientTop || r && r.clientTop || 0)), !e.relatedTarget && u && (e.relatedTarget = u === e.target ? n.toElement : u), e.which || s === t || (e.which = 1 & s ? 1 : 2 & s ? 3 : 4 & s ? 2 : 0), e } }, special: { load: { noBubble: !0 }, click: { trigger: function() { return b.nodeName(this, "input") && "checkbox" === this.type && this.click ? (this.click(), !1) : t } }, focus: { trigger: function() { if (this !== o.activeElement && this.focus) { try { return this.focus(), !1 } catch (e) {} } }, delegateType: "focusin" }, blur: { trigger: function() { return this === o.activeElement && this.blur ? (this.blur(), !1) : t }, delegateType: "focusout" }, beforeunload: { postDispatch: function(e) { e.result !== t && (e.originalEvent.returnValue = e.result) } } }, simulate: function(e, t, n, r) { var i = b.extend(new b.Event, n, { type: e, isSimulated: !0, originalEvent: {} });
                r ? b.event.trigger(i, null, t) : b.event.dispatch.call(t, i), i.isDefaultPrevented() && n.preventDefault() } }, b.removeEvent = o.removeEventListener ? function(e, t, n) { e.removeEventListener && e.removeEventListener(t, n, !1) } : function(e, t, n) { var r = "on" + t;
            e.detachEvent && (typeof e[r] === i && (e[r] = null), e.detachEvent(r, n)) }, b.Event = function(e, n) { return this instanceof b.Event ? (e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || e.returnValue === !1 || e.getPreventDefault && e.getPreventDefault() ? it : ot) : this.type = e, n && b.extend(this, n), this.timeStamp = e && e.timeStamp || b.now(), this[b.expando] = !0, t) : new b.Event(e, n) }, b.Event.prototype = { isDefaultPrevented: ot, isPropagationStopped: ot, isImmediatePropagationStopped: ot, preventDefault: function() { var e = this.originalEvent;
                this.isDefaultPrevented = it, e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1) }, stopPropagation: function() { var e = this.originalEvent;
                this.isPropagationStopped = it, e && (e.stopPropagation && e.stopPropagation(), e.cancelBubble = !0) }, stopImmediatePropagation: function() { this.isImmediatePropagationStopped = it, this.stopPropagation() } }, b.each({ mouseenter: "mouseover", mouseleave: "mouseout" }, function(e, t) { b.event.special[e] = { delegateType: t, bindType: t, handle: function(e) { var n, r = this,
                        i = e.relatedTarget,
                        o = e.handleObj; return (!i || i !== r && !b.contains(r, i)) && (e.type = o.origType, n = o.handler.apply(this, arguments), e.type = t), n } } }), b.support.submitBubbles || (b.event.special.submit = { setup: function() { return b.nodeName(this, "form") ? !1 : (b.event.add(this, "click._submit keypress._submit", function(e) { var n = e.target,
                        r = b.nodeName(n, "input") || b.nodeName(n, "button") ? n.form : t;
                    r && !b._data(r, "submitBubbles") && (b.event.add(r, "submit._submit", function(e) { e._submit_bubble = !0 }), b._data(r, "submitBubbles", !0)) }), t) }, postDispatch: function(e) { e._submit_bubble && (delete e._submit_bubble, this.parentNode && !e.isTrigger && b.event.simulate("submit", this.parentNode, e, !0)) }, teardown: function() { return b.nodeName(this, "form") ? !1 : (b.event.remove(this, "._submit"), t) } }), b.support.changeBubbles || (b.event.special.change = { setup: function() { return Z.test(this.nodeName) ? (("checkbox" === this.type || "radio" === this.type) && (b.event.add(this, "propertychange._change", function(e) { "checked" === e.originalEvent.propertyName && (this._just_changed = !0) }), b.event.add(this, "click._change", function(e) { this._just_changed && !e.isTrigger && (this._just_changed = !1), b.event.simulate("change", this, e, !0) })), !1) : (b.event.add(this, "beforeactivate._change", function(e) { var t = e.target;
                    Z.test(t.nodeName) && !b._data(t, "changeBubbles") && (b.event.add(t, "change._change", function(e) {!this.parentNode || e.isSimulated || e.isTrigger || b.event.simulate("change", this.parentNode, e, !0) }), b._data(t, "changeBubbles", !0)) }), t) }, handle: function(e) { var n = e.target; return this !== n || e.isSimulated || e.isTrigger || "radio" !== n.type && "checkbox" !== n.type ? e.handleObj.handler.apply(this, arguments) : t }, teardown: function() { return b.event.remove(this, "._change"), !Z.test(this.nodeName) } }), b.support.focusinBubbles || b.each({ focus: "focusin", blur: "focusout" }, function(e, t) { var n = 0,
                r = function(e) { b.event.simulate(t, e.target, b.event.fix(e), !0) };
            b.event.special[t] = { setup: function() { 0 === n++ && o.addEventListener(e, r, !0) }, teardown: function() { 0 === --n && o.removeEventListener(e, r, !0) } } }), b.fn.extend({ on: function(e, n, r, i, o) { var a, s; if ("object" == typeof e) { "string" != typeof n && (r = r || n, n = t); for (a in e) { this.on(a, n, r, e[a], o) } return this } if (null == r && null == i ? (i = n, r = n = t) : null == i && ("string" == typeof n ? (i = r, r = t) : (i = r, r = n, n = t)), i === !1) { i = ot } else { if (!i) { return this } } return 1 === o && (s = i, i = function(e) { return b().off(e), s.apply(this, arguments) }, i.guid = s.guid || (s.guid = b.guid++)), this.each(function() { b.event.add(this, e, i, r, n) }) }, one: function(e, t, n, r) { return this.on(e, t, n, r, 1) }, off: function(e, n, r) { var i, o; if (e && e.preventDefault && e.handleObj) { return i = e.handleObj, b(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this } if ("object" == typeof e) { for (o in e) { this.off(o, n, e[o]) } return this } return (n === !1 || "function" == typeof n) && (r = n, n = t), r === !1 && (r = ot), this.each(function() { b.event.remove(this, e, r, n) }) }, bind: function(e, t, n) { return this.on(e, null, t, n) }, unbind: function(e, t) { return this.off(e, null, t) }, delegate: function(e, t, n, r) { return this.on(t, e, n, r) }, undelegate: function(e, t, n) { return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n) }, trigger: function(e, t) { return this.each(function() { b.event.trigger(e, t, this) }) }, triggerHandler: function(e, n) { var r = this[0]; return r ? b.event.trigger(e, n, r, !0) : t } }),
        function(e, t) { var n, r, i, o, a, s, u, l, c, p, f, d, h, g, m, y, v, x = "sizzle" + -new Date,
                w = e.document,
                T = {},
                N = 0,
                C = 0,
                k = it(),
                E = it(),
                S = it(),
                A = typeof t,
                j = 1 << 31,
                D = [],
                L = D.pop,
                H = D.push,
                q = D.slice,
                M = D.indexOf || function(e) { var t = 0,
                        n = this.length; for (; n > t; t++) { if (this[t] === e) { return t } } return -1 },
                _ = "[\\x20\\t\\r\\n\\f]",
                F = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",
                O = F.replace("w", "w#"),
                B = "([*^$|!~]?=)",
                P = "\\[" + _ + "*(" + F + ")" + _ + "*(?:" + B + _ + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + O + ")|)|)" + _ + "*\\]",
                R = ":(" + F + ")(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + P.replace(3, 8) + ")*)|.*)\\)|)",
                W = RegExp("^" + _ + "+|((?:^|[^\\\\])(?:\\\\.)*)" + _ + "+$", "g"),
                $ = RegExp("^" + _ + "*," + _ + "*"),
                I = RegExp("^" + _ + "*([\\x20\\t\\r\\n\\f>+~])" + _ + "*"),
                z = RegExp(R),
                X = RegExp("^" + O + "$"),
                U = { ID: RegExp("^#(" + F + ")"), CLASS: RegExp("^\\.(" + F + ")"), NAME: RegExp("^\\[name=['\"]?(" + F + ")['\"]?\\]"), TAG: RegExp("^(" + F.replace("w", "w*") + ")"), ATTR: RegExp("^" + P), PSEUDO: RegExp("^" + R), CHILD: RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + _ + "*(even|odd|(([+-]|)(\\d*)n|)" + _ + "*(?:([+-]|)" + _ + "*(\\d+)|))" + _ + "*\\)|)", "i"), needsContext: RegExp("^" + _ + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + _ + "*((?:-\\d)?\\d*)" + _ + "*\\)|)(?=[^-]|$)", "i") },
                V = /[\x20\t\r\n\f]*[+~]/,
                Y = /^[^{]+\{\s*\[native code/,
                J = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
                G = /^(?:input|select|textarea|button)$/i,
                Q = /^h\d$/i,
                K = /'|\\/g,
                Z = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
                et = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g,
                tt = function(e, t) { var n = "0x" + t - 65536; return n !== n ? t : 0 > n ? String.fromCharCode(n + 65536) : String.fromCharCode(55296 | n >> 10, 56320 | 1023 & n) }; try { q.call(w.documentElement.childNodes, 0)[0].nodeType } catch (nt) { q = function(e) { var t, n = []; while (t = this[e++]) { n.push(t) } return n } }

            function rt(e) { return Y.test(e + "") }

            function it() { var e, t = []; return e = function(n, r) { return t.push(n += " ") > i.cacheLength && delete e[t.shift()], e[n] = r } }

            function ot(e) { return e[x] = !0, e }

            function at(e) { var t = p.createElement("div"); try { return e(t) } catch (n) { return !1 } finally { t = null } }

            function st(e, t, n, r) { var i, o, a, s, u, l, f, g, m, v; if ((t ? t.ownerDocument || t : w) !== p && c(t), t = t || p, n = n || [], !e || "string" != typeof e) { return n } if (1 !== (s = t.nodeType) && 9 !== s) { return [] } if (!d && !r) { if (i = J.exec(e)) { if (a = i[1]) { if (9 === s) { if (o = t.getElementById(a), !o || !o.parentNode) { return n } if (o.id === a) { return n.push(o), n } } else { if (t.ownerDocument && (o = t.ownerDocument.getElementById(a)) && y(t, o) && o.id === a) { return n.push(o), n } } } else { if (i[2]) { return H.apply(n, q.call(t.getElementsByTagName(e), 0)), n } if ((a = i[3]) && T.getByClassName && t.getElementsByClassName) { return H.apply(n, q.call(t.getElementsByClassName(a), 0)), n } } } if (T.qsa && !h.test(e)) { if (f = !0, g = x, m = t, v = 9 === s && e, 1 === s && "object" !== t.nodeName.toLowerCase()) { l = ft(e), (f = t.getAttribute("id")) ? g = f.replace(K, "\\$&") : t.setAttribute("id", g), g = "[id='" + g + "'] ", u = l.length; while (u--) { l[u] = g + dt(l[u]) } m = V.test(e) && t.parentNode || t, v = l.join(",") } if (v) { try { return H.apply(n, q.call(m.querySelectorAll(v), 0)), n } catch (b) {} finally { f || t.removeAttribute("id") } } } } return wt(e.replace(W, "$1"), t, n, r) } a = st.isXML = function(e) { var t = e && (e.ownerDocument || e).documentElement; return t ? "HTML" !== t.nodeName : !1 }, c = st.setDocument = function(e) { var n = e ? e.ownerDocument || e : w; return n !== p && 9 === n.nodeType && n.documentElement ? (p = n, f = n.documentElement, d = a(n), T.tagNameNoComments = at(function(e) { return e.appendChild(n.createComment("")), !e.getElementsByTagName("*").length }), T.attributes = at(function(e) { e.innerHTML = "<select></select>"; var t = typeof e.lastChild.getAttribute("multiple"); return "boolean" !== t && "string" !== t }), T.getByClassName = at(function(e) { return e.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>", e.getElementsByClassName && e.getElementsByClassName("e").length ? (e.lastChild.className = "e", 2 === e.getElementsByClassName("e").length) : !1 }), T.getByName = at(function(e) { e.id = x + 0, e.innerHTML = "<a name='" + x + "'></a><div name='" + x + "'></div>", f.insertBefore(e, f.firstChild); var t = n.getElementsByName && n.getElementsByName(x).length === 2 + n.getElementsByName(x + 0).length; return T.getIdNotName = !n.getElementById(x), f.removeChild(e), t }), i.attrHandle = at(function(e) { return e.innerHTML = "<a href='#'></a>", e.firstChild && typeof e.firstChild.getAttribute !== A && "#" === e.firstChild.getAttribute("href") }) ? {} : { href: function(e) { return e.getAttribute("href", 2) }, type: function(e) { return e.getAttribute("type") } }, T.getIdNotName ? (i.find.ID = function(e, t) { if (typeof t.getElementById !== A && !d) { var n = t.getElementById(e); return n && n.parentNode ? [n] : [] } }, i.filter.ID = function(e) { var t = e.replace(et, tt); return function(e) { return e.getAttribute("id") === t } }) : (i.find.ID = function(e, n) { if (typeof n.getElementById !== A && !d) { var r = n.getElementById(e); return r ? r.id === e || typeof r.getAttributeNode !== A && r.getAttributeNode("id").value === e ? [r] : t : [] } }, i.filter.ID = function(e) { var t = e.replace(et, tt); return function(e) { var n = typeof e.getAttributeNode !== A && e.getAttributeNode("id"); return n && n.value === t } }), i.find.TAG = T.tagNameNoComments ? function(e, n) { return typeof n.getElementsByTagName !== A ? n.getElementsByTagName(e) : t } : function(e, t) { var n, r = [],
                        i = 0,
                        o = t.getElementsByTagName(e); if ("*" === e) { while (n = o[i++]) { 1 === n.nodeType && r.push(n) } return r } return o }, i.find.NAME = T.getByName && function(e, n) { return typeof n.getElementsByName !== A ? n.getElementsByName(name) : t }, i.find.CLASS = T.getByClassName && function(e, n) { return typeof n.getElementsByClassName === A || d ? t : n.getElementsByClassName(e) }, g = [], h = [":focus"], (T.qsa = rt(n.querySelectorAll)) && (at(function(e) { e.innerHTML = "<select><option selected=''></option></select>", e.querySelectorAll("[selected]").length || h.push("\\[" + _ + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)"), e.querySelectorAll(":checked").length || h.push(":checked") }), at(function(e) { e.innerHTML = "<input type='hidden' i=''/>", e.querySelectorAll("[i^='']").length && h.push("[*^$]=" + _ + "*(?:\"\"|'')"), e.querySelectorAll(":enabled").length || h.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), h.push(",.*:") })), (T.matchesSelector = rt(m = f.matchesSelector || f.mozMatchesSelector || f.webkitMatchesSelector || f.oMatchesSelector || f.msMatchesSelector)) && at(function(e) { T.disconnectedMatch = m.call(e, "div"), m.call(e, "[s!='']:x"), g.push("!=", R) }), h = RegExp(h.join("|")), g = RegExp(g.join("|")), y = rt(f.contains) || f.compareDocumentPosition ? function(e, t) { var n = 9 === e.nodeType ? e.documentElement : e,
                        r = t && t.parentNode; return e === r || !(!r || 1 !== r.nodeType || !(n.contains ? n.contains(r) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(r))) } : function(e, t) { if (t) { while (t = t.parentNode) { if (t === e) { return !0 } } } return !1 }, v = f.compareDocumentPosition ? function(e, t) { var r; return e === t ? (u = !0, 0) : (r = t.compareDocumentPosition && e.compareDocumentPosition && e.compareDocumentPosition(t)) ? 1 & r || e.parentNode && 11 === e.parentNode.nodeType ? e === n || y(w, e) ? -1 : t === n || y(w, t) ? 1 : 0 : 4 & r ? -1 : 1 : e.compareDocumentPosition ? -1 : 1 } : function(e, t) { var r, i = 0,
                        o = e.parentNode,
                        a = t.parentNode,
                        s = [e],
                        l = [t]; if (e === t) { return u = !0, 0 } if (!o || !a) { return e === n ? -1 : t === n ? 1 : o ? -1 : a ? 1 : 0 } if (o === a) { return ut(e, t) } r = e; while (r = r.parentNode) { s.unshift(r) } r = t; while (r = r.parentNode) { l.unshift(r) } while (s[i] === l[i]) { i++ } return i ? ut(s[i], l[i]) : s[i] === w ? -1 : l[i] === w ? 1 : 0 }, u = !1, [0, 0].sort(v), T.detectDuplicates = u, p) : p }, st.matches = function(e, t) { return st(e, null, null, t) }, st.matchesSelector = function(e, t) { if ((e.ownerDocument || e) !== p && c(e), t = t.replace(Z, "='$1']"), !(!T.matchesSelector || d || g && g.test(t) || h.test(t))) { try { var n = m.call(e, t); if (n || T.disconnectedMatch || e.document && 11 !== e.document.nodeType) { return n } } catch (r) {} } return st(t, p, null, [e]).length > 0 }, st.contains = function(e, t) { return (e.ownerDocument || e) !== p && c(e), y(e, t) }, st.attr = function(e, t) { var n; return (e.ownerDocument || e) !== p && c(e), d || (t = t.toLowerCase()), (n = i.attrHandle[t]) ? n(e) : d || T.attributes ? e.getAttribute(t) : ((n = e.getAttributeNode(t)) || e.getAttribute(t)) && e[t] === !0 ? t : n && n.specified ? n.value : null }, st.error = function(e) { throw Error("Syntax error, unrecognized expression: " + e) }, st.uniqueSort = function(e) { var t, n = [],
                    r = 1,
                    i = 0; if (u = !T.detectDuplicates, e.sort(v), u) { for (; t = e[r]; r++) { t === e[r - 1] && (i = n.push(r)) } while (i--) { e.splice(n[i], 1) } } return e };

            function ut(e, t) { var n = t && e,
                    r = n && (~t.sourceIndex || j) - (~e.sourceIndex || j); if (r) { return r } if (n) { while (n = n.nextSibling) { if (n === t) { return -1 } } } return e ? 1 : -1 }

            function lt(e) { return function(t) { var n = t.nodeName.toLowerCase(); return "input" === n && t.type === e } }

            function ct(e) { return function(t) { var n = t.nodeName.toLowerCase(); return ("input" === n || "button" === n) && t.type === e } }

            function pt(e) { return ot(function(t) { return t = +t, ot(function(n, r) { var i, o = e([], n.length, t),
                            a = o.length; while (a--) { n[i = o[a]] && (n[i] = !(r[i] = n[i])) } }) }) } o = st.getText = function(e) { var t, n = "",
                    r = 0,
                    i = e.nodeType; if (i) { if (1 === i || 9 === i || 11 === i) { if ("string" == typeof e.textContent) { return e.textContent } for (e = e.firstChild; e; e = e.nextSibling) { n += o(e) } } else { if (3 === i || 4 === i) { return e.nodeValue } } } else { for (; t = e[r]; r++) { n += o(t) } } return n }, i = st.selectors = { cacheLength: 50, createPseudo: ot, match: U, find: {}, relative: { ">": { dir: "parentNode", first: !0 }, " ": { dir: "parentNode" }, "+": { dir: "previousSibling", first: !0 }, "~": { dir: "previousSibling" } }, preFilter: { ATTR: function(e) { return e[1] = e[1].replace(et, tt), e[3] = (e[4] || e[5] || "").replace(et, tt), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4) }, CHILD: function(e) { return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || st.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && st.error(e[0]), e }, PSEUDO: function(e) { var t, n = !e[5] && e[2]; return U.CHILD.test(e[0]) ? null : (e[4] ? e[2] = e[4] : n && z.test(n) && (t = ft(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3)) } }, filter: { TAG: function(e) { return "*" === e ? function() { return !0 } : (e = e.replace(et, tt).toLowerCase(), function(t) { return t.nodeName && t.nodeName.toLowerCase() === e }) }, CLASS: function(e) { var t = k[e + " "]; return t || (t = RegExp("(^|" + _ + ")" + e + "(" + _ + "|$)")) && k(e, function(e) { return t.test(e.className || typeof e.getAttribute !== A && e.getAttribute("class") || "") }) }, ATTR: function(e, t, n) { return function(r) { var i = st.attr(r, e); return null == i ? "!=" === t : t ? (i += "", "=" === t ? i === n : "!=" === t ? i !== n : "^=" === t ? n && 0 === i.indexOf(n) : "*=" === t ? n && i.indexOf(n) > -1 : "$=" === t ? n && i.slice(-n.length) === n : "~=" === t ? (" " + i + " ").indexOf(n) > -1 : "|=" === t ? i === n || i.slice(0, n.length + 1) === n + "-" : !1) : !0 } }, CHILD: function(e, t, n, r, i) { var o = "nth" !== e.slice(0, 3),
                            a = "last" !== e.slice(-4),
                            s = "of-type" === t; return 1 === r && 0 === i ? function(e) { return !!e.parentNode } : function(t, n, u) { var l, c, p, f, d, h, g = o !== a ? "nextSibling" : "previousSibling",
                                m = t.parentNode,
                                y = s && t.nodeName.toLowerCase(),
                                v = !u && !s; if (m) { if (o) { while (g) { p = t; while (p = p[g]) { if (s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) { return !1 } } h = g = "only" === e && !h && "nextSibling" } return !0 } if (h = [a ? m.firstChild : m.lastChild], a && v) { c = m[x] || (m[x] = {}), l = c[e] || [], d = l[0] === N && l[1], f = l[0] === N && l[2], p = d && m.childNodes[d]; while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) { if (1 === p.nodeType && ++f && p === t) { c[e] = [N, d, f]; break } } } else { if (v && (l = (t[x] || (t[x] = {}))[e]) && l[0] === N) { f = l[1] } else { while (p = ++d && p && p[g] || (f = d = 0) || h.pop()) { if ((s ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) && ++f && (v && ((p[x] || (p[x] = {}))[e] = [N, f]), p === t)) { break } } } } return f -= i, f === r || 0 === f % r && f / r >= 0 } } }, PSEUDO: function(e, t) { var n, r = i.pseudos[e] || i.setFilters[e.toLowerCase()] || st.error("unsupported pseudo: " + e); return r[x] ? r(t) : r.length > 1 ? (n = [e, e, "", t], i.setFilters.hasOwnProperty(e.toLowerCase()) ? ot(function(e, n) { var i, o = r(e, t),
                                a = o.length; while (a--) { i = M.call(e, o[a]), e[i] = !(n[i] = o[a]) } }) : function(e) { return r(e, 0, n) }) : r } }, pseudos: { not: ot(function(e) { var t = [],
                            n = [],
                            r = s(e.replace(W, "$1")); return r[x] ? ot(function(e, t, n, i) { var o, a = r(e, null, i, []),
                                s = e.length; while (s--) {
                                (o = a[s]) && (e[s] = !(t[s] = o)) } }) : function(e, i, o) { return t[0] = e, r(t, null, o, n), !n.pop() } }), has: ot(function(e) { return function(t) { return st(e, t).length > 0 } }), contains: ot(function(e) { return function(t) { return (t.textContent || t.innerText || o(t)).indexOf(e) > -1 } }), lang: ot(function(e) { return X.test(e || "") || st.error("unsupported lang: " + e), e = e.replace(et, tt).toLowerCase(),
                            function(t) { var n;
                                do { if (n = d ? t.getAttribute("xml:lang") || t.getAttribute("lang") : t.lang) { return n = n.toLowerCase(), n === e || 0 === n.indexOf(e + "-") } } while ((t = t.parentNode) && 1 === t.nodeType); return !1 } }), target: function(t) { var n = e.location && e.location.hash; return n && n.slice(1) === t.id }, root: function(e) { return e === f }, focus: function(e) { return e === p.activeElement && (!p.hasFocus || p.hasFocus()) && !!(e.type || e.href || ~e.tabIndex) }, enabled: function(e) { return e.disabled === !1 }, disabled: function(e) { return e.disabled === !0 }, checked: function(e) { var t = e.nodeName.toLowerCase(); return "input" === t && !!e.checked || "option" === t && !!e.selected }, selected: function(e) { return e.parentNode && e.parentNode.selectedIndex, e.selected === !0 }, empty: function(e) { for (e = e.firstChild; e; e = e.nextSibling) { if (e.nodeName > "@" || 3 === e.nodeType || 4 === e.nodeType) { return !1 } } return !0 }, parent: function(e) { return !i.pseudos.empty(e) }, header: function(e) { return Q.test(e.nodeName) }, input: function(e) { return G.test(e.nodeName) }, button: function(e) { var t = e.nodeName.toLowerCase(); return "input" === t && "button" === e.type || "button" === t }, text: function(e) { var t; return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || t.toLowerCase() === e.type) }, first: pt(function() { return [0] }), last: pt(function(e, t) { return [t - 1] }), eq: pt(function(e, t, n) { return [0 > n ? n + t : n] }), even: pt(function(e, t) { var n = 0; for (; t > n; n += 2) { e.push(n) } return e }), odd: pt(function(e, t) { var n = 1; for (; t > n; n += 2) { e.push(n) } return e }), lt: pt(function(e, t, n) { var r = 0 > n ? n + t : n; for (; --r >= 0;) { e.push(r) } return e }), gt: pt(function(e, t, n) { var r = 0 > n ? n + t : n; for (; t > ++r;) { e.push(r) } return e }) } }; for (n in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) { i.pseudos[n] = lt(n) } for (n in { submit: !0, reset: !0 }) { i.pseudos[n] = ct(n) }

            function ft(e, t) { var n, r, o, a, s, u, l, c = E[e + " "]; if (c) { return t ? 0 : c.slice(0) } s = e, u = [], l = i.preFilter; while (s) {
                    (!n || (r = $.exec(s))) && (r && (s = s.slice(r[0].length) || s), u.push(o = [])), n = !1, (r = I.exec(s)) && (n = r.shift(), o.push({ value: n, type: r[0].replace(W, " ") }), s = s.slice(n.length)); for (a in i.filter) {!(r = U[a].exec(s)) || l[a] && !(r = l[a](r)) || (n = r.shift(), o.push({ value: n, type: a, matches: r }), s = s.slice(n.length)) } if (!n) { break } } return t ? s.length : s ? st.error(e) : E(e, u).slice(0) }

            function dt(e) { var t = 0,
                    n = e.length,
                    r = ""; for (; n > t; t++) { r += e[t].value } return r }

            function ht(e, t, n) { var i = t.dir,
                    o = n && "parentNode" === i,
                    a = C++; return t.first ? function(t, n, r) { while (t = t[i]) { if (1 === t.nodeType || o) { return e(t, n, r) } } } : function(t, n, s) { var u, l, c, p = N + " " + a; if (s) { while (t = t[i]) { if ((1 === t.nodeType || o) && e(t, n, s)) { return !0 } } } else { while (t = t[i]) { if (1 === t.nodeType || o) { if (c = t[x] || (t[x] = {}), (l = c[i]) && l[0] === p) { if ((u = l[1]) === !0 || u === r) { return u === !0 } } else { if (l = c[i] = [p], l[1] = e(t, n, s) || r, l[1] === !0) { return !0 } } } } } } }

            function gt(e) { return e.length > 1 ? function(t, n, r) { var i = e.length; while (i--) { if (!e[i](t, n, r)) { return !1 } } return !0 } : e[0] }

            function mt(e, t, n, r, i) { var o, a = [],
                    s = 0,
                    u = e.length,
                    l = null != t; for (; u > s; s++) {
                    (o = e[s]) && (!n || n(o, r, i)) && (a.push(o), l && t.push(s)) } return a }

            function yt(e, t, n, r, i, o) { return r && !r[x] && (r = yt(r)), i && !i[x] && (i = yt(i, o)), ot(function(o, a, s, u) { var l, c, p, f = [],
                        d = [],
                        h = a.length,
                        g = o || xt(t || "*", s.nodeType ? [s] : s, []),
                        m = !e || !o && t ? g : mt(g, f, e, s, u),
                        y = n ? i || (o ? e : h || r) ? [] : a : m; if (n && n(m, y, s, u), r) { l = mt(y, d), r(l, [], s, u), c = l.length; while (c--) {
                            (p = l[c]) && (y[d[c]] = !(m[d[c]] = p)) } } if (o) { if (i || e) { if (i) { l = [], c = y.length; while (c--) {
                                    (p = y[c]) && l.push(m[c] = p) } i(null, y = [], l, u) } c = y.length; while (c--) {
                                (p = y[c]) && (l = i ? M.call(o, p) : f[c]) > -1 && (o[l] = !(a[l] = p)) } } } else { y = mt(y === a ? y.splice(h, y.length) : y), i ? i(null, a, y, u) : H.apply(a, y) } }) }

            function vt(e) { var t, n, r, o = e.length,
                    a = i.relative[e[0].type],
                    s = a || i.relative[" "],
                    u = a ? 1 : 0,
                    c = ht(function(e) { return e === t }, s, !0),
                    p = ht(function(e) { return M.call(t, e) > -1 }, s, !0),
                    f = [function(e, n, r) { return !a && (r || n !== l) || ((t = n).nodeType ? c(e, n, r) : p(e, n, r)) }]; for (; o > u; u++) { if (n = i.relative[e[u].type]) { f = [ht(gt(f), n)] } else { if (n = i.filter[e[u].type].apply(null, e[u].matches), n[x]) { for (r = ++u; o > r; r++) { if (i.relative[e[r].type]) { break } } return yt(u > 1 && gt(f), u > 1 && dt(e.slice(0, u - 1)).replace(W, "$1"), n, r > u && vt(e.slice(u, r)), o > r && vt(e = e.slice(r)), o > r && dt(e)) } f.push(n) } } return gt(f) }

            function bt(e, t) { var n = 0,
                    o = t.length > 0,
                    a = e.length > 0,
                    s = function(s, u, c, f, d) { var h, g, m, y = [],
                            v = 0,
                            b = "0",
                            x = s && [],
                            w = null != d,
                            T = l,
                            C = s || a && i.find.TAG("*", d && u.parentNode || u),
                            k = N += null == T ? 1 : Math.random() || 0.1; for (w && (l = u !== p && u, r = n); null != (h = C[b]); b++) { if (a && h) { g = 0; while (m = e[g++]) { if (m(h, u, c)) { f.push(h); break } } w && (N = k, r = ++n) } o && ((h = !m && h) && v--, s && x.push(h)) } if (v += b, o && b !== v) { g = 0; while (m = t[g++]) { m(x, y, u, c) } if (s) { if (v > 0) { while (b--) { x[b] || y[b] || (y[b] = L.call(f)) } } y = mt(y) } H.apply(f, y), w && !s && y.length > 0 && v + t.length > 1 && st.uniqueSort(f) } return w && (N = k, l = T), x }; return o ? ot(s) : s } s = st.compile = function(e, t) { var n, r = [],
                    i = [],
                    o = S[e + " "]; if (!o) { t || (t = ft(e)), n = t.length; while (n--) { o = vt(t[n]), o[x] ? r.push(o) : i.push(o) } o = S(e, bt(i, r)) } return o };

            function xt(e, t, n) { var r = 0,
                    i = t.length; for (; i > r; r++) { st(e, t[r], n) } return n }

            function wt(e, t, n, r) { var o, a, u, l, c, p = ft(e); if (!r && 1 === p.length) { if (a = p[0] = p[0].slice(0), a.length > 2 && "ID" === (u = a[0]).type && 9 === t.nodeType && !d && i.relative[a[1].type]) { if (t = i.find.ID(u.matches[0].replace(et, tt), t)[0], !t) { return n } e = e.slice(a.shift().value.length) } o = U.needsContext.test(e) ? 0 : a.length; while (o--) { if (u = a[o], i.relative[l = u.type]) { break } if ((c = i.find[l]) && (r = c(u.matches[0].replace(et, tt), V.test(a[0].type) && t.parentNode || t))) { if (a.splice(o, 1), e = r.length && dt(a), !e) { return H.apply(n, q.call(r, 0)), n } break } } } return s(e, p)(r, t, d, n, V.test(e)), n } i.pseudos.nth = i.pseudos.eq;

            function Tt() {} i.filters = Tt.prototype = i.pseudos, i.setFilters = new Tt, c(), st.attr = b.attr, b.find = st, b.expr = st.selectors, b.expr[":"] = b.expr.pseudos, b.unique = st.uniqueSort, b.text = st.getText, b.isXMLDoc = st.isXML, b.contains = st.contains }(e); var at = /Until$/,
        st = /^(?:parents|prev(?:Until|All))/,
        ut = /^.[^:#\[\.,]*$/,
        lt = b.expr.match.needsContext,
        ct = { children: !0, contents: !0, next: !0, prev: !0 };
    b.fn.extend({ find: function(e) { var t, n, r, i = this.length; if ("string" != typeof e) { return r = this, this.pushStack(b(e).filter(function() { for (t = 0; i > t; t++) { if (b.contains(r[t], this)) { return !0 } } })) } for (n = [], t = 0; i > t; t++) { b.find(e, this[t], n) } return n = this.pushStack(i > 1 ? b.unique(n) : n), n.selector = (this.selector ? this.selector + " " : "") + e, n }, has: function(e) { var t, n = b(e, this),
                r = n.length; return this.filter(function() { for (t = 0; r > t; t++) { if (b.contains(this, n[t])) { return !0 } } }) }, not: function(e) { return this.pushStack(ft(this, e, !1)) }, filter: function(e) { return this.pushStack(ft(this, e, !0)) }, is: function(e) { return !!e && ("string" == typeof e ? lt.test(e) ? b(e, this.context).index(this[0]) >= 0 : b.filter(e, this).length > 0 : this.filter(e).length > 0) }, closest: function(e, t) { var n, r = 0,
                i = this.length,
                o = [],
                a = lt.test(e) || "string" != typeof e ? b(e, t || this.context) : 0; for (; i > r; r++) { n = this[r]; while (n && n.ownerDocument && n !== t && 11 !== n.nodeType) { if (a ? a.index(n) > -1 : b.find.matchesSelector(n, e)) { o.push(n); break } n = n.parentNode } } return this.pushStack(o.length > 1 ? b.unique(o) : o) }, index: function(e) { return e ? "string" == typeof e ? b.inArray(this[0], b(e)) : b.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1 }, add: function(e, t) { var n = "string" == typeof e ? b(e, t) : b.makeArray(e && e.nodeType ? [e] : e),
                r = b.merge(this.get(), n); return this.pushStack(b.unique(r)) }, addBack: function(e) { return this.add(null == e ? this.prevObject : this.prevObject.filter(e)) } }), b.fn.andSelf = b.fn.addBack;

    function pt(e, t) { do { e = e[t] } while (e && 1 !== e.nodeType); return e } b.each({ parent: function(e) { var t = e.parentNode; return t && 11 !== t.nodeType ? t : null }, parents: function(e) { return b.dir(e, "parentNode") }, parentsUntil: function(e, t, n) { return b.dir(e, "parentNode", n) }, next: function(e) { return pt(e, "nextSibling") }, prev: function(e) { return pt(e, "previousSibling") }, nextAll: function(e) { return b.dir(e, "nextSibling") }, prevAll: function(e) { return b.dir(e, "previousSibling") }, nextUntil: function(e, t, n) { return b.dir(e, "nextSibling", n) }, prevUntil: function(e, t, n) { return b.dir(e, "previousSibling", n) }, siblings: function(e) { return b.sibling((e.parentNode || {}).firstChild, e) }, children: function(e) { return b.sibling(e.firstChild) }, contents: function(e) { return b.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : b.merge([], e.childNodes) } }, function(e, t) { b.fn[e] = function(n, r) { var i = b.map(this, t, n); return at.test(e) || (r = n), r && "string" == typeof r && (i = b.filter(r, i)), i = this.length > 1 && !ct[e] ? b.unique(i) : i, this.length > 1 && st.test(e) && (i = i.reverse()), this.pushStack(i) } }), b.extend({ filter: function(e, t, n) { return n && (e = ":not(" + e + ")"), 1 === t.length ? b.find.matchesSelector(t[0], e) ? [t[0]] : [] : b.find.matches(e, t) }, dir: function(e, n, r) { var i = [],
                o = e[n]; while (o && 9 !== o.nodeType && (r === t || 1 !== o.nodeType || !b(o).is(r))) { 1 === o.nodeType && i.push(o), o = o[n] } return i }, sibling: function(e, t) { var n = []; for (; e; e = e.nextSibling) { 1 === e.nodeType && e !== t && n.push(e) } return n } });

    function ft(e, t, n) { if (t = t || 0, b.isFunction(t)) { return b.grep(e, function(e, r) { var i = !!t.call(e, r, e); return i === n }) } if (t.nodeType) { return b.grep(e, function(e) { return e === t === n }) } if ("string" == typeof t) { var r = b.grep(e, function(e) { return 1 === e.nodeType }); if (ut.test(t)) { return b.filter(t, r, !n) } t = b.filter(t, r) } return b.grep(e, function(e) { return b.inArray(e, t) >= 0 === n }) }

    function dt(e) { var t = ht.split("|"),
            n = e.createDocumentFragment(); if (n.createElement) { while (t.length) { n.createElement(t.pop()) } } return n } var ht = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
        gt = / jQuery\d+="(?:null|\d+)"/g,
        mt = RegExp("<(?:" + ht + ")[\\s/>]", "i"),
        yt = /^\s+/,
        vt = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
        bt = /<([\w:]+)/,
        xt = /<tbody/i,
        wt = /<|&#?\w+;/,
        Tt = /<(?:script|style|link)/i,
        Nt = /^(?:checkbox|radio)$/i,
        Ct = /checked\s*(?:[^=]|=\s*.checked.)/i,
        kt = /^$|\/(?:java|ecma)script/i,
        Et = /^true\/(.*)/,
        St = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,
        At = { option: [1, "<select multiple='multiple'>", "</select>"], legend: [1, "<fieldset>", "</fieldset>"], area: [1, "<map>", "</map>"], param: [1, "<object>", "</object>"], thead: [1, "<table>", "</table>"], tr: [2, "<table><tbody>", "</tbody></table>"], col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"], td: [3, "<table><tbody><tr>", "</tr></tbody></table>"], _default: b.support.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"] },
        jt = dt(o),
        Dt = jt.appendChild(o.createElement("div"));
    At.optgroup = At.option, At.tbody = At.tfoot = At.colgroup = At.caption = At.thead, At.th = At.td, b.fn.extend({ text: function(e) { return b.access(this, function(e) { return e === t ? b.text(this) : this.empty().append((this[0] && this[0].ownerDocument || o).createTextNode(e)) }, null, e, arguments.length) }, wrapAll: function(e) { if (b.isFunction(e)) { return this.each(function(t) { b(this).wrapAll(e.call(this, t)) }) } if (this[0]) { var t = b(e, this[0].ownerDocument).eq(0).clone(!0);
                this[0].parentNode && t.insertBefore(this[0]), t.map(function() { var e = this; while (e.firstChild && 1 === e.firstChild.nodeType) { e = e.firstChild } return e }).append(this) } return this }, wrapInner: function(e) { return b.isFunction(e) ? this.each(function(t) { b(this).wrapInner(e.call(this, t)) }) : this.each(function() { var t = b(this),
                    n = t.contents();
                n.length ? n.wrapAll(e) : t.append(e) }) }, wrap: function(e) { var t = b.isFunction(e); return this.each(function(n) { b(this).wrapAll(t ? e.call(this, n) : e) }) }, unwrap: function() { return this.parent().each(function() { b.nodeName(this, "body") || b(this).replaceWith(this.childNodes) }).end() }, append: function() { return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.appendChild(e) }) }, prepend: function() { return this.domManip(arguments, !0, function(e) {
                (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) && this.insertBefore(e, this.firstChild) }) }, before: function() { return this.domManip(arguments, !1, function(e) { this.parentNode && this.parentNode.insertBefore(e, this) }) }, after: function() { return this.domManip(arguments, !1, function(e) { this.parentNode && this.parentNode.insertBefore(e, this.nextSibling) }) }, remove: function(e, t) { var n, r = 0; for (; null != (n = this[r]); r++) {
                (!e || b.filter(e, [n]).length > 0) && (t || 1 !== n.nodeType || b.cleanData(Ot(n)), n.parentNode && (t && b.contains(n.ownerDocument, n) && Mt(Ot(n, "script")), n.parentNode.removeChild(n))) } return this }, empty: function() { var e, t = 0; for (; null != (e = this[t]); t++) { 1 === e.nodeType && b.cleanData(Ot(e, !1)); while (e.firstChild) { e.removeChild(e.firstChild) } e.options && b.nodeName(e, "select") && (e.options.length = 0) } return this }, clone: function(e, t) { return e = null == e ? !1 : e, t = null == t ? e : t, this.map(function() { return b.clone(this, e, t) }) }, html: function(e) { return b.access(this, function(e) { var n = this[0] || {},
                    r = 0,
                    i = this.length; if (e === t) { return 1 === n.nodeType ? n.innerHTML.replace(gt, "") : t } if (!("string" != typeof e || Tt.test(e) || !b.support.htmlSerialize && mt.test(e) || !b.support.leadingWhitespace && yt.test(e) || At[(bt.exec(e) || ["", ""])[1].toLowerCase()])) { e = e.replace(vt, "<$1></$2>"); try { for (; i > r; r++) { n = this[r] || {}, 1 === n.nodeType && (b.cleanData(Ot(n, !1)), n.innerHTML = e) } n = 0 } catch (o) {} } n && this.empty().append(e) }, null, e, arguments.length) }, replaceWith: function(e) { var t = b.isFunction(e); return t || "string" == typeof e || (e = b(e).not(this).detach()), this.domManip([e], !0, function(e) { var t = this.nextSibling,
                    n = this.parentNode;
                n && (b(this).remove(), n.insertBefore(e, t)) }) }, detach: function(e) { return this.remove(e, !0) }, domManip: function(e, n, r) { e = f.apply([], e); var i, o, a, s, u, l, c = 0,
                p = this.length,
                d = this,
                h = p - 1,
                g = e[0],
                m = b.isFunction(g); if (m || !(1 >= p || "string" != typeof g || b.support.checkClone) && Ct.test(g)) { return this.each(function(i) { var o = d.eq(i);
                    m && (e[0] = g.call(this, i, n ? o.html() : t)), o.domManip(e, n, r) }) } if (p && (l = b.buildFragment(e, this[0].ownerDocument, !1, this), i = l.firstChild, 1 === l.childNodes.length && (l = i), i)) { for (n = n && b.nodeName(i, "tr"), s = b.map(Ot(l, "script"), Ht), a = s.length; p > c; c++) { o = l, c !== h && (o = b.clone(o, !0, !0), a && b.merge(s, Ot(o, "script"))), r.call(n && b.nodeName(this[c], "table") ? Lt(this[c], "tbody") : this[c], o, c) } if (a) { for (u = s[s.length - 1].ownerDocument, b.map(s, qt), c = 0; a > c; c++) { o = s[c], kt.test(o.type || "") && !b._data(o, "globalEval") && b.contains(u, o) && (o.src ? b.ajax({ url: o.src, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0 }) : b.globalEval((o.text || o.textContent || o.innerHTML || "").replace(St, ""))) } } l = i = null } return this } });

    function Lt(e, t) { return e.getElementsByTagName(t)[0] || e.appendChild(e.ownerDocument.createElement(t)) }

    function Ht(e) { var t = e.getAttributeNode("type"); return e.type = (t && t.specified) + "/" + e.type, e }

    function qt(e) { var t = Et.exec(e.type); return t ? e.type = t[1] : e.removeAttribute("type"), e }

    function Mt(e, t) { var n, r = 0; for (; null != (n = e[r]); r++) { b._data(n, "globalEval", !t || b._data(t[r], "globalEval")) } }

    function _t(e, t) { if (1 === t.nodeType && b.hasData(e)) { var n, r, i, o = b._data(e),
                a = b._data(t, o),
                s = o.events; if (s) { delete a.handle, a.events = {}; for (n in s) { for (r = 0, i = s[n].length; i > r; r++) { b.event.add(t, n, s[n][r]) } } } a.data && (a.data = b.extend({}, a.data)) } }

    function Ft(e, t) { var n, r, i; if (1 === t.nodeType) { if (n = t.nodeName.toLowerCase(), !b.support.noCloneEvent && t[b.expando]) { i = b._data(t); for (r in i.events) { b.removeEvent(t, r, i.handle) } t.removeAttribute(b.expando) } "script" === n && t.text !== e.text ? (Ht(t).text = e.text, qt(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML), b.support.html5Clone && e.innerHTML && !b.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Nt.test(e.type) ? (t.defaultChecked = t.checked = e.checked, t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : ("input" === n || "textarea" === n) && (t.defaultValue = e.defaultValue) } } b.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function(e, t) { b.fn[e] = function(e) { var n, r = 0,
                i = [],
                o = b(e),
                a = o.length - 1; for (; a >= r; r++) { n = r === a ? this : this.clone(!0), b(o[r])[t](n), d.apply(i, n.get()) } return this.pushStack(i) } });

    function Ot(e, n) { var r, o, a = 0,
            s = typeof e.getElementsByTagName !== i ? e.getElementsByTagName(n || "*") : typeof e.querySelectorAll !== i ? e.querySelectorAll(n || "*") : t; if (!s) { for (s = [], r = e.childNodes || e; null != (o = r[a]); a++) {!n || b.nodeName(o, n) ? s.push(o) : b.merge(s, Ot(o, n)) } } return n === t || n && b.nodeName(e, n) ? b.merge([e], s) : s }

    function Bt(e) { Nt.test(e.type) && (e.defaultChecked = e.checked) } b.extend({ clone: function(e, t, n) { var r, i, o, a, s, u = b.contains(e.ownerDocument, e); if (b.support.html5Clone || b.isXMLDoc(e) || !mt.test("<" + e.nodeName + ">") ? o = e.cloneNode(!0) : (Dt.innerHTML = e.outerHTML, Dt.removeChild(o = Dt.firstChild)), !(b.support.noCloneEvent && b.support.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || b.isXMLDoc(e))) { for (r = Ot(o), s = Ot(e), a = 0; null != (i = s[a]); ++a) { r[a] && Ft(i, r[a]) } } if (t) { if (n) { for (s = s || Ot(e), r = r || Ot(o), a = 0; null != (i = s[a]); a++) { _t(i, r[a]) } } else { _t(e, o) } } return r = Ot(o, "script"), r.length > 0 && Mt(r, !u && Ot(e, "script")), r = s = i = null, o }, buildFragment: function(e, t, n, r) { var i, o, a, s, u, l, c, p = e.length,
                f = dt(t),
                d = [],
                h = 0; for (; p > h; h++) { if (o = e[h], o || 0 === o) { if ("object" === b.type(o)) { b.merge(d, o.nodeType ? [o] : o) } else { if (wt.test(o)) { s = s || f.appendChild(t.createElement("div")), u = (bt.exec(o) || ["", ""])[1].toLowerCase(), c = At[u] || At._default, s.innerHTML = c[1] + o.replace(vt, "<$1></$2>") + c[2], i = c[0]; while (i--) { s = s.lastChild } if (!b.support.leadingWhitespace && yt.test(o) && d.push(t.createTextNode(yt.exec(o)[0])), !b.support.tbody) { o = "table" !== u || xt.test(o) ? "<table>" !== c[1] || xt.test(o) ? 0 : s : s.firstChild, i = o && o.childNodes.length; while (i--) { b.nodeName(l = o.childNodes[i], "tbody") && !l.childNodes.length && o.removeChild(l) } } b.merge(d, s.childNodes), s.textContent = ""; while (s.firstChild) { s.removeChild(s.firstChild) } s = f.lastChild } else { d.push(t.createTextNode(o)) } } } } s && f.removeChild(s), b.support.appendChecked || b.grep(Ot(d, "input"), Bt), h = 0; while (o = d[h++]) { if ((!r || -1 === b.inArray(o, r)) && (a = b.contains(o.ownerDocument, o), s = Ot(f.appendChild(o), "script"), a && Mt(s), n)) { i = 0; while (o = s[i++]) { kt.test(o.type || "") && n.push(o) } } } return s = null, f }, cleanData: function(e, t) { var n, r, o, a, s = 0,
                u = b.expando,
                l = b.cache,
                p = b.support.deleteExpando,
                f = b.event.special; for (; null != (n = e[s]); s++) { if ((t || b.acceptData(n)) && (o = n[u], a = o && l[o])) { if (a.events) { for (r in a.events) { f[r] ? b.event.remove(n, r) : b.removeEvent(n, r, a.handle) } } l[o] && (delete l[o], p ? delete n[u] : typeof n.removeAttribute !== i ? n.removeAttribute(u) : n[u] = null, c.push(o)) } } } }); var Pt, Rt, Wt, $t = /alpha\([^)]*\)/i,
        It = /opacity\s*=\s*([^)]*)/,
        zt = /^(top|right|bottom|left)$/,
        Xt = /^(none|table(?!-c[ea]).+)/,
        Ut = /^margin/,
        Vt = RegExp("^(" + x + ")(.*)$", "i"),
        Yt = RegExp("^(" + x + ")(?!px)[a-z%]+$", "i"),
        Jt = RegExp("^([+-])=(" + x + ")", "i"),
        Gt = { BODY: "block" },
        Qt = { position: "absolute", visibility: "hidden", display: "block" },
        Kt = { letterSpacing: 0, fontWeight: 400 },
        Zt = ["Top", "Right", "Bottom", "Left"],
        en = ["Webkit", "O", "Moz", "ms"];

    function tn(e, t) { if (t in e) { return t } var n = t.charAt(0).toUpperCase() + t.slice(1),
            r = t,
            i = en.length; while (i--) { if (t = en[i] + n, t in e) { return t } } return r }

    function nn(e, t) { return e = t || e, "none" === b.css(e, "display") || !b.contains(e.ownerDocument, e) }

    function rn(e, t) { var n, r, i, o = [],
            a = 0,
            s = e.length; for (; s > a; a++) { r = e[a], r.style && (o[a] = b._data(r, "olddisplay"), n = r.style.display, t ? (o[a] || "none" !== n || (r.style.display = ""), "" === r.style.display && nn(r) && (o[a] = b._data(r, "olddisplay", un(r.nodeName)))) : o[a] || (i = nn(r), (n && "none" !== n || !i) && b._data(r, "olddisplay", i ? n : b.css(r, "display")))) } for (a = 0; s > a; a++) { r = e[a], r.style && (t && "none" !== r.style.display && "" !== r.style.display || (r.style.display = t ? o[a] || "" : "none")) } return e } b.fn.extend({ css: function(e, n) { return b.access(this, function(e, n, r) { var i, o, a = {},
                    s = 0; if (b.isArray(n)) { for (o = Rt(e), i = n.length; i > s; s++) { a[n[s]] = b.css(e, n[s], !1, o) } return a } return r !== t ? b.style(e, n, r) : b.css(e, n) }, e, n, arguments.length > 1) }, show: function() { return rn(this, !0) }, hide: function() { return rn(this) }, toggle: function(e) { var t = "boolean" == typeof e; return this.each(function() {
                (t ? e : nn(this)) ? b(this).show(): b(this).hide() }) } }), b.extend({ cssHooks: { opacity: { get: function(e, t) { if (t) { var n = Wt(e, "opacity"); return "" === n ? "1" : n } } } }, cssNumber: { columnCount: !0, fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0 }, cssProps: { "float": b.support.cssFloat ? "cssFloat" : "styleFloat" }, style: function(e, n, r, i) { if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) { var o, a, s, u = b.camelCase(n),
                    l = e.style; if (n = b.cssProps[u] || (b.cssProps[u] = tn(l, u)), s = b.cssHooks[n] || b.cssHooks[u], r === t) { return s && "get" in s && (o = s.get(e, !1, i)) !== t ? o : l[n] } if (a = typeof r, "string" === a && (o = Jt.exec(r)) && (r = (o[1] + 1) * o[2] + parseFloat(b.css(e, n)), a = "number"), !(null == r || "number" === a && isNaN(r) || ("number" !== a || b.cssNumber[u] || (r += "px"), b.support.clearCloneStyle || "" !== r || 0 !== n.indexOf("background") || (l[n] = "inherit"), s && "set" in s && (r = s.set(e, r, i)) === t))) { try { l[n] = r } catch (c) {} } } }, css: function(e, n, r, i) { var o, a, s, u = b.camelCase(n); return n = b.cssProps[u] || (b.cssProps[u] = tn(e.style, u)), s = b.cssHooks[n] || b.cssHooks[u], s && "get" in s && (a = s.get(e, !0, r)), a === t && (a = Wt(e, n, i)), "normal" === a && n in Kt && (a = Kt[n]), "" === r || r ? (o = parseFloat(a), r === !0 || b.isNumeric(o) ? o || 0 : a) : a }, swap: function(e, t, n, r) { var i, o, a = {}; for (o in t) { a[o] = e.style[o], e.style[o] = t[o] } i = n.apply(e, r || []); for (o in t) { e.style[o] = a[o] } return i } }), e.getComputedStyle ? (Rt = function(t) { return e.getComputedStyle(t, null) }, Wt = function(e, n, r) { var i, o, a, s = r || Rt(e),
            u = s ? s.getPropertyValue(n) || s[n] : t,
            l = e.style; return s && ("" !== u || b.contains(e.ownerDocument, e) || (u = b.style(e, n)), Yt.test(u) && Ut.test(n) && (i = l.width, o = l.minWidth, a = l.maxWidth, l.minWidth = l.maxWidth = l.width = u, u = s.width, l.width = i, l.minWidth = o, l.maxWidth = a)), u }) : o.documentElement.currentStyle && (Rt = function(e) { return e.currentStyle }, Wt = function(e, n, r) { var i, o, a, s = r || Rt(e),
            u = s ? s[n] : t,
            l = e.style; return null == u && l && l[n] && (u = l[n]), Yt.test(u) && !zt.test(n) && (i = l.left, o = e.runtimeStyle, a = o && o.left, a && (o.left = e.currentStyle.left), l.left = "fontSize" === n ? "1em" : u, u = l.pixelLeft + "px", l.left = i, a && (o.left = a)), "" === u ? "auto" : u });

    function on(e, t, n) { var r = Vt.exec(t); return r ? Math.max(0, r[1] - (n || 0)) + (r[2] || "px") : t }

    function an(e, t, n, r, i) { var o = n === (r ? "border" : "content") ? 4 : "width" === t ? 1 : 0,
            a = 0; for (; 4 > o; o += 2) { "margin" === n && (a += b.css(e, n + Zt[o], !0, i)), r ? ("content" === n && (a -= b.css(e, "padding" + Zt[o], !0, i)), "margin" !== n && (a -= b.css(e, "border" + Zt[o] + "Width", !0, i))) : (a += b.css(e, "padding" + Zt[o], !0, i), "padding" !== n && (a += b.css(e, "border" + Zt[o] + "Width", !0, i))) } return a }

    function sn(e, t, n) { var r = !0,
            i = "width" === t ? e.offsetWidth : e.offsetHeight,
            o = Rt(e),
            a = b.support.boxSizing && "border-box" === b.css(e, "boxSizing", !1, o); if (0 >= i || null == i) { if (i = Wt(e, t, o), (0 > i || null == i) && (i = e.style[t]), Yt.test(i)) { return i } r = a && (b.support.boxSizingReliable || i === e.style[t]), i = parseFloat(i) || 0 } return i + an(e, t, n || (a ? "border" : "content"), r, o) + "px" }

    function un(e) { var t = o,
            n = Gt[e]; return n || (n = ln(e, t), "none" !== n && n || (Pt = (Pt || b("<iframe frameborder='0' width='0' height='0'/>").css("cssText", "display:block !important")).appendTo(t.documentElement), t = (Pt[0].contentWindow || Pt[0].contentDocument).document, t.write("<!doctype html><html><body>"), t.close(), n = ln(e, t), Pt.detach()), Gt[e] = n), n }

    function ln(e, t) { var n = b(t.createElement(e)).appendTo(t.body),
            r = b.css(n[0], "display"); return n.remove(), r } b.each(["height", "width"], function(e, n) { b.cssHooks[n] = { get: function(e, r, i) { return r ? 0 === e.offsetWidth && Xt.test(b.css(e, "display")) ? b.swap(e, Qt, function() { return sn(e, n, i) }) : sn(e, n, i) : t }, set: function(e, t, r) { var i = r && Rt(e); return on(e, t, r ? an(e, n, r, b.support.boxSizing && "border-box" === b.css(e, "boxSizing", !1, i), i) : 0) } } }), b.support.opacity || (b.cssHooks.opacity = { get: function(e, t) { return It.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? 0.01 * parseFloat(RegExp.$1) + "" : t ? "1" : "" }, set: function(e, t) { var n = e.style,
                r = e.currentStyle,
                i = b.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : "",
                o = r && r.filter || n.filter || "";
            n.zoom = 1, (t >= 1 || "" === t) && "" === b.trim(o.replace($t, "")) && n.removeAttribute && (n.removeAttribute("filter"), "" === t || r && !r.filter) || (n.filter = $t.test(o) ? o.replace($t, i) : o + " " + i) } }), b(function() { b.support.reliableMarginRight || (b.cssHooks.marginRight = { get: function(e, n) { return n ? b.swap(e, { display: "inline-block" }, Wt, [e, "marginRight"]) : t } }), !b.support.pixelPosition && b.fn.position && b.each(["top", "left"], function(e, n) { b.cssHooks[n] = { get: function(e, r) { return r ? (r = Wt(e, n), Yt.test(r) ? b(e).position()[n] + "px" : r) : t } } }) }), b.expr && b.expr.filters && (b.expr.filters.hidden = function(e) { return 0 >= e.offsetWidth && 0 >= e.offsetHeight || !b.support.reliableHiddenOffsets && "none" === (e.style && e.style.display || b.css(e, "display")) }, b.expr.filters.visible = function(e) { return !b.expr.filters.hidden(e) }), b.each({ margin: "", padding: "", border: "Width" }, function(e, t) { b.cssHooks[e + t] = { expand: function(n) { var r = 0,
                    i = {},
                    o = "string" == typeof n ? n.split(" ") : [n]; for (; 4 > r; r++) { i[e + Zt[r] + t] = o[r] || o[r - 2] || o[0] } return i } }, Ut.test(e) || (b.cssHooks[e + t].set = on) }); var cn = /%20/g,
        pn = /\[\]$/,
        fn = /\r?\n/g,
        dn = /^(?:submit|button|image|reset|file)$/i,
        hn = /^(?:input|select|textarea|keygen)/i;
    b.fn.extend({ serialize: function() { return b.param(this.serializeArray()) }, serializeArray: function() { return this.map(function() { var e = b.prop(this, "elements"); return e ? b.makeArray(e) : this }).filter(function() { var e = this.type; return this.name && !b(this).is(":disabled") && hn.test(this.nodeName) && !dn.test(e) && (this.checked || !Nt.test(e)) }).map(function(e, t) { var n = b(this).val(); return null == n ? null : b.isArray(n) ? b.map(n, function(e) { return { name: t.name, value: e.replace(fn, "\r\n") } }) : { name: t.name, value: n.replace(fn, "\r\n") } }).get() } }), b.param = function(e, n) { var r, i = [],
            o = function(e, t) { t = b.isFunction(t) ? t() : null == t ? "" : t, i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t) }; if (n === t && (n = b.ajaxSettings && b.ajaxSettings.traditional), b.isArray(e) || e.jquery && !b.isPlainObject(e)) { b.each(e, function() { o(this.name, this.value) }) } else { for (r in e) { gn(r, e[r], n, o) } } return i.join("&").replace(cn, "+") };

    function gn(e, t, n, r) { var i; if (b.isArray(t)) { b.each(t, function(t, i) { n || pn.test(e) ? r(e, i) : gn(e + "[" + ("object" == typeof i ? t : "") + "]", i, n, r) }) } else { if (n || "object" !== b.type(t)) { r(e, t) } else { for (i in t) { gn(e + "[" + i + "]", t[i], n, r) } } } } b.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, t) { b.fn[t] = function(e, n) { return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t) } }), b.fn.hover = function(e, t) { return this.mouseenter(e).mouseleave(t || e) }; var mn, yn, vn = b.now(),
        bn = /\?/,
        xn = /#.*$/,
        wn = /([?&])_=[^&]*/,
        Tn = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm,
        Nn = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
        Cn = /^(?:GET|HEAD)$/,
        kn = /^\/\//,
        En = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
        Sn = b.fn.load,
        An = {},
        jn = {},
        Dn = "*/".concat("*"); try { yn = a.href } catch (Ln) { yn = o.createElement("a"), yn.href = "", yn = yn.href } mn = En.exec(yn.toLowerCase()) || [];

    function Hn(e) { return function(t, n) { "string" != typeof t && (n = t, t = "*"); var r, i = 0,
                o = t.toLowerCase().match(w) || []; if (b.isFunction(n)) { while (r = o[i++]) { "+" === r[0] ? (r = r.slice(1) || "*", (e[r] = e[r] || []).unshift(n)) : (e[r] = e[r] || []).push(n) } } } }

    function qn(e, n, r, i) { var o = {},
            a = e === jn;

        function s(u) { var l; return o[u] = !0, b.each(e[u] || [], function(e, u) { var c = u(n, r, i); return "string" != typeof c || a || o[c] ? a ? !(l = c) : t : (n.dataTypes.unshift(c), s(c), !1) }), l } return s(n.dataTypes[0]) || !o["*"] && s("*") }

    function Mn(e, n) { var r, i, o = b.ajaxSettings.flatOptions || {}; for (i in n) { n[i] !== t && ((o[i] ? e : r || (r = {}))[i] = n[i]) } return r && b.extend(!0, e, r), e } b.fn.load = function(e, n, r) { if ("string" != typeof e && Sn) { return Sn.apply(this, arguments) } var i, o, a, s = this,
            u = e.indexOf(" "); return u >= 0 && (i = e.slice(u, e.length), e = e.slice(0, u)), b.isFunction(n) ? (r = n, n = t) : n && "object" == typeof n && (a = "POST"), s.length > 0 && b.ajax({ url: e, type: a, dataType: "html", data: n }).done(function(e) { o = arguments, s.html(i ? b("<div>").append(b.parseHTML(e)).find(i) : e) }).complete(r && function(e, t) { s.each(r, o || [e.responseText, t, e]) }), this }, b.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) { b.fn[t] = function(e) { return this.on(t, e) } }), b.each(["get", "post"], function(e, n) { b[n] = function(e, r, i, o) { return b.isFunction(r) && (o = o || i, i = r, r = t), b.ajax({ url: e, type: n, dataType: o, data: r, success: i }) } }), b.extend({ active: 0, lastModified: {}, etag: {}, ajaxSettings: { url: yn, type: "GET", isLocal: Nn.test(mn[1]), global: !0, processData: !0, async: !0, contentType: "application/x-www-form-urlencoded; charset=UTF-8", accepts: { "*": Dn, text: "text/plain", html: "text/html", xml: "application/xml, text/xml", json: "application/json, text/javascript" }, contents: { xml: /xml/, html: /html/, json: /json/ }, responseFields: { xml: "responseXML", text: "responseText" }, converters: { "* text": e.String, "text html": !0, "text json": b.parseJSON, "text xml": b.parseXML }, flatOptions: { url: !0, context: !0 } }, ajaxSetup: function(e, t) { return t ? Mn(Mn(e, b.ajaxSettings), t) : Mn(b.ajaxSettings, e) }, ajaxPrefilter: Hn(An), ajaxTransport: Hn(jn), ajax: function(e, n) { "object" == typeof e && (n = e, e = t), n = n || {}; var r, i, o, a, s, u, l, c, p = b.ajaxSetup({}, n),
                f = p.context || p,
                d = p.context && (f.nodeType || f.jquery) ? b(f) : b.event,
                h = b.Deferred(),
                g = b.Callbacks("once memory"),
                m = p.statusCode || {},
                y = {},
                v = {},
                x = 0,
                T = "canceled",
                N = { readyState: 0, getResponseHeader: function(e) { var t; if (2 === x) { if (!c) { c = {}; while (t = Tn.exec(a)) { c[t[1].toLowerCase()] = t[2] } } t = c[e.toLowerCase()] } return null == t ? null : t }, getAllResponseHeaders: function() { return 2 === x ? a : null }, setRequestHeader: function(e, t) { var n = e.toLowerCase(); return x || (e = v[n] = v[n] || e, y[e] = t), this }, overrideMimeType: function(e) { return x || (p.mimeType = e), this }, statusCode: function(e) { var t; if (e) { if (2 > x) { for (t in e) { m[t] = [m[t], e[t]] } } else { N.always(e[N.status]) } } return this }, abort: function(e) { var t = e || T; return l && l.abort(t), k(0, t), this } }; if (h.promise(N).complete = g.add, N.success = N.done, N.error = N.fail, p.url = ((e || p.url || yn) + "").replace(xn, "").replace(kn, mn[1] + "//"), p.type = n.method || n.type || p.method || p.type, p.dataTypes = b.trim(p.dataType || "*").toLowerCase().match(w) || [""], null == p.crossDomain && (r = En.exec(p.url.toLowerCase()), p.crossDomain = !(!r || r[1] === mn[1] && r[2] === mn[2] && (r[3] || ("http:" === r[1] ? 80 : 443)) == (mn[3] || ("http:" === mn[1] ? 80 : 443)))), p.data && p.processData && "string" != typeof p.data && (p.data = b.param(p.data, p.traditional)), qn(An, p, n, N), 2 === x) { return N } u = p.global, u && 0 === b.active++ && b.event.trigger("ajaxStart"), p.type = p.type.toUpperCase(), p.hasContent = !Cn.test(p.type), o = p.url, p.hasContent || (p.data && (o = p.url += (bn.test(o) ? "&" : "?") + p.data, delete p.data), p.cache === !1 && (p.url = wn.test(o) ? o.replace(wn, "$1_=" + vn++) : o + (bn.test(o) ? "&" : "?") + "_=" + vn++)), p.ifModified && (b.lastModified[o] && N.setRequestHeader("If-Modified-Since", b.lastModified[o]), b.etag[o] && N.setRequestHeader("If-None-Match", b.etag[o])), (p.data && p.hasContent && p.contentType !== !1 || n.contentType) && N.setRequestHeader("Content-Type", p.contentType), N.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Dn + "; q=0.01" : "") : p.accepts["*"]); for (i in p.headers) { N.setRequestHeader(i, p.headers[i]) } if (p.beforeSend && (p.beforeSend.call(f, N, p) === !1 || 2 === x)) { return N.abort() } T = "abort"; for (i in { success: 1, error: 1, complete: 1 }) { N[i](p[i]) } if (l = qn(jn, p, n, N)) { N.readyState = 1, u && d.trigger("ajaxSend", [N, p]), p.async && p.timeout > 0 && (s = setTimeout(function() { N.abort("timeout") }, p.timeout)); try { x = 1, l.send(y, k) } catch (C) { if (!(2 > x)) { throw C } k(-1, C) } } else { k(-1, "No Transport") }

            function k(e, n, r, i) { var c, y, v, w, T, C = n;
                2 !== x && (x = 2, s && clearTimeout(s), l = t, a = i || "", N.readyState = e > 0 ? 4 : 0, r && (w = _n(p, N, r)), e >= 200 && 300 > e || 304 === e ? (p.ifModified && (T = N.getResponseHeader("Last-Modified"), T && (b.lastModified[o] = T), T = N.getResponseHeader("etag"), T && (b.etag[o] = T)), 204 === e ? (c = !0, C = "nocontent") : 304 === e ? (c = !0, C = "notmodified") : (c = Fn(p, w), C = c.state, y = c.data, v = c.error, c = !v)) : (v = C, (e || !C) && (C = "error", 0 > e && (e = 0))), N.status = e, N.statusText = (n || C) + "", c ? h.resolveWith(f, [y, C, N]) : h.rejectWith(f, [N, C, v]), N.statusCode(m), m = t, u && d.trigger(c ? "ajaxSuccess" : "ajaxError", [N, p, c ? y : v]), g.fireWith(f, [N, C]), u && (d.trigger("ajaxComplete", [N, p]), --b.active || b.event.trigger("ajaxStop"))) } return N }, getScript: function(e, n) { return b.get(e, t, n, "script") }, getJSON: function(e, t, n) { return b.get(e, t, n, "json") } });

    function _n(e, n, r) { var i, o, a, s, u = e.contents,
            l = e.dataTypes,
            c = e.responseFields; for (s in c) { s in r && (n[c[s]] = r[s]) } while ("*" === l[0]) { l.shift(), o === t && (o = e.mimeType || n.getResponseHeader("Content-Type")) } if (o) { for (s in u) { if (u[s] && u[s].test(o)) { l.unshift(s); break } } } if (l[0] in r) { a = l[0] } else { for (s in r) { if (!l[0] || e.converters[s + " " + l[0]]) { a = s; break } i || (i = s) } a = a || i } return a ? (a !== l[0] && l.unshift(a), r[a]) : t }

    function Fn(e, t) { var n, r, i, o, a = {},
            s = 0,
            u = e.dataTypes.slice(),
            l = u[0]; if (e.dataFilter && (t = e.dataFilter(t, e.dataType)), u[1]) { for (i in e.converters) { a[i.toLowerCase()] = e.converters[i] } } for (; r = u[++s];) { if ("*" !== r) { if ("*" !== l && l !== r) { if (i = a[l + " " + r] || a["* " + r], !i) { for (n in a) { if (o = n.split(" "), o[1] === r && (i = a[l + " " + o[0]] || a["* " + o[0]])) { i === !0 ? i = a[n] : a[n] !== !0 && (r = o[0], u.splice(s--, 0, r)); break } } } if (i !== !0) { if (i && e["throws"]) { t = i(t) } else { try { t = i(t) } catch (c) { return { state: "parsererror", error: i ? c : "No conversion from " + l + " to " + r } } } } } l = r } } return { state: "success", data: t } } b.ajaxSetup({ accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" }, contents: { script: /(?:java|ecma)script/ }, converters: { "text script": function(e) { return b.globalEval(e), e } } }), b.ajaxPrefilter("script", function(e) { e.cache === t && (e.cache = !1), e.crossDomain && (e.type = "GET", e.global = !1) }), b.ajaxTransport("script", function(e) { if (e.crossDomain) { var n, r = o.head || b("head")[0] || o.documentElement; return { send: function(t, i) { n = o.createElement("script"), n.async = !0, e.scriptCharset && (n.charset = e.scriptCharset), n.src = e.url, n.onload = n.onreadystatechange = function(e, t) {
                        (t || !n.readyState || /loaded|complete/.test(n.readyState)) && (n.onload = n.onreadystatechange = null, n.parentNode && n.parentNode.removeChild(n), n = null, t || i(200, "success")) }, r.insertBefore(n, r.firstChild) }, abort: function() { n && n.onload(t, !0) } } } }); var On = [],
        Bn = /(=)\?(?=&|$)|\?\?/;
    b.ajaxSetup({ jsonp: "callback", jsonpCallback: function() { var e = On.pop() || b.expando + "_" + vn++; return this[e] = !0, e } }), b.ajaxPrefilter("json jsonp", function(n, r, i) { var o, a, s, u = n.jsonp !== !1 && (Bn.test(n.url) ? "url" : "string" == typeof n.data && !(n.contentType || "").indexOf("application/x-www-form-urlencoded") && Bn.test(n.data) && "data"); return u || "jsonp" === n.dataTypes[0] ? (o = n.jsonpCallback = b.isFunction(n.jsonpCallback) ? n.jsonpCallback() : n.jsonpCallback, u ? n[u] = n[u].replace(Bn, "$1" + o) : n.jsonp !== !1 && (n.url += (bn.test(n.url) ? "&" : "?") + n.jsonp + "=" + o), n.converters["script json"] = function() { return s || b.error(o + " was not called"), s[0] }, n.dataTypes[0] = "json", a = e[o], e[o] = function() { s = arguments }, i.always(function() { e[o] = a, n[o] && (n.jsonpCallback = r.jsonpCallback, On.push(o)), s && b.isFunction(a) && a(s[0]), s = a = t }), "script") : t }); var Pn, Rn, Wn = 0,
        $n = e.ActiveXObject && function() { var e; for (e in Pn) { Pn[e](t, !0) } };

    function In() { try { return new e.XMLHttpRequest } catch (t) {} }

    function zn() { try { return new e.ActiveXObject("Microsoft.XMLHTTP") } catch (t) {} } b.ajaxSettings.xhr = e.ActiveXObject ? function() { return !this.isLocal && In() || zn() } : In, Rn = b.ajaxSettings.xhr(), b.support.cors = !!Rn && "withCredentials" in Rn, Rn = b.support.ajax = !!Rn, Rn && b.ajaxTransport(function(n) { if (!n.crossDomain || b.support.cors) { var r; return { send: function(i, o) { var a, s, u = n.xhr(); if (n.username ? u.open(n.type, n.url, n.async, n.username, n.password) : u.open(n.type, n.url, n.async), n.xhrFields) { for (s in n.xhrFields) { u[s] = n.xhrFields[s] } } n.mimeType && u.overrideMimeType && u.overrideMimeType(n.mimeType), n.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest"); try { for (s in i) { u.setRequestHeader(s, i[s]) } } catch (l) {} u.send(n.hasContent && n.data || null), r = function(e, i) { var s, l, c, p; try { if (r && (i || 4 === u.readyState)) { if (r = t, a && (u.onreadystatechange = b.noop, $n && delete Pn[a]), i) { 4 !== u.readyState && u.abort() } else { p = {}, s = u.status, l = u.getAllResponseHeaders(), "string" == typeof u.responseText && (p.text = u.responseText); try { c = u.statusText } catch (f) { c = "" } s || !n.isLocal || n.crossDomain ? 1223 === s && (s = 204) : s = p.text ? 200 : 404 } } } catch (d) { i || o(-1, d) } p && o(s, c, p, l) }, n.async ? 4 === u.readyState ? setTimeout(r) : (a = ++Wn, $n && (Pn || (Pn = {}, b(e).unload($n)), Pn[a] = r), u.onreadystatechange = r) : r() }, abort: function() { r && r(t, !0) } } } }); var Xn, Un, Vn = /^(?:toggle|show|hide)$/,
        Yn = RegExp("^(?:([+-])=|)(" + x + ")([a-z%]*)$", "i"),
        Jn = /queueHooks$/,
        Gn = [nr],
        Qn = { "*": [function(e, t) { var n, r, i = this.createTween(e, t),
                    o = Yn.exec(t),
                    a = i.cur(),
                    s = +a || 0,
                    u = 1,
                    l = 20; if (o) { if (n = +o[2], r = o[3] || (b.cssNumber[e] ? "" : "px"), "px" !== r && s) { s = b.css(i.elem, e, !0) || n || 1;
                        do { u = u || ".5", s /= u, b.style(i.elem, e, s + r) } while (u !== (u = i.cur() / a) && 1 !== u && --l) } i.unit = r, i.start = s, i.end = o[1] ? s + (o[1] + 1) * n : n } return i }] };

    function Kn() { return setTimeout(function() { Xn = t }), Xn = b.now() }

    function Zn(e, t) { b.each(t, function(t, n) { var r = (Qn[t] || []).concat(Qn["*"]),
                i = 0,
                o = r.length; for (; o > i; i++) { if (r[i].call(e, t, n)) { return } } }) }

    function er(e, t, n) { var r, i, o = 0,
            a = Gn.length,
            s = b.Deferred().always(function() { delete u.elem }),
            u = function() { if (i) { return !1 } var t = Xn || Kn(),
                    n = Math.max(0, l.startTime + l.duration - t),
                    r = n / l.duration || 0,
                    o = 1 - r,
                    a = 0,
                    u = l.tweens.length; for (; u > a; a++) { l.tweens[a].run(o) } return s.notifyWith(e, [l, o, n]), 1 > o && u ? n : (s.resolveWith(e, [l]), !1) },
            l = s.promise({ elem: e, props: b.extend({}, t), opts: b.extend(!0, { specialEasing: {} }, n), originalProperties: t, originalOptions: n, startTime: Xn || Kn(), duration: n.duration, tweens: [], createTween: function(t, n) { var r = b.Tween(e, l.opts, t, n, l.opts.specialEasing[t] || l.opts.easing); return l.tweens.push(r), r }, stop: function(t) { var n = 0,
                        r = t ? l.tweens.length : 0; if (i) { return this } for (i = !0; r > n; n++) { l.tweens[n].run(1) } return t ? s.resolveWith(e, [l, t]) : s.rejectWith(e, [l, t]), this } }),
            c = l.props; for (tr(c, l.opts.specialEasing); a > o; o++) { if (r = Gn[o].call(l, e, c, l.opts)) { return r } } return Zn(l, c), b.isFunction(l.opts.start) && l.opts.start.call(e, l), b.fx.timer(b.extend(u, { elem: e, anim: l, queue: l.opts.queue })), l.progress(l.opts.progress).done(l.opts.done, l.opts.complete).fail(l.opts.fail).always(l.opts.always) }

    function tr(e, t) { var n, r, i, o, a; for (i in e) { if (r = b.camelCase(i), o = t[r], n = e[i], b.isArray(n) && (o = n[1], n = e[i] = n[0]), i !== r && (e[r] = n, delete e[i]), a = b.cssHooks[r], a && "expand" in a) { n = a.expand(n), delete e[r]; for (i in n) { i in e || (e[i] = n[i], t[i] = o) } } else { t[r] = o } } } b.Animation = b.extend(er, { tweener: function(e, t) { b.isFunction(e) ? (t = e, e = ["*"]) : e = e.split(" "); var n, r = 0,
                i = e.length; for (; i > r; r++) { n = e[r], Qn[n] = Qn[n] || [], Qn[n].unshift(t) } }, prefilter: function(e, t) { t ? Gn.unshift(e) : Gn.push(e) } });

    function nr(e, t, n) { var r, i, o, a, s, u, l, c, p, f = this,
            d = e.style,
            h = {},
            g = [],
            m = e.nodeType && nn(e);
        n.queue || (c = b._queueHooks(e, "fx"), null == c.unqueued && (c.unqueued = 0, p = c.empty.fire, c.empty.fire = function() { c.unqueued || p() }), c.unqueued++, f.always(function() { f.always(function() { c.unqueued--, b.queue(e, "fx").length || c.empty.fire() }) })), 1 === e.nodeType && ("height" in t || "width" in t) && (n.overflow = [d.overflow, d.overflowX, d.overflowY], "inline" === b.css(e, "display") && "none" === b.css(e, "float") && (b.support.inlineBlockNeedsLayout && "inline" !== un(e.nodeName) ? d.zoom = 1 : d.display = "inline-block")), n.overflow && (d.overflow = "hidden", b.support.shrinkWrapBlocks || f.always(function() { d.overflow = n.overflow[0], d.overflowX = n.overflow[1], d.overflowY = n.overflow[2] })); for (i in t) { if (a = t[i], Vn.exec(a)) { if (delete t[i], u = u || "toggle" === a, a === (m ? "hide" : "show")) { continue } g.push(i) } } if (o = g.length) { s = b._data(e, "fxshow") || b._data(e, "fxshow", {}), "hidden" in s && (m = s.hidden), u && (s.hidden = !m), m ? b(e).show() : f.done(function() { b(e).hide() }), f.done(function() { var t;
                b._removeData(e, "fxshow"); for (t in h) { b.style(e, t, h[t]) } }); for (i = 0; o > i; i++) { r = g[i], l = f.createTween(r, m ? s[r] : 0), h[r] = s[r] || b.style(e, r), r in s || (s[r] = l.start, m && (l.end = l.start, l.start = "width" === r || "height" === r ? 1 : 0)) } } }

    function rr(e, t, n, r, i) { return new rr.prototype.init(e, t, n, r, i) } b.Tween = rr, rr.prototype = { constructor: rr, init: function(e, t, n, r, i, o) { this.elem = e, this.prop = n, this.easing = i || "swing", this.options = t, this.start = this.now = this.cur(), this.end = r, this.unit = o || (b.cssNumber[n] ? "" : "px") }, cur: function() { var e = rr.propHooks[this.prop]; return e && e.get ? e.get(this) : rr.propHooks._default.get(this) }, run: function(e) { var t, n = rr.propHooks[this.prop]; return this.pos = t = this.options.duration ? b.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : rr.propHooks._default.set(this), this } }, rr.prototype.init.prototype = rr.prototype, rr.propHooks = { _default: { get: function(e) { var t; return null == e.elem[e.prop] || e.elem.style && null != e.elem.style[e.prop] ? (t = b.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0) : e.elem[e.prop] }, set: function(e) { b.fx.step[e.prop] ? b.fx.step[e.prop](e) : e.elem.style && (null != e.elem.style[b.cssProps[e.prop]] || b.cssHooks[e.prop]) ? b.style(e.elem, e.prop, e.now + e.unit) : e.elem[e.prop] = e.now } } }, rr.propHooks.scrollTop = rr.propHooks.scrollLeft = { set: function(e) { e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now) } }, b.each(["toggle", "show", "hide"], function(e, t) { var n = b.fn[t];
        b.fn[t] = function(e, r, i) { return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(ir(t, !0), e, r, i) } }), b.fn.extend({ fadeTo: function(e, t, n, r) { return this.filter(nn).css("opacity", 0).show().end().animate({ opacity: t }, e, n, r) }, animate: function(e, t, n, r) { var i = b.isEmptyObject(e),
                o = b.speed(t, n, r),
                a = function() { var t = er(this, b.extend({}, e), o);
                    a.finish = function() { t.stop(!0) }, (i || b._data(this, "finish")) && t.stop(!0) }; return a.finish = a, i || o.queue === !1 ? this.each(a) : this.queue(o.queue, a) }, stop: function(e, n, r) { var i = function(e) { var t = e.stop;
                delete e.stop, t(r) }; return "string" != typeof e && (r = n, n = e, e = t), n && e !== !1 && this.queue(e || "fx", []), this.each(function() { var t = !0,
                    n = null != e && e + "queueHooks",
                    o = b.timers,
                    a = b._data(this); if (n) { a[n] && a[n].stop && i(a[n]) } else { for (n in a) { a[n] && a[n].stop && Jn.test(n) && i(a[n]) } } for (n = o.length; n--;) { o[n].elem !== this || null != e && o[n].queue !== e || (o[n].anim.stop(r), t = !1, o.splice(n, 1)) }(t || !r) && b.dequeue(this, e) }) }, finish: function(e) { return e !== !1 && (e = e || "fx"), this.each(function() { var t, n = b._data(this),
                    r = n[e + "queue"],
                    i = n[e + "queueHooks"],
                    o = b.timers,
                    a = r ? r.length : 0; for (n.finish = !0, b.queue(this, e, []), i && i.cur && i.cur.finish && i.cur.finish.call(this), t = o.length; t--;) { o[t].elem === this && o[t].queue === e && (o[t].anim.stop(!0), o.splice(t, 1)) } for (t = 0; a > t; t++) { r[t] && r[t].finish && r[t].finish.call(this) } delete n.finish }) } });

    function ir(e, t) { var n, r = { height: e },
            i = 0; for (t = t ? 1 : 0; 4 > i; i += 2 - t) { n = Zt[i], r["margin" + n] = r["padding" + n] = e } return t && (r.opacity = r.width = e), r } b.each({ slideDown: ir("show"), slideUp: ir("hide"), slideToggle: ir("toggle"), fadeIn: { opacity: "show" }, fadeOut: { opacity: "hide" }, fadeToggle: { opacity: "toggle" } }, function(e, t) { b.fn[e] = function(e, n, r) { return this.animate(t, e, n, r) } }), b.speed = function(e, t, n) { var r = e && "object" == typeof e ? b.extend({}, e) : { complete: n || !n && t || b.isFunction(e) && e, duration: e, easing: n && t || t && !b.isFunction(t) && t }; return r.duration = b.fx.off ? 0 : "number" == typeof r.duration ? r.duration : r.duration in b.fx.speeds ? b.fx.speeds[r.duration] : b.fx.speeds._default, (null == r.queue || r.queue === !0) && (r.queue = "fx"), r.old = r.complete, r.complete = function() { b.isFunction(r.old) && r.old.call(this), r.queue && b.dequeue(this, r.queue) }, r }, b.easing = { linear: function(e) { return e }, swing: function(e) { return 0.5 - Math.cos(e * Math.PI) / 2 } }, b.timers = [], b.fx = rr.prototype.init, b.fx.tick = function() { var e, n = b.timers,
            r = 0; for (Xn = b.now(); n.length > r; r++) { e = n[r], e() || n[r] !== e || n.splice(r--, 1) } n.length || b.fx.stop(), Xn = t }, b.fx.timer = function(e) { e() && b.timers.push(e) && b.fx.start() }, b.fx.interval = 13, b.fx.start = function() { Un || (Un = setInterval(b.fx.tick, b.fx.interval)) }, b.fx.stop = function() { clearInterval(Un), Un = null }, b.fx.speeds = { slow: 600, fast: 200, _default: 400 }, b.fx.step = {}, b.expr && b.expr.filters && (b.expr.filters.animated = function(e) { return b.grep(b.timers, function(t) { return e === t.elem }).length }), b.fn.offset = function(e) { if (arguments.length) { return e === t ? this : this.each(function(t) { b.offset.setOffset(this, e, t) }) } var n, r, o = { top: 0, left: 0 },
            a = this[0],
            s = a && a.ownerDocument; if (s) { return n = s.documentElement, b.contains(n, a) ? (typeof a.getBoundingClientRect !== i && (o = a.getBoundingClientRect()), r = or(s), { top: o.top + (r.pageYOffset || n.scrollTop) - (n.clientTop || 0), left: o.left + (r.pageXOffset || n.scrollLeft) - (n.clientLeft || 0) }) : o } }, b.offset = { setOffset: function(e, t, n) { var r = b.css(e, "position"); "static" === r && (e.style.position = "relative"); var i = b(e),
                o = i.offset(),
                a = b.css(e, "top"),
                s = b.css(e, "left"),
                u = ("absolute" === r || "fixed" === r) && b.inArray("auto", [a, s]) > -1,
                l = {},
                c = {},
                p, f;
            u ? (c = i.position(), p = c.top, f = c.left) : (p = parseFloat(a) || 0, f = parseFloat(s) || 0), b.isFunction(t) && (t = t.call(e, n, o)), null != t.top && (l.top = t.top - o.top + p), null != t.left && (l.left = t.left - o.left + f), "using" in t ? t.using.call(e, l) : i.css(l) } }, b.fn.extend({ position: function() { if (this[0]) { var e, t, n = { top: 0, left: 0 },
                    r = this[0]; return "fixed" === b.css(r, "position") ? t = r.getBoundingClientRect() : (e = this.offsetParent(), t = this.offset(), b.nodeName(e[0], "html") || (n = e.offset()), n.top += b.css(e[0], "borderTopWidth", !0), n.left += b.css(e[0], "borderLeftWidth", !0)), { top: t.top - n.top - b.css(r, "marginTop", !0), left: t.left - n.left - b.css(r, "marginLeft", !0) } } }, offsetParent: function() { return this.map(function() { var e = this.offsetParent || o.documentElement; while (e && !b.nodeName(e, "html") && "static" === b.css(e, "position")) { e = e.offsetParent } return e || o.documentElement }) } }), b.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function(e, n) { var r = /Y/.test(n);
        b.fn[e] = function(i) { return b.access(this, function(e, i, o) { var a = or(e); return o === t ? a ? n in a ? a[n] : a.document.documentElement[i] : e[i] : (a ? a.scrollTo(r ? b(a).scrollLeft() : o, r ? o : b(a).scrollTop()) : e[i] = o, t) }, e, i, arguments.length, null) } });

    function or(e) { return b.isWindow(e) ? e : 9 === e.nodeType ? e.defaultView || e.parentWindow : !1 } b.each({ Height: "height", Width: "width" }, function(e, n) { b.each({ padding: "inner" + e, content: n, "": "outer" + e }, function(r, i) { b.fn[i] = function(i, o) { var a = arguments.length && (r || "boolean" != typeof i),
                    s = r || (i === !0 || o === !0 ? "margin" : "border"); return b.access(this, function(n, r, i) { var o; return b.isWindow(n) ? n.document.documentElement["client" + e] : 9 === n.nodeType ? (o = n.documentElement, Math.max(n.body["scroll" + e], o["scroll" + e], n.body["offset" + e], o["offset" + e], o["client" + e])) : i === t ? b.css(n, r, s) : b.style(n, r, i, s) }, n, a ? i : t, a, null) } }) }), e.jQuery = e.$ = b, "function" == typeof define && define.amd && define.amd.jQuery && define("jquery", [], function() { return b }) })(window);
if (window.XDomainRequest) { jQuery.ajaxTransport(function(a) { if (a.crossDomain && a.async) { if (a.timeout) { a.xdrTimeout = a.timeout;
                delete a.timeout } var b; return { send: function(c, d) {
                    function e(g, i, f, h) { b.onload = b.onerror = b.ontimeout = jQuery.noop;
                        b = undefined;
                        d(g, i, f, h) } b = new XDomainRequest();
                    b.onload = function() { e(200, "OK", { text: b.responseText }, "Content-Type: " + b.contentType) };
                    b.onerror = function() { e(404, "Not Found") };
                    b.onprogress = jQuery.noop;
                    b.ontimeout = function() { e(0, "timeout") };
                    b.timeout = a.xdrTimeout || Number.MAX_VALUE;
                    b.open(a.type, a.url);
                    b.send((a.hasContent && a.data) || null) }, abort: function() { if (b) { b.onerror = jQuery.noop;
                        b.abort() } } } } }) };
(function(a) { if (typeof define === "function" && define.amd) { define(["jquery"], a) } else { a(jQuery) } }(function(e) { e.ui = e.ui || {};
    e.extend(e.ui, { version: "1.11.2", keyCode: { BACKSPACE: 8, COMMA: 188, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, LEFT: 37, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SPACE: 32, TAB: 9, UP: 38 } });
    e.fn.extend({ scrollParent: function(af) { var ae = this.css("position"),
                ah = ae === "absolute",
                ai = af ? /(auto|scroll|hidden)/ : /(auto|scroll)/,
                ag = this.parents().filter(function() { var aj = e(this); if (ah && aj.css("position") === "static") { return false } return ai.test(aj.css("overflow") + aj.css("overflow-y") + aj.css("overflow-x")) }).eq(0); return ae === "fixed" || !ag.length ? e(this[0].ownerDocument || document) : ag }, uniqueId: (function() { var ae = 0; return function() { return this.each(function() { if (!this.id) { this.id = "ui-id-" + (++ae) } }) } })(), removeUniqueId: function() { return this.each(function() { if (/^ui-id-\d+$/.test(this.id)) { e(this).removeAttr("id") } }) } });

    function L(af, aj) { var ag, ae, ah, ai = af.nodeName.toLowerCase(); if ("area" === ai) { ag = af.parentNode;
            ae = ag.name; if (!af.href || !ae || ag.nodeName.toLowerCase() !== "map") { return false } ah = e("img[usemap='#" + ae + "']")[0]; return !!ah && Z(ah) } return (/input|select|textarea|button|object/.test(ai) ? !af.disabled : "a" === ai ? af.href || aj : aj) && Z(af) }

    function Z(ae) { return e.expr.filters.visible(ae) && !e(ae).parents().addBack().filter(function() { return e.css(this, "visibility") === "hidden" }).length } e.extend(e.expr[":"], { data: e.expr.createPseudo ? e.expr.createPseudo(function(ae) { return function(af) { return !!e.data(af, ae) } }) : function(af, ae, ag) { return !!e.data(af, ag[3]) }, focusable: function(ae) { return L(ae, !isNaN(e.attr(ae, "tabindex"))) }, tabbable: function(ag) { var ae = e.attr(ag, "tabindex"),
                af = isNaN(ae); return (af || ae >= 0) && L(ag, !af) } }); if (!e("<a>").outerWidth(1).jquery) { e.each(["Width", "Height"], function(af, ai) { var aj = ai === "Width" ? ["Left", "Right"] : ["Top", "Bottom"],
                ah = ai.toLowerCase(),
                ag = { innerWidth: e.fn.innerWidth, innerHeight: e.fn.innerHeight, outerWidth: e.fn.outerWidth, outerHeight: e.fn.outerHeight };

            function ae(an, al, ak, am) { e.each(aj, function() { al -= parseFloat(e.css(an, "padding" + this)) || 0; if (ak) { al -= parseFloat(e.css(an, "border" + this + "Width")) || 0 } if (am) { al -= parseFloat(e.css(an, "margin" + this)) || 0 } }); return al } e.fn["inner" + ai] = function(ak) { if (ak === undefined) { return ag["inner" + ai].call(this) } return this.each(function() { e(this).css(ah, ae(this, ak) + "px") }) };
            e.fn["outer" + ai] = function(al, ak) { if (typeof al !== "number") { return ag["outer" + ai].call(this, al) } return this.each(function() { e(this).css(ah, ae(this, al, true, ak) + "px") }) } }) } if (!e.fn.addBack) { e.fn.addBack = function(ae) { return this.add(ae == null ? this.prevObject : this.prevObject.filter(ae)) } } if (e("<a>").data("a-b", "a").removeData("a-b").data("a-b")) { e.fn.removeData = (function(ae) { return function(af) { if (arguments.length) { return ae.call(this, e.camelCase(af)) } else { return ae.call(this) } } })(e.fn.removeData) } e.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase());
    e.fn.extend({ focus: (function(ae) { return function(ag, af) { return typeof ag === "number" ? this.each(function() { var ah = this;
                    setTimeout(function() { e(ah).focus(); if (af) { af.call(ah) } }, ag) }) : ae.apply(this, arguments) } })(e.fn.focus), disableSelection: (function() { var ae = "onselectstart" in document.createElement("div") ? "selectstart" : "mousedown"; return function() { return this.bind(ae + ".ui-disableSelection", function(af) { af.preventDefault() }) } })(), enableSelection: function() { return this.unbind(".ui-disableSelection") }, zIndex: function(ag) { if (ag !== undefined) { return this.css("zIndex", ag) } if (this.length) { var ah = e(this[0]),
                    ae, af; while (ah.length && ah[0] !== document) { ae = ah.css("position"); if (ae === "absolute" || ae === "relative" || ae === "fixed") { af = parseInt(ah.css("zIndex"), 10); if (!isNaN(af) && af !== 0) { return af } } ah = ah.parent() } } return 0 } });
    e.ui.plugin = { add: function(ag, af, ah) { var ae, ai = e.ui[ag].prototype; for (ae in ah) { ai.plugins[ae] = ai.plugins[ae] || [];
                ai.plugins[ae].push([af, ah[ae]]) } }, call: function(ag, ai, aj, af) { var ae, ah = ag.plugins[ai]; if (!ah) { return } if (!af && (!ag.element[0].parentNode || ag.element[0].parentNode.nodeType === 11)) { return } for (ae = 0; ae < ah.length; ae++) { if (ag.options[ah[ae][0]]) { ah[ae][1].apply(ag.element, aj) } } } }; var T = 0,
        K = Array.prototype.slice;
    e.cleanData = (function(ae) { return function(ai) { var ah, aj, ag; for (ag = 0;
                (aj = ai[ag]) != null; ag++) { try { ah = e._data(aj, "events"); if (ah && ah.remove) { e(aj).triggerHandler("remove") } } catch (af) {} } ae(ai) } })(e.cleanData);
    e.widget = function(ak, ae, al) { var af, aj, ai, ah, am = {},
            ag = ak.split(".")[0];
        ak = ak.split(".")[1];
        af = ag + "-" + ak; if (!al) { al = ae;
            ae = e.Widget } e.expr[":"][af.toLowerCase()] = function(an) { return !!e.data(an, af) };
        e[ag] = e[ag] || {};
        aj = e[ag][ak];
        ai = e[ag][ak] = function(ao, an) { if (!this._createWidget) { return new ai(ao, an) } if (arguments.length) { this._createWidget(ao, an) } };
        e.extend(ai, aj, { version: al.version, _proto: e.extend({}, al), _childConstructors: [] });
        ah = new ae();
        ah.options = e.widget.extend({}, ah.options);
        e.each(al, function(an, ao) { if (!e.isFunction(ao)) { am[an] = ao; return } am[an] = (function() { var ap = function() { return ae.prototype[an].apply(this, arguments) },
                    aq = function(ar) { return ae.prototype[an].apply(this, ar) }; return function() { var at = this._super,
                        au = this._superApply,
                        ar;
                    this._super = ap;
                    this._superApply = aq;
                    ar = ao.apply(this, arguments);
                    this._super = at;
                    this._superApply = au; return ar } })() });
        ai.prototype = e.widget.extend(ah, { widgetEventPrefix: aj ? (ah.widgetEventPrefix || ak) : ak }, am, { constructor: ai, namespace: ag, widgetName: ak, widgetFullName: af }); if (aj) { e.each(aj._childConstructors, function(an, ap) { var ao = ap.prototype;
                e.widget(ao.namespace + "." + ao.widgetName, ai, ap._proto) });
            delete aj._childConstructors } else { ae._childConstructors.push(ai) } e.widget.bridge(ak, ai); return ai };
    e.widget.extend = function(af) { var ah = K.call(arguments, 1),
            ai = 0,
            ag = ah.length,
            aj, ae; for (; ai < ag; ai++) { for (aj in ah[ai]) { ae = ah[ai][aj]; if (ah[ai].hasOwnProperty(aj) && ae !== undefined) { if (e.isPlainObject(ae)) { af[aj] = e.isPlainObject(af[aj]) ? e.widget.extend({}, af[aj], ae) : e.widget.extend({}, ae) } else { af[aj] = ae } } } } return af };
    e.widget.bridge = function(ag, af) { var ae = af.prototype.widgetFullName || ag;
        e.fn[ag] = function(ak) { var aj = typeof ak === "string",
                ah = K.call(arguments, 1),
                ai = this;
            ak = !aj && ah.length ? e.widget.extend.apply(null, [ak].concat(ah)) : ak; if (aj) { this.each(function() { var al, am = e.data(this, ae); if (ak === "instance") { ai = am; return false } if (!am) { return e.error("cannot call methods on " + ag + " prior to initialization; attempted to call method '" + ak + "'") } if (!e.isFunction(am[ak]) || ak.charAt(0) === "_") { return e.error("no such method '" + ak + "' for " + ag + " widget instance") } al = am[ak].apply(am, ah); if (al !== am && al !== undefined) { ai = al && al.jquery ? ai.pushStack(al.get()) : al; return false } }) } else { this.each(function() { var al = e.data(this, ae); if (al) { al.option(ak || {}); if (al._init) { al._init() } } else { e.data(this, ae, new af(ak, this)) } }) } return ai } };
    e.Widget = function() {};
    e.Widget._childConstructors = [];
    e.Widget.prototype = { widgetName: "widget", widgetEventPrefix: "", defaultElement: "<div>", options: { disabled: false, create: null }, _createWidget: function(af, ae) { ae = e(ae || this.defaultElement || this)[0];
            this.element = e(ae);
            this.uuid = T++;
            this.eventNamespace = "." + this.widgetName + this.uuid;
            this.bindings = e();
            this.hoverable = e();
            this.focusable = e(); if (ae !== this) { e.data(ae, this.widgetFullName, this);
                this._on(true, this.element, { remove: function(ag) { if (ag.target === ae) { this.destroy() } } });
                this.document = e(ae.style ? ae.ownerDocument : ae.document || ae);
                this.window = e(this.document[0].defaultView || this.document[0].parentWindow) } this.options = e.widget.extend({}, this.options, this._getCreateOptions(), af);
            this._create();
            this._trigger("create", null, this._getCreateEventData());
            this._init() }, _getCreateOptions: e.noop, _getCreateEventData: e.noop, _create: e.noop, _init: e.noop, destroy: function() { this._destroy();
            this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName));
            this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled");
            this.bindings.unbind(this.eventNamespace);
            this.hoverable.removeClass("ui-state-hover");
            this.focusable.removeClass("ui-state-focus") }, _destroy: e.noop, widget: function() { return this.element }, option: function(aj, ae) { var ag = aj,
                ai, ah, af; if (arguments.length === 0) { return e.widget.extend({}, this.options) } if (typeof aj === "string") { ag = {};
                ai = aj.split(".");
                aj = ai.shift(); if (ai.length) { ah = ag[aj] = e.widget.extend({}, this.options[aj]); for (af = 0; af < ai.length - 1; af++) { ah[ai[af]] = ah[ai[af]] || {};
                        ah = ah[ai[af]] } aj = ai.pop(); if (arguments.length === 1) { return ah[aj] === undefined ? null : ah[aj] } ah[aj] = ae } else { if (arguments.length === 1) { return this.options[aj] === undefined ? null : this.options[aj] } ag[aj] = ae } } this._setOptions(ag); return this }, _setOptions: function(af) { var ae; for (ae in af) { this._setOption(ae, af[ae]) } return this }, _setOption: function(ae, af) { this.options[ae] = af; if (ae === "disabled") { this.widget().toggleClass(this.widgetFullName + "-disabled", !!af); if (af) { this.hoverable.removeClass("ui-state-hover");
                    this.focusable.removeClass("ui-state-focus") } } return this }, enable: function() { return this._setOptions({ disabled: false }) }, disable: function() { return this._setOptions({ disabled: true }) }, _on: function(ae, ag, ai) { var af, ah = this; if (typeof ae !== "boolean") { ai = ag;
                ag = ae;
                ae = false } if (!ai) { ai = ag;
                ag = this.element;
                af = this.widget() } else { ag = af = e(ag);
                this.bindings = this.bindings.add(ag) } e.each(ai, function(ao, am) {
                function ak() { if (!ae && (ah.options.disabled === true || e(this).hasClass("ui-state-disabled"))) { return } return (typeof am === "string" ? ah[am] : am).apply(ah, arguments) } if (typeof am !== "string") { ak.guid = am.guid = am.guid || ak.guid || e.guid++ } var al = ao.match(/^([\w:-]*)\s*(.*)$/),
                    an = al[1] + ah.eventNamespace,
                    aj = al[2]; if (aj) { af.delegate(aj, an, ak) } else { ag.bind(an, ak) } }) }, _off: function(ae, af) { af = (af || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace;
            ae.unbind(af).undelegate(af);
            this.bindings = e(this.bindings.not(ae).get());
            this.focusable = e(this.focusable.not(ae).get());
            this.hoverable = e(this.hoverable.not(ae).get()) }, _delay: function(ah, ae) {
            function af() { return (typeof ah === "string" ? ag[ah] : ah).apply(ag, arguments) } var ag = this; return setTimeout(af, ae || 0) }, _hoverable: function(ae) { this.hoverable = this.hoverable.add(ae);
            this._on(ae, { mouseenter: function(af) { e(af.currentTarget).addClass("ui-state-hover") }, mouseleave: function(af) { e(af.currentTarget).removeClass("ui-state-hover") } }) }, _focusable: function(ae) { this.focusable = this.focusable.add(ae);
            this._on(ae, { focusin: function(af) { e(af.currentTarget).addClass("ui-state-focus") }, focusout: function(af) { e(af.currentTarget).removeClass("ui-state-focus") } }) }, _trigger: function(ai, aj, ae) { var ah, af, ag = this.options[ai];
            ae = ae || {};
            aj = e.Event(aj);
            aj.type = (ai === this.widgetEventPrefix ? ai : this.widgetEventPrefix + ai).toLowerCase();
            aj.target = this.element[0];
            af = aj.originalEvent; if (af) { for (ah in af) { if (!(ah in aj)) { aj[ah] = af[ah] } } } this.element.trigger(aj, ae); return !(e.isFunction(ag) && ag.apply(this.element[0], [aj].concat(ae)) === false || aj.isDefaultPrevented()) } };
    e.each({ show: "fadeIn", hide: "fadeOut" }, function(ae, af) { e.Widget.prototype["_" + ae] = function(aj, ak, ag) { if (typeof ak === "string") { ak = { effect: ak } } var ai, ah = !ak ? ae : ak === true || typeof ak === "number" ? af : ak.effect || af;
            ak = ak || {}; if (typeof ak === "number") { ak = { duration: ak } } ai = !e.isEmptyObject(ak);
            ak.complete = ag; if (ak.delay) { aj.delay(ak.delay) } if (ai && e.effects && e.effects.effect[ah]) { aj[ae](ak) } else { if (ah !== ae && aj[ah]) { aj[ah](ak.duration, ak.easing, ag) } else { aj.queue(function(al) { e(this)[ae](); if (ag) { ag.call(aj[0]) } al() }) } } } }); var w = e.widget; var M = false;
    e(document).mouseup(function() { M = false }); var d = e.widget("ui.mouse", { version: "1.11.2", options: { cancel: "input,textarea,button,select,option", distance: 1, delay: 0 }, _mouseInit: function() { var ae = this;
            this.element.bind("mousedown." + this.widgetName, function(af) { return ae._mouseDown(af) }).bind("click." + this.widgetName, function(af) { if (true === e.data(af.target, ae.widgetName + ".preventClickEvent")) { e.removeData(af.target, ae.widgetName + ".preventClickEvent");
                    af.stopImmediatePropagation(); return false } });
            this.started = false }, _mouseDestroy: function() { this.element.unbind("." + this.widgetName); if (this._mouseMoveDelegate) { this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate) } }, _mouseDown: function(ag) { if (M) { return } this._mouseMoved = false;
            (this._mouseStarted && this._mouseUp(ag));
            this._mouseDownEvent = ag; var af = this,
                ae = (ag.which === 1),
                ah = (typeof this.options.cancel === "string" && ag.target.nodeName ? e(ag.target).closest(this.options.cancel).length : false); if (!ae || ah || !this._mouseCapture(ag)) { return true } this.mouseDelayMet = !this.options.delay; if (!this.mouseDelayMet) { this._mouseDelayTimer = setTimeout(function() { af.mouseDelayMet = true }, this.options.delay) } if (this._mouseDistanceMet(ag) && this._mouseDelayMet(ag)) { this._mouseStarted = (this._mouseStart(ag) !== false); if (!this._mouseStarted) { ag.preventDefault(); return true } } if (true === e.data(ag.target, this.widgetName + ".preventClickEvent")) { e.removeData(ag.target, this.widgetName + ".preventClickEvent") } this._mouseMoveDelegate = function(ai) { return af._mouseMove(ai) };
            this._mouseUpDelegate = function(ai) { return af._mouseUp(ai) };
            this.document.bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate);
            ag.preventDefault();
            M = true; return true }, _mouseMove: function(ae) { if (this._mouseMoved) { if (e.ui.ie && (!document.documentMode || document.documentMode < 9) && !ae.button) { return this._mouseUp(ae) } else { if (!ae.which) { return this._mouseUp(ae) } } } if (ae.which || ae.button) { this._mouseMoved = true } if (this._mouseStarted) { this._mouseDrag(ae); return ae.preventDefault() } if (this._mouseDistanceMet(ae) && this._mouseDelayMet(ae)) { this._mouseStarted = (this._mouseStart(this._mouseDownEvent, ae) !== false);
                (this._mouseStarted ? this._mouseDrag(ae) : this._mouseUp(ae)) } return !this._mouseStarted }, _mouseUp: function(ae) { this.document.unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate); if (this._mouseStarted) { this._mouseStarted = false; if (ae.target === this._mouseDownEvent.target) { e.data(ae.target, this.widgetName + ".preventClickEvent", true) } this._mouseStop(ae) } M = false; return false }, _mouseDistanceMet: function(ae) { return (Math.max(Math.abs(this._mouseDownEvent.pageX - ae.pageX), Math.abs(this._mouseDownEvent.pageY - ae.pageY)) >= this.options.distance) }, _mouseDelayMet: function() { return this.mouseDelayMet }, _mouseStart: function() {}, _mouseDrag: function() {}, _mouseStop: function() {}, _mouseCapture: function() { return true } });
    (function() { e.ui = e.ui || {}; var ak, an, ap = Math.max,
            am = Math.abs,
            aq = Math.round,
            ae = /left|center|right/,
            af = /top|center|bottom/,
            ar = /[\+\-]\d+(\.[\d]+)?%?/,
            ag = /^\w+/,
            ao = /%$/,
            ah = e.fn.position;

        function ai(at, au, av) { return [parseFloat(at[0]) * (ao.test(at[0]) ? au / 100 : 1), parseFloat(at[1]) * (ao.test(at[1]) ? av / 100 : 1)] }

        function al(at, au) { return parseInt(e.css(at, au), 10) || 0 }

        function aj(at) { var au = at[0]; if (au.nodeType === 9) { return { width: at.width(), height: at.height(), offset: { top: 0, left: 0 } } } if (e.isWindow(au)) { return { width: at.width(), height: at.height(), offset: { top: at.scrollTop(), left: at.scrollLeft() } } } if (au.preventDefault) { return { width: 0, height: 0, offset: { top: au.pageY, left: au.pageX } } } return { width: at.outerWidth(), height: at.outerHeight(), offset: at.offset() } } e.position = { scrollbarWidth: function() { if (ak !== undefined) { return ak } var aw, at, av = e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                    au = av.children()[0];
                e("body").append(av);
                aw = au.offsetWidth;
                av.css("overflow", "scroll");
                at = au.offsetWidth; if (aw === at) { at = av[0].clientWidth } av.remove(); return (ak = aw - at) }, getScrollInfo: function(at) { var av = at.isWindow || at.isDocument ? "" : at.element.css("overflow-x"),
                    au = at.isWindow || at.isDocument ? "" : at.element.css("overflow-y"),
                    aw = av === "scroll" || (av === "auto" && at.width < at.element[0].scrollWidth),
                    ax = au === "scroll" || (au === "auto" && at.height < at.element[0].scrollHeight); return { width: ax ? e.position.scrollbarWidth() : 0, height: aw ? e.position.scrollbarWidth() : 0 } }, getWithinInfo: function(av) { var aw = e(av || window),
                    at = e.isWindow(aw[0]),
                    au = !!aw[0] && aw[0].nodeType === 9; return { element: aw, isWindow: at, isDocument: au, offset: aw.offset() || { left: 0, top: 0 }, scrollLeft: aw.scrollLeft(), scrollTop: aw.scrollTop(), width: at || au ? aw.width() : aw.outerWidth(), height: at || au ? aw.height() : aw.outerHeight() } } };
        e.fn.position = function(au) { if (!au || !au.of) { return ah.apply(this, arguments) } au = e.extend({}, au); var aC, aB, ax, aA, aD, aE, av = e(au.of),
                ay = e.position.getWithinInfo(au.within),
                at = e.position.getScrollInfo(ay),
                az = (au.collision || "flip").split(" "),
                aw = {};
            aE = aj(av); if (av[0].preventDefault) { au.at = "left top" } aB = aE.width;
            ax = aE.height;
            aA = aE.offset;
            aD = e.extend({}, aA);
            e.each(["my", "at"], function() { var aF = (au[this] || "").split(" "),
                    aG, aH; if (aF.length === 1) { aF = ae.test(aF[0]) ? aF.concat(["center"]) : af.test(aF[0]) ? ["center"].concat(aF) : ["center", "center"] } aF[0] = ae.test(aF[0]) ? aF[0] : "center";
                aF[1] = af.test(aF[1]) ? aF[1] : "center";
                aG = ar.exec(aF[0]);
                aH = ar.exec(aF[1]);
                aw[this] = [aG ? aG[0] : 0, aH ? aH[0] : 0];
                au[this] = [ag.exec(aF[0])[0], ag.exec(aF[1])[0]] }); if (az.length === 1) { az[1] = az[0] } if (au.at[0] === "right") { aD.left += aB } else { if (au.at[0] === "center") { aD.left += aB / 2 } } if (au.at[1] === "bottom") { aD.top += ax } else { if (au.at[1] === "center") { aD.top += ax / 2 } } aC = ai(aw.at, aB, ax);
            aD.left += aC[0];
            aD.top += aC[1]; return this.each(function() { var aG, aP, aH = e(this),
                    aF = aH.outerWidth(),
                    aL = aH.outerHeight(),
                    aM = al(this, "marginLeft"),
                    aJ = al(this, "marginTop"),
                    aK = aF + aM + al(this, "marginRight") + at.width,
                    aN = aL + aJ + al(this, "marginBottom") + at.height,
                    aI = e.extend({}, aD),
                    aO = ai(aw.my, aH.outerWidth(), aH.outerHeight()); if (au.my[0] === "right") { aI.left -= aF } else { if (au.my[0] === "center") { aI.left -= aF / 2 } } if (au.my[1] === "bottom") { aI.top -= aL } else { if (au.my[1] === "center") { aI.top -= aL / 2 } } aI.left += aO[0];
                aI.top += aO[1]; if (!an) { aI.left = aq(aI.left);
                    aI.top = aq(aI.top) } aG = { marginLeft: aM, marginTop: aJ };
                e.each(["left", "top"], function(aR, aQ) { if (e.ui.position[az[aR]]) { e.ui.position[az[aR]][aQ](aI, { targetWidth: aB, targetHeight: ax, elemWidth: aF, elemHeight: aL, collisionPosition: aG, collisionWidth: aK, collisionHeight: aN, offset: [aC[0] + aO[0], aC[1] + aO[1]], my: au.my, at: au.at, within: ay, elem: aH }) } }); if (au.using) { aP = function(aU) { var aS = aA.left - aI.left,
                            aQ = aS + aB - aF,
                            aT = aA.top - aI.top,
                            aV = aT + ax - aL,
                            aR = { target: { element: av, left: aA.left, top: aA.top, width: aB, height: ax }, element: { element: aH, left: aI.left, top: aI.top, width: aF, height: aL }, horizontal: aQ < 0 ? "left" : aS > 0 ? "right" : "center", vertical: aV < 0 ? "top" : aT > 0 ? "bottom" : "middle" }; if (aB < aF && am(aS + aQ) < aB) { aR.horizontal = "center" } if (ax < aL && am(aT + aV) < ax) { aR.vertical = "middle" } if (ap(am(aS), am(aQ)) > ap(am(aT), am(aV))) { aR.important = "horizontal" } else { aR.important = "vertical" } au.using.call(this, aU, aR) } } aH.offset(e.extend(aI, { using: aP })) }) };
        e.ui.position = { fit: { left: function(az, at) { var av = at.within,
                        ax = av.isWindow ? av.scrollLeft : av.offset.left,
                        aw = av.width,
                        au = az.left - at.collisionPosition.marginLeft,
                        aA = ax - au,
                        ay = au + at.collisionWidth - aw - ax,
                        aB; if (at.collisionWidth > aw) { if (aA > 0 && ay <= 0) { aB = az.left + aA + at.collisionWidth - aw - ax;
                            az.left += aA - aB } else { if (ay > 0 && aA <= 0) { az.left = ax } else { if (aA > ay) { az.left = ax + aw - at.collisionWidth } else { az.left = ax } } } } else { if (aA > 0) { az.left += aA } else { if (ay > 0) { az.left -= ay } else { az.left = ap(az.left - au, az.left) } } } }, top: function(ay, at) { var ax = at.within,
                        az = ax.isWindow ? ax.scrollTop : ax.offset.top,
                        au = at.within.height,
                        aA = ay.top - at.collisionPosition.marginTop,
                        aw = az - aA,
                        av = aA + at.collisionHeight - au - az,
                        aB; if (at.collisionHeight > au) { if (aw > 0 && av <= 0) { aB = ay.top + aw + at.collisionHeight - au - az;
                            ay.top += aw - aB } else { if (av > 0 && aw <= 0) { ay.top = az } else { if (aw > av) { ay.top = az + au - at.collisionHeight } else { ay.top = az } } } } else { if (aw > 0) { ay.top += aw } else { if (av > 0) { ay.top -= av } else { ay.top = ap(ay.top - aA, ay.top) } } } } }, flip: { left: function(aF, aB) { var au = aB.within,
                        aG = au.offset.left + au.scrollLeft,
                        aw = au.width,
                        aE = au.isWindow ? au.scrollLeft : au.offset.left,
                        aD = aF.left - aB.collisionPosition.marginLeft,
                        at = aD - aE,
                        av = aD + aB.collisionWidth - aw - aE,
                        aA = aB.my[0] === "left" ? -aB.elemWidth : aB.my[0] === "right" ? aB.elemWidth : 0,
                        az = aB.at[0] === "left" ? aB.targetWidth : aB.at[0] === "right" ? -aB.targetWidth : 0,
                        ax = -2 * aB.offset[0],
                        ay, aC; if (at < 0) { ay = aF.left + aA + az + ax + aB.collisionWidth - aw - aG; if (ay < 0 || ay < am(at)) { aF.left += aA + az + ax } } else { if (av > 0) { aC = aF.left - aB.collisionPosition.marginLeft + aA + az + ax - aE; if (aC > 0 || am(aC) < av) { aF.left += aA + az + ax } } } }, top: function(aB, aC) { var at = aC.within,
                        aA = at.offset.top + at.scrollTop,
                        aF = at.height,
                        au = at.isWindow ? at.scrollTop : at.offset.top,
                        aH = aB.top - aC.collisionPosition.marginTop,
                        ax = aH - au,
                        ay = aH + aC.collisionHeight - aF - au,
                        av = aC.my[1] === "top",
                        aG = av ? -aC.elemHeight : aC.my[1] === "bottom" ? aC.elemHeight : 0,
                        az = aC.at[1] === "top" ? aC.targetHeight : aC.at[1] === "bottom" ? -aC.targetHeight : 0,
                        aw = -2 * aC.offset[1],
                        aD, aE; if (ax < 0) { aE = aB.top + aG + az + aw + aC.collisionHeight - aF - aA; if ((aB.top + aG + az + aw) > ax && (aE < 0 || aE < am(ax))) { aB.top += aG + az + aw } } else { if (ay > 0) { aD = aB.top - aC.collisionPosition.marginTop + aG + az + aw - au; if ((aB.top + aG + az + aw) > ay && (aD > 0 || am(aD) < ay)) { aB.top += aG + az + aw } } } } }, flipfit: { left: function() { e.ui.position.flip.left.apply(this, arguments);
                    e.ui.position.fit.left.apply(this, arguments) }, top: function() { e.ui.position.flip.top.apply(this, arguments);
                    e.ui.position.fit.top.apply(this, arguments) } } };
        (function() { var av, aw, ay, ax, at, au = document.getElementsByTagName("body")[0],
                az = document.createElement("div");
            av = document.createElement(au ? "div" : "body");
            ay = { visibility: "hidden", width: 0, height: 0, border: 0, margin: 0, background: "none" }; if (au) { e.extend(ay, { position: "absolute", left: "-1000px", top: "-1000px" }) } for (at in ay) { av.style[at] = ay[at] } av.appendChild(az);
            aw = au || document.documentElement;
            aw.insertBefore(av, aw.firstChild);
            az.style.cssText = "position: absolute; left: 10.7432222px;";
            ax = e(az).offset().left;
            an = ax > 10 && ax < 11;
            av.innerHTML = "";
            aw.removeChild(av) })() })(); var ad = e.ui.position; var C = e.widget("ui.accordion", { version: "1.11.2", options: { active: 0, animate: {}, collapsible: false, event: "click", header: "> li > :first-child,> :not(li):even", heightStyle: "auto", icons: { activeHeader: "ui-icon-triangle-1-s", header: "ui-icon-triangle-1-e" }, activate: null, beforeActivate: null }, hideProps: { borderTopWidth: "hide", borderBottomWidth: "hide", paddingTop: "hide", paddingBottom: "hide", height: "hide" }, showProps: { borderTopWidth: "show", borderBottomWidth: "show", paddingTop: "show", paddingBottom: "show", height: "show" }, _create: function() { var ae = this.options;
            this.prevShow = this.prevHide = e();
            this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"); if (!ae.collapsible && (ae.active === false || ae.active == null)) { ae.active = 0 } this._processPanels(); if (ae.active < 0) { ae.active += this.headers.length } this._refresh() }, _getCreateEventData: function() { return { header: this.active, panel: !this.active.length ? e() : this.active.next() } }, _createIcons: function() { var ae = this.options.icons; if (ae) { e("<span>").addClass("ui-accordion-header-icon ui-icon " + ae.header).prependTo(this.headers);
                this.active.children(".ui-accordion-header-icon").removeClass(ae.header).addClass(ae.activeHeader);
                this.headers.addClass("ui-accordion-icons") } }, _destroyIcons: function() { this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove() }, _destroy: function() { var ae;
            this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");
            this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").removeUniqueId();
            this._destroyIcons();
            ae = this.headers.next().removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").css("display", "").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeUniqueId(); if (this.options.heightStyle !== "content") { ae.css("height", "") } }, _setOption: function(ae, af) { if (ae === "active") { this._activate(af); return } if (ae === "event") { if (this.options.event) { this._off(this.headers, this.options.event) } this._setupEvents(af) } this._super(ae, af); if (ae === "collapsible" && !af && this.options.active === false) { this._activate(0) } if (ae === "icons") { this._destroyIcons(); if (af) { this._createIcons() } } if (ae === "disabled") { this.element.toggleClass("ui-state-disabled", !!af).attr("aria-disabled", af);
                this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!af) } }, _keydown: function(ag) { if (ag.altKey || ag.ctrlKey) { return } var ah = e.ui.keyCode,
                af = this.headers.length,
                ae = this.headers.index(ag.target),
                ai = false; switch (ag.keyCode) {
                case ah.RIGHT:
                case ah.DOWN:
                    ai = this.headers[(ae + 1) % af]; break;
                case ah.LEFT:
                case ah.UP:
                    ai = this.headers[(ae - 1 + af) % af]; break;
                case ah.SPACE:
                case ah.ENTER:
                    this._eventHandler(ag); break;
                case ah.HOME:
                    ai = this.headers[0]; break;
                case ah.END:
                    ai = this.headers[af - 1]; break } if (ai) { e(ag.target).attr("tabIndex", -1);
                e(ai).attr("tabIndex", 0);
                ai.focus();
                ag.preventDefault() } }, _panelKeyDown: function(ae) { if (ae.keyCode === e.ui.keyCode.UP && ae.ctrlKey) { e(ae.currentTarget).prev().focus() } }, refresh: function() { var ae = this.options;
            this._processPanels(); if ((ae.active === false && ae.collapsible === true) || !this.headers.length) { ae.active = false;
                this.active = e() } else { if (ae.active === false) { this._activate(0) } else { if (this.active.length && !e.contains(this.element[0], this.active[0])) { if (this.headers.length === this.headers.find(".ui-state-disabled").length) { ae.active = false;
                            this.active = e() } else { this._activate(Math.max(0, ae.active - 1)) } } else { ae.active = this.headers.index(this.active) } } } this._destroyIcons();
            this._refresh() }, _processPanels: function() { var af = this.headers,
                ae = this.panels;
            this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-state-default ui-corner-all");
            this.panels = this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide(); if (ae) { this._off(af.not(this.headers));
                this._off(ae.not(this.panels)) } }, _refresh: function() { var ae, ah = this.options,
                ag = ah.heightStyle,
                af = this.element.parent();
            this.active = this._findActive(ah.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all");
            this.active.next().addClass("ui-accordion-content-active").show();
            this.headers.attr("role", "tab").each(function() { var al = e(this),
                    aj = al.uniqueId().attr("id"),
                    ai = al.next(),
                    ak = ai.uniqueId().attr("id");
                al.attr("aria-controls", ak);
                ai.attr("aria-labelledby", aj) }).next().attr("role", "tabpanel");
            this.headers.not(this.active).attr({ "aria-selected": "false", "aria-expanded": "false", tabIndex: -1 }).next().attr({ "aria-hidden": "true" }).hide(); if (!this.active.length) { this.headers.eq(0).attr("tabIndex", 0) } else { this.active.attr({ "aria-selected": "true", "aria-expanded": "true", tabIndex: 0 }).next().attr({ "aria-hidden": "false" }) } this._createIcons();
            this._setupEvents(ah.event); if (ag === "fill") { ae = af.height();
                this.element.siblings(":visible").each(function() { var ai = e(this),
                        aj = ai.css("position"); if (aj === "absolute" || aj === "fixed") { return } ae -= ai.outerHeight(true) });
                this.headers.each(function() { ae -= e(this).outerHeight(true) });
                this.headers.next().each(function() { e(this).height(Math.max(0, ae - e(this).innerHeight() + e(this).height())) }).css("overflow", "auto") } else { if (ag === "auto") { ae = 0;
                    this.headers.next().each(function() { ae = Math.max(ae, e(this).css("height", "").height()) }).height(ae) } } }, _activate: function(ae) { var af = this._findActive(ae)[0]; if (af === this.active[0]) { return } af = af || this.active[0];
            this._eventHandler({ target: af, currentTarget: af, preventDefault: e.noop }) }, _findActive: function(ae) { return typeof ae === "number" ? this.headers.eq(ae) : e() }, _setupEvents: function(af) { var ae = { keydown: "_keydown" }; if (af) { e.each(af.split(" "), function(ah, ag) { ae[ag] = "_eventHandler" }) } this._off(this.headers.add(this.headers.next()));
            this._on(this.headers, ae);
            this._on(this.headers.next(), { keydown: "_panelKeyDown" });
            this._hoverable(this.headers);
            this._focusable(this.headers) }, _eventHandler: function(aj) { var af = this.options,
                ah = this.active,
                al = e(aj.currentTarget),
                ag = al[0] === ah[0],
                ak = ag && af.collapsible,
                am = ak ? e() : al.next(),
                ai = ah.next(),
                ae = { oldHeader: ah, oldPanel: ai, newHeader: ak ? e() : al, newPanel: am };
            aj.preventDefault(); if ((ag && !af.collapsible) || (this._trigger("beforeActivate", aj, ae) === false)) { return } af.active = ak ? false : this.headers.index(al);
            this.active = ag ? e() : al;
            this._toggle(ae);
            ah.removeClass("ui-accordion-header-active ui-state-active"); if (af.icons) { ah.children(".ui-accordion-header-icon").removeClass(af.icons.activeHeader).addClass(af.icons.header) } if (!ag) { al.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"); if (af.icons) { al.children(".ui-accordion-header-icon").removeClass(af.icons.header).addClass(af.icons.activeHeader) } al.next().addClass("ui-accordion-content-active") } }, _toggle: function(af) { var ae = af.newPanel,
                ag = this.prevShow.length ? this.prevShow : af.oldPanel;
            this.prevShow.add(this.prevHide).stop(true, true);
            this.prevShow = ae;
            this.prevHide = ag; if (this.options.animate) { this._animate(ae, ag, af) } else { ag.hide();
                ae.show();
                this._toggleComplete(af) } ag.attr({ "aria-hidden": "true" });
            ag.prev().attr("aria-selected", "false"); if (ae.length && ag.length) { ag.prev().attr({ tabIndex: -1, "aria-expanded": "false" }) } else { if (ae.length) { this.headers.filter(function() { return e(this).attr("tabIndex") === 0 }).attr("tabIndex", -1) } } ae.attr("aria-hidden", "false").prev().attr({ "aria-selected": "true", tabIndex: 0, "aria-expanded": "true" }) }, _animate: function(ao, ap, af) { var ai, ag, aj, an = this,
                ae = 0,
                ah = ao.length && (!ap.length || (ao.index() < ap.index())),
                am = this.options.animate || {},
                ak = ah && am.down || am,
                al = function() { an._toggleComplete(af) }; if (typeof ak === "number") { aj = ak } if (typeof ak === "string") { ag = ak } ag = ag || ak.easing || am.easing;
            aj = aj || ak.duration || am.duration; if (!ap.length) { return ao.animate(this.showProps, aj, ag, al) } if (!ao.length) { return ap.animate(this.hideProps, aj, ag, al) } ai = ao.show().outerHeight();
            ap.animate(this.hideProps, { duration: aj, easing: ag, step: function(aq, ar) { ar.now = Math.round(aq) } });
            ao.hide().animate(this.showProps, { duration: aj, easing: ag, complete: al, step: function(aq, ar) { ar.now = Math.round(aq); if (ar.prop !== "height") { ae += ar.now } else { if (an.options.heightStyle !== "content") { ar.now = Math.round(ai - ap.outerHeight() - ae);
                            ae = 0 } } } }) }, _toggleComplete: function(ae) { var af = ae.oldPanel;
            af.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"); if (af.length) { af.parent()[0].className = af.parent()[0].className } this._trigger("activate", null, ae) } }); var l = e.widget("ui.menu", { version: "1.11.2", defaultElement: "<ul>", delay: 300, options: { icons: { submenu: "ui-icon-carat-1-e" }, items: "> *", menus: "ul", position: { my: "left-1 top", at: "right top" }, role: "menu", blur: null, focus: null, select: null }, _create: function() { this.activeMenu = this.element;
            this.mouseHandled = false;
            this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({ role: this.options.role, tabIndex: 0 }); if (this.options.disabled) { this.element.addClass("ui-state-disabled").attr("aria-disabled", "true") } this._on({ "mousedown .ui-menu-item": function(ae) { ae.preventDefault() }, "click .ui-menu-item": function(ae) { var af = e(ae.target); if (!this.mouseHandled && af.not(".ui-state-disabled").length) { this.select(ae); if (!ae.isPropagationStopped()) { this.mouseHandled = true } if (af.has(".ui-menu").length) { this.expand(ae) } else { if (!this.element.is(":focus") && e(this.document[0].activeElement).closest(".ui-menu").length) { this.element.trigger("focus", [true]); if (this.active && this.active.parents(".ui-menu").length === 1) { clearTimeout(this.timer) } } } } }, "mouseenter .ui-menu-item": function(ae) { if (this.previousFilter) { return } var af = e(ae.currentTarget);
                    af.siblings(".ui-state-active").removeClass("ui-state-active");
                    this.focus(ae, af) }, mouseleave: "collapseAll", "mouseleave .ui-menu": "collapseAll", focus: function(af, ae) { var ag = this.active || this.element.find(this.options.items).eq(0); if (!ae) { this.focus(af, ag) } }, blur: function(ae) { this._delay(function() { if (!e.contains(this.element[0], this.document[0].activeElement)) { this.collapseAll(ae) } }) }, keydown: "_keydown" });
            this.refresh();
            this._on(this.document, { click: function(ae) { if (this._closeOnDocumentClick(ae)) { this.collapseAll(ae) } this.mouseHandled = false } }) }, _destroy: function() { this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show();
            this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function() { var ae = e(this); if (ae.data("ui-menu-submenu-carat")) { ae.remove() } });
            this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content") }, _keydown: function(ah) { var af, ai, ae, ag, aj = true; switch (ah.keyCode) {
                case e.ui.keyCode.PAGE_UP:
                    this.previousPage(ah); break;
                case e.ui.keyCode.PAGE_DOWN:
                    this.nextPage(ah); break;
                case e.ui.keyCode.HOME:
                    this._move("first", "first", ah); break;
                case e.ui.keyCode.END:
                    this._move("last", "last", ah); break;
                case e.ui.keyCode.UP:
                    this.previous(ah); break;
                case e.ui.keyCode.DOWN:
                    this.next(ah); break;
                case e.ui.keyCode.LEFT:
                    this.collapse(ah); break;
                case e.ui.keyCode.RIGHT:
                    if (this.active && !this.active.is(".ui-state-disabled")) { this.expand(ah) } break;
                case e.ui.keyCode.ENTER:
                case e.ui.keyCode.SPACE:
                    this._activate(ah); break;
                case e.ui.keyCode.ESCAPE:
                    this.collapse(ah); break;
                default:
                    aj = false;
                    ai = this.previousFilter || "";
                    ae = String.fromCharCode(ah.keyCode);
                    ag = false;
                    clearTimeout(this.filterTimer); if (ae === ai) { ag = true } else { ae = ai + ae } af = this._filterMenuItems(ae);
                    af = ag && af.index(this.active.next()) !== -1 ? this.active.nextAll(".ui-menu-item") : af; if (!af.length) { ae = String.fromCharCode(ah.keyCode);
                        af = this._filterMenuItems(ae) } if (af.length) { this.focus(ah, af);
                        this.previousFilter = ae;
                        this.filterTimer = this._delay(function() { delete this.previousFilter }, 1000) } else { delete this.previousFilter } } if (aj) { ah.preventDefault() } }, _activate: function(ae) { if (!this.active.is(".ui-state-disabled")) { if (this.active.is("[aria-haspopup='true']")) { this.expand(ae) } else { this.select(ae) } } }, refresh: function() { var af, ah, ai = this,
                ae = this.options.icons.submenu,
                ag = this.element.find(this.options.menus);
            this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length);
            ag.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({ role: this.options.role, "aria-hidden": "true", "aria-expanded": "false" }).each(function() { var aj = e(this),
                    ak = aj.parent(),
                    al = e("<span>").addClass("ui-menu-icon ui-icon " + ae).data("ui-menu-submenu-carat", true);
                ak.attr("aria-haspopup", "true").prepend(al);
                aj.attr("aria-labelledby", ak.attr("id")) });
            af = ag.add(this.element);
            ah = af.find(this.options.items);
            ah.not(".ui-menu-item").each(function() { var aj = e(this); if (ai._isDivider(aj)) { aj.addClass("ui-widget-content ui-menu-divider") } });
            ah.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({ tabIndex: -1, role: this._itemRole() });
            ah.filter(".ui-state-disabled").attr("aria-disabled", "true"); if (this.active && !e.contains(this.element[0], this.active[0])) { this.blur() } }, _itemRole: function() { return { menu: "menuitem", listbox: "option" }[this.options.role] }, _setOption: function(ae, af) { if (ae === "icons") { this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(af.submenu) } if (ae === "disabled") { this.element.toggleClass("ui-state-disabled", !!af).attr("aria-disabled", af) } this._super(ae, af) }, focus: function(ae, af) { var ag, ah;
            this.blur(ae, ae && ae.type === "focus");
            this._scrollIntoView(af);
            this.active = af.first();
            ah = this.active.addClass("ui-state-focus").removeClass("ui-state-active"); if (this.options.role) { this.element.attr("aria-activedescendant", ah.attr("id")) } this.active.parent().closest(".ui-menu-item").addClass("ui-state-active"); if (ae && ae.type === "keydown") { this._close() } else { this.timer = this._delay(function() { this._close() }, this.delay) } ag = af.children(".ui-menu"); if (ag.length && ae && (/^mouse/.test(ae.type))) { this._startOpening(ag) } this.activeMenu = af.parent();
            this._trigger("focus", ae, { item: af }) }, _scrollIntoView: function(ak) { var ae, aj, ah, ag, af, ai; if (this._hasScroll()) { ae = parseFloat(e.css(this.activeMenu[0], "borderTopWidth")) || 0;
                aj = parseFloat(e.css(this.activeMenu[0], "paddingTop")) || 0;
                ah = ak.offset().top - this.activeMenu.offset().top - ae - aj;
                ag = this.activeMenu.scrollTop();
                af = this.activeMenu.height();
                ai = ak.outerHeight(); if (ah < 0) { this.activeMenu.scrollTop(ag + ah) } else { if (ah + ai > af) { this.activeMenu.scrollTop(ag + ah - af + ai) } } } }, blur: function(af, ae) { if (!ae) { clearTimeout(this.timer) } if (!this.active) { return } this.active.removeClass("ui-state-focus");
            this.active = null;
            this._trigger("blur", af, { item: this.active }) }, _startOpening: function(ae) { clearTimeout(this.timer); if (ae.attr("aria-hidden") !== "true") { return } this.timer = this._delay(function() { this._close();
                this._open(ae) }, this.delay) }, _open: function(af) { var ae = e.extend({ of: this.active }, this.options.position);
            clearTimeout(this.timer);
            this.element.find(".ui-menu").not(af.parents(".ui-menu")).hide().attr("aria-hidden", "true");
            af.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(ae) }, collapseAll: function(af, ae) { clearTimeout(this.timer);
            this.timer = this._delay(function() { var ag = ae ? this.element : e(af && af.target).closest(this.element.find(".ui-menu")); if (!ag.length) { ag = this.element } this._close(ag);
                this.blur(af);
                this.activeMenu = ag }, this.delay) }, _close: function(ae) { if (!ae) { ae = this.active ? this.active.parent() : this.element } ae.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active") }, _closeOnDocumentClick: function(ae) { return !e(ae.target).closest(".ui-menu").length }, _isDivider: function(ae) { return !/[^\-\u2014\u2013\s]/.test(ae.text()) }, collapse: function(af) { var ae = this.active && this.active.parent().closest(".ui-menu-item", this.element); if (ae && ae.length) { this._close();
                this.focus(af, ae) } }, expand: function(af) { var ae = this.active && this.active.children(".ui-menu ").find(this.options.items).first(); if (ae && ae.length) { this._open(ae.parent());
                this._delay(function() { this.focus(af, ae) }) } }, next: function(ae) { this._move("next", "first", ae) }, previous: function(ae) { this._move("prev", "last", ae) }, isFirstItem: function() { return this.active && !this.active.prevAll(".ui-menu-item").length }, isLastItem: function() { return this.active && !this.active.nextAll(".ui-menu-item").length }, _move: function(af, ae, ag) { var ah; if (this.active) { if (af === "first" || af === "last") { ah = this.active[af === "first" ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) } else { ah = this.active[af + "All"](".ui-menu-item").eq(0) } } if (!ah || !ah.length || !this.active) { ah = this.activeMenu.find(this.options.items)[ae]() } this.focus(ag, ah) }, nextPage: function(ag) { var ah, ae, af; if (!this.active) { this.next(ag); return } if (this.isLastItem()) { return } if (this._hasScroll()) { ae = this.active.offset().top;
                af = this.element.height();
                this.active.nextAll(".ui-menu-item").each(function() { ah = e(this); return ah.offset().top - ae - af < 0 });
                this.focus(ag, ah) } else { this.focus(ag, this.activeMenu.find(this.options.items)[!this.active ? "first" : "last"]()) } }, previousPage: function(ag) { var ah, ae, af; if (!this.active) { this.next(ag); return } if (this.isFirstItem()) { return } if (this._hasScroll()) { ae = this.active.offset().top;
                af = this.element.height();
                this.active.prevAll(".ui-menu-item").each(function() { ah = e(this); return ah.offset().top - ae + af > 0 });
                this.focus(ag, ah) } else { this.focus(ag, this.activeMenu.find(this.options.items).first()) } }, _hasScroll: function() { return this.element.outerHeight() < this.element.prop("scrollHeight") }, select: function(af) { this.active = this.active || e(af.target).closest(".ui-menu-item"); var ae = { item: this.active }; if (!this.active.has(".ui-menu").length) { this.collapseAll(af, true) } this._trigger("select", af, ae) }, _filterMenuItems: function(ae) { var ag = ae.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&"),
                af = new RegExp("^" + ag, "i"); return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function() { return af.test(e.trim(e(this).text())) }) } });
    e.widget("ui.autocomplete", { version: "1.11.2", defaultElement: "<input>", options: { appendTo: null, autoFocus: false, delay: 300, minLength: 1, position: { my: "left top", at: "left bottom", collision: "none" }, source: null, change: null, close: null, focus: null, open: null, response: null, search: null, select: null }, requestIndex: 0, pending: 0, _create: function() { var ah, aj, af, ai = this.element[0].nodeName.toLowerCase(),
                ae = ai === "textarea",
                ag = ai === "input";
            this.isMultiLine = ae ? true : ag ? false : this.element.prop("isContentEditable");
            this.valueMethod = this.element[ae || ag ? "val" : "text"];
            this.isNewMenu = true;
            this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off");
            this._on(this.element, { keydown: function(al) { if (this.element.prop("readOnly")) { ah = true;
                        af = true;
                        aj = true; return } ah = false;
                    af = false;
                    aj = false; var ak = e.ui.keyCode; switch (al.keyCode) {
                        case ak.PAGE_UP:
                            ah = true;
                            this._move("previousPage", al); break;
                        case ak.PAGE_DOWN:
                            ah = true;
                            this._move("nextPage", al); break;
                        case ak.UP:
                            ah = true;
                            this._keyEvent("previous", al); break;
                        case ak.DOWN:
                            ah = true;
                            this._keyEvent("next", al); break;
                        case ak.ENTER:
                            if (this.menu.active) { ah = true;
                                al.preventDefault();
                                this.menu.select(al) } break;
                        case ak.TAB:
                            if (this.menu.active) { this.menu.select(al) } break;
                        case ak.ESCAPE:
                            if (this.menu.element.is(":visible")) { if (!this.isMultiLine) { this._value(this.term) } this.close(al);
                                al.preventDefault() } break;
                        default:
                            aj = true;
                            this._searchTimeout(al); break } }, keypress: function(al) { if (ah) { ah = false; if (!this.isMultiLine || this.menu.element.is(":visible")) { al.preventDefault() } return } if (aj) { return } var ak = e.ui.keyCode; switch (al.keyCode) {
                        case ak.PAGE_UP:
                            this._move("previousPage", al); break;
                        case ak.PAGE_DOWN:
                            this._move("nextPage", al); break;
                        case ak.UP:
                            this._keyEvent("previous", al); break;
                        case ak.DOWN:
                            this._keyEvent("next", al); break } }, input: function(ak) { if (af) { af = false;
                        ak.preventDefault(); return } this._searchTimeout(ak) }, focus: function() { this.selectedItem = null;
                    this.previous = this._value() }, blur: function(ak) { if (this.cancelBlur) { delete this.cancelBlur; return } clearTimeout(this.searching);
                    this.close(ak);
                    this._change(ak) } });
            this._initSource();
            this.menu = e("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({ role: null }).hide().menu("instance");
            this._on(this.menu.element, { mousedown: function(ak) { ak.preventDefault();
                    this.cancelBlur = true;
                    this._delay(function() { delete this.cancelBlur }); var al = this.menu.element[0]; if (!e(ak.target).closest(".ui-menu-item").length) { this._delay(function() { var am = this;
                            this.document.one("mousedown", function(an) { if (an.target !== am.element[0] && an.target !== al && !e.contains(al, an.target)) { am.close() } }) }) } }, menufocus: function(al, ak) { var an, am; if (this.isNewMenu) { this.isNewMenu = false; if (al.originalEvent && /^mouse/.test(al.originalEvent.type)) { this.menu.blur();
                            this.document.one("mousemove", function() { e(al.target).trigger(al.originalEvent) }); return } } am = ak.item.data("ui-autocomplete-item"); if (false !== this._trigger("focus", al, { item: am })) { if (al.originalEvent && /^key/.test(al.originalEvent.type)) { this._value(am.value) } } an = ak.item.attr("aria-label") || am.value; if (an && e.trim(an).length) { this.liveRegion.children().hide();
                        e("<div>").text(an).appendTo(this.liveRegion) } }, menuselect: function(al, ak) { var am = ak.item.data("ui-autocomplete-item"),
                        an = this.previous; if (this.element[0] !== this.document[0].activeElement) { this.element.focus();
                        this.previous = an;
                        this._delay(function() { this.previous = an;
                            this.selectedItem = am }) } if (false !== this._trigger("select", al, { item: am })) { this._value(am.value) } this.term = this._value();
                    this.close(al);
                    this.selectedItem = am } });
            this.liveRegion = e("<span>", { role: "status", "aria-live": "assertive", "aria-relevant": "additions" }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body);
            this._on(this.window, { beforeunload: function() { this.element.removeAttr("autocomplete") } }) }, _destroy: function() { clearTimeout(this.searching);
            this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete");
            this.menu.element.remove();
            this.liveRegion.remove() }, _setOption: function(ae, af) { this._super(ae, af); if (ae === "source") { this._initSource() } if (ae === "appendTo") { this.menu.element.appendTo(this._appendTo()) } if (ae === "disabled" && af && this.xhr) { this.xhr.abort() } }, _appendTo: function() { var ae = this.options.appendTo; if (ae) { ae = ae.jquery || ae.nodeType ? e(ae) : this.document.find(ae).eq(0) } if (!ae || !ae[0]) { ae = this.element.closest(".ui-front") } if (!ae.length) { ae = this.document[0].body } return ae }, _initSource: function() { var ag, ae, af = this; if (e.isArray(this.options.source)) { ag = this.options.source;
                this.source = function(ah, ai) { ai(e.ui.autocomplete.filter(ag, ah.term)) } } else { if (typeof this.options.source === "string") { ae = this.options.source;
                    this.source = function(ah, ai) { if (af.xhr) { af.xhr.abort() } af.xhr = e.ajax({ url: ae, data: ah, dataType: "json", success: function(aj) { ai(aj) }, error: function() { ai([]) } }) } } else { this.source = this.options.source } } }, _searchTimeout: function(ae) { clearTimeout(this.searching);
            this.searching = this._delay(function() { var af = this.term === this._value(),
                    ah = this.menu.element.is(":visible"),
                    ag = ae.altKey || ae.ctrlKey || ae.metaKey || ae.shiftKey; if (!af || (af && !ah && !ag)) { this.selectedItem = null;
                    this.search(null, ae) } }, this.options.delay) }, search: function(af, ae) { af = af != null ? af : this._value();
            this.term = this._value(); if (af.length < this.options.minLength) { return this.close(ae) } if (this._trigger("search", ae) === false) { return } return this._search(af) }, _search: function(ae) { this.pending++;
            this.element.addClass("ui-autocomplete-loading");
            this.cancelSearch = false;
            this.source({ term: ae }, this._response()) }, _response: function() { var ae = ++this.requestIndex; return e.proxy(function(af) { if (ae === this.requestIndex) { this.__response(af) } this.pending--; if (!this.pending) { this.element.removeClass("ui-autocomplete-loading") } }, this) }, __response: function(ae) { if (ae) { ae = this._normalize(ae) } this._trigger("response", null, { content: ae }); if (!this.options.disabled && ae && ae.length && !this.cancelSearch) { this._suggest(ae);
                this._trigger("open") } else { this._close() } }, close: function(ae) { this.cancelSearch = true;
            this._close(ae) }, _close: function(ae) { if (this.menu.element.is(":visible")) { this.menu.element.hide();
                this.menu.blur();
                this.isNewMenu = true;
                this._trigger("close", ae) } }, _change: function(ae) { if (this.previous !== this._value()) { this._trigger("change", ae, { item: this.selectedItem }) } }, _normalize: function(ae) { if (ae.length && ae[0].label && ae[0].value) { return ae } return e.map(ae, function(af) { if (typeof af === "string") { return { label: af, value: af } } return e.extend({}, af, { label: af.label || af.value, value: af.value || af.label }) }) }, _suggest: function(af) { var ae = this.menu.element.empty();
            this._renderMenu(ae, af);
            this.isNewMenu = true;
            this.menu.refresh();
            ae.show();
            this._resizeMenu();
            ae.position(e.extend({ of: this.element }, this.options.position)); if (this.options.autoFocus) { this.menu.next() } }, _resizeMenu: function() { var ae = this.menu.element;
            ae.outerWidth(Math.max(ae.width("").outerWidth() + 1, this.element.outerWidth())) }, _renderMenu: function(af, ag) { var ae = this;
            e.each(ag, function(ai, ah) { ae._renderItemData(af, ah) }) }, _renderItemData: function(ae, af) { return this._renderItem(ae, af).data("ui-autocomplete-item", af) }, _renderItem: function(ae, af) { return e("<li>").text(af.label).appendTo(ae) }, _move: function(af, ae) { if (!this.menu.element.is(":visible")) { this.search(null, ae); return } if (this.menu.isFirstItem() && /^previous/.test(af) || this.menu.isLastItem() && /^next/.test(af)) { if (!this.isMultiLine) { this._value(this.term) } this.menu.blur(); return } this.menu[af](ae) }, widget: function() { return this.menu.element }, _value: function() { return this.valueMethod.apply(this.element, arguments) }, _keyEvent: function(af, ae) { if (!this.isMultiLine || this.menu.element.is(":visible")) { this._move(af, ae);
                ae.preventDefault() } } });
    e.extend(e.ui.autocomplete, { escapeRegex: function(ae) { return ae.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&") }, filter: function(ae, ag) { var af = new RegExp(e.ui.autocomplete.escapeRegex(ag), "i"); return e.grep(ae, function(ah) { return af.test(ah.label || ah.value || ah) }) } });
    e.widget("ui.autocomplete", e.ui.autocomplete, { options: { messages: { noResults: "No search results.", results: function(ae) { return ae + (ae > 1 ? " results are" : " result is") + " available, use up and down arrow keys to navigate." } } }, __response: function(ae) { var af;
            this._superApply(arguments); if (this.options.disabled || this.cancelSearch) { return } if (ae && ae.length) { af = this.options.messages.results(ae.length) } else { af = this.options.messages.noResults } this.liveRegion.children().hide();
            e("<div>").text(af).appendTo(this.liveRegion) } }); var F = e.ui.autocomplete; var O, u = "ui-button ui-widget ui-state-default ui-corner-all",
        Y = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
        Q = function() { var ae = e(this);
            setTimeout(function() { ae.find(":ui-button").button("refresh") }, 1) },
        r = function(ag) { var ah = ag.name,
                ae = ag.form,
                af = e([]); if (ah) { ah = ah.replace(/'/g, "\\'"); if (ae) { af = e(ae).find("[name='" + ah + "'][type=radio]") } else { af = e("[name='" + ah + "'][type=radio]", ag.ownerDocument).filter(function() { return !this.form }) } } return af };
    e.widget("ui.button", { version: "1.11.2", defaultElement: "<button>", options: { disabled: null, text: true, label: null, icons: { primary: null, secondary: null } }, _create: function() { this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, Q); if (typeof this.options.disabled !== "boolean") { this.options.disabled = !!this.element.prop("disabled") } else { this.element.prop("disabled", this.options.disabled) } this._determineButtonType();
            this.hasTitle = !!this.buttonElement.attr("title"); var af = this,
                ah = this.options,
                ag = this.type === "checkbox" || this.type === "radio",
                ae = !ag ? "ui-state-active" : ""; if (ah.label === null) { ah.label = (this.type === "input" ? this.buttonElement.val() : this.buttonElement.html()) } this._hoverable(this.buttonElement);
            this.buttonElement.addClass(u).attr("role", "button").bind("mouseenter" + this.eventNamespace, function() { if (ah.disabled) { return } if (this === O) { e(this).addClass("ui-state-active") } }).bind("mouseleave" + this.eventNamespace, function() { if (ah.disabled) { return } e(this).removeClass(ae) }).bind("click" + this.eventNamespace, function(ai) { if (ah.disabled) { ai.preventDefault();
                    ai.stopImmediatePropagation() } });
            this._on({ focus: function() { this.buttonElement.addClass("ui-state-focus") }, blur: function() { this.buttonElement.removeClass("ui-state-focus") } }); if (ag) { this.element.bind("change" + this.eventNamespace, function() { af.refresh() }) } if (this.type === "checkbox") { this.buttonElement.bind("click" + this.eventNamespace, function() { if (ah.disabled) { return false } }) } else { if (this.type === "radio") { this.buttonElement.bind("click" + this.eventNamespace, function() { if (ah.disabled) { return false } e(this).addClass("ui-state-active");
                        af.buttonElement.attr("aria-pressed", "true"); var ai = af.element[0];
                        r(ai).not(ai).map(function() { return e(this).button("widget")[0] }).removeClass("ui-state-active").attr("aria-pressed", "false") }) } else { this.buttonElement.bind("mousedown" + this.eventNamespace, function() { if (ah.disabled) { return false } e(this).addClass("ui-state-active");
                        O = this;
                        af.document.one("mouseup", function() { O = null }) }).bind("mouseup" + this.eventNamespace, function() { if (ah.disabled) { return false } e(this).removeClass("ui-state-active") }).bind("keydown" + this.eventNamespace, function(ai) { if (ah.disabled) { return false } if (ai.keyCode === e.ui.keyCode.SPACE || ai.keyCode === e.ui.keyCode.ENTER) { e(this).addClass("ui-state-active") } }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function() { e(this).removeClass("ui-state-active") }); if (this.buttonElement.is("a")) { this.buttonElement.keyup(function(ai) { if (ai.keyCode === e.ui.keyCode.SPACE) { e(this).click() } }) } } } this._setOption("disabled", ah.disabled);
            this._resetButton() }, _determineButtonType: function() { var ag, af, ae; if (this.element.is("[type=checkbox]")) { this.type = "checkbox" } else { if (this.element.is("[type=radio]")) { this.type = "radio" } else { if (this.element.is("input")) { this.type = "input" } else { this.type = "button" } } } if (this.type === "checkbox" || this.type === "radio") { ag = this.element.parents().last();
                af = "label[for='" + this.element.attr("id") + "']";
                this.buttonElement = ag.find(af); if (!this.buttonElement.length) { ag = ag.length ? ag.siblings() : this.element.siblings();
                    this.buttonElement = ag.filter(af); if (!this.buttonElement.length) { this.buttonElement = ag.find(af) } } this.element.addClass("ui-helper-hidden-accessible");
                ae = this.element.is(":checked"); if (ae) { this.buttonElement.addClass("ui-state-active") } this.buttonElement.prop("aria-pressed", ae) } else { this.buttonElement = this.element } }, widget: function() { return this.buttonElement }, _destroy: function() { this.element.removeClass("ui-helper-hidden-accessible");
            this.buttonElement.removeClass(u + " ui-state-active " + Y).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()); if (!this.hasTitle) { this.buttonElement.removeAttr("title") } }, _setOption: function(ae, af) { this._super(ae, af); if (ae === "disabled") { this.widget().toggleClass("ui-state-disabled", !!af);
                this.element.prop("disabled", !!af); if (af) { if (this.type === "checkbox" || this.type === "radio") { this.buttonElement.removeClass("ui-state-focus") } else { this.buttonElement.removeClass("ui-state-focus ui-state-active") } } return } this._resetButton() }, refresh: function() { var ae = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled"); if (ae !== this.options.disabled) { this._setOption("disabled", ae) } if (this.type === "radio") { r(this.element[0]).each(function() { if (e(this).is(":checked")) { e(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") } else { e(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false") } }) } else { if (this.type === "checkbox") { if (this.element.is(":checked")) { this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") } else { this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false") } } } }, _resetButton: function() { if (this.type === "input") { if (this.options.label) { this.element.val(this.options.label) } return } var af = this.buttonElement.removeClass(Y),
                ah = e("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(af.empty()).text(),
                ae = this.options.icons,
                ag = ae.primary && ae.secondary,
                ai = []; if (ae.primary || ae.secondary) { if (this.options.text) { ai.push("ui-button-text-icon" + (ag ? "s" : (ae.primary ? "-primary" : "-secondary"))) } if (ae.primary) { af.prepend("<span class='ui-button-icon-primary ui-icon " + ae.primary + "'></span>") } if (ae.secondary) { af.append("<span class='ui-button-icon-secondary ui-icon " + ae.secondary + "'></span>") } if (!this.options.text) { ai.push(ag ? "ui-button-icons-only" : "ui-button-icon-only"); if (!this.hasTitle) { af.attr("title", e.trim(ah)) } } } else { ai.push("ui-button-text-only") } af.addClass(ai.join(" ")) } });
    e.widget("ui.buttonset", { version: "1.11.2", options: { items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)" }, _create: function() { this.element.addClass("ui-buttonset") }, _init: function() { this.refresh() }, _setOption: function(ae, af) { if (ae === "disabled") { this.buttons.button("option", ae, af) } this._super(ae, af) }, refresh: function() { var ae = this.element.css("direction") === "rtl",
                ag = this.element.find(this.options.items),
                af = ag.filter(":ui-button");
            ag.not(":ui-button").button();
            af.button("refresh");
            this.buttons = ag.map(function() { return e(this).button("widget")[0] }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(ae ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(ae ? "ui-corner-left" : "ui-corner-right").end().end() }, _destroy: function() { this.element.removeClass("ui-buttonset");
            this.buttons.map(function() { return e(this).button("widget")[0] }).removeClass("ui-corner-left ui-corner-right").end().button("destroy") } }); var v = e.ui.button;
    e.extend(e.ui, { datepicker: { version: "1.11.2" } }); var B;

    function s(ag) { var ae, af; while (ag.length && ag[0] !== document) { ae = ag.css("position"); if (ae === "absolute" || ae === "relative" || ae === "fixed") { af = parseInt(ag.css("zIndex"), 10); if (!isNaN(af) && af !== 0) { return af } } ag = ag.parent() } return 0 }

    function y() { this._curInst = null;
        this._keyEvent = false;
        this._disabledInputs = [];
        this._datepickerShowing = false;
        this._inDialog = false;
        this._mainDivId = "ui-datepicker-div";
        this._inlineClass = "ui-datepicker-inline";
        this._appendClass = "ui-datepicker-append";
        this._triggerClass = "ui-datepicker-trigger";
        this._dialogClass = "ui-datepicker-dialog";
        this._disableClass = "ui-datepicker-disabled";
        this._unselectableClass = "ui-datepicker-unselectable";
        this._currentClass = "ui-datepicker-current-day";
        this._dayOverClass = "ui-datepicker-days-cell-over";
        this.regional = [];
        this.regional[""] = { closeText: "Done", prevText: "Prev", nextText: "Next", currentText: "Today", monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"], dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"], dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"], weekHeader: "Wk", dateFormat: "mm/dd/yy", firstDay: 0, isRTL: false, showMonthAfterYear: false, yearSuffix: "" };
        this._defaults = { showOn: "focus", showAnim: "fadeIn", showOptions: {}, defaultDate: null, appendText: "", buttonText: "...", buttonImage: "", buttonImageOnly: false, hideIfNoPrevNext: false, navigationAsDateFormat: false, gotoCurrent: false, changeMonth: false, changeYear: false, yearRange: "c-10:c+10", showOtherMonths: false, selectOtherMonths: false, showWeek: false, calculateWeek: this.iso8601Week, shortYearCutoff: "+10", minDate: null, maxDate: null, duration: "fast", beforeShowDay: null, beforeShow: null, onSelect: null, onChangeMonthYear: null, onClose: null, numberOfMonths: 1, showCurrentAtPos: 0, stepMonths: 1, stepBigMonths: 12, altField: "", altFormat: "", constrainInput: true, showButtonPanel: false, autoSize: false, disabled: false };
        e.extend(this._defaults, this.regional[""]);
        this.regional.en = e.extend(true, {}, this.regional[""]);
        this.regional["en-US"] = e.extend(true, {}, this.regional.en);
        this.dpDiv = I(e("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) } e.extend(y.prototype, { markerClassName: "hasDatepicker", maxRows: 4, _widgetDatepicker: function() { return this.dpDiv }, setDefaults: function(ae) { a(this._defaults, ae || {}); return this }, _attachDatepicker: function(ae, ag) { var ai, ah, af;
            ai = ae.nodeName.toLowerCase();
            ah = (ai === "div" || ai === "span"); if (!ae.id) { this.uuid += 1;
                ae.id = "dp" + this.uuid } af = this._newInst(e(ae), ah);
            af.settings = e.extend({}, ag || {}); if (ai === "input") { this._connectDatepicker(ae, af) } else { if (ah) { this._inlineDatepicker(ae, af) } } }, _newInst: function(ae, ag) { var af = ae[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"); return { id: af, input: ae, selectedDay: 0, selectedMonth: 0, selectedYear: 0, drawMonth: 0, drawYear: 0, inline: ag, dpDiv: (!ag ? this.dpDiv : I(e("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))) } }, _connectDatepicker: function(ae, ag) { var af = e(ae);
            ag.append = e([]);
            ag.trigger = e([]); if (af.hasClass(this.markerClassName)) { return } this._attachments(af, ag);
            af.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp);
            this._autoSize(ag);
            e.data(ae, "datepicker", ag); if (ag.settings.disabled) { this._disableDatepicker(ae) } }, _attachments: function(ah, ak) { var ae, af, ai, aj = this._get(ak, "appendText"),
                ag = this._get(ak, "isRTL"); if (ak.append) { ak.append.remove() } if (aj) { ak.append = e("<span class='" + this._appendClass + "'>" + aj + "</span>");
                ah[ag ? "before" : "after"](ak.append) } ah.unbind("focus", this._showDatepicker); if (ak.trigger) { ak.trigger.remove() } ae = this._get(ak, "showOn"); if (ae === "focus" || ae === "both") { ah.focus(this._showDatepicker) } if (ae === "button" || ae === "both") { af = this._get(ak, "buttonText");
                ai = this._get(ak, "buttonImage");
                ak.trigger = e(this._get(ak, "buttonImageOnly") ? e("<img/>").addClass(this._triggerClass).attr({ src: ai, alt: af, title: af }) : e("<button type='button'></button>").addClass(this._triggerClass).html(!ai ? af : e("<img/>").attr({ src: ai, alt: af, title: af })));
                ah[ag ? "before" : "after"](ak.trigger);
                ak.trigger.click(function() { if (e.datepicker._datepickerShowing && e.datepicker._lastInput === ah[0]) { e.datepicker._hideDatepicker() } else { if (e.datepicker._datepickerShowing && e.datepicker._lastInput !== ah[0]) { e.datepicker._hideDatepicker();
                            e.datepicker._showDatepicker(ah[0]) } else { e.datepicker._showDatepicker(ah[0]) } } return false }) } }, _autoSize: function(ai) { if (this._get(ai, "autoSize") && !ai.inline) { var af, ak, aj, ae, ah = new Date(2009, 12 - 1, 20),
                    ag = this._get(ai, "dateFormat"); if (ag.match(/[DM]/)) { af = function(al) { ak = 0;
                        aj = 0; for (ae = 0; ae < al.length; ae++) { if (al[ae].length > ak) { ak = al[ae].length;
                                aj = ae } } return aj };
                    ah.setMonth(af(this._get(ai, (ag.match(/MM/) ? "monthNames" : "monthNamesShort"))));
                    ah.setDate(af(this._get(ai, (ag.match(/DD/) ? "dayNames" : "dayNamesShort"))) + 20 - ah.getDay()) } ai.input.attr("size", this._formatDate(ai, ah).length) } }, _inlineDatepicker: function(ae, ag) { var af = e(ae); if (af.hasClass(this.markerClassName)) { return } af.addClass(this.markerClassName).append(ag.dpDiv);
            e.data(ae, "datepicker", ag);
            this._setDate(ag, this._getDefaultDate(ag), true);
            this._updateDatepicker(ag);
            this._updateAlternate(ag); if (ag.settings.disabled) { this._disableDatepicker(ae) } ag.dpDiv.css("display", "block") }, _dialogDatepicker: function(ai, aj, am, ae, ah) { var ao, af, ak, ag, al, an = this._dialogInst; if (!an) { this.uuid += 1;
                ao = "dp" + this.uuid;
                this._dialogInput = e("<input type='text' id='" + ao + "' style='position: absolute; top: -100px; width: 0px;'/>");
                this._dialogInput.keydown(this._doKeyDown);
                e("body").append(this._dialogInput);
                an = this._dialogInst = this._newInst(this._dialogInput, false);
                an.settings = {};
                e.data(this._dialogInput[0], "datepicker", an) } a(an.settings, ae || {});
            aj = (aj && aj.constructor === Date ? this._formatDate(an, aj) : aj);
            this._dialogInput.val(aj);
            this._pos = (ah ? (ah.length ? ah : [ah.pageX, ah.pageY]) : null); if (!this._pos) { af = document.documentElement.clientWidth;
                ak = document.documentElement.clientHeight;
                ag = document.documentElement.scrollLeft || document.body.scrollLeft;
                al = document.documentElement.scrollTop || document.body.scrollTop;
                this._pos = [(af / 2) - 100 + ag, (ak / 2) - 150 + al] } this._dialogInput.css("left", (this._pos[0] + 20) + "px").css("top", this._pos[1] + "px");
            an.settings.onSelect = am;
            this._inDialog = true;
            this.dpDiv.addClass(this._dialogClass);
            this._showDatepicker(this._dialogInput[0]); if (e.blockUI) { e.blockUI(this.dpDiv) } e.data(this._dialogInput[0], "datepicker", an); return this }, _destroyDatepicker: function(ae) { var ah, ag = e(ae),
                af = e.data(ae, "datepicker"); if (!ag.hasClass(this.markerClassName)) { return } ah = ae.nodeName.toLowerCase();
            e.removeData(ae, "datepicker"); if (ah === "input") { af.append.remove();
                af.trigger.remove();
                ag.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp) } else { if (ah === "div" || ah === "span") { ag.removeClass(this.markerClassName).empty() } } }, _enableDatepicker: function(ae) { var ai, ah, ag = e(ae),
                af = e.data(ae, "datepicker"); if (!ag.hasClass(this.markerClassName)) { return } ai = ae.nodeName.toLowerCase(); if (ai === "input") { ae.disabled = false;
                af.trigger.filter("button").each(function() { this.disabled = false }).end().filter("img").css({ opacity: "1.0", cursor: "" }) } else { if (ai === "div" || ai === "span") { ah = ag.children("." + this._inlineClass);
                    ah.children().removeClass("ui-state-disabled");
                    ah.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", false) } } this._disabledInputs = e.map(this._disabledInputs, function(aj) { return (aj === ae ? null : aj) }) }, _disableDatepicker: function(ae) { var ai, ah, ag = e(ae),
                af = e.data(ae, "datepicker"); if (!ag.hasClass(this.markerClassName)) { return } ai = ae.nodeName.toLowerCase(); if (ai === "input") { ae.disabled = true;
                af.trigger.filter("button").each(function() { this.disabled = true }).end().filter("img").css({ opacity: "0.5", cursor: "default" }) } else { if (ai === "div" || ai === "span") { ah = ag.children("." + this._inlineClass);
                    ah.children().addClass("ui-state-disabled");
                    ah.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", true) } } this._disabledInputs = e.map(this._disabledInputs, function(aj) { return (aj === ae ? null : aj) });
            this._disabledInputs[this._disabledInputs.length] = ae }, _isDisabledDatepicker: function(af) { if (!af) { return false } for (var ae = 0; ae < this._disabledInputs.length; ae++) { if (this._disabledInputs[ae] === af) { return true } } return false }, _getInst: function(af) { try { return e.data(af, "datepicker") } catch (ae) { throw "Missing instance data for this datepicker" } }, _optionDatepicker: function(ai, ak, af) { var ae, ah, ag, aj, al = this._getInst(ai); if (arguments.length === 2 && typeof ak === "string") { return (ak === "defaults" ? e.extend({}, e.datepicker._defaults) : (al ? (ak === "all" ? e.extend({}, al.settings) : this._get(al, ak)) : null)) } ae = ak || {}; if (typeof ak === "string") { ae = {};
                ae[ak] = af } if (al) { if (this._curInst === al) { this._hideDatepicker() } ah = this._getDateDatepicker(ai, true);
                ag = this._getMinMaxDate(al, "min");
                aj = this._getMinMaxDate(al, "max");
                a(al.settings, ae); if (ag !== null && ae.dateFormat !== undefined && ae.minDate === undefined) { al.settings.minDate = this._formatDate(al, ag) } if (aj !== null && ae.dateFormat !== undefined && ae.maxDate === undefined) { al.settings.maxDate = this._formatDate(al, aj) } if ("disabled" in ae) { if (ae.disabled) { this._disableDatepicker(ai) } else { this._enableDatepicker(ai) } } this._attachments(e(ai), al);
                this._autoSize(al);
                this._setDate(al, ah);
                this._updateAlternate(al);
                this._updateDatepicker(al) } }, _changeDatepicker: function(ae, ag, af) { this._optionDatepicker(ae, ag, af) }, _refreshDatepicker: function(af) { var ae = this._getInst(af); if (ae) { this._updateDatepicker(ae) } }, _setDateDatepicker: function(ae, ag) { var af = this._getInst(ae); if (af) { this._setDate(af, ag);
                this._updateDatepicker(af);
                this._updateAlternate(af) } }, _getDateDatepicker: function(ae, ag) { var af = this._getInst(ae); if (af && !af.inline) { this._setDateFromField(af, ag) } return (af ? this._getDate(af) : null) }, _doKeyDown: function(ai) { var ag, ah, ak, aj = e.datepicker._getInst(ai.target),
                ae = true,
                af = aj.dpDiv.is(".ui-datepicker-rtl");
            aj._keyEvent = true; if (e.datepicker._datepickerShowing) { switch (ai.keyCode) {
                    case 9:
                        e.datepicker._hideDatepicker();
                        ae = false; break;
                    case 13:
                        ak = e("td." + e.datepicker._dayOverClass + ":not(." + e.datepicker._currentClass + ")", aj.dpDiv); if (ak[0]) { e.datepicker._selectDay(ai.target, aj.selectedMonth, aj.selectedYear, ak[0]) } ag = e.datepicker._get(aj, "onSelect"); if (ag) { ah = e.datepicker._formatDate(aj);
                            ag.apply((aj.input ? aj.input[0] : null), [ah, aj]) } else { e.datepicker._hideDatepicker() } return false;
                    case 27:
                        e.datepicker._hideDatepicker(); break;
                    case 33:
                        e.datepicker._adjustDate(ai.target, (ai.ctrlKey ? -e.datepicker._get(aj, "stepBigMonths") : -e.datepicker._get(aj, "stepMonths")), "M"); break;
                    case 34:
                        e.datepicker._adjustDate(ai.target, (ai.ctrlKey ? +e.datepicker._get(aj, "stepBigMonths") : +e.datepicker._get(aj, "stepMonths")), "M"); break;
                    case 35:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._clearDate(ai.target) } ae = ai.ctrlKey || ai.metaKey; break;
                    case 36:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._gotoToday(ai.target) } ae = ai.ctrlKey || ai.metaKey; break;
                    case 37:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._adjustDate(ai.target, (af ? +1 : -1), "D") } ae = ai.ctrlKey || ai.metaKey; if (ai.originalEvent.altKey) { e.datepicker._adjustDate(ai.target, (ai.ctrlKey ? -e.datepicker._get(aj, "stepBigMonths") : -e.datepicker._get(aj, "stepMonths")), "M") } break;
                    case 38:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._adjustDate(ai.target, -7, "D") } ae = ai.ctrlKey || ai.metaKey; break;
                    case 39:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._adjustDate(ai.target, (af ? -1 : +1), "D") } ae = ai.ctrlKey || ai.metaKey; if (ai.originalEvent.altKey) { e.datepicker._adjustDate(ai.target, (ai.ctrlKey ? +e.datepicker._get(aj, "stepBigMonths") : +e.datepicker._get(aj, "stepMonths")), "M") } break;
                    case 40:
                        if (ai.ctrlKey || ai.metaKey) { e.datepicker._adjustDate(ai.target, +7, "D") } ae = ai.ctrlKey || ai.metaKey; break;
                    default:
                        ae = false } } else { if (ai.keyCode === 36 && ai.ctrlKey) { e.datepicker._showDatepicker(this) } else { ae = false } } if (ae) { ai.preventDefault();
                ai.stopPropagation() } }, _doKeyPress: function(af) { var ae, ah, ag = e.datepicker._getInst(af.target); if (e.datepicker._get(ag, "constrainInput")) { ae = e.datepicker._possibleChars(e.datepicker._get(ag, "dateFormat"));
                ah = String.fromCharCode(af.charCode == null ? af.keyCode : af.charCode); return af.ctrlKey || af.metaKey || (ah < " " || !ae || ae.indexOf(ah) > -1) } }, _doKeyUp: function(af) { var ah, ag = e.datepicker._getInst(af.target); if (ag.input.val() !== ag.lastVal) { try { ah = e.datepicker.parseDate(e.datepicker._get(ag, "dateFormat"), (ag.input ? ag.input.val() : null), e.datepicker._getFormatConfig(ag)); if (ah) { e.datepicker._setDateFromField(ag);
                        e.datepicker._updateAlternate(ag);
                        e.datepicker._updateDatepicker(ag) } } catch (ae) {} } return true }, _showDatepicker: function(ag) { ag = ag.target || ag; if (ag.nodeName.toLowerCase() !== "input") { ag = e("input", ag.parentNode)[0] } if (e.datepicker._isDisabledDatepicker(ag) || e.datepicker._lastInput === ag) { return } var ak, ae, al, ah, aj, af, ai;
            ak = e.datepicker._getInst(ag); if (e.datepicker._curInst && e.datepicker._curInst !== ak) { e.datepicker._curInst.dpDiv.stop(true, true); if (ak && e.datepicker._datepickerShowing) { e.datepicker._hideDatepicker(e.datepicker._curInst.input[0]) } } ae = e.datepicker._get(ak, "beforeShow");
            al = ae ? ae.apply(ag, [ag, ak]) : {}; if (al === false) { return } a(ak.settings, al);
            ak.lastVal = null;
            e.datepicker._lastInput = ag;
            e.datepicker._setDateFromField(ak); if (e.datepicker._inDialog) { ag.value = "" } if (!e.datepicker._pos) { e.datepicker._pos = e.datepicker._findPos(ag);
                e.datepicker._pos[1] += ag.offsetHeight } ah = false;
            e(ag).parents().each(function() { ah |= e(this).css("position") === "fixed"; return !ah });
            aj = { left: e.datepicker._pos[0], top: e.datepicker._pos[1] };
            e.datepicker._pos = null;
            ak.dpDiv.empty();
            ak.dpDiv.css({ position: "absolute", display: "block", top: "-1000px" });
            e.datepicker._updateDatepicker(ak);
            aj = e.datepicker._checkOffset(ak, aj, ah);
            ak.dpDiv.css({ position: (e.datepicker._inDialog && e.blockUI ? "static" : (ah ? "fixed" : "absolute")), display: "none", left: aj.left + "px", top: aj.top + "px" }); if (!ak.inline) { af = e.datepicker._get(ak, "showAnim");
                ai = e.datepicker._get(ak, "duration");
                ak.dpDiv.css("z-index", s(e(ag)) + 1);
                e.datepicker._datepickerShowing = true; if (e.effects && e.effects.effect[af]) { ak.dpDiv.show(af, e.datepicker._get(ak, "showOptions"), ai) } else { ak.dpDiv[af || "show"](af ? ai : null) } if (e.datepicker._shouldFocusInput(ak)) { ak.input.focus() } e.datepicker._curInst = ak } }, _updateDatepicker: function(aj) { this.maxRows = 4;
            B = aj;
            aj.dpDiv.empty().append(this._generateHTML(aj));
            this._attachHandlers(aj); var af, ag = this._getNumberOfMonths(aj),
                ai = ag[1],
                ae = 17,
                ah = aj.dpDiv.find("." + this._dayOverClass + " a"); if (ah.length > 0) { c.apply(ah.get(0)) } aj.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""); if (ai > 1) { aj.dpDiv.addClass("ui-datepicker-multi-" + ai).css("width", (ae * ai) + "em") } aj.dpDiv[(ag[0] !== 1 || ag[1] !== 1 ? "add" : "remove") + "Class"]("ui-datepicker-multi");
            aj.dpDiv[(this._get(aj, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"); if (aj === e.datepicker._curInst && e.datepicker._datepickerShowing && e.datepicker._shouldFocusInput(aj)) { aj.input.focus() } if (aj.yearshtml) { af = aj.yearshtml;
                setTimeout(function() { if (af === aj.yearshtml && aj.yearshtml) { aj.dpDiv.find("select.ui-datepicker-year:first").replaceWith(aj.yearshtml) } af = aj.yearshtml = null }, 0) } }, _shouldFocusInput: function(ae) { return ae.input && ae.input.is(":visible") && !ae.input.is(":disabled") && !ae.input.is(":focus") }, _checkOffset: function(am, al, ak) { var af = am.dpDiv.outerWidth(),
                ae = am.dpDiv.outerHeight(),
                ai = am.input ? am.input.outerWidth() : 0,
                aj = am.input ? am.input.outerHeight() : 0,
                ah = document.documentElement.clientWidth + (ak ? 0 : e(document).scrollLeft()),
                ag = document.documentElement.clientHeight + (ak ? 0 : e(document).scrollTop());
            al.left -= (this._get(am, "isRTL") ? (af - ai) : 0);
            al.left -= (ak && al.left === am.input.offset().left) ? e(document).scrollLeft() : 0;
            al.top -= (ak && al.top === (am.input.offset().top + aj)) ? e(document).scrollTop() : 0;
            al.left -= Math.min(al.left, (al.left + af > ah && ah > af) ? Math.abs(al.left + af - ah) : 0);
            al.top -= Math.min(al.top, (al.top + ae > ag && ag > ae) ? Math.abs(ae + aj) : 0); return al }, _findPos: function(ah) { var ae, af = this._getInst(ah),
                ag = this._get(af, "isRTL"); while (ah && (ah.type === "hidden" || ah.nodeType !== 1 || e.expr.filters.hidden(ah))) { ah = ah[ag ? "previousSibling" : "nextSibling"] } ae = e(ah).offset(); return [ae.left, ae.top] }, _hideDatepicker: function(ag) { var ae, af, ah, ai, aj = this._curInst; if (!aj || (ag && aj !== e.data(ag, "datepicker"))) { return } if (this._datepickerShowing) { ae = this._get(aj, "showAnim");
                af = this._get(aj, "duration");
                ah = function() { e.datepicker._tidyDialog(aj) }; if (e.effects && (e.effects.effect[ae] || e.effects[ae])) { aj.dpDiv.hide(ae, e.datepicker._get(aj, "showOptions"), af, ah) } else { aj.dpDiv[(ae === "slideDown" ? "slideUp" : (ae === "fadeIn" ? "fadeOut" : "hide"))]((ae ? af : null), ah) } if (!ae) { ah() } this._datepickerShowing = false;
                ai = this._get(aj, "onClose"); if (ai) { ai.apply((aj.input ? aj.input[0] : null), [(aj.input ? aj.input.val() : ""), aj]) } this._lastInput = null; if (this._inDialog) { this._dialogInput.css({ position: "absolute", left: "0", top: "-100px" }); if (e.blockUI) { e.unblockUI();
                        e("body").append(this.dpDiv) } } this._inDialog = false } }, _tidyDialog: function(ae) { ae.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar") }, _checkExternalClick: function(ae) { if (!e.datepicker._curInst) { return } var af = e(ae.target),
                ag = e.datepicker._getInst(af[0]); if (((af[0].id !== e.datepicker._mainDivId && af.parents("#" + e.datepicker._mainDivId).length === 0 && !af.hasClass(e.datepicker.markerClassName) && !af.closest("." + e.datepicker._triggerClass).length && e.datepicker._datepickerShowing && !(e.datepicker._inDialog && e.blockUI))) || (af.hasClass(e.datepicker.markerClassName) && e.datepicker._curInst !== ag)) { e.datepicker._hideDatepicker() } }, _adjustDate: function(af, ai, ag) { var ae = e(af),
                ah = this._getInst(ae[0]); if (this._isDisabledDatepicker(ae[0])) { return } this._adjustInstDate(ah, ai + (ag === "M" ? this._get(ah, "showCurrentAtPos") : 0), ag);
            this._updateDatepicker(ah) }, _gotoToday: function(af) { var ah, ae = e(af),
                ag = this._getInst(ae[0]); if (this._get(ag, "gotoCurrent") && ag.currentDay) { ag.selectedDay = ag.currentDay;
                ag.drawMonth = ag.selectedMonth = ag.currentMonth;
                ag.drawYear = ag.selectedYear = ag.currentYear } else { ah = new Date();
                ag.selectedDay = ah.getDate();
                ag.drawMonth = ag.selectedMonth = ah.getMonth();
                ag.drawYear = ag.selectedYear = ah.getFullYear() } this._notifyChange(ag);
            this._adjustDate(ae) }, _selectMonthYear: function(af, ah, ag) { var ae = e(af),
                ai = this._getInst(ae[0]);
            ai["selected" + (ag === "M" ? "Month" : "Year")] = ai["draw" + (ag === "M" ? "Month" : "Year")] = parseInt(ah.options[ah.selectedIndex].value, 10);
            this._notifyChange(ai);
            this._adjustDate(ae) }, _selectDay: function(ag, ae, ah, af) { var aj, ai = e(ag); if (e(af).hasClass(this._unselectableClass) || this._isDisabledDatepicker(ai[0])) { return } aj = this._getInst(ai[0]);
            aj.selectedDay = aj.currentDay = e("a", af).html();
            aj.selectedMonth = aj.currentMonth = ae;
            aj.selectedYear = aj.currentYear = ah;
            this._selectDate(ag, this._formatDate(aj, aj.currentDay, aj.currentMonth, aj.currentYear)) }, _clearDate: function(ae) { var af = e(ae);
            this._selectDate(af, "") }, _selectDate: function(af, ai) { var ag, ae = e(af),
                ah = this._getInst(ae[0]);
            ai = (ai != null ? ai : this._formatDate(ah)); if (ah.input) { ah.input.val(ai) } this._updateAlternate(ah);
            ag = this._get(ah, "onSelect"); if (ag) { ag.apply((ah.input ? ah.input[0] : null), [ai, ah]) } else { if (ah.input) { ah.input.trigger("change") } } if (ah.inline) { this._updateDatepicker(ah) } else { this._hideDatepicker();
                this._lastInput = ah.input[0]; if (typeof(ah.input[0]) !== "object") { ah.input.focus() } this._lastInput = null } }, _updateAlternate: function(af) { var ah, ai, ag, ae = this._get(af, "altField"); if (ae) { ah = this._get(af, "altFormat") || this._get(af, "dateFormat");
                ai = this._getDate(af);
                ag = this.formatDate(ah, ai, this._getFormatConfig(af));
                e(ae).each(function() { e(this).val(ag) }) } }, noWeekends: function(ae) { var af = ae.getDay(); return [(af > 0 && af < 6), ""] }, iso8601Week: function(ag) { var ae, af = new Date(ag.getTime());
            af.setDate(af.getDate() + 4 - (af.getDay() || 7));
            ae = af.getTime();
            af.setMonth(0);
            af.setDate(1); return Math.floor(Math.round((ae - af) / 86400000) / 7) + 1 }, parseDate: function(ae, ap, af) { if (ae == null || ap == null) { throw "Invalid arguments" } ap = (typeof ap === "object" ? ap.toString() : ap + ""); if (ap === "") { return null } var ah, aj, ag, ax = 0,
                ak = (af ? af.shortYearCutoff : null) || this._defaults.shortYearCutoff,
                aq = (typeof ak !== "string" ? ak : new Date().getFullYear() % 100 + parseInt(ak, 10)),
                az = (af ? af.dayNamesShort : null) || this._defaults.dayNamesShort,
                aB = (af ? af.dayNames : null) || this._defaults.dayNames,
                aw = (af ? af.monthNamesShort : null) || this._defaults.monthNamesShort,
                av = (af ? af.monthNames : null) || this._defaults.monthNames,
                au = -1,
                an = -1,
                ar = -1,
                al = -1,
                ao = false,
                ay, am = function(aD) { var aC = (ah + 1 < ae.length && ae.charAt(ah + 1) === aD); if (aC) { ah++ } return aC },
                at = function(aD) { var aG = am(aD),
                        aC = (aD === "@" ? 14 : (aD === "!" ? 20 : (aD === "y" && aG ? 4 : (aD === "o" ? 3 : 2)))),
                        aE = (aD === "y" ? aC : 1),
                        aF = new RegExp("^\\d{" + aE + "," + aC + "}"),
                        aH = ap.substring(ax).match(aF); if (!aH) { throw "Missing number at position " + ax } ax += aH[0].length; return parseInt(aH[0], 10) },
                ai = function(aG, aE, aD) { var aF = -1,
                        aC = e.map(am(aG) ? aD : aE, function(aI, aH) { return [
                                [aH, aI]
                            ] }).sort(function(aH, aI) { return -(aH[1].length - aI[1].length) });
                    e.each(aC, function(aH, aI) { var aJ = aI[1]; if (ap.substr(ax, aJ.length).toLowerCase() === aJ.toLowerCase()) { aF = aI[0];
                            ax += aJ.length; return false } }); if (aF !== -1) { return aF + 1 } else { throw "Unknown name at position " + ax } },
                aA = function() { if (ap.charAt(ax) !== ae.charAt(ah)) { throw "Unexpected literal at position " + ax } ax++ }; for (ah = 0; ah < ae.length; ah++) { if (ao) { if (ae.charAt(ah) === "'" && !am("'")) { ao = false } else { aA() } } else { switch (ae.charAt(ah)) {
                        case "d":
                            ar = at("d"); break;
                        case "D":
                            ai("D", az, aB); break;
                        case "o":
                            al = at("o"); break;
                        case "m":
                            an = at("m"); break;
                        case "M":
                            an = ai("M", aw, av); break;
                        case "y":
                            au = at("y"); break;
                        case "@":
                            ay = new Date(at("@"));
                            au = ay.getFullYear();
                            an = ay.getMonth() + 1;
                            ar = ay.getDate(); break;
                        case "!":
                            ay = new Date((at("!") - this._ticksTo1970) / 10000);
                            au = ay.getFullYear();
                            an = ay.getMonth() + 1;
                            ar = ay.getDate(); break;
                        case "'":
                            if (am("'")) { aA() } else { ao = true } break;
                        default:
                            aA() } } } if (ax < ap.length) { ag = ap.substr(ax); if (!/^\s+/.test(ag)) { throw "Extra/unparsed characters found in date: " + ag } } if (au === -1) { au = new Date().getFullYear() } else { if (au < 100) { au += new Date().getFullYear() - new Date().getFullYear() % 100 + (au <= aq ? 0 : -100) } } if (al > -1) { an = 1;
                ar = al;
                do { aj = this._getDaysInMonth(au, an - 1); if (ar <= aj) { break } an++;
                    ar -= aj } while (true) } ay = this._daylightSavingAdjust(new Date(au, an - 1, ar)); if (ay.getFullYear() !== au || ay.getMonth() + 1 !== an || ay.getDate() !== ar) { throw "Invalid date" } return ay }, ATOM: "yy-mm-dd", COOKIE: "D, dd M yy", ISO_8601: "yy-mm-dd", RFC_822: "D, d M y", RFC_850: "DD, dd-M-y", RFC_1036: "D, d M y", RFC_1123: "D, d M yy", RFC_2822: "D, d M yy", RSS: "D, d M y", TICKS: "!", TIMESTAMP: "@", W3C: "yy-mm-dd", _ticksTo1970: (((1970 - 1) * 365 + Math.floor(1970 / 4) - Math.floor(1970 / 100) + Math.floor(1970 / 400)) * 24 * 60 * 60 * 10000000), formatDate: function(ae, ao, al) { if (!ao) { return "" } var af, ap = (al ? al.dayNamesShort : null) || this._defaults.dayNamesShort,
                aq = (al ? al.dayNames : null) || this._defaults.dayNames,
                an = (al ? al.monthNamesShort : null) || this._defaults.monthNamesShort,
                ag = (al ? al.monthNames : null) || this._defaults.monthNames,
                ah = function(at) { var ar = (af + 1 < ae.length && ae.charAt(af + 1) === at); if (ar) { af++ } return ar },
                aj = function(av, ar, au) { var at = "" + ar; if (ah(av)) { while (at.length < au) { at = "0" + at } } return at },
                am = function(av, ar, au, at) { return (ah(av) ? at[ar] : au[ar]) },
                ai = "",
                ak = false; if (ao) { for (af = 0; af < ae.length; af++) { if (ak) { if (ae.charAt(af) === "'" && !ah("'")) { ak = false } else { ai += ae.charAt(af) } } else { switch (ae.charAt(af)) {
                            case "d":
                                ai += aj("d", ao.getDate(), 2); break;
                            case "D":
                                ai += am("D", ao.getDay(), ap, aq); break;
                            case "o":
                                ai += aj("o", Math.round((new Date(ao.getFullYear(), ao.getMonth(), ao.getDate()).getTime() - new Date(ao.getFullYear(), 0, 0).getTime()) / 86400000), 3); break;
                            case "m":
                                ai += aj("m", ao.getMonth() + 1, 2); break;
                            case "M":
                                ai += am("M", ao.getMonth(), an, ag); break;
                            case "y":
                                ai += (ah("y") ? ao.getFullYear() : (ao.getYear() % 100 < 10 ? "0" : "") + ao.getYear() % 100); break;
                            case "@":
                                ai += ao.getTime(); break;
                            case "!":
                                ai += ao.getTime() * 10000 + this._ticksTo1970; break;
                            case "'":
                                if (ah("'")) { ai += "'" } else { ak = true } break;
                            default:
                                ai += ae.charAt(af) } } } } return ai }, _possibleChars: function(af) { var ag, ae = "",
                ah = false,
                ai = function(ak) { var aj = (ag + 1 < af.length && af.charAt(ag + 1) === ak); if (aj) { ag++ } return aj }; for (ag = 0; ag < af.length; ag++) { if (ah) { if (af.charAt(ag) === "'" && !ai("'")) { ah = false } else { ae += af.charAt(ag) } } else { switch (af.charAt(ag)) {
                        case "d":
                        case "m":
                        case "y":
                        case "@":
                            ae += "0123456789"; break;
                        case "D":
                        case "M":
                            return null;
                        case "'":
                            if (ai("'")) { ae += "'" } else { ah = true } break;
                        default:
                            ae += af.charAt(ag) } } } return ae }, _get: function(ae, af) { return ae.settings[af] !== undefined ? ae.settings[af] : this._defaults[af] }, _setDateFromField: function(al, ak) { if (al.input.val() === al.lastVal) { return } var ai = this._get(al, "dateFormat"),
                ag = al.lastVal = al.input ? al.input.val() : null,
                ah = this._getDefaultDate(al),
                af = ah,
                ae = this._getFormatConfig(al); try { af = this.parseDate(ai, ag, ae) || ah } catch (aj) { ag = (ak ? "" : ag) } al.selectedDay = af.getDate();
            al.drawMonth = al.selectedMonth = af.getMonth();
            al.drawYear = al.selectedYear = af.getFullYear();
            al.currentDay = (ag ? af.getDate() : 0);
            al.currentMonth = (ag ? af.getMonth() : 0);
            al.currentYear = (ag ? af.getFullYear() : 0);
            this._adjustInstDate(al) }, _getDefaultDate: function(ae) { return this._restrictMinMax(ae, this._determineDate(ae, this._get(ae, "defaultDate"), new Date())) }, _determineDate: function(aj, af, ag) { var ai = function(al) { var ak = new Date();
                    ak.setDate(ak.getDate() + al); return ak },
                ah = function(ap) { try { return e.datepicker.parseDate(e.datepicker._get(aj, "dateFormat"), ap, e.datepicker._getFormatConfig(aj)) } catch (aq) {} var an = (ap.toLowerCase().match(/^c/) ? e.datepicker._getDate(aj) : null) || new Date(),
                        ao = an.getFullYear(),
                        al = an.getMonth(),
                        am = an.getDate(),
                        ak = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,
                        ar = ak.exec(ap); while (ar) { switch (ar[2] || "d") {
                            case "d":
                            case "D":
                                am += parseInt(ar[1], 10); break;
                            case "w":
                            case "W":
                                am += parseInt(ar[1], 10) * 7; break;
                            case "m":
                            case "M":
                                al += parseInt(ar[1], 10);
                                am = Math.min(am, e.datepicker._getDaysInMonth(ao, al)); break;
                            case "y":
                            case "Y":
                                ao += parseInt(ar[1], 10);
                                am = Math.min(am, e.datepicker._getDaysInMonth(ao, al)); break } ar = ak.exec(ap) } return new Date(ao, al, am) },
                ae = (af == null || af === "" ? ag : (typeof af === "string" ? ah(af) : (typeof af === "number" ? (isNaN(af) ? ag : ai(af)) : new Date(af.getTime()))));
            ae = (ae && ae.toString() === "Invalid Date" ? ag : ae); if (ae) { ae.setHours(0);
                ae.setMinutes(0);
                ae.setSeconds(0);
                ae.setMilliseconds(0) } return this._daylightSavingAdjust(ae) }, _daylightSavingAdjust: function(ae) { if (!ae) { return null } ae.setHours(ae.getHours() > 12 ? ae.getHours() + 2 : 0); return ae }, _setDate: function(ak, ag, aj) { var ae = !ag,
                ah = ak.selectedMonth,
                ai = ak.selectedYear,
                af = this._restrictMinMax(ak, this._determineDate(ak, ag, new Date()));
            ak.selectedDay = ak.currentDay = af.getDate();
            ak.drawMonth = ak.selectedMonth = ak.currentMonth = af.getMonth();
            ak.drawYear = ak.selectedYear = ak.currentYear = af.getFullYear(); if ((ah !== ak.selectedMonth || ai !== ak.selectedYear) && !aj) { this._notifyChange(ak) } this._adjustInstDate(ak); if (ak.input) { ak.input.val(ae ? "" : this._formatDate(ak)) } }, _getDate: function(ae) { var af = (!ae.currentYear || (ae.input && ae.input.val() === "") ? null : this._daylightSavingAdjust(new Date(ae.currentYear, ae.currentMonth, ae.currentDay))); return af }, _attachHandlers: function(ag) { var af = this._get(ag, "stepMonths"),
                ae = "#" + ag.id.replace(/\\\\/g, "\\");
            ag.dpDiv.find("[data-handler]").map(function() { var ah = { prev: function() { e.datepicker._adjustDate(ae, -af, "M") }, next: function() { e.datepicker._adjustDate(ae, +af, "M") }, hide: function() { e.datepicker._hideDatepicker() }, today: function() { e.datepicker._gotoToday(ae) }, selectDay: function() { e.datepicker._selectDay(ae, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this); return false }, selectMonth: function() { e.datepicker._selectMonthYear(ae, this, "M"); return false }, selectYear: function() { e.datepicker._selectMonthYear(ae, this, "Y"); return false } };
                e(this).bind(this.getAttribute("data-event"), ah[this.getAttribute("data-handler")]) }) }, _generateHTML: function(aw) { var aL, aY, aV, aO, aC, a1, aT, aR, aA, aX, aI, am, aQ, ax, ak, at, al, aM, aF, a7, af, aZ, a4, a2, aN, ay, ai, aD, aB, av, a6, ao, aq, aE, ah, a0, ag, an, aj, ap = new Date(),
                aS = this._daylightSavingAdjust(new Date(ap.getFullYear(), ap.getMonth(), ap.getDate())),
                aK = this._get(aw, "isRTL"),
                ae = this._get(aw, "showButtonPanel"),
                aJ = this._get(aw, "hideIfNoPrevNext"),
                aG = this._get(aw, "navigationAsDateFormat"),
                aW = this._getNumberOfMonths(aw),
                ar = this._get(aw, "showCurrentAtPos"),
                aH = this._get(aw, "stepMonths"),
                az = (aW[0] !== 1 || aW[1] !== 1),
                aP = this._daylightSavingAdjust((!aw.currentDay ? new Date(9999, 9, 9) : new Date(aw.currentYear, aw.currentMonth, aw.currentDay))),
                a5 = this._getMinMaxDate(aw, "min"),
                a3 = this._getMinMaxDate(aw, "max"),
                au = aw.drawMonth - ar,
                aU = aw.drawYear; if (au < 0) { au += 12;
                aU-- } if (a3) { aL = this._daylightSavingAdjust(new Date(a3.getFullYear(), a3.getMonth() - (aW[0] * aW[1]) + 1, a3.getDate()));
                aL = (a5 && aL < a5 ? a5 : aL); while (this._daylightSavingAdjust(new Date(aU, au, 1)) > aL) { au--; if (au < 0) { au = 11;
                        aU-- } } } aw.drawMonth = au;
            aw.drawYear = aU;
            aY = this._get(aw, "prevText");
            aY = (!aG ? aY : this.formatDate(aY, this._daylightSavingAdjust(new Date(aU, au - aH, 1)), this._getFormatConfig(aw)));
            aV = (this._canAdjustMonth(aw, -1, aU, au) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + aY + "'><span class='ui-icon ui-icon-circle-triangle-" + (aK ? "e" : "w") + "'>" + aY + "</span></a>" : (aJ ? "" : "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + aY + "'><span class='ui-icon ui-icon-circle-triangle-" + (aK ? "e" : "w") + "'>" + aY + "</span></a>"));
            aO = this._get(aw, "nextText");
            aO = (!aG ? aO : this.formatDate(aO, this._daylightSavingAdjust(new Date(aU, au + aH, 1)), this._getFormatConfig(aw)));
            aC = (this._canAdjustMonth(aw, +1, aU, au) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + aO + "'><span class='ui-icon ui-icon-circle-triangle-" + (aK ? "w" : "e") + "'>" + aO + "</span></a>" : (aJ ? "" : "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + aO + "'><span class='ui-icon ui-icon-circle-triangle-" + (aK ? "w" : "e") + "'>" + aO + "</span></a>"));
            a1 = this._get(aw, "currentText");
            aT = (this._get(aw, "gotoCurrent") && aw.currentDay ? aP : aS);
            a1 = (!aG ? a1 : this.formatDate(a1, aT, this._getFormatConfig(aw)));
            aR = (!aw.inline ? "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(aw, "closeText") + "</button>" : "");
            aA = (ae) ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (aK ? aR : "") + (this._isInRange(aw, aT) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + a1 + "</button>" : "") + (aK ? "" : aR) + "</div>" : "";
            aX = parseInt(this._get(aw, "firstDay"), 10);
            aX = (isNaN(aX) ? 0 : aX);
            aI = this._get(aw, "showWeek");
            am = this._get(aw, "dayNames");
            aQ = this._get(aw, "dayNamesMin");
            ax = this._get(aw, "monthNames");
            ak = this._get(aw, "monthNamesShort");
            at = this._get(aw, "beforeShowDay");
            al = this._get(aw, "showOtherMonths");
            aM = this._get(aw, "selectOtherMonths");
            aF = this._getDefaultDate(aw);
            a7 = "";
            af; for (aZ = 0; aZ < aW[0]; aZ++) { a4 = "";
                this.maxRows = 4; for (a2 = 0; a2 < aW[1]; a2++) { aN = this._daylightSavingAdjust(new Date(aU, au, aw.selectedDay));
                    ay = " ui-corner-all";
                    ai = ""; if (az) { ai += "<div class='ui-datepicker-group"; if (aW[1] > 1) { switch (a2) {
                                case 0:
                                    ai += " ui-datepicker-group-first";
                                    ay = " ui-corner-" + (aK ? "right" : "left"); break;
                                case aW[1] - 1:
                                    ai += " ui-datepicker-group-last";
                                    ay = " ui-corner-" + (aK ? "left" : "right"); break;
                                default:
                                    ai += " ui-datepicker-group-middle";
                                    ay = ""; break } } ai += "'>" } ai += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + ay + "'>" + (/all|left/.test(ay) && aZ === 0 ? (aK ? aC : aV) : "") + (/all|right/.test(ay) && aZ === 0 ? (aK ? aV : aC) : "") + this._generateMonthYearHeader(aw, au, aU, a5, a3, aZ > 0 || a2 > 0, ax, ak) + "</div><table class='ui-datepicker-calendar'><thead><tr>";
                    aD = (aI ? "<th class='ui-datepicker-week-col'>" + this._get(aw, "weekHeader") + "</th>" : ""); for (af = 0; af < 7; af++) { aB = (af + aX) % 7;
                        aD += "<th scope='col'" + ((af + aX + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'" : "") + "><span title='" + am[aB] + "'>" + aQ[aB] + "</span></th>" } ai += aD + "</tr></thead><tbody>";
                    av = this._getDaysInMonth(aU, au); if (aU === aw.selectedYear && au === aw.selectedMonth) { aw.selectedDay = Math.min(aw.selectedDay, av) } a6 = (this._getFirstDayOfMonth(aU, au) - aX + 7) % 7;
                    ao = Math.ceil((a6 + av) / 7);
                    aq = (az ? this.maxRows > ao ? this.maxRows : ao : ao);
                    this.maxRows = aq;
                    aE = this._daylightSavingAdjust(new Date(aU, au, 1 - a6)); for (ah = 0; ah < aq; ah++) { ai += "<tr>";
                        a0 = (!aI ? "" : "<td class='ui-datepicker-week-col'>" + this._get(aw, "calculateWeek")(aE) + "</td>"); for (af = 0; af < 7; af++) { ag = (at ? at.apply((aw.input ? aw.input[0] : null), [aE]) : [true, ""]);
                            an = (aE.getMonth() !== au);
                            aj = (an && !aM) || !ag[0] || (a5 && aE < a5) || (a3 && aE > a3);
                            a0 += "<td class='" + ((af + aX + 6) % 7 >= 5 ? " ui-datepicker-week-end" : "") + (an ? " ui-datepicker-other-month" : "") + ((aE.getTime() === aN.getTime() && au === aw.selectedMonth && aw._keyEvent) || (aF.getTime() === aE.getTime() && aF.getTime() === aN.getTime()) ? " " + this._dayOverClass : "") + (aj ? " " + this._unselectableClass + " ui-state-disabled" : "") + (an && !al ? "" : " " + ag[1] + (aE.getTime() === aP.getTime() ? " " + this._currentClass : "") + (aE.getTime() === aS.getTime() ? " ui-datepicker-today" : "")) + "'" + ((!an || al) && ag[2] ? " title='" + ag[2].replace(/'/g, "&#39;") + "'" : "") + (aj ? "" : " data-handler='selectDay' data-event='click' data-month='" + aE.getMonth() + "' data-year='" + aE.getFullYear() + "'") + ">" + (an && !al ? "&#xa0;" : (aj ? "<span class='ui-state-default'>" + aE.getDate() + "</span>" : "<a class='ui-state-default" + (aE.getTime() === aS.getTime() ? " ui-state-highlight" : "") + (aE.getTime() === aP.getTime() ? " ui-state-active" : "") + (an ? " ui-priority-secondary" : "") + "' href='#'>" + aE.getDate() + "</a>")) + "</td>";
                            aE.setDate(aE.getDate() + 1);
                            aE = this._daylightSavingAdjust(aE) } ai += a0 + "</tr>" } au++; if (au > 11) { au = 0;
                        aU++ } ai += "</tbody></table>" + (az ? "</div>" + ((aW[0] > 0 && a2 === aW[1] - 1) ? "<div class='ui-datepicker-row-break'></div>" : "") : "");
                    a4 += ai } a7 += a4 } a7 += aA;
            aw._keyEvent = false; return a7 }, _generateMonthYearHeader: function(ax, ay, ai, at, aw, ap, aq, ar) { var az, ao, ae, an, av, ak, ag, af, au = this._get(ax, "changeMonth"),
                al = this._get(ax, "changeYear"),
                am = this._get(ax, "showMonthAfterYear"),
                ah = "<div class='ui-datepicker-title'>",
                aj = ""; if (ap || !au) { aj += "<span class='ui-datepicker-month'>" + aq[ay] + "</span>" } else { az = (at && at.getFullYear() === ai);
                ao = (aw && aw.getFullYear() === ai);
                aj += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>"; for (ae = 0; ae < 12; ae++) { if ((!az || ae >= at.getMonth()) && (!ao || ae <= aw.getMonth())) { aj += "<option value='" + ae + "'" + (ae === ay ? " selected='selected'" : "") + ">" + ar[ae] + "</option>" } } aj += "</select>" } if (!am) { ah += aj + (ap || !(au && al) ? "&#xa0;" : "") } if (!ax.yearshtml) { ax.yearshtml = ""; if (ap || !al) { ah += "<span class='ui-datepicker-year'>" + ai + "</span>" } else { an = this._get(ax, "yearRange").split(":");
                    av = new Date().getFullYear();
                    ak = function(aB) { var aA = (aB.match(/c[+\-].*/) ? ai + parseInt(aB.substring(1), 10) : (aB.match(/[+\-].*/) ? av + parseInt(aB, 10) : parseInt(aB, 10))); return (isNaN(aA) ? av : aA) };
                    ag = ak(an[0]);
                    af = Math.max(ag, ak(an[1] || ""));
                    ag = (at ? Math.max(ag, at.getFullYear()) : ag);
                    af = (aw ? Math.min(af, aw.getFullYear()) : af);
                    ax.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; for (; ag <= af; ag++) { ax.yearshtml += "<option value='" + ag + "'" + (ag === ai ? " selected='selected'" : "") + ">" + ag + "</option>" } ax.yearshtml += "</select>";
                    ah += ax.yearshtml;
                    ax.yearshtml = null } } ah += this._get(ax, "yearSuffix"); if (am) { ah += (ap || !(au && al) ? "&#xa0;" : "") + aj } ah += "</div>"; return ah }, _adjustInstDate: function(ak, aj, ah) { var ai = ak.drawYear + (ah === "Y" ? aj : 0),
                ae = ak.drawMonth + (ah === "M" ? aj : 0),
                af = Math.min(ak.selectedDay, this._getDaysInMonth(ai, ae)) + (ah === "D" ? aj : 0),
                ag = this._restrictMinMax(ak, this._daylightSavingAdjust(new Date(ai, ae, af)));
            ak.selectedDay = ag.getDate();
            ak.drawMonth = ak.selectedMonth = ag.getMonth();
            ak.drawYear = ak.selectedYear = ag.getFullYear(); if (ah === "M" || ah === "Y") { this._notifyChange(ak) } }, _restrictMinMax: function(ah, ai) { var ae = this._getMinMaxDate(ah, "min"),
                af = this._getMinMaxDate(ah, "max"),
                ag = (ae && ai < ae ? ae : ai); return (af && ag > af ? af : ag) }, _notifyChange: function(ae) { var af = this._get(ae, "onChangeMonthYear"); if (af) { af.apply((ae.input ? ae.input[0] : null), [ae.selectedYear, ae.selectedMonth + 1, ae]) } }, _getNumberOfMonths: function(ae) { var af = this._get(ae, "numberOfMonths"); return (af == null ? [1, 1] : (typeof af === "number" ? [1, af] : af)) }, _getMinMaxDate: function(ae, af) { return this._determineDate(ae, this._get(ae, af + "Date"), null) }, _getDaysInMonth: function(af, ae) { return 32 - this._daylightSavingAdjust(new Date(af, ae, 32)).getDate() }, _getFirstDayOfMonth: function(af, ae) { return new Date(af, ae, 1).getDay() }, _canAdjustMonth: function(ai, ah, ae, aj) { var ag = this._getNumberOfMonths(ai),
                af = this._daylightSavingAdjust(new Date(ae, aj + (ah < 0 ? ah : ag[0] * ag[1]), 1)); if (ah < 0) { af.setDate(this._getDaysInMonth(af.getFullYear(), af.getMonth())) } return this._isInRange(ai, af) }, _isInRange: function(am, ai) { var ah, ag, af = this._getMinMaxDate(am, "min"),
                ak = this._getMinMaxDate(am, "max"),
                aj = null,
                al = null,
                ae = this._get(am, "yearRange"); if (ae) { ah = ae.split(":");
                ag = new Date().getFullYear();
                aj = parseInt(ah[0], 10);
                al = parseInt(ah[1], 10); if (ah[0].match(/[+\-].*/)) { aj += ag } if (ah[1].match(/[+\-].*/)) { al += ag } } return ((!af || ai.getTime() >= af.getTime()) && (!ak || ai.getTime() <= ak.getTime()) && (!aj || ai.getFullYear() >= aj) && (!al || ai.getFullYear() <= al)) }, _getFormatConfig: function(ae) { var af = this._get(ae, "shortYearCutoff");
            af = (typeof af !== "string" ? af : new Date().getFullYear() % 100 + parseInt(af, 10)); return { shortYearCutoff: af, dayNamesShort: this._get(ae, "dayNamesShort"), dayNames: this._get(ae, "dayNames"), monthNamesShort: this._get(ae, "monthNamesShort"), monthNames: this._get(ae, "monthNames") } }, _formatDate: function(ag, ae, ah, af) { if (!ae) { ag.currentDay = ag.selectedDay;
                ag.currentMonth = ag.selectedMonth;
                ag.currentYear = ag.selectedYear } var ai = (ae ? (typeof ae === "object" ? ae : this._daylightSavingAdjust(new Date(af, ah, ae))) : this._daylightSavingAdjust(new Date(ag.currentYear, ag.currentMonth, ag.currentDay))); return this.formatDate(this._get(ag, "dateFormat"), ai, this._getFormatConfig(ag)) } });

    function I(ae) { var af = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a"; return ae.delegate(af, "mouseout", function() { e(this).removeClass("ui-state-hover"); if (this.className.indexOf("ui-datepicker-prev") !== -1) { e(this).removeClass("ui-datepicker-prev-hover") } if (this.className.indexOf("ui-datepicker-next") !== -1) { e(this).removeClass("ui-datepicker-next-hover") } }).delegate(af, "mouseover", c) }

    function c() { if (!e.datepicker._isDisabledDatepicker(B.inline ? B.dpDiv.parent()[0] : B.input[0])) { e(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover");
            e(this).addClass("ui-state-hover"); if (this.className.indexOf("ui-datepicker-prev") !== -1) { e(this).addClass("ui-datepicker-prev-hover") } if (this.className.indexOf("ui-datepicker-next") !== -1) { e(this).addClass("ui-datepicker-next-hover") } } }

    function a(ae, ag) { e.extend(ae, ag); for (var af in ag) { if (ag[af] == null) { ae[af] = ag[af] } } return ae } e.fn.datepicker = function(af) { if (!this.length) { return this } if (!e.datepicker.initialized) { e(document).mousedown(e.datepicker._checkExternalClick);
            e.datepicker.initialized = true } if (e("#" + e.datepicker._mainDivId).length === 0) { e("body").append(e.datepicker.dpDiv) } var ae = Array.prototype.slice.call(arguments, 1); if (typeof af === "string" && (af === "isDisabled" || af === "getDate" || af === "widget")) { return e.datepicker["_" + af + "Datepicker"].apply(e.datepicker, [this[0]].concat(ae)) } if (af === "option" && arguments.length === 2 && typeof arguments[1] === "string") { return e.datepicker["_" + af + "Datepicker"].apply(e.datepicker, [this[0]].concat(ae)) } return this.each(function() { typeof af === "string" ? e.datepicker["_" + af + "Datepicker"].apply(e.datepicker, [this].concat(ae)) : e.datepicker._attachDatepicker(this, af) }) };
    e.datepicker = new y();
    e.datepicker.initialized = false;
    e.datepicker.uuid = new Date().getTime();
    e.datepicker.version = "1.11.2"; var g = e.datepicker;
    e.widget("ui.draggable", e.ui.mouse, { version: "1.11.2", widgetEventPrefix: "drag", options: { addClasses: true, appendTo: "parent", axis: false, connectToSortable: false, containment: false, cursor: "auto", cursorAt: false, grid: false, handle: false, helper: "original", iframeFix: false, opacity: false, refreshPositions: false, revert: false, revertDuration: 500, scope: "default", scroll: true, scrollSensitivity: 20, scrollSpeed: 20, snap: false, snapMode: "both", snapTolerance: 20, stack: false, zIndex: false, drag: null, start: null, stop: null }, _create: function() { if (this.options.helper === "original") { this._setPositionRelative() } if (this.options.addClasses) { this.element.addClass("ui-draggable") } if (this.options.disabled) { this.element.addClass("ui-draggable-disabled") } this._setHandleClassName();
            this._mouseInit() }, _setOption: function(ae, af) { this._super(ae, af); if (ae === "handle") { this._removeHandleClassName();
                this._setHandleClassName() } }, _destroy: function() { if ((this.helper || this.element).is(".ui-draggable-dragging")) { this.destroyOnClear = true; return } this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled");
            this._removeHandleClassName();
            this._mouseDestroy() }, _mouseCapture: function(ae) { var af = this.options;
            this._blurActiveElement(ae); if (this.helper || af.disabled || e(ae.target).closest(".ui-resizable-handle").length > 0) { return false } this.handle = this._getHandle(ae); if (!this.handle) { return false } this._blockFrames(af.iframeFix === true ? "iframe" : af.iframeFix); return true }, _blockFrames: function(ae) { this.iframeBlocks = this.document.find(ae).map(function() { var af = e(this); return e("<div>").css("position", "absolute").appendTo(af.parent()).outerWidth(af.outerWidth()).outerHeight(af.outerHeight()).offset(af.offset())[0] }) }, _unblockFrames: function() { if (this.iframeBlocks) { this.iframeBlocks.remove();
                delete this.iframeBlocks } }, _blurActiveElement: function(af) { var ag = this.document[0]; if (!this.handleElement.is(af.target)) { return } try { if (ag.activeElement && ag.activeElement.nodeName.toLowerCase() !== "body") { e(ag.activeElement).blur() } } catch (ae) {} }, _mouseStart: function(ae) { var af = this.options;
            this.helper = this._createHelper(ae);
            this.helper.addClass("ui-draggable-dragging");
            this._cacheHelperProportions(); if (e.ui.ddmanager) { e.ui.ddmanager.current = this } this._cacheMargins();
            this.cssPosition = this.helper.css("position");
            this.scrollParent = this.helper.scrollParent(true);
            this.offsetParent = this.helper.offsetParent();
            this.hasFixedAncestor = this.helper.parents().filter(function() { return e(this).css("position") === "fixed" }).length > 0;
            this.positionAbs = this.element.offset();
            this._refreshOffsets(ae);
            this.originalPosition = this.position = this._generatePosition(ae, false);
            this.originalPageX = ae.pageX;
            this.originalPageY = ae.pageY;
            (af.cursorAt && this._adjustOffsetFromHelper(af.cursorAt));
            this._setContainment(); if (this._trigger("start", ae) === false) { this._clear(); return false } this._cacheHelperProportions(); if (e.ui.ddmanager && !af.dropBehaviour) { e.ui.ddmanager.prepareOffsets(this, ae) } this._normalizeRightBottom();
            this._mouseDrag(ae, true); if (e.ui.ddmanager) { e.ui.ddmanager.dragStart(this, ae) } return true }, _refreshOffsets: function(ae) { this.offset = { top: this.positionAbs.top - this.margins.top, left: this.positionAbs.left - this.margins.left, scroll: false, parent: this._getParentOffset(), relative: this._getRelativeOffset() };
            this.offset.click = { left: ae.pageX - this.offset.left, top: ae.pageY - this.offset.top } }, _mouseDrag: function(af, ag) { if (this.hasFixedAncestor) { this.offset.parent = this._getParentOffset() } this.position = this._generatePosition(af, true);
            this.positionAbs = this._convertPositionTo("absolute"); if (!ag) { var ae = this._uiHash(); if (this._trigger("drag", af, ae) === false) { this._mouseUp({}); return false } this.position = ae.position } this.helper[0].style.left = this.position.left + "px";
            this.helper[0].style.top = this.position.top + "px"; if (e.ui.ddmanager) { e.ui.ddmanager.drag(this, af) } return false }, _mouseStop: function(af) { var ae = this,
                ag = false; if (e.ui.ddmanager && !this.options.dropBehaviour) { ag = e.ui.ddmanager.drop(this, af) } if (this.dropped) { ag = this.dropped;
                this.dropped = false } if ((this.options.revert === "invalid" && !ag) || (this.options.revert === "valid" && ag) || this.options.revert === true || (e.isFunction(this.options.revert) && this.options.revert.call(this.element, ag))) { e(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() { if (ae._trigger("stop", af) !== false) { ae._clear() } }) } else { if (this._trigger("stop", af) !== false) { this._clear() } } return false }, _mouseUp: function(ae) { this._unblockFrames(); if (e.ui.ddmanager) { e.ui.ddmanager.dragStop(this, ae) } if (this.handleElement.is(ae.target)) { this.element.focus() } return e.ui.mouse.prototype._mouseUp.call(this, ae) }, cancel: function() { if (this.helper.is(".ui-draggable-dragging")) { this._mouseUp({}) } else { this._clear() } return this }, _getHandle: function(ae) { return this.options.handle ? !!e(ae.target).closest(this.element.find(this.options.handle)).length : true }, _setHandleClassName: function() { this.handleElement = this.options.handle ? this.element.find(this.options.handle) : this.element;
            this.handleElement.addClass("ui-draggable-handle") }, _removeHandleClassName: function() { this.handleElement.removeClass("ui-draggable-handle") }, _createHelper: function(af) { var ae = this.options,
                ag = e.isFunction(ae.helper),
                ah = ag ? e(ae.helper.apply(this.element[0], [af])) : (ae.helper === "clone" ? this.element.clone().removeAttr("id") : this.element); if (!ah.parents("body").length) { ah.appendTo((ae.appendTo === "parent" ? this.element[0].parentNode : ae.appendTo)) } if (ag && ah[0] === this.element[0]) { this._setPositionRelative() } if (ah[0] !== this.element[0] && !(/(fixed|absolute)/).test(ah.css("position"))) { ah.css("position", "absolute") } return ah }, _setPositionRelative: function() { if (!(/^(?:r|a|f)/).test(this.element.css("position"))) { this.element[0].style.position = "relative" } }, _adjustOffsetFromHelper: function(ae) { if (typeof ae === "string") { ae = ae.split(" ") } if (e.isArray(ae)) { ae = { left: +ae[0], top: +ae[1] || 0 } } if ("left" in ae) { this.offset.click.left = ae.left + this.margins.left } if ("right" in ae) { this.offset.click.left = this.helperProportions.width - ae.right + this.margins.left } if ("top" in ae) { this.offset.click.top = ae.top + this.margins.top } if ("bottom" in ae) { this.offset.click.top = this.helperProportions.height - ae.bottom + this.margins.top } }, _isRootNode: function(ae) { return (/(html|body)/i).test(ae.tagName) || ae === this.document[0] }, _getParentOffset: function() { var af = this.offsetParent.offset(),
                ae = this.document[0]; if (this.cssPosition === "absolute" && this.scrollParent[0] !== ae && e.contains(this.scrollParent[0], this.offsetParent[0])) { af.left += this.scrollParent.scrollLeft();
                af.top += this.scrollParent.scrollTop() } if (this._isRootNode(this.offsetParent[0])) { af = { top: 0, left: 0 } } return { top: af.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: af.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) } }, _getRelativeOffset: function() { if (this.cssPosition !== "relative") { return { top: 0, left: 0 } } var ae = this.element.position(),
                af = this._isRootNode(this.scrollParent[0]); return { top: ae.top - (parseInt(this.helper.css("top"), 10) || 0) + (!af ? this.scrollParent.scrollTop() : 0), left: ae.left - (parseInt(this.helper.css("left"), 10) || 0) + (!af ? this.scrollParent.scrollLeft() : 0) } }, _cacheMargins: function() { this.margins = { left: (parseInt(this.element.css("marginLeft"), 10) || 0), top: (parseInt(this.element.css("marginTop"), 10) || 0), right: (parseInt(this.element.css("marginRight"), 10) || 0), bottom: (parseInt(this.element.css("marginBottom"), 10) || 0) } }, _cacheHelperProportions: function() { this.helperProportions = { width: this.helper.outerWidth(), height: this.helper.outerHeight() } }, _setContainment: function() { var ag, ah, ai, ae = this.options,
                af = this.document[0];
            this.relativeContainer = null; if (!ae.containment) { this.containment = null; return } if (ae.containment === "window") { this.containment = [e(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, e(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, e(window).scrollLeft() + e(window).width() - this.helperProportions.width - this.margins.left, e(window).scrollTop() + (e(window).height() || af.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]; return } if (ae.containment === "document") { this.containment = [0, 0, e(af).width() - this.helperProportions.width - this.margins.left, (e(af).height() || af.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]; return } if (ae.containment.constructor === Array) { this.containment = ae.containment; return } if (ae.containment === "parent") { ae.containment = this.helper[0].parentNode } ah = e(ae.containment);
            ai = ah[0]; if (!ai) { return } ag = /(scroll|auto)/.test(ah.css("overflow"));
            this.containment = [(parseInt(ah.css("borderLeftWidth"), 10) || 0) + (parseInt(ah.css("paddingLeft"), 10) || 0), (parseInt(ah.css("borderTopWidth"), 10) || 0) + (parseInt(ah.css("paddingTop"), 10) || 0), (ag ? Math.max(ai.scrollWidth, ai.offsetWidth) : ai.offsetWidth) - (parseInt(ah.css("borderRightWidth"), 10) || 0) - (parseInt(ah.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (ag ? Math.max(ai.scrollHeight, ai.offsetHeight) : ai.offsetHeight) - (parseInt(ah.css("borderBottomWidth"), 10) || 0) - (parseInt(ah.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom];
            this.relativeContainer = ah }, _convertPositionTo: function(ah, ae) { if (!ae) { ae = this.position } var ag = ah === "absolute" ? 1 : -1,
                af = this._isRootNode(this.scrollParent[0]); return { top: (ae.top + this.offset.relative.top * ag + this.offset.parent.top * ag - ((this.cssPosition === "fixed" ? -this.offset.scroll.top : (af ? 0 : this.offset.scroll.top)) * ag)), left: (ae.left + this.offset.relative.left * ag + this.offset.parent.left * ag - ((this.cssPosition === "fixed" ? -this.offset.scroll.left : (af ? 0 : this.offset.scroll.left)) * ag)) } }, _generatePosition: function(ak, an) { var ae, aj, al, ai, ah = this.options,
                am = this._isRootNode(this.scrollParent[0]),
                af = ak.pageX,
                ag = ak.pageY; if (!am || !this.offset.scroll) { this.offset.scroll = { top: this.scrollParent.scrollTop(), left: this.scrollParent.scrollLeft() } } if (an) { if (this.containment) { if (this.relativeContainer) { aj = this.relativeContainer.offset();
                        ae = [this.containment[0] + aj.left, this.containment[1] + aj.top, this.containment[2] + aj.left, this.containment[3] + aj.top] } else { ae = this.containment } if (ak.pageX - this.offset.click.left < ae[0]) { af = ae[0] + this.offset.click.left } if (ak.pageY - this.offset.click.top < ae[1]) { ag = ae[1] + this.offset.click.top } if (ak.pageX - this.offset.click.left > ae[2]) { af = ae[2] + this.offset.click.left } if (ak.pageY - this.offset.click.top > ae[3]) { ag = ae[3] + this.offset.click.top } } if (ah.grid) { al = ah.grid[1] ? this.originalPageY + Math.round((ag - this.originalPageY) / ah.grid[1]) * ah.grid[1] : this.originalPageY;
                    ag = ae ? ((al - this.offset.click.top >= ae[1] || al - this.offset.click.top > ae[3]) ? al : ((al - this.offset.click.top >= ae[1]) ? al - ah.grid[1] : al + ah.grid[1])) : al;
                    ai = ah.grid[0] ? this.originalPageX + Math.round((af - this.originalPageX) / ah.grid[0]) * ah.grid[0] : this.originalPageX;
                    af = ae ? ((ai - this.offset.click.left >= ae[0] || ai - this.offset.click.left > ae[2]) ? ai : ((ai - this.offset.click.left >= ae[0]) ? ai - ah.grid[0] : ai + ah.grid[0])) : ai } if (ah.axis === "y") { af = this.originalPageX } if (ah.axis === "x") { ag = this.originalPageY } } return { top: (ag - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + (this.cssPosition === "fixed" ? -this.offset.scroll.top : (am ? 0 : this.offset.scroll.top))), left: (af - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + (this.cssPosition === "fixed" ? -this.offset.scroll.left : (am ? 0 : this.offset.scroll.left))) } }, _clear: function() { this.helper.removeClass("ui-draggable-dragging"); if (this.helper[0] !== this.element[0] && !this.cancelHelperRemoval) { this.helper.remove() } this.helper = null;
            this.cancelHelperRemoval = false; if (this.destroyOnClear) { this.destroy() } }, _normalizeRightBottom: function() { if (this.options.axis !== "y" && this.helper.css("right") !== "auto") { this.helper.width(this.helper.width());
                this.helper.css("right", "auto") } if (this.options.axis !== "x" && this.helper.css("bottom") !== "auto") { this.helper.height(this.helper.height());
                this.helper.css("bottom", "auto") } }, _trigger: function(af, ag, ae) { ae = ae || this._uiHash();
            e.ui.plugin.call(this, af, [ag, ae, this], true); if (/^(drag|start|stop)/.test(af)) { this.positionAbs = this._convertPositionTo("absolute");
                ae.offset = this.positionAbs } return e.Widget.prototype._trigger.call(this, af, ag, ae) }, plugins: {}, _uiHash: function() { return { helper: this.helper, position: this.position, originalPosition: this.originalPosition, offset: this.positionAbs } } });
    e.ui.plugin.add("draggable", "connectToSortable", { start: function(ah, af, ae) { var ag = e.extend({}, af, { item: ae.element });
            ae.sortables = [];
            e(ae.options.connectToSortable).each(function() { var ai = e(this).sortable("instance"); if (ai && !ai.options.disabled) { ae.sortables.push(ai);
                    ai.refreshPositions();
                    ai._trigger("activate", ah, ag) } }) }, stop: function(ah, af, ae) { var ag = e.extend({}, af, { item: ae.element });
            ae.cancelHelperRemoval = false;
            e.each(ae.sortables, function() { var ai = this; if (ai.isOver) { ai.isOver = 0;
                    ae.cancelHelperRemoval = true;
                    ai.cancelHelperRemoval = false;
                    ai._storedCSS = { position: ai.placeholder.css("position"), top: ai.placeholder.css("top"), left: ai.placeholder.css("left") };
                    ai._mouseStop(ah);
                    ai.options.helper = ai.options._helper } else { ai.cancelHelperRemoval = true;
                    ai._trigger("deactivate", ah, ag) } }) }, drag: function(ag, af, ae) { e.each(ae.sortables, function() { var ah = false,
                    ai = this;
                ai.positionAbs = ae.positionAbs;
                ai.helperProportions = ae.helperProportions;
                ai.offset.click = ae.offset.click; if (ai._intersectsWith(ai.containerCache)) { ah = true;
                    e.each(ae.sortables, function() { this.positionAbs = ae.positionAbs;
                        this.helperProportions = ae.helperProportions;
                        this.offset.click = ae.offset.click; if (this !== ai && this._intersectsWith(this.containerCache) && e.contains(ai.element[0], this.element[0])) { ah = false } return ah }) } if (ah) { if (!ai.isOver) { ai.isOver = 1;
                        ai.currentItem = af.helper.appendTo(ai.element).data("ui-sortable-item", true);
                        ai.options._helper = ai.options.helper;
                        ai.options.helper = function() { return af.helper[0] };
                        ag.target = ai.currentItem[0];
                        ai._mouseCapture(ag, true);
                        ai._mouseStart(ag, true, true);
                        ai.offset.click.top = ae.offset.click.top;
                        ai.offset.click.left = ae.offset.click.left;
                        ai.offset.parent.left -= ae.offset.parent.left - ai.offset.parent.left;
                        ai.offset.parent.top -= ae.offset.parent.top - ai.offset.parent.top;
                        ae._trigger("toSortable", ag);
                        ae.dropped = ai.element;
                        e.each(ae.sortables, function() { this.refreshPositions() });
                        ae.currentItem = ae.element;
                        ai.fromOutside = ae } if (ai.currentItem) { ai._mouseDrag(ag);
                        af.position = ai.position } } else { if (ai.isOver) { ai.isOver = 0;
                        ai.cancelHelperRemoval = true;
                        ai.options._revert = ai.options.revert;
                        ai.options.revert = false;
                        ai._trigger("out", ag, ai._uiHash(ai));
                        ai._mouseStop(ag, true);
                        ai.options.revert = ai.options._revert;
                        ai.options.helper = ai.options._helper; if (ai.placeholder) { ai.placeholder.remove() } ae._refreshOffsets(ag);
                        af.position = ae._generatePosition(ag, true);
                        ae._trigger("fromSortable", ag);
                        ae.dropped = false;
                        e.each(ae.sortables, function() { this.refreshPositions() }) } } }) } });
    e.ui.plugin.add("draggable", "cursor", { start: function(ah, af, ai) { var ag = e("body"),
                ae = ai.options; if (ag.css("cursor")) { ae._cursor = ag.css("cursor") } ag.css("cursor", ae.cursor) }, stop: function(ag, af, ah) { var ae = ah.options; if (ae._cursor) { e("body").css("cursor", ae._cursor) } } });
    e.ui.plugin.add("draggable", "opacity", { start: function(ah, af, ai) { var ag = e(af.helper),
                ae = ai.options; if (ag.css("opacity")) { ae._opacity = ag.css("opacity") } ag.css("opacity", ae.opacity) }, stop: function(ag, af, ah) { var ae = ah.options; if (ae._opacity) { e(af.helper).css("opacity", ae._opacity) } } });
    e.ui.plugin.add("draggable", "scroll", { start: function(ag, ae, af) { if (!af.scrollParentNotHidden) { af.scrollParentNotHidden = af.helper.scrollParent(false) } if (af.scrollParentNotHidden[0] !== af.document[0] && af.scrollParentNotHidden[0].tagName !== "HTML") { af.overflowOffset = af.scrollParentNotHidden.offset() } }, drag: function(ai, ah, ae) { var ag = ae.options,
                af = false,
                aj = ae.scrollParentNotHidden[0],
                ak = ae.document[0]; if (aj !== ak && aj.tagName !== "HTML") { if (!ag.axis || ag.axis !== "x") { if ((ae.overflowOffset.top + aj.offsetHeight) - ai.pageY < ag.scrollSensitivity) { aj.scrollTop = af = aj.scrollTop + ag.scrollSpeed } else { if (ai.pageY - ae.overflowOffset.top < ag.scrollSensitivity) { aj.scrollTop = af = aj.scrollTop - ag.scrollSpeed } } } if (!ag.axis || ag.axis !== "y") { if ((ae.overflowOffset.left + aj.offsetWidth) - ai.pageX < ag.scrollSensitivity) { aj.scrollLeft = af = aj.scrollLeft + ag.scrollSpeed } else { if (ai.pageX - ae.overflowOffset.left < ag.scrollSensitivity) { aj.scrollLeft = af = aj.scrollLeft - ag.scrollSpeed } } } } else { if (!ag.axis || ag.axis !== "x") { if (ai.pageY - e(ak).scrollTop() < ag.scrollSensitivity) { af = e(ak).scrollTop(e(ak).scrollTop() - ag.scrollSpeed) } else { if (e(window).height() - (ai.pageY - e(ak).scrollTop()) < ag.scrollSensitivity) { af = e(ak).scrollTop(e(ak).scrollTop() + ag.scrollSpeed) } } } if (!ag.axis || ag.axis !== "y") { if (ai.pageX - e(ak).scrollLeft() < ag.scrollSensitivity) { af = e(ak).scrollLeft(e(ak).scrollLeft() - ag.scrollSpeed) } else { if (e(window).width() - (ai.pageX - e(ak).scrollLeft()) < ag.scrollSensitivity) { af = e(ak).scrollLeft(e(ak).scrollLeft() + ag.scrollSpeed) } } } } if (af !== false && e.ui.ddmanager && !ag.dropBehaviour) { e.ui.ddmanager.prepareOffsets(ae, ai) } } });
    e.ui.plugin.add("draggable", "snap", { start: function(ah, af, ag) { var ae = ag.options;
            ag.snapElements = [];
            e(ae.snap.constructor !== String ? (ae.snap.items || ":data(ui-draggable)") : ae.snap).each(function() { var aj = e(this),
                    ai = aj.offset(); if (this !== ag.element[0]) { ag.snapElements.push({ item: this, width: aj.outerWidth(), height: aj.outerHeight(), top: ai.top, left: ai.left }) } }) }, drag: function(am, ax, aw) { var ak, av, aq, af, ap, ai, aj, at, an, au, ar = aw.options,
                ao = ar.snapTolerance,
                ag = ax.offset.left,
                ae = ag + aw.helperProportions.width,
                ah = ax.offset.top,
                al = ah + aw.helperProportions.height; for (an = aw.snapElements.length - 1; an >= 0; an--) { ap = aw.snapElements[an].left - aw.margins.left;
                ai = ap + aw.snapElements[an].width;
                aj = aw.snapElements[an].top - aw.margins.top;
                at = aj + aw.snapElements[an].height; if (ae < ap - ao || ag > ai + ao || al < aj - ao || ah > at + ao || !e.contains(aw.snapElements[an].item.ownerDocument, aw.snapElements[an].item)) { if (aw.snapElements[an].snapping) {
                        (aw.options.snap.release && aw.options.snap.release.call(aw.element, am, e.extend(aw._uiHash(), { snapItem: aw.snapElements[an].item }))) } aw.snapElements[an].snapping = false; continue } if (ar.snapMode !== "inner") { ak = Math.abs(aj - al) <= ao;
                    av = Math.abs(at - ah) <= ao;
                    aq = Math.abs(ap - ae) <= ao;
                    af = Math.abs(ai - ag) <= ao; if (ak) { ax.position.top = aw._convertPositionTo("relative", { top: aj - aw.helperProportions.height, left: 0 }).top } if (av) { ax.position.top = aw._convertPositionTo("relative", { top: at, left: 0 }).top } if (aq) { ax.position.left = aw._convertPositionTo("relative", { top: 0, left: ap - aw.helperProportions.width }).left } if (af) { ax.position.left = aw._convertPositionTo("relative", { top: 0, left: ai }).left } } au = (ak || av || aq || af); if (ar.snapMode !== "outer") { ak = Math.abs(aj - ah) <= ao;
                    av = Math.abs(at - al) <= ao;
                    aq = Math.abs(ap - ag) <= ao;
                    af = Math.abs(ai - ae) <= ao; if (ak) { ax.position.top = aw._convertPositionTo("relative", { top: aj, left: 0 }).top } if (av) { ax.position.top = aw._convertPositionTo("relative", { top: at - aw.helperProportions.height, left: 0 }).top } if (aq) { ax.position.left = aw._convertPositionTo("relative", { top: 0, left: ap }).left } if (af) { ax.position.left = aw._convertPositionTo("relative", { top: 0, left: ai - aw.helperProportions.width }).left } } if (!aw.snapElements[an].snapping && (ak || av || aq || af || au)) {
                    (aw.options.snap.snap && aw.options.snap.snap.call(aw.element, am, e.extend(aw._uiHash(), { snapItem: aw.snapElements[an].item }))) } aw.snapElements[an].snapping = (ak || av || aq || af || au) } } });
    e.ui.plugin.add("draggable", "stack", { start: function(ai, ah, ag) { var aj, af = ag.options,
                ae = e.makeArray(e(af.stack)).sort(function(ak, al) { return (parseInt(e(ak).css("zIndex"), 10) || 0) - (parseInt(e(al).css("zIndex"), 10) || 0) }); if (!ae.length) { return } aj = parseInt(e(ae[0]).css("zIndex"), 10) || 0;
            e(ae).each(function(ak) { e(this).css("zIndex", aj + ak) });
            this.css("zIndex", (aj + ae.length)) } });
    e.ui.plugin.add("draggable", "zIndex", { start: function(ah, af, ai) { var ag = e(af.helper),
                ae = ai.options; if (ag.css("zIndex")) { ae._zIndex = ag.css("zIndex") } ag.css("zIndex", ae.zIndex) }, stop: function(ag, af, ah) { var ae = ah.options; if (ae._zIndex) { e(af.helper).css("zIndex", ae._zIndex) } } }); var E = e.ui.draggable;
    e.widget("ui.resizable", e.ui.mouse, { version: "1.11.2", widgetEventPrefix: "resize", options: { alsoResize: false, animate: false, animateDuration: "slow", animateEasing: "swing", aspectRatio: false, autoHide: false, containment: false, ghost: false, grid: false, handles: "e,s,se", helper: false, maxHeight: null, maxWidth: null, minHeight: 10, minWidth: 10, zIndex: 90, resize: null, start: null, stop: null }, _num: function(ae) { return parseInt(ae, 10) || 0 }, _isNumber: function(ae) { return !isNaN(parseInt(ae, 10)) }, _hasScroll: function(ag, af) { if (e(ag).css("overflow") === "hidden") { return false } var ae = (af && af === "left") ? "scrollLeft" : "scrollTop",
                ah = false; if (ag[ae] > 0) { return true } ag[ae] = 1;
            ah = (ag[ae] > 0);
            ag[ae] = 0; return ah }, _create: function() { var ah, ae, ag, af, ak, aj = this,
                ai = this.options;
            this.element.addClass("ui-resizable");
            e.extend(this, { _aspectRatio: !!(ai.aspectRatio), aspectRatio: ai.aspectRatio, originalElement: this.element, _proportionallyResizeElements: [], _helper: ai.helper || ai.ghost || ai.animate ? ai.helper || "ui-resizable-helper" : null }); if (this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)) { this.element.wrap(e("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({ position: this.element.css("position"), width: this.element.outerWidth(), height: this.element.outerHeight(), top: this.element.css("top"), left: this.element.css("left") }));
                this.element = this.element.parent().data("ui-resizable", this.element.resizable("instance"));
                this.elementIsWrapper = true;
                this.element.css({ marginLeft: this.originalElement.css("marginLeft"), marginTop: this.originalElement.css("marginTop"), marginRight: this.originalElement.css("marginRight"), marginBottom: this.originalElement.css("marginBottom") });
                this.originalElement.css({ marginLeft: 0, marginTop: 0, marginRight: 0, marginBottom: 0 });
                this.originalResizeStyle = this.originalElement.css("resize");
                this.originalElement.css("resize", "none");
                this._proportionallyResizeElements.push(this.originalElement.css({ position: "static", zoom: 1, display: "block" }));
                this.originalElement.css({ margin: this.originalElement.css("margin") });
                this._proportionallyResize() } this.handles = ai.handles || (!e(".ui-resizable-handle", this.element).length ? "e,s,se" : { n: ".ui-resizable-n", e: ".ui-resizable-e", s: ".ui-resizable-s", w: ".ui-resizable-w", se: ".ui-resizable-se", sw: ".ui-resizable-sw", ne: ".ui-resizable-ne", nw: ".ui-resizable-nw" }); if (this.handles.constructor === String) { if (this.handles === "all") { this.handles = "n,e,s,w,se,sw,ne,nw" } ah = this.handles.split(",");
                this.handles = {}; for (ae = 0; ae < ah.length; ae++) { ag = e.trim(ah[ae]);
                    ak = "ui-resizable-" + ag;
                    af = e("<div class='ui-resizable-handle " + ak + "'></div>");
                    af.css({ zIndex: ai.zIndex }); if ("se" === ag) { af.addClass("ui-icon ui-icon-gripsmall-diagonal-se") } this.handles[ag] = ".ui-resizable-" + ag;
                    this.element.append(af) } } this._renderAxis = function(al) { var am, an, ap, ao;
                al = al || this.element; for (am in this.handles) { if (this.handles[am].constructor === String) { this.handles[am] = this.element.children(this.handles[am]).first().show() } if (this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i)) { an = e(this.handles[am], this.element);
                        ao = /sw|ne|nw|se|n|s/.test(am) ? an.outerHeight() : an.outerWidth();
                        ap = ["padding", /ne|nw|n/.test(am) ? "Top" : /se|sw|s/.test(am) ? "Bottom" : /^e$/.test(am) ? "Right" : "Left"].join("");
                        al.css(ap, ao);
                        this._proportionallyResize() } if (!e(this.handles[am]).length) { continue } } };
            this._renderAxis(this.element);
            this._handles = e(".ui-resizable-handle", this.element).disableSelection();
            this._handles.mouseover(function() { if (!aj.resizing) { if (this.className) { af = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i) } aj.axis = af && af[1] ? af[1] : "se" } }); if (ai.autoHide) { this._handles.hide();
                e(this.element).addClass("ui-resizable-autohide").mouseenter(function() { if (ai.disabled) { return } e(this).removeClass("ui-resizable-autohide");
                    aj._handles.show() }).mouseleave(function() { if (ai.disabled) { return } if (!aj.resizing) { e(this).addClass("ui-resizable-autohide");
                        aj._handles.hide() } }) } this._mouseInit() }, _destroy: function() { this._mouseDestroy(); var ae, af = function(ag) { e(ag).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove() }; if (this.elementIsWrapper) { af(this.element);
                ae = this.element;
                this.originalElement.css({ position: ae.css("position"), width: ae.outerWidth(), height: ae.outerHeight(), top: ae.css("top"), left: ae.css("left") }).insertAfter(ae);
                ae.remove() } this.originalElement.css("resize", this.originalResizeStyle);
            af(this.originalElement); return this }, _mouseCapture: function(ag) { var af, ae, ah = false; for (af in this.handles) { ae = e(this.handles[af])[0]; if (ae === ag.target || e.contains(ae, ag.target)) { ah = true } } return !this.options.disabled && ah }, _mouseStart: function(ai) { var ag, ah, aj, ae = this.options,
                af = this.element;
            this.resizing = true;
            this._renderProxy();
            ag = this._num(this.helper.css("left"));
            ah = this._num(this.helper.css("top")); if (ae.containment) { ag += e(ae.containment).scrollLeft() || 0;
                ah += e(ae.containment).scrollTop() || 0 } this.offset = this.helper.offset();
            this.position = { left: ag, top: ah };
            this.size = this._helper ? { width: this.helper.width(), height: this.helper.height() } : { width: af.width(), height: af.height() };
            this.originalSize = this._helper ? { width: af.outerWidth(), height: af.outerHeight() } : { width: af.width(), height: af.height() };
            this.sizeDiff = { width: af.outerWidth() - af.width(), height: af.outerHeight() - af.height() };
            this.originalPosition = { left: ag, top: ah };
            this.originalMousePosition = { left: ai.pageX, top: ai.pageY };
            this.aspectRatio = (typeof ae.aspectRatio === "number") ? ae.aspectRatio : ((this.originalSize.width / this.originalSize.height) || 1);
            aj = e(".ui-resizable-" + this.axis).css("cursor");
            e("body").css("cursor", aj === "auto" ? this.axis + "-resize" : aj);
            af.addClass("ui-resizable-resizing");
            this._propagate("start", ai); return true }, _mouseDrag: function(aj) { var ae, ak, ai = this.originalMousePosition,
                al = this.axis,
                ag = (aj.pageX - ai.left) || 0,
                ah = (aj.pageY - ai.top) || 0,
                af = this._change[al];
            this._updatePrevProperties(); if (!af) { return false } ae = af.apply(this, [aj, ag, ah]);
            this._updateVirtualBoundaries(aj.shiftKey); if (this._aspectRatio || aj.shiftKey) { ae = this._updateRatio(ae, aj) } ae = this._respectSize(ae, aj);
            this._updateCache(ae);
            this._propagate("resize", aj);
            ak = this._applyChanges(); if (!this._helper && this._proportionallyResizeElements.length) { this._proportionallyResize() } if (!e.isEmptyObject(ak)) { this._updatePrevProperties();
                this._trigger("resize", aj, this.ui());
                this._applyChanges() } return false }, _mouseStop: function(ak) { this.resizing = false; var am, aj, al, af, ah, ai, an, ag = this.options,
                ae = this; if (this._helper) { am = this._proportionallyResizeElements;
                aj = am.length && (/textarea/i).test(am[0].nodeName);
                al = aj && this._hasScroll(am[0], "left") ? 0 : ae.sizeDiff.height;
                af = aj ? 0 : ae.sizeDiff.width;
                ah = { width: (ae.helper.width() - af), height: (ae.helper.height() - al) };
                ai = (parseInt(ae.element.css("left"), 10) + (ae.position.left - ae.originalPosition.left)) || null;
                an = (parseInt(ae.element.css("top"), 10) + (ae.position.top - ae.originalPosition.top)) || null; if (!ag.animate) { this.element.css(e.extend(ah, { top: an, left: ai })) } ae.helper.height(ae.size.height);
                ae.helper.width(ae.size.width); if (this._helper && !ag.animate) { this._proportionallyResize() } } e("body").css("cursor", "auto");
            this.element.removeClass("ui-resizable-resizing");
            this._propagate("stop", ak); if (this._helper) { this.helper.remove() } return false }, _updatePrevProperties: function() { this.prevPosition = { top: this.position.top, left: this.position.left };
            this.prevSize = { width: this.size.width, height: this.size.height } }, _applyChanges: function() { var ae = {}; if (this.position.top !== this.prevPosition.top) { ae.top = this.position.top + "px" } if (this.position.left !== this.prevPosition.left) { ae.left = this.position.left + "px" } if (this.size.width !== this.prevSize.width) { ae.width = this.size.width + "px" } if (this.size.height !== this.prevSize.height) { ae.height = this.size.height + "px" } this.helper.css(ae); return ae }, _updateVirtualBoundaries: function(af) { var ah, ae, ak, ai, aj, ag = this.options;
            aj = { minWidth: this._isNumber(ag.minWidth) ? ag.minWidth : 0, maxWidth: this._isNumber(ag.maxWidth) ? ag.maxWidth : Infinity, minHeight: this._isNumber(ag.minHeight) ? ag.minHeight : 0, maxHeight: this._isNumber(ag.maxHeight) ? ag.maxHeight : Infinity }; if (this._aspectRatio || af) { ah = aj.minHeight * this.aspectRatio;
                ak = aj.minWidth / this.aspectRatio;
                ae = aj.maxHeight * this.aspectRatio;
                ai = aj.maxWidth / this.aspectRatio; if (ah > aj.minWidth) { aj.minWidth = ah } if (ak > aj.minHeight) { aj.minHeight = ak } if (ae < aj.maxWidth) { aj.maxWidth = ae } if (ai < aj.maxHeight) { aj.maxHeight = ai } } this._vBoundaries = aj }, _updateCache: function(ae) { this.offset = this.helper.offset(); if (this._isNumber(ae.left)) { this.position.left = ae.left } if (this._isNumber(ae.top)) { this.position.top = ae.top } if (this._isNumber(ae.height)) { this.size.height = ae.height } if (this._isNumber(ae.width)) { this.size.width = ae.width } }, _updateRatio: function(ae) { var ag = this.position,
                ah = this.size,
                af = this.axis; if (this._isNumber(ae.height)) { ae.width = (ae.height * this.aspectRatio) } else { if (this._isNumber(ae.width)) { ae.height = (ae.width / this.aspectRatio) } } if (af === "sw") { ae.left = ag.left + (ah.width - ae.width);
                ae.top = null } if (af === "nw") { ae.top = ag.top + (ah.height - ae.height);
                ae.left = ag.left + (ah.width - ae.width) } return ae }, _respectSize: function(aj) { var am = this._vBoundaries,
                an = this.axis,
                ae = this._isNumber(aj.width) && am.maxWidth && (am.maxWidth < aj.width),
                ak = this._isNumber(aj.height) && am.maxHeight && (am.maxHeight < aj.height),
                ao = this._isNumber(aj.width) && am.minWidth && (am.minWidth > aj.width),
                al = this._isNumber(aj.height) && am.minHeight && (am.minHeight > aj.height),
                ah = this.originalPosition.left + this.originalSize.width,
                ai = this.position.top + this.size.height,
                ag = /sw|nw|w/.test(an),
                af = /nw|ne|n/.test(an); if (ao) { aj.width = am.minWidth } if (al) { aj.height = am.minHeight } if (ae) { aj.width = am.maxWidth } if (ak) { aj.height = am.maxHeight } if (ao && ag) { aj.left = ah - am.minWidth } if (ae && ag) { aj.left = ah - am.maxWidth } if (al && af) { aj.top = ai - am.minHeight } if (ak && af) { aj.top = ai - am.maxHeight } if (!aj.width && !aj.height && !aj.left && aj.top) { aj.top = null } else { if (!aj.width && !aj.height && !aj.top && aj.left) { aj.left = null } } return aj }, _getPaddingPlusBorderDimensions: function(ah) { var ae = 0,
                ag = [],
                ai = [ah.css("borderTopWidth"), ah.css("borderRightWidth"), ah.css("borderBottomWidth"), ah.css("borderLeftWidth")],
                af = [ah.css("paddingTop"), ah.css("paddingRight"), ah.css("paddingBottom"), ah.css("paddingLeft")]; for (; ae < 4; ae++) { ag[ae] = (parseInt(ai[ae], 10) || 0);
                ag[ae] += (parseInt(af[ae], 10) || 0) } return { height: ag[0] + ag[2], width: ag[1] + ag[3] } }, _proportionallyResize: function() { if (!this._proportionallyResizeElements.length) { return } var af, ae = 0,
                ag = this.helper || this.element; for (; ae < this._proportionallyResizeElements.length; ae++) { af = this._proportionallyResizeElements[ae]; if (!this.outerDimensions) { this.outerDimensions = this._getPaddingPlusBorderDimensions(af) } af.css({ height: (ag.height() - this.outerDimensions.height) || 0, width: (ag.width() - this.outerDimensions.width) || 0 }) } }, _renderProxy: function() { var ae = this.element,
                af = this.options;
            this.elementOffset = ae.offset(); if (this._helper) { this.helper = this.helper || e("<div style='overflow:hidden;'></div>");
                this.helper.addClass(this._helper).css({ width: this.element.outerWidth() - 1, height: this.element.outerHeight() - 1, position: "absolute", left: this.elementOffset.left + "px", top: this.elementOffset.top + "px", zIndex: ++af.zIndex });
                this.helper.appendTo("body").disableSelection() } else { this.helper = this.element } }, _change: { e: function(af, ae) { return { width: this.originalSize.width + ae } }, w: function(af, ah) { var ae = this.originalSize,
                    ag = this.originalPosition; return { left: ag.left + ah, width: ae.width - ah } }, n: function(ag, ai, ae) { var af = this.originalSize,
                    ah = this.originalPosition; return { top: ah.top + ae, height: af.height - ae } }, s: function(af, ag, ae) { return { height: this.originalSize.height + ae } }, se: function(af, ag, ae) { return e.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [af, ag, ae])) }, sw: function(af, ag, ae) { return e.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [af, ag, ae])) }, ne: function(af, ag, ae) { return e.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [af, ag, ae])) }, nw: function(af, ag, ae) { return e.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [af, ag, ae])) } }, _propagate: function(ae, af) { e.ui.plugin.call(this, ae, [af, this.ui()]);
            (ae !== "resize" && this._trigger(ae, af, this.ui())) }, plugins: {}, ui: function() { return { originalElement: this.originalElement, element: this.element, helper: this.helper, position: this.position, size: this.size, originalSize: this.originalSize, originalPosition: this.originalPosition } } });
    e.ui.plugin.add("resizable", "animate", { stop: function(aj) { var af = e(this).resizable("instance"),
                ag = af.options,
                am = af._proportionallyResizeElements,
                ai = am.length && (/textarea/i).test(am[0].nodeName),
                ak = ai && af._hasScroll(am[0], "left") ? 0 : af.sizeDiff.height,
                al = ai ? 0 : af.sizeDiff.width,
                ae = { width: (af.size.width - al), height: (af.size.height - ak) },
                ah = (parseInt(af.element.css("left"), 10) + (af.position.left - af.originalPosition.left)) || null,
                an = (parseInt(af.element.css("top"), 10) + (af.position.top - af.originalPosition.top)) || null;
            af.element.animate(e.extend(ae, an && ah ? { top: an, left: ah } : {}), { duration: ag.animateDuration, easing: ag.animateEasing, step: function() { var ao = { width: parseInt(af.element.css("width"), 10), height: parseInt(af.element.css("height"), 10), top: parseInt(af.element.css("top"), 10), left: parseInt(af.element.css("left"), 10) }; if (am && am.length) { e(am[0]).css({ width: ao.width, height: ao.height }) } af._updateCache(ao);
                    af._propagate("resize", aj) } }) } });
    e.ui.plugin.add("resizable", "containment", { start: function() { var af, am, ao, aj, ai, ag, ak, an = e(this).resizable("instance"),
                al = an.options,
                ah = an.element,
                ae = al.containment,
                ap = (ae instanceof e) ? ae.get(0) : (/parent/.test(ae)) ? ah.parent().get(0) : ae; if (!ap) { return } an.containerElement = e(ap); if (/document/.test(ae) || ae === document) { an.containerOffset = { left: 0, top: 0 };
                an.containerPosition = { left: 0, top: 0 };
                an.parentData = { element: e(document), left: 0, top: 0, width: e(document).width(), height: e(document).height() || document.body.parentNode.scrollHeight } } else { af = e(ap);
                am = [];
                e(["Top", "Right", "Left", "Bottom"]).each(function(aq, ar) { am[aq] = an._num(af.css("padding" + ar)) });
                an.containerOffset = af.offset();
                an.containerPosition = af.position();
                an.containerSize = { height: (af.innerHeight() - am[3]), width: (af.innerWidth() - am[1]) };
                ao = an.containerOffset;
                aj = an.containerSize.height;
                ai = an.containerSize.width;
                ag = (an._hasScroll(ap, "left") ? ap.scrollWidth : ai);
                ak = (an._hasScroll(ap) ? ap.scrollHeight : aj);
                an.parentData = { element: ap, left: ao.left, top: ao.top, width: ag, height: ak } } }, resize: function(ai) { var ao, aq, aj, ap, ah = e(this).resizable("instance"),
                am = ah.options,
                an = ah.containerOffset,
                ae = ah.position,
                al = ah._aspectRatio || ai.shiftKey,
                ak = { top: 0, left: 0 },
                ag = ah.containerElement,
                af = true; if (ag[0] !== document && (/static/).test(ag.css("position"))) { ak = an } if (ae.left < (ah._helper ? an.left : 0)) { ah.size.width = ah.size.width + (ah._helper ? (ah.position.left - an.left) : (ah.position.left - ak.left)); if (al) { ah.size.height = ah.size.width / ah.aspectRatio;
                    af = false } ah.position.left = am.helper ? an.left : 0 } if (ae.top < (ah._helper ? an.top : 0)) { ah.size.height = ah.size.height + (ah._helper ? (ah.position.top - an.top) : ah.position.top); if (al) { ah.size.width = ah.size.height * ah.aspectRatio;
                    af = false } ah.position.top = ah._helper ? an.top : 0 } aj = ah.containerElement.get(0) === ah.element.parent().get(0);
            ap = /relative|absolute/.test(ah.containerElement.css("position")); if (aj && ap) { ah.offset.left = ah.parentData.left + ah.position.left;
                ah.offset.top = ah.parentData.top + ah.position.top } else { ah.offset.left = ah.element.offset().left;
                ah.offset.top = ah.element.offset().top } ao = Math.abs(ah.sizeDiff.width + (ah._helper ? ah.offset.left - ak.left : (ah.offset.left - an.left)));
            aq = Math.abs(ah.sizeDiff.height + (ah._helper ? ah.offset.top - ak.top : (ah.offset.top - an.top))); if (ao + ah.size.width >= ah.parentData.width) { ah.size.width = ah.parentData.width - ao; if (al) { ah.size.height = ah.size.width / ah.aspectRatio;
                    af = false } } if (aq + ah.size.height >= ah.parentData.height) { ah.size.height = ah.parentData.height - aq; if (al) { ah.size.width = ah.size.height * ah.aspectRatio;
                    af = false } } if (!af) { ah.position.left = ah.prevPosition.left;
                ah.position.top = ah.prevPosition.top;
                ah.size.width = ah.prevSize.width;
                ah.size.height = ah.prevSize.height } }, stop: function() { var aj = e(this).resizable("instance"),
                ag = aj.options,
                ak = aj.containerOffset,
                ai = aj.containerPosition,
                af = aj.containerElement,
                al = e(aj.helper),
                ah = al.offset(),
                am = al.outerWidth() - aj.sizeDiff.width,
                ae = al.outerHeight() - aj.sizeDiff.height; if (aj._helper && !ag.animate && (/relative/).test(af.css("position"))) { e(this).css({ left: ah.left - ai.left - ak.left, width: am, height: ae }) } if (aj._helper && !ag.animate && (/static/).test(af.css("position"))) { e(this).css({ left: ah.left - ai.left - ak.left, width: am, height: ae }) } } });
    e.ui.plugin.add("resizable", "alsoResize", { start: function() { var af = e(this).resizable("instance"),
                ae = af.options,
                ag = function(ah) { e(ah).each(function() { var ai = e(this);
                        ai.data("ui-resizable-alsoresize", { width: parseInt(ai.width(), 10), height: parseInt(ai.height(), 10), left: parseInt(ai.css("left"), 10), top: parseInt(ai.css("top"), 10) }) }) }; if (typeof(ae.alsoResize) === "object" && !ae.alsoResize.parentNode) { if (ae.alsoResize.length) { ae.alsoResize = ae.alsoResize[0];
                    ag(ae.alsoResize) } else { e.each(ae.alsoResize, function(ah) { ag(ah) }) } } else { ag(ae.alsoResize) } }, resize: function(ak, ah) { var aj = e(this).resizable("instance"),
                ae = aj.options,
                ag = aj.originalSize,
                ai = aj.originalPosition,
                al = { height: (aj.size.height - ag.height) || 0, width: (aj.size.width - ag.width) || 0, top: (aj.position.top - ai.top) || 0, left: (aj.position.left - ai.left) || 0 },
                af = function(an, am) { e(an).each(function() { var aq = e(this),
                            ar = e(this).data("ui-resizable-alsoresize"),
                            ao = {},
                            ap = am && am.length ? am : aq.parents(ah.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                        e.each(ap, function(au, at) { var av = (ar[at] || 0) + (al[at] || 0); if (av && av >= 0) { ao[at] = av || null } });
                        aq.css(ao) }) }; if (typeof(ae.alsoResize) === "object" && !ae.alsoResize.nodeType) { e.each(ae.alsoResize, function(an, am) { af(an, am) }) } else { af(ae.alsoResize) } }, stop: function() { e(this).removeData("resizable-alsoresize") } });
    e.ui.plugin.add("resizable", "ghost", { start: function() { var af = e(this).resizable("instance"),
                ae = af.options,
                ag = af.size;
            af.ghost = af.originalElement.clone();
            af.ghost.css({ opacity: 0.25, display: "block", position: "relative", height: ag.height, width: ag.width, margin: 0, left: 0, top: 0 }).addClass("ui-resizable-ghost").addClass(typeof ae.ghost === "string" ? ae.ghost : "");
            af.ghost.appendTo(af.helper) }, resize: function() { var ae = e(this).resizable("instance"); if (ae.ghost) { ae.ghost.css({ position: "relative", height: ae.size.height, width: ae.size.width }) } }, stop: function() { var ae = e(this).resizable("instance"); if (ae.ghost && ae.helper) { ae.helper.get(0).removeChild(ae.ghost.get(0)) } } });
    e.ui.plugin.add("resizable", "grid", { resize: function() { var ap, ai = e(this).resizable("instance"),
                am = ai.options,
                ar = ai.size,
                ao = ai.originalSize,
                aj = ai.originalPosition,
                af = ai.axis,
                aw = typeof am.grid === "number" ? [am.grid, am.grid] : am.grid,
                ag = (aw[0] || 1),
                an = (aw[1] || 1),
                ae = Math.round((ar.width - ao.width) / ag) * ag,
                ah = Math.round((ar.height - ao.height) / an) * an,
                ak = ao.width + ae,
                av = ao.height + ah,
                al = am.maxWidth && (am.maxWidth < ak),
                au = am.maxHeight && (am.maxHeight < av),
                aq = am.minWidth && (am.minWidth > ak),
                at = am.minHeight && (am.minHeight > av);
            am.grid = aw; if (aq) { ak += ag } if (at) { av += an } if (al) { ak -= ag } if (au) { av -= an } if (/^(se|s|e)$/.test(af)) { ai.size.width = ak;
                ai.size.height = av } else { if (/^(ne)$/.test(af)) { ai.size.width = ak;
                    ai.size.height = av;
                    ai.position.top = aj.top - ah } else { if (/^(sw)$/.test(af)) { ai.size.width = ak;
                        ai.size.height = av;
                        ai.position.left = aj.left - ae } else { if (av - an <= 0 || ak - ag <= 0) { ap = ai._getPaddingPlusBorderDimensions(this) } if (av - an > 0) { ai.size.height = av;
                            ai.position.top = aj.top - ah } else { av = an - ap.height;
                            ai.size.height = av;
                            ai.position.top = aj.top + ao.height - av } if (ak - ag > 0) { ai.size.width = ak;
                            ai.position.left = aj.left - ae } else { ak = an - ap.height;
                            ai.size.width = ak;
                            ai.position.left = aj.left + ao.width - ak } } } } } }); var X = e.ui.resizable; var o = e.widget("ui.dialog", { version: "1.11.2", options: { appendTo: "body", autoOpen: true, buttons: [], closeOnEscape: true, closeText: "Close", dialogClass: "", draggable: true, hide: null, height: "auto", maxHeight: null, maxWidth: null, minHeight: 150, minWidth: 150, modal: false, position: { my: "center", at: "center", of: window, collision: "fit", using: function(af) { var ae = e(this).css(af).offset().top; if (ae < 0) { e(this).css("top", af.top - ae) } } }, resizable: true, show: null, title: null, width: 300, beforeClose: null, close: null, drag: null, dragStart: null, dragStop: null, focus: null, open: null, resize: null, resizeStart: null, resizeStop: null }, sizeRelatedOptions: { buttons: true, height: true, maxHeight: true, maxWidth: true, minHeight: true, minWidth: true, width: true }, resizableRelatedOptions: { maxHeight: true, maxWidth: true, minHeight: true, minWidth: true }, _create: function() { this.originalCss = { display: this.element[0].style.display, width: this.element[0].style.width, minHeight: this.element[0].style.minHeight, maxHeight: this.element[0].style.maxHeight, height: this.element[0].style.height };
            this.originalPosition = { parent: this.element.parent(), index: this.element.parent().children().index(this.element) };
            this.originalTitle = this.element.attr("title");
            this.options.title = this.options.title || this.originalTitle;
            this._createWrapper();
            this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog);
            this._createTitlebar();
            this._createButtonPane(); if (this.options.draggable && e.fn.draggable) { this._makeDraggable() } if (this.options.resizable && e.fn.resizable) { this._makeResizable() } this._isOpen = false;
            this._trackFocus() }, _init: function() { if (this.options.autoOpen) { this.open() } }, _appendTo: function() { var ae = this.options.appendTo; if (ae && (ae.jquery || ae.nodeType)) { return e(ae) } return this.document.find(ae || "body").eq(0) }, _destroy: function() { var af, ae = this.originalPosition;
            this._destroyOverlay();
            this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach();
            this.uiDialog.stop(true, true).remove(); if (this.originalTitle) { this.element.attr("title", this.originalTitle) } af = ae.parent.children().eq(ae.index); if (af.length && af[0] !== this.element[0]) { af.before(this.element) } else { ae.parent.append(this.element) } }, widget: function() { return this.uiDialog }, disable: e.noop, enable: e.noop, close: function(ag) { var ah, af = this; if (!this._isOpen || this._trigger("beforeClose", ag) === false) { return } this._isOpen = false;
            this._focusedElement = null;
            this._destroyOverlay();
            this._untrackInstance(); if (!this.opener.filter(":focusable").focus().length) { try { ah = this.document[0].activeElement; if (ah && ah.nodeName.toLowerCase() !== "body") { e(ah).blur() } } catch (ae) {} } this._hide(this.uiDialog, this.options.hide, function() { af._trigger("close", ag) }) }, isOpen: function() { return this._isOpen }, moveToTop: function() { this._moveToTop() }, _moveToTop: function(ah, af) { var ag = false,
                ai = this.uiDialog.siblings(".ui-front:visible").map(function() { return +e(this).css("z-index") }).get(),
                ae = Math.max.apply(null, ai); if (ae >= +this.uiDialog.css("z-index")) { this.uiDialog.css("z-index", ae + 1);
                ag = true } if (ag && !af) { this._trigger("focus", ah) } return ag }, open: function() { var ae = this; if (this._isOpen) { if (this._moveToTop()) { this._focusTabbable() } return } this._isOpen = true;
            this.opener = e(this.document[0].activeElement);
            this._size();
            this._position();
            this._createOverlay();
            this._moveToTop(null, true); if (this.overlay) { this.overlay.css("z-index", this.uiDialog.css("z-index") - 1) } this._show(this.uiDialog, this.options.show, function() { ae._focusTabbable();
                ae._trigger("focus") });
            this._makeFocusTarget();
            this._trigger("open") }, _focusTabbable: function() { var ae = this._focusedElement; if (!ae) { ae = this.element.find("[autofocus]") } if (!ae.length) { ae = this.element.find(":tabbable") } if (!ae.length) { ae = this.uiDialogButtonPane.find(":tabbable") } if (!ae.length) { ae = this.uiDialogTitlebarClose.filter(":tabbable") } if (!ae.length) { ae = this.uiDialog } ae.eq(0).focus() }, _keepFocus: function(af) {
            function ae() { var ah = this.document[0].activeElement,
                    ag = this.uiDialog[0] === ah || e.contains(this.uiDialog[0], ah); if (!ag) { this._focusTabbable() } } af.preventDefault();
            ae.call(this);
            this._delay(ae) }, _createWrapper: function() { this.uiDialog = e("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({ tabIndex: -1, role: "dialog" }).appendTo(this._appendTo());
            this._on(this.uiDialog, { keydown: function(ah) { if (this.options.closeOnEscape && !ah.isDefaultPrevented() && ah.keyCode && ah.keyCode === e.ui.keyCode.ESCAPE) { ah.preventDefault();
                        this.close(ah); return } if (ah.keyCode !== e.ui.keyCode.TAB || ah.isDefaultPrevented()) { return } var af = this.uiDialog.find(":tabbable"),
                        ag = af.filter(":first"),
                        ae = af.filter(":last"); if ((ah.target === ae[0] || ah.target === this.uiDialog[0]) && !ah.shiftKey) { this._delay(function() { ag.focus() });
                        ah.preventDefault() } else { if ((ah.target === ag[0] || ah.target === this.uiDialog[0]) && ah.shiftKey) { this._delay(function() { ae.focus() });
                            ah.preventDefault() } } }, mousedown: function(ae) { if (this._moveToTop(ae)) { this._focusTabbable() } } }); if (!this.element.find("[aria-describedby]").length) { this.uiDialog.attr({ "aria-describedby": this.element.uniqueId().attr("id") }) } }, _createTitlebar: function() { var ae;
            this.uiDialogTitlebar = e("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog);
            this._on(this.uiDialogTitlebar, { mousedown: function(af) { if (!e(af.target).closest(".ui-dialog-titlebar-close")) { this.uiDialog.focus() } } });
            this.uiDialogTitlebarClose = e("<button type='button'></button>").button({ label: this.options.closeText, icons: { primary: "ui-icon-closethick" }, text: false }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar);
            this._on(this.uiDialogTitlebarClose, { click: function(af) { af.preventDefault();
                    this.close(af) } });
            ae = e("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar);
            this._title(ae);
            this.uiDialog.attr({ "aria-labelledby": ae.attr("id") }) }, _title: function(ae) { if (!this.options.title) { ae.html("&#160;") } ae.text(this.options.title) }, _createButtonPane: function() { this.uiDialogButtonPane = e("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix");
            this.uiButtonSet = e("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane);
            this._createButtons() }, _createButtons: function() { var ae = this,
                af = this.options.buttons;
            this.uiDialogButtonPane.remove();
            this.uiButtonSet.empty(); if (e.isEmptyObject(af) || (e.isArray(af) && !af.length)) { this.uiDialog.removeClass("ui-dialog-buttons"); return } e.each(af, function(aj, ag) { var ah, ai;
                ag = e.isFunction(ag) ? { click: ag, text: aj } : ag;
                ag = e.extend({ type: "button" }, ag);
                ah = ag.click;
                ag.click = function() { ah.apply(ae.element[0], arguments) };
                ai = { icons: ag.icons, text: ag.showText };
                delete ag.icons;
                delete ag.showText;
                e("<button></button>", ag).button(ai).appendTo(ae.uiButtonSet) });
            this.uiDialog.addClass("ui-dialog-buttons");
            this.uiDialogButtonPane.appendTo(this.uiDialog) }, _makeDraggable: function() { var ae = this,
                ag = this.options;

            function af(ah) { return { position: ah.position, offset: ah.offset } } this.uiDialog.draggable({ cancel: ".ui-dialog-content, .ui-dialog-titlebar-close", handle: ".ui-dialog-titlebar", containment: "document", start: function(ai, ah) { e(this).addClass("ui-dialog-dragging");
                    ae._blockFrames();
                    ae._trigger("dragStart", ai, af(ah)) }, drag: function(ai, ah) { ae._trigger("drag", ai, af(ah)) }, stop: function(aj, ah) { var ai = ah.offset.left - ae.document.scrollLeft(),
                        ak = ah.offset.top - ae.document.scrollTop();
                    ag.position = { my: "left top", at: "left" + (ai >= 0 ? "+" : "") + ai + " top" + (ak >= 0 ? "+" : "") + ak, of: ae.window };
                    e(this).removeClass("ui-dialog-dragging");
                    ae._unblockFrames();
                    ae._trigger("dragStop", aj, af(ah)) } }) }, _makeResizable: function() { var aj = this,
                af = this.options,
                ae = af.resizable,
                ai = this.uiDialog.css("position"),
                ag = typeof ae === "string" ? ae : "n,e,s,w,se,sw,ne,nw";

            function ah(ak) { return { originalPosition: ak.originalPosition, originalSize: ak.originalSize, position: ak.position, size: ak.size } } this.uiDialog.resizable({ cancel: ".ui-dialog-content", containment: "document", alsoResize: this.element, maxWidth: af.maxWidth, maxHeight: af.maxHeight, minWidth: af.minWidth, minHeight: this._minHeight(), handles: ag, start: function(al, ak) { e(this).addClass("ui-dialog-resizing");
                    aj._blockFrames();
                    aj._trigger("resizeStart", al, ah(ak)) }, resize: function(al, ak) { aj._trigger("resize", al, ah(ak)) }, stop: function(am, ak) { var ao = aj.uiDialog.offset(),
                        al = ao.left - aj.document.scrollLeft(),
                        an = ao.top - aj.document.scrollTop();
                    af.height = aj.uiDialog.height();
                    af.width = aj.uiDialog.width();
                    af.position = { my: "left top", at: "left" + (al >= 0 ? "+" : "") + al + " top" + (an >= 0 ? "+" : "") + an, of: aj.window };
                    e(this).removeClass("ui-dialog-resizing");
                    aj._unblockFrames();
                    aj._trigger("resizeStop", am, ah(ak)) } }).css("position", ai) }, _trackFocus: function() { this._on(this.widget(), { focusin: function(ae) { this._makeFocusTarget();
                    this._focusedElement = e(ae.target) } }) }, _makeFocusTarget: function() { this._untrackInstance();
            this._trackingInstances().unshift(this) }, _untrackInstance: function() { var af = this._trackingInstances(),
                ae = e.inArray(this, af); if (ae !== -1) { af.splice(ae, 1) } }, _trackingInstances: function() { var ae = this.document.data("ui-dialog-instances"); if (!ae) { ae = [];
                this.document.data("ui-dialog-instances", ae) } return ae }, _minHeight: function() { var ae = this.options; return ae.height === "auto" ? ae.minHeight : Math.min(ae.minHeight, ae.height) }, _position: function() { var ae = this.uiDialog.is(":visible"); if (!ae) { this.uiDialog.show() } this.uiDialog.position(this.options.position); if (!ae) { this.uiDialog.hide() } }, _setOptions: function(ag) { var ae = this,
                ah = false,
                af = {};
            e.each(ag, function(ai, aj) { ae._setOption(ai, aj); if (ai in ae.sizeRelatedOptions) { ah = true } if (ai in ae.resizableRelatedOptions) { af[ai] = aj } }); if (ah) { this._size();
                this._position() } if (this.uiDialog.is(":data(ui-resizable)")) { this.uiDialog.resizable("option", af) } }, _setOption: function(ai, ae) { var ag, af, ah = this.uiDialog; if (ai === "dialogClass") { ah.removeClass(this.options.dialogClass).addClass(ae) } if (ai === "disabled") { return } this._super(ai, ae); if (ai === "appendTo") { this.uiDialog.appendTo(this._appendTo()) } if (ai === "buttons") { this._createButtons() } if (ai === "closeText") { this.uiDialogTitlebarClose.button({ label: "" + ae }) } if (ai === "draggable") { ag = ah.is(":data(ui-draggable)"); if (ag && !ae) { ah.draggable("destroy") } if (!ag && ae) { this._makeDraggable() } } if (ai === "position") { this._position() } if (ai === "resizable") { af = ah.is(":data(ui-resizable)"); if (af && !ae) { ah.resizable("destroy") } if (af && typeof ae === "string") { ah.resizable("option", "handles", ae) } if (!af && ae !== false) { this._makeResizable() } } if (ai === "title") { this._title(this.uiDialogTitlebar.find(".ui-dialog-title")) } }, _size: function() { var af, ag, ae, ah = this.options;
            this.element.show().css({ width: "auto", minHeight: 0, maxHeight: "none", height: 0 }); if (ah.minWidth > ah.width) { ah.width = ah.minWidth } af = this.uiDialog.css({ height: "auto", width: ah.width }).outerHeight();
            ag = Math.max(0, ah.minHeight - af);
            ae = typeof ah.maxHeight === "number" ? Math.max(0, ah.maxHeight - af) : "none"; if (ah.height === "auto") { this.element.css({ minHeight: ag, maxHeight: ae, height: "auto" }) } else { this.element.height(Math.max(0, ah.height - af)) } if (this.uiDialog.is(":data(ui-resizable)")) { this.uiDialog.resizable("option", "minHeight", this._minHeight()) } }, _blockFrames: function() { this.iframeBlocks = this.document.find("iframe").map(function() { var ae = e(this); return e("<div>").css({ position: "absolute", width: ae.outerWidth(), height: ae.outerHeight() }).appendTo(ae.parent()).offset(ae.offset())[0] }) }, _unblockFrames: function() { if (this.iframeBlocks) { this.iframeBlocks.remove();
                delete this.iframeBlocks } }, _allowInteraction: function(ae) { if (e(ae.target).closest(".ui-dialog").length) { return true } return !!e(ae.target).closest(".ui-datepicker").length }, _createOverlay: function() { if (!this.options.modal) { return } var ae = true;
            this._delay(function() { ae = false }); if (!this.document.data("ui-dialog-overlays")) { this._on(this.document, { focusin: function(af) { if (ae) { return } if (!this._allowInteraction(af)) { af.preventDefault();
                            this._trackingInstances()[0]._focusTabbable() } } }) } this.overlay = e("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo());
            this._on(this.overlay, { mousedown: "_keepFocus" });
            this.document.data("ui-dialog-overlays", (this.document.data("ui-dialog-overlays") || 0) + 1) }, _destroyOverlay: function() { if (!this.options.modal) { return } if (this.overlay) { var ae = this.document.data("ui-dialog-overlays") - 1; if (!ae) { this.document.unbind("focusin").removeData("ui-dialog-overlays") } else { this.document.data("ui-dialog-overlays", ae) } this.overlay.remove();
                this.overlay = null } } });
    e.widget("ui.droppable", { version: "1.11.2", widgetEventPrefix: "drop", options: { accept: "*", activeClass: false, addClasses: true, greedy: false, hoverClass: false, scope: "default", tolerance: "intersect", activate: null, deactivate: null, drop: null, out: null, over: null }, _create: function() { var ag, ae = this.options,
                af = ae.accept;
            this.isover = false;
            this.isout = true;
            this.accept = e.isFunction(af) ? af : function(ah) { return ah.is(af) };
            this.proportions = function() { if (arguments.length) { ag = arguments[0] } else { return ag ? ag : ag = { width: this.element[0].offsetWidth, height: this.element[0].offsetHeight } } };
            this._addToManager(ae.scope);
            ae.addClasses && this.element.addClass("ui-droppable") }, _addToManager: function(ae) { e.ui.ddmanager.droppables[ae] = e.ui.ddmanager.droppables[ae] || [];
            e.ui.ddmanager.droppables[ae].push(this) }, _splice: function(ae) { var af = 0; for (; af < ae.length; af++) { if (ae[af] === this) { ae.splice(af, 1) } } }, _destroy: function() { var ae = e.ui.ddmanager.droppables[this.options.scope];
            this._splice(ae);
            this.element.removeClass("ui-droppable ui-droppable-disabled") }, _setOption: function(ag, ae) { if (ag === "accept") { this.accept = e.isFunction(ae) ? ae : function(ah) { return ah.is(ae) } } else { if (ag === "scope") { var af = e.ui.ddmanager.droppables[this.options.scope];
                    this._splice(af);
                    this._addToManager(ae) } } this._super(ag, ae) }, _activate: function(ae) { var af = e.ui.ddmanager.current; if (this.options.activeClass) { this.element.addClass(this.options.activeClass) } if (af) { this._trigger("activate", ae, this.ui(af)) } }, _deactivate: function(ae) { var af = e.ui.ddmanager.current; if (this.options.activeClass) { this.element.removeClass(this.options.activeClass) } if (af) { this._trigger("deactivate", ae, this.ui(af)) } }, _over: function(ae) { var af = e.ui.ddmanager.current; if (!af || (af.currentItem || af.element)[0] === this.element[0]) { return } if (this.accept.call(this.element[0], (af.currentItem || af.element))) { if (this.options.hoverClass) { this.element.addClass(this.options.hoverClass) } this._trigger("over", ae, this.ui(af)) } }, _out: function(ae) { var af = e.ui.ddmanager.current; if (!af || (af.currentItem || af.element)[0] === this.element[0]) { return } if (this.accept.call(this.element[0], (af.currentItem || af.element))) { if (this.options.hoverClass) { this.element.removeClass(this.options.hoverClass) } this._trigger("out", ae, this.ui(af)) } }, _drop: function(ag, af) { var ae = af || e.ui.ddmanager.current,
                ah = false; if (!ae || (ae.currentItem || ae.element)[0] === this.element[0]) { return false } this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() { var ai = e(this).droppable("instance"); if (ai.options.greedy && !ai.options.disabled && ai.options.scope === ae.options.scope && ai.accept.call(ai.element[0], (ae.currentItem || ae.element)) && e.ui.intersect(ae, e.extend(ai, { offset: ai.element.offset() }), ai.options.tolerance, ag)) { ah = true; return false } }); if (ah) { return false } if (this.accept.call(this.element[0], (ae.currentItem || ae.element))) { if (this.options.activeClass) { this.element.removeClass(this.options.activeClass) } if (this.options.hoverClass) { this.element.removeClass(this.options.hoverClass) } this._trigger("drop", ag, this.ui(ae)); return this.element } return false }, ui: function(ae) { return { draggable: (ae.currentItem || ae.element), helper: ae.helper, position: ae.position, offset: ae.positionAbs } } });
    e.ui.intersect = (function() {
        function ae(ah, af, ag) { return (ah >= af) && (ah < (af + ag)) } return function(aq, al, ao, an) { if (!al.offset) { return false } var ag = (aq.positionAbs || aq.position.absolute).left + aq.margins.left,
                ah = (aq.positionAbs || aq.position.absolute).top + aq.margins.top,
                am = ag + aq.helperProportions.width,
                ai = ah + aq.helperProportions.height,
                aj = al.offset.left,
                af = al.offset.top,
                ap = aj + al.proportions().width,
                ak = af + al.proportions().height; switch (ao) {
                case "fit":
                    return (aj <= ag && am <= ap && af <= ah && ai <= ak);
                case "intersect":
                    return (aj < ag + (aq.helperProportions.width / 2) && am - (aq.helperProportions.width / 2) < ap && af < ah + (aq.helperProportions.height / 2) && ai - (aq.helperProportions.height / 2) < ak);
                case "pointer":
                    return ae(an.pageY, af, al.proportions().height) && ae(an.pageX, aj, al.proportions().width);
                case "touch":
                    return ((ah >= af && ah <= ak) || (ai >= af && ai <= ak) || (ah < af && ai > ak)) && ((ag >= aj && ag <= ap) || (am >= aj && am <= ap) || (ag < aj && am > ap));
                default:
                    return false } } })();
    e.ui.ddmanager = { current: null, droppables: { "default": [] }, prepareOffsets: function(ak, aj) { var ae, af, ag = e.ui.ddmanager.droppables[ak.options.scope] || [],
                ai = aj ? aj.type : null,
                ah = (ak.currentItem || ak.element).find(":data(ui-droppable)").addBack();
            droppablesLoop: for (ae = 0; ae < ag.length; ae++) { if (ag[ae].options.disabled || (ak && !ag[ae].accept.call(ag[ae].element[0], (ak.currentItem || ak.element)))) { continue } for (af = 0; af < ah.length; af++) { if (ah[af] === ag[ae].element[0]) { ag[ae].proportions().height = 0; continue droppablesLoop } } ag[ae].visible = ag[ae].element.css("display") !== "none"; if (!ag[ae].visible) { continue } if (ai === "mousedown") { ag[ae]._activate.call(ag[ae], aj) } ag[ae].offset = ag[ae].element.offset();
                ag[ae].proportions({ width: ag[ae].element[0].offsetWidth, height: ag[ae].element[0].offsetHeight }) } }, drop: function(ae, af) { var ag = false;
            e.each((e.ui.ddmanager.droppables[ae.options.scope] || []).slice(), function() { if (!this.options) { return } if (!this.options.disabled && this.visible && e.ui.intersect(ae, this, this.options.tolerance, af)) { ag = this._drop.call(this, af) || ag } if (!this.options.disabled && this.visible && this.accept.call(this.element[0], (ae.currentItem || ae.element))) { this.isout = true;
                    this.isover = false;
                    this._deactivate.call(this, af) } }); return ag }, dragStart: function(af, ae) { af.element.parentsUntil("body").bind("scroll.droppable", function() { if (!af.options.refreshPositions) { e.ui.ddmanager.prepareOffsets(af, ae) } }) }, drag: function(af, ae) { if (af.options.refreshPositions) { e.ui.ddmanager.prepareOffsets(af, ae) } e.each(e.ui.ddmanager.droppables[af.options.scope] || [], function() { if (this.options.disabled || this.greedyChild || !this.visible) { return } var ag, ah, ai, ak = e.ui.intersect(af, this, this.options.tolerance, ae),
                    aj = !ak && this.isover ? "isout" : (ak && !this.isover ? "isover" : null); if (!aj) { return } if (this.options.greedy) { ah = this.options.scope;
                    ai = this.element.parents(":data(ui-droppable)").filter(function() { return e(this).droppable("instance").options.scope === ah }); if (ai.length) { ag = e(ai[0]).droppable("instance");
                        ag.greedyChild = (aj === "isover") } } if (ag && aj === "isover") { ag.isover = false;
                    ag.isout = true;
                    ag._out.call(ag, ae) } this[aj] = true;
                this[aj === "isout" ? "isover" : "isout"] = false;
                this[aj === "isover" ? "_over" : "_out"].call(this, ae); if (ag && aj === "isout") { ag.isout = false;
                    ag.isover = true;
                    ag._over.call(ag, ae) } }) }, dragStop: function(af, ae) { af.element.parentsUntil("body").unbind("scroll.droppable"); if (!af.options.refreshPositions) { e.ui.ddmanager.prepareOffsets(af, ae) } } }; var aa = e.ui.droppable; var U = "ui-effects-",
        q = e;
    e.effects = { effect: {} };
    (function(ai, ar) { var an = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
            aj = /^([\-+])=\s*(\d+\.?\d*)/,
            ae = [{ re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function(au) { return [au[1], au[2], au[3], au[4]] } }, { re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function(au) { return [au[1] * 2.55, au[2] * 2.55, au[3] * 2.55, au[4]] } }, { re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/, parse: function(au) { return [parseInt(au[1], 16), parseInt(au[2], 16), parseInt(au[3], 16)] } }, { re: /#([a-f0-9])([a-f0-9])([a-f0-9])/, parse: function(au) { return [parseInt(au[1] + au[1], 16), parseInt(au[2] + au[2], 16), parseInt(au[3] + au[3], 16)] } }, { re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, space: "hsla", parse: function(au) { return [au[1], au[2] / 100, au[3] / 100, au[4]] } }],
            aq = ai.Color = function(au, ax, av, aw) { return new ai.Color.fn.parse(au, ax, av, aw) },
            af = { rgba: { props: { red: { idx: 0, type: "byte" }, green: { idx: 1, type: "byte" }, blue: { idx: 2, type: "byte" } } }, hsla: { props: { hue: { idx: 0, type: "degrees" }, saturation: { idx: 1, type: "percent" }, lightness: { idx: 2, type: "percent" } } } },
            am = { "byte": { floor: true, max: 255 }, percent: { max: 1 }, degrees: { mod: 360, floor: true } },
            al = aq.support = {},
            ah = ai("<p>")[0],
            ag, at = ai.each;
        ah.style.cssText = "background-color:rgba(1,1,1,.5)";
        al.rgba = ah.style.backgroundColor.indexOf("rgba") > -1;
        at(af, function(av, au) { au.cache = "_" + av;
            au.props.alpha = { idx: 3, type: "percent", def: 1 } });

        function ak(au, av, aw) { var ax = am[av.type] || {}; if (au == null) { return (aw || !av.def) ? null : av.def } au = ax.floor ? ~~au : parseFloat(au); if (isNaN(au)) { return av.def } if (ax.mod) { return (au + ax.mod) % ax.mod } return 0 > au ? 0 : ax.max < au ? ax.max : au }

        function ap(aw) { var av = aq(),
                au = av._rgba = [];
            aw = aw.toLowerCase();
            at(ae, function(ax, aA) { var aC, az = aA.re.exec(aw),
                    ay = az && aA.parse(az),
                    aB = aA.space || "rgba"; if (ay) { aC = av[aB](ay);
                    av[af[aB].cache] = aC[af[aB].cache];
                    au = av._rgba = aC._rgba; return false } }); if (au.length) { if (au.join() === "0,0,0,0") { ai.extend(au, ag.transparent) } return av } return ag[aw] } aq.fn = ai.extend(aq.prototype, { parse: function(aw, au, av, ay) { if (aw === ar) { this._rgba = [null, null, null, null]; return this } if (aw.jquery || aw.nodeType) { aw = ai(aw).css(au);
                    au = ar } var aA = this,
                    ax = ai.type(aw),
                    az = this._rgba = []; if (au !== ar) { aw = [aw, au, av, ay];
                    ax = "array" } if (ax === "string") { return this.parse(ap(aw) || ag._default) } if (ax === "array") { at(af.rgba.props, function(aB, aC) { az[aC.idx] = ak(aw[aC.idx], aC) }); return this } if (ax === "object") { if (aw instanceof aq) { at(af, function(aC, aB) { if (aw[aB.cache]) { aA[aB.cache] = aw[aB.cache].slice() } }) } else { at(af, function(aD, aB) { var aC = aB.cache;
                            at(aB.props, function(aE, aF) { if (!aA[aC] && aB.to) { if (aE === "alpha" || aw[aE] == null) { return } aA[aC] = aB.to(aA._rgba) } aA[aC][aF.idx] = ak(aw[aE], aF, true) }); if (aA[aC] && ai.inArray(null, aA[aC].slice(0, 3)) < 0) { aA[aC][3] = 1; if (aB.from) { aA._rgba = aB.from(aA[aC]) } } }) } return this } }, is: function(av) { var au = aq(av),
                    ax = true,
                    aw = this;
                at(af, function(az, ay) { var aB, aA = au[ay.cache]; if (aA) { aB = aw[ay.cache] || ay.to && ay.to(aw._rgba) || [];
                        at(ay.props, function(aC, aD) { if (aA[aD.idx] != null) { ax = (aA[aD.idx] === aB[aD.idx]); return ax } }) } return ax }); return ax }, _space: function() { var au = [],
                    av = this;
                at(af, function(ax, aw) { if (av[aw.cache]) { au.push(ax) } }); return au.pop() }, transition: function(aB, ay) { var au = aq(aB),
                    ax = au._space(),
                    aw = af[ax],
                    az = this.alpha() === 0 ? aq("transparent") : this,
                    av = az[aw.cache] || aw.to(az._rgba),
                    aA = av.slice();
                au = au[aw.cache];
                at(aw.props, function(aG, aD) { var aH = aD.idx,
                        aC = av[aH],
                        aF = au[aH],
                        aE = am[aD.type] || {}; if (aF === null) { return } if (aC === null) { aA[aH] = aF } else { if (aE.mod) { if (aF - aC > aE.mod / 2) { aC += aE.mod } else { if (aC - aF > aE.mod / 2) { aC -= aE.mod } } } aA[aH] = ak((aF - aC) * ay + aC, aD) } }); return this[ax](aA) }, blend: function(aw) { if (this._rgba[3] === 1) { return this } var ax = this._rgba.slice(),
                    au = ax.pop(),
                    av = aq(aw)._rgba; return aq(ai.map(ax, function(ay, az) { return (1 - au) * av[az] + au * ay })) }, toRgbaString: function() { var au = "rgba(",
                    av = ai.map(this._rgba, function(aw, ax) { return aw == null ? (ax > 2 ? 1 : 0) : aw }); if (av[3] === 1) { av.pop();
                    au = "rgb(" } return au + av.join() + ")" }, toHslaString: function() { var au = "hsla(",
                    av = ai.map(this.hsla(), function(aw, ax) { if (aw == null) { aw = ax > 2 ? 1 : 0 } if (ax && ax < 3) { aw = Math.round(aw * 100) + "%" } return aw }); if (av[3] === 1) { av.pop();
                    au = "hsl(" } return au + av.join() + ")" }, toHexString: function(aw) { var av = this._rgba.slice(),
                    au = av.pop(); if (aw) { av.push(~~(au * 255)) } return "#" + ai.map(av, function(ax) { ax = (ax || 0).toString(16); return ax.length === 1 ? "0" + ax : ax }).join("") }, toString: function() { return this._rgba[3] === 0 ? "transparent" : this.toRgbaString() } });
        aq.fn.parse.prototype = aq.fn;

        function ao(aw, au, av) { av = (av + 1) % 1; if (av * 6 < 1) { return aw + (au - aw) * av * 6 } if (av * 2 < 1) { return au } if (av * 3 < 2) { return aw + (au - aw) * ((2 / 3) - av) * 6 } return aw } af.hsla.to = function(aE) { if (aE[0] == null || aE[1] == null || aE[2] == null) { return [null, null, null, aE[3]] } var aC = aE[0] / 255,
                aF = aE[1] / 255,
                aB = aE[2] / 255,
                aA = aE[3],
                ay = Math.max(aC, aF, aB),
                av = Math.min(aC, aF, aB),
                az = ay - av,
                aw = ay + av,
                ax = aw * 0.5,
                au, aD; if (av === ay) { au = 0 } else { if (aC === ay) { au = (60 * (aF - aB) / az) + 360 } else { if (aF === ay) { au = (60 * (aB - aC) / az) + 120 } else { au = (60 * (aC - aF) / az) + 240 } } } if (az === 0) { aD = 0 } else { if (ax <= 0.5) { aD = az / aw } else { aD = az / (2 - aw) } } return [Math.round(au) % 360, aD, ax, aA == null ? 1 : aA] };
        af.hsla.from = function(au) { if (au[0] == null || au[1] == null || au[2] == null) { return [null, null, null, au[3]] } var ax = au[0] / 360,
                aA = au[1],
                av = au[2],
                ay = au[3],
                az = av <= 0.5 ? av * (1 + aA) : av + aA - av * aA,
                aw = 2 * av - az; return [Math.round(ao(aw, az, ax + (1 / 3)) * 255), Math.round(ao(aw, az, ax) * 255), Math.round(ao(aw, az, ax - (1 / 3)) * 255), ay] };
        at(af, function(av, au) { var ay = au.props,
                aw = au.cache,
                az = au.to,
                ax = au.from;
            aq.fn[av] = function(aA) { if (az && !this[aw]) { this[aw] = az(this._rgba) } if (aA === ar) { return this[aw].slice() } var aC, aD = ai.type(aA),
                    aE = (aD === "array" || aD === "object") ? aA : arguments,
                    aB = this[aw].slice();
                at(ay, function(aH, aF) { var aG = aE[aD === "object" ? aH : aF.idx]; if (aG == null) { aG = aB[aF.idx] } aB[aF.idx] = ak(aG, aF) }); if (ax) { aC = aq(ax(aB));
                    aC[aw] = aB; return aC } else { return aq(aB) } };
            at(ay, function(aA, aB) { if (aq.fn[aA]) { return } aq.fn[aA] = function(aC) { var aG = ai.type(aC),
                        aH = (aA === "alpha" ? (this._hsla ? "hsla" : "rgba") : av),
                        aD = this[aH](),
                        aF = aD[aB.idx],
                        aE; if (aG === "undefined") { return aF } if (aG === "function") { aC = aC.call(this, aF);
                        aG = ai.type(aC) } if (aC == null && aB.empty) { return this } if (aG === "string") { aE = aj.exec(aC); if (aE) { aC = aF + parseFloat(aE[2]) * (aE[1] === "+" ? 1 : -1) } } aD[aB.idx] = aC; return this[aH](aD) } }) });
        aq.hook = function(au) { var av = au.split(" ");
            at(av, function(aw, ax) { ai.cssHooks[ax] = { set: function(az, aA) { var aD, aB, ay = ""; if (aA !== "transparent" && (ai.type(aA) !== "string" || (aD = ap(aA)))) { aA = aq(aD || aA); if (!al.rgba && aA._rgba[3] !== 1) { aB = ax === "backgroundColor" ? az.parentNode : az; while ((ay === "" || ay === "transparent") && aB && aB.style) { try { ay = ai.css(aB, "backgroundColor");
                                        aB = aB.parentNode } catch (aC) {} } aA = aA.blend(ay && ay !== "transparent" ? ay : "_default") } aA = aA.toRgbaString() } try { az.style[ax] = aA } catch (aC) {} } };
                ai.fx.step[ax] = function(ay) { if (!ay.colorInit) { ay.start = aq(ay.elem, ax);
                        ay.end = aq(ay.end);
                        ay.colorInit = true } ai.cssHooks[ax].set(ay.elem, ay.start.transition(ay.end, ay.pos)) } }) };
        aq.hook(an);
        ai.cssHooks.borderColor = { expand: function(av) { var au = {};
                at(["Top", "Right", "Bottom", "Left"], function(ax, aw) { au["border" + aw + "Color"] = av }); return au } };
        ag = ai.Color.names = { aqua: "#00ffff", black: "#000000", blue: "#0000ff", fuchsia: "#ff00ff", gray: "#808080", green: "#008000", lime: "#00ff00", maroon: "#800000", navy: "#000080", olive: "#808000", purple: "#800080", red: "#ff0000", silver: "#c0c0c0", teal: "#008080", white: "#ffffff", yellow: "#ffff00", transparent: [null, null, null, 0], _default: "#ffffff" } })(q);
    (function() { var ae = ["add", "remove", "toggle"],
            ag = { border: 1, borderBottom: 1, borderColor: 1, borderLeft: 1, borderRight: 1, borderTop: 1, borderWidth: 1, margin: 1, padding: 1 };
        e.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(ai, aj) { e.fx.step[aj] = function(ak) { if (ak.end !== "none" && !ak.setAttr || ak.pos === 1 && !ak.setAttr) { q.style(ak.elem, aj, ak.end);
                    ak.setAttr = true } } });

        function ah(al) { var am, ak, ai = al.ownerDocument.defaultView ? al.ownerDocument.defaultView.getComputedStyle(al, null) : al.currentStyle,
                aj = {}; if (ai && ai.length && ai[0] && ai[ai[0]]) { ak = ai.length; while (ak--) { am = ai[ak]; if (typeof ai[am] === "string") { aj[e.camelCase(am)] = ai[am] } } } else { for (am in ai) { if (typeof ai[am] === "string") { aj[am] = ai[am] } } } return aj }

        function af(al, am) { var ak = {},
                aj, ai; for (aj in am) { ai = am[aj]; if (al[aj] !== ai) { if (!ag[aj]) { if (e.fx.step[aj] || !isNaN(parseFloat(ai))) { ak[aj] = ai } } } } return ak } if (!e.fn.addBack) { e.fn.addBack = function(ai) { return this.add(ai == null ? this.prevObject : this.prevObject.filter(ai)) } } e.effects.animateClass = function(ai, am, al, ak) { var aj = e.speed(am, al, ak); return this.queue(function() { var an = e(this),
                    ap = an.attr("class") || "",
                    aq, ao = aj.children ? an.find("*").addBack() : an;
                ao = ao.map(function() { var ar = e(this); return { el: ar, start: ah(this) } });
                aq = function() { e.each(ae, function(at, ar) { if (ai[ar]) { an[ar + "Class"](ai[ar]) } }) };
                aq();
                ao = ao.map(function() { this.end = ah(this.el[0]);
                    this.diff = af(this.start, this.end); return this });
                an.attr("class", ap);
                ao = ao.map(function() { var ar = this,
                        au = e.Deferred(),
                        at = e.extend({}, aj, { queue: false, complete: function() { au.resolve(ar) } });
                    this.el.animate(this.diff, at); return au.promise() });
                e.when.apply(e, ao.get()).done(function() { aq();
                    e.each(arguments, function() { var ar = this.el;
                        e.each(this.diff, function(at) { ar.css(at, "") }) });
                    aj.complete.call(an[0]) }) }) };
        e.fn.extend({ addClass: (function(ai) { return function(aj, ak, al, am) { return ak ? e.effects.animateClass.call(this, { add: aj }, ak, al, am) : ai.apply(this, arguments) } })(e.fn.addClass), removeClass: (function(ai) { return function(aj, ak, al, am) { return arguments.length > 1 ? e.effects.animateClass.call(this, { remove: aj }, ak, al, am) : ai.apply(this, arguments) } })(e.fn.removeClass), toggleClass: (function(ai) { return function(aj, ak, an, al, am) { if (typeof ak === "boolean" || ak === undefined) { if (!an) { return ai.apply(this, arguments) } else { return e.effects.animateClass.call(this, (ak ? { add: aj } : { remove: aj }), an, al, am) } } else { return e.effects.animateClass.call(this, { toggle: aj }, ak, an, al) } } })(e.fn.toggleClass), switchClass: function(ak, aj, ai, am, al) { return e.effects.animateClass.call(this, { add: aj, remove: ak }, ai, am, al) } }) })();
    (function() { e.extend(e.effects, { version: "1.11.2", save: function(ai, ah) { for (var ag = 0; ag < ah.length; ag++) { if (ah[ag] !== null) { ai.data(U + ah[ag], ai[0].style[ah[ag]]) } } }, restore: function(aj, ai) { var ah, ag; for (ag = 0; ag < ai.length; ag++) { if (ai[ag] !== null) { ah = aj.data(U + ai[ag]); if (ah === undefined) { ah = "" } aj.css(ai[ag], ah) } } }, setMode: function(ag, ah) { if (ah === "toggle") { ah = ag.is(":hidden") ? "show" : "hide" } return ah }, getBaseline: function(ah, ag) { var aj, ai; switch (ah[0]) {
                    case "top":
                        aj = 0; break;
                    case "middle":
                        aj = 0.5; break;
                    case "bottom":
                        aj = 1; break;
                    default:
                        aj = ah[0] / ag.height } switch (ah[1]) {
                    case "left":
                        ai = 0; break;
                    case "center":
                        ai = 0.5; break;
                    case "right":
                        ai = 1; break;
                    default:
                        ai = ah[1] / ag.width } return { x: ai, y: aj } }, createWrapper: function(ah) { if (ah.parent().is(".ui-effects-wrapper")) { return ah.parent() } var aj = { width: ah.outerWidth(true), height: ah.outerHeight(true), "float": ah.css("float") },
                    al = e("<div></div>").addClass("ui-effects-wrapper").css({ fontSize: "100%", background: "transparent", border: "none", margin: 0, padding: 0 }),
                    ag = { width: ah.width(), height: ah.height() },
                    ai = document.activeElement; try { ai.id } catch (ak) { ai = document.body } ah.wrap(al); if (ah[0] === ai || e.contains(ah[0], ai)) { e(ai).focus() } al = ah.parent(); if (ah.css("position") === "static") { al.css({ position: "relative" });
                    ah.css({ position: "relative" }) } else { e.extend(aj, { position: ah.css("position"), zIndex: ah.css("z-index") });
                    e.each(["top", "left", "bottom", "right"], function(am, an) { aj[an] = ah.css(an); if (isNaN(parseInt(aj[an], 10))) { aj[an] = "auto" } });
                    ah.css({ position: "relative", top: 0, left: 0, right: "auto", bottom: "auto" }) } ah.css(ag); return al.css(aj).show() }, removeWrapper: function(ag) { var ah = document.activeElement; if (ag.parent().is(".ui-effects-wrapper")) { ag.parent().replaceWith(ag); if (ag[0] === ah || e.contains(ag[0], ah)) { e(ah).focus() } } return ag }, setTransition: function(aj, ai, ah, ag) { ag = ag || {};
                e.each(ai, function(ak, am) { var al = aj.cssUnit(am); if (al[0] > 0) { ag[am] = al[0] * ah + al[1] } }); return ag } });

        function af(aj, ai, ah, ag) { if (e.isPlainObject(aj)) { ai = aj;
                aj = aj.effect } aj = { effect: aj }; if (ai == null) { ai = {} } if (e.isFunction(ai)) { ag = ai;
                ah = null;
                ai = {} } if (typeof ai === "number" || e.fx.speeds[ai]) { ag = ah;
                ah = ai;
                ai = {} } if (e.isFunction(ah)) { ag = ah;
                ah = null } if (ai) { e.extend(aj, ai) } ah = ah || ai.duration;
            aj.duration = e.fx.off ? 0 : typeof ah === "number" ? ah : ah in e.fx.speeds ? e.fx.speeds[ah] : e.fx.speeds._default;
            aj.complete = ag || ai.complete; return aj }

        function ae(ag) { if (!ag || typeof ag === "number" || e.fx.speeds[ag]) { return true } if (typeof ag === "string" && !e.effects.effect[ag]) { return true } if (e.isFunction(ag)) { return true } if (typeof ag === "object" && !ag.effect) { return true } return false } e.fn.extend({ effect: function() { var ai = af.apply(this, arguments),
                    aj = ai.mode,
                    ah = ai.queue,
                    ag = e.effects.effect[ai.effect]; if (e.fx.off || !ag) { if (aj) { return this[aj](ai.duration, ai.complete) } else { return this.each(function() { if (ai.complete) { ai.complete.call(this) } }) } }

                function ak(am) { var ao = e(this),
                        al = ai.complete,
                        an = ai.mode;

                    function ap() { if (e.isFunction(al)) { al.call(ao[0]) } if (e.isFunction(am)) { am() } } if (ao.is(":hidden") ? an === "hide" : an === "show") { ao[an]();
                        ap() } else { ag.call(ao[0], ai, ap) } } return ah === false ? this.each(ak) : this.queue(ah || "fx", ak) }, show: (function(ag) { return function(ai) { if (ae(ai)) { return ag.apply(this, arguments) } else { var ah = af.apply(this, arguments);
                        ah.mode = "show"; return this.effect.call(this, ah) } } })(e.fn.show), hide: (function(ag) { return function(ai) { if (ae(ai)) { return ag.apply(this, arguments) } else { var ah = af.apply(this, arguments);
                        ah.mode = "hide"; return this.effect.call(this, ah) } } })(e.fn.hide), toggle: (function(ag) { return function(ai) { if (ae(ai) || typeof ai === "boolean") { return ag.apply(this, arguments) } else { var ah = af.apply(this, arguments);
                        ah.mode = "toggle"; return this.effect.call(this, ah) } } })(e.fn.toggle), cssUnit: function(ai) { var ag = this.css(ai),
                    ah = [];
                e.each(["em", "px", "%", "pt"], function(ak, aj) { if (ag.indexOf(aj) > 0) { ah = [parseFloat(ag), aj] } }); return ah } }) })();
    (function() { var ae = {};
        e.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(af, ag) { ae[ag] = function(ah) { return Math.pow(ah, af + 2) } });
        e.extend(ae, { Sine: function(af) { return 1 - Math.cos(af * Math.PI / 2) }, Circ: function(af) { return 1 - Math.sqrt(1 - af * af) }, Elastic: function(af) { return af === 0 || af === 1 ? af : -Math.pow(2, 8 * (af - 1)) * Math.sin(((af - 1) * 80 - 7.5) * Math.PI / 15) }, Back: function(af) { return af * af * (3 * af - 2) }, Bounce: function(ah) { var af, ag = 4; while (ah < ((af = Math.pow(2, --ag)) - 1) / 11) {} return 1 / Math.pow(4, 3 - ag) - 7.5625 * Math.pow((af * 3 - 2) / 22 - ah, 2) } });
        e.each(ae, function(af, ag) { e.easing["easeIn" + af] = ag;
            e.easing["easeOut" + af] = function(ah) { return 1 - ag(1 - ah) };
            e.easing["easeInOut" + af] = function(ah) { return ah < 0.5 ? ag(ah * 2) / 2 : 1 - ag(ah * -2 + 2) / 2 } }) })(); var m = e.effects; var S = e.effects.effect.blind = function(aq, ai) { var at = e(this),
            ao = /up|down|vertical/,
            aj = /up|left|vertical|horizontal/,
            au = ["position", "top", "bottom", "left", "right", "height", "width"],
            ag = e.effects.setMode(at, aq.mode || "hide"),
            ak = aq.direction || "up",
            ar = ao.test(ak),
            af = ar ? "height" : "width",
            an = ar ? "top" : "left",
            av = aj.test(ak),
            ae = {},
            al = ag === "show",
            ap, ah, am; if (at.parent().is(".ui-effects-wrapper")) { e.effects.save(at.parent(), au) } else { e.effects.save(at, au) } at.show();
        ap = e.effects.createWrapper(at).css({ overflow: "hidden" });
        ah = ap[af]();
        am = parseFloat(ap.css(an)) || 0;
        ae[af] = al ? ah : 0; if (!av) { at.css(ar ? "bottom" : "right", 0).css(ar ? "top" : "left", "auto").css({ position: "absolute" });
            ae[an] = al ? am : ah + am } if (al) { ap.css(af, 0); if (!av) { ap.css(an, am + ah) } } ap.animate(ae, { duration: aq.duration, easing: aq.easing, queue: false, complete: function() { if (ag === "hide") { at.hide() } e.effects.restore(at, au);
                e.effects.removeWrapper(at);
                ai() } }) }; var t = e.effects.effect.bounce = function(at, aj) { var au = e(this),
            av = ["position", "top", "bottom", "left", "right", "height", "width"],
            af = e.effects.setMode(au, at.mode || "effect"),
            an = af === "hide",
            ao = af === "show",
            al = at.direction || "up",
            ag = at.distance,
            ax = at.times || 5,
            ay = ax * 2 + (ao || an ? 1 : 0),
            ak = at.duration / ay,
            aq = at.easing,
            ae = (al === "up" || al === "down") ? "top" : "left",
            aw = (al === "up" || al === "left"),
            ap, ar, am, ai = au.queue(),
            ah = ai.length; if (ao || an) { av.push("opacity") } e.effects.save(au, av);
        au.show();
        e.effects.createWrapper(au); if (!ag) { ag = au[ae === "top" ? "outerHeight" : "outerWidth"]() / 3 } if (ao) { am = { opacity: 1 };
            am[ae] = 0;
            au.css("opacity", 0).css(ae, aw ? -ag * 2 : ag * 2).animate(am, ak, aq) } if (an) { ag = ag / Math.pow(2, ax - 1) } am = {};
        am[ae] = 0; for (ap = 0; ap < ax; ap++) { ar = {};
            ar[ae] = (aw ? "-=" : "+=") + ag;
            au.animate(ar, ak, aq).animate(am, ak, aq);
            ag = an ? ag * 2 : ag / 2 } if (an) { ar = { opacity: 0 };
            ar[ae] = (aw ? "-=" : "+=") + ag;
            au.animate(ar, ak, aq) } au.queue(function() { if (an) { au.hide() } e.effects.restore(au, av);
            e.effects.removeWrapper(au);
            aj() }); if (ah > 1) { ai.splice.apply(ai, [1, 0].concat(ai.splice(ah, ay + 1))) } au.dequeue() }; var A = e.effects.effect.clip = function(an, ah) { var ao = e(this),
            ap = ["position", "top", "bottom", "left", "right", "height", "width"],
            aq = e.effects.setMode(ao, an.mode || "hide"),
            al = aq === "show",
            ai = an.direction || "vertical",
            af = ai === "vertical",
            aj = af ? "height" : "width",
            ar = af ? "top" : "left",
            ae = {},
            am, ak, ag;
        e.effects.save(ao, ap);
        ao.show();
        am = e.effects.createWrapper(ao).css({ overflow: "hidden" });
        ak = (ao[0].tagName === "IMG") ? am : ao;
        ag = ak[aj](); if (al) { ak.css(aj, 0);
            ak.css(ar, ag / 2) } ae[aj] = al ? ag : 0;
        ae[ar] = al ? 0 : ag / 2;
        ak.animate(ae, { queue: false, duration: an.duration, easing: an.easing, complete: function() { if (!al) { ao.hide() } e.effects.restore(ao, ap);
                e.effects.removeWrapper(ao);
                ah() } }) }; var D = e.effects.effect.drop = function(ai, af) { var al = e(this),
            am = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
            an = e.effects.setMode(al, ai.mode || "hide"),
            ah = an === "show",
            ak = ai.direction || "left",
            ag = (ak === "up" || ak === "down") ? "top" : "left",
            ao = (ak === "up" || ak === "left") ? "pos" : "neg",
            ae = { opacity: ah ? 1 : 0 },
            aj;
        e.effects.save(al, am);
        al.show();
        e.effects.createWrapper(al);
        aj = ai.distance || al[ag === "top" ? "outerHeight" : "outerWidth"](true) / 2; if (ah) { al.css("opacity", 0).css(ag, ao === "pos" ? -aj : aj) } ae[ag] = (ah ? (ao === "pos" ? "+=" : "-=") : (ao === "pos" ? "-=" : "+=")) + aj;
        al.animate(ae, { queue: false, duration: ai.duration, easing: ai.easing, complete: function() { if (an === "hide") { al.hide() } e.effects.restore(al, am);
                e.effects.removeWrapper(al);
                af() } }) }; var V = e.effects.effect.explode = function(au, ai) { var ah = au.pieces ? Math.round(Math.sqrt(au.pieces)) : 3,
            aj = ah,
            ae = e(this),
            aw = e.effects.setMode(ae, au.mode || "hide"),
            aq = aw === "show",
            an = ae.show().css("visibility", "hidden").offset(),
            ax = Math.ceil(ae.outerWidth() / aj),
            ap = Math.ceil(ae.outerHeight() / ah),
            am = [],
            ar, al, ak, ag, ao, at;

        function af() { am.push(this); if (am.length === ah * aj) { av() } } for (ar = 0; ar < ah; ar++) { ag = an.top + ar * ap;
            at = ar - (ah - 1) / 2; for (al = 0; al < aj; al++) { ak = an.left + al * ax;
                ao = al - (aj - 1) / 2;
                ae.clone().appendTo("body").wrap("<div></div>").css({ position: "absolute", visibility: "visible", left: -al * ax, top: -ar * ap }).parent().addClass("ui-effects-explode").css({ position: "absolute", overflow: "hidden", width: ax, height: ap, left: ak + (aq ? ao * ax : 0), top: ag + (aq ? at * ap : 0), opacity: aq ? 0 : 1 }).animate({ left: ak + (aq ? 0 : ao * ax), top: ag + (aq ? 0 : at * ap), opacity: aq ? 1 : 0 }, au.duration || 500, au.easing, af) } }

        function av() { ae.css({ visibility: "visible" });
            e(am).remove(); if (!aq) { ae.hide() } ai() } }; var n = e.effects.effect.fade = function(ae, af) { var ah = e(this),
            ag = e.effects.setMode(ah, ae.mode || "toggle");
        ah.animate({ opacity: ag }, { queue: false, duration: ae.duration, easing: ae.easing, complete: af }) }; var p = e.effects.effect.fold = function(ap, ai) { var aq = e(this),
            ar = ["position", "top", "bottom", "left", "right", "height", "width"],
            af = e.effects.setMode(aq, ap.mode || "hide"),
            an = af === "show",
            am = af === "hide",
            ag = ap.size || 15,
            ao = /([0-9]+)%/.exec(ag),
            aj = !!ap.horizFirst,
            au = an !== aj,
            ae = au ? ["width", "height"] : ["height", "width"],
            al = ap.duration / 2,
            ah, av, ak = {},
            at = {};
        e.effects.save(aq, ar);
        aq.show();
        ah = e.effects.createWrapper(aq).css({ overflow: "hidden" });
        av = au ? [ah.width(), ah.height()] : [ah.height(), ah.width()]; if (ao) { ag = parseInt(ao[1], 10) / 100 * av[am ? 0 : 1] } if (an) { ah.css(aj ? { height: 0, width: ag } : { height: ag, width: 0 }) } ak[ae[0]] = an ? av[0] : ag;
        at[ae[1]] = an ? av[1] : 0;
        ah.animate(ak, al, ap.easing).animate(at, al, ap.easing, function() { if (am) { aq.hide() } e.effects.restore(aq, ar);
            e.effects.removeWrapper(aq);
            ai() }) }; var H = e.effects.effect.highlight = function(ag, af) { var ae = e(this),
            ai = ["backgroundImage", "backgroundColor", "opacity"],
            aj = e.effects.setMode(ae, ag.mode || "show"),
            ah = { backgroundColor: ae.css("backgroundColor") }; if (aj === "hide") { ah.opacity = 0 } e.effects.save(ae, ai);
        ae.show().css({ backgroundImage: "none", backgroundColor: ag.color || "#ffff99" }).animate(ah, { queue: false, duration: ag.duration, easing: ag.easing, complete: function() { if (aj === "hide") { ae.hide() } e.effects.restore(ae, ai);
                af() } }) }; var k = e.effects.effect.size = function(aq, aj) { var ar, al, an, ae = e(this),
            ag = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
            ah = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
            ap = ["width", "height", "overflow"],
            av = ["fontSize"],
            am = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
            ai = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
            aw = e.effects.setMode(ae, aq.mode || "effect"),
            ao = aq.restore || aw !== "effect",
            ak = aq.scale || "both",
            at = aq.origin || ["middle", "center"],
            ax = ae.css("position"),
            au = ao ? ag : ah,
            af = { height: 0, width: 0, outerHeight: 0, outerWidth: 0 }; if (aw === "show") { ae.show() } ar = { height: ae.height(), width: ae.width(), outerHeight: ae.outerHeight(), outerWidth: ae.outerWidth() }; if (aq.mode === "toggle" && aw === "show") { ae.from = aq.to || af;
            ae.to = aq.from || ar } else { ae.from = aq.from || (aw === "show" ? af : ar);
            ae.to = aq.to || (aw === "hide" ? af : ar) } an = { from: { y: ae.from.height / ar.height, x: ae.from.width / ar.width }, to: { y: ae.to.height / ar.height, x: ae.to.width / ar.width } }; if (ak === "box" || ak === "both") { if (an.from.y !== an.to.y) { au = au.concat(am);
                ae.from = e.effects.setTransition(ae, am, an.from.y, ae.from);
                ae.to = e.effects.setTransition(ae, am, an.to.y, ae.to) } if (an.from.x !== an.to.x) { au = au.concat(ai);
                ae.from = e.effects.setTransition(ae, ai, an.from.x, ae.from);
                ae.to = e.effects.setTransition(ae, ai, an.to.x, ae.to) } } if (ak === "content" || ak === "both") { if (an.from.y !== an.to.y) { au = au.concat(av).concat(ap);
                ae.from = e.effects.setTransition(ae, av, an.from.y, ae.from);
                ae.to = e.effects.setTransition(ae, av, an.to.y, ae.to) } } e.effects.save(ae, au);
        ae.show();
        e.effects.createWrapper(ae);
        ae.css("overflow", "hidden").css(ae.from); if (at) { al = e.effects.getBaseline(at, ar);
            ae.from.top = (ar.outerHeight - ae.outerHeight()) * al.y;
            ae.from.left = (ar.outerWidth - ae.outerWidth()) * al.x;
            ae.to.top = (ar.outerHeight - ae.to.outerHeight) * al.y;
            ae.to.left = (ar.outerWidth - ae.to.outerWidth) * al.x } ae.css(ae.from); if (ak === "content" || ak === "both") { am = am.concat(["marginTop", "marginBottom"]).concat(av);
            ai = ai.concat(["marginLeft", "marginRight"]);
            ap = ag.concat(am).concat(ai);
            ae.find("*[width]").each(function() { var az = e(this),
                    ay = { height: az.height(), width: az.width(), outerHeight: az.outerHeight(), outerWidth: az.outerWidth() }; if (ao) { e.effects.save(az, ap) } az.from = { height: ay.height * an.from.y, width: ay.width * an.from.x, outerHeight: ay.outerHeight * an.from.y, outerWidth: ay.outerWidth * an.from.x };
                az.to = { height: ay.height * an.to.y, width: ay.width * an.to.x, outerHeight: ay.height * an.to.y, outerWidth: ay.width * an.to.x }; if (an.from.y !== an.to.y) { az.from = e.effects.setTransition(az, am, an.from.y, az.from);
                    az.to = e.effects.setTransition(az, am, an.to.y, az.to) } if (an.from.x !== an.to.x) { az.from = e.effects.setTransition(az, ai, an.from.x, az.from);
                    az.to = e.effects.setTransition(az, ai, an.to.x, az.to) } az.css(az.from);
                az.animate(az.to, aq.duration, aq.easing, function() { if (ao) { e.effects.restore(az, ap) } }) }) } ae.animate(ae.to, { queue: false, duration: aq.duration, easing: aq.easing, complete: function() { if (ae.to.opacity === 0) { ae.css("opacity", ae.from.opacity) } if (aw === "hide") { ae.hide() } e.effects.restore(ae, au); if (!ao) { if (ax === "static") { ae.css({ position: "relative", top: ae.to.top, left: ae.to.left }) } else { e.each(["top", "left"], function(az, ay) { ae.css(ay, function(aB, aD) { var aA = parseInt(aD, 10),
                                    aC = az ? ae.to.left : ae.to.top; if (aD === "auto") { return aC + "px" } return aA + aC + "px" }) }) } } e.effects.removeWrapper(ae);
                aj() } }) }; var i = e.effects.effect.scale = function(ah, af) { var al = e(this),
            ae = e.extend(true, {}, ah),
            an = e.effects.setMode(al, ah.mode || "effect"),
            am = parseInt(ah.percent, 10) || (parseInt(ah.percent, 10) === 0 ? 0 : (an === "hide" ? 0 : 100)),
            aj = ah.direction || "both",
            ak = ah.origin,
            ag = { height: al.height(), width: al.width(), outerHeight: al.outerHeight(), outerWidth: al.outerWidth() },
            ai = { y: aj !== "horizontal" ? (am / 100) : 1, x: aj !== "vertical" ? (am / 100) : 1 };
        ae.effect = "size";
        ae.queue = false;
        ae.complete = af; if (an !== "effect") { ae.origin = ak || ["middle", "center"];
            ae.restore = true } ae.from = ah.from || (an === "show" ? { height: 0, width: 0, outerHeight: 0, outerWidth: 0 } : ag);
        ae.to = { height: ag.height * ai.y, width: ag.width * ai.x, outerHeight: ag.outerHeight * ai.y, outerWidth: ag.outerWidth * ai.x }; if (ae.fade) { if (an === "show") { ae.from.opacity = 0;
                ae.to.opacity = 1 } if (an === "hide") { ae.from.opacity = 1;
                ae.to.opacity = 0 } } al.effect(ae) }; var P = e.effects.effect.puff = function(ai, af) { var ah = e(this),
            al = e.effects.setMode(ah, ai.mode || "hide"),
            ae = al === "hide",
            ak = parseInt(ai.percent, 10) || 150,
            aj = ak / 100,
            ag = { height: ah.height(), width: ah.width(), outerHeight: ah.outerHeight(), outerWidth: ah.outerWidth() };
        e.extend(ai, { effect: "scale", queue: false, fade: true, mode: al, complete: af, percent: ae ? ak : 100, from: ae ? ag : { height: ag.height * aj, width: ag.width * aj, outerHeight: ag.outerHeight * aj, outerWidth: ag.outerWidth * aj } });
        ah.effect(ai) }; var x = e.effects.effect.pulsate = function(al, aq) { var am = e(this),
            af = e.effects.setMode(am, al.mode || "show"),
            aj = af === "show",
            ai = af === "hide",
            an = (aj || af === "hide"),
            ap = ((al.times || 5) * 2) + (an ? 1 : 0),
            ag = al.duration / ap,
            ao = 0,
            ae = am.queue(),
            ah = ae.length,
            ak; if (aj || !am.is(":visible")) { am.css("opacity", 0).show();
            ao = 1 } for (ak = 1; ak < ap; ak++) { am.animate({ opacity: ao }, ag, al.easing);
            ao = 1 - ao } am.animate({ opacity: ao }, ag, al.easing);
        am.queue(function() { if (ai) { am.hide() } aq() }); if (ah > 1) { ae.splice.apply(ae, [1, 0].concat(ae.splice(ah, ap + 1))) } am.dequeue() }; var z = e.effects.effect.shake = function(aq, ak) { var ar = e(this),
            at = ["position", "top", "bottom", "left", "right", "height", "width"],
            ag = e.effects.setMode(ar, aq.mode || "effect"),
            am = aq.direction || "left",
            ah = aq.distance || 20,
            av = aq.times || 3,
            aw = av * 2 + 1,
            al = Math.round(aq.duration / aw),
            af = (am === "up" || am === "down") ? "top" : "left",
            aj = (am === "up" || am === "left"),
            ae = {},
            an = {},
            au = {},
            ap, ao = ar.queue(),
            ai = ao.length;
        e.effects.save(ar, at);
        ar.show();
        e.effects.createWrapper(ar);
        ae[af] = (aj ? "-=" : "+=") + ah;
        an[af] = (aj ? "+=" : "-=") + ah * 2;
        au[af] = (aj ? "-=" : "+=") + ah * 2;
        ar.animate(ae, al, aq.easing); for (ap = 1; ap < av; ap++) { ar.animate(an, al, aq.easing).animate(au, al, aq.easing) } ar.animate(an, al, aq.easing).animate(ae, al / 2, aq.easing).queue(function() { if (ag === "hide") { ar.hide() } e.effects.restore(ar, at);
            e.effects.removeWrapper(ar);
            ak() }); if (ai > 1) { ao.splice.apply(ao, [1, 0].concat(ao.splice(ai, aw + 1))) } ar.dequeue() }; var f = e.effects.effect.slide = function(aj, ag) { var am = e(this),
            an = ["position", "top", "bottom", "left", "right", "width", "height"],
            ao = e.effects.setMode(am, aj.mode || "show"),
            ai = ao === "show",
            al = aj.direction || "left",
            ah = (al === "up" || al === "down") ? "top" : "left",
            af = (al === "up" || al === "left"),
            ak, ae = {};
        e.effects.save(am, an);
        am.show();
        ak = aj.distance || am[ah === "top" ? "outerHeight" : "outerWidth"](true);
        e.effects.createWrapper(am).css({ overflow: "hidden" }); if (ai) { am.css(ah, af ? (isNaN(ak) ? "-" + ak : -ak) : ak) } ae[ah] = (ai ? (af ? "+=" : "-=") : (af ? "-=" : "+=")) + ak;
        am.animate(ae, { queue: false, duration: aj.duration, easing: aj.easing, complete: function() { if (ao === "hide") { am.hide() } e.effects.restore(am, an);
                e.effects.removeWrapper(am);
                ag() } }) }; var G = e.effects.effect.transfer = function(aj, ah) { var af = e(this),
            ap = e(aj.to),
            ak = ap.css("position") === "fixed",
            ag = e("body"),
            al = ak ? ag.scrollTop() : 0,
            ae = ak ? ag.scrollLeft() : 0,
            ao = ap.offset(),
            an = { top: ao.top - al, left: ao.left - ae, height: ap.innerHeight(), width: ap.innerWidth() },
            am = af.offset(),
            ai = e("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(aj.className).css({ top: am.top - al, left: am.left - ae, height: af.innerHeight(), width: af.innerWidth(), position: ak ? "fixed" : "absolute" }).animate(an, aj.duration, aj.easing, function() { ai.remove();
                ah() }) }; var J = e.widget("ui.progressbar", { version: "1.11.2", options: { max: 100, value: 0, change: null, complete: null }, min: 0, _create: function() { this.oldValue = this.options.value = this._constrainedValue();
            this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({ role: "progressbar", "aria-valuemin": this.min });
            this.valueDiv = e("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element);
            this._refreshValue() }, _destroy: function() { this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
            this.valueDiv.remove() }, value: function(ae) { if (ae === undefined) { return this.options.value } this.options.value = this._constrainedValue(ae);
            this._refreshValue() }, _constrainedValue: function(ae) { if (ae === undefined) { ae = this.options.value } this.indeterminate = ae === false; if (typeof ae !== "number") { ae = 0 } return this.indeterminate ? false : Math.min(this.options.max, Math.max(this.min, ae)) }, _setOptions: function(ae) { var af = ae.value;
            delete ae.value;
            this._super(ae);
            this.options.value = this._constrainedValue(af);
            this._refreshValue() }, _setOption: function(ae, af) { if (ae === "max") { af = Math.max(this.min, af) } if (ae === "disabled") { this.element.toggleClass("ui-state-disabled", !!af).attr("aria-disabled", af) } this._super(ae, af) }, _percentage: function() { return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min) }, _refreshValue: function() { var af = this.options.value,
                ae = this._percentage();
            this.valueDiv.toggle(this.indeterminate || af > this.min).toggleClass("ui-corner-right", af === this.options.max).width(ae.toFixed(0) + "%");
            this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate); if (this.indeterminate) { this.element.removeAttr("aria-valuenow"); if (!this.overlayDiv) { this.overlayDiv = e("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv) } } else { this.element.attr({ "aria-valuemax": this.options.max, "aria-valuenow": af }); if (this.overlayDiv) { this.overlayDiv.remove();
                    this.overlayDiv = null } } if (this.oldValue !== af) { this.oldValue = af;
                this._trigger("change") } if (af === this.options.max) { this._trigger("complete") } } }); var R = e.widget("ui.selectable", e.ui.mouse, { version: "1.11.2", options: { appendTo: "body", autoRefresh: true, distance: 0, filter: "*", tolerance: "touch", selected: null, selecting: null, start: null, stop: null, unselected: null, unselecting: null }, _create: function() { var ae, af = this;
            this.element.addClass("ui-selectable");
            this.dragged = false;
            this.refresh = function() { ae = e(af.options.filter, af.element[0]);
                ae.addClass("ui-selectee");
                ae.each(function() { var ah = e(this),
                        ag = ah.offset();
                    e.data(this, "selectable-item", { element: this, $element: ah, left: ag.left, top: ag.top, right: ag.left + ah.outerWidth(), bottom: ag.top + ah.outerHeight(), startselected: false, selected: ah.hasClass("ui-selected"), selecting: ah.hasClass("ui-selecting"), unselecting: ah.hasClass("ui-unselecting") }) }) };
            this.refresh();
            this.selectees = ae.addClass("ui-selectee");
            this._mouseInit();
            this.helper = e("<div class='ui-selectable-helper'></div>") }, _destroy: function() { this.selectees.removeClass("ui-selectee").removeData("selectable-item");
            this.element.removeClass("ui-selectable ui-selectable-disabled");
            this._mouseDestroy() }, _mouseStart: function(af) { var ae = this,
                ag = this.options;
            this.opos = [af.pageX, af.pageY]; if (this.options.disabled) { return } this.selectees = e(ag.filter, this.element[0]);
            this._trigger("start", af);
            e(ag.appendTo).append(this.helper);
            this.helper.css({ left: af.pageX, top: af.pageY, width: 0, height: 0 }); if (ag.autoRefresh) { this.refresh() } this.selectees.filter(".ui-selected").each(function() { var ah = e.data(this, "selectable-item");
                ah.startselected = true; if (!af.metaKey && !af.ctrlKey) { ah.$element.removeClass("ui-selected");
                    ah.selected = false;
                    ah.$element.addClass("ui-unselecting");
                    ah.unselecting = true;
                    ae._trigger("unselecting", af, { unselecting: ah.element }) } });
            e(af.target).parents().addBack().each(function() { var ai, ah = e.data(this, "selectable-item"); if (ah) { ai = (!af.metaKey && !af.ctrlKey) || !ah.$element.hasClass("ui-selected");
                    ah.$element.removeClass(ai ? "ui-unselecting" : "ui-selected").addClass(ai ? "ui-selecting" : "ui-unselecting");
                    ah.unselecting = !ai;
                    ah.selecting = ai;
                    ah.selected = ai; if (ai) { ae._trigger("selecting", af, { selecting: ah.element }) } else { ae._trigger("unselecting", af, { unselecting: ah.element }) } return false } }) }, _mouseDrag: function(ak) { this.dragged = true; if (this.options.disabled) { return } var ai, aj = this,
                af = this.options,
                ae = this.opos[0],
                al = this.opos[1],
                ah = ak.pageX,
                ag = ak.pageY; if (ae > ah) { ai = ah;
                ah = ae;
                ae = ai } if (al > ag) { ai = ag;
                ag = al;
                al = ai } this.helper.css({ left: ae, top: al, width: ah - ae, height: ag - al });
            this.selectees.each(function() { var an = e.data(this, "selectable-item"),
                    am = false; if (!an || an.element === aj.element[0]) { return } if (af.tolerance === "touch") { am = (!(an.left > ah || an.right < ae || an.top > ag || an.bottom < al)) } else { if (af.tolerance === "fit") { am = (an.left > ae && an.right < ah && an.top > al && an.bottom < ag) } } if (am) { if (an.selected) { an.$element.removeClass("ui-selected");
                        an.selected = false } if (an.unselecting) { an.$element.removeClass("ui-unselecting");
                        an.unselecting = false } if (!an.selecting) { an.$element.addClass("ui-selecting");
                        an.selecting = true;
                        aj._trigger("selecting", ak, { selecting: an.element }) } } else { if (an.selecting) { if ((ak.metaKey || ak.ctrlKey) && an.startselected) { an.$element.removeClass("ui-selecting");
                            an.selecting = false;
                            an.$element.addClass("ui-selected");
                            an.selected = true } else { an.$element.removeClass("ui-selecting");
                            an.selecting = false; if (an.startselected) { an.$element.addClass("ui-unselecting");
                                an.unselecting = true } aj._trigger("unselecting", ak, { unselecting: an.element }) } } if (an.selected) { if (!ak.metaKey && !ak.ctrlKey && !an.startselected) { an.$element.removeClass("ui-selected");
                            an.selected = false;
                            an.$element.addClass("ui-unselecting");
                            an.unselecting = true;
                            aj._trigger("unselecting", ak, { unselecting: an.element }) } } } }); return false }, _mouseStop: function(ae) { var af = this;
            this.dragged = false;
            e(".ui-unselecting", this.element[0]).each(function() { var ag = e.data(this, "selectable-item");
                ag.$element.removeClass("ui-unselecting");
                ag.unselecting = false;
                ag.startselected = false;
                af._trigger("unselected", ae, { unselected: ag.element }) });
            e(".ui-selecting", this.element[0]).each(function() { var ag = e.data(this, "selectable-item");
                ag.$element.removeClass("ui-selecting").addClass("ui-selected");
                ag.selecting = false;
                ag.selected = true;
                ag.startselected = true;
                af._trigger("selected", ae, { selected: ag.element }) });
            this._trigger("stop", ae);
            this.helper.remove(); return false } }); var ac = e.widget("ui.selectmenu", { version: "1.11.2", defaultElement: "<select>", options: { appendTo: null, disabled: null, icons: { button: "ui-icon-triangle-1-s" }, position: { my: "left top", at: "left bottom", collision: "none" }, width: null, change: null, close: null, focus: null, open: null, select: null }, _create: function() { var ae = this.element.uniqueId().attr("id");
            this.ids = { element: ae, button: ae + "-button", menu: ae + "-menu" };
            this._drawButton();
            this._drawMenu(); if (this.options.disabled) { this.disable() } }, _drawButton: function() { var ae = this,
                af = this.element.attr("tabindex");
            this.label = e("label[for='" + this.ids.element + "']").attr("for", this.ids.button);
            this._on(this.label, { click: function(ag) { this.button.focus();
                    ag.preventDefault() } });
            this.element.hide();
            this.button = e("<span>", { "class": "ui-selectmenu-button ui-widget ui-state-default ui-corner-all", tabindex: af || this.options.disabled ? -1 : 0, id: this.ids.button, role: "combobox", "aria-expanded": "false", "aria-autocomplete": "list", "aria-owns": this.ids.menu, "aria-haspopup": "true" }).insertAfter(this.element);
            e("<span>", { "class": "ui-icon " + this.options.icons.button }).prependTo(this.button);
            this.buttonText = e("<span>", { "class": "ui-selectmenu-text" }).appendTo(this.button);
            this._setText(this.buttonText, this.element.find("option:selected").text());
            this._resizeButton();
            this._on(this.button, this._buttonEvents);
            this.button.one("focusin", function() { if (!ae.menuItems) { ae._refreshMenu() } });
            this._hoverable(this.button);
            this._focusable(this.button) }, _drawMenu: function() { var ae = this;
            this.menu = e("<ul>", { "aria-hidden": "true", "aria-labelledby": this.ids.button, id: this.ids.menu });
            this.menuWrap = e("<div>", { "class": "ui-selectmenu-menu ui-front" }).append(this.menu).appendTo(this._appendTo());
            this.menuInstance = this.menu.menu({ role: "listbox", select: function(ag, af) { ag.preventDefault();
                    ae._setSelection();
                    ae._select(af.item.data("ui-selectmenu-item"), ag) }, focus: function(ag, af) { var ah = af.item.data("ui-selectmenu-item"); if (ae.focusIndex != null && ah.index !== ae.focusIndex) { ae._trigger("focus", ag, { item: ah }); if (!ae.isOpen) { ae._select(ah, ag) } } ae.focusIndex = ah.index;
                    ae.button.attr("aria-activedescendant", ae.menuItems.eq(ah.index).attr("id")) } }).menu("instance");
            this.menu.addClass("ui-corner-bottom").removeClass("ui-corner-all");
            this.menuInstance._off(this.menu, "mouseleave");
            this.menuInstance._closeOnDocumentClick = function() { return false };
            this.menuInstance._isDivider = function() { return false } }, refresh: function() { this._refreshMenu();
            this._setText(this.buttonText, this._getSelectedItem().text()); if (!this.options.width) { this._resizeButton() } }, _refreshMenu: function() { this.menu.empty(); var ae, af = this.element.find("option"); if (!af.length) { return } this._parseOptions(af);
            this._renderMenu(this.menu, this.items);
            this.menuInstance.refresh();
            this.menuItems = this.menu.find("li").not(".ui-selectmenu-optgroup");
            ae = this._getSelectedItem();
            this.menuInstance.focus(null, ae);
            this._setAria(ae.data("ui-selectmenu-item"));
            this._setOption("disabled", this.element.prop("disabled")) }, open: function(ae) { if (this.options.disabled) { return } if (!this.menuItems) { this._refreshMenu() } else { this.menu.find(".ui-state-focus").removeClass("ui-state-focus");
                this.menuInstance.focus(null, this._getSelectedItem()) } this.isOpen = true;
            this._toggleAttr();
            this._resizeMenu();
            this._position();
            this._on(this.document, this._documentClick);
            this._trigger("open", ae) }, _position: function() { this.menuWrap.position(e.extend({ of: this.button }, this.options.position)) }, close: function(ae) { if (!this.isOpen) { return } this.isOpen = false;
            this._toggleAttr();
            this.range = null;
            this._off(this.document);
            this._trigger("close", ae) }, widget: function() { return this.button }, menuWidget: function() { return this.menu }, _renderMenu: function(af, ah) { var ae = this,
                ag = "";
            e.each(ah, function(aj, ai) { if (ai.optgroup !== ag) { e("<li>", { "class": "ui-selectmenu-optgroup ui-menu-divider" + (ai.element.parent("optgroup").prop("disabled") ? " ui-state-disabled" : ""), text: ai.optgroup }).appendTo(af);
                    ag = ai.optgroup } ae._renderItemData(af, ai) }) }, _renderItemData: function(ae, af) { return this._renderItem(ae, af).data("ui-selectmenu-item", af) }, _renderItem: function(ae, ag) { var af = e("<li>"); if (ag.disabled) { af.addClass("ui-state-disabled") } this._setText(af, ag.label); return af.appendTo(ae) }, _setText: function(ae, af) { if (af) { ae.text(af) } else { ae.html("&#160;") } }, _move: function(af, ag) { var ah, ai, ae = ".ui-menu-item"; if (this.isOpen) { ah = this.menuItems.eq(this.focusIndex) } else { ah = this.menuItems.eq(this.element[0].selectedIndex);
                ae += ":not(.ui-state-disabled)" } if (af === "first" || af === "last") { ai = ah[af === "first" ? "prevAll" : "nextAll"](ae).eq(-1) } else { ai = ah[af + "All"](ae).eq(0) } if (ai.length) { this.menuInstance.focus(ag, ai) } }, _getSelectedItem: function() { return this.menuItems.eq(this.element[0].selectedIndex) }, _toggle: function(ae) { this[this.isOpen ? "close" : "open"](ae) }, _setSelection: function() { var ae; if (!this.range) { return } if (window.getSelection) { ae = window.getSelection();
                ae.removeAllRanges();
                ae.addRange(this.range) } else { this.range.select() } this.button.focus() }, _documentClick: { mousedown: function(ae) { if (!this.isOpen) { return } if (!e(ae.target).closest(".ui-selectmenu-menu, #" + this.ids.button).length) { this.close(ae) } } }, _buttonEvents: { mousedown: function() { var ae; if (window.getSelection) { ae = window.getSelection(); if (ae.rangeCount) { this.range = ae.getRangeAt(0) } } else { this.range = document.selection.createRange() } }, click: function(ae) { this._setSelection();
                this._toggle(ae) }, keydown: function(ae) { var af = true; switch (ae.keyCode) {
                    case e.ui.keyCode.TAB:
                    case e.ui.keyCode.ESCAPE:
                        this.close(ae);
                        af = false; break;
                    case e.ui.keyCode.ENTER:
                        if (this.isOpen) { this._selectFocusedItem(ae) } break;
                    case e.ui.keyCode.UP:
                        if (ae.altKey) { this._toggle(ae) } else { this._move("prev", ae) } break;
                    case e.ui.keyCode.DOWN:
                        if (ae.altKey) { this._toggle(ae) } else { this._move("next", ae) } break;
                    case e.ui.keyCode.SPACE:
                        if (this.isOpen) { this._selectFocusedItem(ae) } else { this._toggle(ae) } break;
                    case e.ui.keyCode.LEFT:
                        this._move("prev", ae); break;
                    case e.ui.keyCode.RIGHT:
                        this._move("next", ae); break;
                    case e.ui.keyCode.HOME:
                    case e.ui.keyCode.PAGE_UP:
                        this._move("first", ae); break;
                    case e.ui.keyCode.END:
                    case e.ui.keyCode.PAGE_DOWN:
                        this._move("last", ae); break;
                    default:
                        this.menu.trigger(ae);
                        af = false } if (af) { ae.preventDefault() } } }, _selectFocusedItem: function(af) { var ae = this.menuItems.eq(this.focusIndex); if (!ae.hasClass("ui-state-disabled")) { this._select(ae.data("ui-selectmenu-item"), af) } }, _select: function(ag, af) { var ae = this.element[0].selectedIndex;
            this.element[0].selectedIndex = ag.index;
            this._setText(this.buttonText, ag.label);
            this._setAria(ag);
            this._trigger("select", af, { item: ag }); if (ag.index !== ae) { this._trigger("change", af, { item: ag }) } this.close(af) }, _setAria: function(af) { var ae = this.menuItems.eq(af.index).attr("id");
            this.button.attr({ "aria-labelledby": ae, "aria-activedescendant": ae });
            this.menu.attr("aria-activedescendant", ae) }, _setOption: function(ae, af) { if (ae === "icons") { this.button.find("span.ui-icon").removeClass(this.options.icons.button).addClass(af.button) } this._super(ae, af); if (ae === "appendTo") { this.menuWrap.appendTo(this._appendTo()) } if (ae === "disabled") { this.menuInstance.option("disabled", af);
                this.button.toggleClass("ui-state-disabled", af).attr("aria-disabled", af);
                this.element.prop("disabled", af); if (af) { this.button.attr("tabindex", -1);
                    this.close() } else { this.button.attr("tabindex", 0) } } if (ae === "width") { this._resizeButton() } }, _appendTo: function() { var ae = this.options.appendTo; if (ae) { ae = ae.jquery || ae.nodeType ? e(ae) : this.document.find(ae).eq(0) } if (!ae || !ae[0]) { ae = this.element.closest(".ui-front") } if (!ae.length) { ae = this.document[0].body } return ae }, _toggleAttr: function() { this.button.toggleClass("ui-corner-top", this.isOpen).toggleClass("ui-corner-all", !this.isOpen).attr("aria-expanded", this.isOpen);
            this.menuWrap.toggleClass("ui-selectmenu-open", this.isOpen);
            this.menu.attr("aria-hidden", !this.isOpen) }, _resizeButton: function() { var ae = this.options.width; if (!ae) { ae = this.element.show().outerWidth();
                this.element.hide() } this.button.outerWidth(ae) }, _resizeMenu: function() { this.menu.outerWidth(Math.max(this.button.outerWidth(), this.menu.width("").outerWidth() + 1)) }, _getCreateOptions: function() { return { disabled: this.element.prop("disabled") } }, _parseOptions: function(af) { var ae = [];
            af.each(function(ai, aj) { var ah = e(aj),
                    ag = ah.parent("optgroup");
                ae.push({ element: ah, index: ai, value: ah.attr("value"), label: ah.text(), optgroup: ag.attr("label") || "", disabled: ag.prop("disabled") || ah.prop("disabled") }) });
            this.items = ae }, _destroy: function() { this.menuWrap.remove();
            this.button.remove();
            this.element.show();
            this.element.removeUniqueId();
            this.label.attr("for", this.ids.element) } }); var h = e.widget("ui.slider", e.ui.mouse, { version: "1.11.2", widgetEventPrefix: "slide", options: { animate: false, distance: 0, max: 100, min: 0, orientation: "horizontal", range: false, step: 1, value: 0, values: null, change: null, slide: null, start: null, stop: null }, numPages: 5, _create: function() { this._keySliding = false;
            this._mouseSliding = false;
            this._animateOff = true;
            this._handleIndex = null;
            this._detectOrientation();
            this._mouseInit();
            this._calculateNewMax();
            this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all");
            this._refresh();
            this._setOption("disabled", this.options.disabled);
            this._animateOff = false }, _refresh: function() { this._createRange();
            this._createHandles();
            this._setupEvents();
            this._refreshValue() }, _createHandles: function() { var ae, ai, af = this.options,
                ah = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                ag = "<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",
                aj = [];
            ai = (af.values && af.values.length) || 1; if (ah.length > ai) { ah.slice(ai).remove();
                ah = ah.slice(0, ai) } for (ae = ah.length; ae < ai; ae++) { aj.push(ag) } this.handles = ah.add(e(aj.join("")).appendTo(this.element));
            this.handle = this.handles.eq(0);
            this.handles.each(function(ak) { e(this).data("ui-slider-handle-index", ak) }) }, _createRange: function() { var af = this.options,
                ae = ""; if (af.range) { if (af.range === true) { if (!af.values) { af.values = [this._valueMin(), this._valueMin()] } else { if (af.values.length && af.values.length !== 2) { af.values = [af.values[0], af.values[0]] } else { if (e.isArray(af.values)) { af.values = af.values.slice(0) } } } } if (!this.range || !this.range.length) { this.range = e("<div></div>").appendTo(this.element);
                    ae = "ui-slider-range ui-widget-header ui-corner-all" } else { this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({ left: "", bottom: "" }) } this.range.addClass(ae + ((af.range === "min" || af.range === "max") ? " ui-slider-range-" + af.range : "")) } else { if (this.range) { this.range.remove() } this.range = null } }, _setupEvents: function() { this._off(this.handles);
            this._on(this.handles, this._handleEvents);
            this._hoverable(this.handles);
            this._focusable(this.handles) }, _destroy: function() { this.handles.remove(); if (this.range) { this.range.remove() } this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all");
            this._mouseDestroy() }, _mouseCapture: function(am) { var ao, ak, aj, al, ah, an, ai, af, ag = this,
                ae = this.options; if (ae.disabled) { return false } this.elementSize = { width: this.element.outerWidth(), height: this.element.outerHeight() };
            this.elementOffset = this.element.offset();
            ao = { x: am.pageX, y: am.pageY };
            ak = this._normValueFromMouse(ao);
            aj = this._valueMax() - this._valueMin() + 1;
            this.handles.each(function(aq) { var ap = Math.abs(ak - ag.values(aq)); if ((aj > ap) || (aj === ap && (aq === ag._lastChangedValue || ag.values(aq) === ae.min))) { aj = ap;
                    al = e(this);
                    ah = aq } });
            an = this._start(am, ah); if (an === false) { return false } this._mouseSliding = true;
            this._handleIndex = ah;
            al.addClass("ui-state-active").focus();
            ai = al.offset();
            af = !e(am.target).parents().addBack().is(".ui-slider-handle");
            this._clickOffset = af ? { left: 0, top: 0 } : { left: am.pageX - ai.left - (al.width() / 2), top: am.pageY - ai.top - (al.height() / 2) - (parseInt(al.css("borderTopWidth"), 10) || 0) - (parseInt(al.css("borderBottomWidth"), 10) || 0) + (parseInt(al.css("marginTop"), 10) || 0) }; if (!this.handles.hasClass("ui-state-hover")) { this._slide(am, ah, ak) } this._animateOff = true; return true }, _mouseStart: function() { return true }, _mouseDrag: function(af) { var ae = { x: af.pageX, y: af.pageY },
                ag = this._normValueFromMouse(ae);
            this._slide(af, this._handleIndex, ag); return false }, _mouseStop: function(ae) { this.handles.removeClass("ui-state-active");
            this._mouseSliding = false;
            this._stop(ae, this._handleIndex);
            this._change(ae, this._handleIndex);
            this._handleIndex = null;
            this._clickOffset = null;
            this._animateOff = false; return false }, _detectOrientation: function() { this.orientation = (this.options.orientation === "vertical") ? "vertical" : "horizontal" }, _normValueFromMouse: function(ag) { var ah, aj, ai, af, ae; if (this.orientation === "horizontal") { ah = this.elementSize.width;
                aj = ag.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0) } else { ah = this.elementSize.height;
                aj = ag.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0) } ai = (aj / ah); if (ai > 1) { ai = 1 } if (ai < 0) { ai = 0 } if (this.orientation === "vertical") { ai = 1 - ai } af = this._valueMax() - this._valueMin();
            ae = this._valueMin() + ai * af; return this._trimAlignValue(ae) }, _start: function(ag, ae) { var af = { handle: this.handles[ae], value: this.value() }; if (this.options.values && this.options.values.length) { af.value = this.values(ae);
                af.values = this.values() } return this._trigger("start", ag, af) }, _slide: function(ah, aj, af) { var ae, ag, ai; if (this.options.values && this.options.values.length) { ae = this.values(aj ? 0 : 1); if ((this.options.values.length === 2 && this.options.range === true) && ((aj === 0 && af > ae) || (aj === 1 && af < ae))) { af = ae } if (af !== this.values(aj)) { ag = this.values();
                    ag[aj] = af;
                    ai = this._trigger("slide", ah, { handle: this.handles[aj], value: af, values: ag });
                    ae = this.values(aj ? 0 : 1); if (ai !== false) { this.values(aj, af) } } } else { if (af !== this.value()) { ai = this._trigger("slide", ah, { handle: this.handles[aj], value: af }); if (ai !== false) { this.value(af) } } } }, _stop: function(ag, ae) { var af = { handle: this.handles[ae], value: this.value() }; if (this.options.values && this.options.values.length) { af.value = this.values(ae);
                af.values = this.values() } this._trigger("stop", ag, af) }, _change: function(ag, ae) { if (!this._keySliding && !this._mouseSliding) { var af = { handle: this.handles[ae], value: this.value() }; if (this.options.values && this.options.values.length) { af.value = this.values(ae);
                    af.values = this.values() } this._lastChangedValue = ae;
                this._trigger("change", ag, af) } }, value: function(ae) { if (arguments.length) { this.options.value = this._trimAlignValue(ae);
                this._refreshValue();
                this._change(null, 0); return } return this._value() }, values: function(ah, ag) { var af, ae, ai; if (arguments.length > 1) { this.options.values[ah] = this._trimAlignValue(ag);
                this._refreshValue();
                this._change(null, ah); return } if (arguments.length) { if (e.isArray(arguments[0])) { af = this.options.values;
                    ae = arguments[0]; for (ai = 0; ai < af.length; ai += 1) { af[ai] = this._trimAlignValue(ae[ai]);
                        this._change(null, ai) } this._refreshValue() } else { if (this.options.values && this.options.values.length) { return this._values(ah) } else { return this.value() } } } else { return this._values() } }, _setOption: function(ah, ae) { var af, ag = 0; if (ah === "range" && this.options.range === true) { if (ae === "min") { this.options.value = this._values(0);
                    this.options.values = null } else { if (ae === "max") { this.options.value = this._values(this.options.values.length - 1);
                        this.options.values = null } } } if (e.isArray(this.options.values)) { ag = this.options.values.length } if (ah === "disabled") { this.element.toggleClass("ui-state-disabled", !!ae) } this._super(ah, ae); switch (ah) {
                case "orientation":
                    this._detectOrientation();
                    this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation);
                    this._refreshValue();
                    this.handles.css(ae === "horizontal" ? "bottom" : "left", ""); break;
                case "value":
                    this._animateOff = true;
                    this._refreshValue();
                    this._change(null, 0);
                    this._animateOff = false; break;
                case "values":
                    this._animateOff = true;
                    this._refreshValue(); for (af = 0; af < ag; af += 1) { this._change(null, af) } this._animateOff = false; break;
                case "step":
                case "min":
                case "max":
                    this._animateOff = true;
                    this._calculateNewMax();
                    this._refreshValue();
                    this._animateOff = false; break;
                case "range":
                    this._animateOff = true;
                    this._refresh();
                    this._animateOff = false; break } }, _value: function() { var ae = this.options.value;
            ae = this._trimAlignValue(ae); return ae }, _values: function(ah) { var ae, ag, af; if (arguments.length) { ae = this.options.values[ah];
                ae = this._trimAlignValue(ae); return ae } else { if (this.options.values && this.options.values.length) { ag = this.options.values.slice(); for (af = 0; af < ag.length; af += 1) { ag[af] = this._trimAlignValue(ag[af]) } return ag } else { return [] } } }, _trimAlignValue: function(af) { if (af <= this._valueMin()) { return this._valueMin() } if (af >= this._valueMax()) { return this._valueMax() } var ag = (this.options.step > 0) ? this.options.step : 1,
                ae = (af - this._valueMin()) % ag,
                ah = af - ae; if (Math.abs(ae) * 2 >= ag) { ah += (ae > 0) ? ag : (-ag) } return parseFloat(ah.toFixed(5)) }, _calculateNewMax: function() { var ae = (this.options.max - this._valueMin()) % this.options.step;
            this.max = this.options.max - ae }, _valueMin: function() { return this.options.min }, _valueMax: function() { return this.max }, _refreshValue: function() { var am, al, ae, an, ah, aj = this.options.range,
                ai = this.options,
                ag = this,
                ak = (!this._animateOff) ? ai.animate : false,
                af = {}; if (this.options.values && this.options.values.length) { this.handles.each(function(ao) { al = (ag.values(ao) - ag._valueMin()) / (ag._valueMax() - ag._valueMin()) * 100;
                    af[ag.orientation === "horizontal" ? "left" : "bottom"] = al + "%";
                    e(this).stop(1, 1)[ak ? "animate" : "css"](af, ai.animate); if (ag.options.range === true) { if (ag.orientation === "horizontal") { if (ao === 0) { ag.range.stop(1, 1)[ak ? "animate" : "css"]({ left: al + "%" }, ai.animate) } if (ao === 1) { ag.range[ak ? "animate" : "css"]({ width: (al - am) + "%" }, { queue: false, duration: ai.animate }) } } else { if (ao === 0) { ag.range.stop(1, 1)[ak ? "animate" : "css"]({ bottom: (al) + "%" }, ai.animate) } if (ao === 1) { ag.range[ak ? "animate" : "css"]({ height: (al - am) + "%" }, { queue: false, duration: ai.animate }) } } } am = al }) } else { ae = this.value();
                an = this._valueMin();
                ah = this._valueMax();
                al = (ah !== an) ? (ae - an) / (ah - an) * 100 : 0;
                af[this.orientation === "horizontal" ? "left" : "bottom"] = al + "%";
                this.handle.stop(1, 1)[ak ? "animate" : "css"](af, ai.animate); if (aj === "min" && this.orientation === "horizontal") { this.range.stop(1, 1)[ak ? "animate" : "css"]({ width: al + "%" }, ai.animate) } if (aj === "max" && this.orientation === "horizontal") { this.range[ak ? "animate" : "css"]({ width: (100 - al) + "%" }, { queue: false, duration: ai.animate }) } if (aj === "min" && this.orientation === "vertical") { this.range.stop(1, 1)[ak ? "animate" : "css"]({ height: al + "%" }, ai.animate) } if (aj === "max" && this.orientation === "vertical") { this.range[ak ? "animate" : "css"]({ height: (100 - al) + "%" }, { queue: false, duration: ai.animate }) } } }, _handleEvents: { keydown: function(ah) { var ai, aj, ag, ae, af = e(ah.target).data("ui-slider-handle-index"); switch (ah.keyCode) {
                    case e.ui.keyCode.HOME:
                    case e.ui.keyCode.END:
                    case e.ui.keyCode.PAGE_UP:
                    case e.ui.keyCode.PAGE_DOWN:
                    case e.ui.keyCode.UP:
                    case e.ui.keyCode.RIGHT:
                    case e.ui.keyCode.DOWN:
                    case e.ui.keyCode.LEFT:
                        ah.preventDefault(); if (!this._keySliding) { this._keySliding = true;
                            e(ah.target).addClass("ui-state-active");
                            ai = this._start(ah, af); if (ai === false) { return } } break } ae = this.options.step; if (this.options.values && this.options.values.length) { aj = ag = this.values(af) } else { aj = ag = this.value() } switch (ah.keyCode) {
                    case e.ui.keyCode.HOME:
                        ag = this._valueMin(); break;
                    case e.ui.keyCode.END:
                        ag = this._valueMax(); break;
                    case e.ui.keyCode.PAGE_UP:
                        ag = this._trimAlignValue(aj + ((this._valueMax() - this._valueMin()) / this.numPages)); break;
                    case e.ui.keyCode.PAGE_DOWN:
                        ag = this._trimAlignValue(aj - ((this._valueMax() - this._valueMin()) / this.numPages)); break;
                    case e.ui.keyCode.UP:
                    case e.ui.keyCode.RIGHT:
                        if (aj === this._valueMax()) { return } ag = this._trimAlignValue(aj + ae); break;
                    case e.ui.keyCode.DOWN:
                    case e.ui.keyCode.LEFT:
                        if (aj === this._valueMin()) { return } ag = this._trimAlignValue(aj - ae); break } this._slide(ah, af, ag) }, keyup: function(ae) { var af = e(ae.target).data("ui-slider-handle-index"); if (this._keySliding) { this._keySliding = false;
                    this._stop(ae, af);
                    this._change(ae, af);
                    e(ae.target).removeClass("ui-state-active") } } } }); var N = e.widget("ui.sortable", e.ui.mouse, { version: "1.11.2", widgetEventPrefix: "sort", ready: false, options: { appendTo: "parent", axis: false, connectWith: false, containment: false, cursor: "auto", cursorAt: false, dropOnEmpty: true, forcePlaceholderSize: false, forceHelperSize: false, grid: false, handle: false, helper: "original", items: "> *", opacity: false, placeholder: false, revert: false, scroll: true, scrollSensitivity: 20, scrollSpeed: 20, scope: "default", tolerance: "intersect", zIndex: 1000, activate: null, beforeStop: null, change: null, deactivate: null, out: null, over: null, receive: null, remove: null, sort: null, start: null, stop: null, update: null }, _isOverAxis: function(ag, ae, af) { return (ag >= ae) && (ag < (ae + af)) }, _isFloating: function(ae) { return (/left|right/).test(ae.css("float")) || (/inline|table-cell/).test(ae.css("display")) }, _create: function() { var ae = this.options;
            this.containerCache = {};
            this.element.addClass("ui-sortable");
            this.refresh();
            this.floating = this.items.length ? ae.axis === "x" || this._isFloating(this.items[0].item) : false;
            this.offset = this.element.offset();
            this._mouseInit();
            this._setHandleClassName();
            this.ready = true }, _setOption: function(ae, af) { this._super(ae, af); if (ae === "handle") { this._setHandleClassName() } }, _setHandleClassName: function() { this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle");
            e.each(this.items, function() {
                (this.instance.options.handle ? this.item.find(this.instance.options.handle) : this.item).addClass("ui-sortable-handle") }) }, _destroy: function() { this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle");
            this._mouseDestroy(); for (var ae = this.items.length - 1; ae >= 0; ae--) { this.items[ae].item.removeData(this.widgetName + "-item") } return this }, _mouseCapture: function(ag, ai) { var ae = null,
                ah = false,
                af = this; if (this.reverting) { return false } if (this.options.disabled || this.options.type === "static") { return false } this._refreshItems(ag);
            e(ag.target).parents().each(function() { if (e.data(this, af.widgetName + "-item") === af) { ae = e(this); return false } }); if (e.data(ag.target, af.widgetName + "-item") === af) { ae = e(ag.target) } if (!ae) { return false } if (this.options.handle && !ai) { e(this.options.handle, ae).find("*").addBack().each(function() { if (this === ag.target) { ah = true } }); if (!ah) { return false } } this.currentItem = ae;
            this._removeCurrentsFromItems(); return true }, _mouseStart: function(ai, ah, aj) { var ae, af, ag = this.options;
            this.currentContainer = this;
            this.refreshPositions();
            this.helper = this._createHelper(ai);
            this._cacheHelperProportions();
            this._cacheMargins();
            this.scrollParent = this.helper.scrollParent();
            this.offset = this.currentItem.offset();
            this.offset = { top: this.offset.top - this.margins.top, left: this.offset.left - this.margins.left };
            e.extend(this.offset, { click: { left: ai.pageX - this.offset.left, top: ai.pageY - this.offset.top }, parent: this._getParentOffset(), relative: this._getRelativeOffset() });
            this.helper.css("position", "absolute");
            this.cssPosition = this.helper.css("position");
            this.originalPosition = this._generatePosition(ai);
            this.originalPageX = ai.pageX;
            this.originalPageY = ai.pageY;
            (ag.cursorAt && this._adjustOffsetFromHelper(ag.cursorAt));
            this.domPosition = { prev: this.currentItem.prev()[0], parent: this.currentItem.parent()[0] }; if (this.helper[0] !== this.currentItem[0]) { this.currentItem.hide() } this._createPlaceholder(); if (ag.containment) { this._setContainment() } if (ag.cursor && ag.cursor !== "auto") { af = this.document.find("body");
                this.storedCursor = af.css("cursor");
                af.css("cursor", ag.cursor);
                this.storedStylesheet = e("<style>*{ cursor: " + ag.cursor + " !important; }</style>").appendTo(af) } if (ag.opacity) { if (this.helper.css("opacity")) { this._storedOpacity = this.helper.css("opacity") } this.helper.css("opacity", ag.opacity) } if (ag.zIndex) { if (this.helper.css("zIndex")) { this._storedZIndex = this.helper.css("zIndex") } this.helper.css("zIndex", ag.zIndex) } if (this.scrollParent[0] !== document && this.scrollParent[0].tagName !== "HTML") { this.overflowOffset = this.scrollParent.offset() } this._trigger("start", ai, this._uiHash()); if (!this._preserveHelperProportions) { this._cacheHelperProportions() } if (!aj) { for (ae = this.containers.length - 1; ae >= 0; ae--) { this.containers[ae]._trigger("activate", ai, this._uiHash(this)) } } if (e.ui.ddmanager) { e.ui.ddmanager.current = this } if (e.ui.ddmanager && !ag.dropBehaviour) { e.ui.ddmanager.prepareOffsets(this, ai) } this.dragging = true;
            this.helper.addClass("ui-sortable-helper");
            this._mouseDrag(ai); return true }, _mouseDrag: function(ai) { var ae, ak, aj, ah, ag = this.options,
                af = false;
            this.position = this._generatePosition(ai);
            this.positionAbs = this._convertPositionTo("absolute"); if (!this.lastPositionAbs) { this.lastPositionAbs = this.positionAbs } if (this.options.scroll) { if (this.scrollParent[0] !== document && this.scrollParent[0].tagName !== "HTML") { if ((this.overflowOffset.top + this.scrollParent[0].offsetHeight) - ai.pageY < ag.scrollSensitivity) { this.scrollParent[0].scrollTop = af = this.scrollParent[0].scrollTop + ag.scrollSpeed } else { if (ai.pageY - this.overflowOffset.top < ag.scrollSensitivity) { this.scrollParent[0].scrollTop = af = this.scrollParent[0].scrollTop - ag.scrollSpeed } } if ((this.overflowOffset.left + this.scrollParent[0].offsetWidth) - ai.pageX < ag.scrollSensitivity) { this.scrollParent[0].scrollLeft = af = this.scrollParent[0].scrollLeft + ag.scrollSpeed } else { if (ai.pageX - this.overflowOffset.left < ag.scrollSensitivity) { this.scrollParent[0].scrollLeft = af = this.scrollParent[0].scrollLeft - ag.scrollSpeed } } } else { if (ai.pageY - e(document).scrollTop() < ag.scrollSensitivity) { af = e(document).scrollTop(e(document).scrollTop() - ag.scrollSpeed) } else { if (e(window).height() - (ai.pageY - e(document).scrollTop()) < ag.scrollSensitivity) { af = e(document).scrollTop(e(document).scrollTop() + ag.scrollSpeed) } } if (ai.pageX - e(document).scrollLeft() < ag.scrollSensitivity) { af = e(document).scrollLeft(e(document).scrollLeft() - ag.scrollSpeed) } else { if (e(window).width() - (ai.pageX - e(document).scrollLeft()) < ag.scrollSensitivity) { af = e(document).scrollLeft(e(document).scrollLeft() + ag.scrollSpeed) } } } if (af !== false && e.ui.ddmanager && !ag.dropBehaviour) { e.ui.ddmanager.prepareOffsets(this, ai) } } this.positionAbs = this._convertPositionTo("absolute"); if (!this.options.axis || this.options.axis !== "y") { this.helper[0].style.left = this.position.left + "px" } if (!this.options.axis || this.options.axis !== "x") { this.helper[0].style.top = this.position.top + "px" } for (ae = this.items.length - 1; ae >= 0; ae--) { ak = this.items[ae];
                aj = ak.item[0];
                ah = this._intersectsWithPointer(ak); if (!ah) { continue } if (ak.instance !== this.currentContainer) { continue } if (aj !== this.currentItem[0] && this.placeholder[ah === 1 ? "next" : "prev"]()[0] !== aj && !e.contains(this.placeholder[0], aj) && (this.options.type === "semi-dynamic" ? !e.contains(this.element[0], aj) : true)) { this.direction = ah === 1 ? "down" : "up"; if (this.options.tolerance === "pointer" || this._intersectsWithSides(ak)) { this._rearrange(ai, ak) } else { break } this._trigger("change", ai, this._uiHash()); break } } this._contactContainers(ai); if (e.ui.ddmanager) { e.ui.ddmanager.drag(this, ai) } this._trigger("sort", ai, this._uiHash());
            this.lastPositionAbs = this.positionAbs; return false }, _mouseStop: function(ai, ah) { if (!ai) { return } if (e.ui.ddmanager && !this.options.dropBehaviour) { e.ui.ddmanager.drop(this, ai) } if (this.options.revert) { var af = this,
                    ag = this.placeholder.offset(),
                    aj = this.options.axis,
                    ae = {}; if (!aj || aj === "x") { ae.left = ag.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft) } if (!aj || aj === "y") { ae.top = ag.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop) } this.reverting = true;
                e(this.helper).animate(ae, parseInt(this.options.revert, 10) || 500, function() { af._clear(ai) }) } else { this._clear(ai, ah) } return false }, cancel: function() { if (this.dragging) { this._mouseUp({ target: null }); if (this.options.helper === "original") { this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") } else { this.currentItem.show() } for (var ae = this.containers.length - 1; ae >= 0; ae--) { this.containers[ae]._trigger("deactivate", null, this._uiHash(this)); if (this.containers[ae].containerCache.over) { this.containers[ae]._trigger("out", null, this._uiHash(this));
                        this.containers[ae].containerCache.over = 0 } } } if (this.placeholder) { if (this.placeholder[0].parentNode) { this.placeholder[0].parentNode.removeChild(this.placeholder[0]) } if (this.options.helper !== "original" && this.helper && this.helper[0].parentNode) { this.helper.remove() } e.extend(this, { helper: null, dragging: false, reverting: false, _noFinalSort: null }); if (this.domPosition.prev) { e(this.domPosition.prev).after(this.currentItem) } else { e(this.domPosition.parent).prepend(this.currentItem) } } return this }, serialize: function(ae) { var ag = this._getItemsAsjQuery(ae && ae.connected),
                af = [];
            ae = ae || {};
            e(ag).each(function() { var ah = (e(ae.item || this).attr(ae.attribute || "id") || "").match(ae.expression || (/(.+)[\-=_](.+)/)); if (ah) { af.push((ae.key || ah[1] + "[]") + "=" + (ae.key && ae.expression ? ah[1] : ah[2])) } }); if (!af.length && ae.key) { af.push(ae.key + "=") } return af.join("&") }, toArray: function(ae) { var ag = this._getItemsAsjQuery(ae && ae.connected),
                af = [];
            ae = ae || {};
            ag.each(function() { af.push(e(ae.item || this).attr(ae.attribute || "id") || "") }); return af }, _intersectsWith: function(ar) { var ag = this.positionAbs.left,
                ak = ag + this.helperProportions.width,
                ah = this.positionAbs.top,
                al = ah + this.helperProportions.height,
                an = ar.left,
                ai = an + ar.width,
                aj = ar.top,
                ap = aj + ar.height,
                ae = this.offset.click.top,
                af = this.offset.click.left,
                aq = (this.options.axis === "x") || ((ah + ae) > aj && (ah + ae) < ap),
                ao = (this.options.axis === "y") || ((ag + af) > an && (ag + af) < ai),
                am = aq && ao; if (this.options.tolerance === "pointer" || this.options.forcePointerForContainers || (this.options.tolerance !== "pointer" && this.helperProportions[this.floating ? "width" : "height"] > ar[this.floating ? "width" : "height"])) { return am } else { return (an < ag + (this.helperProportions.width / 2) && ak - (this.helperProportions.width / 2) < ai && aj < ah + (this.helperProportions.height / 2) && al - (this.helperProportions.height / 2) < ap) } }, _intersectsWithPointer: function(af) { var ai = (this.options.axis === "x") || this._isOverAxis(this.positionAbs.top + this.offset.click.top, af.top, af.height),
                ae = (this.options.axis === "y") || this._isOverAxis(this.positionAbs.left + this.offset.click.left, af.left, af.width),
                ag = ai && ae,
                aj = this._getDragVerticalDirection(),
                ah = this._getDragHorizontalDirection(); if (!ag) { return false } return this.floating ? (((ah && ah === "right") || aj === "down") ? 2 : 1) : (aj && (aj === "down" ? 2 : 1)) }, _intersectsWithSides: function(ah) { var ae = this._isOverAxis(this.positionAbs.top + this.offset.click.top, ah.top + (ah.height / 2), ah.height),
                af = this._isOverAxis(this.positionAbs.left + this.offset.click.left, ah.left + (ah.width / 2), ah.width),
                ag = this._getDragVerticalDirection(),
                ai = this._getDragHorizontalDirection(); if (this.floating && ai) { return ((ai === "right" && af) || (ai === "left" && !af)) } else { return ag && ((ag === "down" && ae) || (ag === "up" && !ae)) } }, _getDragVerticalDirection: function() { var ae = this.positionAbs.top - this.lastPositionAbs.top; return ae !== 0 && (ae > 0 ? "down" : "up") }, _getDragHorizontalDirection: function() { var ae = this.positionAbs.left - this.lastPositionAbs.left; return ae !== 0 && (ae > 0 ? "right" : "left") }, refresh: function(ae) { this._refreshItems(ae);
            this._setHandleClassName();
            this.refreshPositions(); return this }, _connectWith: function() { var ae = this.options; return ae.connectWith.constructor === String ? [ae.connectWith] : ae.connectWith }, _getItemsAsjQuery: function(am) { var ae, af, ai, al, ak = [],
                ah = [],
                aj = this._connectWith(); if (aj && am) { for (ae = aj.length - 1; ae >= 0; ae--) { ai = e(aj[ae]); for (af = ai.length - 1; af >= 0; af--) { al = e.data(ai[af], this.widgetFullName); if (al && al !== this && !al.options.disabled) { ah.push([e.isFunction(al.options.items) ? al.options.items.call(al.element) : e(al.options.items, al.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), al]) } } } } ah.push([e.isFunction(this.options.items) ? this.options.items.call(this.element, null, { options: this.options, item: this.currentItem }) : e(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]);

            function ag() { ak.push(this) } for (ae = ah.length - 1; ae >= 0; ae--) { ah[ae][0].each(ag) } return e(ak) }, _removeCurrentsFromItems: function() { var ae = this.currentItem.find(":data(" + this.widgetName + "-item)");
            this.items = e.grep(this.items, function(af) { for (var ag = 0; ag < ae.length; ag++) { if (ae[ag] === af.item[0]) { return false } } return true }) }, _refreshItems: function(al) { this.items = [];
            this.containers = [this]; var af, ag, ak, ao, ae, an, ap, ah, aj = this.items,
                ai = [
                    [e.isFunction(this.options.items) ? this.options.items.call(this.element[0], al, { item: this.currentItem }) : e(this.options.items, this.element), this]
                ],
                am = this._connectWith(); if (am && this.ready) { for (af = am.length - 1; af >= 0; af--) { ak = e(am[af]); for (ag = ak.length - 1; ag >= 0; ag--) { ao = e.data(ak[ag], this.widgetFullName); if (ao && ao !== this && !ao.options.disabled) { ai.push([e.isFunction(ao.options.items) ? ao.options.items.call(ao.element[0], al, { item: this.currentItem }) : e(ao.options.items, ao.element), ao]);
                            this.containers.push(ao) } } } } for (af = ai.length - 1; af >= 0; af--) { ae = ai[af][1];
                an = ai[af][0]; for (ag = 0, ah = an.length; ag < ah; ag++) { ap = e(an[ag]);
                    ap.data(this.widgetName + "-item", ae);
                    aj.push({ item: ap, instance: ae, width: 0, height: 0, left: 0, top: 0 }) } } }, refreshPositions: function(af) { if (this.offsetParent && this.helper) { this.offset.parent = this._getParentOffset() } var ae, ah, ag, ai; for (ae = this.items.length - 1; ae >= 0; ae--) { ah = this.items[ae]; if (ah.instance !== this.currentContainer && this.currentContainer && ah.item[0] !== this.currentItem[0]) { continue } ag = this.options.toleranceElement ? e(this.options.toleranceElement, ah.item) : ah.item; if (!af) { ah.width = ag.outerWidth();
                    ah.height = ag.outerHeight() } ai = ag.offset();
                ah.left = ai.left;
                ah.top = ai.top } if (this.options.custom && this.options.custom.refreshContainers) { this.options.custom.refreshContainers.call(this) } else { for (ae = this.containers.length - 1; ae >= 0; ae--) { ai = this.containers[ae].element.offset();
                    this.containers[ae].containerCache.left = ai.left;
                    this.containers[ae].containerCache.top = ai.top;
                    this.containers[ae].containerCache.width = this.containers[ae].element.outerWidth();
                    this.containers[ae].containerCache.height = this.containers[ae].element.outerHeight() } } return this }, _createPlaceholder: function(af) { af = af || this; var ag, ae = af.options; if (!ae.placeholder || ae.placeholder.constructor === String) { ag = ae.placeholder;
                ae.placeholder = { element: function() { var ai = af.currentItem[0].nodeName.toLowerCase(),
                            ah = e("<" + ai + ">", af.document[0]).addClass(ag || af.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper"); if (ai === "tr") { af.currentItem.children().each(function() { e("<td>&#160;</td>", af.document[0]).attr("colspan", e(this).attr("colspan") || 1).appendTo(ah) }) } else { if (ai === "img") { ah.attr("src", af.currentItem.attr("src")) } } if (!ag) { ah.css("visibility", "hidden") } return ah }, update: function(ai, ah) { if (ag && !ae.forcePlaceholderSize) { return } if (!ah.height()) { ah.height(af.currentItem.innerHeight() - parseInt(af.currentItem.css("paddingTop") || 0, 10) - parseInt(af.currentItem.css("paddingBottom") || 0, 10)) } if (!ah.width()) { ah.width(af.currentItem.innerWidth() - parseInt(af.currentItem.css("paddingLeft") || 0, 10) - parseInt(af.currentItem.css("paddingRight") || 0, 10)) } } } } af.placeholder = e(ae.placeholder.element.call(af.element, af.currentItem));
            af.currentItem.after(af.placeholder);
            ae.placeholder.update(af, af.placeholder) }, _contactContainers: function(aj) { var am, al, an, ak, ag, ai, aq, ae, ap, ao, ah = null,
                af = null; for (am = this.containers.length - 1; am >= 0; am--) { if (e.contains(this.currentItem[0], this.containers[am].element[0])) { continue } if (this._intersectsWith(this.containers[am].containerCache)) { if (ah && e.contains(this.containers[am].element[0], ah.element[0])) { continue } ah = this.containers[am];
                    af = am } else { if (this.containers[am].containerCache.over) { this.containers[am]._trigger("out", aj, this._uiHash(this));
                        this.containers[am].containerCache.over = 0 } } } if (!ah) { return } if (this.containers.length === 1) { if (!this.containers[af].containerCache.over) { this.containers[af]._trigger("over", aj, this._uiHash(this));
                    this.containers[af].containerCache.over = 1 } } else { an = 10000;
                ak = null;
                ap = ah.floating || this._isFloating(this.currentItem);
                ag = ap ? "left" : "top";
                ai = ap ? "width" : "height";
                ao = ap ? "clientX" : "clientY"; for (al = this.items.length - 1; al >= 0; al--) { if (!e.contains(this.containers[af].element[0], this.items[al].item[0])) { continue } if (this.items[al].item[0] === this.currentItem[0]) { continue } aq = this.items[al].item.offset()[ag];
                    ae = false; if (aj[ao] - aq > this.items[al][ai] / 2) { ae = true } if (Math.abs(aj[ao] - aq) < an) { an = Math.abs(aj[ao] - aq);
                        ak = this.items[al];
                        this.direction = ae ? "up" : "down" } } if (!ak && !this.options.dropOnEmpty) { return } if (this.currentContainer === this.containers[af]) { if (!this.currentContainer.containerCache.over) { this.containers[af]._trigger("over", aj, this._uiHash());
                        this.currentContainer.containerCache.over = 1 } return } ak ? this._rearrange(aj, ak, null, true) : this._rearrange(aj, null, this.containers[af].element, true);
                this._trigger("change", aj, this._uiHash());
                this.containers[af]._trigger("change", aj, this._uiHash(this));
                this.currentContainer = this.containers[af];
                this.options.placeholder.update(this.currentContainer, this.placeholder);
                this.containers[af]._trigger("over", aj, this._uiHash(this));
                this.containers[af].containerCache.over = 1 } }, _createHelper: function(af) { var ae = this.options,
                ag = e.isFunction(ae.helper) ? e(ae.helper.apply(this.element[0], [af, this.currentItem])) : (ae.helper === "clone" ? this.currentItem.clone() : this.currentItem); if (!ag.parents("body").length) { e(ae.appendTo !== "parent" ? ae.appendTo : this.currentItem[0].parentNode)[0].appendChild(ag[0]) } if (ag[0] === this.currentItem[0]) { this._storedCSS = { width: this.currentItem[0].style.width, height: this.currentItem[0].style.height, position: this.currentItem.css("position"), top: this.currentItem.css("top"), left: this.currentItem.css("left") } } if (!ag[0].style.width || ae.forceHelperSize) { ag.width(this.currentItem.width()) } if (!ag[0].style.height || ae.forceHelperSize) { ag.height(this.currentItem.height()) } return ag }, _adjustOffsetFromHelper: function(ae) { if (typeof ae === "string") { ae = ae.split(" ") } if (e.isArray(ae)) { ae = { left: +ae[0], top: +ae[1] || 0 } } if ("left" in ae) { this.offset.click.left = ae.left + this.margins.left } if ("right" in ae) { this.offset.click.left = this.helperProportions.width - ae.right + this.margins.left } if ("top" in ae) { this.offset.click.top = ae.top + this.margins.top } if ("bottom" in ae) { this.offset.click.top = this.helperProportions.height - ae.bottom + this.margins.top } }, _getParentOffset: function() { this.offsetParent = this.helper.offsetParent(); var ae = this.offsetParent.offset(); if (this.cssPosition === "absolute" && this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0])) { ae.left += this.scrollParent.scrollLeft();
                ae.top += this.scrollParent.scrollTop() } if (this.offsetParent[0] === document.body || (this.offsetParent[0].tagName && this.offsetParent[0].tagName.toLowerCase() === "html" && e.ui.ie)) { ae = { top: 0, left: 0 } } return { top: ae.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: ae.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) } }, _getRelativeOffset: function() { if (this.cssPosition === "relative") { var ae = this.currentItem.position(); return { top: ae.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(), left: ae.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft() } } else { return { top: 0, left: 0 } } }, _cacheMargins: function() { this.margins = { left: (parseInt(this.currentItem.css("marginLeft"), 10) || 0), top: (parseInt(this.currentItem.css("marginTop"), 10) || 0) } }, _cacheHelperProportions: function() { this.helperProportions = { width: this.helper.outerWidth(), height: this.helper.outerHeight() } }, _setContainment: function() { var ah, af, ag, ae = this.options; if (ae.containment === "parent") { ae.containment = this.helper[0].parentNode } if (ae.containment === "document" || ae.containment === "window") { this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, e(ae.containment === "document" ? document : window).width() - this.helperProportions.width - this.margins.left, (e(ae.containment === "document" ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top] } if (!(/^(document|window|parent)$/).test(ae.containment)) { ah = e(ae.containment)[0];
                af = e(ae.containment).offset();
                ag = (e(ah).css("overflow") !== "hidden");
                this.containment = [af.left + (parseInt(e(ah).css("borderLeftWidth"), 10) || 0) + (parseInt(e(ah).css("paddingLeft"), 10) || 0) - this.margins.left, af.top + (parseInt(e(ah).css("borderTopWidth"), 10) || 0) + (parseInt(e(ah).css("paddingTop"), 10) || 0) - this.margins.top, af.left + (ag ? Math.max(ah.scrollWidth, ah.offsetWidth) : ah.offsetWidth) - (parseInt(e(ah).css("borderLeftWidth"), 10) || 0) - (parseInt(e(ah).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, af.top + (ag ? Math.max(ah.scrollHeight, ah.offsetHeight) : ah.offsetHeight) - (parseInt(e(ah).css("borderTopWidth"), 10) || 0) - (parseInt(e(ah).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top] } }, _convertPositionTo: function(ai, ae) { if (!ae) { ae = this.position } var ag = ai === "absolute" ? 1 : -1,
                af = this.cssPosition === "absolute" && !(this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0])) ? this.offsetParent : this.scrollParent,
                ah = (/(html|body)/i).test(af[0].tagName); return { top: (ae.top + this.offset.relative.top * ag + this.offset.parent.top * ag - ((this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : (ah ? 0 : af.scrollTop())) * ag)), left: (ae.left + this.offset.relative.left * ag + this.offset.parent.left * ag - ((this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : ah ? 0 : af.scrollLeft()) * ag)) } }, _generatePosition: function(aj) { var ak, ai, ah = this.options,
                af = aj.pageX,
                ag = aj.pageY,
                al = this.cssPosition === "absolute" && !(this.scrollParent[0] !== document && e.contains(this.scrollParent[0], this.offsetParent[0])) ? this.offsetParent : this.scrollParent,
                ae = (/(html|body)/i).test(al[0].tagName); if (this.cssPosition === "relative" && !(this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0])) { this.offset.relative = this._getRelativeOffset() } if (this.originalPosition) { if (this.containment) { if (aj.pageX - this.offset.click.left < this.containment[0]) { af = this.containment[0] + this.offset.click.left } if (aj.pageY - this.offset.click.top < this.containment[1]) { ag = this.containment[1] + this.offset.click.top } if (aj.pageX - this.offset.click.left > this.containment[2]) { af = this.containment[2] + this.offset.click.left } if (aj.pageY - this.offset.click.top > this.containment[3]) { ag = this.containment[3] + this.offset.click.top } } if (ah.grid) { ak = this.originalPageY + Math.round((ag - this.originalPageY) / ah.grid[1]) * ah.grid[1];
                    ag = this.containment ? ((ak - this.offset.click.top >= this.containment[1] && ak - this.offset.click.top <= this.containment[3]) ? ak : ((ak - this.offset.click.top >= this.containment[1]) ? ak - ah.grid[1] : ak + ah.grid[1])) : ak;
                    ai = this.originalPageX + Math.round((af - this.originalPageX) / ah.grid[0]) * ah.grid[0];
                    af = this.containment ? ((ai - this.offset.click.left >= this.containment[0] && ai - this.offset.click.left <= this.containment[2]) ? ai : ((ai - this.offset.click.left >= this.containment[0]) ? ai - ah.grid[0] : ai + ah.grid[0])) : ai } } return { top: (ag - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ((this.cssPosition === "fixed" ? -this.scrollParent.scrollTop() : (ae ? 0 : al.scrollTop())))), left: (af - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ((this.cssPosition === "fixed" ? -this.scrollParent.scrollLeft() : ae ? 0 : al.scrollLeft()))) } }, _rearrange: function(ah, af, ag, ai) { ag ? ag[0].appendChild(this.placeholder[0]) : af.item[0].parentNode.insertBefore(this.placeholder[0], (this.direction === "down" ? af.item[0] : af.item[0].nextSibling));
            this.counter = this.counter ? ++this.counter : 1; var ae = this.counter;
            this._delay(function() { if (ae === this.counter) { this.refreshPositions(!ai) } }) }, _clear: function(ag, ai) { this.reverting = false; var af, ae = []; if (!this._noFinalSort && this.currentItem.parent().length) { this.placeholder.before(this.currentItem) } this._noFinalSort = null; if (this.helper[0] === this.currentItem[0]) { for (af in this._storedCSS) { if (this._storedCSS[af] === "auto" || this._storedCSS[af] === "static") { this._storedCSS[af] = "" } } this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") } else { this.currentItem.show() } if (this.fromOutside && !ai) { ae.push(function(aj) { this._trigger("receive", aj, this._uiHash(this.fromOutside)) }) } if ((this.fromOutside || this.domPosition.prev !== this.currentItem.prev().not(".ui-sortable-helper")[0] || this.domPosition.parent !== this.currentItem.parent()[0]) && !ai) { ae.push(function(aj) { this._trigger("update", aj, this._uiHash()) }) } if (this !== this.currentContainer) { if (!ai) { ae.push(function(aj) { this._trigger("remove", aj, this._uiHash()) });
                    ae.push((function(aj) { return function(ak) { aj._trigger("receive", ak, this._uiHash(this)) } }).call(this, this.currentContainer));
                    ae.push((function(aj) { return function(ak) { aj._trigger("update", ak, this._uiHash(this)) } }).call(this, this.currentContainer)) } }

            function ah(aj, al, ak) { return function(am) { ak._trigger(aj, am, al._uiHash(al)) } } for (af = this.containers.length - 1; af >= 0; af--) { if (!ai) { ae.push(ah("deactivate", this, this.containers[af])) } if (this.containers[af].containerCache.over) { ae.push(ah("out", this, this.containers[af]));
                    this.containers[af].containerCache.over = 0 } } if (this.storedCursor) { this.document.find("body").css("cursor", this.storedCursor);
                this.storedStylesheet.remove() } if (this._storedOpacity) { this.helper.css("opacity", this._storedOpacity) } if (this._storedZIndex) { this.helper.css("zIndex", this._storedZIndex === "auto" ? "" : this._storedZIndex) } this.dragging = false; if (!ai) { this._trigger("beforeStop", ag, this._uiHash()) } this.placeholder[0].parentNode.removeChild(this.placeholder[0]); if (!this.cancelHelperRemoval) { if (this.helper[0] !== this.currentItem[0]) { this.helper.remove() } this.helper = null } if (!ai) { for (af = 0; af < ae.length; af++) { ae[af].call(this, ag) } this._trigger("stop", ag, this._uiHash()) } this.fromOutside = false; return !this.cancelHelperRemoval }, _trigger: function() { if (e.Widget.prototype._trigger.apply(this, arguments) === false) { this.cancel() } }, _uiHash: function(af) { var ae = af || this; return { helper: ae.helper, placeholder: ae.placeholder || e([]), position: ae.position, originalPosition: ae.originalPosition, offset: ae.positionAbs, item: ae.currentItem, sender: af ? af.element : null } } });

    function j(ae) { return function() { var af = this.element.val();
            ae.apply(this, arguments);
            this._refresh(); if (af !== this.element.val()) { this._trigger("change") } } } var ab = e.widget("ui.spinner", { version: "1.11.2", defaultElement: "<input>", widgetEventPrefix: "spin", options: { culture: null, icons: { down: "ui-icon-triangle-1-s", up: "ui-icon-triangle-1-n" }, incremental: true, max: null, min: null, numberFormat: null, page: 10, step: 1, change: null, spin: null, start: null, stop: null }, _create: function() { this._setOption("max", this.options.max);
            this._setOption("min", this.options.min);
            this._setOption("step", this.options.step); if (this.value() !== "") { this._value(this.element.val(), true) } this._draw();
            this._on(this._events);
            this._refresh();
            this._on(this.window, { beforeunload: function() { this.element.removeAttr("autocomplete") } }) }, _getCreateOptions: function() { var af = {},
                ae = this.element;
            e.each(["min", "max", "step"], function(ah, ai) { var ag = ae.attr(ai); if (ag !== undefined && ag.length) { af[ai] = ag } }); return af }, _events: { keydown: function(ae) { if (this._start(ae) && this._keydown(ae)) { ae.preventDefault() } }, keyup: "_stop", focus: function() { this.previous = this.element.val() }, blur: function(ae) { if (this.cancelBlur) { delete this.cancelBlur; return } this._stop();
                this._refresh(); if (this.previous !== this.element.val()) { this._trigger("change", ae) } }, mousewheel: function(af, ae) { if (!ae) { return } if (!this.spinning && !this._start(af)) { return false } this._spin((ae > 0 ? 1 : -1) * this.options.step, af);
                clearTimeout(this.mousewheelTimer);
                this.mousewheelTimer = this._delay(function() { if (this.spinning) { this._stop(af) } }, 100);
                af.preventDefault() }, "mousedown .ui-spinner-button": function(ag) { var ae;
                ae = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val();

                function af() { var ah = this.element[0] === this.document[0].activeElement; if (!ah) { this.element.focus();
                        this.previous = ae;
                        this._delay(function() { this.previous = ae }) } } ag.preventDefault();
                af.call(this);
                this.cancelBlur = true;
                this._delay(function() { delete this.cancelBlur;
                    af.call(this) }); if (this._start(ag) === false) { return } this._repeat(null, e(ag.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, ag) }, "mouseup .ui-spinner-button": "_stop", "mouseenter .ui-spinner-button": function(ae) { if (!e(ae.currentTarget).hasClass("ui-state-active")) { return } if (this._start(ae) === false) { return false } this._repeat(null, e(ae.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, ae) }, "mouseleave .ui-spinner-button": "_stop" }, _draw: function() { var ae = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
            this.element.attr("role", "spinbutton");
            this.buttons = ae.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"); if (this.buttons.height() > Math.ceil(ae.height() * 0.5) && ae.height() > 0) { ae.height(ae.height()) } if (this.options.disabled) { this.disable() } }, _keydown: function(ae) { var ag = this.options,
                af = e.ui.keyCode; switch (ae.keyCode) {
                case af.UP:
                    this._repeat(null, 1, ae); return true;
                case af.DOWN:
                    this._repeat(null, -1, ae); return true;
                case af.PAGE_UP:
                    this._repeat(null, ag.page, ae); return true;
                case af.PAGE_DOWN:
                    this._repeat(null, -ag.page, ae); return true } return false }, _uiSpinnerHtml: function() { return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>" }, _buttonHtml: function() { return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span></a><a class='ui-spinner-button ui-spinner-down ui-corner-br'><span class='ui-icon " + this.options.icons.down + "'>&#9660;</span></a>" }, _start: function(ae) { if (!this.spinning && this._trigger("start", ae) === false) { return false } if (!this.counter) { this.counter = 1 } this.spinning = true; return true }, _repeat: function(af, ae, ag) { af = af || 500;
            clearTimeout(this.timer);
            this.timer = this._delay(function() { this._repeat(40, ae, ag) }, af);
            this._spin(ae * this.options.step, ag) }, _spin: function(ag, af) { var ae = this.value() || 0; if (!this.counter) { this.counter = 1 } ae = this._adjustValue(ae + ag * this._increment(this.counter)); if (!this.spinning || this._trigger("spin", af, { value: ae }) !== false) { this._value(ae);
                this.counter++ } }, _increment: function(af) { var ae = this.options.incremental; if (ae) { return e.isFunction(ae) ? ae(af) : Math.floor(af * af * af / 50000 - af * af / 500 + 17 * af / 200 + 1) } return 1 }, _precision: function() { var ae = this._precisionOf(this.options.step); if (this.options.min !== null) { ae = Math.max(ae, this._precisionOf(this.options.min)) } return ae }, _precisionOf: function(af) { var ag = af.toString(),
                ae = ag.indexOf("."); return ae === -1 ? 0 : ag.length - ae - 1 }, _adjustValue: function(ae) { var ag, af, ah = this.options;
            ag = ah.min !== null ? ah.min : 0;
            af = ae - ag;
            af = Math.round(af / ah.step) * ah.step;
            ae = ag + af;
            ae = parseFloat(ae.toFixed(this._precision())); if (ah.max !== null && ae > ah.max) { return ah.max } if (ah.min !== null && ae < ah.min) { return ah.min } return ae }, _stop: function(ae) { if (!this.spinning) { return } clearTimeout(this.timer);
            clearTimeout(this.mousewheelTimer);
            this.counter = 0;
            this.spinning = false;
            this._trigger("stop", ae) }, _setOption: function(ag, ae) { if (ag === "culture" || ag === "numberFormat") { var af = this._parse(this.element.val());
                this.options[ag] = ae;
                this.element.val(this._format(af)); return } if (ag === "max" || ag === "min" || ag === "step") { if (typeof ae === "string") { ae = this._parse(ae) } } if (ag === "icons") { this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(ae.up);
                this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(ae.down) } this._super(ag, ae); if (ag === "disabled") { this.widget().toggleClass("ui-state-disabled", !!ae);
                this.element.prop("disabled", !!ae);
                this.buttons.button(ae ? "disable" : "enable") } }, _setOptions: j(function(ae) { this._super(ae) }), _parse: function(ae) { if (typeof ae === "string" && ae !== "") { ae = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(ae, 10, this.options.culture) : +ae } return ae === "" || isNaN(ae) ? null : ae }, _format: function(ae) { if (ae === "") { return "" } return window.Globalize && this.options.numberFormat ? Globalize.format(ae, this.options.numberFormat, this.options.culture) : ae }, _refresh: function() { this.element.attr({ "aria-valuemin": this.options.min, "aria-valuemax": this.options.max, "aria-valuenow": this._parse(this.element.val()) }) }, isValid: function() { var ae = this.value(); if (ae === null) { return false } return ae === this._adjustValue(ae) }, _value: function(ae, af) { var ag; if (ae !== "") { ag = this._parse(ae); if (ag !== null) { if (!af) { ag = this._adjustValue(ag) } ae = this._format(ag) } } this.element.val(ae);
            this._refresh() }, _destroy: function() { this.element.removeClass("ui-spinner-input").prop("disabled", false).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
            this.uiSpinner.replaceWith(this.element) }, stepUp: j(function(ae) { this._stepUp(ae) }), _stepUp: function(ae) { if (this._start()) { this._spin((ae || 1) * this.options.step);
                this._stop() } }, stepDown: j(function(ae) { this._stepDown(ae) }), _stepDown: function(ae) { if (this._start()) { this._spin((ae || 1) * -this.options.step);
                this._stop() } }, pageUp: j(function(ae) { this._stepUp((ae || 1) * this.options.page) }), pageDown: j(function(ae) { this._stepDown((ae || 1) * this.options.page) }), value: function(ae) { if (!arguments.length) { return this._parse(this.element.val()) } j(this._value).call(this, ae) }, widget: function() { return this.uiSpinner } }); var W = e.widget("ui.tabs", { version: "1.11.2", delay: 300, options: { active: null, collapsible: false, event: "click", heightStyle: "content", hide: null, show: null, activate: null, beforeActivate: null, beforeLoad: null, load: null }, _isLocal: (function() { var ae = /#.*$/; return function(ag) { var ah, ai;
                ag = ag.cloneNode(false);
                ah = ag.href.replace(ae, "");
                ai = location.href.replace(ae, ""); try { ah = decodeURIComponent(ah) } catch (af) {} try { ai = decodeURIComponent(ai) } catch (af) {} return ag.hash.length > 1 && ah === ai } })(), _create: function() { var ae = this,
                af = this.options;
            this.running = false;
            this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", af.collapsible);
            this._processTabs();
            af.active = this._initialActive(); if (e.isArray(af.disabled)) { af.disabled = e.unique(af.disabled.concat(e.map(this.tabs.filter(".ui-state-disabled"), function(ag) { return ae.tabs.index(ag) }))).sort() } if (this.options.active !== false && this.anchors.length) { this.active = this._findActive(af.active) } else { this.active = e() } this._refresh(); if (this.active.length) { this.load(af.active) } }, _initialActive: function() { var ae = this.options.active,
                ag = this.options.collapsible,
                af = location.hash.substring(1); if (ae === null) { if (af) { this.tabs.each(function(ai, ah) { if (e(ah).attr("aria-controls") === af) { ae = ai; return false } }) } if (ae === null) { ae = this.tabs.index(this.tabs.filter(".ui-tabs-active")) } if (ae === null || ae === -1) { ae = this.tabs.length ? 0 : false } } if (ae !== false) { ae = this.tabs.index(this.tabs.eq(ae)); if (ae === -1) { ae = ag ? false : 0 } } if (!ag && ae === false && this.anchors.length) { ae = 0 } return ae }, _getCreateEventData: function() { return { tab: this.active, panel: !this.active.length ? e() : this._getPanelForTab(this.active) } }, _tabKeydown: function(af) { var ae = e(this.document[0].activeElement).closest("li"),
                ah = this.tabs.index(ae),
                ag = true; if (this._handlePageNav(af)) { return } switch (af.keyCode) {
                case e.ui.keyCode.RIGHT:
                case e.ui.keyCode.DOWN:
                    ah++; break;
                case e.ui.keyCode.UP:
                case e.ui.keyCode.LEFT:
                    ag = false;
                    ah--; break;
                case e.ui.keyCode.END:
                    ah = this.anchors.length - 1; break;
                case e.ui.keyCode.HOME:
                    ah = 0; break;
                case e.ui.keyCode.SPACE:
                    af.preventDefault();
                    clearTimeout(this.activating);
                    this._activate(ah); return;
                case e.ui.keyCode.ENTER:
                    af.preventDefault();
                    clearTimeout(this.activating);
                    this._activate(ah === this.options.active ? false : ah); return;
                default:
                    return } af.preventDefault();
            clearTimeout(this.activating);
            ah = this._focusNextTab(ah, ag); if (!af.ctrlKey) { ae.attr("aria-selected", "false");
                this.tabs.eq(ah).attr("aria-selected", "true");
                this.activating = this._delay(function() { this.option("active", ah) }, this.delay) } }, _panelKeydown: function(ae) { if (this._handlePageNav(ae)) { return } if (ae.ctrlKey && ae.keyCode === e.ui.keyCode.UP) { ae.preventDefault();
                this.active.focus() } }, _handlePageNav: function(ae) { if (ae.altKey && ae.keyCode === e.ui.keyCode.PAGE_UP) { this._activate(this._focusNextTab(this.options.active - 1, false)); return true } if (ae.altKey && ae.keyCode === e.ui.keyCode.PAGE_DOWN) { this._activate(this._focusNextTab(this.options.active + 1, true)); return true } }, _findNextTab: function(ae, af) { var ag = this.tabs.length - 1;

            function ah() { if (ae > ag) { ae = 0 } if (ae < 0) { ae = ag } return ae } while (e.inArray(ah(), this.options.disabled) !== -1) { ae = af ? ae + 1 : ae - 1 } return ae }, _focusNextTab: function(ae, af) { ae = this._findNextTab(ae, af);
            this.tabs.eq(ae).focus(); return ae }, _setOption: function(ae, af) { if (ae === "active") { this._activate(af); return } if (ae === "disabled") { this._setupDisabled(af); return } this._super(ae, af); if (ae === "collapsible") { this.element.toggleClass("ui-tabs-collapsible", af); if (!af && this.options.active === false) { this._activate(0) } } if (ae === "event") { this._setupEvents(af) } if (ae === "heightStyle") { this._setupHeightStyle(af) } }, _sanitizeSelector: function(ae) { return ae ? ae.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : "" }, refresh: function() { var ae = this.options,
                af = this.tablist.children(":has(a[href])");
            ae.disabled = e.map(af.filter(".ui-state-disabled"), function(ag) { return af.index(ag) });
            this._processTabs(); if (ae.active === false || !this.anchors.length) { ae.active = false;
                this.active = e() } else { if (this.active.length && !e.contains(this.tablist[0], this.active[0])) { if (this.tabs.length === ae.disabled.length) { ae.active = false;
                        this.active = e() } else { this._activate(this._findNextTab(Math.max(0, ae.active - 1), false)) } } else { ae.active = this.tabs.index(this.active) } } this._refresh() }, _refresh: function() { this._setupDisabled(this.options.disabled);
            this._setupEvents(this.options.event);
            this._setupHeightStyle(this.options.heightStyle);
            this.tabs.not(this.active).attr({ "aria-selected": "false", "aria-expanded": "false", tabIndex: -1 });
            this.panels.not(this._getPanelForTab(this.active)).hide().attr({ "aria-hidden": "true" }); if (!this.active.length) { this.tabs.eq(0).attr("tabIndex", 0) } else { this.active.addClass("ui-tabs-active ui-state-active").attr({ "aria-selected": "true", "aria-expanded": "true", tabIndex: 0 });
                this._getPanelForTab(this.active).show().attr({ "aria-hidden": "false" }) } }, _processTabs: function() { var ae = this,
                ah = this.tabs,
                ag = this.anchors,
                af = this.panels;
            this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist").delegate("> li", "mousedown" + this.eventNamespace, function(ai) { if (e(this).is(".ui-state-disabled")) { ai.preventDefault() } }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function() { if (e(this).closest("li").is(".ui-state-disabled")) { this.blur() } });
            this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({ role: "tab", tabIndex: -1 });
            this.anchors = this.tabs.map(function() { return e("a", this)[0] }).addClass("ui-tabs-anchor").attr({ role: "presentation", tabIndex: -1 });
            this.panels = e();
            this.anchors.each(function(ap, am) { var ai, an, al, ao = e(am).uniqueId().attr("id"),
                    aj = e(am).closest("li"),
                    ak = aj.attr("aria-controls"); if (ae._isLocal(am)) { ai = am.hash;
                    al = ai.substring(1);
                    an = ae.element.find(ae._sanitizeSelector(ai)) } else { al = aj.attr("aria-controls") || e({}).uniqueId()[0].id;
                    ai = "#" + al;
                    an = ae.element.find(ai); if (!an.length) { an = ae._createPanel(al);
                        an.insertAfter(ae.panels[ap - 1] || ae.tablist) } an.attr("aria-live", "polite") } if (an.length) { ae.panels = ae.panels.add(an) } if (ak) { aj.data("ui-tabs-aria-controls", ak) } aj.attr({ "aria-controls": al, "aria-labelledby": ao });
                an.attr("aria-labelledby", ao) });
            this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel"); if (ah) { this._off(ah.not(this.tabs));
                this._off(ag.not(this.anchors));
                this._off(af.not(this.panels)) } }, _getList: function() { return this.tablist || this.element.find("ol,ul").eq(0) }, _createPanel: function(ae) { return e("<div>").attr("id", ae).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", true) }, _setupDisabled: function(ae) { if (e.isArray(ae)) { if (!ae.length) { ae = false } else { if (ae.length === this.anchors.length) { ae = true } } } for (var af = 0, ag;
                (ag = this.tabs[af]); af++) { if (ae === true || e.inArray(af, ae) !== -1) { e(ag).addClass("ui-state-disabled").attr("aria-disabled", "true") } else { e(ag).removeClass("ui-state-disabled").removeAttr("aria-disabled") } } this.options.disabled = ae }, _setupEvents: function(af) { var ae = {}; if (af) { e.each(af.split(" "), function(ah, ag) { ae[ag] = "_eventHandler" }) } this._off(this.anchors.add(this.tabs).add(this.panels));
            this._on(true, this.anchors, { click: function(ag) { ag.preventDefault() } });
            this._on(this.anchors, ae);
            this._on(this.tabs, { keydown: "_tabKeydown" });
            this._on(this.panels, { keydown: "_panelKeydown" });
            this._focusable(this.tabs);
            this._hoverable(this.tabs) }, _setupHeightStyle: function(ag) { var ae, af = this.element.parent(); if (ag === "fill") { ae = af.height();
                ae -= this.element.outerHeight() - this.element.height();
                this.element.siblings(":visible").each(function() { var ah = e(this),
                        ai = ah.css("position"); if (ai === "absolute" || ai === "fixed") { return } ae -= ah.outerHeight(true) });
                this.element.children().not(this.panels).each(function() { ae -= e(this).outerHeight(true) });
                this.panels.each(function() { e(this).height(Math.max(0, ae - e(this).innerHeight() + e(this).height())) }).css("overflow", "auto") } else { if (ag === "auto") { ae = 0;
                    this.panels.each(function() { ae = Math.max(ae, e(this).height("").height()) }).height(ae) } } }, _eventHandler: function(al) { var af = this.options,
                ai = this.active,
                ak = e(al.currentTarget),
                ag = ak.closest("li"),
                ah = ag[0] === ai[0],
                am = ah && af.collapsible,
                an = am ? e() : this._getPanelForTab(ag),
                aj = !ai.length ? e() : this._getPanelForTab(ai),
                ae = { oldTab: ai, oldPanel: aj, newTab: am ? e() : ag, newPanel: an };
            al.preventDefault(); if (ag.hasClass("ui-state-disabled") || ag.hasClass("ui-tabs-loading") || this.running || (ah && !af.collapsible) || (this._trigger("beforeActivate", al, ae) === false)) { return } af.active = am ? false : this.tabs.index(ag);
            this.active = ah ? e() : ag; if (this.xhr) { this.xhr.abort() } if (!aj.length && !an.length) { e.error("jQuery UI Tabs: Mismatching fragment identifier.") } if (an.length) { this.load(this.tabs.index(ag), al) } this._toggle(al, ae) }, _toggle: function(ai, ae) { var ag = this,
                af = ae.newPanel,
                ak = ae.oldPanel;
            this.running = true;

            function aj() { ag.running = false;
                ag._trigger("activate", ai, ae) }

            function ah() { ae.newTab.closest("li").addClass("ui-tabs-active ui-state-active"); if (af.length && ag.options.show) { ag._show(af, ag.options.show, aj) } else { af.show();
                    aj() } } if (ak.length && this.options.hide) { this._hide(ak, this.options.hide, function() { ae.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active");
                    ah() }) } else { ae.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active");
                ak.hide();
                ah() } ak.attr("aria-hidden", "true");
            ae.oldTab.attr({ "aria-selected": "false", "aria-expanded": "false" }); if (af.length && ak.length) { ae.oldTab.attr("tabIndex", -1) } else { if (af.length) { this.tabs.filter(function() { return e(this).attr("tabIndex") === 0 }).attr("tabIndex", -1) } } af.attr("aria-hidden", "false");
            ae.newTab.attr({ "aria-selected": "true", "aria-expanded": "true", tabIndex: 0 }) }, _activate: function(af) { var ag, ae = this._findActive(af); if (ae[0] === this.active[0]) { return } if (!ae.length) { ae = this.active } ag = ae.find(".ui-tabs-anchor")[0];
            this._eventHandler({ target: ag, currentTarget: ag, preventDefault: e.noop }) }, _findActive: function(ae) { return ae === false ? e() : this.tabs.eq(ae) }, _getIndex: function(ae) { if (typeof ae === "string") { ae = this.anchors.index(this.anchors.filter("[href$='" + ae + "']")) } return ae }, _destroy: function() { if (this.xhr) { this.xhr.abort() } this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible");
            this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role");
            this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId();
            this.tablist.unbind(this.eventNamespace);
            this.tabs.add(this.panels).each(function() { if (e.data(this, "ui-tabs-destroy")) { e(this).remove() } else { e(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role") } });
            this.tabs.each(function() { var af = e(this),
                    ae = af.data("ui-tabs-aria-controls"); if (ae) { af.attr("aria-controls", ae).removeData("ui-tabs-aria-controls") } else { af.removeAttr("aria-controls") } });
            this.panels.show(); if (this.options.heightStyle !== "content") { this.panels.css("height", "") } }, enable: function(af) { var ae = this.options.disabled; if (ae === false) { return } if (af === undefined) { ae = false } else { af = this._getIndex(af); if (e.isArray(ae)) { ae = e.map(ae, function(ag) { return ag !== af ? ag : null }) } else { ae = e.map(this.tabs, function(ag, ah) { return ah !== af ? ah : null }) } } this._setupDisabled(ae) }, disable: function(af) { var ae = this.options.disabled; if (ae === true) { return } if (af === undefined) { ae = true } else { af = this._getIndex(af); if (e.inArray(af, ae) !== -1) { return } if (e.isArray(ae)) { ae = e.merge([af], ae).sort() } else { ae = [af] } } this._setupDisabled(ae) }, load: function(ak, aj) { ak = this._getIndex(ak); var ag = this,
                af = this.tabs.eq(ak),
                ah = af.find(".ui-tabs-anchor"),
                ai = this._getPanelForTab(af),
                ae = { tab: af, panel: ai }; if (this._isLocal(ah[0])) { return } this.xhr = e.ajax(this._ajaxSettings(ah, aj, ae)); if (this.xhr && this.xhr.statusText !== "canceled") { af.addClass("ui-tabs-loading");
                ai.attr("aria-busy", "true");
                this.xhr.success(function(al) { setTimeout(function() { ai.html(al);
                        ag._trigger("load", aj, ae) }, 1) }).complete(function(al, am) { setTimeout(function() { if (am === "abort") { ag.panels.stop(false, true) } af.removeClass("ui-tabs-loading");
                        ai.removeAttr("aria-busy"); if (al === ag.xhr) { delete ag.xhr } }, 1) }) } }, _ajaxSettings: function(ah, ag, ae) { var af = this; return { url: ah.attr("href"), beforeSend: function(ai, aj) { return af._trigger("beforeLoad", ag, e.extend({ jqXHR: ai, ajaxSettings: aj }, ae)) } } }, _getPanelForTab: function(ae) { var af = e(ae).attr("aria-controls"); return this.element.find(this._sanitizeSelector("#" + af)) } }); var b = e.widget("ui.tooltip", { version: "1.11.2", options: { content: function() { var ae = e(this).attr("title") || ""; return e("<a>").text(ae).html() }, hide: true, items: "[title]:not([disabled])", position: { my: "left top+15", at: "left bottom", collision: "flipfit flip" }, show: true, tooltipClass: null, track: false, close: null, open: null }, _addDescribedBy: function(af, ae) { var ag = (af.attr("aria-describedby") || "").split(/\s+/);
            ag.push(ae);
            af.data("ui-tooltip-id", ae).attr("aria-describedby", e.trim(ag.join(" "))) }, _removeDescribedBy: function(ag) { var ae = ag.data("ui-tooltip-id"),
                ah = (ag.attr("aria-describedby") || "").split(/\s+/),
                af = e.inArray(ae, ah); if (af !== -1) { ah.splice(af, 1) } ag.removeData("ui-tooltip-id");
            ah = e.trim(ah.join(" ")); if (ah) { ag.attr("aria-describedby", ah) } else { ag.removeAttr("aria-describedby") } }, _create: function() { this._on({ mouseover: "open", focusin: "open" });
            this.tooltips = {};
            this.parents = {}; if (this.options.disabled) { this._disable() } this.liveRegion = e("<div>").attr({ role: "log", "aria-live": "assertive", "aria-relevant": "additions" }).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body) }, _setOption: function(ag, ae) { var af = this; if (ag === "disabled") { this[ae ? "_disable" : "_enable"]();
                this.options[ag] = ae; return } this._super(ag, ae); if (ag === "content") { e.each(this.tooltips, function(ah, ai) { af._updateContent(ai.element) }) } }, _disable: function() { var ae = this;
            e.each(this.tooltips, function(af, ah) { var ag = e.Event("blur");
                ag.target = ag.currentTarget = ah.element[0];
                ae.close(ag, true) });
            this.element.find(this.options.items).addBack().each(function() { var af = e(this); if (af.is("[title]")) { af.data("ui-tooltip-title", af.attr("title")).removeAttr("title") } }) }, _enable: function() { this.element.find(this.options.items).addBack().each(function() { var ae = e(this); if (ae.data("ui-tooltip-title")) { ae.attr("title", ae.data("ui-tooltip-title")) } }) }, open: function(ag) { var af = this,
                ae = e(ag ? ag.target : this.element).closest(this.options.items); if (!ae.length || ae.data("ui-tooltip-id")) { return } if (ae.attr("title")) { ae.data("ui-tooltip-title", ae.attr("title")) } ae.data("ui-tooltip-open", true); if (ag && ag.type === "mouseover") { ae.parents().each(function() { var ai = e(this),
                        ah; if (ai.data("ui-tooltip-open")) { ah = e.Event("blur");
                        ah.target = ah.currentTarget = this;
                        af.close(ah, true) } if (ai.attr("title")) { ai.uniqueId();
                        af.parents[this.id] = { element: this, title: ai.attr("title") };
                        ai.attr("title", "") } }) } this._updateContent(ae, ag) }, _updateContent: function(af, ai) { var aj, ae = this.options.content,
                ah = this,
                ag = ai ? ai.type : null; if (typeof ae === "string") { return this._open(ai, af, ae) } aj = ae.call(af[0], function(ak) { if (!af.data("ui-tooltip-open")) { return } ah._delay(function() { if (ai) { ai.type = ag } this._open(ai, af, ak) }) }); if (aj) { this._open(ai, af, aj) } }, _open: function(aj, af, ak) { var ah, an, am, ai, ag, ae = e.extend({}, this.options.position); if (!ak) { return } ah = this._find(af); if (ah) { ah.tooltip.find(".ui-tooltip-content").html(ak); return } if (af.is("[title]")) { if (aj && aj.type === "mouseover") { af.attr("title", "") } else { af.removeAttr("title") } } ah = this._tooltip(af);
            an = ah.tooltip;
            this._addDescribedBy(af, an.attr("id"));
            an.find(".ui-tooltip-content").html(ak);
            this.liveRegion.children().hide(); if (ak.clone) { ag = ak.clone();
                ag.removeAttr("id").find("[id]").removeAttr("id") } else { ag = ak } e("<div>").html(ag).appendTo(this.liveRegion);

            function al(ao) { ae.of = ao; if (an.is(":hidden")) { return } an.position(ae) } if (this.options.track && aj && /^mouse/.test(aj.type)) { this._on(this.document, { mousemove: al });
                al(aj) } else { an.position(e.extend({ of: af }, this.options.position)) } an.hide();
            this._show(an, this.options.show); if (this.options.show && this.options.show.delay) { ai = this.delayedShow = setInterval(function() { if (an.is(":visible")) { al(ae.of);
                        clearInterval(ai) } }, e.fx.interval) } this._trigger("open", aj, { tooltip: an });
            am = { keyup: function(ao) { if (ao.keyCode === e.ui.keyCode.ESCAPE) { var ap = e.Event(ao);
                        ap.currentTarget = af[0];
                        this.close(ap, true) } } }; if (af[0] !== this.element[0]) { am.remove = function() { this._removeTooltip(an) } } if (!aj || aj.type === "mouseover") { am.mouseleave = "close" } if (!aj || aj.type === "focusin") { am.focusout = "close" } this._on(true, af, am) }, close: function(ah) { var ai, af = this,
                ae = e(ah ? ah.currentTarget : this.element),
                ag = this._find(ae); if (!ag) { return } ai = ag.tooltip; if (ag.closing) { return } clearInterval(this.delayedShow); if (ae.data("ui-tooltip-title") && !ae.attr("title")) { ae.attr("title", ae.data("ui-tooltip-title")) } this._removeDescribedBy(ae);
            ag.hiding = true;
            ai.stop(true);
            this._hide(ai, this.options.hide, function() { af._removeTooltip(e(this)) });
            ae.removeData("ui-tooltip-open");
            this._off(ae, "mouseleave focusout keyup"); if (ae[0] !== this.element[0]) { this._off(ae, "remove") } this._off(this.document, "mousemove"); if (ah && ah.type === "mouseleave") { e.each(this.parents, function(aj, ak) { e(ak.element).attr("title", ak.title);
                    delete af.parents[aj] }) } ag.closing = true;
            this._trigger("close", ah, { tooltip: ai }); if (!ag.hiding) { ag.closing = false } }, _tooltip: function(ag) { var af = e("<div>").attr("role", "tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || "")),
                ae = af.uniqueId().attr("id");
            e("<div>").addClass("ui-tooltip-content").appendTo(af);
            af.appendTo(this.document[0].body); return this.tooltips[ae] = { element: ag, tooltip: af } }, _find: function(af) { var ae = af.data("ui-tooltip-id"); return ae ? this.tooltips[ae] : null }, _removeTooltip: function(ae) { ae.remove();
            delete this.tooltips[ae.attr("id")] }, _destroy: function() { var ae = this;
            e.each(this.tooltips, function(af, ah) { var ag = e.Event("blur"),
                    ai = ah.element;
                ag.target = ag.currentTarget = ai[0];
                ae.close(ag, true);
                e("#" + af).remove(); if (ai.data("ui-tooltip-title")) { if (!ai.attr("title")) { ai.attr("title", ai.data("ui-tooltip-title")) } ai.removeData("ui-tooltip-title") } });
            this.liveRegion.remove() } }) }));
/* Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.8
 *
 */
(function(a) { a.fn.extend({ slimScroll: function(d) { var c = { width: "auto", height: "250px", size: "7px", color: "#000", position: "right", distance: "1px", start: "top", opacity: 0.4, alwaysVisible: false, disableFadeOut: false, railVisible: false, railColor: "#333", railOpacity: 0.2, railDraggable: true, railClass: "slimScrollRail", barClass: "slimScrollBar", wrapperClass: "slimScrollDiv", allowPageScroll: false, wheelStep: 20, touchScrollStep: 200, borderRadius: "7px", railBorderRadius: "7px", isOverPanel: false, waitTime: 0 }; var b = a.extend(c, d);
            this.each(function() { var A = b.isOverPanel; var z, r, f, g, i, q, F, w = "<div></div>",
                    D = 30,
                    x = false; var e = a(this); if (e.parent().hasClass(b.wrapperClass)) { var j = e.scrollTop();
                    B = e.siblings("." + b.barClass);
                    y = e.siblings("." + b.railClass);
                    C(); if (a.isPlainObject(d)) { if ("height" in d && d.height == "auto") { e.parent().css("height", "auto");
                            e.css("height", "auto"); var E = e.parent().parent().height();
                            e.parent().css("height", E);
                            e.css("height", E) } else { if ("height" in d) { var o = d.height;
                                e.parent().css("height", o);
                                e.css("height", o) } } if ("scrollTo" in d) { j = parseInt(b.scrollTo) } else { if ("scrollBy" in d) { j += parseInt(b.scrollBy) } else { if ("destroy" in d) { B.remove();
                                    y.remove();
                                    e.unwrap(); return } } } n(j, false, true) } return } else { if (a.isPlainObject(d)) { if ("destroy" in d) { return } } } b.height = (b.height == "auto") ? e.parent().height() : b.height; var u = a(w).addClass(b.wrapperClass).css({ position: "relative", overflow: "hidden", width: b.width, height: b.height });
                e.css({ overflow: "hidden", width: b.width, height: b.height }); var y = a(w).addClass(b.railClass).css({ width: b.size, height: "100%", position: "absolute", top: 0, display: (b.alwaysVisible && b.railVisible) ? "block" : "none", "border-radius": b.railBorderRadius, background: b.railColor, opacity: b.railOpacity, zIndex: 90 }); var B = a(w).addClass(b.barClass).css({ background: b.color, width: b.size, position: "absolute", top: 0, opacity: b.opacity, display: b.alwaysVisible ? "block" : "none", "border-radius": b.borderRadius, BorderRadius: b.borderRadius, MozBorderRadius: b.borderRadius, WebkitBorderRadius: b.borderRadius, zIndex: 99 }); var m = (b.position == "right") ? { right: b.distance } : { left: b.distance };
                y.css(m);
                B.css(m);
                e.wrap(u);
                e.parent().append(B);
                e.parent().append(y); if (b.railDraggable) { B.bind("mousedown", function(h) { var G = a(document);
                        r = true;
                        t = parseFloat(B.css("top"));
                        pageY = h.pageY;
                        G.bind("mousemove.slimscroll", function(H) { currTop = t + H.pageY - pageY;
                            B.css("top", currTop);
                            n(0, B.position().top, false) });
                        G.bind("mouseup.slimscroll", function(H) { r = false;
                            k();
                            G.unbind(".slimscroll") }); return false }).bind("selectstart.slimscroll", function(h) { h.stopPropagation();
                        h.preventDefault(); return false }) } y.hover(function() { p() }, function() { k() });
                B.hover(function() { z = true }, function() { z = false }); var l;
                e.hover(function() { l = setTimeout(function() { A = true;
                        p();
                        k() }, b.waitTime) }, function() { clearTimeout(l);
                    A = false;
                    k() });
                e.bind("touchstart", function(G, h) { if (G.originalEvent.touches.length) { g = G.originalEvent.touches[0].pageY } });
                e.bind("touchmove", function(G) { if (!x) { G.originalEvent.preventDefault() } if (G.originalEvent.touches.length) { var h = (g - G.originalEvent.touches[0].pageY) / b.touchScrollStep;
                        n(h, true);
                        g = G.originalEvent.touches[0].pageY } });
                C(); if (b.start === "bottom") { B.css({ top: e.outerHeight() - B.outerHeight() });
                    n(0, true) } else { if (b.start !== "top") { n(a(b.start).position().top, null, true); if (!b.alwaysVisible) { B.hide() } } } v(this);

                function s(H) { if (!A) { return } var H = H || window.event; var G = 0; if (H.wheelDelta) { G = -H.wheelDelta / 120 } if (H.detail) { G = H.detail / 3 } var h = H.target || H.srcTarget || H.srcElement; if (a(h).closest("." + b.wrapperClass).is(e.parent())) { n(G, true) } if (H.preventDefault && !x) { H.preventDefault() } if (!x) { H.returnValue = false } }

                function n(G, K, I) { x = false; var J = G; var H = e.outerHeight() - B.outerHeight(); if (K) { J = parseInt(B.css("top")) + G * parseInt(b.wheelStep) / 100 * B.outerHeight();
                        J = Math.min(Math.max(J, 0), H);
                        J = (G > 0) ? Math.ceil(J) : Math.floor(J);
                        B.css({ top: J + "px" }) } q = parseInt(B.css("top")) / (e.outerHeight() - B.outerHeight());
                    J = q * (e[0].scrollHeight - e.outerHeight()); if (I) { J = G; var h = J / e[0].scrollHeight * e.outerHeight();
                        h = Math.min(Math.max(h, 0), H);
                        B.css({ top: h + "px" }) } e.scrollTop(J);
                    e.trigger("slimscrolling", ~~J);
                    p();
                    k() }

                function v(h) { if (window.addEventListener) { h.addEventListener("DOMMouseScroll", s, false);
                        h.addEventListener("mousewheel", s, false) } else { document.attachEvent("onmousewheel", s) } }

                function C() { i = Math.max((e.outerHeight() / e[0].scrollHeight) * e.outerHeight(), D);
                    B.css({ height: i + "px" }); var h = i == e.outerHeight() ? "none" : "block";
                    B.css({ display: h }) }

                function p() { C();
                    clearTimeout(f); if (q == ~~q) { x = b.allowPageScroll; if (F != q) { var h = (~~q == 0) ? "top" : "bottom";
                            e.trigger("slimscroll", h) } } else { x = false } F = q; if (i >= e.outerHeight()) { x = true; return } B.stop(true, true).fadeIn("fast"); if (b.railVisible) { y.stop(true, true).fadeIn("fast") } }

                function k() { if (!b.alwaysVisible) { f = setTimeout(function() { if (!(b.disableFadeOut && A) && !z && !r) { B.fadeOut("slow");
                                y.fadeOut("slow") } }, 1000) } } }); return this } });
    a.fn.extend({ slimscroll: a.fn.slimScroll }) })(jQuery);
jQuery.fn.center = function(a) { return this.each(function() { var b = jQuery(this);
        b.css({ position: a ? "absolute" : "fixed", left: "50%", top: "50%", zIndex: "99" }).css({ marginLeft: "-" + (b.outerWidth() / 2) + "px", marginTop: "-" + (b.outerHeight() / 2) + "px" }); if (a) { b.css({ marginTop: parseInt(b.css("marginTop"), 10) + jQuery(window).scrollTop(), marginLeft: parseInt(b.css("marginLeft"), 10) + jQuery(window).scrollLeft() }) } }) };
jQuery.cookie = function(j, a, c) { if (typeof a != "undefined") { c = c || {}; if (a === null) { a = "";
            c.expires = -1 } var b = ""; if (c.expires && (typeof c.expires == "number" || c.expires.toUTCString)) { var f; if (typeof c.expires == "number") { f = new Date();
                f.setTime(f.getTime() + (c.expires * 24 * 60 * 60 * 1000)) } else { f = c.expires } b = "; expires=" + f.toUTCString() } var d = c.path ? "; path=" + c.path : ""; var h = c.domain ? "; domain=" + c.domain : ""; var m = c.secure ? "; secure" : "";
        document.cookie = [j, "=", encodeURIComponent(a), b, d, h, m].join("") } else { var e = null; if (document.cookie && document.cookie != "") { var k = document.cookie.split(";"); for (var g = 0; g < k.length; g++) { var l = jQuery.trim(k[g]); if (l.substring(0, j.length + 1) == (j + "=")) { e = decodeURIComponent(l.substring(j.length + 1)); break } } } return e } };
String.format = function(d) { if (arguments.length <= 1) { return d } var b = arguments.length - 2; for (var c = 0; c <= b; c++) { d = d.replace(new RegExp("\\{" + c + "\\}", "gi"), arguments[c + 1]) } return d };
String.prototype.trimStart = function(d) { if (this.length == 0) { return this } d = d ? d : " "; var b = 0; for (; this.charAt(b) == d && b < this.length; b++) {} return this.substring(b) };
String.prototype.trimEnd = function(d) { d = d ? d : " "; var b = this.length - 1; for (; b >= 0 && this.charAt(b) == d; b--) {} return this.substring(0, b + 1) };
String.prototype.trim = function(b) { return this.trimStart(b).trimEnd(b) };
var videoImageDomain = "https://video-thumbs.mediacdn.vn";

function thumb_zoom(b, d, c) { if (b.indexOf("http:") != -1 || b.indexOf("https:") != -1) { if (b.indexOf(videoImageDomain) != -1) { b = b.replace(videoImageDomain, "") } else { return b } } return String.format("{0}/zoom/{1}_{2}/{3}", videoImageDomain.trimEnd("/"), d, c, b.trimStart("/")) }

function thumb_w(c, b) { if (c.indexOf("http:") != -1 || c.indexOf("https:") != -1) { if (c.indexOf(videoImageDomain) != -1) { c = c.replace(videoImageDomain, "") } else { return c } } return String.format("{0}/thumb_w/{1}/{2}", videoImageDomain.trimEnd("/"), b, c.trimStart("/")) }

function openIframe(b) { if ($(".login-overlay").length > 0) { $(".login-overlay").remove() } var e = $("<div />").addClass("login-overlay").css("width", $(document).width()).css("height", $(document).height()).appendTo("body"); var f = $("<div />").addClass("login-box").appendTo("body").center(false); var c = $("<a />").addClass("close-button").attr("href", "#").bind("click", function() { closeLoginBox(); return false }).appendTo(f); var d = $("<iframe />").attr("src", b == null ? "/Pages/Login.aspx" : b).appendTo(f) }

function closeLoginBox() { var c = $(".login-overlay"); var b = $(".login-box");
    c.fadeOut(500, function() { c.remove() });
    b.fadeOut(500, function() { b.remove() }) }

function reload() { document.location = document.location.href.replace("#", "") }
var _mingCookiesName = "Ming_Genk_MingLogin";
var HostGameK = "https://genk.vn";

function MingInfo(b) { $.cookie(_mingCookiesName, b, { expires: 30, path: "/" });
    VietID.init();
    VietID.reloadIFrame();
    closeLoginBox() }
var VietID = { appKey: "56eafad9ecf65bc827739910530c4ebb", callback: "https://genk.vn/MingCallback.aspx?v=1", init: function() { var me = this; if ($.cookie && $.cookie(_mingCookiesName) == "true") { return } $.getScript("https://vietid.net/login/Checksession");
        mingAuthCallBack = function(data1) { if (data1 != "null") { var rels = eval("(" + data1 + ")");
                strQuery = "username=" + rels.username + "&email=" + rels.email + "&full_name=" + rels.full_name + "&id=" + rels.id + "&checksum=" + rels.checksum;
                $.getScript(DomainConfig.AjaxDomain + "/Pages/dologin.aspx?" + strQuery);
                a = function(data) { if (data != null) { $("#login").show();
                        $("#logout").hide();
                        $("#uName").attr("name", rels.username).attr("email", rels.email);
                        $("#uName").text(rels.username);
                        MINGID_NOTIF_FUNC.initNotif(me.appKey) } } } } }, reloadIFrame: function() { if ($("#mingid_comment_iframe").length > 0) { $("#mingid_comment_iframe").attr("src", $("#mingid_comment_iframe").attr("src")) } if ($(".mingid_comment_iframe").length > 0) { $(".mingid_comment_iframe").each(function() { $(this).attr("src", $(this).attr("src")) }) } return false }, logout: function() { var b = this;
        $.ajax({ url: DomainConfig.AjaxDomain + "/Pages/dologin.aspx?type=1", xhrFields: { withCredentials: true }, type: "GET", success: function(c) { $.cookie(_mingCookiesName, true, { expires: 30, path: "/" });
                b.openPopup() } });
        setTimeout(function() { b.reloadIFrame() }, 1000);
        $("#hdLogin").val("");
        $("#logout").show();
        $("#login").hide() }, openPopup: function() { var b = this; if ($("#basic-modal-content").length > 0) { $("#basic-modal-content").remove() } openIframe(String.format("https://vietid.net/OauthServerV2/logout?app_key={0}&call_back={1}", b.appKey, b.callback)) } };

function CheckLogin(params, callback) { $.getScript("https://vietid.net/login/Checksession");
    mingAuthCallBack = function(data) { if (callback == "alert" && data == "null") { alert("Báº¡n chÆ°a Ä‘Äƒng nháº­p"); return false } var img = new Image(); if (data != "null") { var rels = eval("(" + data + ")"); var info = rels.id + "|" + rels.username + "|" + rels.email + "|" + rels.full_name;
            $.ajax({ url: DomainConfig.AjaxDomain + "/MingSession.aspx?info=" + info, xhrFields: { withCredentials: true }, type: "POST", success: function() { if (callback != null && callback != "alert") { if (eval("typeof(" + callback + ") === 'function'")) { eval(String.format("{0}('{1}', '{2}')", callback, params, info)) } else {} } } }) } else { if (params != null) { img.src = DomainConfig.AjaxDomain + "/MingSession.aspx?type=1";
                alert("Báº¡n chÆ°a Ä‘Äƒng nháº­p") } else { img.src = DomainConfig.AjaxDomain + "/MingSession.aspx?type=1" } } return false } } $(document).ready(function() {});

function BBEnterPress1(c) { var b; if (c && c.which) { c = c;
        b = c.which } else { c = window.event;
        b = c.keyCode } if (b == 13) { ValidateSearch(); return false } return true }

function BBEnterPress1Footer(c) { var b; if (c && c.which) { c = c;
        b = c.which } else { c = window.event;
        b = c.keyCode } if (b == 13) { ValidateSearchFooter(); return false } return true }

function ValidateSearchFooter() { if (!require_txt("searchinputfooter", "Báº¡n chÆ°a nháº­p tá»« khÃ³a")) { return false } key = removeHTMLTags("searchinputfooter");
    key = LocDauUnicode(key);
    window.location = sDomainSearch + encodeURIComponent(key) + ".chn"; return false }

function ValidateSearch() { if (!require_txt("searchinput", "Báº¡n chÆ°a nháº­p tá»« khÃ³a")) { return false } key = removeHTMLTags("searchinput");
    key = LocDauUnicode(key);
    window.location = sDomainSearch + encodeURIComponent(key) + ".chn"; return false }

function removeHTMLTags(c) { var b = document.getElementById(c).textContent;
    b = b.replace(/&(lt|gt);/g, function(f, e) { return (e == "lt") ? "<" : ">" }); var d = b.replace(/<\/?[^>]+(>|$)/g, ""); while (d.indexOf('"') != -1) { d = d.replace('"', "") } while (d.indexOf("'") != -1) { d = d.replace("'", "") } document.getElementById(c).value = d; return d }

function searchPress() { if (!require_txt("searchinput", "Báº¡n chÆ°a nháº­p tá»« khÃ³a")) { return false } key = removeHTMLTags("searchinput");
    key = LocDauUnicode(key);
    window.location = sDomainSearch + encodeURIComponent(key) + ".chn"; return false }

function require_txt(c, b) { if (document.getElementById(c).textContent == "") { alert(b);
        document.getElementById(c).focus(); return false } return true }
var rollingNews = function() { var k = { contentPlaceHolder: undefined, hotContentPlaceHolder: undefined, displayHotContentCallback: undefined, duration: 5000, url: DomainConfig.AjaxDomain + "/Handlers/News/RollingNews.ashx", finallyCallback: undefined }; var g = { rollingNewsEvent: { id: "Id", content: "Content", time: "Time", type: "Type", eventDate: "EventTime", isFocus: "IsFocus", note: "Note", focusDate: "FocusDate" }, rollingNewsType: { allType: -1, breakingNews: 2, video: 3, photo: 5, quotation: 1, facebook: 9, linkhay: 10, vietId: 11, phone: 6, email: 7, message: 8, audio: 4 }, action: { getAll: 1, getNew: 2, getMore: 3 }, appendPosition: { top: 0, bottom: 1 } }; var r = { isLoadingNew: false, isLoadingAll: false, isLoadingMore: false }; var q; var m; var n; var o = []; var h = false; var t;

    function l() { clearInterval(t); if (r.isLoadingNew) { $(".live-countdown .couting").hide();
            $(".live-countdown .time").text(k.duration / 1000);
            $(".live-countdown .loading").show() } else { $(".live-countdown .couting").show();
            $(".live-countdown .loading").hide();
            t = setInterval(function() { if (r.isLoadingAll || r.isLoadingNew) { return } var u = parseInt($(".live-countdown .time").text());
                $(".live-countdown .time").text(u > 0 ? u - 1 : k.duration / 1000) }, 1000) } }

    function s() { if (h === false) { k.contentPlaceHolder.html(o.join("")) } else { var u = o.slice();
            k.contentPlaceHolder.html(u.reverse().join("")) } h = !h;
        f(k.finallyCallback) }

    function j(u) { $.ajax({ url: k.url, data: { id: q, action: g.action.getAll }, dataType: "JSON", success: function(v) { l(); if (v.Success) { p(v.Data != "" ? $.parseJSON(v.Data) : []);
                    f(u) } } }) }

    function b() { if (r.isLoadingNew === true || r.isLoadingAll === true) { return } r.isLoadingNew = true;
        l();
        $.ajax({ url: k.url, data: { id: q, action: g.action.getNew, date: m }, dataType: "JSON", success: function(u) { if (u.Success) { p(u.Data != "" ? $.parseJSON(u.Data) : []) } r.isLoadingNew = false;
                l() } }) }

    function p(w) { if (w != null) { var y = w.length; if (y > 0) { var v = []; var u = []; for (var z = 0; z < y; z++) { v.push(d(w[z])); if (w[z][g.rollingNewsEvent.isFocus]) { u.push(i(w[z])) } } if (u.length > 0) { if (k.hotContentPlaceHolder.find("li").length > 0) { k.hotContentPlaceHolder.find("li:first").before(u.join("")) } else { k.hotContentPlaceHolder.html(u.join("")) } f(k.displayHotContentCallback) } var A = v.slice();
                o.push.apply(o, A.reverse()); if (h) { v.reverse() } var x = $(".livenews-item");
                v = $(v.join(""));
                v.hide(); if (x.length > 0) { if (h === true) { x.last().after(v) } else { x.first().before(v) } } else { k.contentPlaceHolder.html(v) } m = w[0][g.rollingNewsEvent.eventDate];
                v.fadeIn() } f(k.finallyCallback);
            ProcessVideo() } }

    function d(u) { var v = [];
        v.push(String.format('<div class="livenews-item" rel="{0}">', u[g.rollingNewsEvent.id]));
        v.push(e(u[g.rollingNewsEvent.type]));
        v.push(String.format('<p class="published-date">{0}</p>', u[g.rollingNewsEvent.time]));
        v.push(String.format('<p class="note">{0}</p>', u[g.rollingNewsEvent.note]));
        v.push('<div class="inner clearfix">');
        v.push(String.format('<div class="news-content content">{0}</div>', u[g.rollingNewsEvent.content]));
        v.push("</div>");
        v.push("</div>"); return v.join("") }

    function i(u) { var v = [];
        v.push(String.format('<li rel="{0}">', u[g.rollingNewsEvent.id]));
        v.push('<span class="content">');
        v.push(String.format('<a rel="nofollow">{0}</a>', u[g.rollingNewsEvent.note]));
        v.push(String.format('</span><span class="time">{0}</span></li>', u[g.rollingNewsEvent.focusDate])); return v.join("") }

    function e(v) { var u = ""; switch (v) {
            case g.rollingNewsType.breakingNews:
                u = "ico-news"; break;
            case g.rollingNewsType.video:
                u = "ico-video"; break;
            case g.rollingNewsType.photo:
                u = "ico-photo"; break;
            case g.rollingNewsType.quotation:
                u = "ico-quote"; break;
            case g.rollingNewsType.facebook:
                u = "ico-fb"; break;
            case g.rollingNewsType.linkhay:
                u = "ico-linkhay"; break;
            case g.rollingNewsType.vietId:
                u = "ico-vietid"; break;
            case g.rollingNewsType.audio:
                u = "ico-audio"; break;
            case g.rollingNewsType.phone:
                u = "ico-call"; break;
            case g.rollingNewsType.email:
                u = "ico-email"; break;
            case g.rollingNewsType.message:
                u = "ico-msg"; break } if (u != "") { return String.format('<i class="ico-type {0}"></i>', u) } return "" }

    function f(u) { if (typeof u == "function") { u() } }

    function c() { if (k.contentPlaceHolder === undefined) { try { console.log("RollingNews's ContentPlaceHolder is undefined.") } catch (u) {} return } j(function() { if (n == null) { n = setInterval(b, k.duration) } }) } return { init: function(u, v) { q = u;
            k = $.extend(k, v);
            c() }, reverse: s } }(jQuery);
var ClockCountdown = { init: function(c, f) { var b = this; var d = f.split(","); var e = new Date(d[0], d[1] - 1, d[2], d[3], d[4], d[5]);
        b.daydiff(c, e.getTime());
        $("#clock-countdown-" + c).show();
        setInterval(function() { b.daydiff(c, e.getTime()) }, 1000) }, daydiff: function(f, h) { var j = new Date().getTime(); var i = h - j; if (i <= 0) { $("#clock-countdown-" + f).remove(); return } var c = i / 1000; var d = parseInt(c / 3600);
        c = c % 3600; var b = parseInt(c / 60); var g = parseInt(c % 60); var e = "cÃ²n "; if (d > 0) { e += d + " giá» " } if (b > 0) { e += b + " phÃºt " } if (g > 0) { e += g + " giÃ¢y " } $("#clock-countdown-" + f).html(e) } };

function changeImageDomain(b) { b = $(b); var c = $(b).attr("src"); if (c.indexOf("genk2.vcmedia.vn") != -1) { return } b.attr("src", c.replace("genknews.vcmedia", "genk2.vcmedia")) }

function HoverAndActiveMenu() { $(".menu li").hover(function() { $(this).find(".sub").stop(true).slideToggle("fast") }); var b = window.location.pathname.split("/")[1]; if (b.length > 0) { b = b.replace(".chn", "");
        $('.menu ul li a[href*="' + b + '.chn"]').addClass("active2");
        $(".menu").find('ul.submenu li a[href*="' + b + '.chn"]').removeClass("active2").parents(".sub").prev().addClass("active2") } }

function Highlight5Title() { $(".item .home-highlight-5-title").hover(function() { $(".item .home-highlight-5-glass").toggleClass("glass-active") });
    $(".item-0 .home-highlight-5-title").hover(function() { $(".item-0 .home-highlight-5-glass").toggleClass("glass-0-active") });
    $(".item-1 .home-highlight-5-title").hover(function() { $(".item-1 .home-highlight-5-glass").toggleClass("glass-1-active") });
    $(".item-2 .home-highlight-5-title").hover(function() { $(".item-2 .home-highlight-5-glass").toggleClass("glass-2-active") });
    $(".item-3 .home-highlight-5-title").hover(function() { $(".item-3 .home-highlight-5-glass").toggleClass("glass-3-active") }) }

function Highlight5Title2() { $(".item .home-highlight-5-title").hover(function() { $(".item .home-highlight-5-glass").toggleClass("glass-active") });
    $(".item-0 .home-highlight-5-title").hover(function() { $(".item-0 .home-highlight-5-glass").toggleClass("glass-0-active") });
    $(".item-1 .home-highlight-5-title").hover(function() { $(".item-1 .home-highlight-5-glass").toggleClass("glass-1-active") }) }

function HotFocusHome() { $(".hot-topic-content-2 li").each(function() { $(this).hover(function() { $(this).find("h2").css("background", "none repeat scroll 0 0 rgba(0, 0, 0, 0.3)") }, function() { $(this).find("h2").css("background", "none repeat scroll 0 0 rgba(0, 0, 0, 0.5)") }) }) }

function BaiPrGenk() { var d = false; var g = []; var b = getCookie("__RC"); var e = (b == 4) ? 1 : 2;
    $(String.format("*[pr-location=0],*[pr-location={0}]", e)).each(function() { var h = $(this).attr("pr-position"); if (h != "13") { d = true;
            $(String.format("*[pr-position={0}]:not([pr-location])", h)).before($(this).removeClass("nodisplay")) } else { $(String.format("*[pr-position={0}]:not([pr-location])", h)).replaceWith($(this).removeClass("nodisplay")) } var i = $(this).find("a[data-id]").first().attr("data-id");
        g.push(i) }); for (var f = 0; f < g.length; f++) { $(".news-stream").find(String.format("a[data-id={0}]", g[f])).closest(".list-news:not([pr-position])").remove() } if (d) { var c = 0;
        $(".news-stream").find(".list-news").each(function() { $(this).removeClass("alternative"); if ((c + 1) % 2 == 0) { $(this).addClass("alternative") } c++ }) } $(".list-news-img h3 a:contains('CafÃ© cÃ´ng nghá»‡')").css("right", "20px");
    $(".list-news-img h3 a:contains('PC/Äá»“ chÆ¡i sá»‘')").css("right", "15px");
    $(".list-news-img h3 a:contains('Digital Marketing')").css("right", "22px");
    $(".list-news-img h3 a:contains('TrÃ  Ä‘Ã¡ cÃ´ng nghá»‡')").parent().addClass("stickCafe");
    $(".iconcomment").each(function() { $(this).remove(); return; var i = $(this).attr("rel"); var h = $(this);
        $.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/VietId/CountVietIdComment.ashx?sortUrl=" + i, xhrFields: { withCredentials: true }, type: "GET", success: function(j) { if (j != null) { h.text(String.format("{0}", j)) } } }) }) }

function removePaddingP(b) { if (b == "True") { $(".content p").css("padding", 0) } }

function renderFbLike(d, c, b) { $(d).parent().find("img.img_face").remove();
    $(d).css({ width: c + "px", height: b + "px", display: "block" }) }

function SubTitleNewsDetail() { var d = document.location; var b = $("#sub_title").html(); if (typeof b != "undefined" && b != null) { if (b.replace(/\s/g, "").length == 0) { $("#sub_title").remove() } var c = $("#tags-details").find("h3").html(); if (c == undefined) { $("#tags-details").remove() } } }

function LocDauUnicode(b) { b = b.toLowerCase();
    b = b.replace(/Ã |Ã¡|áº¡|áº£|Ã£|Ã¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ/g, "a");
    b = b.replace(/Ã¨|Ã©|áº¹|áº»|áº½|Ãª|á»|áº¿|á»‡|á»ƒ|á»…/g, "e");
    b = b.replace(/Ã¬|Ã­|á»‹|á»‰|Ä©/g, "i");
    b = b.replace(/Ã²|Ã³|á»|á»|Ãµ|Ã´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡/g, "o");
    b = b.replace(/Ã¹|Ãº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯/g, "u");
    b = b.replace(/á»³|Ã½|á»µ|á»·|á»¹/g, "y");
    b = b.replace(/Ä‘/g, "d");
    b = b.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, "-");
    b = b.replace(/-+-/g, "-");
    b = b.replace(/^\-+|\-+$/g, ""); return b }

function getCountView(c) { var b = ""; var d = 0;
    $(".item-view").each(function() { var e = ($(this).attr("rel")); if (d == 0) { b += e } else { b += ";" + e } d++ }); if (d < 1) { return } $.ajax({ url: Constants.apiHandlerUrl + "/Handler/GetExtendParamSocial.ashx", data: ({ c: "adtechviewcountgetlist", from: c, lstNewsIds: b }), dataType: "json", type: "GET", beforeSend: function() {}, success: function(e) { if (e.Success) { var f = JSON.parse(e.Data);
                $.each(f, function(i, g) { var h = $(".item-view[rel*='" + g.newsId + "']"); var k = g.total_view.view_pc + g.total_view.view_mob; var j = numeral(k).format("0,0a").replace(",", "."); if (k > 0) { h.html(j);
                        h.removeClass("item-view") } }) } } }) }

function loadQuizIms() { var b = function(c) { $.ajax({ type: "POST", url: sDomain + "/get-quiz-ims.chn", dataType: "json", success: function(d) { if (typeof(d) == "string") { d = JSON.parse(d) } var e = d.message; if (typeof(e) == "string") { e = JSON.parse(e) } c(e.token) } }) };
    IMSQuizEmbed.init({ getTokenFunction: b }) };
$.fn.mcgSlider = function(i) { var a = $.extend({ slideItemElement: ".mcgSlideItem", nextButtonElement: undefined, preButtonElement: undefined, preButton: undefined, nextButton: undefined, numberOfVisibleSlides: 1, auto: true, duration: 8000, speed: 600, autoWidth: false, effect: true, bull: undefined, onSlideNext: undefined, onSlideBack: undefined, onSlideEnd: undefined, onSlideStart: undefined }, i); var h = undefined; var g = undefined; var l = 0; var m = 0; var e = 0; var k = undefined; var d = $(this);

    function f() { var o = d.find(a.slideItemElement); if (o.length > 0) { o.hide(); var s = o.first();
            m = a.numberOfVisibleSlides * s.outerWidth();
            l = Math.ceil(o.length / a.numberOfVisibleSlides); try { console.log(m, l, s.outerWidth()) } catch (p) {} o.css({ display: "inline-block", "float": "left" });
            o.wrapAll('<div class="mcgContainer"></div>');
            h = d.find(".mcgContainer:first");
            h.css({ "float": "left", width: l * m + "px", position: "relative" });
            h.wrapAll('<div class="mcgView"></div>');
            g = d.find(".mcgView:first");
            g.parent().css("overflow", "hidden");
            g.css({ position: "relative", display: "block", overflow: "hidden" }); if (!a.autoWidth) { g.css({ width: m + "px" }) } if (typeof a.bull != "undefined") { var r = a.bull;
                r.each(function() { $(this).unbind("click").bind("click", function() { e = r.index($(this));
                        b() }) }) } var n = undefined; var q = undefined; if (typeof a.preButton != undefined) { n = $(a.preButton) } else { if (typeof a.preButtonElement != undefined) { n = d.find(a.preButtonElement) } } if (typeof a.nextButton != undefined) { q = $(a.nextButton) } else { if (typeof a.nextButtonElement != undefined) { q = d.find(a.nextButtonElement) } } if (typeof n != undefined) { n.click(function() { j() }) } if (typeof q != undefined) { q.click(function() { c() }) } $([q, n, o, $(a.bull)]).each(function() { if (typeof $(this) != undefined) { $(this).hover(function() { clearInterval(k) }, function() { if (a.auto) { k = setInterval(function() { c() }, a.duration) } }) } });
            $([q, n]).each(function() { $(this).css({ cursor: "pointer" }) }); if (a.auto) { k = setInterval(function() { c() }, a.duration) } o.show() } }

    function b() { if (h != undefined) { h.stop(true, true).animate({ left: m * (-e) }, a.speed); var n = a.bull; if (typeof n != "undefined") { var o = $(n[e]);
                n.parent().find(".active").removeClass("active");
                o.addClass("active") } } }

    function c() { if (e == l - 1) { e = 0 } else { e++ } b(); if (typeof a.onSlideNext != "undefined") { a.onSlideNext() } }

    function j() { if (e <= 0) { e = l - 1 } else { e-- } b(); if (typeof a.onSlideBack != "undefined") { a.onSlideBack() } } return this.each(function() { f() }) };
String.format = function(c) { if (arguments.length <= 1) { return c } var a = arguments.length - 2; for (var b = 0; b <= a; b++) { c = c.replace(new RegExp("\\{" + b + "\\}", "gi"), arguments[b + 1]) } return c };
String.prototype.trimStart = function(b) { if (this.length == 0) { return this } b = b ? b : " "; var a = 0; for (; this.charAt(a) == b && a < this.length; a++) {} return this.substring(a) };
String.prototype.trimEnd = function(b) { b = b ? b : " "; var a = this.length - 1; for (; a >= 0 && this.charAt(a) == b; a--) {} return this.substring(0, a + 1) };
String.prototype.trim = function(a) { return this.trimStart(a).trimEnd(a) };
String.prototype.toSubString = function(b) { var c = this; if (c == "" || c.Length <= b) { return c } var a = c.lastIndexOf(" ");
    c = c.substring(0, Math.min(c.length, b)); if (c.length > a) { c = c.substring(0, a) } return c };
$.fn.trimLine = function(a, b) { return this.each(function() { var f = $(this).text().length; var d = parseFloat($(this).css("line-height")) * a; if (isNaN(d)) { d = parseFloat($(this).css("font-size").replace("px", "")) * a } var e = ($(this).height() > d && f > 0); while ($(this).height() > d && f > 0) { f--; var g = $(this).html().toSubString(f);
            $(this).html(g) } if (e) { $(this).html($(this).html().toSubString($(this).html().length) + "...") } if (true === b) { $(this).css({ "min-height": d + "px" }) } }) };
var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function encode64(c) { c = escape(c); var f = ""; var b, g, h = ""; var j, d, k, e = ""; var a = 0;
    do { b = c.charCodeAt(a++);
        g = c.charCodeAt(a++);
        h = c.charCodeAt(a++);
        j = b >> 2;
        d = ((b & 3) << 4) | (g >> 4);
        k = ((g & 15) << 2) | (h >> 6);
        e = h & 63; if (isNaN(g)) { k = e = 64 } else { if (isNaN(h)) { e = 64 } } f = f + keyStr.charAt(j) + keyStr.charAt(d) + keyStr.charAt(k) + keyStr.charAt(e) } while (a < c.length); return f }(function(d) { var a = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/="; var b = function(g) { g = g.replace(/\x0d\x0a/g, "\x0a"); var f = ""; for (var h = 0; h < g.length; h++) { var e = g.charCodeAt(h); if (e < 128) { f += String.fromCharCode(e) } else { if ((e > 127) && (e < 2048)) { f += String.fromCharCode((e >> 6) | 192);
                    f += String.fromCharCode((e & 63) | 128) } else { f += String.fromCharCode((e >> 12) | 224);
                    f += String.fromCharCode(((e >> 6) & 63) | 128);
                    f += String.fromCharCode((e & 63) | 128) } } } return f }; var c = function(e) { var g = ""; var f = 0; var h = c1 = c2 = 0; while (f < e.length) { h = e.charCodeAt(f); if (h < 128) { g += String.fromCharCode(h);
                f++ } else { if ((h > 191) && (h < 224)) { c2 = e.charCodeAt(f + 1);
                    g += String.fromCharCode(((h & 31) << 6) | (c2 & 63));
                    f += 2 } else { c2 = e.charCodeAt(f + 1);
                    c3 = e.charCodeAt(f + 2);
                    g += String.fromCharCode(((h & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                    f += 3 } } } return g };
    d.extend({ base64Encode: function(g) { var k = ""; var f, l, m, n, h, o, j; var e = 0;
            g = b(g); while (e < g.length) { f = g.charCodeAt(e++);
                l = g.charCodeAt(e++);
                m = g.charCodeAt(e++);
                n = f >> 2;
                h = ((f & 3) << 4) | (l >> 4);
                o = ((l & 15) << 2) | (m >> 6);
                j = m & 63; if (isNaN(l)) { o = j = 64 } else { if (isNaN(m)) { j = 64 } } k = k + a.charAt(n) + a.charAt(h) + a.charAt(o) + a.charAt(j) } return k }, base64Decode: function(g) { var k = ""; var f, l, m; var n, h, o, j; var e = 0;
            g = g.replace(/[^A-Za-z0-9\+\/\=]/g, ""); while (e < g.length) { n = a.indexOf(g.charAt(e++));
                h = a.indexOf(g.charAt(e++));
                o = a.indexOf(g.charAt(e++));
                j = a.indexOf(g.charAt(e++));
                f = (n << 2) | (h >> 4);
                l = ((h & 15) << 4) | (o >> 2);
                m = ((o & 3) << 6) | j;
                k = k + String.fromCharCode(f); if (o != 64) { k = k + String.fromCharCode(l) } if (j != 64) { k = k + String.fromCharCode(m) } } k = c(k); return k } }) })(jQuery);
(function(c) {
    function f() { var g = document.documentElement; return ("requestFullscreen" in g) || ("mozRequestFullScreen" in g && document.mozFullScreenEnabled) || ("webkitRequestFullScreen" in g) }

    function b(g) { if (g.requestFullscreen) { g.requestFullscreen() } else { if (g.mozRequestFullScreen) { g.mozRequestFullScreen() } else { if (g.webkitRequestFullScreen) { g.webkitRequestFullScreen() } } } }

    function d() { return document.fullscreen || document.mozFullScreen || document.webkitIsFullScreen || false }

    function a() { if (document.exitFullscreen) { document.exitFullscreen() } else { if (document.mozCancelFullScreen) { document.mozCancelFullScreen() } else { if (document.webkitCancelFullScreen) { document.webkitCancelFullScreen() } } } c(document).off("fullscreenchange mozfullscreenchange webkitfullscreenchange") }

    function e(g) { c(document).on("fullscreenchange mozfullscreenchange webkitfullscreenchange", function() { g(d()) }) } c.support.fullscreen = f();
    c.fn.fullScreen = function(g) { if (!c.support.fullscreen || this.length !== 1) { return this } if (d()) { a(); return this } var j = c.extend({ background: "#111", callback: c.noop(), fullscreenClass: "fullScreen" }, g),
            i = this,
            h = c("#popup-detail-left");
        i.addClass(j.fullscreenClass);
        b(h.get(0));
        i.cancel = function() { a(); return i };
        e(function(k) { if (!k) { i.removeClass(j.fullscreenClass).insertBefore(h);
                h.remove() } j.callback(k) }); return i };
    c.fn.cancelFullScreen = function() { a(); return this } }(jQuery));

function getCookie(a) { var b = document.cookie; var d = b.indexOf(" " + a + "="); if (d == -1) { d = b.indexOf(a + "=") } if (d == -1) { b = null } else { d = b.indexOf("=", d) + 1; var c = b.indexOf(";", d); if (c == -1) { c = b.length } b = unescape(b.substring(d, c)) } return b }

function isSmartPhone() { return (navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone|webOS)/i) != null) }

function SmartPhoneEmbed(c, d, e, i) { if (isSmartPhone()) { var k = $(c).find("object"); var f = ""; var g = $(k).find("embed").attr("width"); var b = $(k).find("embed").attr("height"); var j = false; if (d) { g = d } if (e) { b = e } if (i) { j = i } if (k.length > 0) { $(k).each(function(h, a) { if (h > 0) { f += ";" } f += $(a).find("embed").attr("id") });
            $.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/Video/VideoHandler.ashx", data: { m: "html5", key: f, width: g, height: b, auto: j }, dataType: "json", type: "GET", success: function(a) { if (a.Success) { for (var h = 0; h < a.Data.length; h++) { $(k)[h].outerHTML = a.Data[h].Embed } } } }) } } }
var fbClient = { version: "v2.5", appId: "180276625471433", xfbml: true, status: true, init: function() { var a = this;
        $(document).ready(function() { a.fbLoad("//connect.facebook.net/vi_VN/sdk.js", function() { FB.init({ appId: a.appId, status: a.status, xfbml: a.xfbml, version: a.version }) }) }) }, fbParse: function(b) { try { FB.XFBML.parse(b) } catch (a) {} }, fbLoad: function(b, a) { a = (typeof a != "undefined") ? a : {};
        $.ajax({ type: "GET", url: b, success: a, dataType: "script", cache: true }) }, getLikeShareCount: function(a, d, b, c) { $.ajax({ type: "GET", dataType: "json", url: "https://graph.facebook.com/?ids=" + a, success: function(e) { if ($(d) != null) { $(d).html(e[a].share.share_count) } } }) }, shareClick: function(e) { var c = screen.width / 2 - 700 / 2; var d = screen.height / 2 - 450 / 2; var b = e != null ? e : document.location.href; var a = window.open("http://www.facebook.com/sharer.php?u=" + b, "chia sáº»", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=" + d + ", left=" + c);
        a.focus(); return false }, sendClick: function(b) { var a = b != null ? b : document.location.href;
        FB.ui({ method: "send", link: a, }); return false } };

function social_share(a) { var b = screen.width / 2 - 700 / 2; var c = screen.height / 2 - 450 / 2;
    $(".facebook_share_button").click(function() { var d = window.open("https://www.facebook.com/sharer.php?u=" + a, "chia sáº»", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=" + c + ", left=" + b);
        d.focus(); return false });
    setTimeout(function() { if (!$(".social-share .fb-like iframe").is(":visible")) { $(".social-share").remove() } }, 10000) }

function social_sharevideo(a) { var b = screen.width / 2 - 700 / 2; var c = screen.height / 2 - 450 / 2;
    $(".facebook_share_button").click(function() { var d = window.open("https://www.facebook.com/sharer.php?u=" + a, "chia sáº»", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=700, height=485, top=" + c + ", left=" + b);
        d.focus(); return false });
    setTimeout(function() { if (!$(".social-share .fb-like iframe").is(":visible")) { $(".social-share").remove() } }, 10000) };
var sohavideo = function(h) { var a = { highlightPlayerId: "object_Kenh14", highlightEmbedCodePlaceHolderElement: h("#video-embeb"), highlightTitleElement: "#video-title", highlightSapoElement: "#video-description", highlightTagsElement: "#video-tags", highlightLikePlaceHolderElement: "#video-like", highlightSharePlaceHolderElement: "#video-share", highlightListPlaceHolder: "#divPlaylistVideo", highlightEmbedCodeText: "#txtVideoEmbedCode", highlightEmbedLinkText: "#txtVideoEmbedLink", listPlaceHolder: "#video-list-content", listPagingPlaceHolder: "#video-paging", lbSlideContentPlaceHolder: "#lb-slide", lbPlayerId: "object_Kenh14_lb", lbEmbedCodePlaceHolderElement: "#lb-video-embed", lbTitleElement: "#lb-video-title", lbSapoElement: "#lb-video-description", lbTagsElement: "#lb-video-tags", lbLikePlaceHolderElement: "#lb-video-like", lbSharePlaceHolderElement: "#lb-video-share", lbListPlaceHolder: "#divPlaylistVideo", lbDivCommentId: "mingid_comments_content", domain: "https://genk.vn", videoImageDomain: "https://video-thumbs.mediacdn.vn", videoWidth: 606, videoHeight: 357, pageSize: 16, classId: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", id: "Id", title: "Name", url: "Url", description: "Description", avatar: "Avatar", videoKey: "KeyVideo", zoneId: "ZoneId", name: "Name", playerName: "PName", tags: "Tags", publishDate: "PublishDate", distributionDate: "DistributionDate" }; var s = new Array(); var b = null; var M = false; var y = document.location.href; var f = document.title; var L = new Array();

    function N(O) { if (O.indexOf("http") != -1) { return O } return String.format("{0}{1}", a.domain, O) }

    function z(O) { return N(String.format("/video-{0}.htm", O[a.id])) }

    function p(U, Q, ab, X) { var ad = "100%"; var aa = "56eafad9ecf65bc827739910530c4ebb"; var ac = 5; var Z = 1; var R = 0; var T = 0; var Y = 0; var W = 0; var O = "mingid_comment_iframe"; var V = "https://comment.vietid.net/comments?app_key={0}&content_url={1}&news_title={2}&num_count={3}&debugcache={4}&min={5}&scroll={6}&http_referer={7}&verify={8}&verify_flag={9}&funny_flag=2&iframe_comment_id={10}&comment_flag=0&news_url_short=0"; var S = String.format(V, aa, U, ab, ac, Z, R, T, Q, Y, W, O); var P = document.createElement("iframe");
        P.setAttribute("width", ad);
        P.setAttribute("height", 238);
        P.setAttribute("border", "medium none");
        P.setAttribute("overflow", "hidden");
        P.setAttribute("scrolling", "no");
        P.setAttribute("frameborder", "0");
        P.setAttribute("id", "mingid_comment_iframe");
        P.setAttribute("src", S);
        h("#" + X).empty().append(P) }

    function n(O, Q, P) { if (O.indexOf("http:") != -1 || O.indexOf("https:") != -1) { if (O.indexOf(a.videoImageDomain) != -1) { O = O.replace(a.videoImageDomain, "") } else { return O } } return String.format("{0}/zoom/{1}_{2}/{3}", a.videoImageDomain.trimEnd("/"), Q, P, O.trimStart("/")) }

    function g(P, O) { if (P.indexOf("http:") != -1 || P.indexOf("https:") != -1) { if (P.indexOf(a.videoImageDomain) != -1) { P = P.replace(a.videoImageDomain, "") } else { return P } } return String.format("{0}/thumb_w/{1}/{2}", a.videoImageDomain.trimEnd("/"), O, P.trimStart("/")) }

    function l(P, O) { P = N(P); return String.format('<iframe src="https://www.facebook.com/plugins/like.php?href={0}&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;send=false" scrolling="no" frameborder="0" allowtransparency="true"></iframe>', P) }

    function o(O) { O = N(O); return String.format('<a class="sharefacebook" href="https://www.facebook.com/sharer.php?u={0}" target="_blank"></a>', O) }

    function u(R, T, P, O, Q) { var U = ""; var S = String.format("https://vscc.hosting.mediacdn.vn/media/{0}", T);
        U += String.format('<object width="{0}" height="{1}" classid="{2}" id="{3}">', O, Q, a.classId, R);
        U += '<param name="wmode" value="transparent">';
        U += String.format('<param name="movie" value="{0}">', S);
        U += '<param name="allowFullScreen" value="true">';
        U += '<param name="flashvars" value="videotag=true&autostart=true">';
        U += '<param name="allowscriptaccess" value="always">';
        U += '<param name="bgcolor" value="#000000">';
        U += String.format('<embed width="{0}" height="{1}"  src="{2}"  id="{3}" name="movie" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="videotag=true&autostart=true" bgcolor="#000000" quality="high"></object>', O, Q, S, R); return U }

    function d() { h(".video-menu .active").click();
        h("html,body").removeClass("no-scroll");
        h(a.lbEmbedCodePlaceHolderElement).empty();
        C();
        j(y, f);
        D(a.highlightPlayerId); if (L && L.length > 0) { for (var O = 0; O < L.length; O++) { F(L[O]) } } }

    function C() { h(".lb-background").fadeToggle() }

    function j(P, O) { if (history && history.pushState) { window.history.pushState("", "", P);
            document.title = O } }

    function i(P) { try { var O = v(P); if (O != null) { O.openlb() } } catch (Q) {} }

    function D(P) { try { var O = v(P); if (O != null) { O.closelb();
                O.resumeVideo() } } catch (Q) {} }

    function v(O) { if (document.embeds[O]) { return document.embeds[O] } return document.getElementById(O) }

    function F(O) { if (typeof(O) == "function") { return O() } return false }

    function J(O) { return s[O] }

    function q(O, P) { s[O] = P; return }

    function H(P, O) { return String.format("{0}_{1}", P, O.join("_")) }

    function m(R) { var Q = H("getVideoDetail", [R]); var O = J(Q); if (O == null) { if (b && b.length > 0) { for (var P = 0; P < b.length; P++) { if (b[P][a.id] == R) { O = b[P];
                        q(Q, O); break } } } } return O }

    function K(O) { v(a.highlightPlayerId).callnext(O[a.videoKey]);
        h(a.highlightTitleElement).text(O[a.title]);
        h(a.highlightSapoElement).text(O[a.description]);
        h(a.highlightTagsElement).html(O[a.tags]);
        h(a.highlightLikePlaceHolderElement).html(l(O[a.url], true));
        h(a.highlightSharePlaceHolderElement).html(o(O[a.url]));
        h(a.highlightEmbedCodeText).val(u(a.lbPlayerId, O[a.videoKey], O[a.playerName], a.videoWidth, a.videoHeight));
        h(a.highlightEmbedLinkText).val(N(O[a.url])) }

    function x(Q, P) { i(a.highlightPlayerId); var O = u(a.lbPlayerId, Q[a.videoKey], Q[a.playerName], a.videoWidth, a.videoHeight);
        h("#lb-txt-embed-code").val(O);
        h("#lb-txt-embed-url").val(N(Q[a.url]));
        h(a.lbEmbedCodePlaceHolderElement).html(O);
        h(a.lbTitleElement).text(Q[a.title]);
        h(a.lbSapoElement).text(Q[a.description]); if (Q[a.tags] != "") { h(a.lbTagsElement).html(Q[a.tags]);
            h(a.lbTagsElement).parent().show() } else { h(a.lbTagsElement).parent().hide() } h(a.lbLikePlaceHolderElement).html(l(Q[a.url], true));
        h(a.lbSharePlaceHolderElement).html(o(Q[a.url]));
        j(Q[a.url], k("{0} VIDEO CLIP | genk.vn", Q[a.title]));
        p(z(Q), N(Q[a.url]), h.base64Encode(encodeURI(Q[a.title])), a.lbDivCommentId); if (!h("html, body").hasClass("no-scroll")) { C();
            h("html,body").addClass("no-scroll") } F(P) }

    function G(W, R, V) { if (W == null) { W = b } if (W && W.length > 0) { var U = ""; var S = 170; var T = 100; var O = "<li><a href='{0}' rel='{3}'><img src='{2}' /></a><h2><a rel='{3}' href='{0}'>{1}</a></h2></li>"; for (var P = 0; P < W.length; P++) { var Y = W[P]; var Q = n(Y[a.avatar], S, T);
                U += k(O, Y[a.url], Y[a.title], Q, Y[a.id]) } U += k(O, V, "", "/Images/morevideo.png", -1);
            h(a.lbSlideContentPlaceHolder).html(U);
            h(".lb-slide ul li").addClass("mcgSlideItem");
            h(".lb-slide ul li:last").addClass("last"); var X = Math.floor((getViewPortWidth() - 100) / h(".lb-slide ul li:first").innerWidth());
            h(a.lbSlideContentPlaceHolder).mcgSlider({ numberOfVisibleSlides: X, nextButton: h(".lb-slide-nav.nav-next"), preButton: h(".lb-slide-nav.nav-prev"), auto: false, autoWidth: true });
            h(".lb-slide ul li a").each(function() { h(this).unbind("click").bind("click", function(ac) { var Z = h(this); var ab = parseInt(Z.attr("rel")); if (ab > 0) { ac.preventDefault(); var aa = m(ab);
                        x(aa, function() { h(".lb-slide ul li.current").removeClass("current");
                            Z.closest("li").addClass("current") }) } }) });
            h(".lb-slide ul li").height(function() { var Z = 0;
                h(".lb-slide ul li").each(function() { if (Z < h(this).height()) { Z = h(this).height() } }); return Z });
            F(R) } }

    function e(U, R, T, Q, S) { var O = H("NewestVideo", [U, R, T]); var P = J(O); if (P && P.length > 0) { G(P, function() { b = P;
                F(Q) }, S); return } M = true;
        h.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/Video/GetNewestVideoByZone.ashx", data: { zoneId: U, pageIndex: R, pageSize: T }, dataType: "json", success: function(V) { q(O, V);
                b = V;
                G(V, function() { F(Q);
                    M = false }, S) } }) }

    function A(T, R, S, Q) { var O = H("NewestVideo", [T, R, S]); var P = J(O); if (P && P.length > 0) { w(P, Q); return } M = true;
        h.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/Video/GetNewestVideoByZone.ashx", data: { zoneId: T, pageIndex: R, pageSize: S }, dataType: "json", success: function(U) { q(O, U);
                w(U, function() { F(Q);
                    M = false }) } }) }

    function c(T, R, S, Q) { var O = H("MostViewVideo", [T, R, S]); var P = J(O); if (P && P.length > 0) { w(P, Q); return } M = true;
        h.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/Video/GetMostViewVideoByZone.ashx", data: { zoneId: T, pageIndex: R, pageSize: S }, dataType: "json", success: function(U) { q(O, U);
                w(U, function() { F(Q);
                    M = false }) } }) }

    function w(T, U) { if (T != null && T.length > 0) { b = T; var aa = ""; var Z = 170; var P = 100; var Y = '<div rel="{4}" class="video-item"><a href="{0}"><img src="{2}" alt="" title="{1}" /></a><div class="video-info"><div class="like-facebook">{3}</div></div><h4><a href="{0}">{1}</a></h4></div>'; var S = '<iframe src="//www.facebook.com/plugins/like.php?locale=vi_VN&amp;href={0}&amp;send=false&amp;layout=button_count&amp;width=84&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=24&amp;appId=433277336731778" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:84px; height:21px;" allowtransparency="true"></iframe>'; for (var V = 0; V < T.length; V++) { var W = T[V]; var O = String.format(S, N(W[a.url])); var X = n(W[a.avatar], Z, P);
                aa += String.format(Y, W[a.url], W[a.title], X, O, W[a.id]) } h(a.listPlaceHolder).html(aa); var Q = h(a.listPlaceHolder).find(".video-item"); var R = '<div class="video-sapatator"></div>';
            Q.each(function() { h(this).on("click", function(ab) { ab.preventDefault();
                    sohavideo.lightboxVideo(parseInt(h(this).attr("rel"))) });
                h(this).find("img:first").after('<img src="http://kenh143.vcmedia.vn/skin/listvideo/video-view-icon.png" alt="" class="icon-video" />'); if ((Q.index(h(this)) + 1) % 4 === 0) { h(this).addClass("video-item-last").after(R) } });
            t(T);
            F(U) } }

    function t(U) { if (U != null && U.length > 0) { var Q = '<li rel="{3}"><a class="link-img" href="{0}"><img id="imgplaylist" alt="" src="{2}" /></a><a class="lnk" href="{0}">{1}</a></li>'; var R = ""; var V = 53; var T = 33; for (var O = 0; O < U.length; O++) { var W = U[O];
                R += String.format(Q, W[a.url], W[a.title], n(W[a.avatar], V, T), W[a.id]) } h(a.highlightListPlaceHolder).html(R);
            h(a.highlightListPlaceHolder).find("li").each(function() { h(this).unbind("click").bind("click", function(Y) { Y.preventDefault(); var X = h(this).attr("rel");
                    sohavideo.highlightVideo(X);
                    h(a.highlightListPlaceHolder).find("li.current").removeClass("current");
                    h(this).addClass("current") }) }); var S = '<img src="/Images/listvideo/video-small-icon.png" class="icon-video">'; var P = '<p class="video-play-status">Now playing</p>';
            h(a.highlightListPlaceHolder + " a.link-img").each(function() { h(this).append(S).after(P) }) } }

    function B(U, R, T, S, Q) { var O = H("countVideoByZone", [U, R, T, S]); var V = J(O); var P; if (V != null) { P = Math.floor(V / T); return E(R, P, S, Q) } h.ajax({ url: DomainConfig.AjaxDomain + "/Handlers/Video/CountVideoByZone.ashx", data: { zoneId: U }, success: function(W) { V = parseInt(W);
                q(O, V);
                P = Math.floor(V / T);
                E(R, P, S, Q) } }); return false }

    function E(T, O, U, Q) { var S = ""; var V = 9; var X = h(a.listPagingPlaceHolder); var R = Math.max(1, T - Math.floor(V / 2)); var W = Math.min(O, T + Math.floor(V / 2)); if (T > 1 && R > 1) { S += I(1, U, "TRANG Äáº¦U");
            S += I(R - 1, U, "...") } for (var P = R; P <= W; P++) { S += I(P, U, P, P === T ? "active" : "") } if (T < O && W < O) { S += I(W + 1, U, "...");
            S += I(O, U, "TRANG CUá»I") } h(X).html(S);
        F(Q) }

    function I(P, O, S, Q) { var R = "javascript:void(0);"; return k("<a href='{0}' class='{3}' title='trang {1}' rel='{1}'>{2}</a>", R, P, S, Q) }

    function k(Q) { if (arguments.length <= 1) { return Q } var O = arguments.length - 2; for (var P = 0; P <= O; P++) { Q = Q.replace(new RegExp("\\{" + P + "\\}", "gi"), arguments[P + 1]) } return Q }

    function r() { h("html,body").delay(1000).animate({ scrollTop: h(a.listPlaceHolder).offset().top - 50 }, "slow") } return { init: function(O) { h.extend(a, O) }, highlightVideo: function(O) { return K(m(O)) }, lightboxVideo: function(O, P) { return x(m(O), function() { G(null, function() {});
                F(P) }) }, setCurrentData: function(O) { b = O }, loadNewVideo: function(R, O, Q, P, S) { if (S == null) { r() } A(R, O, Q, function() { B(R, O, Q, P, function() { h(a.listPagingPlaceHolder).find("a").each(function() { h(this).attr("onclick", k("sohavideo.loadNewVideo({0},{1},{2},'{3}', null);", R, h(this).attr("rel"), Q, P)) }) });
                F(S) }) }, loadMostViewVideo: function(R, O, Q, P, S) { if (S == null) { r() } c(R, O, Q, function() { B(R, O, Q, P, function() { h(a.listPagingPlaceHolder).find("a").each(function() { h(this).attr("onclick", k("sohavideo.loadMostViewVideo({0},{1},{2},'{3}',null);", R, h(this).attr("rel"), Q, P)) }) });
                F(S) }) }, loadNewVideoForLightbox: function(Q, O, P, R, S) { return e(Q, O, P, R, S) }, closeLightbox: function() { return d() }, pushVideoToCache: function(O) { var P = H("getVideoDetail", [O[a.id]]);
            q(P, O) }, onCloseLightbox: function(O) { L.push(O) } } }(jQuery);
var videoHotSlide = { isFirstTimePlay: true, Init: function() { var b = this;
        $(".kbwcli-iframe").click(function() { initVideo($(this)) }); var a = $(".kbwcli-iframe #object_iframeGenkNews");
        a.each(function(h, d) { var i = $(this); if (typeof(i.attr("id")) == "undefined") { i.attr("id", "iframeVideo" + h); var c = i.attr("src");
                c += "&postroll=true&nopre=true&midroll=0.8;20s&replay=true&nonVol=true&volume=0.6";
                c += "&boxVideoID=" + i.attr("id"); if (detectmob()) { c = c.replace("&nopre=true", "");
                    c = c.replace("&midroll=0.8;20s", "") } i.attr("src", c.replace("http://", "https://")) } var f = false,
                g = true; var e;
            $(window).scroll(function(p) { if (e) { window.clearTimeout(e);
                    e = null } var j = document.getElementById(i.attr("id")).clientHeight; var k = getScrollTop() + windowPrototype.wdHeight(); var q = parseInt(getElementTop(i.attr("id"))); var m = parseInt(getElementTop(i.attr("id"))) + j; var l = (q >= getScrollTop() && q <= k); var o = (m >= getScrollTop() && m <= k); var n = i.parents(".VCSortableInPreviewMode"); if (l && o) { if (!f && !b.isFullscreen) { if (g) { g = false;
                            setTimeout(function() { n.find(".loading-vid-icon").hide();
                                admPlayProgress(n) }, 300) } else { if ($.inArray("#" + i.attr("id"), readyVideoIds) >= 0) { b.playVideo(i) } else { waitingVideoIdForReady.push("#" + i.attr("id")) } } f = true } } else { if (!l && !o) { clearTimeout(e);
                        setTimeout(function() { if (f && !b.isFullscreen) { b.stopVideo(i);
                                f = false;
                                g = false } }, 0) } } }) }) }, playVideo: function(a) { var c = $(a); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = { action: "request", method: "play" }; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, stopVideo: function(a) { var c = $(a); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = { action: "request", method: "pause" }; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, hideControlBar: function(a) { var c = $(a); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = 'admReviceMessageToPlayer("hidecontrolbar")'; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, getCurrentTime: function(f, d) { var e = $(f); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", cid: d }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } }, setCurrentTime: function(a, b) { var c = $(a);
        c.attr("src", c.attr("src") + "&currentTime=" + b);
        waitingVideoIdForReady.push(a) }, seekCurrentTime: function(g, d) { var f = this; var e = $(g); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", args: [d] }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } setTimeout(function() { f.playVideo(g) }, 100) }, changeIsFullscreen: function() { var a = this;
        a.isFullscreen = !a.isFullscreen } };

function initVideo(a) { if (a.attr("data-isInitIframe") == 0) { videoHD.init(a, false);
        a.find(".fill-play-video").remove(); var a = a.find(".kscnhsl-thumb");
        a.addClass("hidden");
        a.attr("data-isInitIframe", 1);
        a.after('<span class="playLoading" />');
        setTimeout(function() { a.parents(".kbwcli-iframe").find("img, .playLoading").remove();
            a.removeClass("hidden") }, 1000) } }

function playVideo(a) { var c = a.find("iframe"); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = 'admReviceMessageToPlayer("playvideo")'; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }

function stopVideo(a) { var c = a.find("iframe"); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = 'admReviceMessageToPlayer("pausevideo")'; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }
var admStreamVideo = new function() { this.onReadyVideo = function(a) { var c = document.getElementById(a); if (c) { var b = 'admReviceMessageToPlayer("playvideo")'; if (c.contentWindow) { c.contentWindow.postMessage(b, "*") } } } };
var detectmob = function() { if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || navigator.userAgent.match(/Windows Phone/i)) { return true } else { return false } };
var videoHD = { typeAppend: 1, isMute: false, isSuggest: true, isAd: true, isHideControlbar: false, originDomain: "*", suggsetDomain: "/Handler/Video/ListVideoXML.ashx?_videoid=", divVideoFormat: '<div class="VCSortableInPreviewMode" type="VideoStream"></div>', divIfrWrapperFormat: '<div class="iframe-wraper"></div>', videoFormat: '<div class="iframe-wraper">{4}<iframe width="{0}" height="{1}" src="{2}" id="ifVideo-{3}" frameborder="0" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen="" oallowfullscreen="" scrolling="no"></iframe></div>', bgFormat: '<div class="bg-wraper" style="background-image: url({0});"><div class="loading-vid-icon"><div class="lvc-label">{1}</div><div class="lvc-play-icon"></div></div><div class="loading-vid-countdown" style="display: none"><div class="lvc-label">{1}</div><div class="lvc-circle"></div><div class="lvc-line-mask"><div class="lvc-line"></div></div><span style="display: none;"class="lvc-number">3</span></div></div>', bgText: "Video tá»± Ä‘á»™ng phÃ¡t", bgPauseNotify: '<div class="pause-vd-notify" style="display: none;"><span class="clearfix"><svg width="9" height="12"><path d="M0,0V12H3V0ZM6,0V12H9V0Z"></path></svg>Video táº¡m dá»«ng</span></div>', host: "https://mediacdn.vcmedia.vn/1.1/?_site=genk&vid=genk/", videoStorage: "https://video-thumbs.mediacdn.vn/", useBg: true, init: function(b, d) { var a = this; if (typeof(d) == "undefined") { d = {} } if (typeof(d.useBg) != "undefined") { a.useBg = d.useBg } var e; if (d.type) { e = a.getVideoType(d.type); if (e.playType == a.playType.clickToPlay || e.playType == a.playType.autoplay) { a.useBg = false } } if (d.isAd) { a.isAd = d.isAd } if (d.isHideControlbar) { a.isHideControlbar = d.isHideControlbar } if (detectmob() || !a.useBg) { a.bgPauseNotify = "" } var c = $(b).find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
        c.each(function(m, f) { var h = $(this); if (h.is(":visible")) { if (typeof(h.attr("id")) == "undefined") { var n = m; var g = "ifVideo-" + n; while ($('iframe[id="' + g + '"]').length > 0) { n = Math.floor((Math.random() * 1000) + 1);
                        g = "ifVideo-" + n } h.attr("id", g); var j = h.attr("src");
                    j = a.genVideoSource(j, n, e); if (j != "") { h.attr("src", j.replace("http://", "https://"));
                        h.attr("playType", getParameterByName("playType", j)); if (a.useBg && !detectmob()) { var o = h.parent(); if (!h.parent().hasClass("VCSortableInPreviewMode")) { o = $(a.divVideoFormat);
                                h.after(o) } else { if (o.hasClass("VCSortableInPreviewMode") && o.attr("type") == "insertembedcode") { o.attr("type", "VideoStream") } } var i = $(a.divIfrWrapperFormat);
                            o.append(i);
                            o.addClass("pos-rlt");
                            o.find(".iframe-wraper").append(a.bgPauseNotify);
                            o.find(".iframe-wraper").append(h); var k = a.videoStorage + "/thumb_w/650/" + getParameterByName("vid", j).toLowerCase().replace(".mp4", ".jpg").replace(".flv", ".jpg"); var l = String.format(a.bgFormat, k, a.bgText);
                            o.find(".iframe-wraper").append(l);
                            o.find(".bg-wraper").height(o.find("iframe").height()) } } } } });
        $(b).find(".VCSortableInPreviewMode[type=VideoStream]").each(function() { var n = $(this); if (n.find("iframe").length == 0) { var h = n.attr("data-width"); var i = n.attr("data-height"); var f = n.attr("data-src"); var g = n.attr("videoid"); var m = "ifVideo-" + g; while ($('iframe[id="' + m + '"]').length > 0) { g = Math.floor((Math.random() * 1000) + 1);
                    m = "ifVideo-" + g } n.attr("videoid", g);
                f = a.genVideoSource(f, g, e); if (f != "") { var k = String.format(a.videoFormat, h, i, f, g, a.bgPauseNotify);
                    n.find('>div[videoid="' + g + '"]').remove();
                    n.css("text-align", "center"); var j = a.videoStorage + "/thumb_w/650/" + getParameterByName("vid", f).toLowerCase().replace(".mp4", ".jpg").replace(".flv", ".jpg"); var l = String.format(a.bgFormat, j, a.bgText);
                    n.addClass("pos-rlt"); if (a.typeAppend === 0) { n.append(k); if (a.useBg && !detectmob()) { n.find(".iframe-wraper").append(l) } } else { n.prepend(k); if (a.useBg && !detectmob()) { n.find(".iframe-wraper").prepend(l) } } n.find("iframe").attr("playType", getParameterByName("playType", f)) } } });
        $(b).find(".VCSortableInPreviewMode[type=VideoStream] .bg-wraper").each(function() { var f = $(this);
            f.click(function() { var g = f.parents(".VCSortableInPreviewMode");
                admPlayNow(g) }) }) }, buildEmbedVideo: function(c, d, i, a, h, f) { var g = this; var e = g.host + a;
        e += "&_info=" + h; var b = "0;0;0;0"; if (typeof admParamTvc === "function") { b = admParamTvc(0) } e += "&_admParamTvc=" + b; if (f) { e += "&autoplay=" + f } if (g.isSuggest) { e += "&_listsuggest=" + g.suggsetDomain + i } return String.format(g.videoFormat, c, d, e, i, g.bgPauseNotify) }, videoFunction: function(c, d) { var a = this; var b; switch (d) {
            case "play":
                b = { action: "play" };
                $(c).get(0).contentWindow.postMessage(b, a.originDomain); break;
            case "pause":
                b = { action: "pause" };
                $(c).get(0).contentWindow.postMessage(b, a.originDomain); break } }, listFocus: function(b, j, a, c) { var f = this; if ($(b).hasClass("playing")) { return } $(b).parent().find("li").removeClass("playing");
        $(b).addClass("playing"); var i = $(b).attr("data-id"); var d = $(b).attr("data-filename"); var g = $(b).attr("data-key"); var e = f.buildEmbedVideo(j, a, i, d, g, true); if (c != null) { $(c).html(e) } else { $("#video-player-wrapt").html(e) } }, genVideoSource: function(b, c, e) { if (b == "undefined" || b == null) { return "" } var a = this; if (e) { if (b.indexOf("mute") < 0) { b += "&mute=" + e.isMute } if (b.indexOf("vtype") < 0) { b += "&vtype=" + e.vtype } if (b.indexOf("playType") < 0) { b += "&playType=" + e.playType } if (e.playType == a.playType.autoplay) { b += "&autoplay=true" } } b = b.replace("&amp;", "&").replace("_tag=https://vscc.hosting.vcmedia.vn/tag/", "_info="); var d = "0;0;0;0"; if (typeof admParamTvc === "function") { d = admParamTvc(0) } b += "&_admParamTvc=" + d; if (a.isSuggest) { b += "&_listsuggest=" + a.suggsetDomain + c } if (a.isHideControlbar) { b += "&_controlbar=hide" } if (b.indexOf("postroll") < 0) { b += "&postroll=true" } if (b.indexOf("replay") < 0) { b += "&replay=true" } if (b.indexOf("nonVol") < 0) { b += "&nonVol=true" } if (b.indexOf("volume") < 0) { b += "&volume=0.6" } b += "&boxVideoID=ifVideo-" + c; if (detectmob()) { b = b.replace("&nopre=true", "");
            b = b.replace("&midroll=0.8;20s", "") } else { if (b.indexOf("nopre") < 0) { b += "&nopre=true" } if (!a.isAd) { b += "&tag=0";
                b = b.replace("&midroll=0.8;20s", "") } else { if (b.indexOf("midroll") < 0) { b += "&midroll=0.8;20s" } } } b += "&consoleLog=true"; return b }, playType: { viewable: 0, autoplay: 1, clickToPlay: 2 }, videoType: { newsDetail: 1, stream: 2, videoDetail: 3, boxVideo: 4, newsBottom: 5, boxMutex: 6, clickToPlay: 7, zoneVideo: 8 }, getVideoType: function(b) { var a = this; switch (b) {
            case 1:
                return { vtype: "1", position: "bÃ i chi tiáº¿t", playType: a.playType.viewable, isMute: false, note: "" }; break;
            case 2:
                return { vtype: "2", position: "stream", playType: a.playType.viewable, isMute: true, note: "" }; break;
            case 3:
                return { vtype: "3", position: "video chi tiáº¿t", playType: a.playType.autoplay, isMute: false, note: "" }; break;
            case 4:
                return { vtype: "4", position: "box cáº¯t ngang", playType: a.playType.viewable, isMute: true, note: "unmute khi má»Ÿ popup" }; break;
            case 5:
                return { vtype: "5", position: "video chÃ¢n bÃ i", playType: a.playType.viewable, isMute: true, note: "unmute khi má»Ÿ popup" }; break;
            case 6:
                return { vtype: "6", position: "box mutex", playType: a.playType.viewable, isMute: true, note: "" }; break;
            case 7:
                return { vtype: "7", position: "video áº¥n má»›i cháº¡y", playType: a.playType.clickToPlay, isMute: false, note: "" }; break;
            case 8:
                return { vtype: "8", position: "chuyÃªn má»¥c video", playType: a.playType.viewable, isMute: true, note: "" }; break;
            default:
                return { vtype: "2", position: "stream", playType: a.playType.viewable, isMute: true, note: "" }; break } } };
var videoData = { getViewUrl: "/ajax-viewvideo.chn", getViewData: function() { var a = this; var c = ""; var d = 0; var b = $(".need-get-view");
        b.each(function(e, f) { if (d == 0) { c += $(this).attr("data-key") } else { c += "," + $(this).attr("data-key") } d++ });
        $.ajax({ type: "POST", url: a.getViewUrl, data: { key: c }, dataType: "json", success: function(e) { $.each(e.Data, function(i, f) { var g = $(".need-get-view[data-key='" + f.MediaKey + "']"); if (f.play > 0) { var h = numeral(f.play).format("0,0a").replace(",", ".");
                        g.html(h + " lÆ°á»£t xem");
                        g.show();
                        g.removeClass("need-get-view") } g.removeClass("need-get-view") }) }, error: function() { console.log("c") } }) } };
if (typeof(getElementTop) == "undefined") { var getElementTop = function(b) { if (document.getElementById) { var a = document.getElementById(b) } else { if (document.all) { var a = document.all[b] } } if (a != null) { yPos = a.offsetTop;
            tempEl = a.offsetParent; while (tempEl != null) { yPos += tempEl.offsetTop;
                tempEl = tempEl.offsetParent } return yPos } else { return 0 } } }

function admPlayNow(b) { var c = $(b); var a = c.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]'); if ($.inArray("#" + a.attr("id"), readyVideoIds) >= 0) { videoInContent.playVideo(a) } else { waitingVideoIdForReady.push("#" + a.attr("id")) } c.find(".bg-wraper").hide() }

function getScrollTop() { var a = document.body.scrollTop; if (a == 0) { if (window.pageYOffset) { a = window.pageYOffset } else { a = (document.body.parentElement) ? document.body.parentElement.scrollTop : 0 } } return a }
var currentTimingVideo = null;
var waitingVideoIdForReady = [];
var readyVideoIds = [];

function admPlayProgress(a) { var b = 3; var e = $(a); if (currentTimingVideo != e && currentTimingVideo != null) { currentTimingVideo.find(".bg-wraper").hide() } currentTimingVideo = e; var c = e.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]'); if (e.find(".bg-wraper").length > 0) { e.find(".loading-vid-countdown").fadeIn(1500);
        e.find(".loading-vid-countdown").addClass("quickspin");
        e.find(".bg-wraper").addClass("bgPoster"); if (detectmob()) { setTimeout(function() { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInContent.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } e.find(".bg-wraper").hide() }, 1000) } else { e.find(".lvc-label").show();
            e.find(".lvc-number").show(); var d = setInterval(function() { if (b == 2) { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInContent.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } } if (b > 0) { e.find(".lvc-number").html(b) } else { clearInterval(d);
                    e.find(".bg-wraper").hide() } b = b - 1 }, 500) } } else { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInContent.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } } }

function getParameterByName(d, a) { if (!a) { a = window.location.href } d = d.replace(/[\[\]]/g, "\\$&"); var b = new RegExp("[?&]" + d + "(=([^&#]*)|&|#|$)"),
        c = b.exec(a); if (!c) { return null } if (!c[2]) { return "" } return decodeURIComponent(c[2].replace(/\+/g, " ")) }
if (!windowPrototype) { var windowPrototype = { wdHeight: function() { var b; "number" == typeof window.innerWidth ? b = window.innerHeight : document.documentElement && document.documentElement.clientHeight ? b = document.documentElement.clientHeight : document.body && document.body.clientHeight && (b = document.body.clientHeight); return b }, wdWidth: function() { var b; "number" == typeof window.innerWidth ? b = window.innerWidth : document.documentElement && document.documentElement.clientWidth ? b = document.documentElement.clientWidth : document.body && document.body.clientWidth && (b = document.body.clientWidth); return b } },
        Browser = { Version: function() { var b = 999; - 1 != navigator.appVersion.indexOf("MSIE") && (b = parseFloat(navigator.appVersion.split("MSIE")[1])); return b } },
        browserVersion = Browser.Version(),
        admwdHeight = parseInt(windowPrototype.wdHeight()) }
var videoInContent = { isFullscreen: false, init: function(b) { if (detectmob()) { return } var a = this; var c = "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange";
        $(document).on(c, function() { a.changeIsFullscreen() }); var d = $(b).find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
        d.each(function(j, f) { var k = $(this); if (typeof(k.attr("id")) == "undefined") { k.attr("id", "iframeVideo" + j); var e = k.attr("src");
                e += "&postroll=true&nopre=true&midroll=0.8;20s&replay=true&nonVol=true&volume=0.6";
                e += "&boxVideoID=" + k.attr("id"); if (detectmob()) { e = e.replace("&nopre=true", "");
                    e = e.replace("&midroll=0.8;20s", "") } k.attr("src", e.replace("http://", "https://")) } var h = false,
                i = true; var g;
            $(window).scroll(function(l) { if (g) { window.clearTimeout(g);
                    g = null } var p = k.parents(".VCSortableInPreviewMode"); var n = k.attr("id"); var o = k.attr("data-playstatus");
                h = o === "playing"; var m = isElementVisible(document.getElementById(n)); if (m == "play") { if (!h && !a.isFullscreen) { if (i) { i = false;
                            setTimeout(function() { p.find(".loading-vid-icon").hide();
                                admPlayProgress(p) }, 300) } else { if ($.inArray("#" + n, readyVideoIds) >= 0) { a.playVideo(k) } else { waitingVideoIdForReady.push("#" + n) } } h = true } } else { if (m == "pause") { clearTimeout(g);
                        setTimeout(function() { if (h && !a.isFullscreen) { a.stopVideo(k);
                                h = false;
                                i = false } }, 0) } } }) }) }, playVideo: function(g) { var f = this; var e = $(g);
        f.stopAllVideo(); var a = isElementVisible(document.getElementById(e.attr("id"))); if (a == "play") { var c = e.attr("id");
            e.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").hide(); var b = document.getElementById(c); if (b) { e.attr("data-playstatus", "playing"); var d = { action: "request", method: "play" }; if (b.contentWindow) { b.contentWindow.postMessage(d, "*") } } } }, stopAllVideo: function() { var a = this;
        $('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]').each(function() { var b = $(this);
            a.stopVideo("#" + b.attr("id"));
            b.attr("data-playstatus", "stopping") }) }, stopVideo: function(a) { var c = $(a);
        c.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").show(); var d = c.attr("id"); var e = document.getElementById(d);
        c.attr("data-playstatus", "stopping"); if (e) { var b = { action: "request", method: "pause" }; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, hideControlBar: function(a) { var c = $(a); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = 'admReviceMessageToPlayer("hidecontrolbar")'; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, getCurrentTime: function(f, d) { var e = $(f); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", cid: d }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } }, setCurrentTime: function(a, b) { var c = $(a);
        c.attr("src", c.attr("src") + "&currentTime=" + b);
        waitingVideoIdForReady.push(a) }, seekCurrentTime: function(g, d) { var f = this; var e = $(g); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", args: [d] }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } setTimeout(function() { f.playVideo(g) }, 100) }, changeIsFullscreen: function() { var a = this;
        a.isFullscreen = !a.isFullscreen } };
window.addEventListener ? window.addEventListener("message", function(a) { listenPlayer(a) }, !1) : window.attachEvent && window.attachEvent("onmessage", function(a) { listenPlayer(a) });

function isElementVisible(f) { if (f == null) { return } var c = f.getBoundingClientRect(),
        d = window.innerHeight || doc.documentElement.clientHeight; var b = (c.top >= 0 && c.top <= d); var e = (c.bottom >= 0 && c.bottom <= d); var a = (c.bottom - (f.clientHeight - (f.clientHeight / 2)) >= 0 && c.bottom <= d); if (b && a) { return "play" } else { if (!b && !a) { return "pause" } } return "" }

function listenPlayer(a) { if (-1 != a.origin.indexOf("vcplayer.vcmedia.vn") || -1 != a.origin.indexOf("123.31.11.105") || -1 != a.origin.indexOf("vcplayer.mediacdn.vn")) { if ("object" == typeof a.data) { if (typeof(a.data.method) != "undefined") { switch (a.data.method) {
                    case "currentTime":
                        if (typeof(a.data.rid) === "object") { videoInContent.seekCurrentTime(a.data.rid.id, a.data.data) } else { videoInContent.setCurrentTime(a.data.rid, a.data.data) } break } } else { if (typeof(a.data.event) != "undefined") { switch (a.data.event) {
                        case "canplaythrough":
                            $("#" + a.data.boxVideoID).parent().show(); break } } else { if (typeof(a.data.action) != "undefined") { switch (a.data.action) {
                            case "ready":
                                var c = "#" + a.data.boxVideoID;
                                readyVideoIds.push(c); if (waitingVideoIdForReady.length > 0) { if ($.inArray(c, waitingVideoIdForReady) >= 0) { videoInContent.playVideo(c);
                                        waitingVideoIdForReady.splice($.inArray(c, waitingVideoIdForReady), 1) } } break } } } } } } }

function admPlayProgressPopup(a) { var b = 3; var e = $(a); if (currentTimingVideo != e && currentTimingVideo != null) { currentTimingVideo.find(".bg-wraper").hide() } currentTimingVideo = e; var c = e.find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]'); if (e.find(".bg-wraper").length > 0) { e.find(".loading-vid-countdown").fadeIn(1500);
        e.find(".loading-vid-countdown").addClass("quickspin");
        e.find(".bg-wraper").addClass("bgPoster"); if (detectmob()) { setTimeout(function() { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInPopup.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } e.find(".bg-wraper").hide() }, 1000) } else { e.find(".lvc-label").show();
            e.find(".lvc-number").show(); var d = setInterval(function() { if (b == 2) { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInPopup.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } } if (b > 0) { e.find(".lvc-number").html(b) } else { clearInterval(d);
                    e.find(".bg-wraper").hide() } b = b - 1 }, 500) } } else { if ($.inArray("#" + c.attr("id"), readyVideoIds) >= 0) { videoInContent.playVideo(c) } else { waitingVideoIdForReady.push("#" + c.attr("id")) } } }
var videoInPopup = { isFullscreen: false, init: function(b) { var a = this; var c = "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange";
        $(document).on(c, function() { a.changeIsFullscreen() }); var d = $(b).find('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]');
        d.each(function(j, f) { var k = $(this); if (k.parents(".body-full").length > 0) { k.addClass("vidhidden") } if (typeof(k.attr("id")) == "undefined") { k.attr("id", "iframeVideo" + j); var e = k.attr("src");
                e += "&postroll=true&nopre=true&midroll=0.8;20s&replay=true&nonVol=true&volume=0.6";
                e += "&boxVideoID=" + k.attr("id");
                k.attr("src", e.replace("https://", "http://").replace("http://", "//")) } var h = false,
                i = true; var g;
            $(".light-box-content").scroll(function(p) { var m = $(".light-box-content"); var o = m.scrollTop(); if (g) { window.clearTimeout(g);
                    g = null } var l = k.parents(".VCSortableInPreviewMode"); var n = isElementVisible(document.getElementById(k.attr("id"))); if (n == "play") { if (!h && !a.isFullscreen) { if (i) { i = false;
                            setTimeout(function() { l.find(".loading-vid-icon").hide();
                                admPlayProgressPopup(l) }, 300) } else { if ($.inArray("#" + k.attr("id"), readyVideoIds) >= 0) { a.playVideo(k) } else { waitingVideoIdForReady.push("#" + k.attr("id")) } } h = true } } else { if (n == "pause") { clearTimeout(g);
                        setTimeout(function() { if (h && !a.isFullscreen) { a.stopVideo(k);
                                h = false;
                                i = false } }, 0) } } }) }) }, playVideo: function(g) { var f = this; var e = $(g); if (e.hasClass("vidhidden")) { return } f.stopAllVideo(); var a = isElementVisible(document.getElementById(e.attr("id"))); if (a == "play") { var c = e.attr("id");
            e.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").hide(); var b = document.getElementById(c); if (b) { var d = { action: "request", method: "play" }; if (b.contentWindow) { b.contentWindow.postMessage(d, "*") } } } }, stopVideo: function(a) { var c = $(a);
        c.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").show(); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = { action: "request", method: "pause" }; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, stopAllVideo: function() { var a = this;
        $('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]').each(function() { var b = $(this);
            a.stopVideo("#" + b.attr("id"));
            b.attr("data-playstatus", "stopping") }) }, changeIsFullscreen: function() { var a = this;
        a.isFullscreen = !a.isFullscreen } };
/* SpriteSpin - v3.0.0 - 2014-05-17
 * Copyright (c) 2014 ; Licensed  */
(function(f) { var h = window.SpriteSpin = {}; var j = h.namespace = "spritespin"; var i = ["mousedown", "mousemove", "mouseup", "mouseenter", "mouseover", "mouseleave", "dblclick", "touchstart", "touchmove", "touchend", "touchcancel", "selectstart", "gesturestart", "gesturechange", "gestureend"];
    h.mods = {};
    h.defaults = { source: undefined, width: undefined, height: undefined, frames: undefined, framesX: undefined, lanes: 1, module: "360", behavior: "drag", renderer: "canvas", lane: 0, frame: 0, frameTime: 40, animate: true, reverse: false, loop: true, stopFrame: 0, wrap: true, wrapLane: false, sense: 1, senseLane: undefined, orientation: "horizontal", onInit: undefined, onProgress: undefined, onLoad: undefined, onFrame: undefined, onDraw: undefined };

    function a(l, m, n) { l = String(l); while (l.length < m) { l = String(n) + l } return l }

    function g(l, m, n) { return (l > n ? n : (l < m ? m : l)) }

    function b(l, m, o, n) { while (l > o) { l -= n } while (l < m) { l += n } return l }

    function k(l) { l.preventDefault(); return false }

    function c(l, m, n) { if (n) { l.bind(m + "." + j, n) } }

    function d(l) { l.unbind("." + j) }

    function e(q) { var l = (typeof q.source === "string") ? [q.source] : q.source; var m, n = 0,
            o, p = []; var r = function() { n += 1; if (typeof q.progress === "function") { q.progress({ loaded: n, total: l.length, percent: Math.round((n / l.length) * 100) }) } if (n === p.length && typeof q.complete === "function") { q.complete(p) } }; for (m = 0; m < l.length; m += 1) { o = new Image();
            p.push(o);
            o.onload = o.onabort = o.onerror = r;
            o.src = l[m] } } h.sourceArray = function(n, s) { var r = 0,
            o = 0,
            v = 0,
            t = 0,
            q = s.digits || 2; if (s.frame) { r = s.frame[0];
            o = s.frame[1] } if (s.lane) { v = s.lane[0];
            t = s.lane[1] } var m, p, l, u = []; for (m = v; m <= t; m += 1) { for (p = r; p <= o; p += 1) { l = n.replace("{lane}", a(m, q, 0));
                l = l.replace("{frame}", a(p, q, 0));
                u.push(l) } } return u };
    h.measureSource = function(l) { if (l.images.length === 1) { l.sourceWidth = l.images[0].width;
            l.sourceHeight = l.images[0].height;
            l.framesX = l.framesX || l.frames; if (!l.frameWidth || !l.frameHeight) { if (l.framesX) { l.frameWidth = Math.floor(l.sourceWidth / l.framesX); var m = Math.ceil((l.frames * l.lanes) / l.framesX);
                    l.frameHeight = Math.floor(l.sourceHeight / m) } else { l.frameWidth = l.images[0].width;
                    l.frameHeight = l.images[0].height } } } else { l.sourceWidth = l.frameWidth = l.images[0].width;
            l.sourceHeight = l.frameHeight = l.images[0].height;
            l.frames = l.frames || l.images.length } };
    h.resetInput = function(l) { l.startX = l.startY = undefined;
        l.currentX = l.currentY = undefined;
        l.oldX = l.oldY = undefined;
        l.dX = l.dY = l.dW = 0;
        l.ddX = l.ddY = l.ddW = 0 };
    h.updateInput = function(m, l) { if (m.touches === undefined && m.originalEvent !== undefined) { m.touches = m.originalEvent.touches } l.oldX = l.currentX;
        l.oldY = l.currentY; if (m.touches !== undefined && m.touches.length > 0) { l.currentX = m.touches[0].clientX;
            l.currentY = m.touches[0].clientY } else { l.currentX = m.clientX;
            l.currentY = m.clientY } if (l.startX === undefined || l.startY === undefined) { l.startX = l.currentX;
            l.startY = l.currentY;
            l.clickframe = l.frame;
            l.clicklane = l.lane } l.dX = l.currentX - l.startX;
        l.dY = l.currentY - l.startY;
        l.ddX = l.currentX - l.oldX;
        l.ddY = l.currentY - l.oldY;
        l.ndX = l.dX / l.width;
        l.ndY = l.dY / l.height;
        l.nddX = l.ddX / l.width;
        l.nddY = l.ddY / l.height };
    h.updateFrame = function(l, m, n) { if (m !== undefined) { l.frame = Number(m) } else { if (l.animation) { l.frame += (l.reverse ? -1 : 1) } } if (l.animation) { l.frame = b(l.frame, 0, l.frames - 1, l.frames); if (!l.loop && (l.frame === l.stopFrame)) { l.animate = false;
                h.stopAnimation(l) } } else { if (l.wrap) { l.frame = b(l.frame, 0, l.frames - 1, l.frames) } else { l.frame = g(l.frame, 0, l.frames - 1) } } if (n !== undefined) { l.lane = n;
            l.lane = g(l.lane, 0, l.lanes - 1) } l.target.trigger("onFrame", l);
        l.target.trigger("onDraw", l) };
    h.stopAnimation = function(l) { if (l.animation) { window.clearInterval(l.animation);
            l.animation = null } };
    h.setAnimation = function(l) { h.stopAnimation(l); if (l.animate) { l.animation = window.setInterval(function() { try { h.updateFrame(l) } catch (m) {} }, l.frameTime) } };
    h.setModules = function(n) { var l, o, m; for (l = 0; l < n.mods.length; l += 1) { o = n.mods[l]; if (typeof o === "string") { m = h.mods[o]; if (!m) { f.error("No module found with name " + o) } else { n.mods[l] = m } } } };
    h.setLayout = function(m) { m.target.attr("unselectable", "on").css({ "-ms-user-select": "none", "-moz-user-select": "none", "-khtml-user-select": "none", "-webkit-user-select": "none", "user-select": "none" }); var o = Math.floor(m.width || m.frameWidth || m.target.innerWidth()); var l = Math.floor(m.height || m.frameHeight || m.target.innerHeight());
        m.target.css({ width: o, height: l, position: "relative", overflow: "hidden" }); var n = { width: "100%", height: "100%", top: 0, left: 0, bottom: 0, right: 0, position: "absolute" };
        m.stage.css(n).hide(); if (m.canvas) { m.canvas[0].width = o;
            m.canvas[0].height = l;
            m.canvas.css(n).hide() } };
    h.setEvents = function(p) { var m, n, o, l = p.target;
        d(l); for (n = 0; n < i.length; n += 1) { c(l, i[n], k) } for (m = 0; m < p.mods.length; m += 1) { o = p.mods[m]; for (n = 0; n < i.length; n += 1) { c(l, i[n], o[i[n]]) } c(l, "onInit", o.onInit);
            c(l, "onLoad", o.onLoad);
            c(l, "onFrame", o.onFrame);
            c(l, "onDraw", o.onDraw) } c(l, "onLoad", function(r, q) { h.setAnimation(q) });
        c(l, "onInit", p.onInit);
        c(l, "onProgress", p.onProgress);
        c(l, "onLoad", p.onLoad);
        c(l, "onFrame", p.onFrame);
        c(l, "onDraw", p.onDraw) };
    h.boot = function(l) { h.setModules(l);
        h.setLayout(l);
        h.setEvents(l);
        l.target.addClass("loading").trigger("onInit", l);
        e({ source: l.source, progress: function(m) { l.target.trigger("onProgress", m) }, complete: function(m) { l.images = m;
                h.measureSource(l);
                l.stage.show();
                l.target.removeClass("loading").trigger("onLoad", l).trigger("onFrame", l).trigger("onDraw", l) } }) };
    h.create = function(n) { var o = n.target; var m = o.data(j); if (!m) { m = f.extend({}, h.defaults, n);
            m.source = m.source || [];
            o.find("img").each(function() { m.source.push(f(this).attr("src")) });
            o.empty().addClass("spritespin-instance").append("<div class='spritespin-stage'></div>"); if (m.renderer === "canvas") { var l = f("<canvas class='spritespin-canvas'></canvas>")[0]; if (!!(l.getContext && l.getContext("2d"))) { m.canvas = f(l);
                    m.context = l.getContext("2d");
                    o.append(m.canvas);
                    o.addClass("with-canvas") } else { m.renderer = "image" } } m.target = o;
            m.stage = o.find(".spritespin-stage");
            o.data(j, m) } else { f.extend(m, n) } if (typeof m.source === "string") { m.source = [m.source] } if (m.behavior || m.module) { m.mods = []; if (m.behavior) { m.mods.push(m.behavior) } if (m.module) { m.mods.push(m.module) } delete m.behavior;
            delete m.module } h.boot(m) };
    h.destroy = function(l) { if (l) { h.stopAnimation(l);
            d(l.target);
            l.target.removeData(j) } };
    h.registerModule = function(m, l) { if (h.mods[m]) { f.error("Module name is already taken: " + m) } l = l || {};
        h.mods[m] = l; return l };
    h.Api = function(l) { this.data = l };
    h.extendApi = function(l) { var n, m = h.Api.prototype; for (n in l) { if (l.hasOwnProperty(n)) { if (m[n]) { f.error("API method is already defined: " + n) } else { m[n] = l[n] } } } return m };
    f.fn.spritespin = function(l) { if (l === "data") { return this.data(j) } if (l === "api") { return new h.Api(this.data(j)) } if (l === "destroy") { return f(this).each(function() { h.destroy(f(this).data(j)) }) } if (typeof l === "object") { l.target = l.target || f(this); return h.create(l) } return f.error("Invalid call to spritespin") } }(window.jQuery || window.Zepto || window.$));
(function(a) { var b = window.SpriteSpin;
    b.extendApi({ isPlaying: function() { return this.data.animation !== null }, isLooping: function() { return this.data.loop }, toggleAnimation: function() { this.data.animate = !this.data.animate;
            b.setAnimation(this.data) }, stopAnimation: function() { this.data.animate = false;
            b.setAnimation(this.data) }, startAnimation: function() { this.data.animate = true;
            b.setAnimation(this.data) }, loop: function(c) { this.data.loop = c;
            b.setAnimation(this.data); return this }, currentFrame: function() { return this.data.frame }, updateFrame: function(c) { b.updateFrame(this.data, c); return this }, skipFrames: function(d) { var c = this.data;
            b.updateFrame(c, c.frame + (c.reverse ? -d : +d)); return this }, nextFrame: function() { return this.skipFrames(1) }, prevFrame: function() { return this.skipFrames(-1) }, playTo: function(c) { this.data.animate = true;
            this.data.loop = false;
            this.data.stopFrame = c;
            b.setAnimation(this.data); return this } }) }(window.jQuery || window.Zepto || window.$));
(function(a, b) { b.registerModule("click", { mouseup: function(c) { var h = a(this),
                d = h.data("spritespin");
            b.updateInput(c, d); var g, f; if (d.orientation === "horizontal") { g = d.target.innerWidth() / 2;
                f = d.currentX - d.target.offset().left } else { g = d.target.innerHeight() / 2;
                f = d.currentY - d.target.offset().top } if (f > g) { h.spritespin("next") } else { h.spritespin("prev") } } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(a, b) { b.registerModule("drag", { mousedown: function(d) { var c = a(this).spritespin("data");
            b.updateInput(d, c);
            c.dragging = true }, mousemove: function(i) { var d, h, j, g, f = a(this),
                c = f.spritespin("data"); if (c.dragging) { b.updateInput(i, c); if (c.orientation === "horizontal") { d = c.ndX * c.frames * c.sense;
                    h = c.ndY * c.lanes * (c.senseLane || c.sense) } else { d = c.ndY * c.frames * c.sense;
                    h = c.ndX * c.lanes * (c.senseLane || c.sense) } g = Math.floor(c.clickframe + d);
                j = Math.floor(c.clicklane + h);
                b.updateFrame(c, g, j);
                c.animate = false;
                b.stopAnimation(c) } }, mouseup: function() { var d = a(this),
                c = d.spritespin("data");
            b.resetInput(c);
            c.dragging = false }, mouseleave: function() { var d = a(this),
                c = d.spritespin("data");
            b.resetInput(c);
            c.dragging = false } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(a, b) { b.registerModule("hold", { mousedown: function(c) { var f = a(this),
                d = f.spritespin("data");
            b.updateInput(c, d);
            d.onDrag = true;
            f.spritespin("animate", true) }, mousemove: function(c) { var h = a(this),
                d = h.spritespin("data"); if (d.onDrag) { b.updateInput(c, d); var g, f; if (d.orientation === "horizontal") { g = (d.target.innerWidth() / 2);
                    f = (d.currentX - d.target.offset().left - g) / g } else { g = (d.height / 2);
                    f = (d.currentY - d.target.offset().top - g) / g } d.reverse = f < 0;
                f = f < 0 ? -f : f;
                d.frameTime = 80 * (1 - f) + 20 } }, mouseup: function() { var d = a(this),
                c = d.spritespin("data");
            b.resetInput(c);
            c.onDrag = false;
            d.spritespin("animate", false) }, mouseleave: function() { var d = a(this),
                c = d.spritespin("data");
            b.resetInput(c);
            c.onDrag = false;
            d.spritespin("animate", false) }, onFrame: function() { var c = a(this);
            c.spritespin("animate", true) } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(a, b) { b.registerModule("swipe", { mousedown: function(c) { var f = a(this),
                d = f.spritespin("data");
            b.updateInput(c, d);
            d.onDrag = true }, mousemove: function(j) { var k = a(this),
                c = k.spritespin("data"); if (c.onDrag) { b.updateInput(j, c); var g = c.frame; var h = c.snap || 0.25; var i, f; if (c.orientation === "horizontal") { i = c.dX;
                    f = c.target.innerWidth() * h } else { i = c.dY;
                    f = c.target.innerHeight() * h } if (i > f) { g = c.frame - 1;
                    c.onDrag = false } else { if (i < -f) { g = c.frame + 1;
                        c.onDrag = false } } k.spritespin("update", g);
                k.spritespin("animate", false) } }, mouseup: function() { var d = a(this),
                c = d.spritespin("data");
            c.onDrag = false;
            b.resetInput(c) }, mouseleave: function() { var d = a(this),
                c = d.spritespin("data");
            c.onDrag = false;
            b.resetInput(c) } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(e, a) { var c = Math.floor;

    function b(f) { var g = f.lane * f.frames + f.frame; var h = f.frameWidth * (g % f.framesX); var i = f.frameHeight * c(g / f.framesX); if (f.renderer === "canvas") { f.context.clearRect(0, 0, f.width, f.height);
            f.context.drawImage(f.images[0], h, i, f.frameWidth, f.frameHeight, 0, 0, f.width, f.height); return } h = -c(h * f.scaleWidth);
        i = -c(i * f.scaleHeight); if (f.renderer === "background") { f.stage.css({ "background-image": ["url('", f.source[0], "')"].join(""), "background-position": [h, "px ", i, "px"].join("") }) } else { e(f.images).css({ top: i, left: h }) } }

    function d(f) { var g = f.lane * f.frames + f.frame; if (f.renderer === "canvas") { f.context.clearRect(0, 0, f.width, f.height);
            f.context.drawImage(f.images[g], 0, 0, f.width, f.height) } else { if (f.renderer === "background") { f.stage.css({ "background-image": ["url('", f.source[g], "')"].join(""), "background-position": [0, "px ", 0, "px"].join("") }) } else { e(f.images).hide();
                e(f.images[g]).show() } } } a.registerModule("360", { onLoad: function(k, g) { var i, f;
            g.scaleWidth = g.width / g.frameWidth;
            g.scaleHeight = g.height / g.frameHeight;
            g.sourceIsSprite = g.images.length === 1;
            g.stage.empty().css({ "background-image": "none" }).show(); if (g.renderer === "canvas") { g.context.clearRect(0, 0, g.width, g.height);
                g.canvas.show() } else { if (g.renderer === "background") { if (g.sourceIsSprite) { i = c(g.sourceWidth * g.scaleWidth);
                        f = c(g.sourceHeight * g.scaleHeight) } else { i = c(g.frameWidth * g.scaleWidth);
                        f = c(g.frameHeight * g.scaleHeight) } var j = [i, "px ", f, "px"].join("");
                    g.stage.css({ "background-repeat": "no-repeat", "-webkit-background-size": j, "-moz-background-size": j, "-o-background-size": j, "background-size": j }) } else { if (g.renderer === "image") { if (g.sourceIsSprite) { i = c(g.sourceWidth * g.scaleWidth);
                            f = c(g.sourceHeight * g.scaleHeight) } else { i = f = "100%" } e(g.images).appendTo(g.stage).css({ width: i, height: f, position: "absolute" }) } } } }, onDraw: function(g, f) { if (f.sourceIsSprite) { b(f) } else { d(f) } } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(a) { var b = window.SpriteSpin.mods.gallery = {};
    b.onLoad = function(h, c) { c.images = [];
        c.offsets = [];
        c.stage.empty();
        c.speed = 500;
        c.opacity = 0.25;
        c.oldFrame = 0; var d = 0,
            f; for (f = 0; f < c.source.length; f += 1) { var g = a("<img src='" + c.source[f] + "'/>");
            c.stage.append(g);
            c.images.push(g);
            c.offsets.push(-d + (c.width - g[0].width) / 2);
            d += g[0].width;
            g.css({ opacity: 0.25 }) } c.stage.css({ width: d });
        c.images[c.oldFrame].animate({ opacity: 1 }, c.speed) };
    b.onDraw = function(d, c) { if ((c.oldFrame !== c.frame) && c.offsets) { c.stage.stop(true, false);
            c.stage.animate({ left: c.offsets[c.frame] }, c.speed);
            c.images[c.oldFrame].animate({ opacity: c.opacity }, c.speed);
            c.oldFrame = c.frame;
            c.images[c.oldFrame].animate({ opacity: 1 }, c.speed) } else { c.stage.css({ left: c.offsets[c.frame] + c.dX }) } };
    b.resetInput = function(d, c) { if (!c.onDrag) { c.stage.animate({ left: c.offsets[c.frame] }) } } }(window.jQuery || window.Zepto || window.$));
(function(c, a) { var b = Math.floor;
    a.registerModule("panorama", { onLoad: function(j, f) { f.stage.empty().show();
            f.frames = f.sourceWidth; if (f.orientation === "horizontal") { f.scale = f.height / f.sourceHeight;
                f.frames = f.sourceWidth } else { f.scale = f.width / f.sourceWidth;
                f.frames = f.sourceHeight } var g = b(f.sourceWidth * f.scale); var d = b(f.sourceHeight * f.scale); var i = [g, "px ", d, "px"].join("");
            f.stage.css({ "background-image": ["url('", f.source[0], "')"].join(""), "background-repeat": "repeat-both", "-webkit-background-size": i, "-moz-background-size": i, "-o-background-size": i, "background-size": i }) }, onDraw: function(h, d) { var g = 0,
                f = 0; if (d.orientation === "horizontal") { g = -b((d.frame % d.frames) * d.scale) } else { f = -b((d.frame % d.frames) * d.scale) } d.stage.css({ "background-position": [g, "px ", f, "px"].join("") }) } }) }(window.jQuery || window.Zepto || window.$, window.SpriteSpin));
(function(e, d, f) { e.fn.jScrollPane = function(a) {
        function b(aR, bb) { var aQ, bd = this,
                ba, bz, bL, aM, bg, aN, bA, bG, aV, bm, a0, a6, bl, bN, bP, bC, bh, s, a9, bJ, bs, aZ, a7, bB, bj, bR, bv, aP, aU, aX, bV, bU, bo, aL = true,
                bO = true,
                aT = false,
                bQ = false,
                aY = aR.clone(false, false).empty(),
                aO = e.fn.mwheelIntent ? "mwheelIntent.jsp" : "mousewheel.jsp";
            bV = aR.css("paddingTop") + " " + aR.css("paddingRight") + " " + aR.css("paddingBottom") + " " + aR.css("paddingLeft");
            bU = (parseInt(aR.css("paddingLeft"), 10) || 0) + (parseInt(aR.css("paddingRight"), 10) || 0);

            function ar(g) { var k, m, l, i, h, o, n = false,
                    j = false;
                aQ = g; if (ba === f) { h = aR.scrollTop();
                    o = aR.scrollLeft();
                    aR.css({ overflow: "hidden", padding: 0 });
                    bz = aR.innerWidth() + bU;
                    bL = aR.innerHeight();
                    aR.width(bz);
                    ba = e('<div class="jspPane" />').css("padding", bV).append(aR.children());
                    aM = e('<div class="jspContainer" />').css({ width: bz + "px", height: bL + "px" }).append(ba).appendTo(aR) } else { aR.css("width", "");
                    n = aQ.stickToBottom && bn();
                    j = aQ.stickToRight && bt();
                    i = aR.innerWidth() + bU != bz || aR.outerHeight() != bL; if (i) { bz = aR.innerWidth() + bU;
                        bL = aR.innerHeight();
                        aM.css({ width: bz + "px", height: bL + "px" }) } if (!i && bo == bg && ba.outerHeight() == aN) { aR.width(bz); return } bo = bg;
                    ba.css("width", "");
                    aR.width(bz);
                    aM.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end() } ba.css("overflow", "auto"); if (g.contentWidth) { bg = g.contentWidth } else { bg = ba[0].scrollWidth } aN = ba[0].scrollHeight;
                ba.css("overflow", "");
                bA = bg / bz;
                bG = aN / bL;
                aV = bG > 1;
                bm = bA > 1; if (!(bm || aV)) { aR.removeClass("jspScrollable");
                    ba.css({ top: 0, width: aM.width() - bU });
                    bT();
                    bw();
                    be();
                    by();
                    a1() } else { aR.addClass("jspScrollable");
                    k = aQ.maintainPosition && (bl || bC); if (k) { m = aW();
                        l = bW() } bc();
                    br();
                    aS(); if (k) { bq(j ? (bg - bz) : m, false);
                        bp(n ? (aN - bL) : l, false) } bZ();
                    aK();
                    bH(); if (aQ.enableKeyboardNavigation) { bf() } if (aQ.clickOnTrack) { bF() } bu(); if (aQ.hijackInternalLinks) { bS() } } if (aQ.autoReinitialise && !aX) { aX = setInterval(function() { ar(aQ) }, aQ.autoReinitialiseDelay) } else { if (!aQ.autoReinitialise && aX) { clearInterval(aX) } } h && aR.scrollTop(0) && bp(h, false);
                o && aR.scrollLeft(0) && bq(o, false);
                aR.trigger("jsp-initialised", [bm || aV]) }

            function bc() { if (aV) { aM.append(e('<div class="jspVerticalBar" />').append(e('<div class="jspCap jspCapTop" />'), e('<div class="jspTrack" />').append(e('<div class="jspDrag" />').append(e('<div class="jspDragTop" />'), e('<div class="jspDragBottom" />'))), e('<div class="jspCap jspCapBottom" />')));
                    bh = aM.find(">.jspVerticalBar");
                    s = bh.find(">.jspTrack");
                    a0 = s.find(">.jspDrag"); if (aQ.showArrows) { aZ = e('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp", bX(0, -1)).bind("click.jsp", a5);
                        a7 = e('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp", bX(0, 1)).bind("click.jsp", a5); if (aQ.arrowScrollOnHover) { aZ.bind("mouseover.jsp", bX(0, -1, aZ));
                            a7.bind("mouseover.jsp", bX(0, 1, a7)) } a2(s, aQ.verticalArrowPositions, aZ, a7) } bJ = bL;
                    aM.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function() { bJ -= e(this).outerHeight() });
                    a0.hover(function() { a0.addClass("jspHover") }, function() { a0.removeClass("jspHover") }).bind("mousedown.jsp", function(g) { e("html").bind("dragstart.jsp selectstart.jsp", a5);
                        a0.addClass("jspActive"); var h = g.pageY - a0.position().top;
                        e("html").bind("mousemove.jsp", function(i) { bi(i.pageY - h, false) }).bind("mouseup.jsp mouseleave.jsp", bY); return false });
                    bE() } }

            function bE() { s.height(bJ + "px");
                bl = 0;
                a9 = aQ.verticalGutter + s.outerWidth();
                ba.width(bz - a9 - bU); try { if (bh.position().left === 0) { ba.css("margin-left", a9 + "px") } } catch (g) {} }

            function br() { if (bm) { aM.append(e('<div class="jspHorizontalBar" />').append(e('<div class="jspCap jspCapLeft" />'), e('<div class="jspTrack" />').append(e('<div class="jspDrag" />').append(e('<div class="jspDragLeft" />'), e('<div class="jspDragRight" />'))), e('<div class="jspCap jspCapRight" />')));
                    bB = aM.find(">.jspHorizontalBar");
                    bj = bB.find(">.jspTrack");
                    bN = bj.find(">.jspDrag"); if (aQ.showArrows) { aP = e('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp", bX(-1, 0)).bind("click.jsp", a5);
                        aU = e('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp", bX(1, 0)).bind("click.jsp", a5); if (aQ.arrowScrollOnHover) { aP.bind("mouseover.jsp", bX(-1, 0, aP));
                            aU.bind("mouseover.jsp", bX(1, 0, aU)) } a2(bj, aQ.horizontalArrowPositions, aP, aU) } bN.hover(function() { bN.addClass("jspHover") }, function() { bN.removeClass("jspHover") }).bind("mousedown.jsp", function(g) { e("html").bind("dragstart.jsp selectstart.jsp", a5);
                        bN.addClass("jspActive"); var h = g.pageX - bN.position().left;
                        e("html").bind("mousemove.jsp", function(i) { a8(i.pageX - h, false) }).bind("mouseup.jsp mouseleave.jsp", bY); return false });
                    bR = aM.innerWidth();
                    bx() } }

            function bx() { aM.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function() { bR -= e(this).outerWidth() });
                bj.width(bR + "px");
                bC = 0 }

            function aS() { if (bm && aV) { var g = bj.outerHeight(),
                        h = s.outerWidth();
                    bJ -= g;
                    e(bB).find(">.jspCap:visible,>.jspArrow").each(function() { bR += e(this).outerWidth() });
                    bR -= h;
                    bL -= h;
                    bz -= g;
                    bj.parent().append(e('<div class="jspCorner" />').css("width", g + "px"));
                    bE();
                    bx() } if (bm) { ba.width((aM.outerWidth() - bU) + "px") } aN = ba.outerHeight();
                bG = aN / bL; if (bm) { bv = Math.ceil(1 / bA * bR); if (bv > aQ.horizontalDragMaxWidth) { bv = aQ.horizontalDragMaxWidth } else { if (bv < aQ.horizontalDragMinWidth) { bv = aQ.horizontalDragMinWidth } } bN.width(bv + "px");
                    bP = bR - bv;
                    a4(bC) } if (aV) { bs = Math.ceil(1 / bG * bJ); if (bs > aQ.verticalDragMaxHeight) { bs = aQ.verticalDragMaxHeight } else { if (bs < aQ.verticalDragMinHeight) { bs = aQ.verticalDragMinHeight } } a0.height(bs + "px");
                    a6 = bJ - bs;
                    bD(bl) } }

            function a2(i, k, h, l) { var m = "before",
                    j = "after",
                    g; if (k == "os") { k = /Mac/.test(navigator.platform) ? "after" : "split" } if (k == m) { j = k } else { if (k == j) { m = k;
                        g = h;
                        h = l;
                        l = g } } i[m](h)[j](l) }

            function bX(h, g, i) { return function() { bk(h, g, this, i);
                    this.blur(); return false } }

            function bk(k, j, n, m) { n = e(n).addClass("jspActive"); var l, i, h = true,
                    g = function() { if (k !== 0) { bd.scrollByX(k * aQ.arrowButtonSpeed) } if (j !== 0) { bd.scrollByY(j * aQ.arrowButtonSpeed) } i = setTimeout(g, h ? aQ.initialDelay : aQ.arrowRepeatFreq);
                        h = false };
                g();
                l = m ? "mouseout.jsp" : "mouseup.jsp";
                m = m || e("html");
                m.bind(l, function() { n.removeClass("jspActive");
                    i && clearTimeout(i);
                    i = null;
                    m.unbind(l) }) }

            function bF() { by(); if (aV) { s.bind("mousedown.jsp", function(m) { if (m.originalTarget === f || m.originalTarget == m.currentTarget) { var k = e(this),
                                n = k.offset(),
                                l = m.pageY - n.top - bl,
                                i, h = true,
                                j = function() { var q = k.offset(),
                                        r = m.pageY - q.top - bs / 2,
                                        o = bL * aQ.scrollPagePercent,
                                        p = a6 * o / (aN - bL); if (l < 0) { if (bl - p > r) { bd.scrollByY(-o) } else { bi(r) } } else { if (l > 0) { if (bl + p < r) { bd.scrollByY(o) } else { bi(r) } } else { g(); return } } i = setTimeout(j, h ? aQ.initialDelay : aQ.trackClickRepeatFreq);
                                    h = false },
                                g = function() { i && clearTimeout(i);
                                    i = null;
                                    e(document).unbind("mouseup.jsp", g) };
                            j();
                            e(document).bind("mouseup.jsp", g); return false } }) } if (bm) { bj.bind("mousedown.jsp", function(m) { if (m.originalTarget === f || m.originalTarget == m.currentTarget) { var k = e(this),
                                n = k.offset(),
                                l = m.pageX - n.left - bC,
                                i, h = true,
                                j = function() { var q = k.offset(),
                                        r = m.pageX - q.left - bv / 2,
                                        o = bz * aQ.scrollPagePercent,
                                        p = bP * o / (bg - bz); if (l < 0) { if (bC - p > r) { bd.scrollByX(-o) } else { a8(r) } } else { if (l > 0) { if (bC + p < r) { bd.scrollByX(o) } else { a8(r) } } else { g(); return } } i = setTimeout(j, h ? aQ.initialDelay : aQ.trackClickRepeatFreq);
                                    h = false },
                                g = function() { i && clearTimeout(i);
                                    i = null;
                                    e(document).unbind("mouseup.jsp", g) };
                            j();
                            e(document).bind("mouseup.jsp", g); return false } }) } }

            function by() { if (bj) { bj.unbind("mousedown.jsp") } if (s) { s.unbind("mousedown.jsp") } }

            function bY() { e("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp"); if (a0) { a0.removeClass("jspActive") } if (bN) { bN.removeClass("jspActive") } }

            function bi(h, g) { if (!aV) { return } if (h < 0) { h = 0 } else { if (h > a6) { h = a6 } } if (g === f) { g = aQ.animateScroll } if (g) { bd.animate(a0, "top", h, bD) } else { a0.css("top", h);
                    bD(h) } }

            function bD(j) { if (j === f) { j = a0.position().top } aM.scrollTop(0);
                bl = j; var i = bl === 0,
                    k = bl == a6,
                    g = j / a6,
                    h = -g * (aN - bL); if (aL != i || aT != k) { aL = i;
                    aT = k;
                    aR.trigger("jsp-arrow-change", [aL, aT, bO, bQ]) } bK(i, k);
                ba.css("top", h);
                aR.trigger("jsp-scroll-y", [-h, i, k]).trigger("scroll") }

            function a8(g, h) { if (!bm) { return } if (g < 0) { g = 0 } else { if (g > bP) { g = bP } } if (h === f) { h = aQ.animateScroll } if (h) { bd.animate(bN, "left", g, a4) } else { bN.css("left", g);
                    a4(g) } }

            function a4(j) { if (j === f) { j = bN.position().left } aM.scrollTop(0);
                bC = j; var i = bC === 0,
                    g = bC == bP,
                    k = j / bP,
                    h = -k * (bg - bz); if (bO != i || bQ != g) { bO = i;
                    bQ = g;
                    aR.trigger("jsp-arrow-change", [aL, aT, bO, bQ]) } bI(i, g);
                ba.css("left", h);
                aR.trigger("jsp-scroll-x", [-h, i, g]).trigger("scroll") }

            function bK(g, h) { if (aQ.showArrows) { aZ[g ? "addClass" : "removeClass"]("jspDisabled");
                    a7[h ? "addClass" : "removeClass"]("jspDisabled") } }

            function bI(g, h) { if (aQ.showArrows) { aP[g ? "addClass" : "removeClass"]("jspDisabled");
                    aU[h ? "addClass" : "removeClass"]("jspDisabled") } }

            function bp(g, h) { var i = g / (aN - bL);
                bi(i * a6, h) }

            function bq(h, g) { var i = h / (bg - bz);
                a8(i * bP, g) }

            function a3(j, v, g) { var i, l, o, k = 0,
                    u = 0,
                    t, q, n, m, h, p; try { i = e(j) } catch (r) { return } l = i.outerHeight();
                o = i.outerWidth();
                aM.scrollTop(0);
                aM.scrollLeft(0); while (!i.is(".jspPane")) { k += i.position().top;
                    u += i.position().left;
                    i = i.offsetParent(); if (/^body|html$/i.test(i[0].nodeName)) { return } } t = bW();
                n = t + bL; if (k < t || v) { h = k - aQ.verticalGutter } else { if (k + l > n) { h = k - bL + l + aQ.verticalGutter } } if (h) { bp(h, g) } q = aW();
                m = q + bz; if (u < q || v) { p = u - aQ.horizontalGutter } else { if (u + o > m) { p = u - bz + o + aQ.horizontalGutter } } if (p) { bq(p, g) } }

            function aW() { return -ba.position().left }

            function bW() { return -ba.position().top }

            function bn() { var g = aN - bL; return (g > 20) && (g - bW() < 10) }

            function bt() { var g = bg - bz; return (g > 20) && (g - aW() < 10) }

            function aK() { aM.unbind(aO).bind(aO, function(k, l, j, h) { var i = bC,
                        g = bl;
                    bd.scrollBy(j * aQ.mouseWheelSpeed, -h * aQ.mouseWheelSpeed, false); return i == bC && g == bl }) }

            function bT() { aM.unbind(aO) }

            function a5() { return false }

            function bZ() { ba.find(":input,a").unbind("focus.jsp").bind("focus.jsp", function(g) { a3(g.target, false) }) }

            function bw() { ba.find(":input,a").unbind("focus.jsp") }

            function bf() { var h, i, g = [];
                bm && g.push(bB[0]);
                aV && g.push(bh[0]);
                ba.focus(function() { aR.focus() });
                aR.attr("tabindex", 0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp", function(l) { if (l.target !== this && !(g.length && e(l.target).closest(g).length)) { return } var m = bC,
                        k = bl; switch (l.keyCode) {
                        case 40:
                        case 38:
                        case 34:
                        case 32:
                        case 33:
                        case 39:
                        case 37:
                            h = l.keyCode;
                            j(); break;
                        case 35:
                            bp(aN - bL);
                            h = null; break;
                        case 36:
                            bp(0);
                            h = null; break } i = l.keyCode == h && m != bC || k != bl; return !i }).bind("keypress.jsp", function(k) { if (k.keyCode == h) { j() } return !i }); if (aQ.hideFocus) { aR.css("outline", "none"); if ("hideFocus" in aM[0]) { aR.attr("hideFocus", true) } } else { aR.css("outline", ""); if ("hideFocus" in aM[0]) { aR.attr("hideFocus", false) } }

                function j() { var l = bC,
                        k = bl; switch (h) {
                        case 40:
                            bd.scrollByY(aQ.keyboardSpeed, false); break;
                        case 38:
                            bd.scrollByY(-aQ.keyboardSpeed, false); break;
                        case 34:
                        case 32:
                            bd.scrollByY(bL * aQ.scrollPagePercent, false); break;
                        case 33:
                            bd.scrollByY(-bL * aQ.scrollPagePercent, false); break;
                        case 39:
                            bd.scrollByX(aQ.keyboardSpeed, false); break;
                        case 37:
                            bd.scrollByX(-aQ.keyboardSpeed, false); break } i = l != bC || k != bl; return i } }

            function be() { aR.attr("tabindex", "-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp") }

            function bu() { if (location.hash && location.hash.length > 1) { var i, h; try { i = e(location.hash) } catch (g) { return } if (i.length && ba.find(location.hash)) { if (aM.scrollTop() === 0) { h = setInterval(function() { if (aM.scrollTop() > 0) { a3(location.hash, true);
                                    e(document).scrollTop(aM.position().top);
                                    clearInterval(h) } }, 50) } else { a3(location.hash, true);
                            e(document).scrollTop(aM.position().top) } } } }

            function a1() { e("a.jspHijack").unbind("click.jsp-hijack").removeClass("jspHijack") }

            function bS() { a1();
                e("a[href^=#]").addClass("jspHijack").bind("click.jsp-hijack", function() { var h = this.href.split("#"),
                        g; if (h.length > 1) { g = h[1]; if (g.length > 0 && ba.find("#" + g).length > 0) { a3("#" + g, true); return false } } }) }

            function bH() { var i, h, k, j, l, g = false;
                aM.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp", function(m) { var n = m.originalEvent.touches[0];
                    i = aW();
                    h = bW();
                    k = n.pageX;
                    j = n.pageY;
                    l = false;
                    g = true }).bind("touchmove.jsp", function(n) { if (!g) { return } var m = n.originalEvent.touches[0],
                        p = bC,
                        o = bl;
                    bd.scrollTo(i + k - m.pageX, h + j - m.pageY);
                    l = l || Math.abs(k - m.pageX) > 5 || Math.abs(j - m.pageY) > 5; return p == bC && o == bl }).bind("touchend.jsp", function(m) { g = false }).bind("click.jsp-touchclick", function(m) { if (l) { l = false; return false } }) }

            function bM() { var h = bW(),
                    g = aW();
                aR.removeClass("jspScrollable").unbind(".jsp");
                aR.replaceWith(aY.append(ba.children()));
                aY.scrollTop(h);
                aY.scrollLeft(g) } e.extend(bd, { reinitialise: function(g) { g = e.extend({}, aQ, g);
                    ar(g) }, scrollToElement: function(i, h, g) { a3(i, h, g) }, scrollTo: function(i, g, h) { bq(i, h);
                    bp(g, h) }, scrollToX: function(g, h) { bq(g, h) }, scrollToY: function(h, g) { bp(h, g) }, scrollToPercentX: function(g, h) { bq(g * (bg - bz), h) }, scrollToPercentY: function(g, h) { bp(g * (aN - bL), h) }, scrollBy: function(h, g, i) { bd.scrollByX(h, i);
                    bd.scrollByY(g, i) }, scrollByX: function(h, j) { var i = aW() + h,
                        g = i / (bg - bz);
                    a8(g * bP, j) }, scrollByY: function(h, j) { var i = bW() + h,
                        g = i / (aN - bL);
                    bi(g * a6, j) }, positionDragX: function(h, g) { a8(h, g) }, positionDragY: function(g, h) { bi(g, h) }, animate: function(j, i, h, g) { var k = {};
                    k[i] = h;
                    j.animate(k, { duration: aQ.animateDuration, ease: aQ.animateEase, queue: false, step: g }) }, getContentPositionX: function() { return aW() }, getContentPositionY: function() { return bW() }, getContentWidth: function() { return bg }, getContentHeight: function() { return aN }, getPercentScrolledX: function() { return aW() / (bg - bz) }, getPercentScrolledY: function() { return bW() / (aN - bL) }, getIsScrollableH: function() { return bm }, getIsScrollableV: function() { return aV }, getContentPane: function() { return ba }, scrollToBottom: function(g) { bi(a6, g) }, hijackInternalLinks: function() { bS() }, destroy: function() { bM() } });
            ar(bb) } a = e.extend({}, e.fn.jScrollPane.defaults, a);
        e.each(["mouseWheelSpeed", "arrowButtonSpeed", "trackClickSpeed", "keyboardSpeed"], function() { a[this] = a[this] || a.speed }); var c;
        this.each(function() { var i = e(this),
                j = i.data("jsp"); if (j) { j.reinitialise(a) } else { j = new b(i, a);
                i.data("jsp", j) } c = c ? c.add(i) : i }); return c };
    e.fn.jScrollPane.defaults = { showArrows: false, maintainPosition: true, stickToBottom: false, stickToRight: false, clickOnTrack: true, autoReinitialise: false, autoReinitialiseDelay: 500, verticalDragMinHeight: 0, verticalDragMaxHeight: 99999, horizontalDragMinWidth: 0, horizontalDragMaxWidth: 99999, contentWidth: f, animateScroll: false, animateDuration: 300, animateEase: "linear", hijackInternalLinks: false, verticalGutter: 4, horizontalGutter: 4, mouseWheelSpeed: 0, arrowButtonSpeed: 0, arrowRepeatFreq: 50, arrowScrollOnHover: false, trackClickSpeed: 0, trackClickRepeatFreq: 70, verticalArrowPositions: "split", horizontalArrowPositions: "split", enableKeyboardNavigation: true, hideFocus: false, keyboardSpeed: 0, initialDelay: 300, speed: 30, scrollPagePercent: 0.8 } })(jQuery, this);
/* jQuery UI - v1.9.2 - 2015-09-11
 * http://jqueryui.com
 * Includes: jquery.ui.core.js, jquery.ui.widget.js, jquery.ui.mouse.js, jquery.ui.draggable.js
 * Copyright 2015 jQuery Foundation and other contributors; Licensed MIT */
(function(h, b) {
    function c(p, e) { var l, j, m, k = p.nodeName.toLowerCase(); return "area" === k ? (l = p.parentNode, j = l.name, p.href && j && "map" === l.nodeName.toLowerCase() ? (m = h("img[usemap=#" + j + "]")[0], !!m && g(m)) : !1) : (/input|select|textarea|button|object/.test(k) ? !p.disabled : "a" === k ? p.href || e : e) && g(p) }

    function g(a) { return h.expr.filters.visible(a) && !h(a).parents().andSelf().filter(function() { return "hidden" === h.css(this, "visibility") }).length } var f = 0,
        d = /^ui-id-\d+$/;
    h.ui = h.ui || {}, h.ui.version || (h.extend(h.ui, { version: "1.9.2", keyCode: { BACKSPACE: 8, COMMA: 188, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, LEFT: 37, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108, NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SPACE: 32, TAB: 9, UP: 38 } }), h.fn.extend({ _focus: h.fn.focus, focus: function(e, a) { return "number" == typeof e ? this.each(function() { var i = this;
                setTimeout(function() { h(i).focus(), a && a.call(i) }, e) }) : this._focus.apply(this, arguments) }, scrollParent: function() { var a; return a = h.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function() { return /(relative|absolute|fixed)/.test(h.css(this, "position")) && /(auto|scroll)/.test(h.css(this, "overflow") + h.css(this, "overflow-y") + h.css(this, "overflow-x")) }).eq(0) : this.parents().filter(function() { return /(auto|scroll)/.test(h.css(this, "overflow") + h.css(this, "overflow-y") + h.css(this, "overflow-x")) }).eq(0), /fixed/.test(this.css("position")) || !a.length ? h(document) : a }, zIndex: function(j) { if (j !== b) { return this.css("zIndex", j) } if (this.length) { for (var k, e, l = h(this[0]); l.length && l[0] !== document;) { if (k = l.css("position"), ("absolute" === k || "relative" === k || "fixed" === k) && (e = parseInt(l.css("zIndex"), 10), !isNaN(e) && 0 !== e)) { return e } l = l.parent() } } return 0 }, uniqueId: function() { return this.each(function() { this.id || (this.id = "ui-id-" + ++f) }) }, removeUniqueId: function() { return this.each(function() { d.test(this.id) && h(this).removeAttr("id") }) } }), h.extend(h.expr[":"], { data: h.expr.createPseudo ? h.expr.createPseudo(function(a) { return function(e) { return !!h.data(e, a) } }) : function(j, a, e) { return !!h.data(j, e[3]) }, focusable: function(a) { return c(a, !isNaN(h.attr(a, "tabindex"))) }, tabbable: function(j) { var i = h.attr(j, "tabindex"),
                e = isNaN(i); return (e || i >= 0) && c(j, !e) } }), h(function() { var e = document.body,
            a = e.appendChild(a = document.createElement("div"));
        a.offsetHeight, h.extend(a.style, { minHeight: "100px", height: "auto", padding: 0, borderWidth: 0 }), h.support.minHeight = 100 === a.offsetHeight, h.support.selectstart = "onselectstart" in a, e.removeChild(a).style.display = "none" }), h("<a>").outerWidth(1).jquery || h.each(["Width", "Height"], function(e, p) {
        function l(r, o, q, n) { return h.each(j, function() { o -= parseFloat(h.css(r, "padding" + this)) || 0, q && (o -= parseFloat(h.css(r, "border" + this + "Width")) || 0), n && (o -= parseFloat(h.css(r, "margin" + this)) || 0) }), o } var j = "Width" === p ? ["Left", "Right"] : ["Top", "Bottom"],
            m = p.toLowerCase(),
            k = { innerWidth: h.fn.innerWidth, innerHeight: h.fn.innerHeight, outerWidth: h.fn.outerWidth, outerHeight: h.fn.outerHeight };
        h.fn["inner" + p] = function(a) { return a === b ? k["inner" + p].call(this) : this.each(function() { h(this).css(m, l(this, a) + "px") }) }, h.fn["outer" + p] = function(n, a) { return "number" != typeof n ? k["outer" + p].call(this, n) : this.each(function() { h(this).css(m, l(this, n, !0, a) + "px") }) } }), h("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (h.fn.removeData = function(a) { return function(e) { return arguments.length ? a.call(this, h.camelCase(e)) : a.call(this) } }(h.fn.removeData)), function() { var a = /msie ([\w.]+)/.exec(navigator.userAgent.toLowerCase()) || [];
        h.ui.ie = a.length ? !0 : !1, h.ui.ie6 = 6 === parseFloat(a[1], 10) }(), h.fn.extend({ disableSelection: function() { return this.bind((h.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function(a) { a.preventDefault() }) }, enableSelection: function() { return this.unbind(".ui-disableSelection") } }), h.extend(h.ui, { plugin: { add: function(l, j, k) { var e, m = h.ui[l].prototype; for (e in k) { m.plugins[e] = m.plugins[e] || [], m.plugins[e].push([j, k[e]]) } }, call: function(n, m, k) { var l, j = n.plugins[m]; if (j && n.element[0].parentNode && 11 !== n.element[0].parentNode.nodeType) { for (l = 0; j.length > l; l++) { n.options[j[l][0]] && j[l][1].apply(n.element, k) } } } }, contains: h.contains, hasScroll: function(l, j) { if ("hidden" === h(l).css("overflow")) { return !1 } var k = j && "left" === j ? "scrollLeft" : "scrollTop",
                e = !1; return l[k] > 0 ? !0 : (l[k] = 1, e = l[k] > 0, l[k] = 0, e) }, isOverAxis: function(k, j, a) { return k > j && j + a > k }, isOver: function(o, e, m, k, j, l) { return h.ui.isOverAxis(o, m, j) && h.ui.isOverAxis(e, k, l) } })) })(jQuery);
(function(g, f) { var c = 0,
        d = Array.prototype.slice,
        b = g.cleanData;
    g.cleanData = function(h) { for (var a, e = 0; null != (a = h[e]); e++) { try { g(a).triggerHandler("remove") } catch (j) {} } b(h) }, g.widget = function(j, u, q) { var m, t, p, e, k = j.split(".")[0];
        j = j.split(".")[1], m = k + "-" + j, q || (q = u, u = g.Widget), g.expr[":"][m.toLowerCase()] = function(a) { return !!g.data(a, m) }, g[k] = g[k] || {}, t = g[k][j], p = g[k][j] = function(a, h) { return this._createWidget ? (arguments.length && this._createWidget(a, h), f) : new p(a, h) }, g.extend(p, t, { version: q.version, _proto: g.extend({}, q), _childConstructors: [] }), e = new u, e.options = g.widget.extend({}, e.options), g.each(q, function(h, a) { g.isFunction(a) && (q[h] = function() { var l = function() { return u.prototype[h].apply(this, arguments) },
                    i = function(n) { return u.prototype[h].apply(this, n) }; return function() { var r, o = this._super,
                        v = this._superApply; return this._super = l, this._superApply = i, r = a.apply(this, arguments), this._super = o, this._superApply = v, r } }()) }), p.prototype = g.widget.extend(e, { widgetEventPrefix: t ? e.widgetEventPrefix : j }, q, { constructor: p, namespace: k, widgetName: j, widgetBaseClass: m, widgetFullName: m }), t ? (g.each(t._childConstructors, function(l, a) { var h = a.prototype;
            g.widget(h.namespace + "." + h.widgetName, p, a._proto) }), delete t._childConstructors) : u._childConstructors.push(p), g.widget.bridge(j, p) }, g.widget.extend = function(j) { for (var m, k, p = d.call(arguments, 1), l = 0, e = p.length; e > l; l++) { for (m in p[l]) { k = p[l][m], p[l].hasOwnProperty(m) && k !== f && (j[m] = g.isPlainObject(k) ? g.isPlainObject(j[m]) ? g.widget.extend({}, j[m], k) : g.widget.extend({}, k) : k) } } return j }, g.widget.bridge = function(e, h) { var j = h.prototype.widgetFullName || e;
        g.fn[e] = function(i) { var a = "string" == typeof i,
                k = d.call(arguments, 1),
                m = this; return i = !a && k.length ? g.widget.extend.apply(null, [i].concat(k)) : i, a ? this.each(function() { var n, l = g.data(this, j); return l ? g.isFunction(l[i]) && "_" !== i.charAt(0) ? (n = l[i].apply(l, k), n !== l && n !== f ? (m = n && n.jquery ? m.pushStack(n.get()) : n, !1) : f) : g.error("no such method '" + i + "' for " + e + " widget instance") : g.error("cannot call methods on " + e + " prior to initialization; attempted to call method '" + i + "'") }) : this.each(function() { var l = g.data(this, j);
                l ? l.option(i || {})._init() : g.data(this, j, new h(i, this)) }), m } }, g.Widget = function() {}, g.Widget._childConstructors = [], g.Widget.prototype = { widgetName: "widget", widgetEventPrefix: "", defaultElement: "<div>", options: { disabled: !1, create: null }, _createWidget: function(e, a) { a = g(a || this.defaultElement || this)[0], this.element = g(a), this.uuid = c++, this.eventNamespace = "." + this.widgetName + this.uuid, this.options = g.widget.extend({}, this.options, this._getCreateOptions(), e), this.bindings = g(), this.hoverable = g(), this.focusable = g(), a !== this && (g.data(a, this.widgetName, this), g.data(a, this.widgetFullName, this), this._on(!0, this.element, { remove: function(h) { h.target === a && this.destroy() } }), this.document = g(a.style ? a.ownerDocument : a.document || a), this.window = g(this.document[0].defaultView || this.document[0].parentWindow)), this._create(), this._trigger("create", null, this._getCreateEventData()), this._init() }, _getCreateOptions: g.noop, _getCreateEventData: g.noop, _create: g.noop, _init: g.noop, destroy: function() { this._destroy(), this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(g.camelCase(this.widgetFullName)), this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"), this.bindings.unbind(this.eventNamespace), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus") }, _destroy: g.noop, widget: function() { return this.element }, option: function(e, m) { var k, h, l, j = e; if (0 === arguments.length) { return g.widget.extend({}, this.options) } if ("string" == typeof e) { if (j = {}, k = e.split("."), e = k.shift(), k.length) { for (h = j[e] = g.widget.extend({}, this.options[e]), l = 0; k.length - 1 > l; l++) { h[k[l]] = h[k[l]] || {}, h = h[k[l]] } if (e = k.pop(), m === f) { return h[e] === f ? null : h[e] } h[e] = m } else { if (m === f) { return this.options[e] === f ? null : this.options[e] } j[e] = m } } return this._setOptions(j), this }, _setOptions: function(a) { var h; for (h in a) { this._setOption(h, a[h]) } return this }, _setOption: function(a, h) { return this.options[a] = h, "disabled" === a && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!h).attr("aria-disabled", h), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")), this }, enable: function() { return this._setOption("disabled", !1) }, disable: function() { return this._setOption("disabled", !0) }, _on: function(h, j, e) { var l, k = this; "boolean" != typeof h && (e = j, j = h, h = !1), e ? (j = l = g(j), this.bindings = this.bindings.add(j)) : (e = j, j = this.element, l = this.widget()), g.each(e, function(p, n) {
                function i() { return h || k.options.disabled !== !0 && !g(this).hasClass("ui-state-disabled") ? ("string" == typeof n ? k[n] : n).apply(k, arguments) : f } "string" != typeof n && (i.guid = n.guid = n.guid || i.guid || g.guid++); var m = p.match(/^(\w+)\s*(.*)$/),
                    r = m[1] + k.eventNamespace,
                    q = m[2];
                q ? l.delegate(q, r, i) : j.bind(r, i) }) }, _off: function(a, h) { h = (h || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace, a.unbind(h).undelegate(h) }, _delay: function(k, j) {
            function a() { return ("string" == typeof k ? h[k] : k).apply(h, arguments) } var h = this; return setTimeout(a, j || 0) }, _hoverable: function(a) { this.hoverable = this.hoverable.add(a), this._on(a, { mouseenter: function(e) { g(e.currentTarget).addClass("ui-state-hover") }, mouseleave: function(e) { g(e.currentTarget).removeClass("ui-state-hover") } }) }, _focusable: function(a) { this.focusable = this.focusable.add(a), this._on(a, { focusin: function(e) { g(e.currentTarget).addClass("ui-state-focus") }, focusout: function(e) { g(e.currentTarget).removeClass("ui-state-focus") } }) }, _trigger: function(m, e, l) { var j, h, k = this.options[m]; if (l = l || {}, e = g.Event(e), e.type = (m === this.widgetEventPrefix ? m : this.widgetEventPrefix + m).toLowerCase(), e.target = this.element[0], h = e.originalEvent) { for (j in h) { j in e || (e[j] = h[j]) } } return this.element.trigger(e, l), !(g.isFunction(k) && k.apply(this.element[0], [e].concat(l)) === !1 || e.isDefaultPrevented()) } }, g.each({ show: "fadeIn", hide: "fadeOut" }, function(e, a) { g.Widget.prototype["_" + e] = function(j, h, l) { "string" == typeof h && (h = { effect: h }); var i, k = h ? h === !0 || "number" == typeof h ? a : h.effect || a : e;
            h = h || {}, "number" == typeof h && (h = { duration: h }), i = !g.isEmptyObject(h), h.complete = l, h.delay && j.delay(h.delay), i && g.effects && (g.effects.effect[k] || g.uiBackCompat !== !1 && g.effects[k]) ? j[e](h) : k !== e && j[k] ? j[k](h.duration, h.easing, l) : j.queue(function(m) { g(this)[e](), l && l.call(j[0]), m() }) } }), g.uiBackCompat !== !1 && (g.Widget.prototype._getCreateOptions = function() { return g.metadata && g.metadata.get(this.element[0])[this.widgetName] }) })(jQuery);
(function(a) { var b = !1;
    a(document).mouseup(function() { b = !1 }), a.widget("ui.mouse", { version: "1.9.2", options: { cancel: "input,textarea,button,select,option", distance: 1, delay: 0 }, _mouseInit: function() { var c = this;
            this.element.bind("mousedown." + this.widgetName, function(d) { return c._mouseDown(d) }).bind("click." + this.widgetName, function(d) { return !0 === a.data(d.target, c.widgetName + ".preventClickEvent") ? (a.removeData(d.target, c.widgetName + ".preventClickEvent"), d.stopImmediatePropagation(), !1) : undefined }), this.started = !1 }, _mouseDestroy: function() { this.element.unbind("." + this.widgetName), this._mouseMoveDelegate && a(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate) }, _mouseDown: function(d) { if (!b) { this._mouseStarted && this._mouseUp(d), this._mouseDownEvent = d; var e = this,
                    c = 1 === d.which,
                    f = "string" == typeof this.options.cancel && d.target.nodeName ? a(d.target).closest(this.options.cancel).length : !1; return c && !f && this._mouseCapture(d) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() { e.mouseDelayMet = !0 }, this.options.delay)), this._mouseDistanceMet(d) && this._mouseDelayMet(d) && (this._mouseStarted = this._mouseStart(d) !== !1, !this._mouseStarted) ? (d.preventDefault(), !0) : (!0 === a.data(d.target, this.widgetName + ".preventClickEvent") && a.removeData(d.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(g) { return e._mouseMove(g) }, this._mouseUpDelegate = function(g) { return e._mouseUp(g) }, a(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), d.preventDefault(), b = !0, !0)) : !0 } }, _mouseMove: function(c) { return !a.ui.ie || document.documentMode >= 9 || c.button ? this._mouseStarted ? (this._mouseDrag(c), c.preventDefault()) : (this._mouseDistanceMet(c) && this._mouseDelayMet(c) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, c) !== !1, this._mouseStarted ? this._mouseDrag(c) : this._mouseUp(c)), !this._mouseStarted) : this._mouseUp(c) }, _mouseUp: function(c) { return a(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate), this._mouseStarted && (this._mouseStarted = !1, c.target === this._mouseDownEvent.target && a.data(c.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(c)), !1 }, _mouseDistanceMet: function(c) { return Math.max(Math.abs(this._mouseDownEvent.pageX - c.pageX), Math.abs(this._mouseDownEvent.pageY - c.pageY)) >= this.options.distance }, _mouseDelayMet: function() { return this.mouseDelayMet }, _mouseStart: function() {}, _mouseDrag: function() {}, _mouseStop: function() {}, _mouseCapture: function() { return !0 } }) })(jQuery);
(function(a) { a.widget("ui.draggable", a.ui.mouse, { version: "1.9.2", widgetEventPrefix: "drag", options: { addClasses: !0, appendTo: "parent", axis: !1, connectToSortable: !1, containment: !1, cursor: "auto", cursorAt: !1, grid: !1, handle: !1, helper: "original", iframeFix: !1, opacity: !1, refreshPositions: !1, revert: !1, revertDuration: 500, scope: "default", scroll: !0, scrollSensitivity: 20, scrollSpeed: 20, snap: !1, snapMode: "both", snapTolerance: 20, stack: !1, zIndex: !1 }, _create: function() { "original" != this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"), this.options.addClasses && this.element.addClass("ui-draggable"), this.options.disabled && this.element.addClass("ui-draggable-disabled"), this._mouseInit() }, _destroy: function() { this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"), this._mouseDestroy() }, _mouseCapture: function(c) { var b = this.options; return this.helper || b.disabled || a(c.target).is(".ui-resizable-handle") ? !1 : (this.handle = this._getHandle(c), this.handle ? (a(b.iframeFix === !0 ? "iframe" : b.iframeFix).each(function() { a('<div class="ui-draggable-iframeFix" style="background: #fff;"></div>').css({ width: this.offsetWidth + "px", height: this.offsetHeight + "px", position: "absolute", opacity: "0.001", zIndex: 1000 }).css(a(this).offset()).appendTo("body") }), !0) : !1) }, _mouseStart: function(c) { var b = this.options; return this.helper = this._createHelper(c), this.helper.addClass("ui-draggable-dragging"), this._cacheHelperProportions(), a.ui.ddmanager && (a.ui.ddmanager.current = this), this._cacheMargins(), this.cssPosition = this.helper.css("position"), this.scrollParent = this.helper.scrollParent(), this.offset = this.positionAbs = this.element.offset(), this.offset = { top: this.offset.top - this.margins.top, left: this.offset.left - this.margins.left }, a.extend(this.offset, { click: { left: c.pageX - this.offset.left, top: c.pageY - this.offset.top }, parent: this._getParentOffset(), relative: this._getRelativeOffset() }), this.originalPosition = this.position = this._generatePosition(c), this.originalPageX = c.pageX, this.originalPageY = c.pageY, b.cursorAt && this._adjustOffsetFromHelper(b.cursorAt), b.containment && this._setContainment(), this._trigger("start", c) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), a.ui.ddmanager && !b.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, c), this._mouseDrag(c, !0), a.ui.ddmanager && a.ui.ddmanager.dragStart(this, c), !0) }, _mouseDrag: function(d, b) { if (this.position = this._generatePosition(d), this.positionAbs = this._convertPositionTo("absolute"), !b) { var c = this._uiHash(); if (this._trigger("drag", d, c) === !1) { return this._mouseUp({}), !1 } this.position = c.position } return this.options.axis && "y" == this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" == this.options.axis || (this.helper[0].style.top = this.position.top + "px"), a.ui.ddmanager && a.ui.ddmanager.drag(this, d), !1 }, _mouseStop: function(e) { var c = !1;
            a.ui.ddmanager && !this.options.dropBehaviour && (c = a.ui.ddmanager.drop(this, e)), this.dropped && (c = this.dropped, this.dropped = !1); for (var d = this.element[0], b = !1; d && (d = d.parentNode);) { d == document && (b = !0) } if (!b && "original" === this.options.helper) { return !1 } if ("invalid" == this.options.revert && !c || "valid" == this.options.revert && c || this.options.revert === !0 || a.isFunction(this.options.revert) && this.options.revert.call(this.element, c)) { var f = this;
                a(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function() { f._trigger("stop", e) !== !1 && f._clear() }) } else { this._trigger("stop", e) !== !1 && this._clear() } return !1 }, _mouseUp: function(b) { return a("div.ui-draggable-iframeFix").each(function() { this.parentNode.removeChild(this) }), a.ui.ddmanager && a.ui.ddmanager.dragStop(this, b), a.ui.mouse.prototype._mouseUp.call(this, b) }, cancel: function() { return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(), this }, _getHandle: function(c) { var b = this.options.handle && a(this.options.handle, this.element).length ? !1 : !0; return a(this.options.handle, this.element).find("*").andSelf().each(function() { this == c.target && (b = !0) }), b }, _createHelper: function(d) { var b = this.options,
                c = a.isFunction(b.helper) ? a(b.helper.apply(this.element[0], [d])) : "clone" == b.helper ? this.element.clone().removeAttr("id") : this.element; return c.parents("body").length || c.appendTo("parent" == b.appendTo ? this.element[0].parentNode : b.appendTo), c[0] == this.element[0] || /(fixed|absolute)/.test(c.css("position")) || c.css("position", "absolute"), c }, _adjustOffsetFromHelper: function(b) { "string" == typeof b && (b = b.split(" ")), a.isArray(b) && (b = { left: +b[0], top: +b[1] || 0 }), "left" in b && (this.offset.click.left = b.left + this.margins.left), "right" in b && (this.offset.click.left = this.helperProportions.width - b.right + this.margins.left), "top" in b && (this.offset.click.top = b.top + this.margins.top), "bottom" in b && (this.offset.click.top = this.helperProportions.height - b.bottom + this.margins.top) }, _getParentOffset: function() { this.offsetParent = this.helper.offsetParent(); var b = this.offsetParent.offset(); return "absolute" == this.cssPosition && this.scrollParent[0] != document && a.contains(this.scrollParent[0], this.offsetParent[0]) && (b.left += this.scrollParent.scrollLeft(), b.top += this.scrollParent.scrollTop()), (this.offsetParent[0] == document.body || this.offsetParent[0].tagName && "html" == this.offsetParent[0].tagName.toLowerCase() && a.ui.ie) && (b = { top: 0, left: 0 }), { top: b.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: b.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) } }, _getRelativeOffset: function() { if ("relative" == this.cssPosition) { var b = this.element.position(); return { top: b.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(), left: b.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft() } } return { top: 0, left: 0 } }, _cacheMargins: function() { this.margins = { left: parseInt(this.element.css("marginLeft"), 10) || 0, top: parseInt(this.element.css("marginTop"), 10) || 0, right: parseInt(this.element.css("marginRight"), 10) || 0, bottom: parseInt(this.element.css("marginBottom"), 10) || 0 } }, _cacheHelperProportions: function() { this.helperProportions = { width: this.helper.outerWidth(), height: this.helper.outerHeight() } }, _setContainment: function() { var e = this.options; if ("parent" == e.containment && (e.containment = this.helper[0].parentNode), ("document" == e.containment || "window" == e.containment) && (this.containment = ["document" == e.containment ? 0 : a(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, "document" == e.containment ? 0 : a(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, ("document" == e.containment ? 0 : a(window).scrollLeft()) + a("document" == e.containment ? document : window).width() - this.helperProportions.width - this.margins.left, ("document" == e.containment ? 0 : a(window).scrollTop()) + (a("document" == e.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]), /^(document|window|parent)$/.test(e.containment) || e.containment.constructor == Array) { e.containment.constructor == Array && (this.containment = e.containment) } else { var c = a(e.containment),
                    d = c[0]; if (!d) { return } c.offset(); var b = "hidden" != a(d).css("overflow");
                this.containment = [(parseInt(a(d).css("borderLeftWidth"), 10) || 0) + (parseInt(a(d).css("paddingLeft"), 10) || 0), (parseInt(a(d).css("borderTopWidth"), 10) || 0) + (parseInt(a(d).css("paddingTop"), 10) || 0), (b ? Math.max(d.scrollWidth, d.offsetWidth) : d.offsetWidth) - (parseInt(a(d).css("borderLeftWidth"), 10) || 0) - (parseInt(a(d).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (b ? Math.max(d.scrollHeight, d.offsetHeight) : d.offsetHeight) - (parseInt(a(d).css("borderTopWidth"), 10) || 0) - (parseInt(a(d).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = c } }, _convertPositionTo: function(e, c) { c || (c = this.position); var d = "absolute" == e ? 1 : -1,
                b = (this.options, "absolute" != this.cssPosition || this.scrollParent[0] != document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent),
                f = /(html|body)/i.test(b[0].tagName); return { top: c.top + this.offset.relative.top * d + this.offset.parent.top * d - ("fixed" == this.cssPosition ? -this.scrollParent.scrollTop() : f ? 0 : b.scrollTop()) * d, left: c.left + this.offset.relative.left * d + this.offset.parent.left * d - ("fixed" == this.cssPosition ? -this.scrollParent.scrollLeft() : f ? 0 : b.scrollLeft()) * d } }, _generatePosition: function(m) { var c = this.options,
                k = "absolute" != this.cssPosition || this.scrollParent[0] != document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent,
                g = /(html|body)/i.test(k[0].tagName),
                e = m.pageX,
                j = m.pageY; if (this.originalPosition) { var f; if (this.containment) { if (this.relative_container) { var b = this.relative_container.offset();
                        f = [this.containment[0] + b.left, this.containment[1] + b.top, this.containment[2] + b.left, this.containment[3] + b.top] } else { f = this.containment } m.pageX - this.offset.click.left < f[0] && (e = f[0] + this.offset.click.left), m.pageY - this.offset.click.top < f[1] && (j = f[1] + this.offset.click.top), m.pageX - this.offset.click.left > f[2] && (e = f[2] + this.offset.click.left), m.pageY - this.offset.click.top > f[3] && (j = f[3] + this.offset.click.top) } if (c.grid) { var d = c.grid[1] ? this.originalPageY + Math.round((j - this.originalPageY) / c.grid[1]) * c.grid[1] : this.originalPageY;
                    j = f ? d - this.offset.click.top < f[1] || d - this.offset.click.top > f[3] ? d - this.offset.click.top < f[1] ? d + c.grid[1] : d - c.grid[1] : d : d; var p = c.grid[0] ? this.originalPageX + Math.round((e - this.originalPageX) / c.grid[0]) * c.grid[0] : this.originalPageX;
                    e = f ? p - this.offset.click.left < f[0] || p - this.offset.click.left > f[2] ? p - this.offset.click.left < f[0] ? p + c.grid[0] : p - c.grid[0] : p : p } } return { top: j - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" == this.cssPosition ? -this.scrollParent.scrollTop() : g ? 0 : k.scrollTop()), left: e - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" == this.cssPosition ? -this.scrollParent.scrollLeft() : g ? 0 : k.scrollLeft()) } }, _clear: function() { this.helper.removeClass("ui-draggable-dragging"), this.helper[0] == this.element[0] || this.cancelHelperRemoval || this.helper.remove(), this.helper = null, this.cancelHelperRemoval = !1 }, _trigger: function(d, b, c) { return c = c || this._uiHash(), a.ui.plugin.call(this, d, [b, c]), "drag" == d && (this.positionAbs = this._convertPositionTo("absolute")), a.Widget.prototype._trigger.call(this, d, b, c) }, plugins: {}, _uiHash: function() { return { helper: this.helper, position: this.position, originalPosition: this.originalPosition, offset: this.positionAbs } } }), a.ui.plugin.add("draggable", "connectToSortable", { start: function(e, c) { var d = a(this).data("draggable"),
                b = d.options,
                f = a.extend({}, c, { item: d.element });
            d.sortables = [], a(b.connectToSortable).each(function() { var g = a.data(this, "sortable");
                g && !g.options.disabled && (d.sortables.push({ instance: g, shouldRevert: g.options.revert }), g.refreshPositions(), g._trigger("activate", e, f)) }) }, stop: function(e, c) { var d = a(this).data("draggable"),
                b = a.extend({}, c, { item: d.element });
            a.each(d.sortables, function() { this.instance.isOver ? (this.instance.isOver = 0, d.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = !0), this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" == d.options.helper && this.instance.currentItem.css({ top: "auto", left: "auto" })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, b)) }) }, drag: function(e, c) { var d = a(this).data("draggable"),
                b = this;
            a.each(d.sortables, function() { var f = !1,
                    g = this;
                this.instance.positionAbs = d.positionAbs, this.instance.helperProportions = d.helperProportions, this.instance.offset.click = d.offset.click, this.instance._intersectsWith(this.instance.containerCache) && (f = !0, a.each(d.sortables, function() { return this.instance.positionAbs = d.positionAbs, this.instance.helperProportions = d.helperProportions, this.instance.offset.click = d.offset.click, this != g && this.instance._intersectsWith(this.instance.containerCache) && a.ui.contains(g.instance.element[0], this.instance.element[0]) && (f = !1), f })), f ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = a(b).clone().removeAttr("id").appendTo(this.instance.element).data("sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() { return c.helper[0] }, e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = d.offset.click.top, this.instance.offset.click.left = d.offset.click.left, this.instance.offset.parent.left -= d.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= d.offset.parent.top - this.instance.offset.parent.top, d._trigger("toSortable", e), d.dropped = this.instance.element, d.currentItem = d.element, this.instance.fromOutside = d), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), d._trigger("fromSortable", e), d.dropped = !1) }) } }), a.ui.plugin.add("draggable", "cursor", { start: function() { var c = a("body"),
                b = a(this).data("draggable").options;
            c.css("cursor") && (b._cursor = c.css("cursor")), c.css("cursor", b.cursor) }, stop: function() { var b = a(this).data("draggable").options;
            b._cursor && a("body").css("cursor", b._cursor) } }), a.ui.plugin.add("draggable", "opacity", { start: function(e, c) { var d = a(c.helper),
                b = a(this).data("draggable").options;
            d.css("opacity") && (b._opacity = d.css("opacity")), d.css("opacity", b.opacity) }, stop: function(d, b) { var c = a(this).data("draggable").options;
            c._opacity && a(b.helper).css("opacity", c._opacity) } }), a.ui.plugin.add("draggable", "scroll", { start: function() { var b = a(this).data("draggable");
            b.scrollParent[0] != document && "HTML" != b.scrollParent[0].tagName && (b.overflowOffset = b.scrollParent.offset()) }, drag: function(e) { var c = a(this).data("draggable"),
                d = c.options,
                b = !1;
            c.scrollParent[0] != document && "HTML" != c.scrollParent[0].tagName ? (d.axis && "x" == d.axis || (c.overflowOffset.top + c.scrollParent[0].offsetHeight - e.pageY < d.scrollSensitivity ? c.scrollParent[0].scrollTop = b = c.scrollParent[0].scrollTop + d.scrollSpeed : e.pageY - c.overflowOffset.top < d.scrollSensitivity && (c.scrollParent[0].scrollTop = b = c.scrollParent[0].scrollTop - d.scrollSpeed)), d.axis && "y" == d.axis || (c.overflowOffset.left + c.scrollParent[0].offsetWidth - e.pageX < d.scrollSensitivity ? c.scrollParent[0].scrollLeft = b = c.scrollParent[0].scrollLeft + d.scrollSpeed : e.pageX - c.overflowOffset.left < d.scrollSensitivity && (c.scrollParent[0].scrollLeft = b = c.scrollParent[0].scrollLeft - d.scrollSpeed))) : (d.axis && "x" == d.axis || (e.pageY - a(document).scrollTop() < d.scrollSensitivity ? b = a(document).scrollTop(a(document).scrollTop() - d.scrollSpeed) : a(window).height() - (e.pageY - a(document).scrollTop()) < d.scrollSensitivity && (b = a(document).scrollTop(a(document).scrollTop() + d.scrollSpeed))), d.axis && "y" == d.axis || (e.pageX - a(document).scrollLeft() < d.scrollSensitivity ? b = a(document).scrollLeft(a(document).scrollLeft() - d.scrollSpeed) : a(window).width() - (e.pageX - a(document).scrollLeft()) < d.scrollSensitivity && (b = a(document).scrollLeft(a(document).scrollLeft() + d.scrollSpeed)))), b !== !1 && a.ui.ddmanager && !d.dropBehaviour && a.ui.ddmanager.prepareOffsets(c, e) } }), a.ui.plugin.add("draggable", "snap", { start: function() { var c = a(this).data("draggable"),
                b = c.options;
            c.snapElements = [], a(b.snap.constructor != String ? b.snap.items || ":data(draggable)" : b.snap).each(function() { var d = a(this),
                    e = d.offset();
                this != c.element[0] && c.snapElements.push({ item: this, width: d.outerWidth(), height: d.outerHeight(), top: e.top, left: e.left }) }) }, drag: function(w, B) { for (var q = a(this).data("draggable"), G = q.options, E = G.snapTolerance, k = B.offset.left, F = k + q.helperProportions.width, A = B.offset.top, C = A + q.helperProportions.height, x = q.snapElements.length - 1; x >= 0; x--) { var J = q.snapElements[x].left,
                    I = J + q.snapElements[x].width,
                    j = q.snapElements[x].top,
                    K = j + q.snapElements[x].height; if (k > J - E && I + E > k && A > j - E && K + E > A || k > J - E && I + E > k && C > j - E && K + E > C || F > J - E && I + E > F && A > j - E && K + E > A || F > J - E && I + E > F && C > j - E && K + E > C) { if ("inner" != G.snapMode) { var D = E >= Math.abs(j - C),
                            L = E >= Math.abs(K - A),
                            z = E >= Math.abs(J - F),
                            e = E >= Math.abs(I - k);
                        D && (B.position.top = q._convertPositionTo("relative", { top: j - q.helperProportions.height, left: 0 }).top - q.margins.top), L && (B.position.top = q._convertPositionTo("relative", { top: K, left: 0 }).top - q.margins.top), z && (B.position.left = q._convertPositionTo("relative", { top: 0, left: J - q.helperProportions.width }).left - q.margins.left), e && (B.position.left = q._convertPositionTo("relative", { top: 0, left: I }).left - q.margins.left) } var H = D || L || z || e; if ("outer" != G.snapMode) { var D = E >= Math.abs(j - A),
                            L = E >= Math.abs(K - C),
                            z = E >= Math.abs(J - k),
                            e = E >= Math.abs(I - F);
                        D && (B.position.top = q._convertPositionTo("relative", { top: j, left: 0 }).top - q.margins.top), L && (B.position.top = q._convertPositionTo("relative", { top: K - q.helperProportions.height, left: 0 }).top - q.margins.top), z && (B.position.left = q._convertPositionTo("relative", { top: 0, left: J }).left - q.margins.left), e && (B.position.left = q._convertPositionTo("relative", { top: 0, left: I - q.helperProportions.width }).left - q.margins.left) }!q.snapElements[x].snapping && (D || L || z || e || H) && q.options.snap.snap && q.options.snap.snap.call(q.element, w, a.extend(q._uiHash(), { snapItem: q.snapElements[x].item })), q.snapElements[x].snapping = D || L || z || e || H } else { q.snapElements[x].snapping && q.options.snap.release && q.options.snap.release.call(q.element, w, a.extend(q._uiHash(), { snapItem: q.snapElements[x].item })), q.snapElements[x].snapping = !1 } } } }), a.ui.plugin.add("draggable", "stack", { start: function() { var d = a(this).data("draggable").options,
                b = a.makeArray(a(d.stack)).sort(function(f, e) { return (parseInt(a(f).css("zIndex"), 10) || 0) - (parseInt(a(e).css("zIndex"), 10) || 0) }); if (b.length) { var c = parseInt(b[0].style.zIndex) || 0;
                a(b).each(function(f) { this.style.zIndex = c + f }), this[0].style.zIndex = c + b.length } } }), a.ui.plugin.add("draggable", "zIndex", { start: function(e, c) { var d = a(c.helper),
                b = a(this).data("draggable").options;
            d.css("zIndex") && (b._zIndex = d.css("zIndex")), d.css("zIndex", b.zIndex) }, stop: function(d, b) { var c = a(this).data("draggable").options;
            c._zIndex && a(b.helper).css("zIndex", c._zIndex) } }) })(jQuery);
(function(a) { a.fn.extend({ beforeAfter: function(d) { var c = { animateIntro: false, introDelay: 1000, introDuration: 1000, introPosition: 0.5, showFullLinks: true, beforeLinkText: "<span></span>", afterLinkText: "<span></span>", imagePath: "./js/", cursor: "pointer", clickSpeed: 600, linkDisplaySpeed: 200, dividerColor: "#947E3C", enableKeyboard: false, keypressAmount: 20, onReady: function() {}, title: "" }; var d = a.extend(c, d); var b = Math.round(Math.random() * 100000000); return this.each(function() { var i = d; var l = a(this); var k = a("img:first", l).width(); var j = a("img:first", l).height(); if (a("div", l).length < 2) { a("img", l).wrap("<div>") } a(l).width(k).height(j).css({ overflow: "hidden", position: "relative", padding: "0" }); var g = a("img:first", l).attr("src"); var h = a("img:last", l).attr("src");
                a("img:first", l).attr("id", "beforeimage" + b);
                a("img:last", l).attr("id", "afterimage" + b);
                a(l).prepend('<div id="dragwrapper' + b + '"><div id="drag' + b + '"><img width="8" height="56" alt="handle" src="data:image/gif;base64,R0lGODlhCAA4ALMAAACrJATiNgCoJAvgOgCwIgHbLirXWQCcIP///wC7JQAAAAAAAAAAAAAAAAAAAAAAACH5BAAAAAAALAAAAAAIADgAAARc0MgZkhkllwTMTiBxeGA4fiZZimqKJuwbl/BJz6udtzWPuzcdcCcT9oo+YwyRYCJOzia0KfVEn1YqtnCdOr1VpDiYLI+J5PNwfUy70XD2rx2nmyqEPEFw4Bz+gBEAOw==" id="handle' + b + '" /></div></div>');
                a("#dragwrapper" + b).css({ opacity: 0.25, position: "absolute", padding: "0", left: (k * i.introPosition) - (a("#handle" + b).width() / 2) + "px", "z-index": "20" }).width(a("#handle" + b).width()).height(j);
                a("div:eq(2)", l).height(j).width(k * i.introPosition).css({ position: "absolute", overflow: "hidden", left: "0px", "z-index": "10" });
                a("div:eq(3)", l).height(j).width(k).css({ position: "absolute", overflow: "hidden", right: "0px" });
                a("#drag" + b).width(2).height(j).css({ background: i.dividerColor, position: "absolute", left: "3px" });
                a("#beforeimage" + b).css({ position: "absolute", top: "0px", left: "0px" });
                a("#afterimage" + b).css({ position: "absolute", top: "0px", right: "0px" });
                a("#handle" + b).css({ "z-index": "100", position: "relative", cursor: i.cursor, top: (j / 2) - (a("#handle" + b).height() / 2) + "px", left: "-3px" });
                a(l).append('<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAPCAYAAAAoAdW+AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAB9SURBVHjaYvz//z8DFsAGxAkMIEksuBaIX2OTSP8PAU/RJWKA+AdU8hGyRDAQf/2PAHBJbyD+9B8VgCWdgfjFf0wAltzxHzsAS5oB8QNckiBsB8QvcUmCsDsQf8AlCcIBQPwZlyQIRwLxPyB+hits80CSjDhihRmIwwACDACo50lKoGdCcAAAAABJRU5ErkJggg==" width="7" height="15" id="lt-arrow' + b + '"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAPCAYAAAAoAdW+AAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAABzSURBVHjaYvj//38kEDMDMQM6BhHPgDgPn+Q/qAkYko/+Q8BnIA7AJQkCH4DYHZckCLwEYjtckiDwAIjNcEmCwA4mBuzgJRB3Y9P5CYi9sdn5FYiDsbn2BxDHoPvzKVQyHVsIvQbiWlxhmwbEbNgkAQIMAFvjU6/j+UMZAAAAAElFTkSuQmCC" width="7" height="15" id="rt-arrow' + b + '">'); if (i.showFullLinks) { a(l).before('<div class="balinks balinksWrapper" for="' + a(l).attr("id") + '" id="links' + b + '" style="position:relative"><span class="balinktitle">' + i.title + '</span><span class="balinks showleft"><a id="showleft' + b + '" href="javascript:void(0)">' + i.beforeLinkText + '</a></span><span class="balinks showright"><a id="showright' + b + '" href="javascript:void(0)">' + i.afterLinkText + "</a></span></div>");
                    a("#links" + b).width(k);
                    a("#showleft" + b).css({ position: "relative" }).click(function() { a("div:eq(2)", l).animate({ width: k }, i.linkDisplaySpeed);
                        a("#dragwrapper" + b).animate({ left: k - a("#dragwrapper" + b).width() + "px" }, i.linkDisplaySpeed) });
                    a("#showright" + b).css({ position: "absolute" }).click(function() { a("div:eq(2)", l).animate({ width: 0 }, i.linkDisplaySpeed);
                        a("#dragwrapper" + b).animate({ left: "0px" }, i.linkDisplaySpeed) }) } if (i.enableKeyboard) { a(document).keydown(function(m) { if (m.keyCode == 39) { if ((parseInt(a("#dragwrapper" + b).css("left")) + parseInt(a("#dragwrapper" + b).width()) + i.keypressAmount) <= k) { a("#dragwrapper" + b).css("left", parseInt(a("#dragwrapper" + b).css("left")) + i.keypressAmount + "px");
                                a("div:eq(2)", l).width(parseInt(a("div:eq(2)", l).width()) + i.keypressAmount + "px") } else { a("#dragwrapper" + b).css("left", k - parseInt(a("#dragwrapper" + b).width()) + "px");
                                a("div:eq(2)", l).width(k - parseInt(a("#dragwrapper" + b).width()) / 2 + "px") } } if (m.keyCode == 37) { if ((parseInt(a("#dragwrapper" + b).css("left")) - i.keypressAmount) >= 0) { a("#dragwrapper" + b).css("left", parseInt(a("#dragwrapper" + b).css("left")) - i.keypressAmount + "px");
                                a("div:eq(2)", l).width(parseInt(a("div:eq(2)", l).width()) - i.keypressAmount + "px") } else { a("#dragwrapper" + b).css("left", "0px");
                                a("div:eq(2)", l).width(a("#dragwrapper" + b).width() / 2) } } }) } a("#dragwrapper" + b).draggable({ containment: l, drag: e, stop: e });

                function e() { a("#lt-arrow" + b + ", #rt-arrow" + b).stop().css("opacity", 0);
                    a("div:eq(2)", l).width(parseInt(a(this).css("left")) + 4) } if (i.animateIntro) { a("div:eq(2)", l).width(k);
                    a("#dragwrapper" + b).css("left", k - (a("#dragwrapper" + b).width() / 2) + "px");
                    setTimeout(function() { a("#dragwrapper" + b).css({ opacity: 1 }).animate({ left: (k * i.introPosition) - (a("#dragwrapper" + b).width() / 2) + "px" }, i.introDuration, function() { a("#dragwrapper" + b).animate({ opacity: 0.25 }, 1000) });
                        a("div:eq(2)", l).width(k).animate({ width: k * i.introPosition + "px" }, i.introDuration, function() { f();
                            i.onReady.call(this) }) }, i.introDelay) } else { f();
                    i.onReady.call(this) }

                function f() { a(l).hover(function() { a("#lt-arrow" + b).stop().css({ "z-index": "20", position: "absolute", top: j / 2 - a("#lt-arrow" + b).height() / 2 + "px", left: parseInt(a("#dragwrapper" + b).css("left")) - 10 + "px" }).animate({ opacity: 1, left: parseInt(a("#lt-arrow" + b).css("left")) - 6 + "px" }, 200);
                        a("#rt-arrow" + b).stop().css({ position: "absolute", top: j / 2 - a("#lt-arrow" + b).height() / 2 + "px", left: parseInt(a("#dragwrapper" + b).css("left")) + 10 + "px" }).animate({ opacity: 1, left: parseInt(a("#rt-arrow" + b).css("left")) + 6 + "px" }, 200);
                        a("#dragwrapper" + b).animate({ opacity: 1 }, 200) }, function() { a("#lt-arrow" + b).animate({ opacity: 0, left: parseInt(a("#lt-arrow" + b).css("left")) - 6 + "px" }, 350);
                        a("#rt-arrow" + b).animate({ opacity: 0, left: parseInt(a("#rt-arrow" + b).css("left")) + 6 + "px" }, 350);
                        a("#dragwrapper" + b).animate({ opacity: 0.25 }, 350) });
                    a(l).click(function(n) { var m = n.pageX - a(this).offset().left;
                        a("#dragwrapper" + b).stop().animate({ left: m - (a("#dragwrapper" + b).width() / 2) + "px" }, i.clickSpeed);
                        a("div:eq(2)", l).stop().animate({ width: m + "px" }, i.clickSpeed);
                        a("#lt-arrow" + b + ",#rt-arrow" + b).stop().animate({ opacity: 0 }, 50) });
                    a(l).one("mousemove", function() { a("#dragwrapper" + b).stop().animate({ opacity: 1 }, 500) }) } }) } }) })(jQuery);
! function() {
    function h(a) { a.fn.swiper = function(e) { var i; return a(this).each(function() { var j = new b(this, e);
                i || (i = j) }), i } } var d, b = function(al, X) {
        function W(i) { return Math.floor(i) }

        function ac() { Q.autoplayTimeoutId = setTimeout(function() { Q.params.loop ? (Q.fixLoop(), Q._slideNext(), Q.emit("onAutoplay", Q)) : Q.isEnd ? X.autoplayStopOnLast ? Q.stopAutoplay() : (Q._slideTo(0), Q.emit("onAutoplay", Q)) : (Q._slideNext(), Q.emit("onAutoplay", Q)) }, Q.params.autoplay) }

        function ag(m, l) { var k = d(m.target); if (!k.is(l)) { if ("string" == typeof l) { k = k.parents(l) } else { if (l.nodeType) { var i; return k.parents().each(function(o, n) { n === l && (i = l) }), i ? l : void 0 } } } if (0 !== k.length) { return k[0] } }

        function ah(m, i) { i = i || {}; var k = window.MutationObserver || window.WebkitMutationObserver,
                l = new k(function(n) { n.forEach(function(o) { Q.onResize(!0), Q.emit("onObserverUpdate", Q, o) }) });
            l.observe(m, { attributes: "undefined" == typeof i.attributes ? !0 : i.attributes, childList: "undefined" == typeof i.childList ? !0 : i.childList, characterData: "undefined" == typeof i.characterData ? !0 : i.characterData }), Q.observers.push(l) }

        function ae(B) { B.originalEvent && (B = B.originalEvent); var y = B.keyCode || B.charCode; if (!Q.params.allowSwipeToNext && (Q.isHorizontal() && 39 === y || !Q.isHorizontal() && 40 === y)) { return !1 } if (!Q.params.allowSwipeToPrev && (Q.isHorizontal() && 37 === y || !Q.isHorizontal() && 38 === y)) { return !1 } if (!(B.shiftKey || B.altKey || B.ctrlKey || B.metaKey || document.activeElement && document.activeElement.nodeName && ("input" === document.activeElement.nodeName.toLowerCase() || "textarea" === document.activeElement.nodeName.toLowerCase()))) { if (37 === y || 39 === y || 38 === y || 40 === y) { var k = !1; if (Q.container.parents(".swiper-slide").length > 0 && 0 === Q.container.parents(".swiper-slide-active").length) { return } var A = { left: window.pageXOffset, top: window.pageYOffset },
                        z = window.innerWidth,
                        m = window.innerHeight,
                        v = Q.container.offset();
                    Q.rtl && (v.left = v.left - Q.container[0].scrollLeft); for (var w = [
                            [v.left, v.top],
                            [v.left + Q.width, v.top],
                            [v.left, v.top + Q.height],
                            [v.left + Q.width, v.top + Q.height]
                        ], u = 0; u < w.length; u++) { var x = w[u];
                        x[0] >= A.left && x[0] <= A.left + z && x[1] >= A.top && x[1] <= A.top + m && (k = !0) } if (!k) { return } } Q.isHorizontal() ? ((37 === y || 39 === y) && (B.preventDefault ? B.preventDefault() : B.returnValue = !1), (39 === y && !Q.rtl || 37 === y && Q.rtl) && Q.slideNext(), (37 === y && !Q.rtl || 39 === y && Q.rtl) && Q.slidePrev()) : ((38 === y || 40 === y) && (B.preventDefault ? B.preventDefault() : B.returnValue = !1), 40 === y && Q.slideNext(), 38 === y && Q.slidePrev()) } }

        function V(v) { v.originalEvent && (v = v.originalEvent); var o = Q.mousewheel.event,
                k = 0,
                u = Q.rtl ? -1 : 1; if ("mousewheel" === o) { if (Q.params.mousewheelForceToAxis) { if (Q.isHorizontal()) { if (!(Math.abs(v.wheelDeltaX) > Math.abs(v.wheelDeltaY))) { return } k = v.wheelDeltaX * u } else { if (!(Math.abs(v.wheelDeltaY) > Math.abs(v.wheelDeltaX))) { return } k = v.wheelDeltaY } } else { k = Math.abs(v.wheelDeltaX) > Math.abs(v.wheelDeltaY) ? -v.wheelDeltaX * u : -v.wheelDeltaY } } else { if ("DOMMouseScroll" === o) { k = -v.detail } else { if ("wheel" === o) { if (Q.params.mousewheelForceToAxis) { if (Q.isHorizontal()) { if (!(Math.abs(v.deltaX) > Math.abs(v.deltaY))) { return } k = -v.deltaX * u } else { if (!(Math.abs(v.deltaY) > Math.abs(v.deltaX))) { return } k = -v.deltaY } } else { k = Math.abs(v.deltaX) > Math.abs(v.deltaY) ? -v.deltaX * u : -v.deltaY } } } } if (0 !== k) { if (Q.params.mousewheelInvert && (k = -k), Q.params.freeMode) { var p = Q.getWrapperTranslate() + k * Q.params.mousewheelSensitivity,
                        l = Q.isBeginning,
                        m = Q.isEnd; if (p >= Q.minTranslate() && (p = Q.minTranslate()), p <= Q.maxTranslate() && (p = Q.maxTranslate()), Q.setWrapperTransition(0), Q.setWrapperTranslate(p), Q.updateProgress(), Q.updateActiveIndex(), (!l && Q.isBeginning || !m && Q.isEnd) && Q.updateClasses(), Q.params.freeModeSticky ? (clearTimeout(Q.mousewheel.timeout), Q.mousewheel.timeout = setTimeout(function() { Q.slideReset() }, 300)) : Q.params.lazyLoading && Q.lazy && Q.lazy.load(), 0 === p || p === Q.maxTranslate()) { return } } else { if ((new window.Date).getTime() - Q.mousewheel.lastScrollTime > 60) { if (0 > k) { if (Q.isEnd && !Q.params.loop || Q.animating) { if (Q.params.mousewheelReleaseOnEdges) { return !0 } } else { Q.slideNext() } } else { if (Q.isBeginning && !Q.params.loop || Q.animating) { if (Q.params.mousewheelReleaseOnEdges) { return !0 } } else { Q.slidePrev() } } } Q.mousewheel.lastScrollTime = (new window.Date).getTime() } return Q.params.autoplay && Q.stopAutoplay(), v.preventDefault ? v.preventDefault() : v.returnValue = !1, !1 } }

        function ak(u, k) { u = d(u); var p, o, l, m = Q.rtl ? -1 : 1;
            p = u.attr("data-swiper-parallax") || "0", o = u.attr("data-swiper-parallax-x"), l = u.attr("data-swiper-parallax-y"), o || l ? (o = o || "0", l = l || "0") : Q.isHorizontal() ? (o = p, l = "0") : (l = p, o = "0"), o = o.indexOf("%") >= 0 ? parseInt(o, 10) * k * m + "%" : o * k * m + "px", l = l.indexOf("%") >= 0 ? parseInt(l, 10) * k + "%" : l * k + "px", u.transform("translate3d(" + o + ", " + l + ",0px)") }

        function Y(i) { return 0 !== i.indexOf("on") && (i = i[0] !== i[0].toUpperCase() ? "on" + i[0].toUpperCase() + i.substring(1) : "on" + i), i } if (!(this instanceof b)) { return new b(al, X) } var aj = { direction: "horizontal", touchEventsTarget: "container", initialSlide: 0, speed: 300, autoplay: !1, autoplayDisableOnInteraction: !0, autoplayStopOnLast: !1, iOSEdgeSwipeDetection: !1, iOSEdgeSwipeThreshold: 20, freeMode: !1, freeModeMomentum: !0, freeModeMomentumRatio: 1, freeModeMomentumBounce: !0, freeModeMomentumBounceRatio: 1, freeModeSticky: !1, freeModeMinimumVelocity: 0.02, autoHeight: !1, setWrapperSize: !1, virtualTranslate: !1, effect: "slide", coverflow: { rotate: 50, stretch: 0, depth: 100, modifier: 1, slideShadows: !0 }, flip: { slideShadows: !0, limitRotation: !0 }, cube: { slideShadows: !0, shadow: !0, shadowOffset: 20, shadowScale: 0.94 }, fade: { crossFade: !1 }, parallax: !1, scrollbar: null, scrollbarHide: !0, scrollbarDraggable: !1, scrollbarSnapOnRelease: !1, keyboardControl: !1, mousewheelControl: !1, mousewheelReleaseOnEdges: !1, mousewheelInvert: !1, mousewheelForceToAxis: !1, mousewheelSensitivity: 1, hashnav: !1, breakpoints: void 0, spaceBetween: 0, slidesPerView: 1, slidesPerColumn: 1, slidesPerColumnFill: "column", slidesPerGroup: 1, centeredSlides: !1, slidesOffsetBefore: 0, slidesOffsetAfter: 0, roundLengths: !1, touchRatio: 1, touchAngle: 45, simulateTouch: !0, shortSwipes: !0, longSwipes: !0, longSwipesRatio: 0.5, longSwipesMs: 300, followFinger: !0, onlyExternal: !1, threshold: 0, touchMoveStopPropagation: !0, uniqueNavElements: !0, pagination: null, paginationElement: "span", paginationClickable: !1, paginationHide: !1, paginationBulletRender: null, paginationProgressRender: null, paginationFractionRender: null, paginationCustomRender: null, paginationType: "bullets", resistance: !0, resistanceRatio: 0.85, nextButton: null, prevButton: null, watchSlidesProgress: !1, watchSlidesVisibility: !1, grabCursor: !1, preventClicks: !0, preventClicksPropagation: !0, slideToClickedSlide: !1, lazyLoading: !1, lazyLoadingInPrevNext: !1, lazyLoadingInPrevNextAmount: 1, lazyLoadingOnTransitionStart: !1, preloadImages: !0, updateOnImagesReady: !0, loop: !1, loopAdditionalSlides: 0, loopedSlides: null, control: void 0, controlInverse: !1, controlBy: "slide", allowSwipeToPrev: !0, allowSwipeToNext: !0, swipeHandler: null, noSwiping: !0, noSwipingClass: "swiper-no-swiping", slideClass: "swiper-slide", slideActiveClass: "swiper-slide-active", slideVisibleClass: "swiper-slide-visible", slideDuplicateClass: "swiper-slide-duplicate", slideNextClass: "swiper-slide-next", slidePrevClass: "swiper-slide-prev", wrapperClass: "swiper-wrapper", bulletClass: "swiper-pagination-bullet", bulletActiveClass: "swiper-pagination-bullet-active", buttonDisabledClass: "swiper-button-disabled", paginationCurrentClass: "swiper-pagination-current", paginationTotalClass: "swiper-pagination-total", paginationHiddenClass: "swiper-pagination-hidden", paginationProgressbarClass: "swiper-pagination-progressbar", observer: !1, observeParents: !1, a11y: !1, prevSlideMessage: "Previous slide", nextSlideMessage: "Next slide", firstSlideMessage: "This is the first slide", lastSlideMessage: "This is the last slide", paginationBulletMessage: "Go to slide {{index}}", runCallbacksOnInit: !0 },
            af = X && X.virtualTranslate;
        X = X || {}; var am = {}; for (var an in X) { if ("object" != typeof X[an] || null === X[an] || (X[an].nodeType || X[an] === window || X[an] === document || "undefined" != typeof Dom7 && X[an] instanceof Dom7 || "undefined" != typeof jQuery && X[an] instanceof jQuery)) { am[an] = X[an] } else { am[an] = {}; for (var ab in X[an]) { am[an][ab] = X[an][ab] } } } for (var Z in aj) { if ("undefined" == typeof X[Z]) { X[Z] = aj[Z] } else { if ("object" == typeof X[Z]) { for (var aa in aj[Z]) { "undefined" == typeof X[Z][aa] && (X[Z][aa] = aj[Z][aa]) } } } } var Q = this; if (Q.params = X, Q.originalParams = am, Q.classNames = [], "undefined" != typeof d && "undefined" != typeof Dom7 && (d = Dom7), ("undefined" != typeof d || (d = "undefined" == typeof Dom7 ? window.Dom7 || window.Zepto || window.jQuery : Dom7)) && (Q.$ = d, Q.currentBreakpoint = void 0, Q.getActiveBreakpoint = function() { if (!Q.params.breakpoints) { return !1 } var m, i = !1,
                    k = []; for (m in Q.params.breakpoints) { Q.params.breakpoints.hasOwnProperty(m) && k.push(m) } k.sort(function(o, n) { return parseInt(o, 10) > parseInt(n, 10) }); for (var l = 0; l < k.length; l++) { m = k[l], m >= window.innerWidth && !i && (i = m) } return i || "max" }, Q.setBreakpoint = function() { var m = Q.getActiveBreakpoint(); if (m && Q.currentBreakpoint !== m) { var i = m in Q.params.breakpoints ? Q.params.breakpoints[m] : Q.originalParams,
                        k = Q.params.loop && i.slidesPerView !== Q.params.slidesPerView; for (var l in i) { Q.params[l] = i[l] } Q.currentBreakpoint = m, k && Q.destroyLoop && Q.reLoop(!0) } }, Q.params.breakpoints && Q.setBreakpoint(), Q.container = d(al), 0 !== Q.container.length)) { if (Q.container.length > 1) { var ai = []; return Q.container.each(function() { ai.push(new b(this, X)) }), ai } Q.container[0].swiper = Q, Q.container.data("swiper", Q), Q.classNames.push("swiper-container-" + Q.params.direction), Q.params.freeMode && Q.classNames.push("swiper-container-free-mode"), Q.support.flexbox || (Q.classNames.push("swiper-container-no-flexbox"), Q.params.slidesPerColumn = 1), Q.params.autoHeight && Q.classNames.push("swiper-container-autoheight"), (Q.params.parallax || Q.params.watchSlidesVisibility) && (Q.params.watchSlidesProgress = !0), ["cube", "coverflow", "flip"].indexOf(Q.params.effect) >= 0 && (Q.support.transforms3d ? (Q.params.watchSlidesProgress = !0, Q.classNames.push("swiper-container-3d")) : Q.params.effect = "slide"), "slide" !== Q.params.effect && Q.classNames.push("swiper-container-" + Q.params.effect), "cube" === Q.params.effect && (Q.params.resistanceRatio = 0, Q.params.slidesPerView = 1, Q.params.slidesPerColumn = 1, Q.params.slidesPerGroup = 1, Q.params.centeredSlides = !1, Q.params.spaceBetween = 0, Q.params.virtualTranslate = !0, Q.params.setWrapperSize = !1), ("fade" === Q.params.effect || "flip" === Q.params.effect) && (Q.params.slidesPerView = 1, Q.params.slidesPerColumn = 1, Q.params.slidesPerGroup = 1, Q.params.watchSlidesProgress = !0, Q.params.spaceBetween = 0, Q.params.setWrapperSize = !1, "undefined" == typeof af && (Q.params.virtualTranslate = !0)), Q.params.grabCursor && Q.support.touch && (Q.params.grabCursor = !1), Q.wrapper = Q.container.children("." + Q.params.wrapperClass), Q.params.pagination && (Q.paginationContainer = d(Q.params.pagination), Q.params.uniqueNavElements && "string" == typeof Q.params.pagination && Q.paginationContainer.length > 1 && 1 === Q.container.find(Q.params.pagination).length && (Q.paginationContainer = Q.container.find(Q.params.pagination)), "bullets" === Q.params.paginationType && Q.params.paginationClickable ? Q.paginationContainer.addClass("swiper-pagination-clickable") : Q.params.paginationClickable = !1, Q.paginationContainer.addClass("swiper-pagination-" + Q.params.paginationType)), (Q.params.nextButton || Q.params.prevButton) && (Q.params.nextButton && (Q.nextButton = d(Q.params.nextButton), Q.params.uniqueNavElements && "string" == typeof Q.params.nextButton && Q.nextButton.length > 1 && 1 === Q.container.find(Q.params.nextButton).length && (Q.nextButton = Q.container.find(Q.params.nextButton))), Q.params.prevButton && (Q.prevButton = d(Q.params.prevButton), Q.params.uniqueNavElements && "string" == typeof Q.params.prevButton && Q.prevButton.length > 1 && 1 === Q.container.find(Q.params.prevButton).length && (Q.prevButton = Q.container.find(Q.params.prevButton)))), Q.isHorizontal = function() { return "horizontal" === Q.params.direction }, Q.rtl = Q.isHorizontal() && ("rtl" === Q.container[0].dir.toLowerCase() || "rtl" === Q.container.css("direction")), Q.rtl && Q.classNames.push("swiper-container-rtl"), Q.rtl && (Q.wrongRTL = "-webkit-box" === Q.wrapper.css("display")), Q.params.slidesPerColumn > 1 && Q.classNames.push("swiper-container-multirow"), Q.device.android && Q.classNames.push("swiper-container-android"), Q.container.addClass(Q.classNames.join(" ")), Q.translate = 0, Q.progress = 0, Q.velocity = 0, Q.lockSwipeToNext = function() { Q.params.allowSwipeToNext = !1 }, Q.lockSwipeToPrev = function() { Q.params.allowSwipeToPrev = !1 }, Q.lockSwipes = function() { Q.params.allowSwipeToNext = Q.params.allowSwipeToPrev = !1 }, Q.unlockSwipeToNext = function() { Q.params.allowSwipeToNext = !0 }, Q.unlockSwipeToPrev = function() { Q.params.allowSwipeToPrev = !0 }, Q.unlockSwipes = function() { Q.params.allowSwipeToNext = Q.params.allowSwipeToPrev = !0 }, Q.params.grabCursor && (Q.container[0].style.cursor = "move", Q.container[0].style.cursor = "-webkit-grab", Q.container[0].style.cursor = "-moz-grab", Q.container[0].style.cursor = "grab"), Q.imagesToLoad = [], Q.imagesLoaded = 0, Q.loadImage = function(v, o, k, u, p) {
                function l() { p && p() } var m;
                v.complete && u ? l() : o ? (m = new window.Image, m.onload = l, m.onerror = l, k && (m.srcset = k), o && (m.src = o)) : l() }, Q.preloadImages = function() {
                function k() { "undefined" != typeof Q && null !== Q && (void 0 !== Q.imagesLoaded && Q.imagesLoaded++, Q.imagesLoaded === Q.imagesToLoad.length && (Q.params.updateOnImagesReady && Q.update(), Q.emit("onImagesReady", Q))) } Q.imagesToLoad = Q.container.find("img"); for (var i = 0; i < Q.imagesToLoad.length; i++) { Q.loadImage(Q.imagesToLoad[i], Q.imagesToLoad[i].currentSrc || Q.imagesToLoad[i].getAttribute("src"), Q.imagesToLoad[i].srcset || Q.imagesToLoad[i].getAttribute("srcset"), !0, k) } }, Q.autoplayTimeoutId = void 0, Q.autoplaying = !1, Q.autoplayPaused = !1, Q.startAutoplay = function() { return "undefined" != typeof Q.autoplayTimeoutId ? !1 : Q.params.autoplay ? Q.autoplaying ? !1 : (Q.autoplaying = !0, Q.emit("onAutoplayStart", Q), void ac()) : !1 }, Q.stopAutoplay = function(i) { Q.autoplayTimeoutId && (Q.autoplayTimeoutId && clearTimeout(Q.autoplayTimeoutId), Q.autoplaying = !1, Q.autoplayTimeoutId = void 0, Q.emit("onAutoplayStop", Q)) }, Q.pauseAutoplay = function(i) { Q.autoplayPaused || (Q.autoplayTimeoutId && clearTimeout(Q.autoplayTimeoutId), Q.autoplayPaused = !0, 0 === i ? (Q.autoplayPaused = !1, ac()) : Q.wrapper.transitionEnd(function() { Q && (Q.autoplayPaused = !1, Q.autoplaying ? ac() : Q.stopAutoplay()) })) }, Q.minTranslate = function() { return -Q.snapGrid[0] }, Q.maxTranslate = function() { return -Q.snapGrid[Q.snapGrid.length - 1] }, Q.updateAutoHeight = function() { var k = Q.slides.eq(Q.activeIndex)[0]; if ("undefined" != typeof k) { var i = k.offsetHeight;
                    i && Q.wrapper.css("height", i + "px") } }, Q.updateContainerSize = function() { var k, i;
                k = "undefined" != typeof Q.params.width ? Q.params.width : Q.container[0].clientWidth, i = "undefined" != typeof Q.params.height ? Q.params.height : Q.container[0].clientHeight, 0 === k && Q.isHorizontal() || 0 === i && !Q.isHorizontal() || (k = k - parseInt(Q.container.css("padding-left"), 10) - parseInt(Q.container.css("padding-right"), 10), i = i - parseInt(Q.container.css("padding-top"), 10) - parseInt(Q.container.css("padding-bottom"), 10), Q.width = k, Q.height = i, Q.size = Q.isHorizontal() ? Q.width : Q.height) }, Q.updateSlidesSize = function() { Q.slides = Q.wrapper.children("." + Q.params.slideClass), Q.snapGrid = [], Q.slidesGrid = [], Q.slidesSizesGrid = []; var G, C = Q.params.spaceBetween,
                    v = -Q.params.slidesOffsetBefore,
                    r = 0,
                    x = 0; if ("undefined" != typeof Q.size) { "string" == typeof C && C.indexOf("%") >= 0 && (C = parseFloat(C.replace("%", "")) / 100 * Q.size), Q.virtualSize = -C, Q.rtl ? Q.slides.css({ marginLeft: "", marginTop: "" }) : Q.slides.css({ marginRight: "", marginBottom: "" }); var A;
                    Q.params.slidesPerColumn > 1 && (A = Math.floor(Q.slides.length / Q.params.slidesPerColumn) === Q.slides.length / Q.params.slidesPerColumn ? Q.slides.length : Math.ceil(Q.slides.length / Q.params.slidesPerColumn) * Q.params.slidesPerColumn, "auto" !== Q.params.slidesPerView && "row" === Q.params.slidesPerColumnFill && (A = Math.max(A, Q.params.slidesPerView * Q.params.slidesPerColumn))); var B, y = Q.params.slidesPerColumn,
                        k = A / y,
                        E = k - (Q.params.slidesPerColumn * k - Q.slides.length); for (G = 0; G < Q.slides.length; G++) { B = 0; var w = Q.slides.eq(G); if (Q.params.slidesPerColumn > 1) { var D, z, H; "column" === Q.params.slidesPerColumnFill ? (z = Math.floor(G / y), H = G - z * y, (z > E || z === E && H === y - 1) && ++H >= y && (H = 0, z++), D = z + H * A / y, w.css({ "-webkit-box-ordinal-group": D, "-moz-box-ordinal-group": D, "-ms-flex-order": D, "-webkit-order": D, order: D })) : (H = Math.floor(G / k), z = G - H * k), w.css({ "margin-top": 0 !== H && Q.params.spaceBetween && Q.params.spaceBetween + "px" }).attr("data-swiper-column", z).attr("data-swiper-row", H) } "none" !== w.css("display") && ("auto" === Q.params.slidesPerView ? (B = Q.isHorizontal() ? w.outerWidth(!0) : w.outerHeight(!0), Q.params.roundLengths && (B = W(B))) : (B = (Q.size - (Q.params.slidesPerView - 1) * C) / Q.params.slidesPerView, Q.params.roundLengths && (B = W(B)), Q.isHorizontal() ? Q.slides[G].style.width = B + "px" : Q.slides[G].style.height = B + "px"), Q.slides[G].swiperSlideSize = B, Q.slidesSizesGrid.push(B), Q.params.centeredSlides ? (v = v + B / 2 + r / 2 + C, 0 === G && (v = v - Q.size / 2 - C), Math.abs(v) < 0.001 && (v = 0), x % Q.params.slidesPerGroup === 0 && Q.snapGrid.push(v), Q.slidesGrid.push(v)) : (x % Q.params.slidesPerGroup === 0 && Q.snapGrid.push(v), Q.slidesGrid.push(v), v = v + B + C), Q.virtualSize += B + C, r = B, x++) } Q.virtualSize = Math.max(Q.virtualSize, Q.size) + Q.params.slidesOffsetAfter; var I; if (Q.rtl && Q.wrongRTL && ("slide" === Q.params.effect || "coverflow" === Q.params.effect) && Q.wrapper.css({ width: Q.virtualSize + Q.params.spaceBetween + "px" }), (!Q.support.flexbox || Q.params.setWrapperSize) && (Q.isHorizontal() ? Q.wrapper.css({ width: Q.virtualSize + Q.params.spaceBetween + "px" }) : Q.wrapper.css({ height: Q.virtualSize + Q.params.spaceBetween + "px" })), Q.params.slidesPerColumn > 1 && (Q.virtualSize = (B + Q.params.spaceBetween) * A, Q.virtualSize = Math.ceil(Q.virtualSize / Q.params.slidesPerColumn) - Q.params.spaceBetween, Q.wrapper.css({ width: Q.virtualSize + Q.params.spaceBetween + "px" }), Q.params.centeredSlides)) { for (I = [], G = 0; G < Q.snapGrid.length; G++) { Q.snapGrid[G] < Q.virtualSize + Q.snapGrid[0] && I.push(Q.snapGrid[G]) } Q.snapGrid = I } if (!Q.params.centeredSlides) { for (I = [], G = 0; G < Q.snapGrid.length; G++) { Q.snapGrid[G] <= Q.virtualSize - Q.size && I.push(Q.snapGrid[G]) } Q.snapGrid = I, Math.floor(Q.virtualSize - Q.size) - Math.floor(Q.snapGrid[Q.snapGrid.length - 1]) > 1 && Q.snapGrid.push(Q.virtualSize - Q.size) } 0 === Q.snapGrid.length && (Q.snapGrid = [0]), 0 !== Q.params.spaceBetween && (Q.isHorizontal() ? Q.rtl ? Q.slides.css({ marginLeft: C + "px" }) : Q.slides.css({ marginRight: C + "px" }) : Q.slides.css({ marginBottom: C + "px" })), Q.params.watchSlidesProgress && Q.updateSlidesOffset() } }, Q.updateSlidesOffset = function() { for (var i = 0; i < Q.slides.length; i++) { Q.slides[i].swiperSlideOffset = Q.isHorizontal() ? Q.slides[i].offsetLeft : Q.slides[i].offsetTop } }, Q.updateSlidesProgress = function(x) { if ("undefined" == typeof x && (x = Q.translate || 0), 0 !== Q.slides.length) { "undefined" == typeof Q.slides[0].swiperSlideOffset && Q.updateSlidesOffset(); var u = -x;
                    Q.rtl && (u = x), Q.slides.removeClass(Q.params.slideVisibleClass); for (var k = 0; k < Q.slides.length; k++) { var w = Q.slides[k],
                            v = (u - w.swiperSlideOffset) / (w.swiperSlideSize + Q.params.spaceBetween); if (Q.params.watchSlidesVisibility) { var l = -(u - w.swiperSlideOffset),
                                m = l + Q.slidesSizesGrid[k],
                                p = l >= 0 && l < Q.size || m > 0 && m <= Q.size || 0 >= l && m >= Q.size;
                            p && Q.slides.eq(k).addClass(Q.params.slideVisibleClass) } w.progress = Q.rtl ? -v : v } } }, Q.updateProgress = function(m) { "undefined" == typeof m && (m = Q.translate || 0); var i = Q.maxTranslate() - Q.minTranslate(),
                    k = Q.isBeginning,
                    l = Q.isEnd;
                0 === i ? (Q.progress = 0, Q.isBeginning = Q.isEnd = !0) : (Q.progress = (m - Q.minTranslate()) / i, Q.isBeginning = Q.progress <= 0, Q.isEnd = Q.progress >= 1), Q.isBeginning && !k && Q.emit("onReachBeginning", Q), Q.isEnd && !l && Q.emit("onReachEnd", Q), Q.params.watchSlidesProgress && Q.updateSlidesProgress(m), Q.emit("onProgress", Q, Q.progress) }, Q.updateActiveIndex = function() { var m, i, k, l = Q.rtl ? Q.translate : -Q.translate; for (i = 0; i < Q.slidesGrid.length; i++) { "undefined" != typeof Q.slidesGrid[i + 1] ? l >= Q.slidesGrid[i] && l < Q.slidesGrid[i + 1] - (Q.slidesGrid[i + 1] - Q.slidesGrid[i]) / 2 ? m = i : l >= Q.slidesGrid[i] && l < Q.slidesGrid[i + 1] && (m = i + 1) : l >= Q.slidesGrid[i] && (m = i) }(0 > m || "undefined" == typeof m) && (m = 0), k = Math.floor(m / Q.params.slidesPerGroup), k >= Q.snapGrid.length && (k = Q.snapGrid.length - 1), m !== Q.activeIndex && (Q.snapIndex = k, Q.previousIndex = Q.activeIndex, Q.activeIndex = m, Q.updateClasses()) }, Q.updateClasses = function() { Q.slides.removeClass(Q.params.slideActiveClass + " " + Q.params.slideNextClass + " " + Q.params.slidePrevClass); var y = Q.slides.eq(Q.activeIndex);
                y.addClass(Q.params.slideActiveClass); var k = y.next("." + Q.params.slideClass).addClass(Q.params.slideNextClass);
                Q.params.loop && 0 === k.length && Q.slides.eq(0).addClass(Q.params.slideNextClass); var x = y.prev("." + Q.params.slideClass).addClass(Q.params.slidePrevClass); if (Q.params.loop && 0 === x.length && Q.slides.eq(-1).addClass(Q.params.slidePrevClass), Q.paginationContainer && Q.paginationContainer.length > 0) { var w, m = Q.params.loop ? Math.ceil((Q.slides.length - 2 * Q.loopedSlides) / Q.params.slidesPerGroup) : Q.snapGrid.length; if (Q.params.loop ? (w = Math.ceil((Q.activeIndex - Q.loopedSlides) / Q.params.slidesPerGroup), w > Q.slides.length - 1 - 2 * Q.loopedSlides && (w -= Q.slides.length - 2 * Q.loopedSlides), w > m - 1 && (w -= m), 0 > w && "bullets" !== Q.params.paginationType && (w = m + w)) : w = "undefined" != typeof Q.snapIndex ? Q.snapIndex : Q.activeIndex || 0, "bullets" === Q.params.paginationType && Q.bullets && Q.bullets.length > 0 && (Q.bullets.removeClass(Q.params.bulletActiveClass), Q.paginationContainer.length > 1 ? Q.bullets.each(function() { d(this).index() === w && d(this).addClass(Q.params.bulletActiveClass) }) : Q.bullets.eq(w).addClass(Q.params.bulletActiveClass)), "fraction" === Q.params.paginationType && (Q.paginationContainer.find("." + Q.params.paginationCurrentClass).text(w + 1), Q.paginationContainer.find("." + Q.params.paginationTotalClass).text(m)), "progress" === Q.params.paginationType) { var u = (w + 1) / m,
                            v = u,
                            p = 1;
                        Q.isHorizontal() || (p = u, v = 1), Q.paginationContainer.find("." + Q.params.paginationProgressbarClass).transform("translate3d(0,0,0) scaleX(" + v + ") scaleY(" + p + ")").transition(Q.params.speed) } "custom" === Q.params.paginationType && Q.params.paginationCustomRender && (Q.paginationContainer.html(Q.params.paginationCustomRender(Q, w + 1, m)), Q.emit("onPaginationRendered", Q, Q.paginationContainer[0])) } Q.params.loop || (Q.params.prevButton && Q.prevButton && Q.prevButton.length > 0 && (Q.isBeginning ? (Q.prevButton.addClass(Q.params.buttonDisabledClass), Q.params.a11y && Q.a11y && Q.a11y.disable(Q.prevButton)) : (Q.prevButton.removeClass(Q.params.buttonDisabledClass), Q.params.a11y && Q.a11y && Q.a11y.enable(Q.prevButton))), Q.params.nextButton && Q.nextButton && Q.nextButton.length > 0 && (Q.isEnd ? (Q.nextButton.addClass(Q.params.buttonDisabledClass), Q.params.a11y && Q.a11y && Q.a11y.disable(Q.nextButton)) : (Q.nextButton.removeClass(Q.params.buttonDisabledClass), Q.params.a11y && Q.a11y && Q.a11y.enable(Q.nextButton)))) }, Q.updatePagination = function() { if (Q.params.pagination && Q.paginationContainer && Q.paginationContainer.length > 0) { var l = ""; if ("bullets" === Q.params.paginationType) { for (var i = Q.params.loop ? Math.ceil((Q.slides.length - 2 * Q.loopedSlides) / Q.params.slidesPerGroup) : Q.snapGrid.length, k = 0; i > k; k++) { l += Q.params.paginationBulletRender ? Q.params.paginationBulletRender(k, Q.params.bulletClass) : "<" + Q.params.paginationElement + ' class="' + Q.params.bulletClass + '"></' + Q.params.paginationElement + ">" } Q.paginationContainer.html(l), Q.bullets = Q.paginationContainer.find("." + Q.params.bulletClass), Q.params.paginationClickable && Q.params.a11y && Q.a11y && Q.a11y.initPagination() } "fraction" === Q.params.paginationType && (l = Q.params.paginationFractionRender ? Q.params.paginationFractionRender(Q, Q.params.paginationCurrentClass, Q.params.paginationTotalClass) : '<span class="' + Q.params.paginationCurrentClass + '"></span> / <span class="' + Q.params.paginationTotalClass + '"></span>', Q.paginationContainer.html(l)), "progress" === Q.params.paginationType && (l = Q.params.paginationProgressRender ? Q.params.paginationProgressRender(Q, Q.params.paginationProgressbarClass) : '<span class="' + Q.params.paginationProgressbarClass + '"></span>', Q.paginationContainer.html(l)), "custom" !== Q.params.paginationType && Q.emit("onPaginationRendered", Q, Q.paginationContainer[0]) } }, Q.update = function(m) {
                function i() { l = Math.min(Math.max(Q.translate, Q.maxTranslate()), Q.minTranslate()), Q.setWrapperTranslate(l), Q.updateActiveIndex(), Q.updateClasses() } if (Q.updateContainerSize(), Q.updateSlidesSize(), Q.updateProgress(), Q.updatePagination(), Q.updateClasses(), Q.params.scrollbar && Q.scrollbar && Q.scrollbar.set(), m) { var k, l;
                    Q.controller && Q.controller.spline && (Q.controller.spline = void 0), Q.params.freeMode ? (i(), Q.params.autoHeight && Q.updateAutoHeight()) : (k = ("auto" === Q.params.slidesPerView || Q.params.slidesPerView > 1) && Q.isEnd && !Q.params.centeredSlides ? Q.slideTo(Q.slides.length - 1, 0, !1, !0) : Q.slideTo(Q.activeIndex, 0, !1, !0), k || i()) } else { Q.params.autoHeight && Q.updateAutoHeight() } }, Q.onResize = function(n) { Q.params.breakpoints && Q.setBreakpoint(); var k = Q.params.allowSwipeToPrev,
                    l = Q.params.allowSwipeToNext;
                Q.params.allowSwipeToPrev = Q.params.allowSwipeToNext = !0, Q.updateContainerSize(), Q.updateSlidesSize(), ("auto" === Q.params.slidesPerView || Q.params.freeMode || n) && Q.updatePagination(), Q.params.scrollbar && Q.scrollbar && Q.scrollbar.set(), Q.controller && Q.controller.spline && (Q.controller.spline = void 0); var m = !1; if (Q.params.freeMode) { var i = Math.min(Math.max(Q.translate, Q.maxTranslate()), Q.minTranslate());
                    Q.setWrapperTranslate(i), Q.updateActiveIndex(), Q.updateClasses(), Q.params.autoHeight && Q.updateAutoHeight() } else { Q.updateClasses(), m = ("auto" === Q.params.slidesPerView || Q.params.slidesPerView > 1) && Q.isEnd && !Q.params.centeredSlides ? Q.slideTo(Q.slides.length - 1, 0, !1, !0) : Q.slideTo(Q.activeIndex, 0, !1, !0) } Q.params.lazyLoading && !m && Q.lazy && Q.lazy.load(), Q.params.allowSwipeToPrev = k, Q.params.allowSwipeToNext = l }; var K = ["mousedown", "mousemove", "mouseup"];
            window.navigator.pointerEnabled ? K = ["pointerdown", "pointermove", "pointerup"] : window.navigator.msPointerEnabled && (K = ["MSPointerDown", "MSPointerMove", "MSPointerUp"]), Q.touchEvents = { start: Q.support.touch || !Q.params.simulateTouch ? "touchstart" : K[0], move: Q.support.touch || !Q.params.simulateTouch ? "touchmove" : K[1], end: Q.support.touch || !Q.params.simulateTouch ? "touchend" : K[2] }, (window.navigator.pointerEnabled || window.navigator.msPointerEnabled) && ("container" === Q.params.touchEventsTarget ? Q.container : Q.wrapper).addClass("swiper-wp8-" + Q.params.direction), Q.initEvents = function(s) { var o = s ? "off" : "on",
                    k = s ? "removeEventListener" : "addEventListener",
                    p = "container" === Q.params.touchEventsTarget ? Q.container[0] : Q.wrapper[0],
                    l = Q.support.touch ? p : document,
                    m = Q.params.nested ? !0 : !1;
                Q.browser.ie ? (p[k](Q.touchEvents.start, Q.onTouchStart, !1), l[k](Q.touchEvents.move, Q.onTouchMove, m), l[k](Q.touchEvents.end, Q.onTouchEnd, !1)) : (Q.support.touch && (p[k](Q.touchEvents.start, Q.onTouchStart, !1), p[k](Q.touchEvents.move, Q.onTouchMove, m), p[k](Q.touchEvents.end, Q.onTouchEnd, !1)), !X.simulateTouch || Q.device.ios || Q.device.android || (p[k]("mousedown", Q.onTouchStart, !1), document[k]("mousemove", Q.onTouchMove, m), document[k]("mouseup", Q.onTouchEnd, !1))), window[k]("resize", Q.onResize), Q.params.nextButton && Q.nextButton && Q.nextButton.length > 0 && (Q.nextButton[o]("click", Q.onClickNext), Q.params.a11y && Q.a11y && Q.nextButton[o]("keydown", Q.a11y.onEnterKey)), Q.params.prevButton && Q.prevButton && Q.prevButton.length > 0 && (Q.prevButton[o]("click", Q.onClickPrev), Q.params.a11y && Q.a11y && Q.prevButton[o]("keydown", Q.a11y.onEnterKey)), Q.params.pagination && Q.params.paginationClickable && (Q.paginationContainer[o]("click", "." + Q.params.bulletClass, Q.onClickIndex), Q.params.a11y && Q.a11y && Q.paginationContainer[o]("keydown", "." + Q.params.bulletClass, Q.a11y.onEnterKey)), (Q.params.preventClicks || Q.params.preventClicksPropagation) && p[k]("click", Q.preventClicks, !0) }, Q.attachEvents = function() { Q.initEvents() }, Q.detachEvents = function() { Q.initEvents(!0) }, Q.allowClick = !0, Q.preventClicks = function(i) { Q.allowClick || (Q.params.preventClicks && i.preventDefault(), Q.params.preventClicksPropagation && Q.animating && (i.stopPropagation(), i.stopImmediatePropagation())) }, Q.onClickNext = function(i) { i.preventDefault(), (!Q.isEnd || Q.params.loop) && Q.slideNext() }, Q.onClickPrev = function(i) { i.preventDefault(), (!Q.isBeginning || Q.params.loop) && Q.slidePrev() }, Q.onClickIndex = function(i) { i.preventDefault(); var k = d(this).index() * Q.params.slidesPerGroup;
                Q.params.loop && (k += Q.loopedSlides), Q.slideTo(k) }, Q.updateClickedSlide = function(u) { var k = ag(u, "." + Q.params.slideClass),
                    p = !1; if (k) { for (var n = 0; n < Q.slides.length; n++) { Q.slides[n] === k && (p = !0) } } if (!k || !p) { return Q.clickedSlide = void 0, void(Q.clickedIndex = void 0) } if (Q.clickedSlide = k, Q.clickedIndex = d(k).index(), Q.params.slideToClickedSlide && void 0 !== Q.clickedIndex && Q.clickedIndex !== Q.activeIndex) { var l, m = Q.clickedIndex; if (Q.params.loop) { if (Q.animating) { return } l = d(Q.clickedSlide).attr("data-swiper-slide-index"), Q.params.centeredSlides ? m < Q.loopedSlides - Q.params.slidesPerView / 2 || m > Q.slides.length - Q.loopedSlides + Q.params.slidesPerView / 2 ? (Q.fixLoop(), m = Q.wrapper.children("." + Q.params.slideClass + '[data-swiper-slide-index="' + l + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function() { Q.slideTo(m) }, 0)) : Q.slideTo(m) : m > Q.slides.length - Q.params.slidesPerView ? (Q.fixLoop(), m = Q.wrapper.children("." + Q.params.slideClass + '[data-swiper-slide-index="' + l + '"]:not(.swiper-slide-duplicate)').eq(0).index(), setTimeout(function() { Q.slideTo(m) }, 0)) : Q.slideTo(m) } else { Q.slideTo(m) } } }; var ar, aq, q, U, aw, ao, au, ad, F, j, t = "input, select, textarea, button",
                av = Date.now(),
                at = [];
            Q.animating = !1, Q.touches = { startX: 0, startY: 0, currentX: 0, currentY: 0, diff: 0 }; var J, a; if (Q.onTouchStart = function(m) { if (m.originalEvent && (m = m.originalEvent), J = "touchstart" === m.type, J || !("which" in m) || 3 !== m.which) { if (Q.params.noSwiping && ag(m, "." + Q.params.noSwipingClass)) { return void(Q.allowClick = !0) } if (!Q.params.swipeHandler || ag(m, Q.params.swipeHandler)) { var l = Q.touches.currentX = "touchstart" === m.type ? m.targetTouches[0].pageX : m.pageX,
                                k = Q.touches.currentY = "touchstart" === m.type ? m.targetTouches[0].pageY : m.pageY; if (!(Q.device.ios && Q.params.iOSEdgeSwipeDetection && l <= Q.params.iOSEdgeSwipeThreshold)) { if (ar = !0, aq = !1, q = !0, aw = void 0, a = void 0, Q.touches.startX = l, Q.touches.startY = k, U = Date.now(), Q.allowClick = !0, Q.updateContainerSize(), Q.swipeDirection = void 0, Q.params.threshold > 0 && (ad = !1), "touchstart" !== m.type) { var i = !0;
                                    d(m.target).is(t) && (i = !1), document.activeElement && d(document.activeElement).is(t) && document.activeElement.blur(), i && m.preventDefault() } Q.emit("onTouchStart", Q, m) } } } }, Q.onTouchMove = function(n) { if (n.originalEvent && (n = n.originalEvent), !J || "mousemove" !== n.type) { if (n.preventedByNestedSwiper) { return Q.touches.startX = "touchmove" === n.type ? n.targetTouches[0].pageX : n.pageX, void(Q.touches.startY = "touchmove" === n.type ? n.targetTouches[0].pageY : n.pageY) } if (Q.params.onlyExternal) { return Q.allowClick = !1, void(ar && (Q.touches.startX = Q.touches.currentX = "touchmove" === n.type ? n.targetTouches[0].pageX : n.pageX, Q.touches.startY = Q.touches.currentY = "touchmove" === n.type ? n.targetTouches[0].pageY : n.pageY, U = Date.now())) } if (J && document.activeElement && n.target === document.activeElement && d(n.target).is(t)) { return aq = !0, void(Q.allowClick = !1) } if (q && Q.emit("onTouchMove", Q, n), !(n.targetTouches && n.targetTouches.length > 1)) { if (Q.touches.currentX = "touchmove" === n.type ? n.targetTouches[0].pageX : n.pageX, Q.touches.currentY = "touchmove" === n.type ? n.targetTouches[0].pageY : n.pageY, "undefined" == typeof aw) { var m = 180 * Math.atan2(Math.abs(Q.touches.currentY - Q.touches.startY), Math.abs(Q.touches.currentX - Q.touches.startX)) / Math.PI;
                                aw = Q.isHorizontal() ? m > Q.params.touchAngle : 90 - m > Q.params.touchAngle } if (aw && Q.emit("onTouchMoveOpposite", Q, n), "undefined" == typeof a && Q.browser.ieTouch && (Q.touches.currentX !== Q.touches.startX || Q.touches.currentY !== Q.touches.startY) && (a = !0), ar) { if (aw) { return void(ar = !1) } if (a || !Q.browser.ieTouch) { Q.allowClick = !1, Q.emit("onSliderMove", Q, n), n.preventDefault(), Q.params.touchMoveStopPropagation && !Q.params.nested && n.stopPropagation(), aq || (X.loop && Q.fixLoop(), au = Q.getWrapperTranslate(), Q.setWrapperTransition(0), Q.animating && Q.wrapper.trigger("webkitTransitionEnd transitionend oTransitionEnd MSTransitionEnd msTransitionEnd"), Q.params.autoplay && Q.autoplaying && (Q.params.autoplayDisableOnInteraction ? Q.stopAutoplay() : Q.pauseAutoplay()), j = !1, Q.params.grabCursor && (Q.container[0].style.cursor = "move", Q.container[0].style.cursor = "-webkit-grabbing", Q.container[0].style.cursor = "-moz-grabbin", Q.container[0].style.cursor = "grabbing")), aq = !0; var k = Q.touches.diff = Q.isHorizontal() ? Q.touches.currentX - Q.touches.startX : Q.touches.currentY - Q.touches.startY;
                                    k *= Q.params.touchRatio, Q.rtl && (k = -k), Q.swipeDirection = k > 0 ? "prev" : "next", ao = k + au; var l = !0; if (k > 0 && ao > Q.minTranslate() ? (l = !1, Q.params.resistance && (ao = Q.minTranslate() - 1 + Math.pow(-Q.minTranslate() + au + k, Q.params.resistanceRatio))) : 0 > k && ao < Q.maxTranslate() && (l = !1, Q.params.resistance && (ao = Q.maxTranslate() + 1 - Math.pow(Q.maxTranslate() - au - k, Q.params.resistanceRatio))), l && (n.preventedByNestedSwiper = !0), !Q.params.allowSwipeToNext && "next" === Q.swipeDirection && au > ao && (ao = au), !Q.params.allowSwipeToPrev && "prev" === Q.swipeDirection && ao > au && (ao = au), Q.params.followFinger) { if (Q.params.threshold > 0) { if (!(Math.abs(k) > Q.params.threshold || ad)) { return void(ao = au) } if (!ad) { return ad = !0, Q.touches.startX = Q.touches.currentX, Q.touches.startY = Q.touches.currentY, ao = au, void(Q.touches.diff = Q.isHorizontal() ? Q.touches.currentX - Q.touches.startX : Q.touches.currentY - Q.touches.startY) } }(Q.params.freeMode || Q.params.watchSlidesProgress) && Q.updateActiveIndex(), Q.params.freeMode && (0 === at.length && at.push({ position: Q.touches[Q.isHorizontal() ? "startX" : "startY"], time: U }), at.push({ position: Q.touches[Q.isHorizontal() ? "currentX" : "currentY"], time: (new window.Date).getTime() })), Q.updateProgress(ao), Q.setWrapperTranslate(ao) } } } } } }, Q.onTouchEnd = function(S) { if (S.originalEvent && (S = S.originalEvent), q && Q.emit("onTouchEnd", Q, S), q = !1, ar) { Q.params.grabCursor && aq && ar && (Q.container[0].style.cursor = "move", Q.container[0].style.cursor = "-webkit-grab", Q.container[0].style.cursor = "-moz-grab", Q.container[0].style.cursor = "grab"); var B = Date.now(),
                            A = B - U; if (Q.allowClick && (Q.updateClickedSlide(S), Q.emit("onTap", Q, S), 300 > A && B - av > 300 && (F && clearTimeout(F), F = setTimeout(function() { Q && (Q.params.paginationHide && Q.paginationContainer.length > 0 && !d(S.target).hasClass(Q.params.bulletClass) && Q.paginationContainer.toggleClass(Q.params.paginationHiddenClass), Q.emit("onClick", Q, S)) }, 300)), 300 > A && 300 > B - av && (F && clearTimeout(F), Q.emit("onDoubleTap", Q, S))), av = Date.now(), setTimeout(function() { Q && (Q.allowClick = !0) }, 0), !ar || !aq || !Q.swipeDirection || 0 === Q.touches.diff || ao === au) { return void(ar = aq = !1) } ar = aq = !1; var z; if (z = Q.params.followFinger ? Q.rtl ? Q.translate : -Q.translate : -ao, Q.params.freeMode) { if (z < -Q.minTranslate()) { return void Q.slideTo(Q.activeIndex) } if (z > -Q.maxTranslate()) { return void(Q.slides.length < Q.snapGrid.length ? Q.slideTo(Q.snapGrid.length - 1) : Q.slideTo(Q.slides.length - 1)) } if (Q.params.freeModeMomentum) { if (at.length > 1) { var H = at.pop(),
                                        M = at.pop(),
                                        N = H.position - M.position,
                                        I = H.time - M.time;
                                    Q.velocity = N / I, Q.velocity = Q.velocity / 2, Math.abs(Q.velocity) < Q.params.freeModeMinimumVelocity && (Q.velocity = 0), (I > 150 || (new window.Date).getTime() - H.time > 300) && (Q.velocity = 0) } else { Q.velocity = 0 } at.length = 0; var y = 1000 * Q.params.freeModeMomentumRatio,
                                    R = Q.velocity * y,
                                    C = Q.translate + R;
                                Q.rtl && (C = -C); var P, L = !1,
                                    T = 20 * Math.abs(Q.velocity) * Q.params.freeModeMomentumBounceRatio; if (C < Q.maxTranslate()) { Q.params.freeModeMomentumBounce ? (C + Q.maxTranslate() < -T && (C = Q.maxTranslate() - T), P = Q.maxTranslate(), L = !0, j = !0) : C = Q.maxTranslate() } else { if (C > Q.minTranslate()) { Q.params.freeModeMomentumBounce ? (C - Q.minTranslate() > T && (C = Q.minTranslate() + T), P = Q.minTranslate(), L = !0, j = !0) : C = Q.minTranslate() } else { if (Q.params.freeModeSticky) { var az, G = 0; for (G = 0; G < Q.snapGrid.length; G += 1) { if (Q.snapGrid[G] > -C) { az = G; break } } C = Math.abs(Q.snapGrid[az] - C) < Math.abs(Q.snapGrid[az - 1] - C) || "next" === Q.swipeDirection ? Q.snapGrid[az] : Q.snapGrid[az - 1], Q.rtl || (C = -C) } } } if (0 !== Q.velocity) { y = Q.rtl ? Math.abs((-C - Q.translate) / Q.velocity) : Math.abs((C - Q.translate) / Q.velocity) } else { if (Q.params.freeModeSticky) { return void Q.slideReset() } } Q.params.freeModeMomentumBounce && L ? (Q.updateProgress(P), Q.setWrapperTransition(y), Q.setWrapperTranslate(C), Q.onTransitionStart(), Q.animating = !0, Q.wrapper.transitionEnd(function() { Q && j && (Q.emit("onMomentumBounce", Q), Q.setWrapperTransition(Q.params.speed), Q.setWrapperTranslate(P), Q.wrapper.transitionEnd(function() { Q && Q.onTransitionEnd() })) })) : Q.velocity ? (Q.updateProgress(C), Q.setWrapperTransition(y), Q.setWrapperTranslate(C), Q.onTransitionStart(), Q.animating || (Q.animating = !0, Q.wrapper.transitionEnd(function() { Q && Q.onTransitionEnd() }))) : Q.updateProgress(C), Q.updateActiveIndex() } return void((!Q.params.freeModeMomentum || A >= Q.params.longSwipesMs) && (Q.updateProgress(), Q.updateActiveIndex())) } var D, E = 0,
                            O = Q.slidesSizesGrid[0]; for (D = 0; D < Q.slidesGrid.length; D += Q.params.slidesPerGroup) { "undefined" != typeof Q.slidesGrid[D + Q.params.slidesPerGroup] ? z >= Q.slidesGrid[D] && z < Q.slidesGrid[D + Q.params.slidesPerGroup] && (E = D, O = Q.slidesGrid[D + Q.params.slidesPerGroup] - Q.slidesGrid[D]) : z >= Q.slidesGrid[D] && (E = D, O = Q.slidesGrid[Q.slidesGrid.length - 1] - Q.slidesGrid[Q.slidesGrid.length - 2]) } var k = (z - Q.slidesGrid[E]) / O; if (A > Q.params.longSwipesMs) { if (!Q.params.longSwipes) { return void Q.slideTo(Q.activeIndex) } "next" === Q.swipeDirection && (k >= Q.params.longSwipesRatio ? Q.slideTo(E + Q.params.slidesPerGroup) : Q.slideTo(E)), "prev" === Q.swipeDirection && (k > 1 - Q.params.longSwipesRatio ? Q.slideTo(E + Q.params.slidesPerGroup) : Q.slideTo(E)) } else { if (!Q.params.shortSwipes) { return void Q.slideTo(Q.activeIndex) } "next" === Q.swipeDirection && Q.slideTo(E + Q.params.slidesPerGroup), "prev" === Q.swipeDirection && Q.slideTo(E) } } }, Q._slideTo = function(k, i) { return Q.slideTo(k, i, !0, !0) }, Q.slideTo = function(p, m, k, o) { "undefined" == typeof k && (k = !0), "undefined" == typeof p && (p = 0), 0 > p && (p = 0), Q.snapIndex = Math.floor(p / Q.params.slidesPerGroup), Q.snapIndex >= Q.snapGrid.length && (Q.snapIndex = Q.snapGrid.length - 1); var n = -Q.snapGrid[Q.snapIndex];
                    Q.params.autoplay && Q.autoplaying && (o || !Q.params.autoplayDisableOnInteraction ? Q.pauseAutoplay(m) : Q.stopAutoplay()), Q.updateProgress(n); for (var l = 0; l < Q.slidesGrid.length; l++) {-Math.floor(100 * n) >= Math.floor(100 * Q.slidesGrid[l]) && (p = l) } return !Q.params.allowSwipeToNext && n < Q.translate && n < Q.minTranslate() ? !1 : !Q.params.allowSwipeToPrev && n > Q.translate && n > Q.maxTranslate() && (Q.activeIndex || 0) !== p ? !1 : ("undefined" == typeof m && (m = Q.params.speed), Q.previousIndex = Q.activeIndex || 0, Q.activeIndex = p, Q.rtl && -n === Q.translate || !Q.rtl && n === Q.translate ? (Q.params.autoHeight && Q.updateAutoHeight(), Q.updateClasses(), "slide" !== Q.params.effect && Q.setWrapperTranslate(n), !1) : (Q.updateClasses(), Q.onTransitionStart(k), 0 === m ? (Q.setWrapperTranslate(n), Q.setWrapperTransition(0), Q.onTransitionEnd(k)) : (Q.setWrapperTranslate(n), Q.setWrapperTransition(m), Q.animating || (Q.animating = !0, Q.wrapper.transitionEnd(function() { Q && Q.onTransitionEnd(k) }))), !0)) }, Q.onTransitionStart = function(i) { "undefined" == typeof i && (i = !0), Q.params.autoHeight && Q.updateAutoHeight(), Q.lazy && Q.lazy.onTransitionStart(), i && (Q.emit("onTransitionStart", Q), Q.activeIndex !== Q.previousIndex && (Q.emit("onSlideChangeStart", Q), Q.activeIndex > Q.previousIndex ? Q.emit("onSlideNextStart", Q) : Q.emit("onSlidePrevStart", Q))) }, Q.onTransitionEnd = function(i) { Q.animating = !1, Q.setWrapperTransition(0), "undefined" == typeof i && (i = !0), Q.lazy && Q.lazy.onTransitionEnd(), i && (Q.emit("onTransitionEnd", Q), Q.activeIndex !== Q.previousIndex && (Q.emit("onSlideChangeEnd", Q), Q.activeIndex > Q.previousIndex ? Q.emit("onSlideNextEnd", Q) : Q.emit("onSlidePrevEnd", Q))), Q.params.hashnav && Q.hashnav && Q.hashnav.setHash() }, Q.slideNext = function(l, i, k) { if (Q.params.loop) { if (Q.animating) { return !1 } Q.fixLoop();
                        Q.container[0].clientLeft; return Q.slideTo(Q.activeIndex + Q.params.slidesPerGroup, i, l, k) } return Q.slideTo(Q.activeIndex + Q.params.slidesPerGroup, i, l, k) }, Q._slideNext = function(i) { return Q.slideNext(!0, i, !0) }, Q.slidePrev = function(l, i, k) { if (Q.params.loop) { if (Q.animating) { return !1 } Q.fixLoop();
                        Q.container[0].clientLeft; return Q.slideTo(Q.activeIndex - 1, i, l, k) } return Q.slideTo(Q.activeIndex - 1, i, l, k) }, Q._slidePrev = function(i) { return Q.slidePrev(!0, i, !0) }, Q.slideReset = function(l, i, k) { return Q.slideTo(Q.activeIndex, i, l) }, Q.setWrapperTransition = function(k, i) { Q.wrapper.transition(k), "slide" !== Q.params.effect && Q.effects[Q.params.effect] && Q.effects[Q.params.effect].setTransition(k), Q.params.parallax && Q.parallax && Q.parallax.setTransition(k), Q.params.scrollbar && Q.scrollbar && Q.scrollbar.setTransition(k), Q.params.control && Q.controller && Q.controller.setTransition(k, i), Q.emit("onSetTransition", Q, k) }, Q.setWrapperTranslate = function(x, v, k) { var w = 0,
                        m = 0,
                        r = 0;
                    Q.isHorizontal() ? w = Q.rtl ? -x : x : m = x, Q.params.roundLengths && (w = W(w), m = W(m)), Q.params.virtualTranslate || (Q.support.transforms3d ? Q.wrapper.transform("translate3d(" + w + "px, " + m + "px, " + r + "px)") : Q.wrapper.transform("translate(" + w + "px, " + m + "px)")), Q.translate = Q.isHorizontal() ? w : m; var u, p = Q.maxTranslate() - Q.minTranslate();
                    u = 0 === p ? 0 : (x - Q.minTranslate()) / p, u !== Q.progress && Q.updateProgress(x), v && Q.updateActiveIndex(), "slide" !== Q.params.effect && Q.effects[Q.params.effect] && Q.effects[Q.params.effect].setTranslate(Q.translate), Q.params.parallax && Q.parallax && Q.parallax.setTranslate(Q.translate), Q.params.scrollbar && Q.scrollbar && Q.scrollbar.setTranslate(Q.translate), Q.params.control && Q.controller && Q.controller.setTranslate(Q.translate, k), Q.emit("onSetTranslate", Q, Q.translate) }, Q.getTranslate = function(p, m) { var k, o, n, l; return "undefined" == typeof m && (m = "x"), Q.params.virtualTranslate ? Q.rtl ? -Q.translate : Q.translate : (n = window.getComputedStyle(p, null), window.WebKitCSSMatrix ? (o = n.transform || n.webkitTransform, o.split(",").length > 6 && (o = o.split(", ").map(function(i) { return i.replace(",", ".") }).join(", ")), l = new window.WebKitCSSMatrix("none" === o ? "" : o)) : (l = n.MozTransform || n.OTransform || n.MsTransform || n.msTransform || n.transform || n.getPropertyValue("transform").replace("translate(", "matrix(1, 0, 0, 1,"), k = l.toString().split(",")), "x" === m && (o = window.WebKitCSSMatrix ? l.m41 : 16 === k.length ? parseFloat(k[12]) : parseFloat(k[4])), "y" === m && (o = window.WebKitCSSMatrix ? l.m42 : 16 === k.length ? parseFloat(k[13]) : parseFloat(k[5])), Q.rtl && o && (o = -o), o || 0) }, Q.getWrapperTranslate = function(i) { return "undefined" == typeof i && (i = Q.isHorizontal() ? "x" : "y"), Q.getTranslate(Q.wrapper[0], i) }, Q.observers = [], Q.initObservers = function() { if (Q.params.observeParents) { for (var k = Q.container.parents(), i = 0; i < k.length; i++) { ah(k[i]) } } ah(Q.container[0], { childList: !1 }), ah(Q.wrapper[0], { attributes: !1 }) }, Q.disconnectObservers = function() { for (var i = 0; i < Q.observers.length; i++) { Q.observers[i].disconnect() } Q.observers = [] }, Q.createLoop = function() { Q.wrapper.children("." + Q.params.slideClass + "." + Q.params.slideDuplicateClass).remove(); var m = Q.wrapper.children("." + Q.params.slideClass); "auto" !== Q.params.slidesPerView || Q.params.loopedSlides || (Q.params.loopedSlides = m.length), Q.loopedSlides = parseInt(Q.params.loopedSlides || Q.params.slidesPerView, 10), Q.loopedSlides = Q.loopedSlides + Q.params.loopAdditionalSlides, Q.loopedSlides > m.length && (Q.loopedSlides = m.length); var l, k = [],
                        i = []; for (m.each(function(o, e) { var p = d(this);
                            o < Q.loopedSlides && i.push(e), o < m.length && o >= m.length - Q.loopedSlides && k.push(e), p.attr("data-swiper-slide-index", o) }), l = 0; l < i.length; l++) { Q.wrapper.append(d(i[l].cloneNode(!0)).addClass(Q.params.slideDuplicateClass)) } for (l = k.length - 1; l >= 0; l--) { Q.wrapper.prepend(d(k[l].cloneNode(!0)).addClass(Q.params.slideDuplicateClass)) } }, Q.destroyLoop = function() { Q.wrapper.children("." + Q.params.slideClass + "." + Q.params.slideDuplicateClass).remove(), Q.slides.removeAttr("data-swiper-slide-index") }, Q.reLoop = function(k) { var i = Q.activeIndex - Q.loopedSlides;
                    Q.destroyLoop(), Q.createLoop(), Q.updateSlidesSize(), k && Q.slideTo(i + Q.loopedSlides, 0, !1) }, Q.fixLoop = function() { var i;
                    Q.activeIndex < Q.loopedSlides ? (i = Q.slides.length - 3 * Q.loopedSlides + Q.activeIndex, i += Q.loopedSlides, Q.slideTo(i, 0, !1, !0)) : ("auto" === Q.params.slidesPerView && Q.activeIndex >= 2 * Q.loopedSlides || Q.activeIndex > Q.slides.length - 2 * Q.params.slidesPerView) && (i = -Q.slides.length + Q.activeIndex + Q.loopedSlides, i += Q.loopedSlides, Q.slideTo(i, 0, !1, !0)) }, Q.appendSlide = function(k) { if (Q.params.loop && Q.destroyLoop(), "object" == typeof k && k.length) { for (var i = 0; i < k.length; i++) { k[i] && Q.wrapper.append(k[i]) } } else { Q.wrapper.append(k) } Q.params.loop && Q.createLoop(), Q.params.observer && Q.support.observer || Q.update(!0) }, Q.prependSlide = function(l) { Q.params.loop && Q.destroyLoop(); var i = Q.activeIndex + 1; if ("object" == typeof l && l.length) { for (var k = 0; k < l.length; k++) { l[k] && Q.wrapper.prepend(l[k]) } i = Q.activeIndex + l.length } else { Q.wrapper.prepend(l) } Q.params.loop && Q.createLoop(), Q.params.observer && Q.support.observer || Q.update(!0), Q.slideTo(i, 0, !1) }, Q.removeSlide = function(m) { Q.params.loop && (Q.destroyLoop(), Q.slides = Q.wrapper.children("." + Q.params.slideClass)); var i, k = Q.activeIndex; if ("object" == typeof m && m.length) { for (var l = 0; l < m.length; l++) { i = m[l], Q.slides[i] && Q.slides.eq(i).remove(), k > i && k-- } k = Math.max(k, 0) } else { i = m, Q.slides[i] && Q.slides.eq(i).remove(), k > i && k--, k = Math.max(k, 0) } Q.params.loop && Q.createLoop(), Q.params.observer && Q.support.observer || Q.update(!0), Q.params.loop ? Q.slideTo(k + Q.loopedSlides, 0, !1) : Q.slideTo(k, 0, !1) }, Q.removeAllSlides = function() { for (var k = [], i = 0; i < Q.slides.length; i++) { k.push(i) } Q.removeSlide(k) }, Q.effects = { fade: { setTranslate: function() { for (var p = 0; p < Q.slides.length; p++) { var m = Q.slides.eq(p),
                                    k = m[0].swiperSlideOffset,
                                    o = -k;
                                Q.params.virtualTranslate || (o -= Q.translate); var n = 0;
                                Q.isHorizontal() || (n = o, o = 0); var l = Q.params.fade.crossFade ? Math.max(1 - Math.abs(m[0].progress), 0) : 1 + Math.min(Math.max(m[0].progress, -1), 0);
                                m.css({ opacity: l }).transform("translate3d(" + o + "px, " + n + "px, 0px)") } }, setTransition: function(k) { if (Q.slides.transition(k), Q.params.virtualTranslate && 0 !== k) { var i = !1;
                                Q.slides.transitionEnd(function() { if (!i && Q) { i = !0, Q.animating = !1; for (var l = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], m = 0; m < l.length; m++) { Q.wrapper.trigger(l[m]) } } }) } } }, flip: { setTranslate: function() { for (var B = 0; B < Q.slides.length; B++) { var k = Q.slides.eq(B),
                                    A = k[0].progress;
                                Q.params.flip.limitRotation && (A = Math.max(Math.min(k[0].progress, 1), -1)); var z = k[0].swiperSlideOffset,
                                    m = -180 * A,
                                    w = m,
                                    x = 0,
                                    v = -z,
                                    y = 0; if (Q.isHorizontal() ? Q.rtl && (w = -w) : (y = v, v = 0, x = -w, w = 0), k[0].style.zIndex = -Math.abs(Math.round(A)) + Q.slides.length, Q.params.flip.slideShadows) { var D = Q.isHorizontal() ? k.find(".swiper-slide-shadow-left") : k.find(".swiper-slide-shadow-top"),
                                        C = Q.isHorizontal() ? k.find(".swiper-slide-shadow-right") : k.find(".swiper-slide-shadow-bottom");
                                    0 === D.length && (D = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "left" : "top") + '"></div>'), k.append(D)), 0 === C.length && (C = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "right" : "bottom") + '"></div>'), k.append(C)), D.length && (D[0].style.opacity = Math.max(-A, 0)), C.length && (C[0].style.opacity = Math.max(A, 0)) } k.transform("translate3d(" + v + "px, " + y + "px, 0px) rotateX(" + x + "deg) rotateY(" + w + "deg)") } }, setTransition: function(i) { if (Q.slides.transition(i).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(i), Q.params.virtualTranslate && 0 !== i) { var k = !1;
                                Q.slides.eq(Q.activeIndex).transitionEnd(function() { if (!k && Q && d(this).hasClass(Q.params.slideActiveClass)) { k = !0, Q.animating = !1; for (var l = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"], m = 0; m < l.length; m++) { Q.wrapper.trigger(l[m]) } } }) } } }, cube: { setTranslate: function() { var P, z = 0;
                            Q.params.cube.shadow && (Q.isHorizontal() ? (P = Q.wrapper.find(".swiper-cube-shadow"), 0 === P.length && (P = d('<div class="swiper-cube-shadow"></div>'), Q.wrapper.append(P)), P.css({ height: Q.width + "px" })) : (P = Q.container.find(".swiper-cube-shadow"), 0 === P.length && (P = d('<div class="swiper-cube-shadow"></div>'), Q.container.append(P)))); for (var y = 0; y < Q.slides.length; y++) { var x = Q.slides.eq(y),
                                    E = 90 * y,
                                    I = Math.floor(E / 360);
                                Q.rtl && (E = -E, I = Math.floor(-E / 360)); var L = Math.max(Math.min(x[0].progress, 1), -1),
                                    G = 0,
                                    k = 0,
                                    O = 0;
                                y % 4 === 0 ? (G = 4 * -I * Q.size, O = 0) : (y - 1) % 4 === 0 ? (G = 0, O = 4 * -I * Q.size) : (y - 2) % 4 === 0 ? (G = Q.size + 4 * I * Q.size, O = Q.size) : (y - 3) % 4 === 0 && (G = -Q.size, O = 3 * Q.size + 4 * Q.size * I), Q.rtl && (G = -G), Q.isHorizontal() || (k = G, G = 0); var A = "rotateX(" + (Q.isHorizontal() ? 0 : -E) + "deg) rotateY(" + (Q.isHorizontal() ? E : 0) + "deg) translate3d(" + G + "px, " + k + "px, " + O + "px)"; if (1 >= L && L > -1 && (z = 90 * y + 90 * L, Q.rtl && (z = 90 * -y - 90 * L)), x.transform(A), Q.params.cube.slideShadows) { var N = Q.isHorizontal() ? x.find(".swiper-slide-shadow-left") : x.find(".swiper-slide-shadow-top"),
                                        H = Q.isHorizontal() ? x.find(".swiper-slide-shadow-right") : x.find(".swiper-slide-shadow-bottom");
                                    0 === N.length && (N = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "left" : "top") + '"></div>'), x.append(N)), 0 === H.length && (H = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "right" : "bottom") + '"></div>'), x.append(H)), N.length && (N[0].style.opacity = Math.max(-L, 0)), H.length && (H[0].style.opacity = Math.max(L, 0)) } } if (Q.wrapper.css({ "-webkit-transform-origin": "50% 50% -" + Q.size / 2 + "px", "-moz-transform-origin": "50% 50% -" + Q.size / 2 + "px", "-ms-transform-origin": "50% 50% -" + Q.size / 2 + "px", "transform-origin": "50% 50% -" + Q.size / 2 + "px" }), Q.params.cube.shadow) { if (Q.isHorizontal()) { P.transform("translate3d(0px, " + (Q.width / 2 + Q.params.cube.shadowOffset) + "px, " + -Q.width / 2 + "px) rotateX(90deg) rotateZ(0deg) scale(" + Q.params.cube.shadowScale + ")") } else { var R = Math.abs(z) - 90 * Math.floor(Math.abs(z) / 90),
                                        S = 1.5 - (Math.sin(2 * R * Math.PI / 360) / 2 + Math.cos(2 * R * Math.PI / 360) / 2),
                                        D = Q.params.cube.shadowScale,
                                        B = Q.params.cube.shadowScale / S,
                                        C = Q.params.cube.shadowOffset;
                                    P.transform("scale3d(" + D + ", 1, " + B + ") translate3d(0px, " + (Q.height / 2 + C) + "px, " + -Q.height / 2 / B + "px) rotateX(-90deg)") } } var M = Q.isSafari || Q.isUiWebView ? -Q.size / 2 : 0;
                            Q.wrapper.transform("translate3d(0px,0," + M + "px) rotateX(" + (Q.isHorizontal() ? 0 : z) + "deg) rotateY(" + (Q.isHorizontal() ? -z : 0) + "deg)") }, setTransition: function(i) { Q.slides.transition(i).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(i), Q.params.cube.shadow && !Q.isHorizontal() && Q.container.find(".swiper-cube-shadow").transition(i) } }, coverflow: { setTranslate: function() { for (var P = Q.translate, z = Q.isHorizontal() ? -P + Q.width / 2 : -P + Q.height / 2, y = Q.isHorizontal() ? Q.params.coverflow.rotate : -Q.params.coverflow.rotate, x = Q.params.coverflow.depth, E = 0, I = Q.slides.length; I > E; E++) { var L = Q.slides.eq(E),
                                    G = Q.slidesSizesGrid[E],
                                    k = L[0].swiperSlideOffset,
                                    O = (z - k - G / 2) / G * Q.params.coverflow.modifier,
                                    A = Q.isHorizontal() ? y * O : 0,
                                    N = Q.isHorizontal() ? 0 : y * O,
                                    H = -x * Math.abs(O),
                                    R = Q.isHorizontal() ? 0 : Q.params.coverflow.stretch * O,
                                    S = Q.isHorizontal() ? Q.params.coverflow.stretch * O : 0;
                                Math.abs(S) < 0.001 && (S = 0), Math.abs(R) < 0.001 && (R = 0), Math.abs(H) < 0.001 && (H = 0), Math.abs(A) < 0.001 && (A = 0), Math.abs(N) < 0.001 && (N = 0); var D = "translate3d(" + S + "px," + R + "px," + H + "px)  rotateX(" + N + "deg) rotateY(" + A + "deg)"; if (L.transform(D), L[0].style.zIndex = -Math.abs(Math.round(O)) + 1, Q.params.coverflow.slideShadows) { var B = Q.isHorizontal() ? L.find(".swiper-slide-shadow-left") : L.find(".swiper-slide-shadow-top"),
                                        C = Q.isHorizontal() ? L.find(".swiper-slide-shadow-right") : L.find(".swiper-slide-shadow-bottom");
                                    0 === B.length && (B = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "left" : "top") + '"></div>'), L.append(B)), 0 === C.length && (C = d('<div class="swiper-slide-shadow-' + (Q.isHorizontal() ? "right" : "bottom") + '"></div>'), L.append(C)), B.length && (B[0].style.opacity = O > 0 ? O : 0), C.length && (C[0].style.opacity = -O > 0 ? -O : 0) } } if (Q.browser.ie) { var M = Q.wrapper[0].style;
                                M.perspectiveOrigin = z + "px 50%" } }, setTransition: function(i) { Q.slides.transition(i).find(".swiper-slide-shadow-top, .swiper-slide-shadow-right, .swiper-slide-shadow-bottom, .swiper-slide-shadow-left").transition(i) } } }, Q.lazy = { initialImageLoaded: !1, loadImageInSlide: function(m, l) { if ("undefined" != typeof m && ("undefined" == typeof l && (l = !0), 0 !== Q.slides.length)) { var k = Q.slides.eq(m),
                                i = k.find(".swiper-lazy:not(.swiper-lazy-loaded):not(.swiper-lazy-loading)");!k.hasClass("swiper-lazy") || k.hasClass("swiper-lazy-loaded") || k.hasClass("swiper-lazy-loading") || (i = i.add(k[0])), 0 !== i.length && i.each(function() { var u = d(this);
                                u.addClass("swiper-lazy-loading"); var o = u.attr("data-background"),
                                    p = u.attr("data-src"),
                                    s = u.attr("data-srcset");
                                Q.loadImage(u[0], p || o, s, !1, function() { if (o ? (u.css("background-image", 'url("' + o + '")'), u.removeAttr("data-background")) : (s && (u.attr("srcset", s), u.removeAttr("data-srcset")), p && (u.attr("src", p), u.removeAttr("data-src"))), u.addClass("swiper-lazy-loaded").removeClass("swiper-lazy-loading"), k.find(".swiper-lazy-preloader, .preloader").remove(), Q.params.loop && l) { var n = k.attr("data-swiper-slide-index"); if (k.hasClass(Q.params.slideDuplicateClass)) { var e = Q.wrapper.children('[data-swiper-slide-index="' + n + '"]:not(.' + Q.params.slideDuplicateClass + ")");
                                            Q.lazy.loadImageInSlide(e.index(), !1) } else { var r = Q.wrapper.children("." + Q.params.slideDuplicateClass + '[data-swiper-slide-index="' + n + '"]');
                                            Q.lazy.loadImageInSlide(r.index(), !1) } } Q.emit("onLazyImageReady", Q, k[0], u[0]) }), Q.emit("onLazyImageLoad", Q, k[0], u[0]) }) } }, load: function() { var w; if (Q.params.watchSlidesVisibility) { Q.wrapper.children("." + Q.params.slideVisibleClass).each(function() { Q.lazy.loadImageInSlide(d(this).index()) }) } else { if (Q.params.slidesPerView > 1) { for (w = Q.activeIndex; w < Q.activeIndex + Q.params.slidesPerView; w++) { Q.slides[w] && Q.lazy.loadImageInSlide(w) } } else { Q.lazy.loadImageInSlide(Q.activeIndex) } } if (Q.params.lazyLoadingInPrevNext) { if (Q.params.slidesPerView > 1 || Q.params.lazyLoadingInPrevNextAmount && Q.params.lazyLoadingInPrevNextAmount > 1) { var k = Q.params.lazyLoadingInPrevNextAmount,
                                    v = Q.params.slidesPerView,
                                    u = Math.min(Q.activeIndex + v + Math.max(k, v), Q.slides.length),
                                    l = Math.max(Q.activeIndex - Math.max(v, k), 0); for (w = Q.activeIndex + Q.params.slidesPerView; u > w; w++) { Q.slides[w] && Q.lazy.loadImageInSlide(w) } for (w = l; w < Q.activeIndex; w++) { Q.slides[w] && Q.lazy.loadImageInSlide(w) } } else { var m = Q.wrapper.children("." + Q.params.slideNextClass);
                                m.length > 0 && Q.lazy.loadImageInSlide(m.index()); var p = Q.wrapper.children("." + Q.params.slidePrevClass);
                                p.length > 0 && Q.lazy.loadImageInSlide(p.index()) } } }, onTransitionStart: function() { Q.params.lazyLoading && (Q.params.lazyLoadingOnTransitionStart || !Q.params.lazyLoadingOnTransitionStart && !Q.lazy.initialImageLoaded) && Q.lazy.load() }, onTransitionEnd: function() { Q.params.lazyLoading && !Q.params.lazyLoadingOnTransitionStart && Q.lazy.load() } }, Q.scrollbar = { isTouched: !1, setDragPosition: function(p) { var m = Q.scrollbar,
                            k = Q.isHorizontal() ? "touchstart" === p.type || "touchmove" === p.type ? p.targetTouches[0].pageX : p.pageX || p.clientX : "touchstart" === p.type || "touchmove" === p.type ? p.targetTouches[0].pageY : p.pageY || p.clientY,
                            o = k - m.track.offset()[Q.isHorizontal() ? "left" : "top"] - m.dragSize / 2,
                            n = -Q.minTranslate() * m.moveDivider,
                            l = -Q.maxTranslate() * m.moveDivider;
                        n > o ? o = n : o > l && (o = l), o = -o / m.moveDivider, Q.updateProgress(o), Q.setWrapperTranslate(o, !0) }, dragStart: function(k) { var i = Q.scrollbar;
                        i.isTouched = !0, k.preventDefault(), k.stopPropagation(), i.setDragPosition(k), clearTimeout(i.dragTimeout), i.track.transition(0), Q.params.scrollbarHide && i.track.css("opacity", 1), Q.wrapper.transition(100), i.drag.transition(100), Q.emit("onScrollbarDragStart", Q) }, dragMove: function(k) { var i = Q.scrollbar;
                        i.isTouched && (k.preventDefault ? k.preventDefault() : k.returnValue = !1, i.setDragPosition(k), Q.wrapper.transition(0), i.track.transition(0), i.drag.transition(0), Q.emit("onScrollbarDragMove", Q)) }, dragEnd: function(k) { var i = Q.scrollbar;
                        i.isTouched && (i.isTouched = !1, Q.params.scrollbarHide && (clearTimeout(i.dragTimeout), i.dragTimeout = setTimeout(function() { i.track.css("opacity", 0), i.track.transition(400) }, 1000)), Q.emit("onScrollbarDragEnd", Q), Q.params.scrollbarSnapOnRelease && Q.slideReset()) }, enableDraggable: function() { var i = Q.scrollbar,
                            k = Q.support.touch ? i.track : document;
                        d(i.track).on(Q.touchEvents.start, i.dragStart), d(k).on(Q.touchEvents.move, i.dragMove), d(k).on(Q.touchEvents.end, i.dragEnd) }, disableDraggable: function() { var i = Q.scrollbar,
                            k = Q.support.touch ? i.track : document;
                        d(i.track).off(Q.touchEvents.start, i.dragStart), d(k).off(Q.touchEvents.move, i.dragMove), d(k).off(Q.touchEvents.end, i.dragEnd) }, set: function() { if (Q.params.scrollbar) { var i = Q.scrollbar;
                            i.track = d(Q.params.scrollbar), Q.params.uniqueNavElements && "string" == typeof Q.params.scrollbar && i.track.length > 1 && 1 === Q.container.find(Q.params.scrollbar).length && (i.track = Q.container.find(Q.params.scrollbar)), i.drag = i.track.find(".swiper-scrollbar-drag"), 0 === i.drag.length && (i.drag = d('<div class="swiper-scrollbar-drag"></div>'), i.track.append(i.drag)), i.drag[0].style.width = "", i.drag[0].style.height = "", i.trackSize = Q.isHorizontal() ? i.track[0].offsetWidth : i.track[0].offsetHeight, i.divider = Q.size / Q.virtualSize, i.moveDivider = i.divider * (i.trackSize / Q.size), i.dragSize = i.trackSize * i.divider, Q.isHorizontal() ? i.drag[0].style.width = i.dragSize + "px" : i.drag[0].style.height = i.dragSize + "px", i.divider >= 1 ? i.track[0].style.display = "none" : i.track[0].style.display = "", Q.params.scrollbarHide && (i.track[0].style.opacity = 0) } }, setTranslate: function() { if (Q.params.scrollbar) { var l, i = Q.scrollbar,
                                k = (Q.translate || 0, i.dragSize);
                            l = (i.trackSize - i.dragSize) * Q.progress, Q.rtl && Q.isHorizontal() ? (l = -l, l > 0 ? (k = i.dragSize - l, l = 0) : -l + i.dragSize > i.trackSize && (k = i.trackSize + l)) : 0 > l ? (k = i.dragSize + l, l = 0) : l + i.dragSize > i.trackSize && (k = i.trackSize - l), Q.isHorizontal() ? (Q.support.transforms3d ? i.drag.transform("translate3d(" + l + "px, 0, 0)") : i.drag.transform("translateX(" + l + "px)"), i.drag[0].style.width = k + "px") : (Q.support.transforms3d ? i.drag.transform("translate3d(0px, " + l + "px, 0)") : i.drag.transform("translateY(" + l + "px)"), i.drag[0].style.height = k + "px"), Q.params.scrollbarHide && (clearTimeout(i.timeout), i.track[0].style.opacity = 1, i.timeout = setTimeout(function() { i.track[0].style.opacity = 0, i.track.transition(400) }, 1000)) } }, setTransition: function(i) { Q.params.scrollbar && Q.scrollbar.drag.transition(i) } }, Q.controller = { LinearSpline: function(n, k) { this.x = n, this.y = k, this.lastIndex = n.length - 1; var l, m;
                        this.x.length;
                        this.interpolate = function(o) { return o ? (m = i(this.x, o), l = m - 1, (o - this.x[l]) * (this.y[m] - this.y[l]) / (this.x[m] - this.x[l]) + this.y[l]) : 0 }; var i = function() { var r, o, p; return function(u, e) { for (o = -1, r = u.length; r - o > 1;) { u[p = r + o >> 1] <= e ? o = p : r = p } return r } }() }, getInterpolateFunction: function(i) { Q.controller.spline || (Q.controller.spline = Q.params.loop ? new Q.controller.LinearSpline(Q.slidesGrid, i.slidesGrid) : new Q.controller.LinearSpline(Q.snapGrid, i.snapGrid)) }, setTranslate: function(w, p) {
                        function v(e) { w = e.rtl && "horizontal" === e.params.direction ? -Q.translate : Q.translate, "slide" === Q.params.controlBy && (Q.controller.getInterpolateFunction(e), k = -Q.controller.spline.interpolate(-w)), k && "container" !== Q.params.controlBy || (u = (e.maxTranslate() - e.minTranslate()) / (Q.maxTranslate() - Q.minTranslate()), k = (w - Q.minTranslate()) * u + e.minTranslate()), Q.params.controlInverse && (k = e.maxTranslate() - k), e.updateProgress(k), e.setWrapperTranslate(k, !1, Q), e.updateActiveIndex() } var u, k, l = Q.params.control; if (Q.isArray(l)) { for (var m = 0; m < l.length; m++) { l[m] !== p && l[m] instanceof b && v(l[m]) } } else { l instanceof b && p !== l && v(l) } }, setTransition: function(o, l) {
                        function m(e) { e.setWrapperTransition(o, Q), 0 !== o && (e.onTransitionStart(), e.wrapper.transitionEnd(function() { n && (e.params.loop && "slide" === Q.params.controlBy && e.fixLoop(), e.onTransitionEnd()) })) } var k, n = Q.params.control; if (Q.isArray(n)) { for (k = 0; k < n.length; k++) { n[k] !== l && n[k] instanceof b && m(n[k]) } } else { n instanceof b && l !== n && m(n) } } }, Q.hashnav = { init: function() { if (Q.params.hashnav) { Q.hashnav.initialized = !0; var v = document.location.hash.replace("#", ""); if (v) { for (var o = 0, k = 0, u = Q.slides.length; u > k; k++) { var p = Q.slides.eq(k),
                                        l = p.attr("data-hash"); if (l === v && !p.hasClass(Q.params.slideDuplicateClass)) { var m = p.index();
                                        Q.slideTo(m, o, Q.params.runCallbacksOnInit, !0) } } } } }, setHash: function() { Q.hashnav.initialized && Q.params.hashnav && (document.location.hash = Q.slides.eq(Q.activeIndex).attr("data-hash") || "") } }, Q.disableKeyboardControl = function() { Q.params.keyboardControl = !1, d(document).off("keydown", ae) }, Q.enableKeyboardControl = function() { Q.params.keyboardControl = !0, d(document).on("keydown", ae) }, Q.mousewheel = { event: !1, lastScrollTime: (new window.Date).getTime() }, Q.params.mousewheelControl) { try { new window.WheelEvent("wheel"), Q.mousewheel.event = "wheel" } catch (ay) {
                    (window.WheelEvent || Q.container[0] && "wheel" in Q.container[0]) && (Q.mousewheel.event = "wheel") }!Q.mousewheel.event && window.WheelEvent, Q.mousewheel.event || void 0 === document.onmousewheel || (Q.mousewheel.event = "mousewheel"), Q.mousewheel.event || (Q.mousewheel.event = "DOMMouseScroll") } Q.disableMousewheelControl = function() { return Q.mousewheel.event ? (Q.container.off(Q.mousewheel.event, V), !0) : !1 }, Q.enableMousewheelControl = function() { return Q.mousewheel.event ? (Q.container.on(Q.mousewheel.event, V), !0) : !1 }, Q.parallax = { setTranslate: function() { Q.container.children("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() { ak(this, Q.progress) }), Q.slides.each(function() { var i = d(this);
                        i.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() { var e = Math.min(Math.max(i[0].progress, -1), 1);
                            ak(this, e) }) }) }, setTransition: function(i) { "undefined" == typeof i && (i = Q.params.speed), Q.container.find("[data-swiper-parallax], [data-swiper-parallax-x], [data-swiper-parallax-y]").each(function() { var k = d(this),
                            e = parseInt(k.attr("data-swiper-parallax-duration"), 10) || i;
                        0 === i && (e = 0), k.transition(e) }) } }, Q._plugins = []; for (var ax in Q.plugins) { var ap = Q.plugins[ax](Q, Q.params[ax]);
                ap && Q._plugins.push(ap) } return Q.callPlugins = function(k) { for (var i = 0; i < Q._plugins.length; i++) { k in Q._plugins[i] && Q._plugins[i][k](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]) } }, Q.emitterEventListeners = {}, Q.emit = function(k) { Q.params[k] && Q.params[k](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]); var i; if (Q.emitterEventListeners[k]) { for (i = 0; i < Q.emitterEventListeners[k].length; i++) { Q.emitterEventListeners[k][i](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]) } } Q.callPlugins && Q.callPlugins(k, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]) }, Q.on = function(k, i) { return k = Y(k), Q.emitterEventListeners[k] || (Q.emitterEventListeners[k] = []), Q.emitterEventListeners[k].push(i), Q }, Q.off = function(l, i) { var k; if (l = Y(l), "undefined" == typeof i) { return Q.emitterEventListeners[l] = [], Q } if (Q.emitterEventListeners[l] && 0 !== Q.emitterEventListeners[l].length) { for (k = 0; k < Q.emitterEventListeners[l].length; k++) { Q.emitterEventListeners[l][k] === i && Q.emitterEventListeners[l].splice(k, 1) } return Q } }, Q.once = function(l, i) { l = Y(l); var k = function() { i(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]), Q.off(l, k) }; return Q.on(l, k), Q }, Q.a11y = { makeFocusable: function(i) { return i.attr("tabIndex", "0"), i }, addRole: function(k, i) { return k.attr("role", i), k }, addLabel: function(k, i) { return k.attr("aria-label", i), k }, disable: function(i) { return i.attr("aria-disabled", !0), i }, enable: function(i) { return i.attr("aria-disabled", !1), i }, onEnterKey: function(i) { 13 === i.keyCode && (d(i.target).is(Q.params.nextButton) ? (Q.onClickNext(i), Q.isEnd ? Q.a11y.notify(Q.params.lastSlideMessage) : Q.a11y.notify(Q.params.nextSlideMessage)) : d(i.target).is(Q.params.prevButton) && (Q.onClickPrev(i), Q.isBeginning ? Q.a11y.notify(Q.params.firstSlideMessage) : Q.a11y.notify(Q.params.prevSlideMessage)), d(i.target).is("." + Q.params.bulletClass) && d(i.target)[0].click()) }, liveRegion: d('<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>'), notify: function(k) { var i = Q.a11y.liveRegion;
                    0 !== i.length && (i.html(""), i.html(k)) }, init: function() { Q.params.nextButton && Q.nextButton && Q.nextButton.length > 0 && (Q.a11y.makeFocusable(Q.nextButton), Q.a11y.addRole(Q.nextButton, "button"), Q.a11y.addLabel(Q.nextButton, Q.params.nextSlideMessage)), Q.params.prevButton && Q.prevButton && Q.prevButton.length > 0 && (Q.a11y.makeFocusable(Q.prevButton), Q.a11y.addRole(Q.prevButton, "button"), Q.a11y.addLabel(Q.prevButton, Q.params.prevSlideMessage)), d(Q.container).append(Q.a11y.liveRegion) }, initPagination: function() { Q.params.pagination && Q.params.paginationClickable && Q.bullets && Q.bullets.length && Q.bullets.each(function() { var i = d(this);
                        Q.a11y.makeFocusable(i), Q.a11y.addRole(i, "button"), Q.a11y.addLabel(i, Q.params.paginationBulletMessage.replace(/{{index}}/, i.index() + 1)) }) }, destroy: function() { Q.a11y.liveRegion && Q.a11y.liveRegion.length > 0 && Q.a11y.liveRegion.remove() } }, Q.init = function() { Q.params.loop && Q.createLoop(), Q.updateContainerSize(), Q.updateSlidesSize(), Q.updatePagination(), Q.params.scrollbar && Q.scrollbar && (Q.scrollbar.set(), Q.params.scrollbarDraggable && Q.scrollbar.enableDraggable()), "slide" !== Q.params.effect && Q.effects[Q.params.effect] && (Q.params.loop || Q.updateProgress(), Q.effects[Q.params.effect].setTranslate()), Q.params.loop ? Q.slideTo(Q.params.initialSlide + Q.loopedSlides, 0, Q.params.runCallbacksOnInit) : (Q.slideTo(Q.params.initialSlide, 0, Q.params.runCallbacksOnInit), 0 === Q.params.initialSlide && (Q.parallax && Q.params.parallax && Q.parallax.setTranslate(), Q.lazy && Q.params.lazyLoading && (Q.lazy.load(), Q.lazy.initialImageLoaded = !0))), Q.attachEvents(), Q.params.observer && Q.support.observer && Q.initObservers(), Q.params.preloadImages && !Q.params.lazyLoading && Q.preloadImages(), Q.params.autoplay && Q.startAutoplay(), Q.params.keyboardControl && Q.enableKeyboardControl && Q.enableKeyboardControl(), Q.params.mousewheelControl && Q.enableMousewheelControl && Q.enableMousewheelControl(), Q.params.hashnav && Q.hashnav && Q.hashnav.init(), Q.params.a11y && Q.a11y && Q.a11y.init(), Q.emit("onInit", Q) }, Q.cleanupStyles = function() { Q.container.removeClass(Q.classNames.join(" ")).removeAttr("style"), Q.wrapper.removeAttr("style"), Q.slides && Q.slides.length && Q.slides.removeClass([Q.params.slideVisibleClass, Q.params.slideActiveClass, Q.params.slideNextClass, Q.params.slidePrevClass].join(" ")).removeAttr("style").removeAttr("data-swiper-column").removeAttr("data-swiper-row"), Q.paginationContainer && Q.paginationContainer.length && Q.paginationContainer.removeClass(Q.params.paginationHiddenClass), Q.bullets && Q.bullets.length && Q.bullets.removeClass(Q.params.bulletActiveClass), Q.params.prevButton && d(Q.params.prevButton).removeClass(Q.params.buttonDisabledClass), Q.params.nextButton && d(Q.params.nextButton).removeClass(Q.params.buttonDisabledClass), Q.params.scrollbar && Q.scrollbar && (Q.scrollbar.track && Q.scrollbar.track.length && Q.scrollbar.track.removeAttr("style"), Q.scrollbar.drag && Q.scrollbar.drag.length && Q.scrollbar.drag.removeAttr("style")) }, Q.destroy = function(k, i) { Q.detachEvents(), Q.stopAutoplay(), Q.params.scrollbar && Q.scrollbar && Q.params.scrollbarDraggable && Q.scrollbar.disableDraggable(), Q.params.loop && Q.destroyLoop(), i && Q.cleanupStyles(), Q.disconnectObservers(), Q.params.keyboardControl && Q.disableKeyboardControl && Q.disableKeyboardControl(), Q.params.mousewheelControl && Q.disableMousewheelControl && Q.disableMousewheelControl(), Q.params.a11y && Q.a11y && Q.a11y.destroy(), Q.emit("onDestroy"), k !== !1 && (Q = null) }, Q.init(), Q } };
    b.prototype = { isSafari: function() { var a = navigator.userAgent.toLowerCase(); return a.indexOf("safari") >= 0 && a.indexOf("chrome") < 0 && a.indexOf("android") < 0 }(), isUiWebView: /(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/i.test(navigator.userAgent), isArray: function(a) { return "[object Array]" === Object.prototype.toString.apply(a) }, browser: { ie: window.navigator.pointerEnabled || window.navigator.msPointerEnabled, ieTouch: window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints > 1 || window.navigator.pointerEnabled && window.navigator.maxTouchPoints > 1 }, device: function() { var m = navigator.userAgent,
                j = m.match(/(Android);?[\s\/]+([\d.]+)?/),
                k = m.match(/(iPad).*OS\s([\d_]+)/),
                l = m.match(/(iPod)(.*OS\s([\d_]+))?/),
                i = !k && m.match(/(iPhone\sOS)\s([\d_]+)/); return { ios: k || i || l, android: j } }(), support: { touch: window.Modernizr && Modernizr.touch === !0 || function() { return !!("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch) }(), transforms3d: window.Modernizr && Modernizr.csstransforms3d === !0 || function() { var a = document.createElement("div").style; return "webkitPerspective" in a || "MozPerspective" in a || "OPerspective" in a || "MsPerspective" in a || "perspective" in a }(), flexbox: function() { for (var k = document.createElement("div").style, i = "alignItems webkitAlignItems webkitBoxAlign msFlexAlign mozBoxAlign webkitFlexDirection msFlexDirection mozBoxDirection mozBoxOrient webkitBoxDirection webkitBoxOrient".split(" "), j = 0; j < i.length; j++) { if (i[j] in k) { return !0 } } }(), observer: function() { return "MutationObserver" in window || "WebkitMutationObserver" in window }() }, plugins: {} }; for (var g = ["jQuery", "Zepto", "Dom7"], f = 0; f < g.length; f++) { window[g[f]] && h(window[g[f]]) } var c;
    c = "undefined" == typeof Dom7 ? window.Dom7 || window.Zepto || window.jQuery : Dom7, c && ("transitionEnd" in c.fn || (c.fn.transitionEnd = function(m) {
        function j(a) { if (a.target === this) { for (m.call(this, a), k = 0; k < l.length; k++) { i.off(l[k], j) } } } var k, l = ["webkitTransitionEnd", "transitionend", "oTransitionEnd", "MSTransitionEnd", "msTransitionEnd"],
            i = this; if (m) { for (k = 0; k < l.length; k++) { i.on(l[k], j) } } return this }), "transform" in c.fn || (c.fn.transform = function(k) { for (var i = 0; i < this.length; i++) { var j = this[i].style;
            j.webkitTransform = j.MsTransform = j.msTransform = j.MozTransform = j.OTransform = j.transform = k } return this }), "transition" in c.fn || (c.fn.transition = function(k) { "string" != typeof k && (k += "ms"); for (var i = 0; i < this.length; i++) { var j = this[i].style;
            j.webkitTransitionDuration = j.MsTransitionDuration = j.msTransitionDuration = j.MozTransitionDuration = j.OTransitionDuration = j.transitionDuration = k } return this })), window.Swiper = b }(), "undefined" != typeof module ? module.exports = window.Swiper : "function" == typeof define && define.amd && define([], function() { return window.Swiper }); /* Lazy Load 1.9.3 - MIT license - Copyright 2010-2013 Mika Tuupola */
! function(f, g, h, i) { var j = f(g);
    f.fn.lazyload = function(a) {
        function b() { var k = 0;
            d.each(function() { var l = f(this); if (!e.skip_invisible || l.is(":visible")) { if (f.abovethetop(this, e) || f.leftofbegin(this, e)) {} else { if (f.belowthefold(this, e) || f.rightoffold(this, e)) { if (++k > e.failure_limit) { return !1 } } else { l.trigger("appear"), k = 0 } } } }) } var c, d = this,
            e = { threshold: 0, failure_limit: 0, event: "scroll", effect: "show", container: g, data_attribute: "original", skip_invisible: !0, appear: null, load: null, placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" }; return a && (i !== a.failurelimit && (a.failure_limit = a.failurelimit, delete a.failurelimit), i !== a.effectspeed && (a.effect_speed = a.effectspeed, delete a.effectspeed), f.extend(e, a)), c = e.container === i || e.container === g ? j : f(e.container), 0 === e.event.indexOf("scroll") && c.bind(e.event, function() { return b() }), this.each(function() { var k = this,
                l = f(k);
            k.loaded = !1, (l.attr("src") === i || l.attr("src") === !1) && l.is("img") && l.attr("src", e.placeholder), l.one("appear", function() { if (!this.loaded) { if (e.appear) { var m = d.length;
                        e.appear.call(k, m, e) } f("<img />").bind("load", function() { var o = l.attr("data-" + e.data_attribute);
                        l.hide(), l.is("img") ? l.attr("src", o) : l.css("background-image", "url('" + o + "')"), l[e.effect](e.effect_speed), k.loaded = !0; var p = f.grep(d, function(q) { return !q.loaded }); if (d = f(p), e.load) { var n = d.length;
                            e.load.call(k, n, e) } }).attr("src", l.attr("data-" + e.data_attribute)) } }), 0 !== e.event.indexOf("scroll") && l.bind(e.event, function() { k.loaded || l.trigger("appear") }) }), j.bind("resize", function() { b() }), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && j.bind("pageshow", function(k) { k.originalEvent && k.originalEvent.persisted && d.each(function() { f(this).trigger("appear") }) }), f(h).ready(function() { b() }), this }, f.belowthefold = function(d, a) { var b; return b = a.container === i || a.container === g ? (g.innerHeight ? g.innerHeight : j.height()) + j.scrollTop() : f(a.container).offset().top + f(a.container).height(), b <= f(d).offset().top - a.threshold }, f.rightoffold = function(d, a) { var b; return b = a.container === i || a.container === g ? j.width() + j.scrollLeft() : f(a.container).offset().left + f(a.container).width(), b <= f(d).offset().left - a.threshold }, f.abovethetop = function(d, a) { var b; return b = a.container === i || a.container === g ? j.scrollTop() : f(a.container).offset().top, b >= f(d).offset().top + a.threshold + f(d).height() }, f.leftofbegin = function(d, a) { var b; return b = a.container === i || a.container === g ? j.scrollLeft() : f(a.container).offset().left, b >= f(d).offset().left + a.threshold + f(d).width() }, f.inviewport = function(a, d) { return !(f.rightoffold(a, d) || f.leftofbegin(a, d) || f.belowthefold(a, d) || f.abovethetop(a, d)) }, f.extend(f.expr[":"], { "below-the-fold": function(a) { return f.belowthefold(a, { threshold: 0 }) }, "above-the-top": function(a) { return !f.belowthefold(a, { threshold: 0 }) }, "right-of-screen": function(a) { return f.rightoffold(a, { threshold: 0 }) }, "left-of-screen": function(a) { return !f.rightoffold(a, { threshold: 0 }) }, "in-viewport": function(a) { return f.inviewport(a, { threshold: 0 }) }, "above-the-fold": function(a) { return !f.belowthefold(a, { threshold: 0 }) }, "right-of-fold": function(a) { return f.rightoffold(a, { threshold: 0 }) }, "left-of-fold": function(a) { return !f.rightoffold(a, { threshold: 0 }) } }) }(jQuery, window, document);
(function() {
    function A(a) { this._n = a }

    function m(l, a, d) { var f = Math.pow(10, a),
            c;
        c = (Math.round(l * f) / f).toFixed(a); if (d) { var h = new RegExp("0{1," + d + "}$");
            c = c.replace(h, "") } return c }

    function B(d, c) { var a;
        c.indexOf("$") > -1 ? a = y(d, c) : c.indexOf("%") > -1 ? a = C(d, c) : c.indexOf(":") > -1 ? a = w(d, c) : a = D(d, c); return a }

    function F(I, d) { if (d.indexOf(":") > -1) { I._n = b(d) } else { if (d === x) { I._n = 0 } else { var H = d;
                z[g].delimiters.decimal !== "." && (d = d.replace(/\./g, "").replace(z[g].delimiters.decimal, ".")); var p = new RegExp(z[g].abbreviations.thousand + "(?:\\)|(\\" + z[g].currency.symbol + ")?(?:\\))?)?$"),
                    J = new RegExp(z[g].abbreviations.million + "(?:\\)|(\\" + z[g].currency.symbol + ")?(?:\\))?)?$"),
                    v = new RegExp(z[g].abbreviations.billion + "(?:\\)|(\\" + z[g].currency.symbol + ")?(?:\\))?)?$"),
                    G = new RegExp(z[g].abbreviations.trillion + "(?:\\)|(\\" + z[g].currency.symbol + ")?(?:\\))?)?$"),
                    i = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
                    n = !1; for (var r = 0; r <= i.length; r++) { n = d.indexOf(i[r]) > -1 ? Math.pow(1024, r + 1) : !1; if (n) { break } } I._n = (n ? n : 1) * (H.match(p) ? Math.pow(10, 3) : 1) * (H.match(J) ? Math.pow(10, 6) : 1) * (H.match(v) ? Math.pow(10, 9) : 1) * (H.match(G) ? Math.pow(10, 12) : 1) * (d.indexOf("%") > -1 ? 0.01 : 1) * Number((d.indexOf("(") > -1 ? "-" : "") + d.replace(/[^0-9\.'-]+/g, ""));
                I._n = n ? Math.ceil(I._n) : I._n } } return I._n }

    function y(h, f) { var c = f.indexOf("$") <= 1 ? !0 : !1,
            d = ""; if (f.indexOf(" $") > -1) { d = " ";
            f = f.replace(" $", "") } else { if (f.indexOf("$ ") > -1) { d = " ";
                f = f.replace("$ ", "") } else { f = f.replace("$", "") } } var a = B(h, f); if (c) { if (a.indexOf("(") > -1 || a.indexOf("-") > -1) { a = a.split("");
                a.splice(1, 0, z[g].currency.symbol + d);
                a = a.join("") } else { a = z[g].currency.symbol + d + a } } else { if (a.indexOf(")") > -1) { a = a.split("");
                a.splice(-1, 0, d + z[g].currency.symbol);
                a = a.join("") } else { a = a + d + z[g].currency.symbol } } return a }

    function C(f, c) { var a = ""; if (c.indexOf(" %") > -1) { a = " ";
            c = c.replace(" %", "") } else { c = c.replace("%", "") } f._n = f._n * 100; var d = B(f, c); if (d.indexOf(")") > -1) { d = d.split("");
            d.splice(-1, 0, a + "%");
            d = d.join("") } else { d = d + a + "%" } return d }

    function w(h, d) { var a = Math.floor(h._n / 60 / 60),
            f = Math.floor((h._n - a * 60 * 60) / 60),
            c = Math.round(h._n - a * 60 * 60 - f * 60); return a + ":" + (f < 10 ? "0" + f : f) + ":" + (c < 10 ? "0" + c : c) }

    function b(d) { var c = d.split(":"),
            a = 0; if (c.length === 3) { a += Number(c[0]) * 60 * 60;
            a += Number(c[1]) * 60;
            a += Number(c[2]) } else { if (c.lenght === 2) { a += Number(c[0]) * 60;
                a += Number(c[1]) } } return Number(a) }

    function D(Q, u) { var r = !1,
            L = !1,
            M = "",
            R = "",
            J = "",
            O = Math.abs(Q._n); if (Q._n === 0 && x !== null) { return x } if (u.indexOf("(") > -1) { r = !0;
            u = u.slice(1, -1) } if (u.indexOf("a") > -1) { if (u.indexOf(" a") > -1) { M = " ";
                u = u.replace(" a", "") } else { u = u.replace("a", "") } if (O >= Math.pow(10, 12)) { M += z[g].abbreviations.tillion;
                Q._n = Q._n / Math.pow(10, 12) } else { if (O < Math.pow(10, 12) && O >= Math.pow(10, 9)) { M += z[g].abbreviations.billion;
                    Q._n = Q._n / Math.pow(10, 9) } else { if (O < Math.pow(10, 9) && O >= Math.pow(10, 6)) { M += z[g].abbreviations.million;
                        Q._n = Q._n / Math.pow(10, 6) } else { if (O < Math.pow(10, 6) && O >= Math.pow(10, 3)) { M += z[g].abbreviations.thousand;
                            Q._n = Q._n / Math.pow(10, 3) } } } } } if (u.indexOf("b") > -1) { if (u.indexOf(" b") > -1) { R = " ";
                u = u.replace(" b", "") } else { u = u.replace("b", "") } var I = ["B", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
                n, P; for (var G = 0; G <= I.length; G++) { n = Math.pow(1024, G);
                P = Math.pow(1024, G + 1); if (Q._n >= n && Q._n < P) { R += I[G];
                    n > 0 && (Q._n = Q._n / n); break } } } if (u.indexOf("o") > -1) { if (u.indexOf(" o") > -1) { J = " ";
                u = u.replace(" o", "") } else { u = u.replace("o", "") } J += z[g].ordinal(Q._n) } if (u.indexOf("[.]") > -1) { L = !0;
            u = u.replace("[.]", ".") } var K = Q._n.toString().split(".")[0],
            S = u.split(".")[1],
            i = u.indexOf(","),
            N = "",
            H = !1; if (S) { if (S.indexOf("[") > -1) { S = S.replace("]", "");
                S = S.split("[");
                N = m(Q._n, S[0].length + S[1].length, S[1].length) } else { N = m(Q._n, S.length) } K = N.split(".")[0];
            N.split(".")[1].length ? N = z[g].delimiters.decimal + N.split(".")[1] : N = "";
            L && Number(N) === 0 && (N = "") } else { K = m(Q._n, null) } if (K.indexOf("-") > -1) { K = K.slice(1);
            H = !0 } i > -1 && (K = K.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1" + z[g].delimiters.thousands));
        u.indexOf(".") === 0 && (K = ""); return (r && H ? "(" : "") + (!r && H ? "-" : "") + K + N + (J ? J : "") + (M ? M : "") + (R ? R : "") + (r && H ? ")" : "") }

    function q(a, c) { z[a] = c } var E, k = "1.4.5",
        z = {},
        g = "en",
        x = null,
        j = typeof module != "undefined" && module.exports;
    E = function(a) { E.isNumeral(a) ? a = a.value() : Number(a) || (a = 0); return new A(Number(a)) };
    E.version = k;
    E.isNumeral = function(a) { return a instanceof A };
    E.language = function(c, a) { if (!c) { return g } c && !a && (g = c);
        (a || !z[c]) && q(c, a); return E };
    E.language("en", { delimiters: { thousands: ",", decimal: "." }, abbreviations: { thousand: "k", million: "m", billion: "b", trillion: "t" }, ordinal: function(a) { var c = a % 10; return ~~(a % 100 / 10) === 1 ? "th" : c === 1 ? "st" : c === 2 ? "nd" : c === 3 ? "rd" : "th" }, currency: { symbol: "$" } });
    E.zeroFormat = function(a) { typeof a == "string" ? x = a : x = null };
    E.fn = A.prototype = { clone: function() { return E(this) }, format: function(a) { return B(this, a ? a : E.defaultFormat) }, unformat: function(a) { return F(this, a ? a : E.defaultFormat) }, value: function() { return this._n }, valueOf: function() { return this._n }, set: function(a) { this._n = Number(a); return this }, add: function(a) { this._n = this._n + Number(a); return this }, subtract: function(a) { this._n = this._n - Number(a); return this }, multiply: function(a) { this._n = this._n * Number(a); return this }, divide: function(a) { this._n = this._n / Number(a); return this }, difference: function(a) { var c = this._n - Number(a);
            c < 0 && (c = -c); return c } };
    j && (module.exports = E);
    typeof ender == "undefined" && (this.numeral = E);
    typeof define == "function" && define.amd && define([], function() { return E }) }).call(this);
var timeLine = { pageIndex: 1, flag: true, page_count: 0, url: "/ajax-home/page-{0}/{1}.chn", delaySuccess: 1200, placeholder: ".kds-new-stream-wrapper", isDetail: false, lastItem: null, duplessthan: 5, flagSameZone: true, flagScroll: true, allowScroll: true, timer: null, isTrack: true, checkPage: "home", sortItem: "desc", isApiAdm: true, init: function() { var a = this; if (a.isDetail) { var d = true;
            a.getData(a.pageIndex);
            $(function() { $("#divAdvBottomAll").remove(); var e = setInterval(function() { if (!$(".VID-scrolltop").hasClass("loaded")) { $(".VID-scrolltop").addClass("loaded");
                        $(".VID-scrolltop").on("click", function() { $(this).addClass("anScroll");
                            setTimeout(function() { $(".VID-scrolltop").removeClass("anScroll") }, 3000) }) } else { clearInterval(e) } }, 1500) }) } else { if (a.checkPage == "tags") { a.pageIndex = 2 } else { a.pageIndex = 3 } a.page_count++ } var c = "";
        c += '<div class="fb-loading-wrapper" style="max-width: 700px;">';
        c += '<div class="fblw-timeline-item">';
        c += '<div class="fblwti-animated">';
        c += '<div class="fblwtia-mask fblwtia-title-line fblwtia-title-mask-0"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sapo-line-0"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-0"></div>';
        c += '<div class="fblwtia-mask fblwtia-title-line fblwtia-title-mask-1"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sapo-line-1"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-1"></div>';
        c += '<div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-2"></div>';
        c += '<div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-2"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-2"></div>';
        c += '<div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-3"></div>';
        c += '<div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-3"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-3"></div>';
        c += '<div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-4"></div>';
        c += '<div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-4"></div>';
        c += '<div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-4"></div>';
        c += "</div></div></div>"; if (a.checkPage == "video") { $(a.placeholder).append('<div id="IconLoadListDetail"><img src="https://genknews.genkcdn.vn/web_images/loadding_v2.png"/> </div>') } else { $(a.placeholder).append(c) } setTimeout(function() { a.showFooter(false) }, 2000); var b = $(window);
        b.scroll(function() { var g = a.pageIndex; var f = a.page_count; if (typeof(sessionStorage) != "undefined") { var e = $("#hdZoneId").val() != null ? $("#hdZoneId").val() : "";
                e = typeof e == "undefined" ? "0" : e; if (sessionStorage.getItem("ss_pageindex_" + a.checkPage + "_zoneId_" + e) != null && g < sessionStorage.getItem("ss_pageindex_" + a.checkPage + "_zoneId_" + e)) { g = parseInt(sessionStorage.getItem("ss_pageindex_" + a.checkPage + "_zoneId_" + e)) } if (sessionStorage.getItem("ss_pagecount_" + a.checkPage + "_zoneId_" + e) != null) { f = sessionStorage.getItem("ss_pagecount_" + a.checkPage + "_zoneId_" + e) } } if ($(this).scrollTop() + $(this).height() >= $(document).height() - 50) { if (f < 4) { $(a.placeholder).find(".wrapperbtn").remove();
                    a.getData(g) } else { a.showFooter(true); if ($(a.placeholder).find(".wrapperbtn").length > 0) { return } $(a.placeholder).append('<div class="wrapperbtn"><a href="javascript:void(0);" class="btnviewmore">Xem thÃªm</a></div>');
                    $(a.placeholder).find(".btnviewmore").on("click", function() { a.getData(g);
                        f = 0;
                        a.page_count = 0; if (typeof(sessionStorage) != "undefined") { sessionStorage.removeItem("ss_pagecount_" + a.checkPage + "_zoneId_" + e) } if (a.isTrack) { trackEvent.stream($("#hdNewsId").val() != null ? "Detail" : "Category", $("#hdZoneUrl").val(), g - 1);
                            a.isTrack = false } }) } } }); if (a.checkPage == "detail") { trackEvent.stream("Detail", $("#hdZoneUrl").val(), 1) } if (a.checkPage == "cate") { trackEvent.stream("Category", $("#hdZoneUrl").val(), 1) } if (a.checkPage == "home") { trackEvent.stream("Home", "trang-chu", 1) } $("#LoadListCate a").click(function() { if (typeof(sessionStorage) != "undefined") { var e = $("#hdZoneId").val() != null ? $("#hdZoneId").val() : "";
                e = typeof e == "undefined" ? "0" : e; var f = $(this).offset().top;
                sessionStorage.setItem("ss_position_" + a.checkPage + "_zoneId_" + e, f) } }) }, formatTimeAgo: function() { var a = $(".kcnwn-meta.date-time");
        a.timeago() }, getData: function(f) { var k = this; if (k.flag === false) { return } k.flag = false; var i = $("#hdZoneId").val() != null ? $("#hdZoneId").val() : ""; var j = $("#hdExcluId").val() != null ? $("#hdExcluId").val() : ""; var c = $("#hdTagUrl").val() != null ? $("#hdTagUrl").val() : ""; var h = $("#hdPageUrlAjax").val() != null ? $("#hdPageUrlAjax").val() : "";
        k.url = h; var a = ""; if (k.checkPage == "cate") { a = String.format(k.url, f, i, j) } else { if (k.checkPage == "detail") { if (k.isApiAdm == false) { a = String.format(k.url, f, j) } else { var b = ""; try { var d = new RegExp(/__uid\:([0-9]+)/); var b = d.exec(decodeURIComponent(getCookie("__uif")))[1] } catch (l) {} b = b || "1509518141984318107"; var g = DomainWeb + $("#hdNewsUrl").val();
                    a = AdmDomain + "/request/client?guid=" + b + "&domain=GenK&boxid=1&url=" + g + "&page=" + (f - 1) } } else { if (k.checkPage == "tags") { a = String.format(k.url, c, f, k.sortItem) } else { if (k.checkPage == "video") { a = String.format(k.url, f) } else { if (k.checkPage == "videotag") { a = String.format(k.url, i, f) } else { if (k.checkPage == "thread") { a = String.format(k.url, f, i) } else { a = String.format(k.url, f, j) } } } } } } $.ajax({ url: a, dataType: "html", beforeSend: function() { $("#IconLoadListDetail").css("display", "block");
                $(".fb-loading-wrapper").css("display", "block");
                $(".wrapperbtn").remove() }, success: function(e) { setTimeout(function() { if (k.checkPage == "tags") { k.successCallbackTags(e, f) } else { k.successCallback(e); if (f <= 11 && (k.checkPage == "home")) { k.backToPositionStream(e, f, k.checkPage, i) } } }, k.delaySuccess) } }) }, backToPositionStream: function(d, b, c, a) { if (b > 11) { return } if (typeof(sessionStorage) != "undefined") { a = typeof a == "undefined" ? "0" : a; var e = sessionStorage.getItem("ss_content_" + c + "_zoneId_" + a); if (e === null) { e = "" } sessionStorage.setItem("ss_content_" + c + "_zoneId_" + a, e + d);
            $("#LoadListCate a").click(function() { var f = $(this).offset().top;
                sessionStorage.setItem("ss_position_" + c + "_zoneId_" + a, f) }) } }, successCallback: function(k) { var d = this;
        $("#IconLoadListDetail").css("display", "none");
        $(".fb-loading-wrapper").css("display", "none"); if (k !== "") { if (d.pageIndex === 1 && d.isDetail) { $(".dtimeline").prepend('<span class="tlTitle font1b">Tin má»›i</span><ul class="tl" />') } d.lastItem = $(d.placeholder).find(">ul > li:nth-last-of-type(" + d.duplessthan + ")"); if (d.checkPage == "detail" && d.isApiAdm) { var c = $.parseJSON(k.replace("GenK_Box_1=", "")); var m; var j = ""; var a = ""; var o = ""; var p = ""; var l = ""; for (var h = 0; h < c.listnews.length; h++) { m = c.listnews[h]; if (d.pageIndex == 1 && h < 5) { a += d.showItem(m) } else { if (d.pageIndex == 1 && h >= 5) { o += d.showItem(m) } else { if (d.pageIndex == 2 && h < 5) { p += d.showItem(m) } else { if (d.pageIndex == 2 && h >= 5) { l += d.showItem(m) } else { j += d.showItem(m) } } } } } if (d.pageIndex == 1) { $("#genk_detail_showadmlist1").append(a);
                    $("#genk_detail_showadmlist1").attr("algid", c.algid);
                    $("#genk_detail_showadmlist1").attr("boxid", c.boxid);
                    $("#genk_detail_showadmlist1").attr("dspid", c.dspid);
                    setTimeout(function() { try { sendLogRecommend("genk_detail_showadmlist1") } catch (i) {} }, 500);
                    $("#genk_detail_showadmlist2").append(o);
                    $("#genk_detail_showadmlist2").attr("algid", c.algid);
                    $("#genk_detail_showadmlist2").attr("boxid", c.boxid);
                    $("#genk_detail_showadmlist2").attr("dspid", c.dspid);
                    setTimeout(function() { try { sendLogRecommend("genk_detail_showadmlist2") } catch (i) {} }, 500) } else { if (d.pageIndex == 2) { $("#genk_detail_showadmlist3").append(p);
                        $("#genk_detail_showadmlist3").attr("algid", c.algid);
                        $("#genk_detail_showadmlist3").attr("boxid", c.boxid);
                        $("#genk_detail_showadmlist3").attr("dspid", c.dspid);
                        setTimeout(function() { try { sendLogRecommend("genk_detail_showadmlist3") } catch (i) {} }, 500);
                        $("#genk_detail_showadmlist4").append(l);
                        $("#genk_detail_showadmlist4").attr("algid", c.algid);
                        $("#genk_detail_showadmlist4").attr("boxid", c.boxid);
                        $("#genk_detail_showadmlist4").attr("dspid", c.dspid);
                        setTimeout(function() { try { sendLogRecommend("genk_detail_showadmlist4") } catch (i) {} }, 500) } else { $(d.placeholder).find(">ul").append(j);
                        $(d.placeholder).find(">ul").attr("algid", c.algid);
                        $(d.placeholder).find(">ul").attr("boxid", c.boxid);
                        $(d.placeholder).find(">ul").attr("dspid", c.dspid);
                        setTimeout(function() { try { sendLogRecommend("LoadListCate2") } catch (i) {} }, 500) } } if (d.pageIndex < 4) { addViewPlusDetail() } relatedNews.initTimelinePoppup() } else { $(d.placeholder).find(">ul").append(k) } var g = {}; if (d.pageIndex == 3 || d.pageIndex == 4 || d.pageIndex == 5 || d.pageIndex == 6 || d.pageIndex == 7) { $("ul li.knswli").each(function() { var e = $(this).attr("id"); if (typeof e != "undefined") { if (g[e]) { $(this).remove() } else { g[e] = true } } }) } d.removeDup(); if (d.pageIndex === 1 && d.isDetail) { d.pageIndex++;
                $("#boxNewest").wrap('<li class="item-news-cate clearfix xxx tlboxNB"/>');
                $(d.placeholder).find(">ul").prepend('<span class="tlthead">Tin má»›i</span>');
                $(".boxSameZone").after($("#boxNewest").addClass("relative mgt40 mgb30"));
                $(d.placeholder).find(">ul li.tlboxNB").remove();
                $("#boxVideoTL, #boxDBL, #boxSocial").wrap('<li class="item-news-cate clearfix xxx"/>');
                $("div[id^=slideEvent], #slThreadAndNew").wrapAll('<li class="item-news-cate clearfix tlboxThread xxx"/>');
                $(d.placeholder).find('>ul li.item-news-cate:not(".xxx, .s"):eq(5)').before($("#boxDBL").parent("li.item-news-cate"));
                $(d.placeholder).find('>ul li.item-news-cate:not(".xxx, .s"):eq(10)').before($("#slThreadAndNew, div[id^=slideEvent]").parent("li.item-news-cate"));
                $(d.placeholder).find('>ul li.item-news-cate:not(".xxx, .s"):eq(15)').before($("#boxSocial").parent("li.item-news-cate"));
                setTimeout(function() { d.threadChange() }, 3000) } else { if (d.isTrack) { if (($("#hdHome").val() != null)) { trackEvent.stream("Home", "trang-chu", d.pageIndex - 1) } else { trackEvent.stream($("#hdNewsId").val() != null ? "Detail" : "Category", $("#hdZoneUrl").val(), d.pageIndex - 1) } } } if (typeof(sessionStorage) != "undefined") { var b = $("#hdZoneId").val() != null ? $("#hdZoneId").val() : "";
                b = typeof b == "undefined" ? "0" : b; if (sessionStorage.getItem("ss_pageindex_" + d.checkPage + "_zoneId_" + b) != null && sessionStorage.getItem("ss_pageindex_" + d.checkPage + "_zoneId_" + b) > d.pageIndex) { var f = sessionStorage.getItem("ss_pageindex_" + d.checkPage + "_zoneId_" + b);
                    f++;
                    d.pageIndex = f } else { d.pageIndex++ } d.page_count++;
                sessionStorage.setItem("ss_pagecount_" + d.checkPage + "_zoneId_" + b, d.page_count);
                sessionStorage.setItem("ss_pageindex_" + d.checkPage + "_zoneId_" + b, d.pageIndex) } d.flag = true;
            d.showFooter(false);
            d.iconHot(); if (d.isDetail && d.pageIndex <= 3) { d.addAdvBox() } } else { $(".wrapperbtn").remove();
            d.showFooter(true) } try { if (d.checkPage == "detail") { if (d.pageIndex > 2) { brandContentStream.init("#LoadListCate2");
                    bindStikerStream.init("#LoadListCate2") } else { brandContentStream.init("#LoadListCate");
                    bindStikerStream.init("#LoadListCate") } } else { brandContentStream.init("#LoadListCate");
                bindStikerStream.init("#LoadListCate") } } catch (n) {} }, successCallbackTags: function(d, b) { var a = this;
        $("#IconLoadListDetail").css("display", "none");
        $(".fb-loading-wrapper").css("display", "none"); if (d !== "") { if (b == 1) { $(a.placeholder).find(">ul").html(d);
                a.page_count = 0;
                a.pageIndex = 1 } else { $(a.placeholder).find(">ul").append(d) } var c = {}; if (a.pageIndex == 3 || a.pageIndex == 4 || a.pageIndex == 5 || a.pageIndex == 6 || a.pageIndex == 7) { $("ul li.knswli").each(function() { var e = $(this).attr("id"); if (typeof e != "undefined") { if (c[e]) { $(this).remove() } else { c[e] = true } } }) } a.formatTimeAgo();
            a.page_count++;
            a.pageIndex++;
            a.flag = true;
            a.showFooter(false);
            a.iconHot(); if (a.isDetail && a.pageIndex <= 3) { a.addAdvBox() } } else { $(".wrapperbtn").remove();
            a.showFooter(true) } }, showItem: function(f) { var g = this; var c = "show-popup visit-popup"; var d = ' ispopup="1" data-newsid="' + f.id + '" '; var h = typeof f.stickerType != "undefined" ? f.stickerType : "0"; var e = ' data-popup-url="' + f.url.replace("http://genk.vn", "").replace("https://genk.vn", "") + '"'; var b = f.type; if (b > 3) { c = "";
            d = ' ispopup="0"' } var a = "";
        a += '<li class="knswli clearfix " ' + d + '  id="newsid' + f.id + '" data-locked="False" data-marked-zoneid="genk_home_bs7" data-boxtype="timelineposition">';
        a += '<div class="knswli-left fl"><a title="' + f.title.replace(/"/g, "&quot;") + '" href="' + f.url.replace("http://genk.vn", "").replace("https://genk.vn", "") + '" class="kscliw-ava ' + c + '" ' + e + '><img src="' + g.thumb_img(f.image, 250, 155) + '" title="' + f.title.replace(/"/g, "&quot;") + '" alt="' + f.title.replace(/"/g, "&quot;") + '" width="250" height="155"/></a></div> ';
        a += '<div class="knswli-right elp-list">';
        a += '<h4 class="knswli-title"><a href="' + f.url.replace("http://genk.vn", "").replace("https://genk.vn", "") + '" title="' + f.title.replace(/"/g, "&quot;") + '" data-id="' + f.id + '" newstype="' + h + '" class="' + c + '" ' + e + " >" + f.title.replace(/"/g, "&quot;") + "</a></h4>";
        a += '<div class="knswli-meta">';
        a += '<span class="knswli-time" title="' + f.publishDate + '"> ' + getTimeAgo(f.publishDate) + "</span>";
        a += '<span class="knswli-comment viewcountcomment" rel="http://genk.vn/news-' + f.id + '.chn">1</span><span class="knswli-facebook">0</span></div>';
        a += '<span class="knswli-sapo">' + f.des + "</span>";
        a += '<div class="knswli-relate-wrap nodisplay"></div></div></li>'; return a }, thumb_img: function(a, c, b) { if (typeof storageImageDomain == "undefined") { storageImageDomain = "https://genknews.genkcdn.vn" } if (c == 0 || typeof c == "undefined") { return a } if (a.indexOf(storageImageDomain) != -1) { a = a.replace(storageImageDomain, "") } return String.format("{0}/zoom/{1}_{2}/{3}", storageImageDomain, c, b, a.trimStart("/")) }, showFooter: function(a) { if (a) { $(".hide-on-loading").show() } else { $(".hide-on-loading").hide() } }, iconList: function() { var e = '<i class="ico-newstype-photo" title="BÃ i áº£nh"></i>'; var b = '<i class="ico-newstype-video" title="BÃ i video"></i>'; var c = '<i class="ico-newstype-update" title="Cáº­p nháº­t"></i>'; var d = '<i class="ico-newstype-live" title="Trá»±c tiáº¿p"></i>'; var a = $("a[data-newstype]");
        a.each(function() { var f = $(this); if (f.find('>i[class^="ico-newstype"]').length === 0) { switch (f.attr("data-newstype")) {
                    case "2":
                        f.append(b); break;
                    case "3":
                        f.append(e); break;
                    case "6":
                        f.append(c); break;
                    case "7":
                        f.append(e + b); break;
                    case "10":
                        f.append(d); break } } }) }, iconHot: function() { var a = $('a[data-breakingnews="True"]:not(:has("i.ico-newstype-focus"))');
        a.each(function() { $(this).append('<i class="ico-newstype-focus"></i>') }) }, dateParse: function(a) { var b = $.trim(a);
        b = b.replace(/\.\d+/, "");
        b = b.replace(/-/, "/").replace(/-/, "/");
        b = b.replace(/T/, " ").replace(/Z/, " UTC");
        b = b.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2");
        b = b.replace(/([\+\-]\d\d)$/, " $100"); return new Date(b) }, iconNew: function(a, b) { return new Date() - this.dateParse(a) < 60 * b * 1000 }, addAdvBox: function() { var a = this;
        $(a.placeholder).find(">ul #boxDBL").parent("li.item-news-cate").before($(".adm1"));
        $(a.placeholder).find(">ul #slThreadAndNew, >ul div[id^=slideEvent]").parent("li.item-news-cate").before($(".adm2"));
        $(a.placeholder).find(">ul #boxSocial").parent("li.item-news-cate").before($(".adm3"));
        $(a.placeholder).find(">ul li.toptitle:last").before($(".adm4")) }, removeDup: function() { var a = this; var c = {}; var b = a.lastItem.nextAll("li.item-news-cate");
        b.each(function() { var d = $(this).attr("data-newsid"); if (c[d]) { $(this).remove() } else { c[d] = true } }) }, addEventScroll: function() { if (isSmartPhone() || is_touch_device()) { this.allowScroll = false } else { $.scrollSpeed(80, 450); if (this.flagScroll) { this.disableIframePointEvent() } } }, destroyEventScroll: function() { if (jQuery._data(window, "events") != null && jQuery._data(window, "events").mousewheel != null) { $(window).unmousewheel(); if (!$(".VID-scrolltop").hasClass("anScroll")) { $("html, body").stop(true, false) } } }, disableIframePointEvent: function() { $(function() { if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) { var a = $("iframe");
                window.addEventListener("scroll", function() { clearTimeout(this.timer); if (!a.hasClass("disable-hover")) { a.addClass("disable-hover") } this.timer = setTimeout(function() { a.removeClass("disable-hover") }, 500) }, false) } this.flagScroll = false }) }, fixBox: function() { var a = $(".timeline .sm-detail");
        a.css({ position: "absolute", bottom: "15px" }) }, threadChange: function() { var a = $(".tlboxThread"); if (a.length) { a.find("> div").addClass("relative");
            a.find(".visibility").removeClass("visibility").addClass("hidden");
            $("#slThreadAndNew span.bSKH").off("click").on("click", function() { $(this).parent().stop().animate({ opacity: "0", right: "-660px" }, 450, function() { $(this).css({ right: "0", opacity: "1" });
                    $(this).addClass("hidden");
                    $(this).prev("div").hide().removeClass("hidden").fadeIn() }) });
            $(".tlboxThread h3 .bSKH").off("click").on("click", function(b) { $(this).parents(".slide-list").stop().animate({ opacity: "0", left: "-660px" }, 450, function() { $(this).css({ left: "0", opacity: "1" });
                    $(this).addClass("hidden");
                    $(this).next("div").hide().removeClass("hidden").fadeIn() }); return false }) } }, boxSameZone: function(b) { var a = this; if ($(".news-title:first").length && $("#hdCatId").val() > 0 && a.flagSameZone) { if ($(b).scrollTop() >= $(".news-title:first").offset().top) { $.getJSON(appSettings.ajaxDomain + "/Handlers/BetaComment.ashx?callback=?", { zoneId: $("#hdCatId").val(), newsId: $("#hdNewsId").val(), c: "samezone" }, function(f) { if (f != null) { var c = $(".boxSameZone"); if (c.length) { c.addClass("success");
                            c.find("> div.fl").html(f.objJson.Left);
                            c.find("> div.fr").html(f.objJson.Right); var d = c.find("> div.fr li .bTitle"); var g = $(".boxSameZone div.fl p"); var e = $(".boxSameZone div.fr span");
                            d.each(function() { $(this).trimLine(3) });
                            g.each(function() { $(this).trimLine(3) });
                            e.timeago();
                            e.each(function() { if (timeLine.iconNew($(this).attr("title"), 120)) { $(this).css("color", "#007F74") } }); if (c.find("> div.fr").height() > c.find("> div.fl").height()) { c.find("> div.fl").height(c.find("> div.fr").height()) } } } });
                a.flagSameZone = false } } } };
var trackEvent = { stream: function(a, b, c) { ga("send", "event", "Stream" + a + "_" + b, "load page " + c, b) } };
var brandContentStream = { content: "#LoadListCate", attr: "data-id", init: function(b) { var a = this;
        a.content = $(b); var c = ""; var e = 0; var d = a.content.find(".elp-list:not(.done-get-brand-content)");
        d.each(function() { var f = ($(this).find("h4.knswli-title a").attr(a.attr)); if (typeof(f) != "undefined") { if (e == 0) { c += f } else { c += "," + f } e++ } }); if (e < 1) { return } $.ajax({ url: DomainConfig.AjaxDomain + "/ajax-brandcontent.chn", data: { c: "brandcontentbynewsids", newsIds: c }, dataType: "json", type: "POST", beforeSend: function() {}, success: function(f) { if (f != null) { a.genToolTip(f) } } }) }, genToolTip: function(c) { var a = this; var b = window.location.pathname;
        $.each(c, function(g, e) { var d = a.content.find(".elp-list h4 a[" + a.attr + "*='" + e.NewsId + "']").parents(".elp-list"); var h = '<div class="brand-content stream k14topic-sapo">';
            h += String.format('<a href="{0}" title="{1}" class="k14topic-logo">', e.BrandContentUrl, e.BrandContentName);
            h += String.format('<img src="{0}" />', e.BrandContentLogoStream);
            h += "</a>";
            h += '<div class="k14topic-tooltip-wrapper">';
            h += '<div class="k14topic-tooltip-content">';
            h += String.format('<div class="k14topic-tooltip-header" style=""><div class="fl" style="padding: 10px;">');
            h += String.format('<img src="{0}" alt="{1}">', e.BrandContentCover, e.BrandContentName);
            h += "</div>";
            h += '<div class="right">';
            h += String.format('<a href="{0}" title="{1}" class="k14topic-name">{1}</a>', e.BrandContentUrl, e.BrandContentName);
            h += "</div></div>";
            h += '<div class="k14topic-tooltip-body">';
            h += '<ul class="k14topic-list-news">';
            e.Data = JSON.parse(e.Data); for (var f = 0; f < e.Data.length && f < 3; f++) { h += '<li class="k14topic-news clearfix">';
                h += String.format('<a href="{0}" title="{1}" class="k14topic-news-thumb">', e.Data[f].NewsUrl, e.Data[f].NewsTitle);
                h += String.format('<img src="{0}" alt="{1}">', e.Data[f].NewsImage, e.Data[f].NewsTitle);
                h += "</a>";
                h += '<h3 class="k14topic-news-title">';
                h += String.format('<a href="{0}" title="{1}">{1}</a>', e.Data[f].NewsUrl, e.Data[f].NewsTitle);
                h += "</h3>";
                h += "</li>" } h += "</ul>";
            h += String.format('<a href="{0}" title="{1}" class="k14topic-btn-research">xem chi tiáº¿t</a>', e.BrandContentUrl, e.BrandContentName);
            h += "</div>";
            h += "</div>";
            h += "</div>";
            h += "</div>"; if (e.BrandContentUrl.indexOf(b) == -1 || b == "/") { if (!d.hasClass("done-get-brand-content")) {
                    (d).prepend(h);
                    d.find(".sapo-new").hide().fadeIn(600);
                    d.addClass("done-get-brand-content") } } }) } };
var brandContent = { height: 168, init: function() { var me = this; if ($("#hdNewsId").val() > 0 && $("#hdBrandContentUrl").val() != null) { $.ajax({ url: DomainConfig.AjaxDomain + "/ajax-brandcontent.chn", data: { c: "brandcontent", newsId: $("#hdNewsId").val(), tUrl: $("#hdBrandContentUrl").val() }, dataType: "json", type: "GET", beforeSend: function() {}, success: function(msg) { if (msg != "") { msg = eval(msg); var res = msg; if (res.Data != null) { me.genToolTip(res) } } } }) } }, genToolTip: function(c) { if (c.BrandContentLogoStream != "") { var a = '<div class="brand-content k14topic-sapo">';
            a += String.format('<a href="{0}" title="{1}" class="k14topic-logo">', c.BrandContentUrl, c.BrandContentName);
            a += String.format('<img src="{0}" />', c.BrandContentLogoStream);
            a += "</a>";
            a += '<div class="k14topic-tooltip-wrapper">';
            a += '<div class="k14topic-tooltip-content">';
            a += String.format('<div class="k14topic-tooltip-header" style=""><div class="fl" style="padding: 10px;">');
            a += String.format('<img src="{0}" alt="{1}">', c.BrandContentCover, c.BrandContentName);
            a += "</div>";
            a += '<div class="right">';
            a += String.format('<a href="{0}" title="{1}" class="k14topic-name">{1}</a>', c.BrandContentUrl, c.BrandContentName);
            a += "</div></div>";
            a += '<div class="k14topic-tooltip-body">';
            a += '<ul class="k14topic-list-news">'; for (var b = 0; b < c.Data.length && b < 3; b++) { a += '<li class="k14topic-news clearfix">';
                a += String.format('<a href="{0}" title="{1}" class="k14topic-news-thumb">', c.Data[b].NewsUrl, c.Data[b].NewsTitle);
                a += String.format('<img src="{0}" alt="{1}">', c.Data[b].NewsImage, c.Data[b].NewsTitle);
                a += "</a>";
                a += '<h3 class="k14topic-news-title">';
                a += String.format('<a href="{0}" title="{1}">{1}</a>', c.Data[b].NewsUrl, c.Data[b].NewsTitle);
                a += "</h3>";
                a += "</li>" } a += "</ul>";
            a += String.format('<a href="{0}" title="{1}" class="k14topic-btn-research">xem chi tiáº¿t</a>', c.BrandContentUrl, c.BrandContentName);
            a += "</div>";
            a += "</div>";
            a += "</div>";
            a += "</div>";
            $(".kbwc-title").prepend(a);
            $(".k14topic-sapo").hide().fadeIn(600); if ($(".kbwc-header .klcbfn-subtitle").length > 0) { $(".kbwc-header .klcbfn-subtitle").remove() } } } };
var bindStikerStream = { content: "#LoadListCate", attr: "newstype", init: function(b) { var a = this;
        a.content = $(b); var c = a.content.find("li.knswli");
        c.each(function() { getStickerInNews($(this)) }) } };

function getStickerInNews(a) { var b = ""; switch (a.find(".knswli-title a").attr("newstype")) {
        case "5":
            b = "sticker-nong";
            addSticker(a, b); break;
        case "6":
            b = "sticker-quy";
            addSticker(a, b); break;
        case "7":
            b = "sticker-sock";
            addSticker(a, b); break;
        case "8":
            b = "sticker-hong";
            addSticker(a, b); break;
        case "9":
            b = "sticker-cute";
            addSticker(a, b); break;
        case "10":
            b = "sticker-funny";
            addSticker(a, b); break } a.addClass("done-get-sticker") }

function addSticker(c, b) { if (b != "") { var a = "<span class='sticker " + b + "'>"; if (c.find(".knswli-left .sticker").length == 0) { c.find(".knswli-left").append(a);
            c.find(".knswli-left").addClass("pos-rlt") } } }

function getTimeAgo(f) { f = f * 1000; var e = new Date(); var c = "1 phÃºt trÆ°á»›c"; if (e.getTime() > f) { var a = e.getTime() - f; if (a >= 86400000) { var b = a / 1000;
            b = b / 3600;
            b = b / 24;
            c = Math.floor(b) + " ngÃ y trÆ°á»›c" } if (a < 86400000 && a >= 3600000) { var b = a / 1000;
            b = b / 3600;
            c = Math.floor(b) + " giá» trÆ°á»›c" } if (a < 3600000 && a >= 60000) { var b = a / 1000;
            b = b / 60;
            c = Math.floor(b) + " phÃºt trÆ°á»›c" } } return c };
(function(a) { if (typeof define === "function" && define.amd) { define(["jquery"], a) } else { a(jQuery) } }(function(d) { d.timeago = function(h) { if (h instanceof Date) { return e(h) } else { if (typeof h === "string") { return e(d.timeago.parse(h)) } else { if (typeof h === "number") { return e(new Date(h)) } else { return e(d.timeago.datetime(h)) } } } }; var g = d.timeago;
    d.extend(d.timeago, { settings: { refreshMillis: 60000, allowPast: true, allowFuture: false, localeTitle: false, cutoff: 0, strings: { prefixAgo: null, prefixFromNow: null, suffixAgo: "trÆ°á»›c", suffixFromNow: "from now", inPast: "any moment now", seconds: "chÆ°a Ä‘áº¿n 1 phÃºt", minute: "1 phÃºt", minutes: "%d phÃºt", hour: "1 giá»", hours: "%d giá»", day: "1 ngÃ y", days: "%d ngÃ y", month: "1 thÃ¡ng", months: "%d thÃ¡ng", year: "1 nÄƒm", years: "%d nÄƒm", wordSeparator: " ", numbers: [] } }, inWords: function(m) { if (!this.settings.allowPast && !this.settings.allowFuture) { throw "timeago allowPast and allowFuture settings can not both be set to false." } var n = this.settings.strings; var o = n.prefixAgo; var r = n.suffixAgo; if (this.settings.allowFuture) { if (m < 0) { o = n.prefixFromNow;
                    r = n.suffixFromNow } } if (!this.settings.allowPast && m >= 0) { return this.settings.strings.inPast } var j = Math.abs(m) / 1000; var h = j / 60; var l = h / 60; var q = l / 24; var k = q / 365;

            function s(w, u) { var v = d.isFunction(w) ? w(u, m) : w; var t = (n.numbers && n.numbers[u]) || u; return v.replace(/%d/i, t) } var i = j < 45 && s(n.seconds, Math.round(j)) || j < 90 && s(n.minute, 1) || h < 45 && s(n.minutes, Math.round(h)) || h < 90 && s(n.hour, 1) || l < 24 && s(n.hours, Math.round(l)) || l < 42 && s(n.day, 1) || q < 30 && s(n.days, Math.round(q)) || q < 45 && s(n.month, 1) || q < 365 && s(n.months, Math.round(q / 30)) || k < 1.5 && s(n.year, 1) || s(n.years, Math.round(k)); var p = n.wordSeparator || ""; if (n.wordSeparator === undefined) { p = " " } return d.trim([o, i, r].join(p)) }, parse: function(h) { var i = d.trim(h);
            i = i.replace(/\.\d+/, "");
            i = i.replace(/-/, "/").replace(/-/, "/");
            i = i.replace(/T/, " ").replace(/Z/, " UTC");
            i = i.replace(/([\+\-]\d\d)\:?(\d\d)/, " $1$2");
            i = i.replace(/([\+\-]\d\d)$/, " $100"); return new Date(i) }, datetime: function(h) { var i = g.isTime(h) ? d(h).attr("datetime") : d(h).attr("title"); return g.parse(i) }, isTime: function(h) { return d(h).get(0).tagName.toLowerCase() === "time" } }); var f = { init: function() { var h = d.proxy(a, this);
            h(); var i = g.settings; if (i.refreshMillis > 0) { this._timeagoInterval = setInterval(h, i.refreshMillis) } }, update: function(h) { var i = g.parse(h);
            d(this).data("timeago", { datetime: i }); if (g.settings.localeTitle) { d(this).attr("title", i.toLocaleString()) } a.apply(this) }, updateFromDOM: function() { d(this).data("timeago", { datetime: g.parse(g.isTime(this) ? d(this).attr("datetime") : d(this).attr("title")) });
            a.apply(this) }, dispose: function() { if (this._timeagoInterval) { window.clearInterval(this._timeagoInterval);
                this._timeagoInterval = null } } };
    d.fn.timeago = function(h, i) { var j = h ? f[h] : f.init; if (!j) { throw new Error("Unknown function name '" + h + "' for timeago") } this.each(function() { j.call(this, i) }); return this };

    function a() { if (!d.contains(document.documentElement, this)) { d(this).timeago("dispose"); return this } var h = c(this); var i = g.settings; if (!isNaN(h.datetime)) { if (i.cutoff == 0 || Math.abs(b(h.datetime)) < i.cutoff) { d(this).text(e(h.datetime)) } } return this }

    function c(h) { h = d(h); if (!h.data("timeago")) { h.data("timeago", { datetime: g.datetime(h) }); var i = d.trim(h.text()); if (g.settings.localeTitle) { h.attr("title", h.data("timeago").datetime.toLocaleString()) } else { if (i.length > 0 && !(g.isTime(h) && h.attr("title"))) { h.attr("title", i) } } } return h.data("timeago") }

    function e(h) { return g.inWords(b(h)) }

    function b(h) { return (new Date().getTime() - h.getTime()) } document.createElement("abbr");
    document.createElement("time") }));

function createCookie(e, a, c) { if (c) { var d = new Date();
        d.setTime(d.getTime() + (c * 24 * 60 * 60 * 1000)); var b = "; expires=" + d.toGMTString() } else { var b = "" } document.cookie = e + "=" + a + b + "; path=/" }

function eraseCookie(a) { createCookie(a, "", -1) }

function ClickBackOld() { eraseCookie("changebeta");
    $.get(DomainConfig.AjaxDomain + "/Handlers/CountOnline/SubCountOnline.ashx", function(a) { location.reload() }) }

function hoverSlider(a) { a.find(".swiper-button-next").hover(function() { if (!($(this).hasClass("swiper-button-disabled"))) { $(this).parent().parent().find(".swiper-container-horizontal ul").addClass("str-right-hover") } }, function() { $(this).parent().parent().find(".swiper-container-horizontal ul").removeClass("str-right-hover") });
    a.find(".swiper-button-prev").hover(function() { if (!($(this).hasClass("swiper-button-disabled"))) { $(this).parent().parent().find(".swiper-container-horizontal ul").addClass("str-left-hover") } }, function() { $(this).parent().parent().find(".swiper-container-horizontal ul").removeClass("str-left-hover") }) }

function clickSlider(a) { a.find(".swiper-button-next").on("click", function() { if ($(this).hasClass("swiper-button-disabled")) { $(this).parent().parent().find(".swiper-container-horizontal ul").removeClass("str-right-hover") } });
    a.find(".swiper-button-prev").on("click", function() { if ($(this).hasClass("swiper-button-disabled")) { $(this).parent().parent().find(".swiper-container-horizontal ul").removeClass("str-left-hover") } }) }
var changestyle = { init: function() { $(".gbh-menu-list .gmli.expand-icon").click(function(a) { a.stopPropagation(); if ($(".iconmenu").hasClass("active")) { $(".iconmenu").removeClass("active");
                $(".menu-expand-wrapper").fadeOut("medium") } else { $(".iconmenu").addClass("active");
                $(".menu-expand-wrapper").fadeIn("medium") } }); var b;
        $(".gbh-menu-list .gmli.expand-icon").on("mouseenter", function(a) { b = setTimeout(function() { a.stopPropagation();
                $(".iconmenu").addClass("active");
                $(".menu-expand-wrapper").fadeIn("medium") }, 300) }).on("mouseleave", function(a) { clearTimeout(b);
            a.stopPropagation();
            $(".iconmenu").removeClass("hidden") });
        $(".ghw-bottom-header").hover(function() {}, function(a) { a.stopPropagation();
            $(".iconmenu").removeClass("active");
            $(".menu-expand-wrapper").fadeOut("medium") }); var c = this;
        $(window).load(function() { c.change() });
        $(window).resize(function() { c.change() });
        $(window).scroll(function() { c.change() }); if ($(window).height() > 600) { var f = $(window).scrollTop(); if (f > $(".ghw-top-header").height()) { $(".ghw-bottom-header").css({ position: " fixed", width: "100%", "z-index": "99999", top: "0" }) } else { $(".ghw-bottom-header").css({ position: " relative", width: "100%", "z-index": "99999", top: "0" }) } $("#genk-detail-toolbar").hide() } else { var e = $(".genk-body-wrapper").offset().top; var d = $(window).scrollTop(); if (d >= e) { $("#genk-detail-toolbar").fadeIn();
                $("#genk-detail-toolbar").css("position", "fixed") } else { $("#genk-detail-toolbar").fadeOut();
                $("#genk-detail-toolbar").css("position", "absolute") } } }, change: function() { $(".kscli-list .ksclili").eq(1).css("height", $(".kscli-list .ksclili:first-of-type .ksclili-ava").height() - 113 - 27 + "px");
        $(".ktnc-list .ktncli").eq(1).css("height", $(".ktnc-list .ktncli:first-of-type .ktncli-ava").height() - 113 - 27 + "px");
        $(".knswli.video .knswli-object-wrapper").width($(window).width()); if ($(window).width() < 1010) { $(".knswli.video .knswli-object-wrapper").css("margin-left", "0") } else { $(".knswli.video .knswli-object-wrapper").css("margin-left", -($(window).width() - 1040) / 2 - 5 + "px") } }, menuscroll: function() { $(window).scroll(function() { if ($(window).height() > 600) { var a = $(window).scrollTop(); if (a > $(".ghw-top-header").height()) { $(".ghw-bottom-header").css({ position: " fixed", width: "100%", "z-index": "99999", top: "0" }) } else { $(".ghw-bottom-header").css({ position: " relative", width: "100%", "z-index": "99999", top: "0" }) } $("#genk-detail-toolbar").hide() } else { var c = $(".genk-body-wrapper").offset().top; var b = $(window).scrollTop(); if (b >= c) { $("#genk-detail-toolbar").fadeIn();
                    $("#genk-detail-toolbar").css("position", "fixed") } else { $("#genk-detail-toolbar").fadeOut();
                    $("#genk-detail-toolbar").css("position", "absolute") } } }) } };

function HoverAndActiveMenu2() { var c = $("#hdNewsUrl").val(); var a = ""; if (typeof c != "undefined") { a = c.split("/")[1] } else { a = window.location.pathname.split("/")[1] } var b = $("#hdCatUrl").val(); if (typeof b != "undefined") { a = b } if (a.length > 0) { a = a.replace(".chn", ""); if (a == "dien-thoai" || a == "may-tinh-bang") { $('ul.gbh-menu-list li.gmli a[href*="mobile.chn"]').addClass("active2") } else { if (a == "digital-marketing" || a == "media") { $('ul.gbh-menu-list li.gmli a[href*="internet.chn"]').addClass("active2") } else { if (a == "lich-su" || a == "tri-thuc") { $('ul.gbh-menu-list li.gmli a[href*="kham-pha.chn"]').addClass("active2") } else { $('ul.gbh-menu-list li.gmli a[href*="' + a + '.chn"]').addClass("active2") } } } } }

function SearchControl() { if ($("#searchinput").val() != "" && $(".textsearch").hasClass("show-search")) { searchPress() } else { if (flag == false) { $("#btnSearch").addClass("active");
            $(".textsearch").toggleClass("show-search", 100);
            $("#searchinput").focus();
            flag = true } else { $("#btnSearch").removeClass("active");
            flag = false } } }

function getLikeShareCount(b, a) { $.ajax({ type: "GET", dataType: "json", url: "https://sharefb.cnnd.vn/?urls=" + b, success: function(c) { $.each(c, function(i, j) { var h = j.url; var k = $(".item-fb-loaded[rel*='" + h + "']"); if (j.total_count > 0) { k.html(j.total_count);
                    k.show() } else { k.html("0");
                    k.hide() } }) } }) }

function getLikeShareCountDetail(b, a) { $.ajax({ type: "GET", dataType: "json", url: "https://sharefb.cnnd.vn/?urls=" + b, success: function(c) { $.each(c, function(f, d) { var e = $(a); if (d.total_count > 0) { e.html(d.share_count);
                    e.show() } else { e.html("0") } }) } }) }

function GetBeforeAfter() { $(".VCCSortableInPreviewMode[type=BeforeAfter]").each(function() { photoDetail.isStop = true;
        $(this).beforeAfter({ animateIntro: true, imagePath: "https://genknews.genkcdn.vn/images/", introDuration: 100, linkDisplaySpeed: 500, introPosition: parseFloat($(this).attr("position-percent")), showFullLinks: true, title: decodeURIComponent($(this).attr("title")), cursor: "e-resize", enableKeyboard: true, beforeLinkText: "&nbsp;&nbsp; TrÆ°á»›c", afterLinkText: "Sau &nbsp;&nbsp;", beforeDate: $(this).attr("before-date"), afterDate: $(this).attr("after-date"), imageWidth: $(this).attr("w"), imageHeight: $(this).attr("h") });
        $('.balinks a[target="_blank"]').removeAttr("target") }) }

function putElemntToCenter(a) { var c = a.outerWidth(); var b = $("div.sp-detail div.sp-detail-maincontent div.sp-detail-content").width();
    a.css({ "margin-left": ((b - c) / 2) + "px" }) }

function getcountCommentDetail(a) { $.ajax({ url: sDomain + "/ajax-countcomentvietid.chn", data: { sortUrl: a }, success: function(b) { b = isNaN(parseInt(b)) ? 0 : parseInt(b); if (b != null) { $(".countdetaicomment").text(String.format("{0}", b)) } } }) }

function captionGalleryWidth() { $(".VCSortableInPreviewMode[type=Photo]").each(function() { var a = "auto"; if ($(this).find("img").length > 0) { a = $(this).find("img").width() - 20 } $(this).find(".PhotoCMS_Caption").css({ width: a, margin: "auto" }); if ($(this).find(".PhotoCMS_Caption").find("p").length == 0 && $(this).find(".PhotoCMS_Caption").text() == "") { $(this).find(".PhotoCMS_Caption").css("padding", "0") } }) }

function jsFlashPlayer() { GetFlashPlayer = function(a) { if (window.document[a]) { return window.document[a] } if (navigator.appName.indexOf("Microsoft Internet") == -1) { if (document.embeds && document.embeds[a]) { return document.embeds[a] } } return document.getElementById(a) } }

function callnext(c, b, f, e) { var d = GetFlashPlayer(f);
    d.callnext(c);
    d.callback(b) }

function setCookieMobileRedirect(a, c, f) { var e = new Date();
    e.setTime(e.getTime() + (f * 24 * 60 * 60 * 1000)); var b = "expires=" + e.toUTCString();
    document.cookie = a + "=" + c + "; " + b }

function CheckMobileRedirect() { try { if (typeof(Storage) !== "undefined") { var a = sessionStorage.getItem("VisitSession"); if (a == null) { sessionStorage.setItem("VisitSession", "1"); var c = window.location.hash; if (c == "#first") {} else { setCookieMobileRedirect("browser", "", -1); if (navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry|Windows Phone|webOS)/i) != null) { window.location = window.location.href } } } else {} } } catch (b) { console.log("Lá»—i check mobile redirect: " + b) } }

function loadcountfacebook() { if (arrNewsId != "") { getLikeShareCount(arrNewsId, elementId) } }

function facebookAppConfig() { window.fbAsyncInit = function() { FB.init({ appId: "180276625471433", xfbml: true, version: "v2.3" });
        likePopup() };
    (function(e, b, a) { var c, f = e.getElementsByTagName(b)[0]; if (e.getElementById(a)) { return } c = e.createElement(b);
        c.id = a;
        c.src = "//connect.facebook.net/vi_VN/all.js";
        f.parentNode.insertBefore(c, f) }(document, "script", "facebook-jssdk")) }

function loadFirstPageDetail() { var a = $(window);
    a.scroll(function() { var c = $(".klw-new-content").height(); var b = $(".klw-new-content").offset().top; var d = b + c / 2; var e = $(window).scrollTop(); if (e >= d) { getData() } }) }
var flagload = true;

function getData() { if (flagload === false) { return } flagload = false;
    $.ajax({ url: "/ajax-first.chn", dataType: "html", beforeSend: function() { $("#IconLoadListDetail").css("display", "block");
            $(".wrapperbtn").remove() }, success: function(a) { $("#loadTimeLineFisrtPage").append(a) } }) }

function ProcessVideo() { videoHD.isAd = true;
    videoHD.init("#ContentDetail", { type: videoHD.videoType.newsDetail });
    videoInContent.init(".knc-content") }

function AddAdmicroForVideo() { var b = "0;0;0;0"; try { b = admParamTvc(0) } catch (c) { console.log("Loi video moi:" + c) } var a = "&admparam=" + b;
    $("#ContentDetail .VCSortableInPreviewMode[type=Video]").each(function() { var f = $(this).find("object"); var e = $(f).attr("id"); var d = '<iframe width="640" height="360" frameborder="0" allowfullscreen="" scrolling="no" src="https://vscc.hosting.mediacdn.vn/embed/' + e + "?layout=&mouseauto=true" + a + '" id="' + e + '" data-layout="first-scroll"></iframe>';
        $(this).empty();
        $(this).html(d) }) }

function viewByDateDetail() { $("#viewbydate").click(function(j) { var c = $(".kscli-view-by-date #ksclivbdf-date").val() + ""; var a = $(".kscli-view-by-date #ksclivbdf-month").val() + ""; var g = $(".kscli-view-by-date #ksclivbdf-year").val() + ""; if (c == "0" || a == "0" || g == "0") { alert("Báº¡n cáº§n nháº­p ngÃ y thÃ¡ng cáº§n xem. HÃ£y thá»­ láº¡i"); return } try { var h = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/; var f = c + "/" + a + "/" + g; var i = 1902; var b = (new Date()).getFullYear(); if (regs = f.match(h)) { if (regs[1] < 1 || regs[1] > 31) { alert("GiÃ¡ trá»‹ ngÃ y khÃ´ng Ä‘Ãºng: " + regs[1]); return } else { if (regs[2] < 1 || regs[2] > 12) { alert("GiÃ¡ trá»‹ thÃ¡ng khÃ´ng Ä‘Ãºng: " + regs[2]); return } else { if (regs[3] < i || regs[3] > b) { alert("GiÃ¡ trá»‹ nÄƒm khÃ´ng Ä‘Ãºng: " + regs[3] + " - pháº£i náº±m trong khoáº£ng " + i + " vÃ  " + b); return } } } switch (a) {
                    case "4":
                    case "6":
                    case "9":
                    case "11":
                        if (c > 30) { alert('KhÃ´ng tá»“n táº¡i ngÃ y: "' + c + "/" + a + "/" + g + '". HÃ£y thá»­ láº¡i'); return } break;
                    case "2":
                        var d = parseFloat(g) % 4 == 0; if (c > (d ? 29 : 28)) { alert('KhÃ´ng tá»“n táº¡i ngÃ y: "' + c + "/" + a + "/" + g + '". HÃ£y thá»­ láº¡i'); return } break } } else { alert('KhÃ´ng tá»“n táº¡i ngÃ y: "' + c + "/" + a + "/" + g + '". HÃ£y thá»­ láº¡i'); return } var k = "/" + $("#hdZoneUrl").val() + "/" + c + "-" + a + "-" + g + ".chn";
            location.href = k } catch (j) { alert('KhÃ´ng tá»“n táº¡i ngÃ y: "' + c + "/" + a + "/" + g + '". HÃ£y thá»­ láº¡i') } }) }

function stickyAdmAll() { $(window).load(function() { if ($(window).height() < 600) { $("#advZoneSticky").css("margin", "0 auto");
            $("#admzone962").css("float", "left") } });
    $(window).scroll(function() { if ($(window).height() < 600) { $("#advZoneSticky").css("margin", "0 auto");
            $("#admzone962").css("float", "left") } }) }

function home_lazyload() { $("img.lazy").lazyload({ effect: "fadeIn" });
    $(document).ajaxStop(function() { $("img.lazy").lazyload({ effect: "fadeIn" }).removeClass("lazy") }) }

function getCountView() { var a = ""; var b = 0;
    $(".item-view").each(function() { var c = ($(this).attr("rel")); if (b == 0) { a += c } else { a += ";" + c } b++ }); if (b < 1) { return } $.ajax({ url: sDomain + "/Handlers/GetViewCountAdtech.ashx", data: ({ command: "adtechviewcountgetlist", lstNewsIds: a }), dataType: "json", type: "POST", beforeSend: function() {}, success: function(c) { if (c.Success) { var d = JSON.parse(c.Data);
                $.each(d, function(g, e) { var f = $(".item-view[rel*='" + e.newsId + "']"); var i = e.total_view.view_pc + e.total_view.view_mob; var h = numeral(i).format("0,0a").replace(",", "."); if (i > 0) { f.html(h);
                        f.removeClass("item-view") } }) } }, error: function(c) { console.log(c) } }) }(runinit = window.runinit || []).push(function() {
    function d(j) { var h, i, f; var g = document.getElementById("searchinput"); if (j && j.clipboardData && j.clipboardData.types && j.clipboardData.getData) { h = j.clipboardData.types; if (((h instanceof DOMStringList) && h.contains("text/html")) || (h.indexOf && h.indexOf("text/html") !== -1)) { i = j.clipboardData.getData("text/html");
                b(g, i);
                j.stopPropagation();
                j.preventDefault(); return false } } f = document.createDocumentFragment(); while (g.childNodes.length > 0) { f.appendChild(g.childNodes[0]) } a(g, f); return true }

    function a(f, g) { if (f.childNodes && f.childNodes.length > 0) { var e = f.innerHTML;
            f.innerHTML = "";
            f.appendChild(g);
            b(f, e) } else { setTimeout(function() { a(f, g) }, 20) } }

    function b(i, h) { var g = document.getElementById("searchinput"); var f = c(h); var e = f.replace(/\s\s+/g, " ");
        g.innerText = e;
        i.focus() }

    function c(f) { var e = "" + f;
        e = e.replace(/&nbsp;/gi, " ");
        e = e.replace(/&amp;/gi, "&");
        e = e.replace(/&quot;/gi, '"');
        e = e.replace(/&lt;/gi, "<");
        e = e.replace(/&gt;/gi, ">");
        e = e.replace(/<br>/gi, " ");
        e = e.replace(/<br\s\/>/gi, " ");
        e = e.replace(/<br\/>/gi, " ");
        e = e.replace(/<p.*>/gi, " ");
        e = e.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, " $2 ");
        e = e.replace(/<script.*>[\w\W]{1,}(.*?)[\w\W]{1,}<\/script>/gi, " ");
        e = e.replace(/<script.*src\s*=\s*[\"']?([^\"']+)[\"']?[^\<>]/gi, "$1");
        e = e.replace(/<style.*>[\w\W]{1,}(.*?)[\w\W]{1,}<\/style>/gi, " ");
        e = e.replace(/<style.*src\s*=\s*[\"']?([^\"']+)[\"']?[^\<>]/gi, "$1");
        e = e.replace(/<(?:.|\s)*?>/g, " ");
        e = e.replace(/(?:(?:\r\n|\r|\n)\s*){2,}/gim, " ");
        e = e.replace(/ +(?= )/g, " ");
        e = e.replace(/</gi, "");
        e = e.replace(/>/gi, ""); return e } $(function() { var e = document.getElementById("searchinput"); if (e != null) { if (e.addEventListener) { e.addEventListener("paste", d, false) } else { e.attachEvent("onpaste", d) } } }) });

function loadJsCommon() { changestyle.init();
    changestyle.menuscroll();
    HoverAndActiveMenu2(); var b = false;
    $("#searchinput").click(function(c) { c.stopPropagation() });
    $("#btnSearch").click(function(c) { c.stopPropagation(); if ($("#searchinput").text() != "" && $(".textsearch").hasClass("show-search")) { searchPress() } else { if (b == false) { $("#btnSearch").addClass("active");
                $(".textsearch").toggleClass("show-search", 100);
                $("#searchinput").focus();
                b = true } else { $("#btnSearch").removeClass("active");
                $(".textsearch").removeClass("show-search");
                b = false } } });
    $("body").click(function() { if ($(".textsearch").hasClass("show-search")) { $(".textsearch").removeClass("show-search");
            b = false; return } });
    $("#btnSearchFooter").click(function() { ValidateSearchFooter() }); if ($("#LoadListCate li[pr-position]").length > 0) { var a = $("#LoadListCate li[pr-position]").attr("id");
        $('#LoadListCate li.knswli[id="' + a + '"]').not("[pr-position]").remove() } }

function loadJsAsync(b, d) { var a = document.getElementsByTagName("head")[0]; var c = document.createElement("script");
    c.type = "text/javascript";
    c.async = true; if (typeof d == "function") { c.onreadystatechange = c.onload = function() { d() } } c.src = b; if ($('head script[scr="' + b + '"]').length == 0) { a.appendChild(c) } }

function checkRunInit() { if (typeof runinit != "undefined" && runinit.length >= 1) { runinit[0](); var b = runinit.length; var c = []; for (var a = 1; a < b; a++) { c.push(runinit[a]) } runinit = c } window.setTimeout(function() { checkRunInit() }, 100) } checkRunInit();
var catchupLabel = { PageIndex: 1, init: function() { var a = this;
        $(".block-header .c span.sp2").html(totalTagItem);
        $(".genk-label .sel-option").hover(function() { $(".genk-label .sel-option").addClass("open") }, function() { $(".genk-label .sel-option").removeClass("open") });
        $(window).scroll(function() { a.positonHeader() });
        a.formatTimeAgo();
        a.loadlisttimeline();
        relatedNews.initTimelinePoppup() }, positonHeader: function() { var a = this; var c = $(window).width() < 1280 ? "660px" : "700px"; var b = $(".block-header").next().offset().top - 40; if ($(window).scrollTop() > b) { $(".block-header").css({ position: "fixed", top: 0, width: c }).next().css({ "margin-top": "40px" });
            $(".block-header .c").show();
            $(".ghw-bottom-header").hide() } else { $(".block-header").css({ position: "relative", top: "" }).next().css({ "margin-top": "0px" });
            $(".block-header .c").hide();
            $(".ghw-bottom-header").show() } var d = null;
        $(".cc").each(function() { var h = $(this); var g = parseFloat($(window).scrollTop() - $(".genk-label").offset().top); var f = parseFloat(h.offset().top - $(".genk-label").offset().top); if (f < g + 100) { d = h } }); if (d != null) { $(".block-header .c span.sp1").html($(d).attr("data-sort")) } }, formatTimeAgo: function() { var a = $(".kcnwn-meta.date-time");
        a.timeago() }, loadlisttimeline: function() { timeLine.placeholder = ".load-list-tags";
        timeLine.checkPage = "tags";
        timeLine.init() }, reorderListNews: function(b, c, d) { var e = this;
        $.cookie("catchup" + d, b, { expires: 7, path: "/" }); var f = $("#hdPageUrlAjax").val() != null ? $("#hdPageUrlAjax").val() : "";
        timeLine.flag = true;
        timeLine.url = f;
        timeLine.sortItem = b;
        timeLine.placeholder = ".load-list-tags";
        timeLine.getData(e.PageIndex); if (c == "Má»›i nháº¥t") { $(".sel-option > span").html("Má»›i nháº¥t") } else { $(".sel-option > span").html("CÅ© nháº¥t") } var a = $(".block-header").next().offset().top - 40; if ($(window).scrollTop() > a) { $("html, body").animate({ scrollTop: $(".block-header").next().offset().top - 40 }, 600) } $(".genk-label .sel-option").removeClass("open") } };
var boxDanhChoBan = function() { var a = 5; var b = function(e, f) { var g = parseInt(e);
        $(".nhipdapthitruong").data("page", g + 1);
        $(".nhipdapthitruong .page").html((g + 1) + "/" + parseInt($(".nhipdapthitruong").data("totalPage"))); var c = $("#ChinhSachMoi li"); if (f) { for (var d = g * a; d < (g + 1) * a; d++) { $(c[d]).show() } } else { $("#ChinhSachMoi").fadeOut("fast", function() { $("#ChinhSachMoi li").hide(); for (var h = g * a; h < (g + 1) * a; h++) { $(c[h]).show();
                    $("#ChinhSachMoi").fadeIn() } }) } }; return { init: function() { boxDanhChoBan.bindDataForyou(25) }, nextPage: function() { var d = parseInt($(".nhipdapthitruong").data("page")) + 1; var c = $(".nhipdapthitruong").data("totalPage"); if (d <= c) { b(d - 1) } }, prevPage: function() { var c = parseInt($(".nhipdapthitruong").data("page")) - 1; if (c >= 1) { b(c - 1) } }, bindDataForyou: function(d) { var c = ""; try { var f = new RegExp(/__uid\:([0-9]+)/); var c = f.exec(decodeURIComponent(getCookie("__uif")))[1] } catch (g) {} c = c || "1509518141984318107";
            $.ajax({ url: "http://nspapi.aiservice.vn/request/client?guid=" + c + "&domain=GenK&boxid=4&url=" + window.location.href + "&numnews=" + d, dataType: "text", success: function(t) { if (t != null && t != "undefined" && t != "") { var p; var s = ""; var j = $.parseJSON(t.replace("GenK_Box_4=", "")); var h = "show-popup visit-popup"; for (var m = 0; m < j.listnews.length; m++) { p = j.listnews[m]; var e = p.type; var n = ' ispopup="1"'; if (e > 3) { h = "";
                                n = ' ispopup="0"' } var o = p.title.replace(/"/g, "&quot;"); var q = p.url.replace("http://genk.vn", "").replace("https://genk.vn", ""); var r = m > 1 ? " after" : ""; var k = "";
                            s += '<li data-newsid="' + p.id + '" class="item' + r + '" ' + n + ">";
                            s += '<h3><a data-box="dbl-ngang" data-popup-url="' + q + '" class="' + h + '" href="' + q + '" title="' + o + '" >' + o + "</a>" + k + "</h3>"; if (m <= 1) { if (p.image.indexOf(".gif") != -1) { s += '<a data-box="dbl-ngang" data-popup-url="' + q + '" class="' + h + ' knswa_border fr" href="' + q + '" title="' + o + '"><img class="lazy" data-original=""' + p.image.replace("zoom/75_75", "zoom/80_80") + '" src="' + p.image + '.png" alt="' + o + '" title="' + o + '" /></a>' } else { s += '<a data-box="dbl-ngang" data-popup-url="' + q + '" class="' + h + ' knswa_border fr" href="' + q + '" title="' + o + '"><img src="' + p.image.replace("zoom/75_75", "zoom/80_80") + '" alt="' + o + '" title="' + o + '" /></a>' } } s += "</li>" } $("#ChinhSachMoi").html(s); var l = $(".nhipdapthitruong li").length;
                        $(".nhipdapthitruong").data("page", 1).data("totalPage", Math.ceil(parseFloat(l) / a)).find(".page").html("1/" + Math.ceil(parseFloat(l) / a));
                        $(".nhipdapthitruong .b-up").click(function() { boxDanhChoBan.prevPage() });
                        $(".nhipdapthitruong .b-down").click(function() { boxDanhChoBan.nextPage() });
                        $("#ChinhSachMoi li").hide();
                        b(parseInt($(".nhipdapthitruong").data("page")) - 1, 1);
                        $("#ChinhSachMoi").attr("algid", j.algid);
                        $("#ChinhSachMoi").attr("boxid", j.boxid);
                        $("#ChinhSachMoi").attr("dspid", j.dspid);
                        setTimeout(function() { try { sendLogRecommend("ChinhSachMoi") } catch (i) {} }, 500); var u = $(".docnhieuandcauchuyenthuonghieu .nhipdapthitruong").height();
                        $(".docnhieuhomel").css("max-height", u);
                        $(".docnhieuhomel").css("height", u) } }, error: function() {} }) }, bindListDataForyou: function(g, c, f) { var h = ""; try { var d = new RegExp(/__uid\:([0-9]+)/); var h = d.exec(decodeURIComponent(getCookie("__uif")))[1] } catch (i) {} h = h || "1509518141984318107";
            $.ajax({ url: "http://nspapi.aiservice.vn/request/client?guid=" + h + "&domain=GenK&boxid=4&url=" + window.location.href + "&numnews=" + g, dataType: "text", success: function(r) { if (r != null && r != "undefined" && r != "") { var j; var t = ""; var q = $.parseJSON(r.replace("GenK_Box_4=", "")); var n = "show-popup visit-popup"; for (var m = 0; m < q.listnews.length; m++) { j = q.listnews[m]; var k = j.type; var o = ' ispopup="1"'; if (k > 3) { n = "";
                                o = ' ispopup="0"' } var l = j.title.replace(/"/g, "&quot;"); var e = j.url.replace("http://genk.vn", "").replace("https://genk.vn", ""); var p = m > 1 ? " after" : ""; var s = ""; if (m > 0) { t += '<li data-newsid="' + j.id + '" class="cc item' + p + '" ' + o + ' data-sort="' + parseInt(m + 1) + '">'; if (j.image.indexOf(".gif") != -1) { t += '<a data-popup-url="' + e + '" data-box="" class="' + n + '" href="' + e + '" title="' + l + '"><img width="250" height="155" class="lazy" data-original=""' + j.image.replace("zoom/75_75", "zoom/250_155") + '" src="' + j.image.replace("zoom/75_75", "zoom/250_155") + '.png" alt="' + l + '" title="' + l + '" /></a>' } else { t += '<a data-popup-url="' + e + '" data-box="" class="' + n + '" href="' + e + '" title="' + l + '"><img width="250" height="155" src="' + j.image.replace("zoom/75_75", "zoom/250_155") + '" alt="' + l + '" title="' + l + '" /></a>' } t += '<h3><a data-popup-url="' + e + '" data-box="" class="' + n + '" href="' + e + '" title="' + l + '" >' + l + "</a></h3>";
                                t += '<span class="note1"><a href="' + j.catHref + '" class="knswli-category" title="' + j.catName + '">' + j.catName + '</a> - <span class="kcnwn-meta date-time pl0 knswli-time" title="' + j.publishDate + '">' + getTimeAgo(j.publishDate) + '</span></span><p class="knswli-right">' + j.des + "</p>";
                                t += "</li>" } else { t += '<li data-newsid="' + j.id + '" class="clearfix top-item cc  item' + p + '" ' + o + ' data-sort="' + parseInt(m + 1) + '">'; if (j.image.indexOf(".gif") != -1) { t += '<a data-popup-url="' + e + '" data-box="" class="' + n + '" href="' + e + '" title="' + l + '"><img  width="700" height="430" class="lazy" data-original=""' + j.image.replace("zoom/75_75", "zoom/700_430") + '" src="' + j.image.replace("zoom/75_75", "zoom/250_155") + '.png" alt="' + l + '" title="' + l + '" /></a>' } else { t += '<a data-popup-url="' + e + '" data-box="" class="' + n + '" href="' + e + '" title="' + l + '"><img  width="700" height="430" src="' + j.image.replace("zoom/75_75", "zoom/700_430") + '" alt="' + l + '" title="' + l + '" /></a>' } t += '<div class="description"> <div class="big-desc"><h3><a data-popup-url="' + e + '" data-box="" class="title-new-cate ' + n + '" href="' + e + '" title="' + l + '" >' + l + "</a></h3></div>";
                                t += '<span class="time-new kcnwn-meta date-time">' + getTimeAgo(j.publishDate) + "</span>";
                                t += "</div></li>" } } $("#lstForYou").html(t);
                        $("#lstForYou").attr("algid", q.algid);
                        $("#lstForYou").attr("boxid", q.boxid);
                        $("#lstForYou").attr("dspid", q.dspid);
                        setTimeout(function() { try { sendLogRecommend("lstForYou") } catch (u) {} }, 500) } }, error: function() {} }) } } }();

function setCookieByDay(a, c, f) { var e = new Date();
    e.setTime(e.getTime() + (f * 24 * 60 * 60 * 1000)); var b = "expires=" + e.toUTCString();
    document.cookie = a + "=" + c + "; " + b }

function DeleteCookie(a) { setCookieByDay(a, "", -1) }

function ClickBeta() { setCookieByDay("viewtest", 1, 60);
    location.reload() }

function setHeightBoxMosViewAndCmh() { var a = 0;
    $(function() { a = $(".mostviewandnhipdap .mostview").height();
        $(".thuonghieur").css("max-height", a);
        $(".thuonghieur").css("height", a) }) }

function getTimeAgo(f) { f = f * 1000; var e = new Date(); var c = "1 phÃºt trÆ°á»›c"; if (e.getTime() > f) { var a = e.getTime() - f; if (a >= 86400000) { var b = a / 1000;
            b = b / 3600;
            b = b / 24;
            c = Math.floor(b) + " ngÃ y trÆ°á»›c" } if (a < 86400000 && a >= 3600000) { var b = a / 1000;
            b = b / 3600;
            c = Math.floor(b) + " giá» trÆ°á»›c" } if (a < 3600000 && a >= 60000) { var b = a / 1000;
            b = b / 60;
            c = Math.floor(b) + " phÃºt trÆ°á»›c" } } return c };
$(document).ready(function() { trackEventGA.init() });
var trackEventGA = { init: function() { if (typeof ga == "undefined") { return } var b = $("#hdZoneUrl").val(); var a = $("#hdParentUrl").val(); if ($("#hdNewsId").val() != null && b != null) { if (a != null && a != "") { ga("send", "event", "TotalCategory_" + a, window.location.href, a) } else { ga("send", "event", "TotalCategory_" + b, window.location.href, b) } } if ($("#hdZoneId").val() != null && b != null) { if (a != null && a != "") { ga("send", "event", "TotalCategory_" + a, window.location.href, a) } else { ga("send", "event", "TotalCategory_" + b, window.location.href, b) } } }, stream: function(a, b, c) { ga("send", "event", "Stream" + a + "_" + b, "load page " + c, b) } };
var HomeSilder = { init: function() { var b = new Swiper(".klwfnsw", { slidesPerView: "auto", pagination: ".klwfn-slide-wrapper .swiper-pagination", nextButton: ".klwfn-slide-wrapper .swiper-button-next", prevButton: ".klwfn-slide-wrapper .swiper-button-prev", slidesPerGroup: 2, simulateTouch: true, speed: 600, hashNav: true, preventClicks: false, preventClicksPropagation: false, paginationClickable: true });
        hoverSlider($(".klwfn-slide-wrapper"));
        clickSlider($(".klwfn-slide-wrapper")); var a = new Swiper(".kdsdsk-wrapper", { slidesPerView: "auto", nextButton: ".kdsdsk-wrapper .swiper-button-next", prevButton: ".kdsdsk-wrapper .swiper-button-prev", pagination: ".kdsdsk-wrapper .swiper-pagination", slidesPerGroup: 2, simulateTouch: true, speed: 600, hashNav: true, paginationClickable: true, preventClicks: false, preventClicksPropagation: false });
        hoverSlider($(".kdsdsk-wrapper"));
        clickSlider($(".kdsdsk-wrapper")); var c = new Swiper(".knswlivr-wrapper-slide", { nextButton: ".kvli-next", prevButton: ".kvli-prev", slidesPerView: "auto", slidesPerGroup: 4, direction: "vertical" }) } };

function loadHomeBoxVideo() { $(".knswli-video-list li").each(function() { $(this).click(function() { var b = $(this).attr("data-url");
            $("#object_iframeGenkNews").attr("src", b);
            $("#object_iframeGenkNews iframe").attr("src", b);
            $(".knswli-video-list li").removeClass("playing"); var a = $(this).attr("data-time");
            $("#admBoxListtime_between span").html(a);
            $(this).addClass("playing") }) }) }

function addViewPlusHome() { var h = $('<div id="admzone42585"></div>'); var g = $(".kds-new-stream-wrapper .knsw-list").first().find(".shownews")[1]; if (g != null) { $(g).after(h);
        admicroAD.unit.push(function() { admicroAD.show("admzone42585") }) } var f = $('<div id="admzone42586"></div>'); var a = $(".kds-new-stream-wrapper .knsw-list").first().find(".shownews")[6]; if (a != null) { $(a).after(f);
        admicroAD.unit.push(function() { admicroAD.show("admzone42586") }) } var b = $('<div id="admzone42587"></div>'); var c = $(".kds-new-stream-wrapper .knsw-list").first().find(".shownews")[14]; if (c != null) { $(c).after(b);
        admicroAD.unit.push(function() { admicroAD.show("admzone42587") }) } var d = $('<div id="admzone42588"></div>'); var e = $(".kds-new-stream-wrapper .knsw-list").first().find(".shownews")[22]; if (e != null) { $(e).before(d);
        admicroAD.unit.push(function() { admicroAD.show("admzone42588") }) } };
/* Copyright (c) 2011 Piotr Rochala (http://rocha.la)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.8
 *
 */
(function(a) { a.fn.extend({ slimScrollOnlyDrag: function(d) { var c = { width: "auto", height: "250px", size: "7px", color: "#000", position: "right", distance: "1px", start: "top", opacity: 0.4, alwaysVisible: false, disableFadeOut: false, railVisible: false, railColor: "#333", railOpacity: 0.2, railDraggable: true, railClass: "slimScrollRail", barClass: "slimScrollBar", wrapperClass: "slimScrollDiv", allowPageScroll: false, wheelStep: 20, touchScrollStep: 200, borderRadius: "7px", railBorderRadius: "7px" }; var b = a.extend(c, d);
            this.each(function() { var A, z, r, f, g, i, q, E, w = "<div></div>",
                    C = 30,
                    x = false; var e = a(this); if (e.parent().hasClass(b.wrapperClass)) { var j = e.scrollTop();
                    B = e.siblings("." + b.barClass);
                    y = e.siblings("." + b.railClass);
                    l(); if (a.isPlainObject(d)) { if ("height" in d && d.height == "auto") { e.parent().css("height", "auto");
                            e.css("height", "auto"); var D = e.parent().parent().height();
                            e.parent().css("height", D);
                            e.css("height", D) } else { if ("height" in d) { var o = d.height;
                                e.parent().css("height", o);
                                e.css("height", o) } } if ("scrollTo" in d) { j = parseInt(b.scrollTo) } else { if ("scrollBy" in d) { j += parseInt(b.scrollBy) } else { if ("destroy" in d) { B.remove();
                                    y.remove();
                                    e.unwrap(); return } } } n(j, false, true) } return } else { if (a.isPlainObject(d)) { if ("destroy" in d) { return } } } b.height = (b.height == "auto") ? e.parent().height() : b.height; var u = a(w).addClass(b.wrapperClass).css({ position: "relative", overflow: "hidden", width: b.width, height: b.height });
                e.css({ overflow: "hidden", width: b.width, height: b.height }); var y = a(w).addClass(b.railClass).css({ width: b.size, height: "100%", position: "absolute", top: 0, display: (b.alwaysVisible && b.railVisible) ? "block" : "none", "border-radius": b.railBorderRadius, background: b.railColor, opacity: b.railOpacity, zIndex: 90 }); var B = a(w).addClass(b.barClass).css({ background: b.color, width: b.size, position: "absolute", top: 0, opacity: b.opacity, display: b.alwaysVisible ? "block" : "none", "border-radius": b.borderRadius, BorderRadius: b.borderRadius, MozBorderRadius: b.borderRadius, WebkitBorderRadius: b.borderRadius, zIndex: 99 }); var m = (b.position == "right") ? { right: b.distance } : { left: b.distance };
                y.css(m);
                B.css(m);
                e.wrap(u);
                e.parent().append(B);
                e.parent().append(y); if (b.railDraggable) { B.bind("mousedown", function(h) { var F = a(document);
                        r = true;
                        t = parseFloat(B.css("top"));
                        pageY = h.pageY;
                        F.bind("mousemove.slimscroll", function(G) { currTop = t + G.pageY - pageY;
                            B.css("top", currTop);
                            n(0, B.position().top, false) });
                        F.bind("mouseup.slimscroll", function(G) { r = false;
                            k();
                            F.unbind(".slimscroll") }); return false }).bind("selectstart.slimscroll", function(h) { h.stopPropagation();
                        h.preventDefault(); return false }) } y.hover(function() { p() }, function() { k() });
                B.hover(function() { z = true }, function() { z = false });
                e.hover(function() { A = true;
                    p();
                    k() }, function() { A = false;
                    k() });
                e.bind("touchstart", function(F, h) { if (F.originalEvent.touches.length) { g = F.originalEvent.touches[0].pageY } });
                e.bind("touchmove", function(F) { if (!x) { F.originalEvent.preventDefault() } if (F.originalEvent.touches.length) { var h = (g - F.originalEvent.touches[0].pageY) / b.touchScrollStep;
                        n(h, true);
                        g = F.originalEvent.touches[0].pageY } });
                l(); if (b.start === "bottom") { B.css({ top: e.outerHeight() - B.outerHeight() });
                    n(0, true) } else { if (b.start !== "top") { n(a(b.start).position().top, null, true); if (!b.alwaysVisible) { B.hide() } } } v(this);

                function s(G) { return; if (!A) { return } var G = G || window.event; var F = 0; if (G.wheelDelta) { F = -G.wheelDelta / 120 } if (G.detail) { F = G.detail / 3 } var h = G.target || G.srcTarget || G.srcElement; if (a(h).closest("." + b.wrapperClass).is(e.parent())) { n(F, true) } if (G.preventDefault && !x) { G.preventDefault() } if (!x) { G.returnValue = false } }

                function n(F, J, H) { x = false; var I = F; var G = e.outerHeight() - B.outerHeight(); if (J) { I = parseInt(B.css("top")) + F * parseInt(b.wheelStep) / 100 * B.outerHeight();
                        I = Math.min(Math.max(I, 0), G);
                        I = (F > 0) ? Math.ceil(I) : Math.floor(I);
                        B.css({ top: I + "px" }) } q = parseInt(B.css("top")) / (e.outerHeight() - B.outerHeight());
                    I = q * (e[0].scrollHeight - e.outerHeight()); if (H) { I = F; var h = I / e[0].scrollHeight * e.outerHeight();
                        h = Math.min(Math.max(h, 0), G);
                        B.css({ top: h + "px" }) } e.scrollTop(I);
                    e.trigger("slimscrolling", ~~I);
                    p();
                    k() }

                function v(h) { if (window.addEventListener) { h.addEventListener("DOMMouseScroll", s, false);
                        h.addEventListener("mousewheel", s, false) } else { document.attachEvent("onmousewheel", s) } }

                function l() { i = Math.max((e.outerHeight() / e[0].scrollHeight) * e.outerHeight(), C);
                    B.css({ height: i + "px" }); var h = i == e.outerHeight() ? "none" : "block";
                    B.css({ display: h }) }

                function p() { l();
                    clearTimeout(f); if (q == ~~q) { x = b.allowPageScroll; if (E != q) { var h = (~~q == 0) ? "top" : "bottom";
                            e.trigger("slimscroll", h) } } else { x = false } E = q; if (i >= e.outerHeight()) { x = true; return } B.stop(true, true).fadeIn("fast"); if (b.railVisible) { y.stop(true, true).fadeIn("fast") } }

                function k() { if (!b.alwaysVisible) { f = setTimeout(function() { if (!(b.disableFadeOut && A) && !z && !r) { B.fadeOut("slow");
                                y.fadeOut("slow") } }, 1000) } } }); return this } });
    a.fn.extend({ slimscroll: a.fn.slimScroll }) })(jQuery);
var wechoicePlaylist = { isfirstTime: true, init: function() { var b = this;
        $.ajax({ type: "GET", dataType: "json", url: "http://decuapi.wechoice.vn/Handlers/ApiGetDataStream.ashx?token=asdaisjLHOWENKLNoi092347osjdfdfslkjwwe95845&removeaward=1,5,9,10,11,13,14,20", success: function(d) { if (d.Success) { var c = "<li class='wechoice-video-item' data-src='{4}'>                                <div class='wvi-info clearfix'>                                <div class='wvii-ava'>                                <img src='{0}'>                                </div>                                <div class='wvii-info'>                                <div class='wvii-info-table'>                                <div class='wvii-info-table-cell'>                                <a href='javascript:;' title='{2}' class='wviii-link'>                                <span>{2}</span>                                </a>                                <span class='wviii-vote'>{3} vote</span>                                </div>                                </div>                                </div>                                <a target='_blank' rel='nofollow' href='{1}' class='wca-profile-link clearfix'>                                <b>vote</b>                                <i>                                <svg width='7' height='7' viewBox='0 0 7 7'>                                <path d='M6.2,3.5H7V7H0V0H3.5V.8H.8V6.2H6.2ZM7,0V2.7H6.2V1.3L3.9,3.7l-.5-.5L5.7.8H4.3V0Z' fill='#fff'></path>                                </svg>                                </i>                                </a>                                </div>                                </li>"; var e = "";
                    $.each(d.Data, function(f, g) { e += String.format(c, g.AvatarImg, g.DetailUrl, g.Member_FullName, a(g.VoteCount), g.Member_Job2) });
                    $(".list-wechoice-video li").remove();
                    $(".list-wechoice-video").append(e);
                    $(".list-wechoice-video .wechoice-video-item").unbind("click");
                    $(".list-wechoice-video .wechoice-video-item").click(function(f) { $(".list-wechoice-video .wechoice-video-item.nowPlaying").removeClass("nowPlaying"); var i = $(this);
                        i.addClass("nowPlaying"); var g = i.attr("data-src"); if (b.isfirstTime) { g = g.replace("autoplay=true", "autoplay=false");
                            b.isfirstTime = false } var h = $(g);
                        h.attr("playtype", 0);
                        i.attr("data-id", h.attr("id"));
                        $(".wechoice-video-playlist .iframe-wraper iframe").remove();
                        $(".wechoice-video-playlist .iframe-wraper").append(h);
                        videoInContentWeChoice.init(".wechoice-video-playlist .iframe-wraper") });
                    $(".list-wechoice-video .wechoice-video-item").first().click();
                    addListenVideoEnd();
                    $(".wca-header-cat-link a").attr("href", "http://wechoice.vn" + d.ExData.AwardUrl);
                    $(".wca-header-cat-link a").attr("title", d.ExData.AwardName);
                    $(".wca-header-cat-link a").text(d.ExData.AwardName);
                    $(".wechoice-video-playlist").removeClass("hidden");
                    setTimeout(function() { var f = $(".wechoice-right-header").outerHeight();
                        $(".wechoice-right-scroll").css("top", f) }, 500);
                    $(".list-wechoice-video").slimScrollOnlyDrag({ height: "100%", alwaysVisible: true }) } } });

        function a(c) { c += "";
            x = c.split(".");
            x1 = x[0];
            x2 = x.length > 1 ? "." + x[1] : ""; var d = /(\d+)(\d{3})/; while (d.test(x1)) { x1 = x1.replace(d, "$1,$2") } return x1 + x2 } } };

function addListenVideoEnd() { window.addEventListener ? window.addEventListener("message", function(c) { a(c) }, !1) : window.attachEvent && window.attachEvent("onmessage", function(c) { a(c) });

    function a(d) { if (-1 != d.origin.indexOf("vcplayer.vcmedia.vn") || -1 != d.origin.indexOf("123.31.11.105") || -1 != d.origin.indexOf("vcplayer.mediacdn.vn")) { if ("string" == typeof d.data && (-1 != d.data.indexOf("admBoxListVideo.onEndedVideo"))) { try { var e = d.data.replace('admBoxListVideo.onEndedVideo("', "").replace('")', ""); if (nextVideoPlaylist) { nextVideoPlaylist(e) } } catch (c) {} } } } }

function nextVideoPlaylist(a) { var c = $(".list-wechoice-video li[data-id=" + a + "]"); if (c.length > 0) { var b = c.next(); if (b.length > 0) { b.click() } else { $(".list-wechoice-video .wechoice-video-item").first().click() } } else { $(".list-wechoice-video .wechoice-video-item").first().click() } }
var videoInContentWeChoice = { isFullscreen: false, init: function(b) { if (detectmob()) { return } var a = this; var c = "webkitfullscreenchange mozfullscreenchange fullscreenchange MSFullscreenChange";
        $(document).on(c, function() { a.changeIsFullscreen() }); var d = $(b).find('iframe[src*="vcplayer.vcmedia.vn"][playType=0], iframe[src*="123.31.11.105"][playType=0], iframe[src*="vcplayer.mediacdn.vn"][playType=0]');
        d.each(function(i, e) { var j = $(this); var g = false,
                h = true; var f;
            $(window).scroll(function(k) { if (f) { window.clearTimeout(f);
                    f = null } var o = j.parents(".VCSortableInPreviewMode"); var m = j.attr("id"); var n = j.attr("data-playstatus");
                g = n === "playing"; var l = isElementVisible(document.getElementById(m)); if (l == "play") { if (!g && !a.isFullscreen) { if (h) { h = false;
                            setTimeout(function() { o.find(".loading-vid-icon").hide();
                                admPlayProgress(o) }, 300) } else { if ($.inArray("#" + m, readyVideoIds) >= 0) { a.playVideo(j) } else { if ($.inArray(m, waitingVideoIdForReady) < 0) { waitingVideoIdForReady.push("#" + m) } } } g = true } } else { if (l == "pause") { clearTimeout(f);
                        setTimeout(function() { if (g && !a.isFullscreen) { a.stopVideo(j);
                                g = false;
                                h = false } }, 0) } } }) }) }, playVideo: function(g) { var f = this; var e = $(g);
        f.stopAllVideo(); var a = isElementVisible(document.getElementById(e.attr("id"))); if (a == "play") { var c = e.attr("id");
            e.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").hide(); var b = document.getElementById(c); if (b) { e.attr("data-playstatus", "playing"); var d = { action: "request", method: "play" }; if (b.contentWindow) { b.contentWindow.postMessage(d, "*") } } } }, stopVideo: function(a) { var c = $(a);
        c.parents(".VCSortableInPreviewMode").find(".pause-vd-notify").show(); var d = c.attr("id"); var e = document.getElementById(d);
        c.attr("data-playstatus", "stopping"); if (e) { var b = { action: "request", method: "pause" }; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, hideControlBar: function(a) { var c = $(a); var d = c.attr("id"); var e = document.getElementById(d); if (e) { var b = 'admReviceMessageToPlayer("hidecontrolbar")'; if (e.contentWindow) { e.contentWindow.postMessage(b, "*") } } }, getCurrentTime: function(f, d) { var e = $(f); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", cid: d }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } }, setCurrentTime: function(a, b) { var c = $(a);
        c.attr("src", c.attr("src") + "&currentTime=" + b);
        waitingVideoIdForReady.push("#" + c.attr("id")) }, seekCurrentTime: function(g, d) { var f = this; var e = $(g); var c = e.attr("id"); var b = document.getElementById(c); if (b) { var a = { action: "request", method: "currentTime", args: [d] }; if (b.contentWindow) { b.contentWindow.postMessage(a, "*") } } setTimeout(function() { f.playVideo(g) }, 100) }, stopAllVideo: function() { var a = this;
        $('iframe[src*="vcplayer.vcmedia.vn"], iframe[src*="123.31.11.105"], iframe[src*="vcplayer.mediacdn.vn"]').each(function() { var b = $(this);
            a.stopVideo("#" + b.attr("id"));
            b.attr("data-playstatus", "stopping") }) }, changeIsFullscreen: function() { var a = this;
        a.isFullscreen = !a.isFullscreen } };