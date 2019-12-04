
(function(W) {
    W().registerPlugin("nhac", "6.0", function(e, F, G) {
        function W() {
            var a = H.getElementsByClassName("jw-icon-playback")[0];
            void 0 != a && (void 0 == P && (P = document.createElement("div"), P.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-back-song", P.onclick = function() {
                var a = e.getPlaylist(),
                    b = e.getPlaylistIndex();
                0 == b ? e.playlistItem(a.length - 1) : e.playlistItem(b - 1)
            }, a.parentNode.insertBefore(P, a)), void 0 == Q && (Q = document.createElement("div"), Q.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-next-song",
                Q.onclick = function() {
                    var a = e.getPlaylist();
                    B.length >= a.length && (B.length = 0);
                    if (R) {
                        var b = e.getPlaylistIndex();
                        z = b == a.length - 1 ? 0 : b + 1
                    } else {
                        do z = Math.floor(Math.random() * a.length); while (-1 < B.indexOf(z))
                    }
                    0 > B.indexOf(z) && B.push(z);
                    e.playlistItem(z)
                }, a.parentNode.insertBefore(Q, a.nextSibling)));
            a = H.getElementsByClassName("stringQ")[0];
            void 0 != a && (void 0 == I && (I = document.createElement("div"), I.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-repeat-all", I.onclick = function() {
                "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-repeat-all" ==
                I.className ? (I.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-repeat-one", T = !0) : (I.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-repeat-all", T = !1)
            }, a.parentNode.insertBefore(I, a)), void 0 == J && (J = document.createElement("div"), J.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-sequence", J.onclick = function() {
                "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-sequence" == J.className ? (J.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-shuffle",
                    R = !1) : (J.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-sequence", R = !0)
            }, a.parentNode.insertBefore(J, a)))
        }

        function J() {
            if (void 0 == w.showAutoNext || w.showAutoNext) {
                if (void 0 == D) {
                    var a = E.getElementsByClassName("jw-icon-hd")[0];
                    void 0 != a && (D = document.createElement("div"), D.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-on", D.onclick = function() {
                        "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-on" == D.className ? (D.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-off",
                        "function" === typeof onPlayerAutoNextOff && onPlayerAutoNextOff()) : (D.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-on", "function" === typeof onPlayerAutoNextOn && onPlayerAutoNextOn())
                    }, a.parentNode.insertBefore(D, a))
                }
                void 0 == K && (a = E.getElementsByClassName("jw-icon-playback")[0], void 0 != a && (K = document.createElement("div"), K.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-nextsong", K.onclick = function() {
                    "function" === typeof onPlayerAutoNext &&
                    onPlayerAutoNext()
                }, a.parentNode.insertBefore(K, a.nextSibling)))
            }
        }

        function ia() {
            if (void 0 == x) {
                var a = H.getElementsByClassName("stringQ")[0];
                void 0 != a && (x = document.createElement("div"), x.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric", x.onclick = function() {
                    "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric" == x.className ? (x.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric jw-toggle jw-off",
                        r.style.visibility = "hidden") : (x.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric", r.style.visibility = "visible")
                }, a.parentNode.insertBefore(x, a.nextSibling))
            }
        }

        function U(a) {
            if (!O)
                if (null != e.getConfig().captionsTrack && 0 < e.getConfig().captionsTrack.cues.length) {
                    O = !0;
                    a = e.getConfig().captionsTrack.cues;
                    var d = !1;
                    if (2 < a.length) {
                        var b = a[0].text,
                            q = a[1].text.toLowerCase();
                        if (0 <= q.indexOf("s\u00e1ng t\u00e1c") || 0 <= q.indexOf("ca s\u0129") || 0 <= q.indexOf("tr\u00ecnh b\u00e0y") || 0 <= q.indexOf("th\u1ec3 hi\u1ec7n") ||
                            0 <= q.indexOf("nh\u1ea1c s\u0129")) d = !0, a[0].startTime = 0;
                        0 <= b.indexOf("B\u00e0i h\u00e1t: ") && 53 < b.length && (a[0].text = a[0].text.replace("B\u00e0i h\u00e1t: ", ""), a[1].text = a[1].text.replace("Ca s\u0129: ", ""), a[1].text = a[1].text.replace("Nh\u1ea1c s\u0129: ", ""))
                    }
                    if (F.resounded)
                        for (b = 1; b < a.length + 1; b++) {
                            q = a[b - 1].text;
                            var c = (q.match(/([\s]+)/g) || []).length + 1,
                                n = a[b - 1].endTime - a[b - 1].startTime,
                                f = n / c,
                                g = 0,
                                m = "|";
                            b < a.length && (g = a[b].startTime - a[b - 1].endTime);
                            if (3 >= b && F.lyric_debug || 0 <= q.toLowerCase().indexOf("nhac.vn")) 10 >
                            b ? 10 > n ? console.log("@@@ ", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q) : console.log("@@@ ", b, n.toFixed(1), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q) : console.log("@@@", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q);
                            if (3 < b && 0 > q.toLowerCase().indexOf("nhac.vn")) {
                                var l = a[b - 1].startTime - a[b - 2].endTime,
                                    h = a[b - 2].startTime - a[b - 3].endTime,
                                    t = (a[b - 2].text.match(/([\s]+)/g) || []).length + 1,
                                    w = a[b - 2].endTime - a[b - 2].startTime,
                                    p = w / t,
                                    u = n - p * c,
                                    y = 0;
                                if (1 <= u || .9 < g) m = "$";
                                F.lyric_debug && (10 > b ?
                                    10 > n ? console.log("@@@ ", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q, "/", u.toFixed(3)) : console.log("@@@ ", b, n.toFixed(1), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q, "/", u.toFixed(3)) : console.log("@@@", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q, "/", u.toFixed(3)));
                                2.5 < u || .8 < u && 1.199 <= g && .9899 <= f ? y = 5 : 2 < u || 1.2 < u && 1 < f || 1.1 < g && .9 < f ? y = 4 : 1.5 < u || 1.1 < u && .7 < f || 1 < g && 1.2 < u ? y = 3 : 1.8 < g && .7 < f || 3.1 < g && .44 < f && 0 == l && 0 == h || 3.2 < g && .6 < f && 0 == l || 10 < g && .5 < f && .1 > l && .1 > h || 20 < g && .48 < f && .2 > l && .2 >
                                h ? y = 4.9 < g && .7 < f && 0 == l ? 4 : 3 : 2.09 < g && .59 < f || 2.2 < g && .6 < f || 1.68 < g && .72 < f || 1.69 < g && .6 < f && .2 > l || 1.1 < g && .4 < f && .1 > l || .5 < g && .7 < f && .1 > l ? y = .7 < u ? 3 : 2 : 1.1 < u || 1 < u && .58 < f || 2 <= g && .8 < f ? y = 2 : 1 < u || 2 <= g && .49 < f ? y = 1 : .5 < u && .79 < f && (F.lyric_debug && (console.log("---", n.toFixed(3), "/", c, "=", f.toFixed(3), "|", g.toFixed(2)), console.log("---", w.toFixed(3), "/", t, "=", p.toFixed(3)), console.log("---", p.toFixed(3), "*", c, "=", (p * c).toFixed(3), "/", n.toFixed(3), "-", (p * c).toFixed(3), "=", u.toFixed(3))), y = 1);
                                5 == y ? (q = q.substr(q.length - 1), a[b -
                                1].text += q + q + "....") : 4 == y ? a[b - 1].text += "...." : 3 == y ? a[b - 1].text += "..." : 2 == y ? a[b - 1].text += ".." : 1 == y && (a[b - 1].text += ",");
                                F.lyric_debug && 0 < y && console.log(" ->", a[b - 1].text, f, "|", g, y)
                            }
                        }
                    A = -1;
                    k = [{
                        startTime: 0,
                        text: ""
                    }];
                    b = a[0].startTime;
                    !d && "" != C && 2 < b && (d = {}, 4 < b ? (d.text = X, d.startTime = 0, d.endTime = a[0].startTime / 2 - .5, k.push(d), k.push({
                        startTime: a[0].startTime / 2,
                        text: ""
                    }), d = {}, d.text = "Ca s\u0129: " + Y, d.startTime = a[0].startTime / 2, d.endTime = a[0].startTime - .5, k.push(d)) : (d.text = X + " - " + Y, d.startTime = 0, d.endTime =
                        a[0].startTime - .5, k.push(d)), k.push({
                        startTime: a[0].startTime,
                        text: ""
                    }));
                    for (b = 0; b < a.length; b++) k.push(a[b]), k.push({
                        startTime: a[b].endTime,
                        text: ""
                    }), F.resounded && b < a.length - 1 && (n = a[b + 1].startTime - a[b].endTime, 10 < n && (d = {}, 30 < n ? (d.text = "5 4 3 2 1", d.startTime = a[b + 1].startTime - 2) : 20 < n ? (d.text = "4 3 2 1", d.startTime = a[b + 1].startTime - 1.5) : (d.text = "3 2 1", d.startTime = a[b + 1].startTime - 1), d.endTime = a[b + 1].startTime - .5, k.push(d), k.push({
                        startTime: a[b + 1].startTime,
                        text: ""
                    })));
                    Z();
                    ia();
                    void 0 !== x && null != e.getConfig().captionsTrack &&
                    (aa = "visible", r.style.visibility = "visible", x.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric")
                } else ba(a)
        }

        function ja(a) {
            U("firstFrame2")
        }

        function ka(a) {
            if (void 0 == D) {
                a = H.getElementsByClassName("jw-icon-hd")[0];
                if (void 0 == a) return;
                D = a.getElementsByClassName("jw-option")
            }
            1 == D.length && (a = D[0], "128K" == a.innerHTML ? ea("320K (Login)", 320) : "128 kbps" == a.innerHTML && ea("320 kbps (Login)", 320));
            U("firstFrame")
        }

        function ea(a, d) {
            var b = document.createElement("li");
            b.className = "jw-text jw-option jw-item-1 jw-reset";
            b.innerHTML = a;
            b.onclick = function() {
                ca = !0;
                "function" === typeof onPlayerLoginVip && onPlayerLoginVip(d)
            };
            var c = D[D.length - 1];
            c.parentNode.insertBefore(b, c.nextSibling)
        }

        function fa(a) {
            var d = e.getCurrentQuality(),
                b = H.getElementsByClassName("jw-icon-hd")[0];
            void 0 != b && (v = b.className, 0 < v.indexOf("jw-icon-hd-128") && (v = v.substring(0, v.indexOf("jw-icon-hd-128") - 1)), 0 < v.indexOf("jw-icon-hd-320") && (v = v.substring(0, v.indexOf("jw-icon-hd-320") - 1)), a = a[d].label.toLowerCase(), "320k" == a ? b.className = v + " jw-icon-hd-320" :
                "128k" == a && (b.className = v + " jw-icon-hd-128"))
        }

        function ba(a) {
            a = e.getConfig().playlistItem.tracks;
            void 0 != a && 0 < a.length && void 0 != a[0].file && 0 == e.getCurrentCaptions() && e.setCurrentCaptions(1)
        }

        function la() {
            if ("visible" === aa) {
                var a = r.clientWidth,
                    d = Math.pow(a / 420, .6),
                    b = c.fontSize * d;
                h.style.maxWidth = a + "px";
                h.style.fontSize = Math.round(b) + "px";
                h.style.lineHeight = Math.round(1.4 * b) + "px";
                h.style.position = "relative";
                t.style.maxWidth = a + "px";
                t.style.fontSize = Math.round(b) + "px";
                t.style.lineHeight = Math.round(1.4 *
                    b) + "px";
                t.style.position = "relative";
                t.style.display = "inline-block";
                t.style.margin = "0px";
                t.style.padding = "0px";
                w.style.maxWidth = a + "px";
                w.style.fontSize = Math.round(b) + "px";
                w.style.lineHeight = Math.round(1.4 * b) + "px";
                w.style.position = "relative";
                w.style.display = "inline-block";
                w.style.margin = "14px 0";
                m.style.color = "#21b685";
                m.style.position = "absolute";
                m.style.top = "0px";
                m.style.left = "0px";
                m.style.overflow = "hidden";
                m.style.whiteSpace = "nowrap";
                m.style.textShadow = "-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black";
                m.style.lineHeight = Math.round(1.4 * b) + "px";
                l.style.color = "#21b685";
                l.style.position = "absolute";
                l.style.top = "0px";
                l.style.left = "0px";
                l.style.overflow = "hidden";
                l.style.whiteSpace = "nowrap";
                l.style.textShadow = "-1px 0 black, 0 1px black, 1px 0 black, 0 -1px black";
                l.style.lineHeight = Math.round(1.4 * b) + "px";
                c.windowOpacity && (K.style.padding = Math.round(5 * d) + "px", K.style.borderRadius = Math.round(5 * d) + "px")
            }
        }

        function ha(a, d, b) {
            if (!(L && 3 < M)) {
                var c = a.text,
                    h = d.text;
                d = /<br\s*[\/]?>/gi;
                var n = !1;
                c = (c || "").replace(d,
                    " ");
                h = h.replace(d, " ");
                if ("" !== c && "" !== h) {
                    if (b) {
                        c != m.innerHTML && (m.style.width = "0%", m.innerHTML = c, t.innerHTML = c);
                        if (L || !n && ("" === l.innerHTML || N)) n = !0, L && (L = !1), l.style.width = "0%", l.innerHTML = h, w.innerHTML = h;
                        t.appendChild(m)
                    } else N && (m.innerHTML = h, t.innerHTML = h, l.innerHTML = c, w.innerHTML = c), w.appendChild(l);
                    if (c.length) {
                        setTimeout(la, 16);
                        var f = 1,
                            g = 0;
                        var p = Math.round(1E3 * (a.endTime - a.startTime) / 50);
                        N && (f = (M - a.startTime) * p / (a.endTime - a.startTime));
                        var r = setInterval(function() {
                                if ("paused" != e.getState())
                                    if (g =
                                        f / p * 100, 100 < g && (g = 100), M < a.startTime || Math.floor(M) > Math.ceil(a.endTime) || !O) clearInterval(r), A >= k.length - 1 && (m.style.width = "100%", l.style.width = "100%", t.appendChild(m), w.appendChild(l));
                                    else if (b ? (!n && f > p / 3 && A < k.length - 2 && (n = !0, l.style.width = "0%", l.innerHTML = h, w.innerHTML = h), m.style.width = g + "%") : (!n && f > p / 3 && A < k.length - 2 && (n = !0, m.style.width = "0%", m.innerHTML = h, t.innerHTML = h), l.style.width = g + "%"), f++, f >= p + 1 || N) clearInterval(r), b ? A < k.length - 1 && (l.style.width = "0%") : A < k.length - 1 && (m.style.width = "0%")
                            },
                            50)
                    }
                }
            }
        }

        function Z() {
            for (var a = -1, c = 0; c < k.length; c++)
                if (k[c].startTime <= M && (c === k.length - 1 || k[c + 1].startTime >= M)) {
                    a = c;
                    break
                }
            if (-1 === a) ha("");
            else if (a !== A) {
                A = a;
                c = !0;
                0 == (a + 1) / 2 % 2 && (c = !1);
                var b = A < k.length - 2 ? k[a + 2] : k[a - 2];
                N && "" === k[a].text && "" === b.text && (A = a = a < k.length - 1 ? a + 1 : a - 1, c = 0 == (a + 1) / 2 % 2 ? !1 : !0, b = A < k.length - 2 ? k[a + 2] : k[a - 2]);
                ha(k[a], b, c)
            }
        }

        function da(a) {
            a = String(a).replace("#", "");
            3 === a.length && (a = a[0] + a[0] + a[1] + a[1] + a[2] + a[2]);
            return "#" + a.substr(-6)
        }

        function V(a, c) {
            var b = "rgb",
                d = [parseInt(a.substr(1,
                    2), 16), parseInt(a.substr(3, 2), 16), parseInt(a.substr(5, 2), 16)];
            void 0 !== c && 100 !== c && (b += "a", d.push(c / 100));
            return b + "(" + d.join(",") + ")"
        }
        "undefined" !== typeof GoPerformance && "function" === typeof GoPerformance && GoPerformance(e, F, G);
        var Q, P, x, I, J, H, D, c, k, p, E, r, K, h, t, m, w, l, A, aa = "visible",
            N = !1,
            S = -1,
            T = !1,
            R = !0,
            z = -1,
            B = [0],
            ca = !1,
            O = !1,
            L = !1,
            C, X, Y, v;
        e.onReady(function(a) {
            H = e.getContainer();
            G.style.position = "absolute";
            G.style.top = "0px";
            G.style.width = "100%";
            G.style.height = "100%";
            G.style.overflow = "hidden";
            G.style.pointerEvents =
                "none";
            ba("onReady")
        });
        e.onBeforePlay(function(a) {
            a = H.getElementsByClassName("jw-title-primary")[0];
            void 0 != a && (C = a.innerHTML, 0 > C.indexOf("<font") && 0 < C.indexOf(" - ") && (X = C.split(" - ")[0], Y = C.split(" - ")[1], C = C.replace(" - ", " - <font color='#6a8385'>"), C += "</font>", a.innerHTML = C));
            a = e.getConfig().playlistItem.thumb;
            void 0 != a ? E.src = a : void 0 != e.getConfig().playlistItem.image && (E.src = e.getConfig().playlistItem.image)
        });
        e.on("meta", function(a) {
            W();
            U("onMeta")
        });
        e.on("levels", function(a) {
            fa(a.levels)
        });
        e.on("visualQuality", function(a) {
            void 0 == D && (D = H.getElementsByClassName("jw-icon-hd")[0].getElementsByClassName("jw-option"));
            "auto" != a.mode && "auto" != a.reason || e.setCurrentQuality(a.level.index);
            0 < D.length && (a = D[0], "Auto" == a.innerHTML && (a.className = "jw-hidden"))
        });
        e.on("beforeComplete", function(a) {
            if (T) S = e.getPlaylistIndex();
            else if (!R) {
                a = e.getPlaylist();
                B.length >= a.length && (B.length = 0);
                do z = Math.floor(Math.random() * a.length); while (-1 < B.indexOf(z));
                0 > B.indexOf(z) && B.push(z);
                S = z
            }
        });
        e.on("playlistItem",
            function(a) {
                O = !1;
                L = !0;
                m.innerHTML = "";
                t.innerHTML = "";
                l.innerHTML = "";
                w.innerHTML = "";
                (T || !R) && 0 <= S && (a = S, S = -1, e.playlistItem(a));
                aa = "hidden";
                r.style.visibility = "hidden";
                void 0 !== x && (x.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric jw-toggle jw-reset jw-hidden");
                ba("playlistItem")
            });
        if (void 0 === F.showVIP || !1 === F.showVIP) e.on("firstFrame", ja);
        else e.on("firstFrame", ka);
        e.on("levelsChanged", function(a) {
            fa(a.levels);
            ca && (ca = !1, e.setCurrentQuality(0))
        });
        e.on("time", function(a) {
            O &&
            (M = a.position, k && Z());
            O || (a = e.getConfig().playlistItem.tracks, void 0 != a && 0 < a.length && void 0 != a[0].file && U("onTime"))
        });
        e.on("seek", function(a) {
            N = !0;
            L && 1 > a.position && (L = !1);
            m.style.width = "0%";
            l.style.width = "0%"
        });
        e.on("seeked", function(a) {
            N = !1
        });
        this.resize = function(a, c) {};
        (function() {
            p = document.createElement("div");
            p.style.display = "block";
            p.style.position = "relative";
            p.style.width = "260px";
            p.style.height = "260px";
            p.style.top = "20px";
            p.style.left = "20px";
            p.style.overflow = "hidden";
            p.style.boxShadow = "5px 5px 5px rgba(0,0,0,0.5)";
            p.style.zIndex = "1";
            G.appendChild(p);
            E = document.createElement("img");
            E.style.position = "absolute";
            E.style.left = "50%";
            E.style.top = "50%";
            E.style.height = "100%";
            E.style.width = "auto";
            E.style.transform = "translate(-50%,-50%)";
            p.appendChild(E);
            c = e.getCaptions();
            void 0 == c.color && (c.color = "#FFFFFF");
            void 0 == c.fontFamily && (c.fontFamily = "Roboto, Arial, sans-serif");
            c.fontOpacity = 100;
            void 0 == c.fontStyle && (c.fontStyle = "normal");
            void 0 == c.fontWeight && (c.fontWeight = "normal");
            void 0 == c.textDecoration && (c.textDecoration =
                "none");
            void 0 == c.edgeStyle && (c.edgeStyle = "uniform");
            void 0 == c.backgroundColor && (c.backgroundColor = "#000");
            void 0 == c.windowColor && (c.windowColor = "#FFFFFF");
            c.fontSize = 17;
            var a = c.fontOpacity,
                d = c.windowOpacity,
                b = c.edgeStyle,
                k = c.backgroundColor,
                x, n = V(da(c.color), a),
                f = c.fontFamily,
                g = c.fontStyle,
                z = c.fontWeight,
                A = c.textDecoration,
                v;
            d && (x = V(da(c.windowColor), d));
            a = V("#000000", a);
            "dropshadow" === b ? v = "0 2px 1px " + a : "raised" === b ? v = "0 0 5px " + a + ", 0 1px 5px " + a + ", 0 2px 5px " + a : "depressed" === b ? v = "0 -2px 1px " +
                a : "uniform" === b && (v = "-2px 0 1px " + a + ",2px 0 1px " + a + ",0 -2px 1px " + a + ",0 2px 1px " + a + ",-1px 1px 1px " + a + ",1px 1px 1px " + a + ",1px -1px 1px " + a + ",1px 1px 1px " + a);
            c.back && V(da(k), c.backgroundOpacity);
            r = document.createElement("div");
            K = document.createElement("div");
            h = document.createElement("div");
            t = document.createElement("p");
            m = document.createElement("span");
            w = document.createElement("p");
            l = document.createElement("span");
            h.appendChild(t);
            h.appendChild(document.createElement("br"));
            h.appendChild(w);
            r.style.display =
                "block";
            r.style.height = "auto";
            r.style.width = "536px";
            r.style.marginLeft = "290px";
            r.style.position = "absolute";
            r.style.top = "90px";
            r.style.textAlign = "center";
            r.style.zIndex = "1";
            K.style.display = "inline-block";
            void 0 != x && (K.style.backgroundColor = x);
            h.style.color = n;
            h.style.display = "inline-block";
            h.style.fontFamily = f;
            h.style.fontStyle = g;
            h.style.fontWeight = z;
            h.style.textAlign = "center";
            h.style.textDecoration = A;
            h.style.wordWrap = "break-word";
            h.style.textShadow = v;
            K.appendChild(h);
            r.appendChild(K);
            G.appendChild(r)
        })();
        var M = 0;
        k && Z()
    })
})(jwplayer);