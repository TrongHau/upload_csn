(function(J) {
    J().registerPlugin("nhac", "6.0", function(e, w, C) {
        function J() {
            if (void 0 == w.showAutoNext || w.showAutoNext) {
                if (void 0 == D) {
                    var a = E.getElementsByClassName("jw-settings-submenu-button")[0];
                    void 0 != a && (D = document.createElement("div"), D.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-on hidden",  a.parentNode.insertBefore(D, a))
                }
                var a = E.getElementsByClassName("jw-icon-playback")[0];
                void 0 != a && (void 0 == P && (P = document.createElement("div"), P.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-backsong", P.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-back" viewBox="0 0 16 16"><path class="zp-svg-fill" fill="#BEBEBE" fill-rule="nonzero" d="M2 2v12h1.98V2H2zm3.48 6L14 14V2L5.48 8z"></path></svg>', P.onclick = function () {
                    "function" === typeof onPlayerAutoBack &&
                    onPlayerAutoBack()
                }, a.parentNode.insertBefore(P, a)), void 0 == Q && (Q = document.createElement("div"), Q.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-nextsong", Q.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" class=\"jw-svg-icon jw-svg-icon-next\" viewBox=\"0 0 16 16\"><path class=\"zp-svg-fill\" fill=\"#BEBEBE\" fill-rule=\"nonzero\" d=\"M14 2v12h-1.98V2H14zm-3.48 6L2 14V2l8.52 6z\"></path></svg>", Q.onclick = function () {
                    "function" === typeof onPlayerAutoNext &&
                    onPlayerAutoNext()
                }, a.parentNode.insertBefore(Q, a.nextSibling)));

                var a = E.getElementsByClassName("jw-icon-auto-next-on")[0];
                var notRepeat = '<span class="csn-title-repeat">Không lặp</span><svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-not-repeat" viewBox="0 0 16 16"><path class="zp-svg-fill repeat-all" fill="#BEBEBE" fill-rule="nonzero" d="M2.594 4.983h9.98v1.492l2.287-2.238L12.574 2v1.492H1.762A.76.76 0 0 0 1 4.237v5.695l1.525-1.56V4.984h.07zm10.812 6.034h-9.98V9.525l-2.287 2.238L3.426 14v-1.492h10.812a.76.76 0 0 0 .762-.745V6.068l-1.525 1.56v3.389h-.07z"></path></svg>';
                var repeatOne = '<span class="csn-title-repeat" style="width: 120px">Lặp bài hiện tại</span><svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-repeat-one" viewBox="0 0 16 16"><g fill="#ff3456" fill-rule="nonzero"><path class="zp-svg-fill repeat-one" d="M3.133 5.01h9.6v1.506l2.2-2.258L12.733 2v1.505h-10.4a.75.75 0 0 0-.733.753v5.747l1.467-1.573V5.01h.066zm10.4 6.09h-4.8L7.4 12.605h6.867a.75.75 0 0 0 .733-.752V6.105L13.533 7.68V11.1z"></path><path class="zp-svg-fill repeat-one" d="M4.667 12.81h.866v.616H3.2v-.615h.867v-1.78H3.2v-.615h1.467v2.395zm-.334 1.848C5.8 14.658 7 13.426 7 11.92c0-1.505-1.2-2.737-2.667-2.737-1.466 0-2.666 1.232-2.666 2.737 0 1.505 1.2 2.737 2.666 2.737z"></path></g></svg>';
                var repeatAll = '<span class="csn-title-repeat">Lặp tất cả</span><svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-repeat-all" viewBox="0 0 16 16"><path class="zp-svg-fill repeat-all" fill="#ff3456" fill-rule="nonzero" d="M2.594 4.983h9.98v1.492l2.287-2.238L12.574 2v1.492H1.762A.76.76 0 0 0 1 4.237v5.695l1.525-1.56V4.984h.07zm10.812 6.034h-9.98V9.525l-2.287 2.238L3.426 14v-1.492h10.812a.76.76 0 0 0 .762-.745V6.068l-1.525 1.56v3.389h-.07z"></path></svg>';
                var notClassRepeat = "jw-icon csn-repeat-btn jw-icon-inline jw-button-color jw-reset jw-icon-repeat-not";
                var repeatClassOne = "jw-icon csn-repeat-btn jw-icon-inline jw-button-color jw-reset jw-icon-repeat-one";
                var repeatClassAll = "jw-icon csn-repeat-btn jw-icon-inline jw-button-color jw-reset jw-icon-repeat-all";
                var sequence = '<span class="csn-title-repeat" style="width: 100px">Ngẫu nhiên</span><svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-sequence" viewBox="0 0 16 16"><path class="zp-svg-fill" fill="#BEBEBE" fill-rule="nonzero" d="M4.065 3.492H1v1.491h3.692l1.323 2.034.905-1.424-.418-.61-.975-1.491H4.065zm4.11 6.915l.417.61.975 1.491h3.065V14l2.298-2.237-2.298-2.238v1.492h-2.229L9.08 8.983l-.906 1.424zM12.631 2v1.492H9.567l-.975 1.491-1.045 1.56-.905 1.423-1.95 3.05H1v1.492H5.597l.975-1.491L7.617 9.39l.905-1.424 1.95-2.983h2.23v1.492L15 4.237 12.632 2z"></path></svg>';
                var shuffle = '<span class="csn-title-repeat" style="width: 150px">Không Ngẫu nhiên</span><svg xmlns="http://www.w3.org/2000/svg" class="jw-svg-icon jw-svg-icon-shuffle"  viewBox="0 0 16 16"><path class="zp-svg-fill" fill="#ff3456" fill-rule="nonzero" d="M4.065 3.492H1v1.491h3.692l1.323 2.034.905-1.424-.418-.61-.975-1.491H4.065zm4.11 6.915l.417.61.975 1.491h3.065V14l2.298-2.237-2.298-2.238v1.492h-2.229L9.08 8.983l-.906 1.424zM12.631 2v1.492H9.567l-.975 1.491-1.045 1.56-.905 1.423-1.95 3.05H1v1.492H5.597l.975-1.491L7.617 9.39l.905-1.424 1.95-2.983h2.23v1.492L15 4.237 12.632 2z"></path></svg>';
                void 0 != a && (void 0 == PP && (PP = document.createElement("div"), PP.className = notClassRepeat, PP.innerHTML = notRepeat, PP.onclick = function () {
                    notClassRepeat == PP.className ?
                    (PP.className = repeatClassOne, TT = !0, PP.innerHTML = repeatOne,autoRepeat('one')) :
                    repeatClassOne == PP.className ?
                    (PP.className = repeatClassAll, TT = !1, PP.innerHTML = repeatAll, autoRepeat('all')) :
                    (PP.className = notClassRepeat, TT = !2, PP.innerHTML = notRepeat, autoRepeat('none'))
                }, a.parentNode.insertBefore(PP, a)), void 0 == PPP && (PPP = document.createElement("div"), PPP.className = "jw-icon csn-random-btn jw-icon-inline jw-button-color jw-reset jw-icon-sequence", PPP.innerHTML = sequence, PPP.title = "Ngẫu nhiên", PPP.onclick = function () {
                    "jw-icon csn-random-btn jw-icon-inline jw-button-color jw-reset jw-icon-sequence" == PPP.className ? (PPP.className = "jw-icon csn-random-btn jw-icon-inline jw-button-color jw-reset jw-icon-shuffle",
                        TTT = !1, PPP.innerHTML = shuffle, autoRandom(true)) : (PPP.className = "jw-icon csn-random-btn jw-icon-inline jw-button-color jw-reset jw-icon-sequence", TTT = !0, PPP.innerHTML = sequence, autoRandom(false))
                }, V = document.createElement("div"), V.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-favourite",V.style = 'line-height: 38px;', V.innerHTML = '<span class="csn-title-favourite">Yêu thích bài hát này</span><span class="wishlist toggle_wishlist"><i aria-hidden="true" style="font-size: 18px"  class="fa fa-heart-o"></i></span>', V.onclick = function() { reloadFavourite() },
                a.parentNode.insertBefore(PPP, a), PP.parentNode.insertBefore(V, PP)));
                jwplayer().setConfig({
                    repeat: false
                });
                if(Cookies.set("auto_repeat") == 'one') {
                    jwplayer().setConfig({
                        repeat: true
                    });
                    logPlayAudioFlag = true;
                    PP.className = repeatClassOne;
                    PP.innerHTML = repeatOne;
                }
                if(Cookies.get("auto_repeat") == 'all' || !Cookies.get("auto_repeat")) {
                    jwplayer().setConfig({
                        repeat: false
                    });
                    logPlayAudioFlag = false;
                    PP.className = repeatClassAll;
                    PP.innerHTML = repeatAll;
                }
                if(Cookies.get("auto_repeat") == 'none') {
                    jwplayer().setConfig({
                        repeat: false
                    });
                    Cookies.get("auto_repeat", 'none');
                    logPlayAudioFlag = false;
                }
                if(Cookies.get("auto_random") == 'true') {
                    PPP.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-shuffle";
                    PPP.innerHTML = shuffle;
                }

            }
        }

        function Y() {
            if (void 0 == F) {
                var a = E.getElementsByClassName("jw-settings-submenu-button")[0];
                void 0 != a && (F = document.createElement("div"), F.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric", F.onclick = function() {
                    "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric" == F.className ? (F.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric jw-toggle jw-off", p.style.visibility = "hidden") : (F.className = "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-lyric",
                        p.style.visibility = "visible")
                }, a.parentNode.insertBefore(F, a.nextSibling))
            }
        }
        function M(a) {
            if (!L)
                if (null != e.getConfig().captionsTrack && 0 < e.getConfig().captionsTrack.cues.length) {
                    L = !0;
                    a = e.getConfig().captionsTrack.cues;
                    var d = !1;
                    if (2 < a.length) {
                        var b = a[0].text,
                            q = a[1].text.toLowerCase();
                        if (0 <= q.indexOf("s\u00e1ng t\u00e1c") || 0 <= q.indexOf("ca s\u0129") || 0 <= q.indexOf("tr\u00ecnh b\u00e0y") || 0 <= q.indexOf("th\u1ec3 hi\u1ec7n") || 0 <= q.indexOf("nh\u1ea1c s\u0129")) d = !0, a[0].startTime = 0;
                        0 <= b.indexOf("B\u00e0i h\u00e1t: ") &&
                        53 < b.length && (a[0].text = a[0].text.replace("B\u00e0i h\u00e1t: ", ""), a[1].text = a[1].text.replace("Ca s\u0129: ", ""), a[1].text = a[1].text.replace("Nh\u1ea1c s\u0129: ", ""))
                    }
                    if (w.resounded)
                        for (b = 1; b < a.length + 1; b++) {
                            q = a[b - 1].text;
                            var c = (q.match(/([\s]+)/g) || []).length + 1,
                                n = a[b - 1].endTime - a[b - 1].startTime,
                                f = n / c,
                                g = 0,
                                m = "|";
                            b < a.length && (g = a[b].startTime - a[b - 1].endTime);
                            if (3 >= b && w.lyric_debug || 0 <= q.toLowerCase().indexOf("chiasenhac.vn")) 10 > b ? 10 > n ? console.log("@@@ ", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2),
                                m, q) : console.log("@@@ ", b, n.toFixed(1), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q) : console.log("@@@", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q);
                            if (3 < b && 0 > q.toLowerCase().indexOf("chiasenhac.vn")) {
                                var l = a[b - 1].startTime - a[b - 2].endTime,
                                    h = a[b - 2].startTime - a[b - 3].endTime,
                                    p = (a[b - 2].text.match(/([\s]+)/g) || []).length + 1,
                                    u = a[b - 2].endTime - a[b - 2].startTime,
                                    r = u / p,
                                    t = n - r * c,
                                    x = 0;
                                if (1 <= t || .9 < g) m = "$";
                                w.lyric_debug && (10 > b ? 10 > n ? console.log("@@@ ", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m,
                                    q, "/", t.toFixed(3)) : console.log("@@@ ", b, n.toFixed(1), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q, "/", t.toFixed(3)) : console.log("@@@", b, n.toFixed(2), "/", c, "=", f.toFixed(4), "|", g.toFixed(2), m, q, "/", t.toFixed(3)));
                                2.5 < t || .8 < t && 1.199 <= g && .9899 <= f ? x = 5 : 2 < t || 1.2 < t && 1 < f || 1.1 < g && .9 < f ? x = 4 : 1.5 < t || 1.1 < t && .7 < f || 1 < g && 1.2 < t ? x = 3 : 1.8 < g && .7 < f || 3.1 < g && .44 < f && 0 == l && 0 == h || 3.2 < g && .6 < f && 0 == l || 10 < g && .5 < f && .1 > l && .1 > h || 20 < g && .48 < f && .2 > l && .2 > h ? x = 4.9 < g && .7 < f && 0 == l ? 4 : 3 : 2.09 < g && .59 < f || 2.2 < g && .6 < f || 1.68 < g && .72 < f || 1.69 < g && .6 < f &&
                                .2 > l || 1.1 < g && .4 < f && .1 > l || .5 < g && .7 < f && .1 > l ? x = .7 < t ? 3 : 2 : 1.1 < t || 1 < t && .58 < f || 2 <= g && .8 < f ? x = 2 : 1 < t || 2 <= g && .49 < f ? x = 1 : .5 < t && .79 < f && (w.lyric_debug && (console.log("---", n.toFixed(3), "/", c, "=", f.toFixed(3), "|", g.toFixed(2)), console.log("---", u.toFixed(3), "/", p, "=", r.toFixed(3)), console.log("---", r.toFixed(3), "*", c, "=", (r * c).toFixed(3), "/", n.toFixed(3), "-", (r * c).toFixed(3), "=", t.toFixed(3))), x = 1);
                                5 == x ? (q = q.substr(q.length - 1), a[b - 1].text += q + q + "....") : 4 == x ? a[b - 1].text += "...." : 3 == x ? a[b - 1].text += "..." : 2 == x ? a[b - 1].text +=
                                    ".." : 1 == x && (a[b - 1].text += ",");
                                w.lyric_debug && 0 < x && console.log(" ->", a[b - 1].text, f, "|", g, x)
                            }
                        }
                    z = -1;
                    k = [{
                        startTime: 0,
                        text: ""
                    }];
                    b = a[0].startTime;
                    !d && "" != A && 2 < b && (d = {}, 4 < b ? (d.text = P, d.startTime = 0, d.endTime = a[0].startTime / 2 - .5, k.push(d), k.push({
                        startTime: a[0].startTime / 2,
                        text: ""
                    }), d = {}, d.text = "Ca s\u0129: " + Q, d.startTime = a[0].startTime / 2, d.endTime = a[0].startTime - .5, k.push(d)) : (d.text = P + " - " + Q, d.startTime = 0, d.endTime = a[0].startTime - .5, k.push(d)), k.push({
                        startTime: a[0].startTime,
                        text: ""
                    }));
                    for (b = 0; b < a.length; b++) k.push(a[b]),
                        k.push({
                            startTime: a[b].endTime,
                            text: ""
                        }), w.resounded && b < a.length - 1 && (n = a[b + 1].startTime - a[b].endTime, 10 < n && (d = {}, 30 < n ? (d.text = "5 4 3 2 1", d.startTime = a[b + 1].startTime - 2) : 20 < n ? (d.text = "4 3 2 1", d.startTime = a[b + 1].startTime - 1.5) : (d.text = "3 2 1", d.startTime = a[b + 1].startTime - 1), d.endTime = a[b + 1].startTime - .5, k.push(d), k.push({
                        startTime: a[b + 1].startTime,
                        text: ""
                    })));
                    R();
                    Y();
                    e.setCurrentCaptions(0)
                } else U(a)
        }

        function Z(a) {
            M("firstFrame2")
        }

        function aa(a) {
            if (void 0 == v) {
                a = E.getElementsByClassName("jw-settings-submenu-button")[0];
                if (void 0 == a) return;
                v = a.getElementsByClassName("jw-option")
            }
            1 == v.length && (a = v[0], "128K" == a.innerHTML ? V("320K (Login)", 320) : "128 kbps" == a.innerHTML && V("320 kbps (Login)", 320));
            M("firstFrame")
        }

        function V(a, d) {
            var b = document.createElement("li");
            b.className = "jw-text jw-option jw-item-1 jw-reset";
            b.innerHTML = a;
            b.onclick = function() {
                S = !0;
                "function" === typeof onPlayerLoginVip && onPlayerLoginVip(d)
            };
            var c = v[v.length - 1];
            c.parentNode.insertBefore(b, c.nextSibling)
        }

        function W(a) {
            var d = e.getCurrentQuality(),
                b = E.getElementsByClassName("jw-settings-submenu-button")[0];
            void 0 != b && (void 0 == N && (N = b.className), a = a[d].label.toLowerCase(), "320k" == a ? b.className = N + " jw-icon-hd-320" : "128k" == a && (b.className = N + " jw-icon-hd-128"))
        }

        function U(a) {
            e.getConfig();
            void 0 != e.getConfig().tracks && 0 < e.getConfig().tracks.length && void 0 != e.getConfig().tracks[0].file && e.setCurrentCaptions(1)
        }

        function ba() {
            var a = p.clientWidth,
                d = Math.pow(a / 420, .6),
                b = c.fontSize * d;
            h.style.maxWidth = a + "px";
            h.style.fontSize = Math.round(b) + "px";
            h.style.lineHeight = Math.round(1.4 * b) + "px";
            h.style.position = "relative";
            u.style.maxWidth = a + "px";
            u.style.fontSize = Math.round(b) + "px";
            u.style.lineHeight = Math.round(1.4 * b) + "px";
            u.style.position = "relative";
            u.style.display = "inline-block";
            u.style.margin = "0px";
            u.style.padding = "0px";
            r.style.maxWidth = a + "px";
            r.style.fontSize = Math.round(b) + "px";
            r.style.lineHeight = Math.round(1.4 * b) + "px";
            r.style.position = "relative";
            r.style.display = "inline-block";
            r.style.margin = "14px 0";
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
            c.windowOpacity && (G.style.padding = Math.round(5 * d) + "px", G.style.borderRadius = Math.round(5 * d) + "px")
        }

        function X(a, d, b) {
            var c = a.text,
                h = d.text;
            d = /<br\s*[\/]?>/gi;
            var n = !1;
            c = (c || "").replace(d, " ");
            h = h.replace(d, " ");
            if ("" !== c && "" !== h && (b ? (c != m.innerHTML && (m.style.width = "0%", m.innerHTML = c, u.innerHTML = c), n || "" !== l.innerHTML && !H && L || (n = !0, l.style.width = "0%", l.innerHTML = h, r.innerHTML = h), u.appendChild(m)) : (H && (m.innerHTML = h, u.innerHTML = h, l.innerHTML = c, r.innerHTML = c), r.appendChild(l)), c.length)) {
                setTimeout(ba, 16);
                var f = 1,
                    g = 0;
                var p = Math.round(1E3 * (a.endTime - a.startTime) / 50);
                H && (f = (I - a.startTime) * p / (a.endTime -
                    a.startTime));
                var y = setInterval(function() {
                    if ("paused" != e.getState())
                        if (g = f / p * 100, 100 < g && (g = 100), I < a.startTime || Math.floor(I) > Math.ceil(a.endTime) || !L) clearInterval(y), z >= k.length - 1 && (m.style.width = "100%", l.style.width = "100%", u.appendChild(m), r.appendChild(l));
                        else if (b ? (!n && f > p / 3 && z < k.length - 2 && (n = !0, l.style.width = "0%", l.innerHTML = h, r.innerHTML = h), m.style.width = g + "%") : (!n && f > p / 3 && z < k.length - 2 && (n = !0, m.style.width = "0%", m.innerHTML = h, u.innerHTML = h), l.style.width = g + "%"), f++, f >= p + 1 || H) clearInterval(y),
                            b ? z < k.length - 1 && (l.style.width = "0%") : z < k.length - 1 && (m.style.width = "0%")
                }, 50)
            }
        }

        function R() {
            for (var a = -1, c = 0; c < k.length; c++)
                if (k[c].startTime <= I && (c === k.length - 1 || k[c + 1].startTime >= I)) {
                    a = c;
                    break
                }
            if (-1 === a) X("");
            else if (a !== z) {
                z = a;
                c = !0;
                0 == (a + 1) / 2 % 2 && (c = !1);
                var b = z < k.length - 2 ? k[a + 2] : k[a - 2];
                H && "" === k[a].text && "" === b.text && (z = a = a < k.length - 1 ? a + 1 : a - 1, c = 0 == (a + 1) / 2 % 2 ? !1 : !0, b = z < k.length - 2 ? k[a + 2] : k[a - 2]);
                X(k[a], b, c)
            }
        }

        function T(a) {
            a = String(a).replace("#", "");
            3 === a.length && (a = a[0] + a[0] + a[1] + a[1] + a[2] + a[2]);
            return "#" +
                a.substr(-6)
        }

        function O(a, c) {
            var b = "rgb",
                d = [parseInt(a.substr(1, 2), 16), parseInt(a.substr(3, 2), 16), parseInt(a.substr(5, 2), 16)];
            void 0 !== c && 100 !== c && (b += "a", d.push(c / 100));
            return b + "(" + d.join(",") + ")"
        }
        "undefined" !== typeof GoPerformance && "function" === typeof GoPerformance && GoPerformance(e, w, C);
        var D, K, V, F, E, v, c, k, y, B, p, G, h, u, m, r, l, z, H = !1,
            S = !1,
            TT = !1,
            TTT = !1,
            L = !1,
            A, P, PP, PPP, Q, N;
        e.on('ready', function(a) {
            E = e.getContainer();
            C.style.position = "absolute";
            C.style.top = "0px";
            C.style.width = "100%";
            C.style.height = "100%";
            C.style.overflow = "hidden";
            C.style.pointerEvents = "none";
            U("onReady")
        });
        e.on('beforePlay', function(a) {
            a = E.getElementsByClassName("jw-title-primary")[0];
            void 0 != a && (A = a.innerHTML, 0 > A.indexOf("<font") && 0 < A.indexOf(" - ") && (P = A.split(" - ")[0], Q = A.split(" - ")[1], A = A.replace(" - ", " - <font color='#6a8385'>"), A += "</font>", a.innerHTML = A));
            J();
            a = e.getConfig().playlistItem.thumb;
            void 0 != a ? B.src = a : void 0 != e.getConfig().thumb ? B.src = e.getConfig().thumb : void 0 != e.getConfig().playlistItem.image && (B.src = e.getConfig().playlistItem.image)
        });
        e.on("meta", function(a) {
            M("onMeta")
        });
        e.on("levels", function(a) {
            W(a.levels)
        });
        e.on("visualQuality", function(a) {
            void 0 == v && (v = E.getElementsByClassName("jw-settings-submenu-button")[0].getElementsByClassName("jw-option"));
            "auto" != a.mode && "auto" != a.reason || e.setCurrentQuality(a.level.index);
            0 < v.length && (a = v[0], "Auto" == a.innerHTML && (a.className = "jw-hidden"))
        });
        if (void 0 === w.showVIP || !1 === w.showVIP) e.on("firstFrame", Z);
        else e.on("firstFrame", aa);
        e.on("levelsChanged", function(a) {
            W(a.levels);
            S && (S = !1, e.setCurrentQuality(0))
        });
        e.on("time", function(a) {
            I = a.position;
            k && R();
            L || (a = e.getConfig().playlistItem.tracks, void 0 != a && 0 < a.length && void 0 != a[0].file && M("onTime"))
        });
        e.on("seek", function(a) {
            H = !0;
            m.style.width = "0%";
            l.style.width = "0%"
        });
        e.on("seeked", function(a) {
            H = !1
        });
        this.resize = function(a, c) {};
        (function() {
            y = document.createElement("div");
            y.style.display = "block";
            y.style.position = "relative";
            y.style.width = "260px";
            y.style.height = "260px";
            y.style.top = "20px";
            y.style.left = "20px";
            y.style.overflow = "hidden";
            y.style.boxShadow = "5px 5px 5px rgba(0,0,0,0.5)";
            y.style.zIndex = "1";
            C.appendChild(y);
            B = document.createElement("img");
            B.style.position = "absolute";
            B.style.left = "50%";
            B.style.top = "50%";
            B.style.height = "100%";
            B.style.width = "auto";
            B.style.transform = "translate(-50%,-50%)";
            y.appendChild(B);
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
                w, n = O(T(c.color), a),
                f = c.fontFamily,
                g = c.fontStyle,
                z = c.fontWeight,
                A = c.textDecoration,
                v;
            d && (w = O(T(c.windowColor), d));
            a = O("#000000", a);
            "dropshadow" === b ? v = "0 2px 1px " + a : "raised" === b ? v = "0 0 5px " + a + ", 0 1px 5px " + a + ", 0 2px 5px " + a : "depressed" === b ? v = "0 -2px 1px " +
                a : "uniform" === b && (v = "-2px 0 1px " + a + ",2px 0 1px " + a + ",0 -2px 1px " + a + ",0 2px 1px " + a + ",-1px 1px 1px " + a + ",1px 1px 1px " + a + ",1px -1px 1px " + a + ",1px 1px 1px " + a);
            c.back && O(T(k), c.backgroundOpacity);
            p = document.createElement("div");
            G = document.createElement("div");
            h = document.createElement("div");
            u = document.createElement("p");
            m = document.createElement("span");
            r = document.createElement("p");
            l = document.createElement("span");
            h.appendChild(u);
            h.appendChild(document.createElement("br"));
            h.appendChild(r);
            p.style.display =
                "block";
            p.style.height = "auto";
            p.style.width = "536px";
            p.style.marginLeft = "290px";
            p.style.position = "absolute";
            p.style.top = "90px";
            p.style.textAlign = "center";
            p.style.zIndex = "1";
            G.style.display = "inline-block";
            void 0 != w && (G.style.backgroundColor = w);
            h.style.color = n;
            h.style.display = "inline-block";
            h.style.fontFamily = f;
            h.style.fontStyle = g;
            h.style.fontWeight = z;
            h.style.textAlign = "center";
            h.style.textDecoration = A;
            h.style.wordWrap = "break-word";
            h.style.textShadow = v;
            G.appendChild(h);
            p.appendChild(G);
            C.appendChild(p)
        })();
        var I = 0;
        k && R()
    })
})(jwplayer);

function setAutoNext(J) {
    var e = jwplayer().getContainer();
    // void 0 != e && (e = e.getElementsByClassName("jw-icon-auto-next")[0], void 0 != e && (e.className = J ? "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-on" : "jw-icon jw-icon-inline jw-button-color jw-reset jw-icon-auto-next jw-icon-auto-next-off"))
};