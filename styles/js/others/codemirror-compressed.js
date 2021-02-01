/* CodeMirror - Minified & Bundled
   Generated on 9/6/2015 with http://codemirror.net/doc/compress.html
   Version: HEAD

   CodeMirror Library:
   - codemirror.js
   Modes:
   - clike.js
   - css.js
   - htmlmixed.js
   - php.js
   - xml.js
   Add-ons:
   - active-line.js
   - matchbrackets.js
   - matchtags.js
   - xml-fold.js
 */
! function(a) {
    if ("object" == typeof exports && "object" == typeof module) module.exports = a();
    else {
        if ("function" == typeof define && define.amd) return define([], a);
        this.CodeMirror = a()
    }
}(function() {
    "use strict";

    function v(a, b) {
        if (!(this instanceof v)) return new v(a, b);
        this.options = b = b ? hg(b) : {}, hg(Ad, b, !1), I(b);
        var c = b.value;
        "string" == typeof c && (c = new af(c, b.mode, null, b.lineSeparator)), this.doc = c;
        var g = new v.inputStyles[b.inputStyle](this),
            h = this.display = new w(a, c, g);
        h.wrapper.CodeMirror = this, E(this), C(this), b.lineWrapping && (this.display.wrapper.className += " CodeMirror-wrap"), b.autofocus && !n && h.input.focus(), M(this), this.state = {
            keyMaps: [],
            overlays: [],
            modeGen: 0,
            overwrite: !1,
            delayingBlurEvent: !1,
            focused: !1,
            suppressEdits: !1,
            pasteIncoming: !1,
            cutIncoming: !1,
            selectingText: !1,
            draggingText: !1,
            highlight: new Yf,
            keySeq: null,
            specialChars: null
        };
        var i = this;
        d && 11 > e && setTimeout(function() {
            i.display.input.reset(!0)
        }, 20), pc(this), Bg(), Vb(this), this.curOp.forceUpdate = !0, ef(this, c), b.autofocus && !n || i.hasFocus() ? setTimeout(ig(Zc, this), 20) : $c(this);
        for (var j in Bd) Bd.hasOwnProperty(j) && Bd[j](this, b[j], Dd);
        R(this), b.finishInit && b.finishInit(this);
        for (var k = 0; k < Hd.length; ++k) Hd[k](this);
        Xb(this), f && b.lineWrapping && "optimizelegibility" == getComputedStyle(h.lineDiv).textRendering && (h.lineDiv.style.textRendering = "auto")
    }

    function w(b, c, g) {
        var h = this;
        this.input = g, h.scrollbarFiller = pg("div", null, "CodeMirror-scrollbar-filler"), h.scrollbarFiller.setAttribute("cm-not-content", "true"), h.gutterFiller = pg("div", null, "CodeMirror-gutter-filler"), h.gutterFiller.setAttribute("cm-not-content", "true"), h.lineDiv = pg("div", null, "CodeMirror-code"), h.selectionDiv = pg("div", null, null, "position: relative; z-index: 1"), h.cursorDiv = pg("div", null, "CodeMirror-cursors"), h.measure = pg("div", null, "CodeMirror-measure"), h.lineMeasure = pg("div", null, "CodeMirror-measure"), h.lineSpace = pg("div", [h.measure, h.lineMeasure, h.selectionDiv, h.cursorDiv, h.lineDiv], null, "position: relative; outline: none"), h.mover = pg("div", [pg("div", [h.lineSpace], "CodeMirror-lines")], null, "position: relative"), h.sizer = pg("div", [h.mover], "CodeMirror-sizer"), h.sizerWidth = null, h.heightForcer = pg("div", null, null, "position: absolute; height: " + Tf + "px; width: 1px;"), h.gutters = pg("div", null, "CodeMirror-gutters"), h.lineGutter = null, h.scroller = pg("div", [h.sizer, h.heightForcer, h.gutters], "CodeMirror-scroll"), h.scroller.setAttribute("tabIndex", "-1"), h.wrapper = pg("div", [h.scrollbarFiller, h.gutterFiller, h.scroller], "CodeMirror"), d && 8 > e && (h.gutters.style.zIndex = -1, h.scroller.style.paddingRight = 0), f || a && n || (h.scroller.draggable = !0), b && (b.appendChild ? b.appendChild(h.wrapper) : b(h.wrapper)), h.viewFrom = h.viewTo = c.first, h.reportedViewFrom = h.reportedViewTo = c.first, h.view = [], h.renderedView = null, h.externalMeasured = null, h.viewOffset = 0, h.lastWrapHeight = h.lastWrapWidth = 0, h.updateLineNumbers = null, h.nativeBarWidth = h.barHeight = h.barWidth = 0, h.scrollbarsClipped = !1, h.lineNumWidth = h.lineNumInnerWidth = h.lineNumChars = null, h.alignWidgets = !1, h.cachedCharWidth = h.cachedTextHeight = h.cachedPaddingH = null, h.maxLine = null, h.maxLineLength = 0, h.maxLineChanged = !1, h.wheelDX = h.wheelDY = h.wheelStartX = h.wheelStartY = null, h.shift = !1, h.selForContextMenu = null, h.activeTouch = null, g.init(h)
    }

    function x(a) {
        a.doc.mode = v.getMode(a.options, a.doc.modeOption), y(a)
    }

    function y(a) {
        a.doc.iter(function(a) {
            a.stateAfter && (a.stateAfter = null), a.styles && (a.styles = null)
        }), a.doc.frontier = a.doc.first, ib(a, 100), a.state.modeGen++, a.curOp && ic(a)
    }

    function z(a) {
        a.options.lineWrapping ? (xg(a.display.wrapper, "CodeMirror-wrap"), a.display.sizer.style.minWidth = "", a.display.sizerWidth = null) : (wg(a.display.wrapper, "CodeMirror-wrap"), H(a)), B(a), ic(a), Fb(a), setTimeout(function() {
            N(a)
        }, 100)
    }

    function A(a) {
        var b = Rb(a.display),
            c = a.options.lineWrapping,
            d = c && Math.max(5, a.display.scroller.clientWidth / Sb(a.display) - 3);
        return function(e) {
            if (we(a.doc, e)) return 0;
            var f = 0;
            if (e.widgets)
                for (var g = 0; g < e.widgets.length; g++) e.widgets[g].height && (f += e.widgets[g].height);
            return c ? f + (Math.ceil(e.text.length / d) || 1) * b : f + b
        }
    }

    function B(a) {
        var b = a.doc,
            c = A(a);
        b.iter(function(a) {
            var b = c(a);
            b != a.height && jf(a, b)
        })
    }

    function C(a) {
        a.display.wrapper.className = a.display.wrapper.className.replace(/\s*cm-s-\S+/g, "") + a.options.theme.replace(/(^|\s)\s*/g, " cm-s-"), Fb(a)
    }

    function D(a) {
        E(a), ic(a), setTimeout(function() {
            Q(a)
        }, 20)
    }

    function E(a) {
        var b = a.display.gutters,
            c = a.options.gutters;
        rg(b);
        for (var d = 0; d < c.length; ++d) {
            var e = c[d],
                f = b.appendChild(pg("div", null, "CodeMirror-gutter " + e));
            "CodeMirror-linenumbers" == e && (a.display.lineGutter = f, f.style.width = (a.display.lineNumWidth || 1) + "px")
        }
        b.style.display = d ? "" : "none", F(a)
    }

    function F(a) {
        var b = a.display.gutters.offsetWidth;
        a.display.sizer.style.marginLeft = b + "px"
    }

    function G(a) {
        if (0 == a.height) return 0;
        for (var c, b = a.text.length, d = a; c = pe(d);) {
            var e = c.find(0, !0);
            d = e.from.line, b += e.from.ch - e.to.ch
        }
        for (d = a; c = qe(d);) {
            var e = c.find(0, !0);
            b -= d.text.length - e.from.ch, d = e.to.line, b += d.text.length - e.to.ch
        }
        return b
    }

    function H(a) {
        var b = a.display,
            c = a.doc;
        b.maxLine = ff(c, c.first), b.maxLineLength = G(b.maxLine), b.maxLineChanged = !0, c.iter(function(a) {
            var c = G(a);
            c > b.maxLineLength && (b.maxLineLength = c, b.maxLine = a)
        })
    }

    function I(a) {
        var b = dg(a.gutters, "CodeMirror-linenumbers"); - 1 == b && a.lineNumbers ? a.gutters = a.gutters.concat(["CodeMirror-linenumbers"]) : b > -1 && !a.lineNumbers && (a.gutters = a.gutters.slice(0), a.gutters.splice(b, 1))
    }

    function J(a) {
        var b = a.display,
            c = b.gutters.offsetWidth,
            d = Math.round(a.doc.height + nb(a.display));
        return {
            clientHeight: b.scroller.clientHeight,
            viewHeight: b.wrapper.clientHeight,
            scrollWidth: b.scroller.scrollWidth,
            clientWidth: b.scroller.clientWidth,
            viewWidth: b.wrapper.clientWidth,
            barLeft: a.options.fixedGutter ? c : 0,
            docHeight: d,
            scrollHeight: d + pb(a) + b.barHeight,
            nativeBarWidth: b.nativeBarWidth,
            gutterWidth: c
        }
    }

    function K(a, b, c) {
        this.cm = c;
        var f = this.vert = pg("div", [pg("div", null, null, "min-width: 1px")], "CodeMirror-vscrollbar"),
            g = this.horiz = pg("div", [pg("div", null, null, "height: 100%; min-height: 1px")], "CodeMirror-hscrollbar");
        a(f), a(g), Jf(f, "scroll", function() {
            f.clientHeight && b(f.scrollTop, "vertical")
        }), Jf(g, "scroll", function() {
            g.clientWidth && b(g.scrollLeft, "horizontal")
        }), this.checkedOverlay = !1, d && 8 > e && (this.horiz.style.minHeight = this.vert.style.minWidth = "18px")
    }

    function L() {}

    function M(a) {
        a.display.scrollbars && (a.display.scrollbars.clear(), a.display.scrollbars.addClass && wg(a.display.wrapper, a.display.scrollbars.addClass)), a.display.scrollbars = new v.scrollbarModel[a.options.scrollbarStyle](function(b) {
            a.display.wrapper.insertBefore(b, a.display.scrollbarFiller), Jf(b, "mousedown", function() {
                a.state.focused && setTimeout(function() {
                    a.display.input.focus()
                }, 0)
            }), b.setAttribute("cm-not-content", "true")
        }, function(b, c) {
            "horizontal" == c ? Ic(a, b) : Hc(a, b)
        }, a), a.display.scrollbars.addClass && xg(a.display.wrapper, a.display.scrollbars.addClass)
    }

    function N(a, b) {
        b || (b = J(a));
        var c = a.display.barWidth,
            d = a.display.barHeight;
        O(a, b);
        for (var e = 0; 4 > e && c != a.display.barWidth || d != a.display.barHeight; e++) c != a.display.barWidth && a.options.lineWrapping && $(a), O(a, J(a)), c = a.display.barWidth, d = a.display.barHeight
    }

    function O(a, b) {
        var c = a.display,
            d = c.scrollbars.update(b);
        c.sizer.style.paddingRight = (c.barWidth = d.right) + "px", c.sizer.style.paddingBottom = (c.barHeight = d.bottom) + "px", d.right && d.bottom ? (c.scrollbarFiller.style.display = "block", c.scrollbarFiller.style.height = d.bottom + "px", c.scrollbarFiller.style.width = d.right + "px") : c.scrollbarFiller.style.display = "", d.bottom && a.options.coverGutterNextToScrollbar && a.options.fixedGutter ? (c.gutterFiller.style.display = "block", c.gutterFiller.style.height = d.bottom + "px", c.gutterFiller.style.width = b.gutterWidth + "px") : c.gutterFiller.style.display = ""
    }

    function P(a, b, c) {
        var d = c && null != c.top ? Math.max(0, c.top) : a.scroller.scrollTop;
        d = Math.floor(d - mb(a));
        var e = c && null != c.bottom ? c.bottom : d + a.wrapper.clientHeight,
            f = lf(b, d),
            g = lf(b, e);
        if (c && c.ensure) {
            var h = c.ensure.from.line,
                i = c.ensure.to.line;
            f > h ? (f = h, g = lf(b, mf(ff(b, h)) + a.wrapper.clientHeight)) : Math.min(i, b.lastLine()) >= g && (f = lf(b, mf(ff(b, i)) - a.wrapper.clientHeight), g = i)
        }
        return {
            from: f,
            to: Math.max(g, f + 1)
        }
    }

    function Q(a) {
        var b = a.display,
            c = b.view;
        if (b.alignWidgets || b.gutters.firstChild && a.options.fixedGutter) {
            for (var d = T(b) - b.scroller.scrollLeft + a.doc.scrollLeft, e = b.gutters.offsetWidth, f = d + "px", g = 0; g < c.length; g++)
                if (!c[g].hidden) {
                    a.options.fixedGutter && c[g].gutter && (c[g].gutter.style.left = f);
                    var h = c[g].alignable;
                    if (h)
                        for (var i = 0; i < h.length; i++) h[i].style.left = f
                }
            a.options.fixedGutter && (b.gutters.style.left = d + e + "px")
        }
    }

    function R(a) {
        if (!a.options.lineNumbers) return !1;
        var b = a.doc,
            c = S(a.options, b.first + b.size - 1),
            d = a.display;
        if (c.length != d.lineNumChars) {
            var e = d.measure.appendChild(pg("div", [pg("div", c)], "CodeMirror-linenumber CodeMirror-gutter-elt")),
                f = e.firstChild.offsetWidth,
                g = e.offsetWidth - f;
            return d.lineGutter.style.width = "", d.lineNumInnerWidth = Math.max(f, d.lineGutter.offsetWidth - g) + 1, d.lineNumWidth = d.lineNumInnerWidth + g, d.lineNumChars = d.lineNumInnerWidth ? c.length : -1, d.lineGutter.style.width = d.lineNumWidth + "px", F(a), !0
        }
        return !1
    }

    function S(a, b) {
        return String(a.lineNumberFormatter(b + a.firstLineNumber))
    }

    function T(a) {
        return a.scroller.getBoundingClientRect().left - a.sizer.getBoundingClientRect().left
    }

    function U(a, b, c) {
        var d = a.display;
        this.viewport = b, this.visible = P(d, a.doc, b), this.editorIsHidden = !d.wrapper.offsetWidth, this.wrapperHeight = d.wrapper.clientHeight, this.wrapperWidth = d.wrapper.clientWidth, this.oldDisplayWidth = qb(a), this.force = c, this.dims = aa(a), this.events = []
    }

    function V(a) {
        var b = a.display;
        !b.scrollbarsClipped && b.scroller.offsetWidth && (b.nativeBarWidth = b.scroller.offsetWidth - b.scroller.clientWidth, b.heightForcer.style.height = pb(a) + "px", b.sizer.style.marginBottom = -b.nativeBarWidth + "px", b.sizer.style.borderRightWidth = pb(a) + "px", b.scrollbarsClipped = !0)
    }

    function W(a, b) {
        var c = a.display,
            d = a.doc;
        if (b.editorIsHidden) return kc(a), !1;
        if (!b.force && b.visible.from >= c.viewFrom && b.visible.to <= c.viewTo && (null == c.updateLineNumbers || c.updateLineNumbers >= c.viewTo) && c.renderedView == c.view && 0 == oc(a)) return !1;
        R(a) && (kc(a), b.dims = aa(a));
        var e = d.first + d.size,
            f = Math.max(b.visible.from - a.options.viewportMargin, d.first),
            g = Math.min(e, b.visible.to + a.options.viewportMargin);
        c.viewFrom < f && f - c.viewFrom < 20 && (f = Math.max(d.first, c.viewFrom)), c.viewTo > g && c.viewTo - g < 20 && (g = Math.min(e, c.viewTo)), u && (f = ue(a.doc, f), g = ve(a.doc, g));
        var h = f != c.viewFrom || g != c.viewTo || c.lastWrapHeight != b.wrapperHeight || c.lastWrapWidth != b.wrapperWidth;
        nc(a, f, g), c.viewOffset = mf(ff(a.doc, c.viewFrom)), a.display.mover.style.top = c.viewOffset + "px";
        var i = oc(a);
        if (!h && 0 == i && !b.force && c.renderedView == c.view && (null == c.updateLineNumbers || c.updateLineNumbers >= c.viewTo)) return !1;
        var j = ug();
        return i > 4 && (c.lineDiv.style.display = "none"), ba(a, c.updateLineNumbers, b.dims), i > 4 && (c.lineDiv.style.display = ""), c.renderedView = c.view, j && ug() != j && j.offsetHeight && j.focus(), rg(c.cursorDiv), rg(c.selectionDiv), c.gutters.style.height = c.sizer.style.minHeight = 0, h && (c.lastWrapHeight = b.wrapperHeight, c.lastWrapWidth = b.wrapperWidth, ib(a, 400)), c.updateLineNumbers = null, !0
    }

    function X(a, b) {
        for (var c = b.viewport, d = !0;
            (d && a.options.lineWrapping && b.oldDisplayWidth != qb(a) || (c && null != c.top && (c = {
                top: Math.min(a.doc.height + nb(a.display) - rb(a), c.top)
            }), b.visible = P(a.display, a.doc, c), !(b.visible.from >= a.display.viewFrom && b.visible.to <= a.display.viewTo))) && W(a, b); d = !1) {
            $(a);
            var e = J(a);
            db(a), Z(a, e), N(a, e)
        }
        b.signal(a, "update", a), (a.display.viewFrom != a.display.reportedViewFrom || a.display.viewTo != a.display.reportedViewTo) && (b.signal(a, "viewportChange", a, a.display.viewFrom, a.display.viewTo), a.display.reportedViewFrom = a.display.viewFrom, a.display.reportedViewTo = a.display.viewTo)
    }

    function Y(a, b) {
        var c = new U(a, b);
        if (W(a, c)) {
            $(a), X(a, c);
            var d = J(a);
            db(a), Z(a, d), N(a, d), c.finish()
        }
    }

    function Z(a, b) {
        a.display.sizer.style.minHeight = b.docHeight + "px";
        var c = b.docHeight + a.display.barHeight;
        a.display.heightForcer.style.top = c + "px", a.display.gutters.style.height = Math.max(c + pb(a), b.clientHeight) + "px"
    }

    function $(a) {
        for (var b = a.display, c = b.lineDiv.offsetTop, f = 0; f < b.view.length; f++) {
            var h, g = b.view[f];
            if (!g.hidden) {
                if (d && 8 > e) {
                    var i = g.node.offsetTop + g.node.offsetHeight;
                    h = i - c, c = i
                } else {
                    var j = g.node.getBoundingClientRect();
                    h = j.bottom - j.top
                }
                var k = g.line.height - h;
                if (2 > h && (h = Rb(b)), (k > .001 || -.001 > k) && (jf(g.line, h), _(g.line), g.rest))
                    for (var l = 0; l < g.rest.length; l++) _(g.rest[l])
            }
        }
    }

    function _(a) {
        if (a.widgets)
            for (var b = 0; b < a.widgets.length; ++b) a.widgets[b].height = a.widgets[b].node.offsetHeight
    }

    function aa(a) {
        for (var b = a.display, c = {}, d = {}, e = b.gutters.clientLeft, f = b.gutters.firstChild, g = 0; f; f = f.nextSibling, ++g) c[a.options.gutters[g]] = f.offsetLeft + f.clientLeft + e, d[a.options.gutters[g]] = f.clientWidth;
        return {
            fixedPos: T(b),
            gutterTotalWidth: b.gutters.offsetWidth,
            gutterLeft: c,
            gutterWidth: d,
            wrapperWidth: b.wrapper.clientWidth
        }
    }

    function ba(a, b, c) {
        function i(b) {
            var c = b.nextSibling;
            return f && o && a.display.currentWheelTarget == b ? b.style.display = "none" : b.parentNode.removeChild(b), c
        }
        for (var d = a.display, e = a.options.lineNumbers, g = d.lineDiv, h = g.firstChild, j = d.view, k = d.viewFrom, l = 0; l < j.length; l++) {
            var m = j[l];
            if (m.hidden);
            else if (m.node && m.node.parentNode == g) {
                for (; h != m.node;) h = i(h);
                var p = e && null != b && k >= b && m.lineNumber;
                m.changes && (dg(m.changes, "gutter") > -1 && (p = !1), ca(a, m, k, c)), p && (rg(m.lineNumber), m.lineNumber.appendChild(document.createTextNode(S(a.options, k)))), h = m.node.nextSibling
            } else {
                var n = ka(a, m, k, c);
                g.insertBefore(n, h)
            }
            k += m.size
        }
        for (; h;) h = i(h)
    }

    function ca(a, b, c, d) {
        for (var e = 0; e < b.changes.length; e++) {
            var f = b.changes[e];
            "text" == f ? ga(a, b) : "gutter" == f ? ia(a, b, c, d) : "class" == f ? ha(b) : "widget" == f && ja(a, b, d)
        }
        b.changes = null
    }

    function da(a) {
        return a.node == a.text && (a.node = pg("div", null, null, "position: relative"), a.text.parentNode && a.text.parentNode.replaceChild(a.node, a.text), a.node.appendChild(a.text), d && 8 > e && (a.node.style.zIndex = 2)), a.node
    }

    function ea(a) {
        var b = a.bgClass ? a.bgClass + " " + (a.line.bgClass || "") : a.line.bgClass;
        if (b && (b += " CodeMirror-linebackground"), a.background) b ? a.background.className = b : (a.background.parentNode.removeChild(a.background), a.background = null);
        else if (b) {
            var c = da(a);
            a.background = c.insertBefore(pg("div", null, b), c.firstChild)
        }
    }

    function fa(a, b) {
        var c = a.display.externalMeasured;
        return c && c.line == b.line ? (a.display.externalMeasured = null, b.measure = c.measure, c.built) : Qe(a, b)
    }

    function ga(a, b) {
        var c = b.text.className,
            d = fa(a, b);
        b.text == b.node && (b.node = d.pre), b.text.parentNode.replaceChild(d.pre, b.text), b.text = d.pre, d.bgClass != b.bgClass || d.textClass != b.textClass ? (b.bgClass = d.bgClass, b.textClass = d.textClass, ha(b)) : c && (b.text.className = c)
    }

    function ha(a) {
        ea(a), a.line.wrapClass ? da(a).className = a.line.wrapClass : a.node != a.text && (a.node.className = "");
        var b = a.textClass ? a.textClass + " " + (a.line.textClass || "") : a.line.textClass;
        a.text.className = b || ""
    }

    function ia(a, b, c, d) {
        if (b.gutter && (b.node.removeChild(b.gutter), b.gutter = null), b.gutterBackground && (b.node.removeChild(b.gutterBackground), b.gutterBackground = null), b.line.gutterClass) {
            var e = da(b);
            b.gutterBackground = pg("div", null, "CodeMirror-gutter-background " + b.line.gutterClass, "left: " + (a.options.fixedGutter ? d.fixedPos : -d.gutterTotalWidth) + "px; width: " + d.gutterTotalWidth + "px"), e.insertBefore(b.gutterBackground, b.text)
        }
        var f = b.line.gutterMarkers;
        if (a.options.lineNumbers || f) {
            var e = da(b),
                g = b.gutter = pg("div", null, "CodeMirror-gutter-wrapper", "left: " + (a.options.fixedGutter ? d.fixedPos : -d.gutterTotalWidth) + "px");
            if (a.display.input.setUneditable(g), e.insertBefore(g, b.text), b.line.gutterClass && (g.className += " " + b.line.gutterClass), !a.options.lineNumbers || f && f["CodeMirror-linenumbers"] || (b.lineNumber = g.appendChild(pg("div", S(a.options, c), "CodeMirror-linenumber CodeMirror-gutter-elt", "left: " + d.gutterLeft["CodeMirror-linenumbers"] + "px; width: " + a.display.lineNumInnerWidth + "px"))), f)
                for (var h = 0; h < a.options.gutters.length; ++h) {
                    var i = a.options.gutters[h],
                        j = f.hasOwnProperty(i) && f[i];
                    j && g.appendChild(pg("div", [j], "CodeMirror-gutter-elt", "left: " + d.gutterLeft[i] + "px; width: " + d.gutterWidth[i] + "px"))
                }
        }
    }

    function ja(a, b, c) {
        b.alignable && (b.alignable = null);
        for (var e, d = b.node.firstChild; d; d = e) {
            var e = d.nextSibling;
            "CodeMirror-linewidget" == d.className && b.node.removeChild(d)
        }
        la(a, b, c)
    }

    function ka(a, b, c, d) {
        var e = fa(a, b);
        return b.text = b.node = e.pre, e.bgClass && (b.bgClass = e.bgClass), e.textClass && (b.textClass = e.textClass), ha(b), ia(a, b, c, d), la(a, b, d), b.node
    }

    function la(a, b, c) {
        if (ma(a, b.line, b, c, !0), b.rest)
            for (var d = 0; d < b.rest.length; d++) ma(a, b.rest[d], b, c, !1)
    }

    function ma(a, b, c, d, e) {
        if (b.widgets)
            for (var f = da(c), g = 0, h = b.widgets; g < h.length; ++g) {
                var i = h[g],
                    j = pg("div", [i.node], "CodeMirror-linewidget");
                i.handleMouseEvents || j.setAttribute("cm-ignore-events", "true"), na(i, j, c, d), a.display.input.setUneditable(j), e && i.above ? f.insertBefore(j, c.gutter || c.text) : f.appendChild(j), Nf(i, "redraw")
            }
    }

    function na(a, b, c, d) {
        if (a.noHScroll) {
            (c.alignable || (c.alignable = [])).push(b);
            var e = d.wrapperWidth;
            b.style.left = d.fixedPos + "px", a.coverGutter || (e -= d.gutterTotalWidth, b.style.paddingLeft = d.gutterTotalWidth + "px"), b.style.width = e + "px"
        }
        a.coverGutter && (b.style.zIndex = 5, b.style.position = "relative", a.noHScroll || (b.style.marginLeft = -d.gutterTotalWidth + "px"))
    }

    function qa(a) {
        return oa(a.line, a.ch)
    }

    function ra(a, b) {
        return pa(a, b) < 0 ? b : a
    }

    function sa(a, b) {
        return pa(a, b) < 0 ? a : b
    }

    function ta(a) {
        a.state.focused || (a.display.input.focus(), Zc(a))
    }

    function ua(a) {
        return a.options.readOnly || a.doc.cantEdit
    }

    function wa(a, b, c, d, e) {
        var f = a.doc;
        a.display.shift = !1, d || (d = f.sel);
        var g = a.state.pasteIncoming || "paste" == e,
            h = f.splitLines(b),
            i = null;
        if (g && d.ranges.length > 1)
            if (va && va.join("\n") == b) {
                if (d.ranges.length % va.length == 0) {
                    i = [];
                    for (var j = 0; j < va.length; j++) i.push(f.splitLines(va[j]))
                }
            } else h.length == d.ranges.length && (i = eg(h, function(a) {
                return [a]
            }));
        for (var j = d.ranges.length - 1; j >= 0; j--) {
            var k = d.ranges[j],
                l = k.from(),
                m = k.to();
            k.empty() && (c && c > 0 ? l = oa(l.line, l.ch - c) : a.state.overwrite && !g && (m = oa(m.line, Math.min(ff(f, m.line).text.length, m.ch + bg(h).length))));
            var n = a.curOp.updateInput,
                o = {
                    from: l,
                    to: m,
                    text: i ? i[j % i.length] : h,
                    origin: e || (g ? "paste" : a.state.cutIncoming ? "cut" : "+input")
                };
            hd(a.doc, o), Nf(a, "inputRead", a, o)
        }
        b && !g && ya(a, b), td(a), a.curOp.updateInput = n, a.curOp.typing = !0, a.state.pasteIncoming = a.state.cutIncoming = !1
    }

    function xa(a, b) {
        var c = a.clipboardData && a.clipboardData.getData("text/plain");
        return c ? (a.preventDefault(), ua(b) || b.options.disableInput || cc(b, function() {
            wa(b, c, 0, null, "paste")
        }), !0) : void 0
    }

    function ya(a, b) {
        if (a.options.electricChars && a.options.smartIndent)
            for (var c = a.doc.sel, d = c.ranges.length - 1; d >= 0; d--) {
                var e = c.ranges[d];
                if (!(e.head.ch > 100 || d && c.ranges[d - 1].head.line == e.head.line)) {
                    var f = a.getModeAt(e.head),
                        g = !1;
                    if (f.electricChars) {
                        for (var h = 0; h < f.electricChars.length; h++)
                            if (b.indexOf(f.electricChars.charAt(h)) > -1) {
                                g = vd(a, e.head.line, "smart");
                                break
                            }
                    } else f.electricInput && f.electricInput.test(ff(a.doc, e.head.line).text.slice(0, e.head.ch)) && (g = vd(a, e.head.line, "smart"));
                    g && Nf(a, "electricInput", a, e.head.line)
                }
            }
    }

    function za(a) {
        for (var b = [], c = [], d = 0; d < a.doc.sel.ranges.length; d++) {
            var e = a.doc.sel.ranges[d].head.line,
                f = {
                    anchor: oa(e, 0),
                    head: oa(e + 1, 0)
                };
            c.push(f), b.push(a.getRange(f.anchor, f.head))
        }
        return {
            text: b,
            ranges: c
        }
    }

    function Aa(a) {
        a.setAttribute("autocorrect", "off"), a.setAttribute("autocapitalize", "off"), a.setAttribute("spellcheck", "false")
    }

    function Ba(a) {
        this.cm = a, this.prevInput = "", this.pollingFast = !1, this.polling = new Yf, this.inaccurateSelection = !1, this.hasSelection = !1, this.composing = null
    }

    function Ca() {
        var a = pg("textarea", null, null, "position: absolute; padding: 0; width: 1px; height: 1em; outline: none"),
            b = pg("div", [a], null, "overflow: hidden; position: relative; width: 3px; height: 0px;");
        return f ? a.style.width = "1000px" : a.setAttribute("wrap", "off"), m && (a.style.border = "1px solid black"), Aa(a), b
    }

    function Da(a) {
        this.cm = a, this.lastAnchorNode = this.lastAnchorOffset = this.lastFocusNode = this.lastFocusOffset = null, this.polling = new Yf, this.gracePeriod = !1
    }

    function Ea(a, b) {
        var c = wb(a, b.line);
        if (!c || c.hidden) return null;
        var d = ff(a.doc, b.line),
            e = tb(c, d, b.line),
            f = nf(d),
            g = "left";
        if (f) {
            var h = Yg(f, b.ch);
            g = h % 2 ? "right" : "left"
        }
        var i = Ab(e.map, b.ch, g);
        return i.offset = "right" == i.collapse ? i.end : i.start, i
    }

    function Fa(a, b) {
        return b && (a.bad = !0), a
    }

    function Ga(a, b, c) {
        var d;
        if (b == a.display.lineDiv) {
            if (d = a.display.lineDiv.childNodes[c], !d) return Fa(a.clipPos(oa(a.display.viewTo - 1)), !0);
            b = null, c = 0
        } else
            for (d = b;; d = d.parentNode) {
                if (!d || d == a.display.lineDiv) return null;
                if (d.parentNode && d.parentNode == a.display.lineDiv) break
            }
        for (var e = 0; e < a.display.view.length; e++) {
            var f = a.display.view[e];
            if (f.node == d) return Ha(f, b, c)
        }
    }

    function Ha(a, b, c) {
        function k(b, c, d) {
            for (var e = -1; e < (j ? j.length : 0); e++)
                for (var f = 0 > e ? i.map : j[e], g = 0; g < f.length; g += 3) {
                    var h = f[g + 2];
                    if (h == b || h == c) {
                        var k = kf(0 > e ? a.line : a.rest[e]),
                            l = f[g] + d;
                        return (0 > d || h != b) && (l = f[g + (d ? 1 : 0)]), oa(k, l)
                    }
                }
        }
        var d = a.text.firstChild,
            e = !1;
        if (!b || !tg(d, b)) return Fa(oa(kf(a.line), 0), !0);
        if (b == d && (e = !0, b = d.childNodes[c], c = 0, !b)) {
            var f = a.rest ? bg(a.rest) : a.line;
            return Fa(oa(kf(f), f.text.length), e)
        }
        var g = 3 == b.nodeType ? b : null,
            h = b;
        for (g || 1 != b.childNodes.length || 3 != b.firstChild.nodeType || (g = b.firstChild, c && (c = g.nodeValue.length)); h.parentNode != d;) h = h.parentNode;
        var i = a.measure,
            j = i.maps,
            l = k(g, h, c);
        if (l) return Fa(l, e);
        for (var m = h.nextSibling, n = g ? g.nodeValue.length - c : 0; m; m = m.nextSibling) {
            if (l = k(m, m.firstChild, 0)) return Fa(oa(l.line, l.ch - n), e);
            n += m.textContent.length
        }
        for (var o = h.previousSibling, n = c; o; o = o.previousSibling) {
            if (l = k(o, o.firstChild, -1)) return Fa(oa(l.line, l.ch + n), e);
            n += m.textContent.length
        }
    }

    function Ia(a, b, c, d, e) {
        function i(a) {
            return function(b) {
                return b.id == a
            }
        }

        function j(b) {
            if (1 == b.nodeType) {
                var c = b.getAttribute("cm-text");
                if (null != c) return "" == c && (c = b.textContent.replace(/\u200b/g, "")), void(f += c);
                var l, k = b.getAttribute("cm-marker");
                if (k) {
                    var m = a.findMarks(oa(d, 0), oa(e + 1, 0), i(+k));
                    return void(m.length && (l = m[0].find()) && (f += gf(a.doc, l.from, l.to).join(h)))
                }
                if ("false" == b.getAttribute("contenteditable")) return;
                for (var n = 0; n < b.childNodes.length; n++) j(b.childNodes[n]);
                /^(pre|div|p)$/i.test(b.nodeName) && (g = !0)
            } else if (3 == b.nodeType) {
                var o = b.nodeValue;
                if (!o) return;
                g && (f += h, g = !1), f += o
            }
        }
        for (var f = "", g = !1, h = a.doc.lineSeparator(); j(b), b != c;) b = b.nextSibling;
        return f
    }

    function Ja(a, b) {
        this.ranges = a, this.primIndex = b
    }

    function Ka(a, b) {
        this.anchor = a, this.head = b
    }

    function La(a, b) {
        var c = a[b];
        a.sort(function(a, b) {
            return pa(a.from(), b.from())
        }), b = dg(a, c);
        for (var d = 1; d < a.length; d++) {
            var e = a[d],
                f = a[d - 1];
            if (pa(f.to(), e.from()) >= 0) {
                var g = sa(f.from(), e.from()),
                    h = ra(f.to(), e.to()),
                    i = f.empty() ? e.from() == e.head : f.from() == f.head;
                b >= d && --b, a.splice(--d, 2, new Ka(i ? h : g, i ? g : h))
            }
        }
        return new Ja(a, b)
    }

    function Ma(a, b) {
        return new Ja([new Ka(a, b || a)], 0)
    }

    function Na(a, b) {
        return Math.max(a.first, Math.min(b, a.first + a.size - 1))
    }

    function Oa(a, b) {
        if (b.line < a.first) return oa(a.first, 0);
        var c = a.first + a.size - 1;
        return b.line > c ? oa(c, ff(a, c).text.length) : Pa(b, ff(a, b.line).text.length)
    }

    function Pa(a, b) {
        var c = a.ch;
        return null == c || c > b ? oa(a.line, b) : 0 > c ? oa(a.line, 0) : a
    }

    function Qa(a, b) {
        return b >= a.first && b < a.first + a.size
    }

    function Ra(a, b) {
        for (var c = [], d = 0; d < b.length; d++) c[d] = Oa(a, b[d]);
        return c
    }

    function Sa(a, b, c, d) {
        if (a.cm && a.cm.display.shift || a.extend) {
            var e = b.anchor;
            if (d) {
                var f = pa(c, e) < 0;
                f != pa(d, e) < 0 ? (e = c, c = d) : f != pa(c, d) < 0 && (c = d)
            }
            return new Ka(e, c)
        }
        return new Ka(d || c, c)
    }

    function Ta(a, b, c, d) {
        Za(a, new Ja([Sa(a, a.sel.primary(), b, c)], 0), d)
    }

    function Ua(a, b, c) {
        for (var d = [], e = 0; e < a.sel.ranges.length; e++) d[e] = Sa(a, a.sel.ranges[e], b[e], null);
        var f = La(d, a.sel.primIndex);
        Za(a, f, c)
    }

    function Va(a, b, c, d) {
        var e = a.sel.ranges.slice(0);
        e[b] = c, Za(a, La(e, a.sel.primIndex), d)
    }

    function Wa(a, b, c, d) {
        Za(a, Ma(b, c), d)
    }

    function Xa(a, b) {
        var c = {
            ranges: b.ranges,
            update: function(b) {
                this.ranges = [];
                for (var c = 0; c < b.length; c++) this.ranges[c] = new Ka(Oa(a, b[c].anchor), Oa(a, b[c].head))
            }
        };
        return Lf(a, "beforeSelectionChange", a, c), a.cm && Lf(a.cm, "beforeSelectionChange", a.cm, c), c.ranges != b.ranges ? La(c.ranges, c.ranges.length - 1) : b
    }

    function Ya(a, b, c) {
        var d = a.history.done,
            e = bg(d);
        e && e.ranges ? (d[d.length - 1] = b, $a(a, b, c)) : Za(a, b, c)
    }

    function Za(a, b, c) {
        $a(a, b, c), uf(a, a.sel, a.cm ? a.cm.curOp.id : NaN, c)
    }

    function $a(a, b, c) {
        (Rf(a, "beforeSelectionChange") || a.cm && Rf(a.cm, "beforeSelectionChange")) && (b = Xa(a, b));
        var d = c && c.bias || (pa(b.primary().head, a.sel.primary().head) < 0 ? -1 : 1);
        _a(a, bb(a, b, d, !0)), c && c.scroll === !1 || !a.cm || td(a.cm)
    }

    function _a(a, b) {
        b.equals(a.sel) || (a.sel = b, a.cm && (a.cm.curOp.updateInput = a.cm.curOp.selectionChanged = !0, Qf(a.cm)), Nf(a, "cursorActivity", a))
    }

    function ab(a) {
        _a(a, bb(a, a.sel, null, !1), Vf)
    }

    function bb(a, b, c, d) {
        for (var e, f = 0; f < b.ranges.length; f++) {
            var g = b.ranges[f],
                h = cb(a, g.anchor, c, d),
                i = cb(a, g.head, c, d);
            (e || h != g.anchor || i != g.head) && (e || (e = b.ranges.slice(0, f)), e[f] = new Ka(h, i))
        }
        return e ? La(e, b.primIndex) : b
    }

    function cb(a, b, c, d) {
        var e = !1,
            f = b,
            g = c || 1;
        a.cantEdit = !1;
        a: for (;;) {
            var h = ff(a, f.line);
            if (h.markedSpans)
                for (var i = 0; i < h.markedSpans.length; ++i) {
                    var j = h.markedSpans[i],
                        k = j.marker;
                    if ((null == j.from || (k.inclusiveLeft ? j.from <= f.ch : j.from < f.ch)) && (null == j.to || (k.inclusiveRight ? j.to >= f.ch : j.to > f.ch))) {
                        if (d && (Lf(k, "beforeCursorEnter"), k.explicitlyCleared)) {
                            if (h.markedSpans) {
                                --i;
                                continue
                            }
                            break
                        }
                        if (!k.atomic) continue;
                        var l = k.find(0 > g ? -1 : 1);
                        if (0 == pa(l, f) && (l.ch += g, l.ch < 0 ? l = l.line > a.first ? Oa(a, oa(l.line - 1)) : null : l.ch > h.text.length && (l = l.line < a.first + a.size - 1 ? oa(l.line + 1, 0) : null), !l)) {
                            if (e) return d ? (a.cantEdit = !0, oa(a.first, 0)) : cb(a, b, c, !0);
                            e = !0, l = b, g = -g
                        }
                        f = l;
                        continue a
                    }
                }
            return f
        }
    }

    function db(a) {
        a.display.input.showSelection(a.display.input.prepareSelection())
    }

    function eb(a, b) {
        for (var c = a.doc, d = {}, e = d.cursors = document.createDocumentFragment(), f = d.selection = document.createDocumentFragment(), g = 0; g < c.sel.ranges.length; g++)
            if (b !== !1 || g != c.sel.primIndex) {
                var h = c.sel.ranges[g],
                    i = h.empty();
                (i || a.options.showCursorWhenSelecting) && fb(a, h.head, e), i || gb(a, h, f)
            }
        return d
    }

    function fb(a, b, c) {
        var d = Lb(a, b, "div", null, null, !a.options.singleCursorHeightPerLine),
            e = c.appendChild(pg("div", "\xa0", "CodeMirror-cursor"));
        if (e.style.left = d.left + "px", e.style.top = d.top + "px", e.style.height = Math.max(0, d.bottom - d.top) * a.options.cursorHeight + "px", d.other) {
            var f = c.appendChild(pg("div", "\xa0", "CodeMirror-cursor CodeMirror-secondarycursor"));
            f.style.display = "", f.style.left = d.other.left + "px", f.style.top = d.other.top + "px", f.style.height = .85 * (d.other.bottom - d.other.top) + "px"
        }
    }

    function gb(a, b, c) {
        function j(a, b, c, d) {
            0 > b && (b = 0), b = Math.round(b), d = Math.round(d), f.appendChild(pg("div", null, "CodeMirror-selected", "position: absolute; left: " + a + "px; top: " + b + "px; width: " + (null == c ? i - a : c) + "px; height: " + (d - b) + "px"))
        }

        function k(b, c, d) {
            function m(c, d) {
                return Kb(a, oa(b, c), "div", f, d)
            }
            var k, l, f = ff(e, b),
                g = f.text.length;
            return Og(nf(f), c || 0, null == d ? g : d, function(a, b, e) {
                var n, o, p, f = m(a, "left");
                if (a == b) n = f, o = p = f.left;
                else {
                    if (n = m(b - 1, "right"), "rtl" == e) {
                        var q = f;
                        f = n, n = q
                    }
                    o = f.left, p = n.right
                }
                null == c && 0 == a && (o = h), n.top - f.top > 3 && (j(o, f.top, null, f.bottom), o = h, f.bottom < n.top && j(o, f.bottom, null, n.top)), null == d && b == g && (p = i), (!k || f.top < k.top || f.top == k.top && f.left < k.left) && (k = f), (!l || n.bottom > l.bottom || n.bottom == l.bottom && n.right > l.right) && (l = n), h + 1 > o && (o = h), j(o, n.top, p - o, n.bottom)
            }), {
                start: k,
                end: l
            }
        }
        var d = a.display,
            e = a.doc,
            f = document.createDocumentFragment(),
            g = ob(a.display),
            h = g.left,
            i = Math.max(d.sizerWidth, qb(a) - d.sizer.offsetLeft) - g.right,
            l = b.from(),
            m = b.to();
        if (l.line == m.line) k(l.line, l.ch, m.ch);
        else {
            var n = ff(e, l.line),
                o = ff(e, m.line),
                p = se(n) == se(o),
                q = k(l.line, l.ch, p ? n.text.length + 1 : null).end,
                r = k(m.line, p ? 0 : null, m.ch).start;
            p && (q.top < r.top - 2 ? (j(q.right, q.top, null, q.bottom), j(h, r.top, r.left, r.bottom)) : j(q.right, q.top, r.left - q.right, q.bottom)), q.bottom < r.top && j(h, q.bottom, null, r.top)
        }
        c.appendChild(f)
    }

    function hb(a) {
        if (a.state.focused) {
            var b = a.display;
            clearInterval(b.blinker);
            var c = !0;
            b.cursorDiv.style.visibility = "", a.options.cursorBlinkRate > 0 ? b.blinker = setInterval(function() {
                b.cursorDiv.style.visibility = (c = !c) ? "" : "hidden"
            }, a.options.cursorBlinkRate) : a.options.cursorBlinkRate < 0 && (b.cursorDiv.style.visibility = "hidden")
        }
    }

    function ib(a, b) {
        a.doc.mode.startState && a.doc.frontier < a.display.viewTo && a.state.highlight.set(b, ig(jb, a))
    }

    function jb(a) {
        var b = a.doc;
        if (b.frontier < b.first && (b.frontier = b.first), !(b.frontier >= a.display.viewTo)) {
            var c = +new Date + a.options.workTime,
                d = Jd(b.mode, lb(a, b.frontier)),
                e = [];
            b.iter(b.frontier, Math.min(b.first + b.size, a.display.viewTo + 500), function(f) {
                if (b.frontier >= a.display.viewFrom) {
                    var g = f.styles,
                        h = f.text.length > a.options.maxHighlightLength,
                        i = Ke(a, f, h ? Jd(b.mode, d) : d, !0);
                    f.styles = i.styles;
                    var j = f.styleClasses,
                        k = i.classes;
                    k ? f.styleClasses = k : j && (f.styleClasses = null);
                    for (var l = !g || g.length != f.styles.length || j != k && (!j || !k || j.bgClass != k.bgClass || j.textClass != k.textClass), m = 0; !l && m < g.length; ++m) l = g[m] != f.styles[m];
                    l && e.push(b.frontier), f.stateAfter = h ? d : Jd(b.mode, d)
                } else f.text.length <= a.options.maxHighlightLength && Me(a, f.text, d), f.stateAfter = b.frontier % 5 == 0 ? Jd(b.mode, d) : null;
                return ++b.frontier, +new Date > c ? (ib(a, a.options.workDelay), !0) : void 0
            }), e.length && cc(a, function() {
                for (var b = 0; b < e.length; b++) jc(a, e[b], "text")
            })
        }
    }

    function kb(a, b, c) {
        for (var d, e, f = a.doc, g = c ? -1 : b - (a.doc.mode.innerMode ? 1e3 : 100), h = b; h > g; --h) {
            if (h <= f.first) return f.first;
            var i = ff(f, h - 1);
            if (i.stateAfter && (!c || h <= f.frontier)) return h;
            var j = Zf(i.text, null, a.options.tabSize);
            (null == e || d > j) && (e = h - 1, d = j)
        }
        return e
    }

    function lb(a, b, c) {
        var d = a.doc,
            e = a.display;
        if (!d.mode.startState) return !0;
        var f = kb(a, b, c),
            g = f > d.first && ff(d, f - 1).stateAfter;
        return g = g ? Jd(d.mode, g) : Kd(d.mode), d.iter(f, b, function(c) {
            Me(a, c.text, g);
            var h = f == b - 1 || f % 5 == 0 || f >= e.viewFrom && f < e.viewTo;
            c.stateAfter = h ? Jd(d.mode, g) : null, ++f
        }), c && (d.frontier = f), g
    }

    function mb(a) {
        return a.lineSpace.offsetTop
    }

    function nb(a) {
        return a.mover.offsetHeight - a.lineSpace.offsetHeight
    }

    function ob(a) {
        if (a.cachedPaddingH) return a.cachedPaddingH;
        var b = sg(a.measure, pg("pre", "x")),
            c = window.getComputedStyle ? window.getComputedStyle(b) : b.currentStyle,
            d = {
                left: parseInt(c.paddingLeft),
                right: parseInt(c.paddingRight)
            };
        return isNaN(d.left) || isNaN(d.right) || (a.cachedPaddingH = d), d
    }

    function pb(a) {
        return Tf - a.display.nativeBarWidth
    }

    function qb(a) {
        return a.display.scroller.clientWidth - pb(a) - a.display.barWidth
    }

    function rb(a) {
        return a.display.scroller.clientHeight - pb(a) - a.display.barHeight
    }

    function sb(a, b, c) {
        var d = a.options.lineWrapping,
            e = d && qb(a);
        if (!b.measure.heights || d && b.measure.width != e) {
            var f = b.measure.heights = [];
            if (d) {
                b.measure.width = e;
                for (var g = b.text.firstChild.getClientRects(), h = 0; h < g.length - 1; h++) {
                    var i = g[h],
                        j = g[h + 1];
                    Math.abs(i.bottom - j.bottom) > 2 && f.push((i.bottom + j.top) / 2 - c.top)
                }
            }
            f.push(c.bottom - c.top)
        }
    }

    function tb(a, b, c) {
        if (a.line == b) return {
            map: a.measure.map,
            cache: a.measure.cache
        };
        for (var d = 0; d < a.rest.length; d++)
            if (a.rest[d] == b) return {
                map: a.measure.maps[d],
                cache: a.measure.caches[d]
            };
        for (var d = 0; d < a.rest.length; d++)
            if (kf(a.rest[d]) > c) return {
                map: a.measure.maps[d],
                cache: a.measure.caches[d],
                before: !0
            }
    }

    function ub(a, b) {
        b = se(b);
        var c = kf(b),
            d = a.display.externalMeasured = new gc(a.doc, b, c);
        d.lineN = c;
        var e = d.built = Qe(a, d);
        return d.text = e.pre, sg(a.display.lineMeasure, e.pre), d
    }

    function vb(a, b, c, d) {
        return yb(a, xb(a, b), c, d)
    }

    function wb(a, b) {
        if (b >= a.display.viewFrom && b < a.display.viewTo) return a.display.view[lc(a, b)];
        var c = a.display.externalMeasured;
        return c && b >= c.lineN && b < c.lineN + c.size ? c : void 0
    }

    function xb(a, b) {
        var c = kf(b),
            d = wb(a, c);
        d && !d.text ? d = null : d && d.changes && (ca(a, d, c, aa(a)), a.curOp.forceUpdate = !0), d || (d = ub(a, b));
        var e = tb(d, b, c);
        return {
            line: b,
            view: d,
            rect: null,
            map: e.map,
            cache: e.cache,
            before: e.before,
            hasHeights: !1
        }
    }

    function yb(a, b, c, d, e) {
        b.before && (c = -1);
        var g, f = c + (d || "");
        return b.cache.hasOwnProperty(f) ? g = b.cache[f] : (b.rect || (b.rect = b.view.text.getBoundingClientRect()), b.hasHeights || (sb(a, b.view, b.rect), b.hasHeights = !0), g = Bb(a, b, c, d), g.bogus || (b.cache[f] = g)), {
            left: g.left,
            right: g.right,
            top: e ? g.rtop : g.top,
            bottom: e ? g.rbottom : g.bottom
        }
    }

    function Ab(a, b, c) {
        for (var d, e, f, g, h = 0; h < a.length; h += 3) {
            var i = a[h],
                j = a[h + 1];
            if (i > b ? (e = 0, f = 1, g = "left") : j > b ? (e = b - i, f = e + 1) : (h == a.length - 3 || b == j && a[h + 3] > b) && (f = j - i, e = f - 1, b >= j && (g = "right")), null != e) {
                if (d = a[h + 2], i == j && c == (d.insertLeft ? "left" : "right") && (g = c), "left" == c && 0 == e)
                    for (; h && a[h - 2] == a[h - 3] && a[h - 1].insertLeft;) d = a[(h -= 3) + 2], g = "left";
                if ("right" == c && e == j - i)
                    for (; h < a.length - 3 && a[h + 3] == a[h + 4] && !a[h + 5].insertLeft;) d = a[(h += 3) + 2], g = "right";
                break
            }
        }
        return {
            node: d,
            start: e,
            end: f,
            collapse: g,
            coverStart: i,
            coverEnd: j
        }
    }

    function Bb(a, b, c, f) {
        var l, g = Ab(b.map, c, f),
            h = g.node,
            i = g.start,
            j = g.end,
            k = g.collapse;
        if (3 == h.nodeType) {
            for (var m = 0; 4 > m; m++) {
                for (; i && og(b.line.text.charAt(g.coverStart + i));) --i;
                for (; g.coverStart + j < g.coverEnd && og(b.line.text.charAt(g.coverStart + j));) ++j;
                if (d && 9 > e && 0 == i && j == g.coverEnd - g.coverStart) l = h.parentNode.getBoundingClientRect();
                else if (d && a.options.lineWrapping) {
                    var n = qg(h, i, j).getClientRects();
                    l = n.length ? n["right" == f ? n.length - 1 : 0] : zb
                } else l = qg(h, i, j).getBoundingClientRect() || zb;
                if (l.left || l.right || 0 == i) break;
                j = i, i -= 1, k = "right"
            }
            d && 11 > e && (l = Cb(a.display.measure, l))
        } else {
            i > 0 && (k = f = "right");
            var n;
            l = a.options.lineWrapping && (n = h.getClientRects()).length > 1 ? n["right" == f ? n.length - 1 : 0] : h.getBoundingClientRect()
        }
        if (d && 9 > e && !i && (!l || !l.left && !l.right)) {
            var o = h.parentNode.getClientRects()[0];
            l = o ? {
                left: o.left,
                right: o.left + Sb(a.display),
                top: o.top,
                bottom: o.bottom
            } : zb
        }
        for (var p = l.top - b.rect.top, q = l.bottom - b.rect.top, r = (p + q) / 2, s = b.view.measure.heights, m = 0; m < s.length - 1 && !(r < s[m]); m++);
        var t = m ? s[m - 1] : 0,
            u = s[m],
            v = {
                left: ("right" == k ? l.right : l.left) - b.rect.left,
                right: ("left" == k ? l.left : l.right) - b.rect.left,
                top: t,
                bottom: u
            };
        return l.left || l.right || (v.bogus = !0), a.options.singleCursorHeightPerLine || (v.rtop = p, v.rbottom = q), v
    }

    function Cb(a, b) {
        if (!window.screen || null == screen.logicalXDPI || screen.logicalXDPI == screen.deviceXDPI || !Mg(a)) return b;
        var c = screen.logicalXDPI / screen.deviceXDPI,
            d = screen.logicalYDPI / screen.deviceYDPI;
        return {
            left: b.left * c,
            right: b.right * c,
            top: b.top * d,
            bottom: b.bottom * d
        }
    }

    function Db(a) {
        if (a.measure && (a.measure.cache = {}, a.measure.heights = null, a.rest))
            for (var b = 0; b < a.rest.length; b++) a.measure.caches[b] = {}
    }

    function Eb(a) {
        a.display.externalMeasure = null, rg(a.display.lineMeasure);
        for (var b = 0; b < a.display.view.length; b++) Db(a.display.view[b])
    }

    function Fb(a) {
        Eb(a), a.display.cachedCharWidth = a.display.cachedTextHeight = a.display.cachedPaddingH = null, a.options.lineWrapping || (a.display.maxLineChanged = !0), a.display.lineNumChars = null
    }

    function Gb() {
        return window.pageXOffset || (document.documentElement || document.body).scrollLeft
    }

    function Hb() {
        return window.pageYOffset || (document.documentElement || document.body).scrollTop
    }

    function Ib(a, b, c, d) {
        if (b.widgets)
            for (var e = 0; e < b.widgets.length; ++e)
                if (b.widgets[e].above) {
                    var f = Ae(b.widgets[e]);
                    c.top += f, c.bottom += f
                }
        if ("line" == d) return c;
        d || (d = "local");
        var g = mf(b);
        if ("local" == d ? g += mb(a.display) : g -= a.display.viewOffset, "page" == d || "window" == d) {
            var h = a.display.lineSpace.getBoundingClientRect();
            g += h.top + ("window" == d ? 0 : Hb());
            var i = h.left + ("window" == d ? 0 : Gb());
            c.left += i, c.right += i
        }
        return c.top += g, c.bottom += g, c
    }

    function Jb(a, b, c) {
        if ("div" == c) return b;
        var d = b.left,
            e = b.top;
        if ("page" == c) d -= Gb(), e -= Hb();
        else if ("local" == c || !c) {
            var f = a.display.sizer.getBoundingClientRect();
            d += f.left, e += f.top
        }
        var g = a.display.lineSpace.getBoundingClientRect();
        return {
            left: d - g.left,
            top: e - g.top
        }
    }

    function Kb(a, b, c, d, e) {
        return d || (d = ff(a.doc, b.line)), Ib(a, d, vb(a, d, b.ch, e), c)
    }

    function Lb(a, b, c, d, e, f) {
        function g(b, g) {
            var h = yb(a, e, b, g ? "right" : "left", f);
            return g ? h.left = h.right : h.right = h.left, Ib(a, d, h, c)
        }

        function h(a, b) {
            var c = i[b],
                d = c.level % 2;
            return a == Pg(c) && b && c.level < i[b - 1].level ? (c = i[--b], a = Qg(c) - (c.level % 2 ? 0 : 1), d = !0) : a == Qg(c) && b < i.length - 1 && c.level < i[b + 1].level && (c = i[++b], a = Pg(c) - c.level % 2, d = !1), d && a == c.to && a > c.from ? g(a - 1) : g(a, d)
        }
        d = d || ff(a.doc, b.line), e || (e = xb(a, d));
        var i = nf(d),
            j = b.ch;
        if (!i) return g(j);
        var k = Yg(i, j),
            l = h(j, k);
        return null != Xg && (l.other = h(j, Xg)), l
    }

    function Mb(a, b) {
        var c = 0,
            b = Oa(a.doc, b);
        a.options.lineWrapping || (c = Sb(a.display) * b.ch);
        var d = ff(a.doc, b.line),
            e = mf(d) + mb(a.display);
        return {
            left: c,
            right: c,
            top: e,
            bottom: e + d.height
        }
    }

    function Nb(a, b, c, d) {
        var e = oa(a, b);
        return e.xRel = d, c && (e.outside = !0), e
    }

    function Ob(a, b, c) {
        var d = a.doc;
        if (c += a.display.viewOffset, 0 > c) return Nb(d.first, 0, !0, -1);
        var e = lf(d, c),
            f = d.first + d.size - 1;
        if (e > f) return Nb(d.first + d.size - 1, ff(d, f).text.length, !0, 1);
        0 > b && (b = 0);
        for (var g = ff(d, e);;) {
            var h = Pb(a, g, e, b, c),
                i = qe(g),
                j = i && i.find(0, !0);
            if (!i || !(h.ch > j.from.ch || h.ch == j.from.ch && h.xRel > 0)) return h;
            e = kf(g = j.to.line)
        }
    }

    function Pb(a, b, c, d, e) {
        function j(d) {
            var e = Lb(a, oa(c, d), "line", b, i);
            return g = !0, f > e.bottom ? e.left - h : f < e.top ? e.left + h : (g = !1, e.left)
        }
        var f = e - mf(b),
            g = !1,
            h = 2 * a.display.wrapper.clientWidth,
            i = xb(a, b),
            k = nf(b),
            l = b.text.length,
            m = Rg(b),
            n = Sg(b),
            o = j(m),
            p = g,
            q = j(n),
            r = g;
        if (d > q) return Nb(c, n, r, 1);
        for (;;) {
            if (k ? n == m || n == $g(b, m, 1) : 1 >= n - m) {
                for (var s = o > d || q - d >= d - o ? m : n, t = d - (s == m ? o : q); og(b.text.charAt(s));) ++s;
                var u = Nb(c, s, s == m ? p : r, -1 > t ? -1 : t > 1 ? 1 : 0);
                return u
            }
            var v = Math.ceil(l / 2),
                w = m + v;
            if (k) {
                w = m;
                for (var x = 0; v > x; ++x) w = $g(b, w, 1)
            }
            var y = j(w);
            y > d ? (n = w, q = y, (r = g) && (q += 1e3), l = v) : (m = w, o = y, p = g, l -= v)
        }
    }

    function Rb(a) {
        if (null != a.cachedTextHeight) return a.cachedTextHeight;
        if (null == Qb) {
            Qb = pg("pre");
            for (var b = 0; 49 > b; ++b) Qb.appendChild(document.createTextNode("x")), Qb.appendChild(pg("br"));
            Qb.appendChild(document.createTextNode("x"))
        }
        sg(a.measure, Qb);
        var c = Qb.offsetHeight / 50;
        return c > 3 && (a.cachedTextHeight = c), rg(a.measure), c || 1
    }

    function Sb(a) {
        if (null != a.cachedCharWidth) return a.cachedCharWidth;
        var b = pg("span", "xxxxxxxxxx"),
            c = pg("pre", [b]);
        sg(a.measure, c);
        var d = b.getBoundingClientRect(),
            e = (d.right - d.left) / 10;
        return e > 2 && (a.cachedCharWidth = e), e || 10
    }

    function Vb(a) {
        a.curOp = {
            cm: a,
            viewChanged: !1,
            startHeight: a.doc.height,
            forceUpdate: !1,
            updateInput: null,
            typing: !1,
            changeObjs: null,
            cursorActivityHandlers: null,
            cursorActivityCalled: 0,
            selectionChanged: !1,
            updateMaxLine: !1,
            scrollLeft: null,
            scrollTop: null,
            scrollToPos: null,
            focus: !1,
            id: ++Ub
        }, Tb ? Tb.ops.push(a.curOp) : a.curOp.ownsGroup = Tb = {
            ops: [a.curOp],
            delayedCallbacks: []
        }
    }

    function Wb(a) {
        var b = a.delayedCallbacks,
            c = 0;
        do {
            for (; c < b.length; c++) b[c].call(null);
            for (var d = 0; d < a.ops.length; d++) {
                var e = a.ops[d];
                if (e.cursorActivityHandlers)
                    for (; e.cursorActivityCalled < e.cursorActivityHandlers.length;) e.cursorActivityHandlers[e.cursorActivityCalled++].call(null, e.cm)
            }
        } while (c < b.length)
    }

    function Xb(a) {
        var b = a.curOp,
            c = b.ownsGroup;
        if (c) try {
            Wb(c)
        } finally {
            Tb = null;
            for (var d = 0; d < c.ops.length; d++) c.ops[d].cm.curOp = null;
            Yb(c)
        }
    }

    function Yb(a) {
        for (var b = a.ops, c = 0; c < b.length; c++) Zb(b[c]);
        for (var c = 0; c < b.length; c++) $b(b[c]);
        for (var c = 0; c < b.length; c++) _b(b[c]);
        for (var c = 0; c < b.length; c++) ac(b[c]);
        for (var c = 0; c < b.length; c++) bc(b[c])
    }

    function Zb(a) {
        var b = a.cm,
            c = b.display;
        V(b), a.updateMaxLine && H(b), a.mustUpdate = a.viewChanged || a.forceUpdate || null != a.scrollTop || a.scrollToPos && (a.scrollToPos.from.line < c.viewFrom || a.scrollToPos.to.line >= c.viewTo) || c.maxLineChanged && b.options.lineWrapping, a.update = a.mustUpdate && new U(b, a.mustUpdate && {
            top: a.scrollTop,
            ensure: a.scrollToPos
        }, a.forceUpdate)
    }

    function $b(a) {
        a.updatedDisplay = a.mustUpdate && W(a.cm, a.update)
    }

    function _b(a) {
        var b = a.cm,
            c = b.display;
        a.updatedDisplay && $(b), a.barMeasure = J(b), c.maxLineChanged && !b.options.lineWrapping && (a.adjustWidthTo = vb(b, c.maxLine, c.maxLine.text.length).left + 3, b.display.sizerWidth = a.adjustWidthTo, a.barMeasure.scrollWidth = Math.max(c.scroller.clientWidth, c.sizer.offsetLeft + a.adjustWidthTo + pb(b) + b.display.barWidth), a.maxScrollLeft = Math.max(0, c.sizer.offsetLeft + a.adjustWidthTo - qb(b))), (a.updatedDisplay || a.selectionChanged) && (a.preparedSelection = c.input.prepareSelection())
    }

    function ac(a) {
        var b = a.cm;
        null != a.adjustWidthTo && (b.display.sizer.style.minWidth = a.adjustWidthTo + "px", a.maxScrollLeft < b.doc.scrollLeft && Ic(b, Math.min(b.display.scroller.scrollLeft, a.maxScrollLeft), !0), b.display.maxLineChanged = !1), a.preparedSelection && b.display.input.showSelection(a.preparedSelection), a.updatedDisplay && Z(b, a.barMeasure), (a.updatedDisplay || a.startHeight != b.doc.height) && N(b, a.barMeasure), a.selectionChanged && hb(b), b.state.focused && a.updateInput && b.display.input.reset(a.typing), a.focus && a.focus == ug() && ta(a.cm)
    }

    function bc(a) {
        var b = a.cm,
            c = b.display,
            d = b.doc;
        if (a.updatedDisplay && X(b, a.update), null == c.wheelStartX || null == a.scrollTop && null == a.scrollLeft && !a.scrollToPos || (c.wheelStartX = c.wheelStartY = null), null == a.scrollTop || c.scroller.scrollTop == a.scrollTop && !a.forceScroll || (d.scrollTop = Math.max(0, Math.min(c.scroller.scrollHeight - c.scroller.clientHeight, a.scrollTop)), c.scrollbars.setScrollTop(d.scrollTop), c.scroller.scrollTop = d.scrollTop), null == a.scrollLeft || c.scroller.scrollLeft == a.scrollLeft && !a.forceScroll || (d.scrollLeft = Math.max(0, Math.min(c.scroller.scrollWidth - qb(b), a.scrollLeft)), c.scrollbars.setScrollLeft(d.scrollLeft), c.scroller.scrollLeft = d.scrollLeft, Q(b)), a.scrollToPos) {
            var e = pd(b, Oa(d, a.scrollToPos.from), Oa(d, a.scrollToPos.to), a.scrollToPos.margin);
            a.scrollToPos.isCursor && b.state.focused && od(b, e)
        }
        var f = a.maybeHiddenMarkers,
            g = a.maybeUnhiddenMarkers;
        if (f)
            for (var h = 0; h < f.length; ++h) f[h].lines.length || Lf(f[h], "hide");
        if (g)
            for (var h = 0; h < g.length; ++h) g[h].lines.length && Lf(g[h], "unhide");
        c.wrapper.offsetHeight && (d.scrollTop = b.display.scroller.scrollTop), a.changeObjs && Lf(b, "changes", b, a.changeObjs), a.update && a.update.finish()
    }

    function cc(a, b) {
        if (a.curOp) return b();
        Vb(a);
        try {
            return b()
        } finally {
            Xb(a)
        }
    }

    function dc(a, b) {
        return function() {
            if (a.curOp) return b.apply(a, arguments);
            Vb(a);
            try {
                return b.apply(a, arguments)
            } finally {
                Xb(a)
            }
        }
    }

    function ec(a) {
        return function() {
            if (this.curOp) return a.apply(this, arguments);
            Vb(this);
            try {
                return a.apply(this, arguments)
            } finally {
                Xb(this)
            }
        }
    }

    function fc(a) {
        return function() {
            var b = this.cm;
            if (!b || b.curOp) return a.apply(this, arguments);
            Vb(b);
            try {
                return a.apply(this, arguments)
            } finally {
                Xb(b)
            }
        }
    }

    function gc(a, b, c) {
        this.line = b, this.rest = te(b), this.size = this.rest ? kf(bg(this.rest)) - c + 1 : 1, this.node = this.text = null, this.hidden = we(a, b)
    }

    function hc(a, b, c) {
        for (var e, d = [], f = b; c > f; f = e) {
            var g = new gc(a.doc, ff(a.doc, f), f);
            e = f + g.size, d.push(g)
        }
        return d
    }

    function ic(a, b, c, d) {
        null == b && (b = a.doc.first), null == c && (c = a.doc.first + a.doc.size), d || (d = 0);
        var e = a.display;
        if (d && c < e.viewTo && (null == e.updateLineNumbers || e.updateLineNumbers > b) && (e.updateLineNumbers = b), a.curOp.viewChanged = !0, b >= e.viewTo) u && ue(a.doc, b) < e.viewTo && kc(a);
        else if (c <= e.viewFrom) u && ve(a.doc, c + d) > e.viewFrom ? kc(a) : (e.viewFrom += d, e.viewTo += d);
        else if (b <= e.viewFrom && c >= e.viewTo) kc(a);
        else if (b <= e.viewFrom) {
            var f = mc(a, c, c + d, 1);
            f ? (e.view = e.view.slice(f.index), e.viewFrom = f.lineN, e.viewTo += d) : kc(a)
        } else if (c >= e.viewTo) {
            var f = mc(a, b, b, -1);
            f ? (e.view = e.view.slice(0, f.index), e.viewTo = f.lineN) : kc(a)
        } else {
            var g = mc(a, b, b, -1),
                h = mc(a, c, c + d, 1);
            g && h ? (e.view = e.view.slice(0, g.index).concat(hc(a, g.lineN, h.lineN)).concat(e.view.slice(h.index)), e.viewTo += d) : kc(a)
        }
        var i = e.externalMeasured;
        i && (c < i.lineN ? i.lineN += d : b < i.lineN + i.size && (e.externalMeasured = null))
    }

    function jc(a, b, c) {
        a.curOp.viewChanged = !0;
        var d = a.display,
            e = a.display.externalMeasured;
        if (e && b >= e.lineN && b < e.lineN + e.size && (d.externalMeasured = null), !(b < d.viewFrom || b >= d.viewTo)) {
            var f = d.view[lc(a, b)];
            if (null != f.node) {
                var g = f.changes || (f.changes = []); - 1 == dg(g, c) && g.push(c)
            }
        }
    }

    function kc(a) {
        a.display.viewFrom = a.display.viewTo = a.doc.first, a.display.view = [], a.display.viewOffset = 0
    }

    function lc(a, b) {
        if (b >= a.display.viewTo) return null;
        if (b -= a.display.viewFrom, 0 > b) return null;
        for (var c = a.display.view, d = 0; d < c.length; d++)
            if (b -= c[d].size, 0 > b) return d
    }

    function mc(a, b, c, d) {
        var f, e = lc(a, b),
            g = a.display.view;
        if (!u || c == a.doc.first + a.doc.size) return {
            index: e,
            lineN: c
        };
        for (var h = 0, i = a.display.viewFrom; e > h; h++) i += g[h].size;
        if (i != b) {
            if (d > 0) {
                if (e == g.length - 1) return null;
                f = i + g[e].size - b, e++
            } else f = i - b;
            b += f, c += f
        }
        for (; ue(a.doc, c) != c;) {
            if (e == (0 > d ? 0 : g.length - 1)) return null;
            c += d * g[e - (0 > d ? 1 : 0)].size, e += d
        }
        return {
            index: e,
            lineN: c
        }
    }

    function nc(a, b, c) {
        var d = a.display,
            e = d.view;
        0 == e.length || b >= d.viewTo || c <= d.viewFrom ? (d.view = hc(a, b, c), d.viewFrom = b) : (d.viewFrom > b ? d.view = hc(a, b, d.viewFrom).concat(d.view) : d.viewFrom < b && (d.view = d.view.slice(lc(a, b))), d.viewFrom = b, d.viewTo < c ? d.view = d.view.concat(hc(a, d.viewTo, c)) : d.viewTo > c && (d.view = d.view.slice(0, lc(a, c)))), d.viewTo = c
    }

    function oc(a) {
        for (var b = a.display.view, c = 0, d = 0; d < b.length; d++) {
            var e = b[d];
            e.hidden || e.node && !e.changes || ++c
        }
        return c
    }

    function pc(a) {
        function g() {
            b.activeTouch && (c = setTimeout(function() {
                b.activeTouch = null
            }, 1e3), f = b.activeTouch, f.end = +new Date)
        }

        function h(a) {
            if (1 != a.touches.length) return !1;
            var b = a.touches[0];
            return b.radiusX <= 1 && b.radiusY <= 1
        }

        function i(a, b) {
            if (null == b.left) return !0;
            var c = b.left - a.left,
                d = b.top - a.top;
            return c * c + d * d > 400
        }
        var b = a.display;
        Jf(b.scroller, "mousedown", dc(a, uc)), d && 11 > e ? Jf(b.scroller, "dblclick", dc(a, function(b) {
            if (!Pf(a, b)) {
                var c = tc(a, b);
                if (c && !Bc(a, b) && !sc(a.display, b)) {
                    Df(b);
                    var d = a.findWordAt(c);
                    Ta(a.doc, d.anchor, d.head)
                }
            }
        })) : Jf(b.scroller, "dblclick", function(b) {
            Pf(a, b) || Df(b)
        }), s || Jf(b.scroller, "contextmenu", function(b) {
            _c(a, b)
        });
        var c, f = {
            end: 0
        };
        Jf(b.scroller, "touchstart", function(a) {
            if (!h(a)) {
                clearTimeout(c);
                var d = +new Date;
                b.activeTouch = {
                    start: d,
                    moved: !1,
                    prev: d - f.end <= 300 ? f : null
                }, 1 == a.touches.length && (b.activeTouch.left = a.touches[0].pageX, b.activeTouch.top = a.touches[0].pageY)
            }
        }), Jf(b.scroller, "touchmove", function() {
            b.activeTouch && (b.activeTouch.moved = !0)
        }), Jf(b.scroller, "touchend", function(c) {
            var d = b.activeTouch;
            if (d && !sc(b, c) && null != d.left && !d.moved && new Date - d.start < 300) {
                var f, e = a.coordsChar(b.activeTouch, "page");
                f = !d.prev || i(d, d.prev) ? new Ka(e, e) : !d.prev.prev || i(d, d.prev.prev) ? a.findWordAt(e) : new Ka(oa(e.line, 0), Oa(a.doc, oa(e.line + 1, 0))), a.setSelection(f.anchor, f.head), a.focus(), Df(c)
            }
            g()
        }), Jf(b.scroller, "touchcancel", g), Jf(b.scroller, "scroll", function() {
            b.scroller.clientHeight && (Hc(a, b.scroller.scrollTop), Ic(a, b.scroller.scrollLeft, !0), Lf(a, "scroll", a))
        }), Jf(b.scroller, "mousewheel", function(b) {
            Mc(a, b)
        }), Jf(b.scroller, "DOMMouseScroll", function(b) {
            Mc(a, b)
        }), Jf(b.wrapper, "scroll", function() {
            b.wrapper.scrollTop = b.wrapper.scrollLeft = 0
        }), b.dragFunctions = {
            enter: function(b) {
                Pf(a, b) || Gf(b)
            },
            over: function(b) {
                Pf(a, b) || (Fc(a, b), Gf(b))
            },
            start: function(b) {
                Ec(a, b)
            },
            drop: dc(a, Dc),
            leave: function() {
                Gc(a)
            }
        };
        var j = b.input.getField();
        Jf(j, "keyup", function(b) {
            Wc.call(a, b)
        }), Jf(j, "keydown", dc(a, Uc)), Jf(j, "keypress", dc(a, Xc)), Jf(j, "focus", ig(Zc, a)), Jf(j, "blur", ig($c, a))
    }

    function qc(a, b, c) {
        var d = c && c != v.Init;
        if (!b != !d) {
            var e = a.display.dragFunctions,
                f = b ? Jf : Kf;
            f(a.display.scroller, "dragstart", e.start), f(a.display.scroller, "dragenter", e.enter), f(a.display.scroller, "dragover", e.over), f(a.display.scroller, "dragleave", e.leave), f(a.display.scroller, "drop", e.drop)
        }
    }

    function rc(a) {
        var b = a.display;
        (b.lastWrapHeight != b.wrapper.clientHeight || b.lastWrapWidth != b.wrapper.clientWidth) && (b.cachedCharWidth = b.cachedTextHeight = b.cachedPaddingH = null, b.scrollbarsClipped = !1, a.setSize())
    }

    function sc(a, b) {
        for (var c = Hf(b); c != a.wrapper; c = c.parentNode)
            if (!c || 1 == c.nodeType && "true" == c.getAttribute("cm-ignore-events") || c.parentNode == a.sizer && c != a.mover) return !0
    }

    function tc(a, b, c, d) {
        var e = a.display;
        if (!c && "true" == Hf(b).getAttribute("cm-not-content")) return null;
        var f, g, h = e.lineSpace.getBoundingClientRect();
        try {
            f = b.clientX - h.left, g = b.clientY - h.top
        } catch (b) {
            return null
        }
        var j, i = Ob(a, f, g);
        if (d && 1 == i.xRel && (j = ff(a.doc, i.line).text).length == i.ch) {
            var k = Zf(j, j.length, a.options.tabSize) - j.length;
            i = oa(i.line, Math.max(0, Math.round((f - ob(a.display).left) / Sb(a.display)) - k))
        }
        return i
    }

    function uc(a) {
        var b = this,
            c = b.display;
        if (!(c.activeTouch && c.input.supportsTouch() || Pf(b, a))) {
            if (c.shift = a.shiftKey, sc(c, a)) return void(f || (c.scroller.draggable = !1, setTimeout(function() {
                c.scroller.draggable = !0
            }, 100)));
            if (!Bc(b, a)) {
                var d = tc(b, a);
                switch (window.focus(), If(a)) {
                    case 1:
                        b.state.selectingText ? b.state.selectingText(a) : d ? xc(b, a, d) : Hf(a) == c.scroller && Df(a);
                        break;
                    case 2:
                        f && (b.state.lastMiddleDown = +new Date), d && Ta(b.doc, d), setTimeout(function() {
                            c.input.focus()
                        }, 20), Df(a);
                        break;
                    case 3:
                        s ? _c(b, a) : Yc(b)
                }
            }
        }
    }

    function xc(a, b, c) {
        d ? setTimeout(ig(ta, a), 0) : a.curOp.focus = ug();
        var f, e = +new Date;
        wc && wc.time > e - 400 && 0 == pa(wc.pos, c) ? f = "triple" : vc && vc.time > e - 400 && 0 == pa(vc.pos, c) ? (f = "double", wc = {
            time: e,
            pos: c
        }) : (f = "single", vc = {
            time: e,
            pos: c
        });
        var i, g = a.doc.sel,
            h = o ? b.metaKey : b.ctrlKey;
        a.options.dragDrop && Dg && !ua(a) && "single" == f && (i = g.contains(c)) > -1 && (pa((i = g.ranges[i]).from(), c) < 0 || c.xRel > 0) && (pa(i.to(), c) > 0 || c.xRel < 0) ? yc(a, b, c, h) : zc(a, b, c, f, h)
    }

    function yc(a, b, c, g) {
        var h = a.display,
            i = +new Date,
            j = dc(a, function(k) {
                f && (h.scroller.draggable = !1), a.state.draggingText = !1, Kf(document, "mouseup", j), Kf(h.scroller, "drop", j), Math.abs(b.clientX - k.clientX) + Math.abs(b.clientY - k.clientY) < 10 && (Df(k), !g && +new Date - 200 < i && Ta(a.doc, c), f || d && 9 == e ? setTimeout(function() {
                    document.body.focus(), h.input.focus()
                }, 20) : h.input.focus())
            });
        f && (h.scroller.draggable = !0), a.state.draggingText = j, h.scroller.dragDrop && h.scroller.dragDrop(), Jf(document, "mouseup", j), Jf(h.scroller, "drop", j)
    }

    function zc(a, b, c, d, e) {
        function o(b) {
            if (0 != pa(n, b))
                if (n = b, "rect" == d) {
                    for (var e = [], f = a.options.tabSize, k = Zf(ff(g, c.line).text, c.ch, f), l = Zf(ff(g, b.line).text, b.ch, f), m = Math.min(k, l), o = Math.max(k, l), p = Math.min(c.line, b.line), q = Math.min(a.lastLine(), Math.max(c.line, b.line)); q >= p; p++) {
                        var r = ff(g, p).text,
                            s = $f(r, m, f);
                        m == o ? e.push(new Ka(oa(p, s), oa(p, s))) : r.length > s && e.push(new Ka(oa(p, s), oa(p, $f(r, o, f))))
                    }
                    e.length || e.push(new Ka(c, c)), Za(g, La(j.ranges.slice(0, i).concat(e), i), {
                        origin: "*mouse",
                        scroll: !1
                    }), a.scrollIntoView(b)
                } else {
                    var t = h,
                        u = t.anchor,
                        v = b;
                    if ("single" != d) {
                        if ("double" == d) var w = a.findWordAt(b);
                        else var w = new Ka(oa(b.line, 0), Oa(g, oa(b.line + 1, 0)));
                        pa(w.anchor, u) > 0 ? (v = w.head, u = sa(t.from(), w.anchor)) : (v = w.anchor, u = ra(t.to(), w.head))
                    }
                    var e = j.ranges.slice(0);
                    e[i] = new Ka(Oa(g, u), v), Za(g, La(e, i), Wf)
                }
        }

        function r(b) {
            var c = ++q,
                e = tc(a, b, !0, "rect" == d);
            if (e)
                if (0 != pa(e, n)) {
                    a.curOp.focus = ug(), o(e);
                    var h = P(f, g);
                    (e.line >= h.to || e.line < h.from) && setTimeout(dc(a, function() {
                        q == c && r(b)
                    }), 150)
                } else {
                    var i = b.clientY < p.top ? -20 : b.clientY > p.bottom ? 20 : 0;
                    i && setTimeout(dc(a, function() {
                        q == c && (f.scroller.scrollTop += i, r(b))
                    }), 50)
                }
        }

        function s(b) {
            a.state.selectingText = !1, q = 1 / 0, Df(b), f.input.focus(), Kf(document, "mousemove", t), Kf(document, "mouseup", u), g.history.lastSelOrigin = null
        }
        var f = a.display,
            g = a.doc;
        Df(b);
        var h, i, j = g.sel,
            k = j.ranges;
        if (e && !b.shiftKey ? (i = g.sel.contains(c), h = i > -1 ? k[i] : new Ka(c, c)) : (h = g.sel.primary(), i = g.sel.primIndex), b.altKey) d = "rect", e || (h = new Ka(c, c)), c = tc(a, b, !0, !0), i = -1;
        else if ("double" == d) {
            var l = a.findWordAt(c);
            h = a.display.shift || g.extend ? Sa(g, h, l.anchor, l.head) : l
        } else if ("triple" == d) {
            var m = new Ka(oa(c.line, 0), Oa(g, oa(c.line + 1, 0)));
            h = a.display.shift || g.extend ? Sa(g, h, m.anchor, m.head) : m
        } else h = Sa(g, h, c);
        e ? -1 == i ? (i = k.length, Za(g, La(k.concat([h]), i), {
            scroll: !1,
            origin: "*mouse"
        })) : k.length > 1 && k[i].empty() && "single" == d && !b.shiftKey ? (Za(g, La(k.slice(0, i).concat(k.slice(i + 1)), 0), {
            scroll: !1,
            origin: "*mouse"
        }), j = g.sel) : Va(g, i, h, Wf) : (i = 0, Za(g, new Ja([h], 0), Wf), j = g.sel);
        var n = c,
            p = f.wrapper.getBoundingClientRect(),
            q = 0,
            t = dc(a, function(a) {
                If(a) ? r(a) : s(a)
            }),
            u = dc(a, s);
        a.state.selectingText = u, Jf(document, "mousemove", t), Jf(document, "mouseup", u)
    }

    function Ac(a, b, c, d, e) {
        try {
            var f = b.clientX,
                g = b.clientY
        } catch (b) {
            return !1
        }
        if (f >= Math.floor(a.display.gutters.getBoundingClientRect().right)) return !1;
        d && Df(b);
        var h = a.display,
            i = h.lineDiv.getBoundingClientRect();
        if (g > i.bottom || !Rf(a, c)) return Ff(b);
        g -= i.top - h.viewOffset;
        for (var j = 0; j < a.options.gutters.length; ++j) {
            var k = h.gutters.childNodes[j];
            if (k && k.getBoundingClientRect().right >= f) {
                var l = lf(a.doc, g),
                    m = a.options.gutters[j];
                return e(a, c, a, l, m, b), Ff(b)
            }
        }
    }

    function Bc(a, b) {
        return Ac(a, b, "gutterClick", !0, Nf)
    }

    function Dc(a) {
        var b = this;
        if (Gc(b), !Pf(b, a) && !sc(b.display, a)) {
            Df(a), d && (Cc = +new Date);
            var c = tc(b, a, !0),
                e = a.dataTransfer.files;
            if (c && !ua(b))
                if (e && e.length && window.FileReader && window.File)
                    for (var f = e.length, g = Array(f), h = 0, i = function(a, d) {
                            var e = new FileReader;
                            e.onload = dc(b, function() {
                                if (g[d] = e.result, ++h == f) {
                                    c = Oa(b.doc, c);
                                    var a = {
                                        from: c,
                                        to: c,
                                        text: b.doc.splitLines(g.join(b.doc.lineSeparator())),
                                        origin: "paste"
                                    };
                                    hd(b.doc, a), Ya(b.doc, Ma(c, bd(a)))
                                }
                            }), e.readAsText(a)
                        }, j = 0; f > j; ++j) i(e[j], j);
                else {
                    if (b.state.draggingText && b.doc.sel.contains(c) > -1) return b.state.draggingText(a), void setTimeout(function() {
                        b.display.input.focus()
                    }, 20);
                    try {
                        var g = a.dataTransfer.getData("Text");
                        if (g) {
                            if (b.state.draggingText && !(o ? a.altKey : a.ctrlKey)) var k = b.listSelections();
                            if ($a(b.doc, Ma(c, c)), k)
                                for (var j = 0; j < k.length; ++j) nd(b.doc, "", k[j].anchor, k[j].head, "drag");
                            b.replaceSelection(g, "around", "paste"), b.display.input.focus()
                        }
                    } catch (a) {}
                }
        }
    }

    function Ec(a, b) {
        if (d && (!a.state.draggingText || +new Date - Cc < 100)) return void Gf(b);
        if (!Pf(a, b) && !sc(a.display, b) && (b.dataTransfer.setData("Text", a.getSelection()), b.dataTransfer.setDragImage && !j)) {
            var c = pg("img", null, null, "position: fixed; left: 0; top: 0;");
            c.src = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==", i && (c.width = c.height = 1, a.display.wrapper.appendChild(c), c._top = c.offsetTop), b.dataTransfer.setDragImage(c, 0, 0), i && c.parentNode.removeChild(c)
        }
    }

    function Fc(a, b) {
        var c = tc(a, b);
        if (c) {
            var d = document.createDocumentFragment();
            fb(a, c, d), a.display.dragCursor || (a.display.dragCursor = pg("div", null, "CodeMirror-cursors CodeMirror-dragcursors"), a.display.lineSpace.insertBefore(a.display.dragCursor, a.display.cursorDiv)), sg(a.display.dragCursor, d)
        }
    }

    function Gc(a) {
        a.display.dragCursor && (a.display.lineSpace.removeChild(a.display.dragCursor), a.display.dragCursor = null)
    }

    function Hc(b, c) {
        Math.abs(b.doc.scrollTop - c) < 2 || (b.doc.scrollTop = c, a || Y(b, {
            top: c
        }), b.display.scroller.scrollTop != c && (b.display.scroller.scrollTop = c), b.display.scrollbars.setScrollTop(c), a && Y(b), ib(b, 100))
    }

    function Ic(a, b, c) {
        (c ? b == a.doc.scrollLeft : Math.abs(a.doc.scrollLeft - b) < 2) || (b = Math.min(b, a.display.scroller.scrollWidth - a.display.scroller.clientWidth), a.doc.scrollLeft = b, Q(a), a.display.scroller.scrollLeft != b && (a.display.scroller.scrollLeft = b), a.display.scrollbars.setScrollLeft(b))
    }

    function Mc(b, c) {
        var d = Lc(c),
            e = d.x,
            g = d.y,
            h = b.display,
            j = h.scroller;
        if (e && j.scrollWidth > j.clientWidth || g && j.scrollHeight > j.clientHeight) {
            if (g && o && f) a: for (var k = c.target, l = h.view; k != j; k = k.parentNode)
                for (var m = 0; m < l.length; m++)
                    if (l[m].node == k) {
                        b.display.currentWheelTarget = k;
                        break a
                    }
            if (e && !a && !i && null != Kc) return g && Hc(b, Math.max(0, Math.min(j.scrollTop + g * Kc, j.scrollHeight - j.clientHeight))), Ic(b, Math.max(0, Math.min(j.scrollLeft + e * Kc, j.scrollWidth - j.clientWidth))), Df(c), void(h.wheelStartX = null);
            if (g && null != Kc) {
                var n = g * Kc,
                    p = b.doc.scrollTop,
                    q = p + h.wrapper.clientHeight;
                0 > n ? p = Math.max(0, p + n - 50) : q = Math.min(b.doc.height, q + n + 50), Y(b, {
                    top: p,
                    bottom: q
                })
            }
            20 > Jc && (null == h.wheelStartX ? (h.wheelStartX = j.scrollLeft, h.wheelStartY = j.scrollTop, h.wheelDX = e, h.wheelDY = g, setTimeout(function() {
                if (null != h.wheelStartX) {
                    var a = j.scrollLeft - h.wheelStartX,
                        b = j.scrollTop - h.wheelStartY,
                        c = b && h.wheelDY && b / h.wheelDY || a && h.wheelDX && a / h.wheelDX;
                    h.wheelStartX = h.wheelStartY = null, c && (Kc = (Kc * Jc + c) / (Jc + 1), ++Jc)
                }
            }, 200)) : (h.wheelDX += e, h.wheelDY += g))
        }
    }

    function Nc(a, b, c) {
        if ("string" == typeof b && (b = Ld[b], !b)) return !1;
        a.display.input.ensurePolled();
        var d = a.display.shift,
            e = !1;
        try {
            ua(a) && (a.state.suppressEdits = !0), c && (a.display.shift = !1), e = b(a) != Uf
        } finally {
            a.display.shift = d, a.state.suppressEdits = !1
        }
        return e
    }

    function Oc(a, b, c) {
        for (var d = 0; d < a.state.keyMaps.length; d++) {
            var e = Od(b, a.state.keyMaps[d], c, a);
            if (e) return e
        }
        return a.options.extraKeys && Od(b, a.options.extraKeys, c, a) || Od(b, a.options.keyMap, c, a)
    }

    function Qc(a, b, c, d) {
        var e = a.state.keySeq;
        if (e) {
            if (Pd(b)) return "handled";
            Pc.set(50, function() {
                a.state.keySeq == e && (a.state.keySeq = null, a.display.input.reset())
            }), b = e + " " + b
        }
        var f = Oc(a, b, d);
        return "multi" == f && (a.state.keySeq = b), "handled" == f && Nf(a, "keyHandled", a, b, c), ("handled" == f || "multi" == f) && (Df(c), hb(a)), e && !f && /\'$/.test(b) ? (Df(c), !0) : !!f
    }

    function Rc(a, b) {
        var c = Qd(b, !0);
        return c ? b.shiftKey && !a.state.keySeq ? Qc(a, "Shift-" + c, b, function(b) {
            return Nc(a, b, !0)
        }) || Qc(a, c, b, function(b) {
            return ("string" == typeof b ? /^go[A-Z]/.test(b) : b.motion) ? Nc(a, b) : void 0
        }) : Qc(a, c, b, function(b) {
            return Nc(a, b)
        }) : !1
    }

    function Sc(a, b, c) {
        return Qc(a, "'" + c + "'", b, function(b) {
            return Nc(a, b, !0)
        })
    }

    function Uc(a) {
        var b = this;
        if (b.curOp.focus = ug(), !Pf(b, a)) {
            d && 11 > e && 27 == a.keyCode && (a.returnValue = !1);
            var c = a.keyCode;
            b.display.shift = 16 == c || a.shiftKey;
            var f = Rc(b, a);
            i && (Tc = f ? c : null, !f && 88 == c && !Kg && (o ? a.metaKey : a.ctrlKey) && b.replaceSelection("", null, "cut")), 18 != c || /\bCodeMirror-crosshair\b/.test(b.display.lineDiv.className) || Vc(b)
        }
    }

    function Vc(a) {
        function c(a) {
            18 != a.keyCode && a.altKey || (wg(b, "CodeMirror-crosshair"), Kf(document, "keyup", c), Kf(document, "mouseover", c))
        }
        var b = a.display.lineDiv;
        xg(b, "CodeMirror-crosshair"), Jf(document, "keyup", c), Jf(document, "mouseover", c)
    }

    function Wc(a) {
        16 == a.keyCode && (this.doc.sel.shift = !1), Pf(this, a)
    }

    function Xc(a) {
        var b = this;
        if (!(sc(b.display, a) || Pf(b, a) || a.ctrlKey && !a.altKey || o && a.metaKey)) {
            var c = a.keyCode,
                d = a.charCode;
            if (i && c == Tc) return Tc = null, void Df(a);
            if (!i || a.which && !(a.which < 10) || !Rc(b, a)) {
                var e = String.fromCharCode(null == d ? c : d);
                Sc(b, a, e) || b.display.input.onKeyPress(a)
            }
        }
    }

    function Yc(a) {
        a.state.delayingBlurEvent = !0, setTimeout(function() {
            a.state.delayingBlurEvent && (a.state.delayingBlurEvent = !1, $c(a))
        }, 100)
    }

    function Zc(a) {
        a.state.delayingBlurEvent && (a.state.delayingBlurEvent = !1), "nocursor" != a.options.readOnly && (a.state.focused || (Lf(a, "focus", a), a.state.focused = !0, xg(a.display.wrapper, "CodeMirror-focused"), a.curOp || a.display.selForContextMenu == a.doc.sel || (a.display.input.reset(), f && setTimeout(function() {
            a.display.input.reset(!0)
        }, 20)), a.display.input.receivedFocus()), hb(a))
    }

    function $c(a) {
        a.state.delayingBlurEvent || (a.state.focused && (Lf(a, "blur", a), a.state.focused = !1, wg(a.display.wrapper, "CodeMirror-focused")), clearInterval(a.display.blinker), setTimeout(function() {
            a.state.focused || (a.display.shift = !1)
        }, 150))
    }

    function _c(a, b) {
        sc(a.display, b) || ad(a, b) || a.display.input.onContextMenu(b)
    }

    function ad(a, b) {
        return Rf(a, "gutterContextMenu") ? Ac(a, b, "gutterContextMenu", !1, Lf) : !1
    }

    function cd(a, b) {
        if (pa(a, b.from) < 0) return a;
        if (pa(a, b.to) <= 0) return bd(b);
        var c = a.line + b.text.length - (b.to.line - b.from.line) - 1,
            d = a.ch;
        return a.line == b.to.line && (d += bd(b).ch - b.to.ch), oa(c, d)
    }

    function dd(a, b) {
        for (var c = [], d = 0; d < a.sel.ranges.length; d++) {
            var e = a.sel.ranges[d];
            c.push(new Ka(cd(e.anchor, b), cd(e.head, b)))
        }
        return La(c, a.sel.primIndex)
    }

    function ed(a, b, c) {
        return a.line == b.line ? oa(c.line, a.ch - b.ch + c.ch) : oa(c.line + (a.line - b.line), a.ch)
    }

    function fd(a, b, c) {
        for (var d = [], e = oa(a.first, 0), f = e, g = 0; g < b.length; g++) {
            var h = b[g],
                i = ed(h.from, e, f),
                j = ed(bd(h), e, f);
            if (e = h.to, f = j, "around" == c) {
                var k = a.sel.ranges[g],
                    l = pa(k.head, k.anchor) < 0;
                d[g] = new Ka(l ? j : i, l ? i : j)
            } else d[g] = new Ka(i, i)
        }
        return new Ja(d, a.sel.primIndex)
    }

    function gd(a, b, c) {
        var d = {
            canceled: !1,
            from: b.from,
            to: b.to,
            text: b.text,
            origin: b.origin,
            cancel: function() {
                this.canceled = !0
            }
        };
        return c && (d.update = function(b, c, d, e) {
            b && (this.from = Oa(a, b)), c && (this.to = Oa(a, c)), d && (this.text = d), void 0 !== e && (this.origin = e)
        }), Lf(a, "beforeChange", a, d), a.cm && Lf(a.cm, "beforeChange", a.cm, d), d.canceled ? null : {
            from: d.from,
            to: d.to,
            text: d.text,
            origin: d.origin
        }
    }

    function hd(a, b, c) {
        if (a.cm) {
            if (!a.cm.curOp) return dc(a.cm, hd)(a, b, c);
            if (a.cm.state.suppressEdits) return
        }
        if (!(Rf(a, "beforeChange") || a.cm && Rf(a.cm, "beforeChange")) || (b = gd(a, b, !0))) {
            var d = t && !c && ie(a, b.from, b.to);
            if (d)
                for (var e = d.length - 1; e >= 0; --e) id(a, {
                    from: d[e].from,
                    to: d[e].to,
                    text: e ? [""] : b.text
                });
            else id(a, b)
        }
    }

    function id(a, b) {
        if (1 != b.text.length || "" != b.text[0] || 0 != pa(b.from, b.to)) {
            var c = dd(a, b);
            sf(a, b, c, a.cm ? a.cm.curOp.id : NaN), ld(a, b, c, fe(a, b));
            var d = [];
            df(a, function(a, c) {
                c || -1 != dg(d, a.history) || (Cf(a.history, b), d.push(a.history)), ld(a, b, null, fe(a, b))
            })
        }
    }

    function jd(a, b, c) {
        if (!a.cm || !a.cm.state.suppressEdits) {
            for (var e, d = a.history, f = a.sel, g = "undo" == b ? d.done : d.undone, h = "undo" == b ? d.undone : d.done, i = 0; i < g.length && (e = g[i], c ? !e.ranges || e.equals(a.sel) : e.ranges); i++);
            if (i != g.length) {
                for (d.lastOrigin = d.lastSelOrigin = null; e = g.pop(), e.ranges;) {
                    if (vf(e, h), c && !e.equals(a.sel)) return void Za(a, e, {
                        clearRedo: !1
                    });
                    f = e
                }
                var j = [];
                vf(f, h), h.push({
                    changes: j,
                    generation: d.generation
                }), d.generation = e.generation || ++d.maxGeneration;
                for (var k = Rf(a, "beforeChange") || a.cm && Rf(a.cm, "beforeChange"), i = e.changes.length - 1; i >= 0; --i) {
                    var l = e.changes[i];
                    if (l.origin = b, k && !gd(a, l, !1)) return void(g.length = 0);
                    j.push(pf(a, l));
                    var m = i ? dd(a, l) : bg(g);
                    ld(a, l, m, he(a, l)), !i && a.cm && a.cm.scrollIntoView({
                        from: l.from,
                        to: bd(l)
                    });
                    var n = [];
                    df(a, function(a, b) {
                        b || -1 != dg(n, a.history) || (Cf(a.history, l), n.push(a.history)), ld(a, l, null, he(a, l))
                    })
                }
            }
        }
    }

    function kd(a, b) {
        if (0 != b && (a.first += b, a.sel = new Ja(eg(a.sel.ranges, function(a) {
                return new Ka(oa(a.anchor.line + b, a.anchor.ch), oa(a.head.line + b, a.head.ch))
            }), a.sel.primIndex), a.cm)) {
            ic(a.cm, a.first, a.first - b, b);
            for (var c = a.cm.display, d = c.viewFrom; d < c.viewTo; d++) jc(a.cm, d, "gutter")
        }
    }

    function ld(a, b, c, d) {
        if (a.cm && !a.cm.curOp) return dc(a.cm, ld)(a, b, c, d);
        if (b.to.line < a.first) return void kd(a, b.text.length - 1 - (b.to.line - b.from.line));
        if (!(b.from.line > a.lastLine())) {
            if (b.from.line < a.first) {
                var e = b.text.length - 1 - (a.first - b.from.line);
                kd(a, e), b = {
                    from: oa(a.first, 0),
                    to: oa(b.to.line + e, b.to.ch),
                    text: [bg(b.text)],
                    origin: b.origin
                }
            }
            var f = a.lastLine();
            b.to.line > f && (b = {
                from: b.from,
                to: oa(f, ff(a, f).text.length),
                text: [b.text[0]],
                origin: b.origin
            }), b.removed = gf(a, b.from, b.to), c || (c = dd(a, b)), a.cm ? md(a.cm, b, d) : Ye(a, b, d), $a(a, c, Vf)
        }
    }

    function md(a, b, c) {
        var d = a.doc,
            e = a.display,
            f = b.from,
            g = b.to,
            h = !1,
            i = f.line;
        a.options.lineWrapping || (i = kf(se(ff(d, f.line))), d.iter(i, g.line + 1, function(a) {
            return a == e.maxLine ? (h = !0, !0) : void 0
        })), d.sel.contains(b.from, b.to) > -1 && Qf(a), Ye(d, b, c, A(a)), a.options.lineWrapping || (d.iter(i, f.line + b.text.length, function(a) {
            var b = G(a);
            b > e.maxLineLength && (e.maxLine = a, e.maxLineLength = b, e.maxLineChanged = !0, h = !1)
        }), h && (a.curOp.updateMaxLine = !0)), d.frontier = Math.min(d.frontier, f.line), ib(a, 400);
        var j = b.text.length - (g.line - f.line) - 1;
        b.full ? ic(a) : f.line != g.line || 1 != b.text.length || Xe(a.doc, b) ? ic(a, f.line, g.line + 1, j) : jc(a, f.line, "text");
        var k = Rf(a, "changes"),
            l = Rf(a, "change");
        if (l || k) {
            var m = {
                from: f,
                to: g,
                text: b.text,
                removed: b.removed,
                origin: b.origin
            };
            l && Nf(a, "change", a, m), k && (a.curOp.changeObjs || (a.curOp.changeObjs = [])).push(m)
        }
        a.display.selForContextMenu = null
    }

    function nd(a, b, c, d, e) {
        if (d || (d = c), pa(d, c) < 0) {
            var f = d;
            d = c, c = f
        }
        "string" == typeof b && (b = a.splitLines(b)), hd(a, {
            from: c,
            to: d,
            text: b,
            origin: e
        })
    }

    function od(a, b) {
        if (!Pf(a, "scrollCursorIntoView")) {
            var c = a.display,
                d = c.sizer.getBoundingClientRect(),
                e = null;
            if (b.top + d.top < 0 ? e = !0 : b.bottom + d.top > (window.innerHeight || document.documentElement.clientHeight) && (e = !1), null != e && !l) {
                var f = pg("div", "\u200b", null, "position: absolute; top: " + (b.top - c.viewOffset - mb(a.display)) + "px; height: " + (b.bottom - b.top + pb(a) + c.barHeight) + "px; left: " + b.left + "px; width: 2px;");
                a.display.lineSpace.appendChild(f), f.scrollIntoView(e), a.display.lineSpace.removeChild(f)
            }
        }
    }

    function pd(a, b, c, d) {
        null == d && (d = 0);
        for (var e = 0; 5 > e; e++) {
            var f = !1,
                g = Lb(a, b),
                h = c && c != b ? Lb(a, c) : g,
                i = rd(a, Math.min(g.left, h.left), Math.min(g.top, h.top) - d, Math.max(g.left, h.left), Math.max(g.bottom, h.bottom) + d),
                j = a.doc.scrollTop,
                k = a.doc.scrollLeft;
            if (null != i.scrollTop && (Hc(a, i.scrollTop), Math.abs(a.doc.scrollTop - j) > 1 && (f = !0)), null != i.scrollLeft && (Ic(a, i.scrollLeft), Math.abs(a.doc.scrollLeft - k) > 1 && (f = !0)), !f) break
        }
        return g
    }

    function qd(a, b, c, d, e) {
        var f = rd(a, b, c, d, e);
        null != f.scrollTop && Hc(a, f.scrollTop), null != f.scrollLeft && Ic(a, f.scrollLeft)
    }

    function rd(a, b, c, d, e) {
        var f = a.display,
            g = Rb(a.display);
        0 > c && (c = 0);
        var h = a.curOp && null != a.curOp.scrollTop ? a.curOp.scrollTop : f.scroller.scrollTop,
            i = rb(a),
            j = {};
        e - c > i && (e = c + i);
        var k = a.doc.height + nb(f),
            l = g > c,
            m = e > k - g;
        if (h > c) j.scrollTop = l ? 0 : c;
        else if (e > h + i) {
            var n = Math.min(c, (m ? k : e) - i);
            n != h && (j.scrollTop = n)
        }
        var o = a.curOp && null != a.curOp.scrollLeft ? a.curOp.scrollLeft : f.scroller.scrollLeft,
            p = qb(a) - (a.options.fixedGutter ? f.gutters.offsetWidth : 0),
            q = d - b > p;
        return q && (d = b + p), 10 > b ? j.scrollLeft = 0 : o > b ? j.scrollLeft = Math.max(0, b - (q ? 0 : 10)) : d > p + o - 3 && (j.scrollLeft = d + (q ? 0 : 10) - p), j
    }

    function sd(a, b, c) {
        (null != b || null != c) && ud(a), null != b && (a.curOp.scrollLeft = (null == a.curOp.scrollLeft ? a.doc.scrollLeft : a.curOp.scrollLeft) + b), null != c && (a.curOp.scrollTop = (null == a.curOp.scrollTop ? a.doc.scrollTop : a.curOp.scrollTop) + c)
    }

    function td(a) {
        ud(a);
        var b = a.getCursor(),
            c = b,
            d = b;
        a.options.lineWrapping || (c = b.ch ? oa(b.line, b.ch - 1) : b, d = oa(b.line, b.ch + 1)), a.curOp.scrollToPos = {
            from: c,
            to: d,
            margin: a.options.cursorScrollMargin,
            isCursor: !0
        }
    }

    function ud(a) {
        var b = a.curOp.scrollToPos;
        if (b) {
            a.curOp.scrollToPos = null;
            var c = Mb(a, b.from),
                d = Mb(a, b.to),
                e = rd(a, Math.min(c.left, d.left), Math.min(c.top, d.top) - b.margin, Math.max(c.right, d.right), Math.max(c.bottom, d.bottom) + b.margin);
            a.scrollTo(e.scrollLeft, e.scrollTop)
        }
    }

    function vd(a, b, c, d) {
        var f, e = a.doc;
        null == c && (c = "add"), "smart" == c && (e.mode.indent ? f = lb(a, b) : c = "prev");
        var g = a.options.tabSize,
            h = ff(e, b),
            i = Zf(h.text, null, g);
        h.stateAfter && (h.stateAfter = null);
        var k, j = h.text.match(/^\s*/)[0];
        if (d || /\S/.test(h.text)) {
            if ("smart" == c && (k = e.mode.indent(f, h.text.slice(j.length), h.text), k == Uf || k > 150)) {
                if (!d) return;
                c = "prev"
            }
        } else k = 0, c = "not";
        "prev" == c ? k = b > e.first ? Zf(ff(e, b - 1).text, null, g) : 0 : "add" == c ? k = i + a.options.indentUnit : "subtract" == c ? k = i - a.options.indentUnit : "number" == typeof c && (k = i + c), k = Math.max(0, k);
        var l = "",
            m = 0;
        if (a.options.indentWithTabs)
            for (var n = Math.floor(k / g); n; --n) m += g, l += "	";
        if (k > m && (l += ag(k - m)), l != j) return nd(e, l, oa(b, 0), oa(b, j.length), "+input"), h.stateAfter = null, !0;
        for (var n = 0; n < e.sel.ranges.length; n++) {
            var o = e.sel.ranges[n];
            if (o.head.line == b && o.head.ch < j.length) {
                var m = oa(b, j.length);
                Va(e, n, new Ka(m, m));
                break
            }
        }
    }

    function wd(a, b, c, d) {
        var e = b,
            f = b;
        return "number" == typeof b ? f = ff(a, Na(a, b)) : e = kf(b), null == e ? null : (d(f, e) && a.cm && jc(a.cm, e, c), f)
    }

    function xd(a, b) {
        for (var c = a.doc.sel.ranges, d = [], e = 0; e < c.length; e++) {
            for (var f = b(c[e]); d.length && pa(f.from, bg(d).to) <= 0;) {
                var g = d.pop();
                if (pa(g.from, f.from) < 0) {
                    f.from = g.from;
                    break
                }
            }
            d.push(f)
        }
        cc(a, function() {
            for (var b = d.length - 1; b >= 0; b--) nd(a.doc, "", d[b].from, d[b].to, "+delete");
            td(a)
        })
    }

    function yd(a, b, c, d, e) {
        function k() {
            var b = f + c;
            return b < a.first || b >= a.first + a.size ? j = !1 : (f = b, i = ff(a, b))
        }

        function l(a) {
            var b = (e ? $g : _g)(i, g, c, !0);
            if (null == b) {
                if (a || !k()) return j = !1;
                g = e ? (0 > c ? Sg : Rg)(i) : 0 > c ? i.text.length : 0
            } else g = b;
            return !0
        }
        var f = b.line,
            g = b.ch,
            h = c,
            i = ff(a, f),
            j = !0;
        if ("char" == d) l();
        else if ("column" == d) l(!0);
        else if ("word" == d || "group" == d)
            for (var m = null, n = "group" == d, o = a.cm && a.cm.getHelper(b, "wordChars"), p = !0; !(0 > c) || l(!p); p = !1) {
                var q = i.text.charAt(g) || "\n",
                    r = lg(q, o) ? "w" : n && "\n" == q ? "n" : !n || /\s/.test(q) ? null : "p";
                if (!n || p || r || (r = "s"), m && m != r) {
                    0 > c && (c = 1, l());
                    break
                }
                if (r && (m = r), c > 0 && !l(!p)) break
            }
        var s = cb(a, oa(f, g), h, !0);
        return j || (s.hitSide = !0), s
    }

    function zd(a, b, c, d) {
        var g, e = a.doc,
            f = b.left;
        if ("page" == d) {
            var h = Math.min(a.display.wrapper.clientHeight, window.innerHeight || document.documentElement.clientHeight);
            g = b.top + c * (h - (0 > c ? 1.5 : .5) * Rb(a.display))
        } else "line" == d && (g = c > 0 ? b.bottom + 3 : b.top - 3);
        for (;;) {
            var i = Ob(a, f, g);
            if (!i.outside) break;
            if (0 > c ? 0 >= g : g >= e.height) {
                i.hitSide = !0;
                break
            }
            g += 5 * c
        }
        return i
    }

    function Cd(a, b, c, d) {
        v.defaults[a] = b, c && (Bd[a] = d ? function(a, b, d) {
            d != Dd && c(a, b, d)
        } : c)
    }

    function Nd(a) {
        for (var c, d, e, f, b = a.split(/-(?!$)/), a = b[b.length - 1], g = 0; g < b.length - 1; g++) {
            var h = b[g];
            if (/^(cmd|meta|m)$/i.test(h)) f = !0;
            else if (/^a(lt)?$/i.test(h)) c = !0;
            else if (/^(c|ctrl|control)$/i.test(h)) d = !0;
            else {
                if (!/^s(hift)$/i.test(h)) throw new Error("Unrecognized modifier name: " + h);
                e = !0
            }
        }
        return c && (a = "Alt-" + a), d && (a = "Ctrl-" + a), f && (a = "Cmd-" + a), e && (a = "Shift-" + a), a
    }

    function Rd(a) {
        return "string" == typeof a ? Md[a] : a
    }

    function Vd(a, b, c, d, e) {
        if (d && d.shared) return Xd(a, b, c, d, e);
        if (a.cm && !a.cm.curOp) return dc(a.cm, Vd)(a, b, c, d, e);
        var f = new Ud(a, e),
            g = pa(b, c);
        if (d && hg(d, f, !1), g > 0 || 0 == g && f.clearWhenEmpty !== !1) return f;
        if (f.replacedWith && (f.collapsed = !0, f.widgetNode = pg("span", [f.replacedWith], "CodeMirror-widget"), d.handleMouseEvents || f.widgetNode.setAttribute("cm-ignore-events", "true"), d.insertLeft && (f.widgetNode.insertLeft = !0)), f.collapsed) {
            if (re(a, b.line, b, c, f) || b.line != c.line && re(a, c.line, b, c, f)) throw new Error("Inserting collapsed marker partially overlapping an existing one");
            u = !0
        }
        f.addToHistory && sf(a, {
            from: b,
            to: c,
            origin: "markText"
        }, a.sel, NaN);
        var j, h = b.line,
            i = a.cm;
        if (a.iter(h, c.line + 1, function(a) {
                i && f.collapsed && !i.options.lineWrapping && se(a) == i.display.maxLine && (j = !0), f.collapsed && h != b.line && jf(a, 0), ce(a, new _d(f, h == b.line ? b.ch : null, h == c.line ? c.ch : null)), ++h
            }), f.collapsed && a.iter(b.line, c.line + 1, function(b) {
                we(a, b) && jf(b, 0)
            }), f.clearOnEnter && Jf(f, "beforeCursorEnter", function() {
                f.clear()
            }), f.readOnly && (t = !0, (a.history.done.length || a.history.undone.length) && a.clearHistory()), f.collapsed && (f.id = ++Td, f.atomic = !0), i) {
            if (j && (i.curOp.updateMaxLine = !0), f.collapsed) ic(i, b.line, c.line + 1);
            else if (f.className || f.title || f.startStyle || f.endStyle || f.css)
                for (var k = b.line; k <= c.line; k++) jc(i, k, "text");
            f.atomic && ab(i.doc), Nf(i, "markerAdded", i, f)
        }
        return f
    }

    function Xd(a, b, c, d, e) {
        d = hg(d), d.shared = !1;
        var f = [Vd(a, b, c, d, e)],
            g = f[0],
            h = d.widgetNode;
        return df(a, function(a) {
            h && (d.widgetNode = h.cloneNode(!0)), f.push(Vd(a, Oa(a, b), Oa(a, c), d, e));
            for (var i = 0; i < a.linked.length; ++i)
                if (a.linked[i].isParent) return;
            g = bg(f)
        }), new Wd(f, g)
    }

    function Yd(a) {
        return a.findMarks(oa(a.first, 0), a.clipPos(oa(a.lastLine())), function(a) {
            return a.parent
        })
    }

    function Zd(a, b) {
        for (var c = 0; c < b.length; c++) {
            var d = b[c],
                e = d.find(),
                f = a.clipPos(e.from),
                g = a.clipPos(e.to);
            if (pa(f, g)) {
                var h = Vd(a, f, g, d.primary, d.primary.type);
                d.markers.push(h), h.parent = d
            }
        }
    }

    function $d(a) {
        for (var b = 0; b < a.length; b++) {
            var c = a[b],
                d = [c.primary.doc];
            df(c.primary.doc, function(a) {
                d.push(a)
            });
            for (var e = 0; e < c.markers.length; e++) {
                var f = c.markers[e]; - 1 == dg(d, f.doc) && (f.parent = null, c.markers.splice(e--, 1))
            }
        }
    }

    function _d(a, b, c) {
        this.marker = a, this.from = b, this.to = c
    }

    function ae(a, b) {
        if (a)
            for (var c = 0; c < a.length; ++c) {
                var d = a[c];
                if (d.marker == b) return d
            }
    }

    function be(a, b) {
        for (var c, d = 0; d < a.length; ++d) a[d] != b && (c || (c = [])).push(a[d]);
        return c
    }

    function ce(a, b) {
        a.markedSpans = a.markedSpans ? a.markedSpans.concat([b]) : [b], b.marker.attachLine(a)
    }

    function de(a, b, c) {
        if (a)
            for (var e, d = 0; d < a.length; ++d) {
                var f = a[d],
                    g = f.marker,
                    h = null == f.from || (g.inclusiveLeft ? f.from <= b : f.from < b);
                if (h || f.from == b && "bookmark" == g.type && (!c || !f.marker.insertLeft)) {
                    var i = null == f.to || (g.inclusiveRight ? f.to >= b : f.to > b);
                    (e || (e = [])).push(new _d(g, f.from, i ? null : f.to))
                }
            }
        return e
    }

    function ee(a, b, c) {
        if (a)
            for (var e, d = 0; d < a.length; ++d) {
                var f = a[d],
                    g = f.marker,
                    h = null == f.to || (g.inclusiveRight ? f.to >= b : f.to > b);
                if (h || f.from == b && "bookmark" == g.type && (!c || f.marker.insertLeft)) {
                    var i = null == f.from || (g.inclusiveLeft ? f.from <= b : f.from < b);
                    (e || (e = [])).push(new _d(g, i ? null : f.from - b, null == f.to ? null : f.to - b))
                }
            }
        return e
    }

    function fe(a, b) {
        if (b.full) return null;
        var c = Qa(a, b.from.line) && ff(a, b.from.line).markedSpans,
            d = Qa(a, b.to.line) && ff(a, b.to.line).markedSpans;
        if (!c && !d) return null;
        var e = b.from.ch,
            f = b.to.ch,
            g = 0 == pa(b.from, b.to),
            h = de(c, e, g),
            i = ee(d, f, g),
            j = 1 == b.text.length,
            k = bg(b.text).length + (j ? e : 0);
        if (h)
            for (var l = 0; l < h.length; ++l) {
                var m = h[l];
                if (null == m.to) {
                    var n = ae(i, m.marker);
                    n ? j && (m.to = null == n.to ? null : n.to + k) : m.to = e
                }
            }
        if (i)
            for (var l = 0; l < i.length; ++l) {
                var m = i[l];
                if (null != m.to && (m.to += k), null == m.from) {
                    var n = ae(h, m.marker);
                    n || (m.from = k, j && (h || (h = [])).push(m))
                } else m.from += k, j && (h || (h = [])).push(m)
            }
        h && (h = ge(h)), i && i != h && (i = ge(i));
        var o = [h];
        if (!j) {
            var q, p = b.text.length - 2;
            if (p > 0 && h)
                for (var l = 0; l < h.length; ++l) null == h[l].to && (q || (q = [])).push(new _d(h[l].marker, null, null));
            for (var l = 0; p > l; ++l) o.push(q);
            o.push(i)
        }
        return o
    }

    function ge(a) {
        for (var b = 0; b < a.length; ++b) {
            var c = a[b];
            null != c.from && c.from == c.to && c.marker.clearWhenEmpty !== !1 && a.splice(b--, 1)
        }
        return a.length ? a : null
    }

    function he(a, b) {
        var c = yf(a, b),
            d = fe(a, b);
        if (!c) return d;
        if (!d) return c;
        for (var e = 0; e < c.length; ++e) {
            var f = c[e],
                g = d[e];
            if (f && g) a: for (var h = 0; h < g.length; ++h) {
                for (var i = g[h], j = 0; j < f.length; ++j)
                    if (f[j].marker == i.marker) continue a;
                f.push(i)
            } else g && (c[e] = g)
        }
        return c
    }

    function ie(a, b, c) {
        var d = null;
        if (a.iter(b.line, c.line + 1, function(a) {
                if (a.markedSpans)
                    for (var b = 0; b < a.markedSpans.length; ++b) {
                        var c = a.markedSpans[b].marker;
                        !c.readOnly || d && -1 != dg(d, c) || (d || (d = [])).push(c)
                    }
            }), !d) return null;
        for (var e = [{
                from: b,
                to: c
            }], f = 0; f < d.length; ++f)
            for (var g = d[f], h = g.find(0), i = 0; i < e.length; ++i) {
                var j = e[i];
                if (!(pa(j.to, h.from) < 0 || pa(j.from, h.to) > 0)) {
                    var k = [i, 1],
                        l = pa(j.from, h.from),
                        m = pa(j.to, h.to);
                    (0 > l || !g.inclusiveLeft && !l) && k.push({
                        from: j.from,
                        to: h.from
                    }), (m > 0 || !g.inclusiveRight && !m) && k.push({
                        from: h.to,
                        to: j.to
                    }), e.splice.apply(e, k), i += k.length - 1
                }
            }
        return e
    }

    function je(a) {
        var b = a.markedSpans;
        if (b) {
            for (var c = 0; c < b.length; ++c) b[c].marker.detachLine(a);
            a.markedSpans = null
        }
    }

    function ke(a, b) {
        if (b) {
            for (var c = 0; c < b.length; ++c) b[c].marker.attachLine(a);
            a.markedSpans = b
        }
    }

    function le(a) {
        return a.inclusiveLeft ? -1 : 0
    }

    function me(a) {
        return a.inclusiveRight ? 1 : 0
    }

    function ne(a, b) {
        var c = a.lines.length - b.lines.length;
        if (0 != c) return c;
        var d = a.find(),
            e = b.find(),
            f = pa(d.from, e.from) || le(a) - le(b);
        if (f) return -f;
        var g = pa(d.to, e.to) || me(a) - me(b);
        return g ? g : b.id - a.id
    }

    function oe(a, b) {
        var d, c = u && a.markedSpans;
        if (c)
            for (var e, f = 0; f < c.length; ++f) e = c[f], e.marker.collapsed && null == (b ? e.from : e.to) && (!d || ne(d, e.marker) < 0) && (d = e.marker);
        return d
    }

    function pe(a) {
        return oe(a, !0)
    }

    function qe(a) {
        return oe(a, !1)
    }

    function re(a, b, c, d, e) {
        var f = ff(a, b),
            g = u && f.markedSpans;
        if (g)
            for (var h = 0; h < g.length; ++h) {
                var i = g[h];
                if (i.marker.collapsed) {
                    var j = i.marker.find(0),
                        k = pa(j.from, c) || le(i.marker) - le(e),
                        l = pa(j.to, d) || me(i.marker) - me(e);
                    if (!(k >= 0 && 0 >= l || 0 >= k && l >= 0) && (0 >= k && (pa(j.to, c) > 0 || i.marker.inclusiveRight && e.inclusiveLeft) || k >= 0 && (pa(j.from, d) < 0 || i.marker.inclusiveLeft && e.inclusiveRight))) return !0
                }
            }
    }

    function se(a) {
        for (var b; b = pe(a);) a = b.find(-1, !0).line;
        return a
    }

    function te(a) {
        for (var b, c; b = qe(a);) a = b.find(1, !0).line, (c || (c = [])).push(a);
        return c
    }

    function ue(a, b) {
        var c = ff(a, b),
            d = se(c);
        return c == d ? b : kf(d)
    }

    function ve(a, b) {
        if (b > a.lastLine()) return b;
        var d, c = ff(a, b);
        if (!we(a, c)) return b;
        for (; d = qe(c);) c = d.find(1, !0).line;
        return kf(c) + 1
    }

    function we(a, b) {
        var c = u && b.markedSpans;
        if (c)
            for (var d, e = 0; e < c.length; ++e)
                if (d = c[e], d.marker.collapsed) {
                    if (null == d.from) return !0;
                    if (!d.marker.widgetNode && 0 == d.from && d.marker.inclusiveLeft && xe(a, b, d)) return !0
                }
    }

    function xe(a, b, c) {
        if (null == c.to) {
            var d = c.marker.find(1, !0);
            return xe(a, d.line, ae(d.line.markedSpans, c.marker))
        }
        if (c.marker.inclusiveRight && c.to == b.text.length) return !0;
        for (var e, f = 0; f < b.markedSpans.length; ++f)
            if (e = b.markedSpans[f], e.marker.collapsed && !e.marker.widgetNode && e.from == c.to && (null == e.to || e.to != c.from) && (e.marker.inclusiveLeft || c.marker.inclusiveRight) && xe(a, b, e)) return !0
    }

    function ze(a, b, c) {
        mf(b) < (a.curOp && a.curOp.scrollTop || a.doc.scrollTop) && sd(a, null, c)
    }

    function Ae(a) {
        if (null != a.height) return a.height;
        var b = a.doc.cm;
        if (!b) return 0;
        if (!tg(document.body, a.node)) {
            var c = "position: relative;";
            a.coverGutter && (c += "margin-left: -" + b.display.gutters.offsetWidth + "px;"), a.noHScroll && (c += "width: " + b.display.wrapper.clientWidth + "px;"), sg(b.display.measure, pg("div", [a.node], null, c))
        }
        return a.height = a.node.offsetHeight
    }

    function Be(a, b, c, d) {
        var e = new ye(a, c, d),
            f = a.cm;
        return f && e.noHScroll && (f.display.alignWidgets = !0), wd(a, b, "widget", function(b) {
            var c = b.widgets || (b.widgets = []);
            if (null == e.insertAt ? c.push(e) : c.splice(Math.min(c.length - 1, Math.max(0, e.insertAt)), 0, e), e.line = b, f && !we(a, b)) {
                var d = mf(b) < a.scrollTop;
                jf(b, b.height + Ae(e)), d && sd(f, null, e.height), f.curOp.forceUpdate = !0
            }
            return !0
        }), e
    }

    function De(a, b, c, d) {
        a.text = b, a.stateAfter && (a.stateAfter = null), a.styles && (a.styles = null), null != a.order && (a.order = null), je(a), ke(a, c);
        var e = d ? d(a) : 1;
        e != a.height && jf(a, e)
    }

    function Ee(a) {
        a.parent = null, je(a)
    }

    function Fe(a, b) {
        if (a)
            for (;;) {
                var c = a.match(/(?:^|\s+)line-(background-)?(\S+)/);
                if (!c) break;
                a = a.slice(0, c.index) + a.slice(c.index + c[0].length);
                var d = c[1] ? "bgClass" : "textClass";
                null == b[d] ? b[d] = c[2] : new RegExp("(?:^|s)" + c[2] + "(?:$|s)").test(b[d]) || (b[d] += " " + c[2])
            }
        return a
    }

    function Ge(a, b) {
        if (a.blankLine) return a.blankLine(b);
        if (a.innerMode) {
            var c = v.innerMode(a, b);
            return c.mode.blankLine ? c.mode.blankLine(c.state) : void 0
        }
    }

    function He(a, b, c, d) {
        for (var e = 0; 10 > e; e++) {
            d && (d[0] = v.innerMode(a, c).mode);
            var f = a.token(b, c);
            if (b.pos > b.start) return f
        }
        throw new Error("Mode " + a.name + " failed to advance stream.")
    }

    function Ie(a, b, c, d) {
        function e(a) {
            return {
                start: k.start,
                end: k.pos,
                string: k.current(),
                type: h || null,
                state: a ? Jd(f.mode, j) : j
            }
        }
        var h, f = a.doc,
            g = f.mode;
        b = Oa(f, b);
        var l, i = ff(f, b.line),
            j = lb(a, b.line, c),
            k = new Sd(i.text, a.options.tabSize);
        for (d && (l = []);
            (d || k.pos < b.ch) && !k.eol();) k.start = k.pos, h = He(g, k, j), d && l.push(e(!0));
        return d ? l : e()
    }

    function Je(a, b, c, d, e, f, g) {
        var h = c.flattenSpans;
        null == h && (h = a.options.flattenSpans);
        var l, i = 0,
            j = null,
            k = new Sd(b, a.options.tabSize),
            m = a.options.addModeClass && [null];
        for ("" == b && Fe(Ge(c, d), f); !k.eol();) {
            if (k.pos > a.options.maxHighlightLength ? (h = !1, g && Me(a, b, d, k.pos), k.pos = b.length, l = null) : l = Fe(He(c, k, d, m), f), m) {
                var n = m[0].name;
                n && (l = "m-" + (l ? n + " " + l : n))
            }
            if (!h || j != l) {
                for (; i < k.start;) i = Math.min(k.start, i + 5e4), e(i, j);
                j = l
            }
            k.start = k.pos
        }
        for (; i < k.pos;) {
            var o = Math.min(k.pos, i + 5e4);
            e(o, j), i = o
        }
    }

    function Ke(a, b, c, d) {
        var e = [a.state.modeGen],
            f = {};
        Je(a, b.text, a.doc.mode, c, function(a, b) {
            e.push(a, b)
        }, f, d);
        for (var g = 0; g < a.state.overlays.length; ++g) {
            var h = a.state.overlays[g],
                i = 1,
                j = 0;
            Je(a, b.text, h.mode, !0, function(a, b) {
                for (var c = i; a > j;) {
                    var d = e[i];
                    d > a && e.splice(i, 1, a, e[i + 1], d), i += 2, j = Math.min(a, d)
                }
                if (b)
                    if (h.opaque) e.splice(c, i - c, a, "cm-overlay " + b), i = c + 2;
                    else
                        for (; i > c; c += 2) {
                            var f = e[c + 1];
                            e[c + 1] = (f ? f + " " : "") + "cm-overlay " + b
                        }
            }, f)
        }
        return {
            styles: e,
            classes: f.bgClass || f.textClass ? f : null
        }
    }

    function Le(a, b, c) {
        if (!b.styles || b.styles[0] != a.state.modeGen) {
            var d = lb(a, kf(b)),
                e = Ke(a, b, b.text.length > a.options.maxHighlightLength ? Jd(a.doc.mode, d) : d);
            b.stateAfter = d, b.styles = e.styles, e.classes ? b.styleClasses = e.classes : b.styleClasses && (b.styleClasses = null), c === a.doc.frontier && a.doc.frontier++
        }
        return b.styles
    }

    function Me(a, b, c, d) {
        var e = a.doc.mode,
            f = new Sd(b, a.options.tabSize);
        for (f.start = f.pos = d || 0, "" == b && Ge(e, c); !f.eol();) He(e, f, c), f.start = f.pos
    }

    function Pe(a, b) {
        if (!a || /^\s*$/.test(a)) return null;
        var c = b.addModeClass ? Oe : Ne;
        return c[a] || (c[a] = a.replace(/\S+/g, "cm-$&"))
    }

    function Qe(a, b) {
        var c = pg("span", null, null, f ? "padding-right: .1px" : null),
            e = {
                pre: pg("pre", [c], "CodeMirror-line"),
                content: c,
                col: 0,
                pos: 0,
                cm: a,
                splitSpaces: (d || f) && a.getOption("lineWrapping")
            };
        b.measure = {};
        for (var g = 0; g <= (b.rest ? b.rest.length : 0); g++) {
            var i, h = g ? b.rest[g - 1] : b.line;
            e.pos = 0, e.addToken = Se, Hg(a.display.measure) && (i = nf(h)) && (e.addToken = Ue(e.addToken, i)), e.map = [];
            var j = b != a.display.externalMeasured && kf(h);
            We(h, e, Le(a, h, j)), h.styleClasses && (h.styleClasses.bgClass && (e.bgClass = yg(h.styleClasses.bgClass, e.bgClass || "")), h.styleClasses.textClass && (e.textClass = yg(h.styleClasses.textClass, e.textClass || ""))), 0 == e.map.length && e.map.push(0, 0, e.content.appendChild(Fg(a.display.measure))), 0 == g ? (b.measure.map = e.map, b.measure.cache = {}) : ((b.measure.maps || (b.measure.maps = [])).push(e.map), (b.measure.caches || (b.measure.caches = [])).push({}))
        }
        return f && /\bcm-tab\b/.test(e.content.lastChild.className) && (e.content.className = "cm-tab-wrap-hack"), Lf(a, "renderLine", a, b.line, e.pre), e.pre.className && (e.textClass = yg(e.pre.className, e.textClass || "")), e
    }

    function Re(a) {
        var b = pg("span", "\u2022", "cm-invalidchar");
        return b.title = "\\u" + a.charCodeAt(0).toString(16), b.setAttribute("aria-label", b.title), b
    }

    function Se(a, b, c, f, g, h, i) {
        if (b) {
            var j = a.splitSpaces ? b.replace(/ {3,}/g, Te) : b,
                k = a.cm.state.specialChars,
                l = !1;
            if (k.test(b))
                for (var m = document.createDocumentFragment(), n = 0;;) {
                    k.lastIndex = n;
                    var o = k.exec(b),
                        p = o ? o.index - n : b.length - n;
                    if (p) {
                        var q = document.createTextNode(j.slice(n, n + p));
                        d && 9 > e ? m.appendChild(pg("span", [q])) : m.appendChild(q), a.map.push(a.pos, a.pos + p, q), a.col += p, a.pos += p
                    }
                    if (!o) break;
                    if (n += p + 1, "	" == o[0]) {
                        var r = a.cm.options.tabSize,
                            s = r - a.col % r,
                            q = m.appendChild(pg("span", ag(s), "cm-tab"));
                        q.setAttribute("role", "presentation"), q.setAttribute("cm-text", "	"), a.col += s
                    } else if ("\r" == o[0] || "\n" == o[0]) {
                        var q = m.appendChild(pg("span", "\r" == o[0] ? "\u240d" : "\u2424", "cm-invalidchar"));
                        q.setAttribute("cm-text", o[0]), a.col += 1
                    } else {
                        var q = a.cm.options.specialCharPlaceholder(o[0]);
                        q.setAttribute("cm-text", o[0]), d && 9 > e ? m.appendChild(pg("span", [q])) : m.appendChild(q), a.col += 1
                    }
                    a.map.push(a.pos, a.pos + 1, q), a.pos++
                } else {
                    a.col += b.length;
                    var m = document.createTextNode(j);
                    a.map.push(a.pos, a.pos + b.length, m), d && 9 > e && (l = !0), a.pos += b.length
                }
            if (c || f || g || l || i) {
                var t = c || "";
                f && (t += f), g && (t += g);
                var u = pg("span", [m], t, i);
                return h && (u.title = h), a.content.appendChild(u)
            }
            a.content.appendChild(m)
        }
    }

    function Te(a) {
        for (var b = " ", c = 0; c < a.length - 2; ++c) b += c % 2 ? " " : "\xa0";
        return b += " "
    }

    function Ue(a, b) {
        return function(c, d, e, f, g, h, i) {
            e = e ? e + " cm-force-border" : "cm-force-border";
            for (var j = c.pos, k = j + d.length;;) {
                for (var l = 0; l < b.length; l++) {
                    var m = b[l];
                    if (m.to > j && m.from <= j) break
                }
                if (m.to >= k) return a(c, d, e, f, g, h, i);
                a(c, d.slice(0, m.to - j), e, f, null, h, i), f = null, d = d.slice(m.to - j), j = m.to
            }
        }
    }

    function Ve(a, b, c, d) {
        var e = !d && c.widgetNode;
        e && a.map.push(a.pos, a.pos + b, e), !d && a.cm.display.input.needsContentAttribute && (e || (e = a.content.appendChild(document.createElement("span"))), e.setAttribute("cm-marker", c.id)), e && (a.cm.display.input.setUneditable(e), a.content.appendChild(e)), a.pos += b
    }

    function We(a, b, c) {
        var d = a.markedSpans,
            e = a.text,
            f = 0;
        if (d)
            for (var k, l, n, o, p, q, r, h = e.length, i = 0, g = 1, j = "", m = 0;;) {
                if (m == i) {
                    n = o = p = q = l = "", r = null, m = 1 / 0;
                    for (var s = [], t = 0; t < d.length; ++t) {
                        var u = d[t],
                            v = u.marker;
                        "bookmark" == v.type && u.from == i && v.widgetNode ? s.push(v) : u.from <= i && (null == u.to || u.to > i || v.collapsed && u.to == i && u.from == i) ? (null != u.to && u.to != i && m > u.to && (m = u.to, o = ""), v.className && (n += " " + v.className), v.css && (l = v.css), v.startStyle && u.from == i && (p += " " + v.startStyle), v.endStyle && u.to == m && (o += " " + v.endStyle), v.title && !q && (q = v.title), v.collapsed && (!r || ne(r.marker, v) < 0) && (r = u)) : u.from > i && m > u.from && (m = u.from)
                    }
                    if (r && (r.from || 0) == i) {
                        if (Ve(b, (null == r.to ? h + 1 : r.to) - i, r.marker, null == r.from), null == r.to) return;
                        r.to == i && (r = !1)
                    }
                    if (!r && s.length)
                        for (var t = 0; t < s.length; ++t) Ve(b, 0, s[t])
                }
                if (i >= h) break;
                for (var w = Math.min(h, m);;) {
                    if (j) {
                        var x = i + j.length;
                        if (!r) {
                            var y = x > w ? j.slice(0, w - i) : j;
                            b.addToken(b, y, k ? k + n : n, p, i + y.length == m ? o : "", q, l)
                        }
                        if (x >= w) {
                            j = j.slice(w - i), i = w;
                            break
                        }
                        i = x, p = ""
                    }
                    j = e.slice(f, f = c[g++]), k = Pe(c[g++], b.cm.options)
                }
            } else
                for (var g = 1; g < c.length; g += 2) b.addToken(b, e.slice(f, f = c[g]), Pe(c[g + 1], b.cm.options))
    }

    function Xe(a, b) {
        return 0 == b.from.ch && 0 == b.to.ch && "" == bg(b.text) && (!a.cm || a.cm.options.wholeLineUpdateBefore)
    }

    function Ye(a, b, c, d) {
        function e(a) {
            return c ? c[a] : null
        }

        function f(a, c, e) {
            De(a, c, e, d), Nf(a, "change", a, b)
        }

        function g(a, b) {
            for (var c = a, f = []; b > c; ++c) f.push(new Ce(j[c], e(c), d));
            return f
        }
        var h = b.from,
            i = b.to,
            j = b.text,
            k = ff(a, h.line),
            l = ff(a, i.line),
            m = bg(j),
            n = e(j.length - 1),
            o = i.line - h.line;
        if (b.full) a.insert(0, g(0, j.length)), a.remove(j.length, a.size - j.length);
        else if (Xe(a, b)) {
            var p = g(0, j.length - 1);
            f(l, l.text, n), o && a.remove(h.line, o), p.length && a.insert(h.line, p)
        } else if (k == l)
            if (1 == j.length) f(k, k.text.slice(0, h.ch) + m + k.text.slice(i.ch), n);
            else {
                var p = g(1, j.length - 1);
                p.push(new Ce(m + k.text.slice(i.ch), n, d)), f(k, k.text.slice(0, h.ch) + j[0], e(0)), a.insert(h.line + 1, p)
            }
        else if (1 == j.length) f(k, k.text.slice(0, h.ch) + j[0] + l.text.slice(i.ch), e(0)), a.remove(h.line + 1, o);
        else {
            f(k, k.text.slice(0, h.ch) + j[0], e(0)), f(l, m + l.text.slice(i.ch), n);
            var p = g(1, j.length - 1);
            o > 1 && a.remove(h.line + 1, o - 1), a.insert(h.line + 1, p)
        }
        Nf(a, "change", a, b)
    }

    function Ze(a) {
        this.lines = a, this.parent = null;
        for (var b = 0, c = 0; b < a.length; ++b) a[b].parent = this, c += a[b].height;
        this.height = c
    }

    function $e(a) {
        this.children = a;
        for (var b = 0, c = 0, d = 0; d < a.length; ++d) {
            var e = a[d];
            b += e.chunkSize(), c += e.height, e.parent = this
        }
        this.size = b, this.height = c, this.parent = null
    }

    function df(a, b, c) {
        function d(a, e, f) {
            if (a.linked)
                for (var g = 0; g < a.linked.length; ++g) {
                    var h = a.linked[g];
                    if (h.doc != e) {
                        var i = f && h.sharedHist;
                        (!c || i) && (b(h.doc, i), d(h.doc, a, i))
                    }
                }
        }
        d(a, null, !0)
    }

    function ef(a, b) {
        if (b.cm) throw new Error("This document is already in use.");
        a.doc = b, b.cm = a, B(a), x(a), a.options.lineWrapping || H(a), a.options.mode = b.modeOption, ic(a)
    }

    function ff(a, b) {
        if (b -= a.first, 0 > b || b >= a.size) throw new Error("There is no line " + (b + a.first) + " in the document.");
        for (var c = a; !c.lines;)
            for (var d = 0;; ++d) {
                var e = c.children[d],
                    f = e.chunkSize();
                if (f > b) {
                    c = e;
                    break
                }
                b -= f
            }
        return c.lines[b]
    }

    function gf(a, b, c) {
        var d = [],
            e = b.line;
        return a.iter(b.line, c.line + 1, function(a) {
            var f = a.text;
            e == c.line && (f = f.slice(0, c.ch)), e == b.line && (f = f.slice(b.ch)), d.push(f), ++e
        }), d
    }

    function hf(a, b, c) {
        var d = [];
        return a.iter(b, c, function(a) {
            d.push(a.text)
        }), d
    }

    function jf(a, b) {
        var c = b - a.height;
        if (c)
            for (var d = a; d; d = d.parent) d.height += c
    }

    function kf(a) {
        if (null == a.parent) return null;
        for (var b = a.parent, c = dg(b.lines, a), d = b.parent; d; b = d, d = d.parent)
            for (var e = 0; d.children[e] != b; ++e) c += d.children[e].chunkSize();
        return c + b.first
    }

    function lf(a, b) {
        var c = a.first;
        a: do {
            for (var d = 0; d < a.children.length; ++d) {
                var e = a.children[d],
                    f = e.height;
                if (f > b) {
                    a = e;
                    continue a
                }
                b -= f, c += e.chunkSize()
            }
            return c
        } while (!a.lines);
        for (var d = 0; d < a.lines.length; ++d) {
            var g = a.lines[d],
                h = g.height;
            if (h > b) break;
            b -= h
        }
        return c + d
    }

    function mf(a) {
        a = se(a);
        for (var b = 0, c = a.parent, d = 0; d < c.lines.length; ++d) {
            var e = c.lines[d];
            if (e == a) break;
            b += e.height
        }
        for (var f = c.parent; f; c = f, f = c.parent)
            for (var d = 0; d < f.children.length; ++d) {
                var g = f.children[d];
                if (g == c) break;
                b += g.height
            }
        return b
    }

    function nf(a) {
        var b = a.order;
        return null == b && (b = a.order = ah(a.text)), b
    }

    function of (a) {
        this.done = [], this.undone = [], this.undoDepth = 1 / 0, this.lastModTime = this.lastSelTime = 0, this.lastOp = this.lastSelOp = null, this.lastOrigin = this.lastSelOrigin = null, this.generation = this.maxGeneration = a || 1
    }

    function pf(a, b) {
        var c = {
            from: qa(b.from),
            to: bd(b),
            text: gf(a, b.from, b.to)
        };
        return wf(a, c, b.from.line, b.to.line + 1), df(a, function(a) {
            wf(a, c, b.from.line, b.to.line + 1)
        }, !0), c
    }

    function qf(a) {
        for (; a.length;) {
            var b = bg(a);
            if (!b.ranges) break;
            a.pop()
        }
    }

    function rf(a, b) {
        return b ? (qf(a.done), bg(a.done)) : a.done.length && !bg(a.done).ranges ? bg(a.done) : a.done.length > 1 && !a.done[a.done.length - 2].ranges ? (a.done.pop(), bg(a.done)) : void 0
    }

    function sf(a, b, c, d) {
        var e = a.history;
        e.undone.length = 0;
        var g, f = +new Date;
        if ((e.lastOp == d || e.lastOrigin == b.origin && b.origin && ("+" == b.origin.charAt(0) && a.cm && e.lastModTime > f - a.cm.options.historyEventDelay || "*" == b.origin.charAt(0))) && (g = rf(e, e.lastOp == d))) {
            var h = bg(g.changes);
            0 == pa(b.from, b.to) && 0 == pa(b.from, h.to) ? h.to = bd(b) : g.changes.push(pf(a, b))
        } else {
            var i = bg(e.done);
            for (i && i.ranges || vf(a.sel, e.done), g = {
                    changes: [pf(a, b)],
                    generation: e.generation
                }, e.done.push(g); e.done.length > e.undoDepth;) e.done.shift(), e.done[0].ranges || e.done.shift()
        }
        e.done.push(c), e.generation = ++e.maxGeneration, e.lastModTime = e.lastSelTime = f, e.lastOp = e.lastSelOp = d, e.lastOrigin = e.lastSelOrigin = b.origin, h || Lf(a, "historyAdded")
    }

    function tf(a, b, c, d) {
        var e = b.charAt(0);
        return "*" == e || "+" == e && c.ranges.length == d.ranges.length && c.somethingSelected() == d.somethingSelected() && new Date - a.history.lastSelTime <= (a.cm ? a.cm.options.historyEventDelay : 500)
    }

    function uf(a, b, c, d) {
        var e = a.history,
            f = d && d.origin;
        c == e.lastSelOp || f && e.lastSelOrigin == f && (e.lastModTime == e.lastSelTime && e.lastOrigin == f || tf(a, f, bg(e.done), b)) ? e.done[e.done.length - 1] = b : vf(b, e.done), e.lastSelTime = +new Date, e.lastSelOrigin = f, e.lastSelOp = c, d && d.clearRedo !== !1 && qf(e.undone)
    }

    function vf(a, b) {
        var c = bg(b);
        c && c.ranges && c.equals(a) || b.push(a)
    }

    function wf(a, b, c, d) {
        var e = b["spans_" + a.id],
            f = 0;
        a.iter(Math.max(a.first, c), Math.min(a.first + a.size, d), function(c) {
            c.markedSpans && ((e || (e = b["spans_" + a.id] = {}))[f] = c.markedSpans), ++f
        })
    }

    function xf(a) {
        if (!a) return null;
        for (var c, b = 0; b < a.length; ++b) a[b].marker.explicitlyCleared ? c || (c = a.slice(0, b)) : c && c.push(a[b]);
        return c ? c.length ? c : null : a
    }

    function yf(a, b) {
        var c = b["spans_" + a.id];
        if (!c) return null;
        for (var d = 0, e = []; d < b.text.length; ++d) e.push(xf(c[d]));
        return e
    }

    function zf(a, b, c) {
        for (var d = 0, e = []; d < a.length; ++d) {
            var f = a[d];
            if (f.ranges) e.push(c ? Ja.prototype.deepCopy.call(f) : f);
            else {
                var g = f.changes,
                    h = [];
                e.push({
                    changes: h
                });
                for (var i = 0; i < g.length; ++i) {
                    var k, j = g[i];
                    if (h.push({
                            from: j.from,
                            to: j.to,
                            text: j.text
                        }), b)
                        for (var l in j)(k = l.match(/^spans_(\d+)$/)) && dg(b, Number(k[1])) > -1 && (bg(h)[l] = j[l], delete j[l])
                }
            }
        }
        return e
    }

    function Af(a, b, c, d) {
        c < a.line ? a.line += d : b < a.line && (a.line = b, a.ch = 0)
    }

    function Bf(a, b, c, d) {
        for (var e = 0; e < a.length; ++e) {
            var f = a[e],
                g = !0;
            if (f.ranges) {
                f.copied || (f = a[e] = f.deepCopy(), f.copied = !0);
                for (var h = 0; h < f.ranges.length; h++) Af(f.ranges[h].anchor, b, c, d), Af(f.ranges[h].head, b, c, d)
            } else {
                for (var h = 0; h < f.changes.length; ++h) {
                    var i = f.changes[h];
                    if (c < i.from.line) i.from = oa(i.from.line + d, i.from.ch), i.to = oa(i.to.line + d, i.to.ch);
                    else if (b <= i.to.line) {
                        g = !1;
                        break
                    }
                }
                g || (a.splice(0, e + 1), e = 0)
            }
        }
    }

    function Cf(a, b) {
        var c = b.from.line,
            d = b.to.line,
            e = b.text.length - (d - c) - 1;
        Bf(a.done, c, d, e), Bf(a.undone, c, d, e)
    }

    function Ff(a) {
        return null != a.defaultPrevented ? a.defaultPrevented : 0 == a.returnValue
    }

    function Hf(a) {
        return a.target || a.srcElement
    }

    function If(a) {
        var b = a.which;
        return null == b && (1 & a.button ? b = 1 : 2 & a.button ? b = 3 : 4 & a.button && (b = 2)), o && a.ctrlKey && 1 == b && (b = 3), b
    }

    function Nf(a, b) {
        function f(a) {
            return function() {
                a.apply(null, d)
            }
        }
        var c = a._handlers && a._handlers[b];
        if (c) {
            var e, d = Array.prototype.slice.call(arguments, 2);
            Tb ? e = Tb.delayedCallbacks : Mf ? e = Mf : (e = Mf = [], setTimeout(Of, 0));
            for (var g = 0; g < c.length; ++g) e.push(f(c[g]))
        }
    }

    function Of() {
        var a = Mf;
        Mf = null;
        for (var b = 0; b < a.length; ++b) a[b]()
    }

    function Pf(a, b, c) {
        return "string" == typeof b && (b = {
            type: b,
            preventDefault: function() {
                this.defaultPrevented = !0
            }
        }), Lf(a, c || b.type, a, b), Ff(b) || b.codemirrorIgnore
    }

    function Qf(a) {
        var b = a._handlers && a._handlers.cursorActivity;
        if (b)
            for (var c = a.curOp.cursorActivityHandlers || (a.curOp.cursorActivityHandlers = []), d = 0; d < b.length; ++d) - 1 == dg(c, b[d]) && c.push(b[d])
    }

    function Rf(a, b) {
        var c = a._handlers && a._handlers[b];
        return c && c.length > 0
    }

    function Sf(a) {
        a.prototype.on = function(a, b) {
            Jf(this, a, b)
        }, a.prototype.off = function(a, b) {
            Kf(this, a, b)
        }
    }

    function Yf() {
        this.id = null
    }

    function ag(a) {
        for (; _f.length <= a;) _f.push(bg(_f) + " ");
        return _f[a]
    }

    function bg(a) {
        return a[a.length - 1]
    }

    function dg(a, b) {
        for (var c = 0; c < a.length; ++c)
            if (a[c] == b) return c;
        return -1
    }

    function eg(a, b) {
        for (var c = [], d = 0; d < a.length; d++) c[d] = b(a[d], d);
        return c
    }

    function fg() {}

    function gg(a, b) {
        var c;
        return Object.create ? c = Object.create(a) : (fg.prototype = a, c = new fg), b && hg(b, c), c
    }

    function hg(a, b, c) {
        b || (b = {});
        for (var d in a) !a.hasOwnProperty(d) || c === !1 && b.hasOwnProperty(d) || (b[d] = a[d]);
        return b
    }

    function ig(a) {
        var b = Array.prototype.slice.call(arguments, 1);
        return function() {
            return a.apply(null, b)
        }
    }

    function lg(a, b) {
        return b ? b.source.indexOf("\\w") > -1 && kg(a) ? !0 : b.test(a) : kg(a)
    }

    function mg(a) {
        for (var b in a)
            if (a.hasOwnProperty(b) && a[b]) return !1;
        return !0
    }

    function og(a) {
        return a.charCodeAt(0) >= 768 && ng.test(a)
    }

    function pg(a, b, c, d) {
        var e = document.createElement(a);
        if (c && (e.className = c), d && (e.style.cssText = d), "string" == typeof b) e.appendChild(document.createTextNode(b));
        else if (b)
            for (var f = 0; f < b.length; ++f) e.appendChild(b[f]);
        return e
    }

    function rg(a) {
        for (var b = a.childNodes.length; b > 0; --b) a.removeChild(a.firstChild);
        return a
    }

    function sg(a, b) {
        return rg(a).appendChild(b)
    }

    function ug() {
        for (var a = document.activeElement; a && a.root && a.root.activeElement;) a = a.root.activeElement;
        return a
    }

    function vg(a) {
        return new RegExp("(^|\\s)" + a + "(?:$|\\s)\\s*")
    }

    function yg(a, b) {
        for (var c = a.split(" "), d = 0; d < c.length; d++) c[d] && !vg(c[d]).test(b) && (b += " " + c[d]);
        return b
    }

    function zg(a) {
        if (document.body.getElementsByClassName)
            for (var b = document.body.getElementsByClassName("CodeMirror"), c = 0; c < b.length; c++) {
                var d = b[c].CodeMirror;
                d && a(d)
            }
    }

    function Bg() {
        Ag || (Cg(), Ag = !0)
    }

    function Cg() {
        var a;
        Jf(window, "resize", function() {
            null == a && (a = setTimeout(function() {
                a = null, zg(rc)
            }, 100))
        }), Jf(window, "blur", function() {
            zg($c)
        })
    }

    function Fg(a) {
        if (null == Eg) {
            var b = pg("span", "\u200b");
            sg(a, pg("span", [b, document.createTextNode("x")])), 0 != a.firstChild.offsetHeight && (Eg = b.offsetWidth <= 1 && b.offsetHeight > 2 && !(d && 8 > e))
        }
        var c = Eg ? pg("span", "\u200b") : pg("span", "\xa0", null, "display: inline-block; width: 1px; margin-right: -1px");
        return c.setAttribute("cm-text", ""), c
    }

    function Hg(a) {
        if (null != Gg) return Gg;
        var b = sg(a, document.createTextNode("A\u062eA")),
            c = qg(b, 0, 1).getBoundingClientRect();
        if (!c || c.left == c.right) return !1;
        var d = qg(b, 1, 2).getBoundingClientRect();
        return Gg = d.right - c.right < 3
    }

    function Mg(a) {
        if (null != Lg) return Lg;
        var b = sg(a, pg("span", "x")),
            c = b.getBoundingClientRect(),
            d = qg(b, 0, 1).getBoundingClientRect();
        return Lg = Math.abs(c.left - d.left) > 1
    }

    function Og(a, b, c, d) {
        if (!a) return d(b, c, "ltr");
        for (var e = !1, f = 0; f < a.length; ++f) {
            var g = a[f];
            (g.from < c && g.to > b || b == c && g.to == b) && (d(Math.max(g.from, b), Math.min(g.to, c), 1 == g.level ? "rtl" : "ltr"), e = !0)
        }
        e || d(b, c, "ltr")
    }

    function Pg(a) {
        return a.level % 2 ? a.to : a.from
    }

    function Qg(a) {
        return a.level % 2 ? a.from : a.to
    }

    function Rg(a) {
        var b = nf(a);
        return b ? Pg(b[0]) : 0
    }

    function Sg(a) {
        var b = nf(a);
        return b ? Qg(bg(b)) : a.text.length
    }

    function Tg(a, b) {
        var c = ff(a.doc, b),
            d = se(c);
        d != c && (b = kf(d));
        var e = nf(d),
            f = e ? e[0].level % 2 ? Sg(d) : Rg(d) : 0;
        return oa(b, f)
    }

    function Ug(a, b) {
        for (var c, d = ff(a.doc, b); c = qe(d);) d = c.find(1, !0).line, b = null;
        var e = nf(d),
            f = e ? e[0].level % 2 ? Rg(d) : Sg(d) : d.text.length;
        return oa(null == b ? kf(d) : b, f)
    }

    function Vg(a, b) {
        var c = Tg(a, b.line),
            d = ff(a.doc, c.line),
            e = nf(d);
        if (!e || 0 == e[0].level) {
            var f = Math.max(0, d.text.search(/\S/)),
                g = b.line == c.line && b.ch <= f && b.ch;
            return oa(c.line, g ? 0 : f)
        }
        return c
    }

    function Wg(a, b, c) {
        var d = a[0].level;
        return b == d ? !0 : c == d ? !1 : c > b
    }

    function Yg(a, b) {
        Xg = null;
        for (var d, c = 0; c < a.length; ++c) {
            var e = a[c];
            if (e.from < b && e.to > b) return c;
            if (e.from == b || e.to == b) {
                if (null != d) return Wg(a, e.level, a[d].level) ? (e.from != e.to && (Xg = d), c) : (e.from != e.to && (Xg = c), d);
                d = c
            }
        }
        return d
    }

    function Zg(a, b, c, d) {
        if (!d) return b + c;
        do b += c; while (b > 0 && og(a.text.charAt(b)));
        return b
    }

    function $g(a, b, c, d) {
        var e = nf(a);
        if (!e) return _g(a, b, c, d);
        for (var f = Yg(e, b), g = e[f], h = Zg(a, b, g.level % 2 ? -c : c, d);;) {
            if (h > g.from && h < g.to) return h;
            if (h == g.from || h == g.to) return Yg(e, h) == f ? h : (g = e[f += c], c > 0 == g.level % 2 ? g.to : g.from);
            if (g = e[f += c], !g) return null;
            h = c > 0 == g.level % 2 ? Zg(a, g.to, -1, d) : Zg(a, g.from, 1, d)
        }
    }

    function _g(a, b, c, d) {
        var e = b + c;
        if (d)
            for (; e > 0 && og(a.text.charAt(e));) e += c;
        return 0 > e || e > a.text.length ? null : e
    }
    var a = /gecko\/\d/i.test(navigator.userAgent),
        b = /MSIE \d/.test(navigator.userAgent),
        c = /Trident\/(?:[7-9]|\d{2,})\..*rv:(\d+)/.exec(navigator.userAgent),
        d = b || c,
        e = d && (b ? document.documentMode || 6 : c[1]),
        f = /WebKit\//.test(navigator.userAgent),
        g = f && /Qt\/\d+\.\d+/.test(navigator.userAgent),
        h = /Chrome\//.test(navigator.userAgent),
        i = /Opera\//.test(navigator.userAgent),
        j = /Apple Computer/.test(navigator.vendor),
        k = /Mac OS X 1\d\D([8-9]|\d\d)\D/.test(navigator.userAgent),
        l = /PhantomJS/.test(navigator.userAgent),
        m = /AppleWebKit/.test(navigator.userAgent) && /Mobile\/\w+/.test(navigator.userAgent),
        n = m || /Android|webOS|BlackBerry|Opera Mini|Opera Mobi|IEMobile/i.test(navigator.userAgent),
        o = m || /Mac/.test(navigator.platform),
        p = /win/i.test(navigator.platform),
        q = i && navigator.userAgent.match(/Version\/(\d*\.\d*)/);
    q && (q = Number(q[1])), q && q >= 15 && (i = !1, f = !0);
    var r = o && (g || i && (null == q || 12.11 > q)),
        s = a || d && e >= 9,
        t = !1,
        u = !1;
    K.prototype = hg({
        update: function(a) {
            var b = a.scrollWidth > a.clientWidth + 1,
                c = a.scrollHeight > a.clientHeight + 1,
                d = a.nativeBarWidth;
            if (c) {
                this.vert.style.display = "block", this.vert.style.bottom = b ? d + "px" : "0";
                var e = a.viewHeight - (b ? d : 0);
                this.vert.firstChild.style.height = Math.max(0, a.scrollHeight - a.clientHeight + e) + "px"
            } else this.vert.style.display = "", this.vert.firstChild.style.height = "0";
            if (b) {
                this.horiz.style.display = "block", this.horiz.style.right = c ? d + "px" : "0", this.horiz.style.left = a.barLeft + "px";
                var f = a.viewWidth - a.barLeft - (c ? d : 0);
                this.horiz.firstChild.style.width = a.scrollWidth - a.clientWidth + f + "px"
            } else this.horiz.style.display = "", this.horiz.firstChild.style.width = "0";
            return !this.checkedOverlay && a.clientHeight > 0 && (0 == d && this.overlayHack(), this.checkedOverlay = !0), {
                right: c ? d : 0,
                bottom: b ? d : 0
            }
        },
        setScrollLeft: function(a) {
            this.horiz.scrollLeft != a && (this.horiz.scrollLeft = a)
        },
        setScrollTop: function(a) {
            this.vert.scrollTop != a && (this.vert.scrollTop = a)
        },
        overlayHack: function() {
            var a = o && !k ? "12px" : "18px";
            this.horiz.style.minHeight = this.vert.style.minWidth = a;
            var b = this,
                c = function(a) {
                    Hf(a) != b.vert && Hf(a) != b.horiz && dc(b.cm, uc)(a)
                };
            Jf(this.vert, "mousedown", c), Jf(this.horiz, "mousedown", c)
        },
        clear: function() {
            var a = this.horiz.parentNode;
            a.removeChild(this.horiz), a.removeChild(this.vert)
        }
    }, K.prototype), L.prototype = hg({
        update: function() {
            return {
                bottom: 0,
                right: 0
            }
        },
        setScrollLeft: function() {},
        setScrollTop: function() {},
        clear: function() {}
    }, L.prototype), v.scrollbarModel = {
        "native": K,
        "null": L
    }, U.prototype.signal = function(a, b) {
        Rf(a, b) && this.events.push(arguments)
    }, U.prototype.finish = function() {
        for (var a = 0; a < this.events.length; a++) Lf.apply(null, this.events[a])
    };
    var oa = v.Pos = function(a, b) {
            return this instanceof oa ? (this.line = a, void(this.ch = b)) : new oa(a, b)
        },
        pa = v.cmpPos = function(a, b) {
            return a.line - b.line || a.ch - b.ch
        },
        va = null;
    Ba.prototype = hg({
        init: function(a) {
            function h(a) {
                if (c.somethingSelected()) va = c.getSelections(), b.inaccurateSelection && (b.prevInput = "", b.inaccurateSelection = !1, g.value = va.join("\n"), cg(g));
                else {
                    if (!c.options.lineWiseCopyCut) return;
                    var d = za(c);
                    va = d.text, "cut" == a.type ? c.setSelections(d.ranges, null, Vf) : (b.prevInput = "", g.value = d.text.join("\n"), cg(g))
                }
                "cut" == a.type && (c.state.cutIncoming = !0)
            }
            var b = this,
                c = this.cm,
                f = this.wrapper = Ca(),
                g = this.textarea = f.firstChild;
            a.wrapper.insertBefore(f, a.wrapper.firstChild), m && (g.style.width = "0px"), Jf(g, "input", function() {
                d && e >= 9 && b.hasSelection && (b.hasSelection = null), b.poll()
            }), Jf(g, "paste", function(a) {
                return xa(a, c) ? !0 : (c.state.pasteIncoming = !0, void b.fastPoll())
            }), Jf(g, "cut", h), Jf(g, "copy", h), Jf(a.scroller, "paste", function(d) {
                sc(a, d) || (c.state.pasteIncoming = !0, b.focus())
            }), Jf(a.lineSpace, "selectstart", function(b) {
                sc(a, b) || Df(b)
            }), Jf(g, "compositionstart", function() {
                var a = c.getCursor("from");
                b.composing && b.composing.range.clear(),
                    b.composing = {
                        start: a,
                        range: c.markText(a, c.getCursor("to"), {
                            className: "CodeMirror-composing"
                        })
                    }
            }), Jf(g, "compositionend", function() {
                b.composing && (b.poll(), b.composing.range.clear(), b.composing = null)
            })
        },
        prepareSelection: function() {
            var a = this.cm,
                b = a.display,
                c = a.doc,
                d = eb(a);
            if (a.options.moveInputWithCursor) {
                var e = Lb(a, c.sel.primary().head, "div"),
                    f = b.wrapper.getBoundingClientRect(),
                    g = b.lineDiv.getBoundingClientRect();
                d.teTop = Math.max(0, Math.min(b.wrapper.clientHeight - 10, e.top + g.top - f.top)), d.teLeft = Math.max(0, Math.min(b.wrapper.clientWidth - 10, e.left + g.left - f.left))
            }
            return d
        },
        showSelection: function(a) {
            var b = this.cm,
                c = b.display;
            sg(c.cursorDiv, a.cursors), sg(c.selectionDiv, a.selection), null != a.teTop && (this.wrapper.style.top = a.teTop + "px", this.wrapper.style.left = a.teLeft + "px")
        },
        reset: function(a) {
            if (!this.contextMenuPending) {
                var b, c, f = this.cm,
                    g = f.doc;
                if (f.somethingSelected()) {
                    this.prevInput = "";
                    var h = g.sel.primary();
                    b = Kg && (h.to().line - h.from().line > 100 || (c = f.getSelection()).length > 1e3);
                    var i = b ? "-" : c || f.getSelection();
                    this.textarea.value = i, f.state.focused && cg(this.textarea), d && e >= 9 && (this.hasSelection = i)
                } else a || (this.prevInput = this.textarea.value = "", d && e >= 9 && (this.hasSelection = null));
                this.inaccurateSelection = b
            }
        },
        getField: function() {
            return this.textarea
        },
        supportsTouch: function() {
            return !1
        },
        focus: function() {
            if ("nocursor" != this.cm.options.readOnly && (!n || ug() != this.textarea)) try {
                this.textarea.focus()
            } catch (a) {}
        },
        blur: function() {
            this.textarea.blur()
        },
        resetPosition: function() {
            this.wrapper.style.top = this.wrapper.style.left = 0
        },
        receivedFocus: function() {
            this.slowPoll()
        },
        slowPoll: function() {
            var a = this;
            a.pollingFast || a.polling.set(this.cm.options.pollInterval, function() {
                a.poll(), a.cm.state.focused && a.slowPoll()
            })
        },
        fastPoll: function() {
            function c() {
                var d = b.poll();
                d || a ? (b.pollingFast = !1, b.slowPoll()) : (a = !0, b.polling.set(60, c))
            }
            var a = !1,
                b = this;
            b.pollingFast = !0, b.polling.set(20, c)
        },
        poll: function() {
            var a = this.cm,
                b = this.textarea,
                c = this.prevInput;
            if (this.contextMenuPending || !a.state.focused || Jg(b) && !c && !this.composing || ua(a) || a.options.disableInput || a.state.keySeq) return !1;
            var f = b.value;
            if (f == c && !a.somethingSelected()) return !1;
            if (d && e >= 9 && this.hasSelection === f || o && /[\uf700-\uf7ff]/.test(f)) return a.display.input.reset(), !1;
            if (a.doc.sel == a.display.selForContextMenu) {
                var g = f.charCodeAt(0);
                if (8203 != g || c || (c = "\u200b"), 8666 == g) return this.reset(), this.cm.execCommand("undo")
            }
            for (var h = 0, i = Math.min(c.length, f.length); i > h && c.charCodeAt(h) == f.charCodeAt(h);) ++h;
            var j = this;
            return cc(a, function() {
                wa(a, f.slice(h), c.length - h, null, j.composing ? "*compose" : null), f.length > 1e3 || f.indexOf("\n") > -1 ? b.value = j.prevInput = "" : j.prevInput = f, j.composing && (j.composing.range.clear(), j.composing.range = a.markText(j.composing.start, a.getCursor("to"), {
                    className: "CodeMirror-composing"
                }))
            }), !0
        },
        ensurePolled: function() {
            this.pollingFast && this.poll() && (this.pollingFast = !1)
        },
        onKeyPress: function() {
            d && e >= 9 && (this.hasSelection = null), this.fastPoll()
        },
        onContextMenu: function(a) {
            function o() {
                if (null != h.selectionStart) {
                    var a = c.somethingSelected(),
                        d = "\u200b" + (a ? h.value : "");
                    h.value = "\u21da", h.value = d, b.prevInput = a ? "" : "\u200b", h.selectionStart = 1, h.selectionEnd = d.length, g.selForContextMenu = c.doc.sel
                }
            }

            function p() {
                if (b.contextMenuPending = !1, b.wrapper.style.position = "relative", h.style.cssText = m, d && 9 > e && g.scrollbars.setScrollTop(g.scroller.scrollTop = k), null != h.selectionStart) {
                    (!d || d && 9 > e) && o();
                    var a = 0,
                        f = function() {
                            g.selForContextMenu == c.doc.sel && 0 == h.selectionStart && h.selectionEnd > 0 && "\u200b" == b.prevInput ? dc(c, Ld.selectAll)(c) : a++ < 10 ? g.detectingSelectAll = setTimeout(f, 500) : g.input.reset()
                        };
                    g.detectingSelectAll = setTimeout(f, 200)
                }
            }
            var b = this,
                c = b.cm,
                g = c.display,
                h = b.textarea,
                j = tc(c, a),
                k = g.scroller.scrollTop;
            if (j && !i) {
                var l = c.options.resetSelectionOnContextMenu;
                l && -1 == c.doc.sel.contains(j) && dc(c, Za)(c.doc, Ma(j), Vf);
                var m = h.style.cssText;
                if (b.wrapper.style.position = "absolute", h.style.cssText = "position: fixed; width: 30px; height: 30px; top: " + (a.clientY - 5) + "px; left: " + (a.clientX - 5) + "px; z-index: 1000; background: " + (d ? "rgba(255, 255, 255, .05)" : "transparent") + "; outline: none; border-width: 0; outline: none; overflow: hidden; opacity: .05; filter: alpha(opacity=5);", f) var n = window.scrollY;
                if (g.input.focus(), f && window.scrollTo(null, n), g.input.reset(), c.somethingSelected() || (h.value = b.prevInput = " "), b.contextMenuPending = !0, g.selForContextMenu = c.doc.sel, clearTimeout(g.detectingSelectAll), d && e >= 9 && o(), s) {
                    Gf(a);
                    var q = function() {
                        Kf(window, "mouseup", q), setTimeout(p, 20)
                    };
                    Jf(window, "mouseup", q)
                } else setTimeout(p, 50)
            }
        },
        setUneditable: fg,
        needsContentAttribute: !1
    }, Ba.prototype), Da.prototype = hg({
        init: function(a) {
            function e(a) {
                if (c.somethingSelected()) va = c.getSelections(), "cut" == a.type && c.replaceSelection("", null, "cut");
                else {
                    if (!c.options.lineWiseCopyCut) return;
                    var b = za(c);
                    va = b.text, "cut" == a.type && c.operation(function() {
                        c.setSelections(b.ranges, 0, Vf), c.replaceSelection("", null, "cut")
                    })
                }
                if (a.clipboardData && !m) a.preventDefault(), a.clipboardData.clearData(), a.clipboardData.setData("text/plain", va.join("\n"));
                else {
                    var d = Ca(),
                        e = d.firstChild;
                    c.display.lineSpace.insertBefore(d, c.display.lineSpace.firstChild), e.value = va.join("\n");
                    var f = document.activeElement;
                    cg(e), setTimeout(function() {
                        c.display.lineSpace.removeChild(d), f.focus()
                    }, 50)
                }
            }
            var b = this,
                c = b.cm,
                d = b.div = a.lineDiv;
            d.contentEditable = "true", Aa(d), Jf(d, "paste", function(a) {
                xa(a, c)
            }), Jf(d, "compositionstart", function(a) {
                var d = a.data;
                if (b.composing = {
                        sel: c.doc.sel,
                        data: d,
                        startData: d
                    }, d) {
                    var e = c.doc.sel.primary(),
                        f = c.getLine(e.head.line),
                        g = f.indexOf(d, Math.max(0, e.head.ch - d.length));
                    g > -1 && g <= e.head.ch && (b.composing.sel = Ma(oa(e.head.line, g), oa(e.head.line, g + d.length)))
                }
            }), Jf(d, "compositionupdate", function(a) {
                b.composing.data = a.data
            }), Jf(d, "compositionend", function(a) {
                var c = b.composing;
                c && (a.data == c.startData || /\u200b/.test(a.data) || (c.data = a.data), setTimeout(function() {
                    c.handled || b.applyComposition(c), b.composing == c && (b.composing = null)
                }, 50))
            }), Jf(d, "touchstart", function() {
                b.forceCompositionEnd()
            }), Jf(d, "input", function() {
                b.composing || b.pollContent() || cc(b.cm, function() {
                    ic(c)
                })
            }), Jf(d, "copy", e), Jf(d, "cut", e)
        },
        prepareSelection: function() {
            var a = eb(this.cm, !1);
            return a.focus = this.cm.state.focused, a
        },
        showSelection: function(a) {
            a && this.cm.display.view.length && (a.focus && this.showPrimarySelection(), this.showMultipleSelections(a))
        },
        showPrimarySelection: function() {
            var b = window.getSelection(),
                c = this.cm.doc.sel.primary(),
                d = Ga(this.cm, b.anchorNode, b.anchorOffset),
                e = Ga(this.cm, b.focusNode, b.focusOffset);
            if (!d || d.bad || !e || e.bad || 0 != pa(sa(d, e), c.from()) || 0 != pa(ra(d, e), c.to())) {
                var f = Ea(this.cm, c.from()),
                    g = Ea(this.cm, c.to());
                if (f || g) {
                    var h = this.cm.display.view,
                        i = b.rangeCount && b.getRangeAt(0);
                    if (f) {
                        if (!g) {
                            var j = h[h.length - 1].measure,
                                k = j.maps ? j.maps[j.maps.length - 1] : j.map;
                            g = {
                                node: k[k.length - 1],
                                offset: k[k.length - 2] - k[k.length - 3]
                            }
                        }
                    } else f = {
                        node: h[0].measure.map[2],
                        offset: 0
                    };
                    try {
                        var l = qg(f.node, f.offset, g.offset, g.node)
                    } catch (m) {}
                    l && (b.removeAllRanges(), b.addRange(l), i && null == b.anchorNode ? b.addRange(i) : a && this.startGracePeriod()), this.rememberSelection()
                }
            }
        },
        startGracePeriod: function() {
            var a = this;
            clearTimeout(this.gracePeriod), this.gracePeriod = setTimeout(function() {
                a.gracePeriod = !1, a.selectionChanged() && a.cm.operation(function() {
                    a.cm.curOp.selectionChanged = !0
                })
            }, 20)
        },
        showMultipleSelections: function(a) {
            sg(this.cm.display.cursorDiv, a.cursors), sg(this.cm.display.selectionDiv, a.selection)
        },
        rememberSelection: function() {
            var a = window.getSelection();
            this.lastAnchorNode = a.anchorNode, this.lastAnchorOffset = a.anchorOffset, this.lastFocusNode = a.focusNode, this.lastFocusOffset = a.focusOffset
        },
        selectionInEditor: function() {
            var a = window.getSelection();
            if (!a.rangeCount) return !1;
            var b = a.getRangeAt(0).commonAncestorContainer;
            return tg(this.div, b)
        },
        focus: function() {
            "nocursor" != this.cm.options.readOnly && this.div.focus()
        },
        blur: function() {
            this.div.blur()
        },
        getField: function() {
            return this.div
        },
        supportsTouch: function() {
            return !0
        },
        receivedFocus: function() {
            function b() {
                a.cm.state.focused && (a.pollSelection(), a.polling.set(a.cm.options.pollInterval, b))
            }
            var a = this;
            this.selectionInEditor() ? this.pollSelection() : cc(this.cm, function() {
                a.cm.curOp.selectionChanged = !0
            }), this.polling.set(this.cm.options.pollInterval, b)
        },
        selectionChanged: function() {
            var a = window.getSelection();
            return a.anchorNode != this.lastAnchorNode || a.anchorOffset != this.lastAnchorOffset || a.focusNode != this.lastFocusNode || a.focusOffset != this.lastFocusOffset
        },
        pollSelection: function() {
            if (!this.composing && !this.gracePeriod && this.selectionChanged()) {
                var a = window.getSelection(),
                    b = this.cm;
                this.rememberSelection();
                var c = Ga(b, a.anchorNode, a.anchorOffset),
                    d = Ga(b, a.focusNode, a.focusOffset);
                c && d && cc(b, function() {
                    Za(b.doc, Ma(c, d), Vf), (c.bad || d.bad) && (b.curOp.selectionChanged = !0)
                })
            }
        },
        pollContent: function() {
            var a = this.cm,
                b = a.display,
                c = a.doc.sel.primary(),
                d = c.from(),
                e = c.to();
            if (d.line < b.viewFrom || e.line > b.viewTo - 1) return !1;
            var f;
            if (d.line == b.viewFrom || 0 == (f = lc(a, d.line))) var g = kf(b.view[0].line),
                h = b.view[0].node;
            else var g = kf(b.view[f].line),
                h = b.view[f - 1].node.nextSibling;
            var i = lc(a, e.line);
            if (i == b.view.length - 1) var j = b.viewTo - 1,
                k = b.lineDiv.lastChild;
            else var j = kf(b.view[i + 1].line) - 1,
                k = b.view[i + 1].node.previousSibling;
            for (var l = a.doc.splitLines(Ia(a, h, k, g, j)), m = gf(a.doc, oa(g, 0), oa(j, ff(a.doc, j).text.length)); l.length > 1 && m.length > 1;)
                if (bg(l) == bg(m)) l.pop(), m.pop(), j--;
                else {
                    if (l[0] != m[0]) break;
                    l.shift(), m.shift(), g++
                }
            for (var n = 0, o = 0, p = l[0], q = m[0], r = Math.min(p.length, q.length); r > n && p.charCodeAt(n) == q.charCodeAt(n);) ++n;
            for (var s = bg(l), t = bg(m), u = Math.min(s.length - (1 == l.length ? n : 0), t.length - (1 == m.length ? n : 0)); u > o && s.charCodeAt(s.length - o - 1) == t.charCodeAt(t.length - o - 1);) ++o;
            l[l.length - 1] = s.slice(0, s.length - o), l[0] = l[0].slice(n);
            var v = oa(g, n),
                w = oa(j, m.length ? bg(m).length - o : 0);
            return l.length > 1 || l[0] || pa(v, w) ? (nd(a.doc, l, v, w, "+input"), !0) : void 0
        },
        ensurePolled: function() {
            this.forceCompositionEnd()
        },
        reset: function() {
            this.forceCompositionEnd()
        },
        forceCompositionEnd: function() {
            this.composing && !this.composing.handled && (this.applyComposition(this.composing), this.composing.handled = !0, this.div.blur(), this.div.focus())
        },
        applyComposition: function(a) {
            a.data && a.data != a.startData && dc(this.cm, wa)(this.cm, a.data, 0, a.sel)
        },
        setUneditable: function(a) {
            a.setAttribute("contenteditable", "false")
        },
        onKeyPress: function(a) {
            a.preventDefault(), dc(this.cm, wa)(this.cm, String.fromCharCode(null == a.charCode ? a.keyCode : a.charCode), 0)
        },
        onContextMenu: fg,
        resetPosition: fg,
        needsContentAttribute: !0
    }, Da.prototype), v.inputStyles = {
        textarea: Ba,
        contenteditable: Da
    }, Ja.prototype = {
        primary: function() {
            return this.ranges[this.primIndex]
        },
        equals: function(a) {
            if (a == this) return !0;
            if (a.primIndex != this.primIndex || a.ranges.length != this.ranges.length) return !1;
            for (var b = 0; b < this.ranges.length; b++) {
                var c = this.ranges[b],
                    d = a.ranges[b];
                if (0 != pa(c.anchor, d.anchor) || 0 != pa(c.head, d.head)) return !1
            }
            return !0
        },
        deepCopy: function() {
            for (var a = [], b = 0; b < this.ranges.length; b++) a[b] = new Ka(qa(this.ranges[b].anchor), qa(this.ranges[b].head));
            return new Ja(a, this.primIndex)
        },
        somethingSelected: function() {
            for (var a = 0; a < this.ranges.length; a++)
                if (!this.ranges[a].empty()) return !0;
            return !1
        },
        contains: function(a, b) {
            b || (b = a);
            for (var c = 0; c < this.ranges.length; c++) {
                var d = this.ranges[c];
                if (pa(b, d.from()) >= 0 && pa(a, d.to()) <= 0) return c
            }
            return -1
        }
    }, Ka.prototype = {
        from: function() {
            return sa(this.anchor, this.head)
        },
        to: function() {
            return ra(this.anchor, this.head)
        },
        empty: function() {
            return this.head.line == this.anchor.line && this.head.ch == this.anchor.ch
        }
    };
    var Qb, vc, wc, zb = {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
        },
        Tb = null,
        Ub = 0,
        Cc = 0,
        Jc = 0,
        Kc = null;
    d ? Kc = -.53 : a ? Kc = 15 : h ? Kc = -.7 : j && (Kc = -1 / 3);
    var Lc = function(a) {
        var b = a.wheelDeltaX,
            c = a.wheelDeltaY;
        return null == b && a.detail && a.axis == a.HORIZONTAL_AXIS && (b = a.detail), null == c && a.detail && a.axis == a.VERTICAL_AXIS ? c = a.detail : null == c && (c = a.wheelDelta), {
            x: b,
            y: c
        }
    };
    v.wheelEventPixels = function(a) {
        var b = Lc(a);
        return b.x *= Kc, b.y *= Kc, b
    };
    var Pc = new Yf,
        Tc = null,
        bd = v.changeEnd = function(a) {
            return a.text ? oa(a.from.line + a.text.length - 1, bg(a.text).length + (1 == a.text.length ? a.from.ch : 0)) : a.to
        };
    v.prototype = {
        constructor: v,
        focus: function() {
            window.focus(), this.display.input.focus()
        },
        setOption: function(a, b) {
            var c = this.options,
                d = c[a];
            (c[a] != b || "mode" == a) && (c[a] = b, Bd.hasOwnProperty(a) && dc(this, Bd[a])(this, b, d))
        },
        getOption: function(a) {
            return this.options[a]
        },
        getDoc: function() {
            return this.doc
        },
        addKeyMap: function(a, b) {
            this.state.keyMaps[b ? "push" : "unshift"](Rd(a))
        },
        removeKeyMap: function(a) {
            for (var b = this.state.keyMaps, c = 0; c < b.length; ++c)
                if (b[c] == a || b[c].name == a) return b.splice(c, 1), !0
        },
        addOverlay: ec(function(a, b) {
            var c = a.token ? a : v.getMode(this.options, a);
            if (c.startState) throw new Error("Overlays may not be stateful.");
            this.state.overlays.push({
                mode: c,
                modeSpec: a,
                opaque: b && b.opaque
            }), this.state.modeGen++, ic(this)
        }),
        removeOverlay: ec(function(a) {
            for (var b = this.state.overlays, c = 0; c < b.length; ++c) {
                var d = b[c].modeSpec;
                if (d == a || "string" == typeof a && d.name == a) return b.splice(c, 1), this.state.modeGen++, void ic(this)
            }
        }),
        indentLine: ec(function(a, b, c) {
            "string" != typeof b && "number" != typeof b && (b = null == b ? this.options.smartIndent ? "smart" : "prev" : b ? "add" : "subtract"), Qa(this.doc, a) && vd(this, a, b, c)
        }),
        indentSelection: ec(function(a) {
            for (var b = this.doc.sel.ranges, c = -1, d = 0; d < b.length; d++) {
                var e = b[d];
                if (e.empty()) e.head.line > c && (vd(this, e.head.line, a, !0), c = e.head.line, d == this.doc.sel.primIndex && td(this));
                else {
                    var f = e.from(),
                        g = e.to(),
                        h = Math.max(c, f.line);
                    c = Math.min(this.lastLine(), g.line - (g.ch ? 0 : 1)) + 1;
                    for (var i = h; c > i; ++i) vd(this, i, a);
                    var j = this.doc.sel.ranges;
                    0 == f.ch && b.length == j.length && j[d].from().ch > 0 && Va(this.doc, d, new Ka(f, j[d].to()), Vf)
                }
            }
        }),
        getTokenAt: function(a, b) {
            return Ie(this, a, b)
        },
        getLineTokens: function(a, b) {
            return Ie(this, oa(a), b, !0)
        },
        getTokenTypeAt: function(a) {
            a = Oa(this.doc, a);
            var f, b = Le(this, ff(this.doc, a.line)),
                c = 0,
                d = (b.length - 1) / 2,
                e = a.ch;
            if (0 == e) f = b[2];
            else
                for (;;) {
                    var g = c + d >> 1;
                    if ((g ? b[2 * g - 1] : 0) >= e) d = g;
                    else {
                        if (!(b[2 * g + 1] < e)) {
                            f = b[2 * g + 2];
                            break
                        }
                        c = g + 1
                    }
                }
            var h = f ? f.indexOf("cm-overlay ") : -1;
            return 0 > h ? f : 0 == h ? null : f.slice(0, h - 1)
        },
        getModeAt: function(a) {
            var b = this.doc.mode;
            return b.innerMode ? v.innerMode(b, this.getTokenAt(a).state).mode : b
        },
        getHelper: function(a, b) {
            return this.getHelpers(a, b)[0]
        },
        getHelpers: function(a, b) {
            var c = [];
            if (!Id.hasOwnProperty(b)) return c;
            var d = Id[b],
                e = this.getModeAt(a);
            if ("string" == typeof e[b]) d[e[b]] && c.push(d[e[b]]);
            else if (e[b])
                for (var f = 0; f < e[b].length; f++) {
                    var g = d[e[b][f]];
                    g && c.push(g)
                } else e.helperType && d[e.helperType] ? c.push(d[e.helperType]) : d[e.name] && c.push(d[e.name]);
            for (var f = 0; f < d._global.length; f++) {
                var h = d._global[f];
                h.pred(e, this) && -1 == dg(c, h.val) && c.push(h.val)
            }
            return c
        },
        getStateAfter: function(a, b) {
            var c = this.doc;
            return a = Na(c, null == a ? c.first + c.size - 1 : a), lb(this, a + 1, b)
        },
        cursorCoords: function(a, b) {
            var c, d = this.doc.sel.primary();
            return c = null == a ? d.head : "object" == typeof a ? Oa(this.doc, a) : a ? d.from() : d.to(), Lb(this, c, b || "page")
        },
        charCoords: function(a, b) {
            return Kb(this, Oa(this.doc, a), b || "page")
        },
        coordsChar: function(a, b) {
            return a = Jb(this, a, b || "page"), Ob(this, a.left, a.top)
        },
        lineAtHeight: function(a, b) {
            return a = Jb(this, {
                top: a,
                left: 0
            }, b || "page").top, lf(this.doc, a + this.display.viewOffset)
        },
        heightAtLine: function(a, b) {
            var d, c = !1;
            if ("number" == typeof a) {
                var e = this.doc.first + this.doc.size - 1;
                a < this.doc.first ? a = this.doc.first : a > e && (a = e, c = !0), d = ff(this.doc, a)
            } else d = a;
            return Ib(this, d, {
                top: 0,
                left: 0
            }, b || "page").top + (c ? this.doc.height - mf(d) : 0)
        },
        defaultTextHeight: function() {
            return Rb(this.display)
        },
        defaultCharWidth: function() {
            return Sb(this.display)
        },
        setGutterMarker: ec(function(a, b, c) {
            return wd(this.doc, a, "gutter", function(a) {
                var d = a.gutterMarkers || (a.gutterMarkers = {});
                return d[b] = c, !c && mg(d) && (a.gutterMarkers = null), !0
            })
        }),
        clearGutter: ec(function(a) {
            var b = this,
                c = b.doc,
                d = c.first;
            c.iter(function(c) {
                c.gutterMarkers && c.gutterMarkers[a] && (c.gutterMarkers[a] = null, jc(b, d, "gutter"), mg(c.gutterMarkers) && (c.gutterMarkers = null)), ++d
            })
        }),
        lineInfo: function(a) {
            if ("number" == typeof a) {
                if (!Qa(this.doc, a)) return null;
                var b = a;
                if (a = ff(this.doc, a), !a) return null
            } else {
                var b = kf(a);
                if (null == b) return null
            }
            return {
                line: b,
                handle: a,
                text: a.text,
                gutterMarkers: a.gutterMarkers,
                textClass: a.textClass,
                bgClass: a.bgClass,
                wrapClass: a.wrapClass,
                widgets: a.widgets
            }
        },
        getViewport: function() {
            return {
                from: this.display.viewFrom,
                to: this.display.viewTo
            }
        },
        addWidget: function(a, b, c, d, e) {
            var f = this.display;
            a = Lb(this, Oa(this.doc, a));
            var g = a.bottom,
                h = a.left;
            if (b.style.position = "absolute", b.setAttribute("cm-ignore-events", "true"), this.display.input.setUneditable(b), f.sizer.appendChild(b), "over" == d) g = a.top;
            else if ("above" == d || "near" == d) {
                var i = Math.max(f.wrapper.clientHeight, this.doc.height),
                    j = Math.max(f.sizer.clientWidth, f.lineSpace.clientWidth);
                ("above" == d || a.bottom + b.offsetHeight > i) && a.top > b.offsetHeight ? g = a.top - b.offsetHeight : a.bottom + b.offsetHeight <= i && (g = a.bottom), h + b.offsetWidth > j && (h = j - b.offsetWidth)
            }
            b.style.top = g + "px", b.style.left = b.style.right = "", "right" == e ? (h = f.sizer.clientWidth - b.offsetWidth, b.style.right = "0px") : ("left" == e ? h = 0 : "middle" == e && (h = (f.sizer.clientWidth - b.offsetWidth) / 2), b.style.left = h + "px"), c && qd(this, h, g, h + b.offsetWidth, g + b.offsetHeight)
        },
        triggerOnKeyDown: ec(Uc),
        triggerOnKeyPress: ec(Xc),
        triggerOnKeyUp: Wc,
        execCommand: function(a) {
            return Ld.hasOwnProperty(a) ? Ld[a].call(null, this) : void 0
        },
        triggerElectric: ec(function(a) {
            ya(this, a)
        }),
        findPosH: function(a, b, c, d) {
            var e = 1;
            0 > b && (e = -1, b = -b);
            for (var f = 0, g = Oa(this.doc, a); b > f && (g = yd(this.doc, g, e, c, d), !g.hitSide); ++f);
            return g
        },
        moveH: ec(function(a, b) {
            var c = this;
            c.extendSelectionsBy(function(d) {
                return c.display.shift || c.doc.extend || d.empty() ? yd(c.doc, d.head, a, b, c.options.rtlMoveVisually) : 0 > a ? d.from() : d.to()
            }, Xf)
        }),
        deleteH: ec(function(a, b) {
            var c = this.doc.sel,
                d = this.doc;
            c.somethingSelected() ? d.replaceSelection("", null, "+delete") : xd(this, function(c) {
                var e = yd(d, c.head, a, b, !1);
                return 0 > a ? {
                    from: e,
                    to: c.head
                } : {
                    from: c.head,
                    to: e
                }
            })
        }),
        findPosV: function(a, b, c, d) {
            var e = 1,
                f = d;
            0 > b && (e = -1, b = -b);
            for (var g = 0, h = Oa(this.doc, a); b > g; ++g) {
                var i = Lb(this, h, "div");
                if (null == f ? f = i.left : i.left = f, h = zd(this, i, e, c), h.hitSide) break
            }
            return h
        },
        moveV: ec(function(a, b) {
            var c = this,
                d = this.doc,
                e = [],
                f = !c.display.shift && !d.extend && d.sel.somethingSelected();
            if (d.extendSelectionsBy(function(g) {
                    if (f) return 0 > a ? g.from() : g.to();
                    var h = Lb(c, g.head, "div");
                    null != g.goalColumn && (h.left = g.goalColumn), e.push(h.left);
                    var i = zd(c, h, a, b);
                    return "page" == b && g == d.sel.primary() && sd(c, null, Kb(c, i, "div").top - h.top), i
                }, Xf), e.length)
                for (var g = 0; g < d.sel.ranges.length; g++) d.sel.ranges[g].goalColumn = e[g]
        }),
        findWordAt: function(a) {
            var b = this.doc,
                c = ff(b, a.line).text,
                d = a.ch,
                e = a.ch;
            if (c) {
                var f = this.getHelper(a, "wordChars");
                (a.xRel < 0 || e == c.length) && d ? --d : ++e;
                for (var g = c.charAt(d), h = lg(g, f) ? function(a) {
                        return lg(a, f)
                    } : /\s/.test(g) ? function(a) {
                        return /\s/.test(a)
                    } : function(a) {
                        return !/\s/.test(a) && !lg(a)
                    }; d > 0 && h(c.charAt(d - 1));) --d;
                for (; e < c.length && h(c.charAt(e));) ++e
            }
            return new Ka(oa(a.line, d), oa(a.line, e))
        },
        toggleOverwrite: function(a) {
            (null == a || a != this.state.overwrite) && ((this.state.overwrite = !this.state.overwrite) ? xg(this.display.cursorDiv, "CodeMirror-overwrite") : wg(this.display.cursorDiv, "CodeMirror-overwrite"), Lf(this, "overwriteToggle", this, this.state.overwrite))
        },
        hasFocus: function() {
            return this.display.input.getField() == ug()
        },
        scrollTo: ec(function(a, b) {
            (null != a || null != b) && ud(this), null != a && (this.curOp.scrollLeft = a), null != b && (this.curOp.scrollTop = b)
        }),
        getScrollInfo: function() {
            var a = this.display.scroller;
            return {
                left: a.scrollLeft,
                top: a.scrollTop,
                height: a.scrollHeight - pb(this) - this.display.barHeight,
                width: a.scrollWidth - pb(this) - this.display.barWidth,
                clientHeight: rb(this),
                clientWidth: qb(this)
            }
        },
        scrollIntoView: ec(function(a, b) {
            if (null == a ? (a = {
                    from: this.doc.sel.primary().head,
                    to: null
                }, null == b && (b = this.options.cursorScrollMargin)) : "number" == typeof a ? a = {
                    from: oa(a, 0),
                    to: null
                } : null == a.from && (a = {
                    from: a,
                    to: null
                }), a.to || (a.to = a.from), a.margin = b || 0, null != a.from.line) ud(this), this.curOp.scrollToPos = a;
            else {
                var c = rd(this, Math.min(a.from.left, a.to.left), Math.min(a.from.top, a.to.top) - a.margin, Math.max(a.from.right, a.to.right), Math.max(a.from.bottom, a.to.bottom) + a.margin);
                this.scrollTo(c.scrollLeft, c.scrollTop)
            }
        }),
        setSize: ec(function(a, b) {
            function d(a) {
                return "number" == typeof a || /^\d+$/.test(String(a)) ? a + "px" : a
            }
            var c = this;
            null != a && (c.display.wrapper.style.width = d(a)), null != b && (c.display.wrapper.style.height = d(b)), c.options.lineWrapping && Eb(this);
            var e = c.display.viewFrom;
            c.doc.iter(e, c.display.viewTo, function(a) {
                if (a.widgets)
                    for (var b = 0; b < a.widgets.length; b++)
                        if (a.widgets[b].noHScroll) {
                            jc(c, e, "widget");
                            break
                        }++e
            }), c.curOp.forceUpdate = !0, Lf(c, "refresh", this)
        }),
        operation: function(a) {
            return cc(this, a)
        },
        refresh: ec(function() {
            var a = this.display.cachedTextHeight;
            ic(this), this.curOp.forceUpdate = !0, Fb(this), this.scrollTo(this.doc.scrollLeft, this.doc.scrollTop), F(this), (null == a || Math.abs(a - Rb(this.display)) > .5) && B(this), Lf(this, "refresh", this)
        }),
        swapDoc: ec(function(a) {
            var b = this.doc;
            return b.cm = null, ef(this, a), Fb(this), this.display.input.reset(), this.scrollTo(a.scrollLeft, a.scrollTop), this.curOp.forceScroll = !0, Nf(this, "swapDoc", this, b), b
        }),
        getInputField: function() {
            return this.display.input.getField()
        },
        getWrapperElement: function() {
            return this.display.wrapper
        },
        getScrollerElement: function() {
            return this.display.scroller
        },
        getGutterElement: function() {
            return this.display.gutters
        }
    }, Sf(v);
    var Ad = v.defaults = {},
        Bd = v.optionHandlers = {},
        Dd = v.Init = {
            toString: function() {
                return "CodeMirror.Init"
            }
        };
    Cd("value", "", function(a, b) {
        a.setValue(b)
    }, !0), Cd("mode", null, function(a, b) {
        a.doc.modeOption = b, x(a)
    }, !0), Cd("indentUnit", 2, x, !0), Cd("indentWithTabs", !1), Cd("smartIndent", !0), Cd("tabSize", 4, function(a) {
        y(a), Fb(a), ic(a)
    }, !0), Cd("lineSeparator", null, function(a, b) {
        if (a.doc.lineSep = b, b) {
            var c = [],
                d = a.doc.first;
            a.doc.iter(function(a) {
                for (var e = 0;;) {
                    var f = a.text.indexOf(b, e);
                    if (-1 == f) break;
                    e = f + b.length, c.push(oa(d, f))
                }
                d++
            });
            for (var e = c.length - 1; e >= 0; e--) nd(a.doc, b, c[e], oa(c[e].line, c[e].ch + b.length))
        }
    }), Cd("specialChars", /[\t\u0000-\u0019\u00ad\u200b-\u200f\u2028\u2029\ufeff]/g, function(a, b, c) {
        a.state.specialChars = new RegExp(b.source + (b.test("	") ? "" : "|	"), "g"), c != v.Init && a.refresh()
    }), Cd("specialCharPlaceholder", Re, function(a) {
        a.refresh()
    }, !0), Cd("electricChars", !0), Cd("inputStyle", n ? "contenteditable" : "textarea", function() {
        throw new Error("inputStyle can not (yet) be changed in a running editor")
    }, !0), Cd("rtlMoveVisually", !p), Cd("wholeLineUpdateBefore", !0), Cd("theme", "default", function(a) {
        C(a), D(a)
    }, !0), Cd("keyMap", "default", function(a, b, c) {
        var d = Rd(b),
            e = c != v.Init && Rd(c);
        e && e.detach && e.detach(a, d), d.attach && d.attach(a, e || null)
    }), Cd("extraKeys", null), Cd("lineWrapping", !1, z, !0), Cd("gutters", [], function(a) {
        I(a.options), D(a)
    }, !0), Cd("fixedGutter", !0, function(a, b) {
        a.display.gutters.style.left = b ? T(a.display) + "px" : "0", a.refresh()
    }, !0), Cd("coverGutterNextToScrollbar", !1, function(a) {
        N(a)
    }, !0), Cd("scrollbarStyle", "native", function(a) {
        M(a), N(a), a.display.scrollbars.setScrollTop(a.doc.scrollTop), a.display.scrollbars.setScrollLeft(a.doc.scrollLeft)
    }, !0), Cd("lineNumbers", !1, function(a) {
        I(a.options), D(a)
    }, !0), Cd("firstLineNumber", 1, D, !0), Cd("lineNumberFormatter", function(a) {
        return a
    }, D, !0), Cd("showCursorWhenSelecting", !1, db, !0), Cd("resetSelectionOnContextMenu", !0), Cd("lineWiseCopyCut", !0), Cd("readOnly", !1, function(a, b) {
        "nocursor" == b ? ($c(a), a.display.input.blur(), a.display.disabled = !0) : (a.display.disabled = !1, b || a.display.input.reset())
    }), Cd("disableInput", !1, function(a, b) {
        b || a.display.input.reset()
    }, !0), Cd("dragDrop", !0, qc), Cd("cursorBlinkRate", 530), Cd("cursorScrollMargin", 0), Cd("cursorHeight", 1, db, !0), Cd("singleCursorHeightPerLine", !0, db, !0), Cd("workTime", 100), Cd("workDelay", 100), Cd("flattenSpans", !0, y, !0), Cd("addModeClass", !1, y, !0), Cd("pollInterval", 100), Cd("undoDepth", 200, function(a, b) {
        a.doc.history.undoDepth = b
    }), Cd("historyEventDelay", 1250), Cd("viewportMargin", 10, function(a) {
        a.refresh()
    }, !0), Cd("maxHighlightLength", 1e4, y, !0), Cd("moveInputWithCursor", !0, function(a, b) {
        b || a.display.input.resetPosition()
    }), Cd("tabindex", null, function(a, b) {
        a.display.input.getField().tabIndex = b || ""
    }), Cd("autofocus", null);
    var Ed = v.modes = {},
        Fd = v.mimeModes = {};
    v.defineMode = function(a, b) {
        v.defaults.mode || "null" == a || (v.defaults.mode = a), arguments.length > 2 && (b.dependencies = Array.prototype.slice.call(arguments, 2)), Ed[a] = b
    }, v.defineMIME = function(a, b) {
        Fd[a] = b
    }, v.resolveMode = function(a) {
        if ("string" == typeof a && Fd.hasOwnProperty(a)) a = Fd[a];
        else if (a && "string" == typeof a.name && Fd.hasOwnProperty(a.name)) {
            var b = Fd[a.name];
            "string" == typeof b && (b = {
                name: b
            }), a = gg(b, a), a.name = b.name
        } else if ("string" == typeof a && /^[\w\-]+\/[\w\-]+\+xml$/.test(a)) return v.resolveMode("application/xml");
        return "string" == typeof a ? {
            name: a
        } : a || {
            name: "null"
        }
    }, v.getMode = function(a, b) {
        var b = v.resolveMode(b),
            c = Ed[b.name];
        if (!c) return v.getMode(a, "text/plain");
        var d = c(a, b);
        if (Gd.hasOwnProperty(b.name)) {
            var e = Gd[b.name];
            for (var f in e) e.hasOwnProperty(f) && (d.hasOwnProperty(f) && (d["_" + f] = d[f]), d[f] = e[f])
        }
        if (d.name = b.name, b.helperType && (d.helperType = b.helperType), b.modeProps)
            for (var f in b.modeProps) d[f] = b.modeProps[f];
        return d
    }, v.defineMode("null", function() {
        return {
            token: function(a) {
                a.skipToEnd()
            }
        }
    }), v.defineMIME("text/plain", "null");
    var Gd = v.modeExtensions = {};
    v.extendMode = function(a, b) {
        var c = Gd.hasOwnProperty(a) ? Gd[a] : Gd[a] = {};
        hg(b, c)
    }, v.defineExtension = function(a, b) {
        v.prototype[a] = b
    }, v.defineDocExtension = function(a, b) {
        af.prototype[a] = b
    }, v.defineOption = Cd;
    var Hd = [];
    v.defineInitHook = function(a) {
        Hd.push(a)
    };
    var Id = v.helpers = {};
    v.registerHelper = function(a, b, c) {
        Id.hasOwnProperty(a) || (Id[a] = v[a] = {
            _global: []
        }), Id[a][b] = c
    }, v.registerGlobalHelper = function(a, b, c, d) {
        v.registerHelper(a, b, d), Id[a]._global.push({
            pred: c,
            val: d
        })
    };
    var Jd = v.copyState = function(a, b) {
            if (b === !0) return b;
            if (a.copyState) return a.copyState(b);
            var c = {};
            for (var d in b) {
                var e = b[d];
                e instanceof Array && (e = e.concat([])), c[d] = e
            }
            return c
        },
        Kd = v.startState = function(a, b, c) {
            return a.startState ? a.startState(b, c) : !0
        };
    v.innerMode = function(a, b) {
        for (; a.innerMode;) {
            var c = a.innerMode(b);
            if (!c || c.mode == a) break;
            b = c.state, a = c.mode
        }
        return c || {
            mode: a,
            state: b
        }
    };
    var Ld = v.commands = {
            selectAll: function(a) {
                a.setSelection(oa(a.firstLine(), 0), oa(a.lastLine()), Vf)
            },
            singleSelection: function(a) {
                a.setSelection(a.getCursor("anchor"), a.getCursor("head"), Vf)
            },
            killLine: function(a) {
                xd(a, function(b) {
                    if (b.empty()) {
                        var c = ff(a.doc, b.head.line).text.length;
                        return b.head.ch == c && b.head.line < a.lastLine() ? {
                            from: b.head,
                            to: oa(b.head.line + 1, 0)
                        } : {
                            from: b.head,
                            to: oa(b.head.line, c)
                        }
                    }
                    return {
                        from: b.from(),
                        to: b.to()
                    }
                })
            },
            deleteLine: function(a) {
                xd(a, function(b) {
                    return {
                        from: oa(b.from().line, 0),
                        to: Oa(a.doc, oa(b.to().line + 1, 0))
                    }
                })
            },
            delLineLeft: function(a) {
                xd(a, function(a) {
                    return {
                        from: oa(a.from().line, 0),
                        to: a.from()
                    }
                })
            },
            delWrappedLineLeft: function(a) {
                xd(a, function(b) {
                    var c = a.charCoords(b.head, "div").top + 5,
                        d = a.coordsChar({
                            left: 0,
                            top: c
                        }, "div");
                    return {
                        from: d,
                        to: b.from()
                    }
                })
            },
            delWrappedLineRight: function(a) {
                xd(a, function(b) {
                    var c = a.charCoords(b.head, "div").top + 5,
                        d = a.coordsChar({
                            left: a.display.lineDiv.offsetWidth + 100,
                            top: c
                        }, "div");
                    return {
                        from: b.from(),
                        to: d
                    }
                })
            },
            undo: function(a) {
                a.undo()
            },
            redo: function(a) {
                a.redo()
            },
            undoSelection: function(a) {
                a.undoSelection()
            },
            redoSelection: function(a) {
                a.redoSelection()
            },
            goDocStart: function(a) {
                a.extendSelection(oa(a.firstLine(), 0))
            },
            goDocEnd: function(a) {
                a.extendSelection(oa(a.lastLine()))
            },
            goLineStart: function(a) {
                a.extendSelectionsBy(function(b) {
                    return Tg(a, b.head.line)
                }, {
                    origin: "+move",
                    bias: 1
                })
            },
            goLineStartSmart: function(a) {
                a.extendSelectionsBy(function(b) {
                    return Vg(a, b.head)
                }, {
                    origin: "+move",
                    bias: 1
                })
            },
            goLineEnd: function(a) {
                a.extendSelectionsBy(function(b) {
                    return Ug(a, b.head.line)
                }, {
                    origin: "+move",
                    bias: -1
                })
            },
            goLineRight: function(a) {
                a.extendSelectionsBy(function(b) {
                    var c = a.charCoords(b.head, "div").top + 5;
                    return a.coordsChar({
                        left: a.display.lineDiv.offsetWidth + 100,
                        top: c
                    }, "div")
                }, Xf)
            },
            goLineLeft: function(a) {
                a.extendSelectionsBy(function(b) {
                    var c = a.charCoords(b.head, "div").top + 5;
                    return a.coordsChar({
                        left: 0,
                        top: c
                    }, "div")
                }, Xf)
            },
            goLineLeftSmart: function(a) {
                a.extendSelectionsBy(function(b) {
                    var c = a.charCoords(b.head, "div").top + 5,
                        d = a.coordsChar({
                            left: 0,
                            top: c
                        }, "div");
                    return d.ch < a.getLine(d.line).search(/\S/) ? Vg(a, b.head) : d
                }, Xf)
            },
            goLineUp: function(a) {
                a.moveV(-1, "line")
            },
            goLineDown: function(a) {
                a.moveV(1, "line")
            },
            goPageUp: function(a) {
                a.moveV(-1, "page")
            },
            goPageDown: function(a) {
                a.moveV(1, "page")
            },
            goCharLeft: function(a) {
                a.moveH(-1, "char")
            },
            goCharRight: function(a) {
                a.moveH(1, "char")
            },
            goColumnLeft: function(a) {
                a.moveH(-1, "column")
            },
            goColumnRight: function(a) {
                a.moveH(1, "column")
            },
            goWordLeft: function(a) {
                a.moveH(-1, "word")
            },
            goGroupRight: function(a) {
                a.moveH(1, "group")
            },
            goGroupLeft: function(a) {
                a.moveH(-1, "group")
            },
            goWordRight: function(a) {
                a.moveH(1, "word")
            },
            delCharBefore: function(a) {
                a.deleteH(-1, "char")
            },
            delCharAfter: function(a) {
                a.deleteH(1, "char")
            },
            delWordBefore: function(a) {
                a.deleteH(-1, "word")
            },
            delWordAfter: function(a) {
                a.deleteH(1, "word")
            },
            delGroupBefore: function(a) {
                a.deleteH(-1, "group")
            },
            delGroupAfter: function(a) {
                a.deleteH(1, "group")
            },
            indentAuto: function(a) {
                a.indentSelection("smart")
            },
            indentMore: function(a) {
                a.indentSelection("add")
            },
            indentLess: function(a) {
                a.indentSelection("subtract")
            },
            insertTab: function(a) {
                a.replaceSelection("	")
            },
            insertSoftTab: function(a) {
                for (var b = [], c = a.listSelections(), d = a.options.tabSize, e = 0; e < c.length; e++) {
                    var f = c[e].from(),
                        g = Zf(a.getLine(f.line), f.ch, d);
                    b.push(new Array(d - g % d + 1).join(" "))
                }
                a.replaceSelections(b)
            },
            defaultTab: function(a) {
                a.somethingSelected() ? a.indentSelection("add") : a.execCommand("insertTab")
            },
            transposeChars: function(a) {
                cc(a, function() {
                    for (var b = a.listSelections(), c = [], d = 0; d < b.length; d++) {
                        var e = b[d].head,
                            f = ff(a.doc, e.line).text;
                        if (f)
                            if (e.ch == f.length && (e = new oa(e.line, e.ch - 1)), e.ch > 0) e = new oa(e.line, e.ch + 1), a.replaceRange(f.charAt(e.ch - 1) + f.charAt(e.ch - 2), oa(e.line, e.ch - 2), e, "+transpose");
                            else if (e.line > a.doc.first) {
                            var g = ff(a.doc, e.line - 1).text;
                            g && a.replaceRange(f.charAt(0) + a.doc.lineSeparator() + g.charAt(g.length - 1), oa(e.line - 1, g.length - 1), oa(e.line, 1), "+transpose")
                        }
                        c.push(new Ka(e, e))
                    }
                    a.setSelections(c)
                })
            },
            newlineAndIndent: function(a) {
                cc(a, function() {
                    for (var b = a.listSelections().length, c = 0; b > c; c++) {
                        var d = a.listSelections()[c];
                        a.replaceRange(a.doc.lineSeparator(), d.anchor, d.head, "+input"), a.indentLine(d.from().line + 1, null, !0), td(a)
                    }
                })
            },
            toggleOverwrite: function(a) {
                a.toggleOverwrite()
            }
        },
        Md = v.keyMap = {};
    Md.basic = {
        Left: "goCharLeft",
        Right: "goCharRight",
        Up: "goLineUp",
        Down: "goLineDown",
        End: "goLineEnd",
        Home: "goLineStartSmart",
        PageUp: "goPageUp",
        PageDown: "goPageDown",
        Delete: "delCharAfter",
        Backspace: "delCharBefore",
        "Shift-Backspace": "delCharBefore",
        Tab: "defaultTab",
        "Shift-Tab": "indentAuto",
        Enter: "newlineAndIndent",
        Insert: "toggleOverwrite",
        Esc: "singleSelection"
    }, Md.pcDefault = {
        "Ctrl-A": "selectAll",
        "Ctrl-D": "deleteLine",
        "Ctrl-Z": "undo",
        "Shift-Ctrl-Z": "redo",
        "Ctrl-Y": "redo",
        "Ctrl-Home": "goDocStart",
        "Ctrl-End": "goDocEnd",
        "Ctrl-Up": "goLineUp",
        "Ctrl-Down": "goLineDown",
        "Ctrl-Left": "goGroupLeft",
        "Ctrl-Right": "goGroupRight",
        "Alt-Left": "goLineStart",
        "Alt-Right": "goLineEnd",
        "Ctrl-Backspace": "delGroupBefore",
        "Ctrl-Delete": "delGroupAfter",
        "Ctrl-S": "save",
        "Ctrl-F": "find",
        "Ctrl-G": "findNext",
        "Shift-Ctrl-G": "findPrev",
        "Shift-Ctrl-F": "replace",
        "Shift-Ctrl-R": "replaceAll",
        "Ctrl-[": "indentLess",
        "Ctrl-]": "indentMore",
        "Ctrl-U": "undoSelection",
        "Shift-Ctrl-U": "redoSelection",
        "Alt-U": "redoSelection",
        fallthrough: "basic"
    }, Md.emacsy = {
        "Ctrl-F": "goCharRight",
        "Ctrl-B": "goCharLeft",
        "Ctrl-P": "goLineUp",
        "Ctrl-N": "goLineDown",
        "Alt-F": "goWordRight",
        "Alt-B": "goWordLeft",
        "Ctrl-A": "goLineStart",
        "Ctrl-E": "goLineEnd",
        "Ctrl-V": "goPageDown",
        "Shift-Ctrl-V": "goPageUp",
        "Ctrl-D": "delCharAfter",
        "Ctrl-H": "delCharBefore",
        "Alt-D": "delWordAfter",
        "Alt-Backspace": "delWordBefore",
        "Ctrl-K": "killLine",
        "Ctrl-T": "transposeChars"
    }, Md.macDefault = {
        "Cmd-A": "selectAll",
        "Cmd-D": "deleteLine",
        "Cmd-Z": "undo",
        "Shift-Cmd-Z": "redo",
        "Cmd-Y": "redo",
        "Cmd-Home": "goDocStart",
        "Cmd-Up": "goDocStart",
        "Cmd-End": "goDocEnd",
        "Cmd-Down": "goDocEnd",
        "Alt-Left": "goGroupLeft",
        "Alt-Right": "goGroupRight",
        "Cmd-Left": "goLineLeft",
        "Cmd-Right": "goLineRight",
        "Alt-Backspace": "delGroupBefore",
        "Ctrl-Alt-Backspace": "delGroupAfter",
        "Alt-Delete": "delGroupAfter",
        "Cmd-S": "save",
        "Cmd-F": "find",
        "Cmd-G": "findNext",
        "Shift-Cmd-G": "findPrev",
        "Cmd-Alt-F": "replace",
        "Shift-Cmd-Alt-F": "replaceAll",
        "Cmd-[": "indentLess",
        "Cmd-]": "indentMore",
        "Cmd-Backspace": "delWrappedLineLeft",
        "Cmd-Delete": "delWrappedLineRight",
        "Cmd-U": "undoSelection",
        "Shift-Cmd-U": "redoSelection",
        "Ctrl-Up": "goDocStart",
        "Ctrl-Down": "goDocEnd",
        fallthrough: ["basic", "emacsy"]
    }, Md["default"] = o ? Md.macDefault : Md.pcDefault, v.normalizeKeyMap = function(a) {
        var b = {};
        for (var c in a)
            if (a.hasOwnProperty(c)) {
                var d = a[c];
                if (/^(name|fallthrough|(de|at)tach)$/.test(c)) continue;
                if ("..." == d) {
                    delete a[c];
                    continue
                }
                for (var e = eg(c.split(" "), Nd), f = 0; f < e.length; f++) {
                    var g, h;
                    f == e.length - 1 ? (h = e.join(" "), g = d) : (h = e.slice(0, f + 1).join(" "), g = "...");
                    var i = b[h];
                    if (i) {
                        if (i != g) throw new Error("Inconsistent bindings for " + h)
                    } else b[h] = g
                }
                delete a[c]
            }
        for (var j in b) a[j] = b[j];
        return a
    };
    var Od = v.lookupKey = function(a, b, c, d) {
            b = Rd(b);
            var e = b.call ? b.call(a, d) : b[a];
            if (e === !1) return "nothing";
            if ("..." === e) return "multi";
            if (null != e && c(e)) return "handled";
            if (b.fallthrough) {
                if ("[object Array]" != Object.prototype.toString.call(b.fallthrough)) return Od(a, b.fallthrough, c, d);
                for (var f = 0; f < b.fallthrough.length; f++) {
                    var g = Od(a, b.fallthrough[f], c, d);
                    if (g) return g
                }
            }
        },
        Pd = v.isModifierKey = function(a) {
            var b = "string" == typeof a ? a : Ng[a.keyCode];
            return "Ctrl" == b || "Alt" == b || "Shift" == b || "Mod" == b
        },
        Qd = v.keyName = function(a, b) {
            if (i && 34 == a.keyCode && a["char"]) return !1;
            var c = Ng[a.keyCode],
                d = c;
            return null == d || a.altGraphKey ? !1 : (a.altKey && "Alt" != c && (d = "Alt-" + d), (r ? a.metaKey : a.ctrlKey) && "Ctrl" != c && (d = "Ctrl-" + d), (r ? a.ctrlKey : a.metaKey) && "Cmd" != c && (d = "Cmd-" + d), !b && a.shiftKey && "Shift" != c && (d = "Shift-" + d), d)
        };
    v.fromTextArea = function(a, b) {
        function d() {
            a.value = i.getValue()
        }
        if (b = b ? hg(b) : {}, b.value = a.value, !b.tabindex && a.tabIndex && (b.tabindex = a.tabIndex), !b.placeholder && a.placeholder && (b.placeholder = a.placeholder), null == b.autofocus) {
            var c = ug();
            b.autofocus = c == a || null != a.getAttribute("autofocus") && c == document.body
        }
        if (a.form && (Jf(a.form, "submit", d), !b.leaveSubmitMethodAlone)) {
            var e = a.form,
                f = e.submit;
            try {
                var g = e.submit = function() {
                    d(), e.submit = f, e.submit(), e.submit = g
                }
            } catch (h) {}
        }
        b.finishInit = function(b) {
            b.save = d, b.getTextArea = function() {
                return a
            }, b.toTextArea = function() {
                b.toTextArea = isNaN, d(), a.parentNode.removeChild(b.getWrapperElement()), a.style.display = "", a.form && (Kf(a.form, "submit", d), "function" == typeof a.form.submit && (a.form.submit = f))
            }
        }, a.style.display = "none";
        var i = v(function(b) {
            a.parentNode.insertBefore(b, a.nextSibling)
        }, b);
        return i
    };
    var Sd = v.StringStream = function(a, b) {
        this.pos = this.start = 0, this.string = a, this.tabSize = b || 8, this.lastColumnPos = this.lastColumnValue = 0, this.lineStart = 0
    };
    Sd.prototype = {
        eol: function() {
            return this.pos >= this.string.length
        },
        sol: function() {
            return this.pos == this.lineStart
        },
        peek: function() {
            return this.string.charAt(this.pos) || void 0
        },
        next: function() {
            return this.pos < this.string.length ? this.string.charAt(this.pos++) : void 0
        },
        eat: function(a) {
            var b = this.string.charAt(this.pos);
            if ("string" == typeof a) var c = b == a;
            else var c = b && (a.test ? a.test(b) : a(b));
            return c ? (++this.pos, b) : void 0
        },
        eatWhile: function(a) {
            for (var b = this.pos; this.eat(a););
            return this.pos > b
        },
        eatSpace: function() {
            for (var a = this.pos;
                /[\s\u00a0]/.test(this.string.charAt(this.pos));) ++this.pos;
            return this.pos > a
        },
        skipToEnd: function() {
            this.pos = this.string.length
        },
        skipTo: function(a) {
            var b = this.string.indexOf(a, this.pos);
            return b > -1 ? (this.pos = b, !0) : void 0
        },
        backUp: function(a) {
            this.pos -= a
        },
        column: function() {
            return this.lastColumnPos < this.start && (this.lastColumnValue = Zf(this.string, this.start, this.tabSize, this.lastColumnPos, this.lastColumnValue), this.lastColumnPos = this.start), this.lastColumnValue - (this.lineStart ? Zf(this.string, this.lineStart, this.tabSize) : 0)
        },
        indentation: function() {
            return Zf(this.string, null, this.tabSize) - (this.lineStart ? Zf(this.string, this.lineStart, this.tabSize) : 0)
        },
        match: function(a, b, c) {
            if ("string" != typeof a) {
                var f = this.string.slice(this.pos).match(a);
                return f && f.index > 0 ? null : (f && b !== !1 && (this.pos += f[0].length), f)
            }
            var d = function(a) {
                    return c ? a.toLowerCase() : a
                },
                e = this.string.substr(this.pos, a.length);
            return d(e) == d(a) ? (b !== !1 && (this.pos += a.length), !0) : void 0
        },
        current: function() {
            return this.string.slice(this.start, this.pos)
        },
        hideFirstChars: function(a, b) {
            this.lineStart += a;
            try {
                return b()
            } finally {
                this.lineStart -= a
            }
        }
    };
    var Td = 0,
        Ud = v.TextMarker = function(a, b) {
            this.lines = [], this.type = b, this.doc = a, this.id = ++Td
        };
    Sf(Ud), Ud.prototype.clear = function() {
        if (!this.explicitlyCleared) {
            var a = this.doc.cm,
                b = a && !a.curOp;
            if (b && Vb(a), Rf(this, "clear")) {
                var c = this.find();
                c && Nf(this, "clear", c.from, c.to)
            }
            for (var d = null, e = null, f = 0; f < this.lines.length; ++f) {
                var g = this.lines[f],
                    h = ae(g.markedSpans, this);
                a && !this.collapsed ? jc(a, kf(g), "text") : a && (null != h.to && (e = kf(g)), null != h.from && (d = kf(g))), g.markedSpans = be(g.markedSpans, h), null == h.from && this.collapsed && !we(this.doc, g) && a && jf(g, Rb(a.display))
            }
            if (a && this.collapsed && !a.options.lineWrapping)
                for (var f = 0; f < this.lines.length; ++f) {
                    var i = se(this.lines[f]),
                        j = G(i);
                    j > a.display.maxLineLength && (a.display.maxLine = i, a.display.maxLineLength = j, a.display.maxLineChanged = !0)
                }
            null != d && a && this.collapsed && ic(a, d, e + 1), this.lines.length = 0, this.explicitlyCleared = !0, this.atomic && this.doc.cantEdit && (this.doc.cantEdit = !1, a && ab(a.doc)), a && Nf(a, "markerCleared", a, this), b && Xb(a), this.parent && this.parent.clear()
        }
    }, Ud.prototype.find = function(a, b) {
        null == a && "bookmark" == this.type && (a = 1);
        for (var c, d, e = 0; e < this.lines.length; ++e) {
            var f = this.lines[e],
                g = ae(f.markedSpans, this);
            if (null != g.from && (c = oa(b ? f : kf(f), g.from), -1 == a)) return c;
            if (null != g.to && (d = oa(b ? f : kf(f), g.to), 1 == a)) return d
        }
        return c && {
            from: c,
            to: d
        }
    }, Ud.prototype.changed = function() {
        var a = this.find(-1, !0),
            b = this,
            c = this.doc.cm;
        a && c && cc(c, function() {
            var d = a.line,
                e = kf(a.line),
                f = wb(c, e);
            if (f && (Db(f), c.curOp.selectionChanged = c.curOp.forceUpdate = !0), c.curOp.updateMaxLine = !0, !we(b.doc, d) && null != b.height) {
                var g = b.height;
                b.height = null;
                var h = Ae(b) - g;
                h && jf(d, d.height + h)
            }
        })
    }, Ud.prototype.attachLine = function(a) {
        if (!this.lines.length && this.doc.cm) {
            var b = this.doc.cm.curOp;
            b.maybeHiddenMarkers && -1 != dg(b.maybeHiddenMarkers, this) || (b.maybeUnhiddenMarkers || (b.maybeUnhiddenMarkers = [])).push(this)
        }
        this.lines.push(a)
    }, Ud.prototype.detachLine = function(a) {
        if (this.lines.splice(dg(this.lines, a), 1), !this.lines.length && this.doc.cm) {
            var b = this.doc.cm.curOp;
            (b.maybeHiddenMarkers || (b.maybeHiddenMarkers = [])).push(this)
        }
    };
    var Td = 0,
        Wd = v.SharedTextMarker = function(a, b) {
            this.markers = a, this.primary = b;
            for (var c = 0; c < a.length; ++c) a[c].parent = this
        };
    Sf(Wd), Wd.prototype.clear = function() {
        if (!this.explicitlyCleared) {
            this.explicitlyCleared = !0;
            for (var a = 0; a < this.markers.length; ++a) this.markers[a].clear();
            Nf(this, "clear")
        }
    }, Wd.prototype.find = function(a, b) {
        return this.primary.find(a, b)
    };
    var ye = v.LineWidget = function(a, b, c) {
        if (c)
            for (var d in c) c.hasOwnProperty(d) && (this[d] = c[d]);
        this.doc = a, this.node = b
    };
    Sf(ye), ye.prototype.clear = function() {
        var a = this.doc.cm,
            b = this.line.widgets,
            c = this.line,
            d = kf(c);
        if (null != d && b) {
            for (var e = 0; e < b.length; ++e) b[e] == this && b.splice(e--, 1);
            b.length || (c.widgets = null);
            var f = Ae(this);
            jf(c, Math.max(0, c.height - f)), a && cc(a, function() {
                ze(a, c, -f), jc(a, d, "widget")
            })
        }
    }, ye.prototype.changed = function() {
        var a = this.height,
            b = this.doc.cm,
            c = this.line;
        this.height = null;
        var d = Ae(this) - a;
        d && (jf(c, c.height + d), b && cc(b, function() {
            b.curOp.forceUpdate = !0, ze(b, c, d)
        }))
    };
    var Ce = v.Line = function(a, b, c) {
        this.text = a, ke(this, b), this.height = c ? c(this) : 1
    };
    Sf(Ce), Ce.prototype.lineNo = function() {
        return kf(this)
    };
    var Ne = {},
        Oe = {};
    Ze.prototype = {
        chunkSize: function() {
            return this.lines.length
        },
        removeInner: function(a, b) {
            for (var c = a, d = a + b; d > c; ++c) {
                var e = this.lines[c];
                this.height -= e.height, Ee(e), Nf(e, "delete")
            }
            this.lines.splice(a, b)
        },
        collapse: function(a) {
            a.push.apply(a, this.lines)
        },
        insertInner: function(a, b, c) {
            this.height += c, this.lines = this.lines.slice(0, a).concat(b).concat(this.lines.slice(a));
            for (var d = 0; d < b.length; ++d) b[d].parent = this
        },
        iterN: function(a, b, c) {
            for (var d = a + b; d > a; ++a)
                if (c(this.lines[a])) return !0
        }
    }, $e.prototype = {
        chunkSize: function() {
            return this.size
        },
        removeInner: function(a, b) {
            this.size -= b;
            for (var c = 0; c < this.children.length; ++c) {
                var d = this.children[c],
                    e = d.chunkSize();
                if (e > a) {
                    var f = Math.min(b, e - a),
                        g = d.height;
                    if (d.removeInner(a, f), this.height -= g - d.height, e == f && (this.children.splice(c--, 1), d.parent = null), 0 == (b -= f)) break;
                    a = 0
                } else a -= e
            }
            if (this.size - b < 25 && (this.children.length > 1 || !(this.children[0] instanceof Ze))) {
                var h = [];
                this.collapse(h), this.children = [new Ze(h)], this.children[0].parent = this
            }
        },
        collapse: function(a) {
            for (var b = 0; b < this.children.length; ++b) this.children[b].collapse(a)
        },
        insertInner: function(a, b, c) {
            this.size += b.length, this.height += c;
            for (var d = 0; d < this.children.length; ++d) {
                var e = this.children[d],
                    f = e.chunkSize();
                if (f >= a) {
                    if (e.insertInner(a, b, c), e.lines && e.lines.length > 50) {
                        for (; e.lines.length > 50;) {
                            var g = e.lines.splice(e.lines.length - 25, 25),
                                h = new Ze(g);
                            e.height -= h.height, this.children.splice(d + 1, 0, h), h.parent = this
                        }
                        this.maybeSpill()
                    }
                    break
                }
                a -= f
            }
        },
        maybeSpill: function() {
            if (!(this.children.length <= 10)) {
                var a = this;
                do {
                    var b = a.children.splice(a.children.length - 5, 5),
                        c = new $e(b);
                    if (a.parent) {
                        a.size -= c.size, a.height -= c.height;
                        var e = dg(a.parent.children, a);
                        a.parent.children.splice(e + 1, 0, c)
                    } else {
                        var d = new $e(a.children);
                        d.parent = a, a.children = [d, c], a = d
                    }
                    c.parent = a.parent
                } while (a.children.length > 10);
                a.parent.maybeSpill()
            }
        },
        iterN: function(a, b, c) {
            for (var d = 0; d < this.children.length; ++d) {
                var e = this.children[d],
                    f = e.chunkSize();
                if (f > a) {
                    var g = Math.min(b, f - a);
                    if (e.iterN(a, g, c)) return !0;
                    if (0 == (b -= g)) break;
                    a = 0
                } else a -= f
            }
        }
    };
    var _e = 0,
        af = v.Doc = function(a, b, c, d) {
            if (!(this instanceof af)) return new af(a, b, c, d);
            null == c && (c = 0), $e.call(this, [new Ze([new Ce("", null)])]), this.first = c, this.scrollTop = this.scrollLeft = 0, this.cantEdit = !1, this.cleanGeneration = 1, this.frontier = c;
            var e = oa(c, 0);
            this.sel = Ma(e), this.history = new of (null), this.id = ++_e, this.modeOption = b, this.lineSep = d, "string" == typeof a && (a = this.splitLines(a)), Ye(this, {
                from: e,
                to: e,
                text: a
            }), Za(this, Ma(e), Vf)
        };
    af.prototype = gg($e.prototype, {
        constructor: af,
        iter: function(a, b, c) {
            c ? this.iterN(a - this.first, b - a, c) : this.iterN(this.first, this.first + this.size, a)
        },
        insert: function(a, b) {
            for (var c = 0, d = 0; d < b.length; ++d) c += b[d].height;
            this.insertInner(a - this.first, b, c)
        },
        remove: function(a, b) {
            this.removeInner(a - this.first, b)
        },
        getValue: function(a) {
            var b = hf(this, this.first, this.first + this.size);
            return a === !1 ? b : b.join(a || this.lineSeparator())
        },
        setValue: fc(function(a) {
            var b = oa(this.first, 0),
                c = this.first + this.size - 1;
            hd(this, {
                from: b,
                to: oa(c, ff(this, c).text.length),
                text: this.splitLines(a),
                origin: "setValue",
                full: !0
            }, !0), Za(this, Ma(b))
        }),
        replaceRange: function(a, b, c, d) {
            b = Oa(this, b), c = c ? Oa(this, c) : b, nd(this, a, b, c, d)
        },
        getRange: function(a, b, c) {
            var d = gf(this, Oa(this, a), Oa(this, b));
            return c === !1 ? d : d.join(c || this.lineSeparator())
        },
        getLine: function(a) {
            var b = this.getLineHandle(a);
            return b && b.text
        },
        getLineHandle: function(a) {
            return Qa(this, a) ? ff(this, a) : void 0
        },
        getLineNumber: function(a) {
            return kf(a)
        },
        getLineHandleVisualStart: function(a) {
            return "number" == typeof a && (a = ff(this, a)), se(a)
        },
        lineCount: function() {
            return this.size
        },
        firstLine: function() {
            return this.first
        },
        lastLine: function() {
            return this.first + this.size - 1
        },
        clipPos: function(a) {
            return Oa(this, a)
        },
        getCursor: function(a) {
            var c, b = this.sel.primary();
            return c = null == a || "head" == a ? b.head : "anchor" == a ? b.anchor : "end" == a || "to" == a || a === !1 ? b.to() : b.from()
        },
        listSelections: function() {
            return this.sel.ranges
        },
        somethingSelected: function() {
            return this.sel.somethingSelected()
        },
        setCursor: fc(function(a, b, c) {
            Wa(this, Oa(this, "number" == typeof a ? oa(a, b || 0) : a), null, c)
        }),
        setSelection: fc(function(a, b, c) {
            Wa(this, Oa(this, a), Oa(this, b || a), c)
        }),
        extendSelection: fc(function(a, b, c) {
            Ta(this, Oa(this, a), b && Oa(this, b), c)
        }),
        extendSelections: fc(function(a, b) {
            Ua(this, Ra(this, a, b))
        }),
        extendSelectionsBy: fc(function(a, b) {
            Ua(this, eg(this.sel.ranges, a), b)
        }),
        setSelections: fc(function(a, b, c) {
            if (a.length) {
                for (var d = 0, e = []; d < a.length; d++) e[d] = new Ka(Oa(this, a[d].anchor), Oa(this, a[d].head));
                null == b && (b = Math.min(a.length - 1, this.sel.primIndex)), Za(this, La(e, b), c)
            }
        }),
        addSelection: fc(function(a, b, c) {
            var d = this.sel.ranges.slice(0);
            d.push(new Ka(Oa(this, a), Oa(this, b || a))), Za(this, La(d, d.length - 1), c)
        }),
        getSelection: function(a) {
            for (var c, b = this.sel.ranges, d = 0; d < b.length; d++) {
                var e = gf(this, b[d].from(), b[d].to());
                c = c ? c.concat(e) : e
            }
            return a === !1 ? c : c.join(a || this.lineSeparator())
        },
        getSelections: function(a) {
            for (var b = [], c = this.sel.ranges, d = 0; d < c.length; d++) {
                var e = gf(this, c[d].from(), c[d].to());
                a !== !1 && (e = e.join(a || this.lineSeparator())), b[d] = e
            }
            return b
        },
        replaceSelection: function(a, b, c) {
            for (var d = [], e = 0; e < this.sel.ranges.length; e++) d[e] = a;
            this.replaceSelections(d, b, c || "+input")
        },
        replaceSelections: fc(function(a, b, c) {
            for (var d = [], e = this.sel, f = 0; f < e.ranges.length; f++) {
                var g = e.ranges[f];
                d[f] = {
                    from: g.from(),
                    to: g.to(),
                    text: this.splitLines(a[f]),
                    origin: c
                }
            }
            for (var h = b && "end" != b && fd(this, d, b), f = d.length - 1; f >= 0; f--) hd(this, d[f]);
            h ? Ya(this, h) : this.cm && td(this.cm)
        }),
        undo: fc(function() {
            jd(this, "undo")
        }),
        redo: fc(function() {
            jd(this, "redo")
        }),
        undoSelection: fc(function() {
            jd(this, "undo", !0)
        }),
        redoSelection: fc(function() {
            jd(this, "redo", !0)
        }),
        setExtending: function(a) {
            this.extend = a
        },
        getExtending: function() {
            return this.extend
        },
        historySize: function() {
            for (var a = this.history, b = 0, c = 0, d = 0; d < a.done.length; d++) a.done[d].ranges || ++b;
            for (var d = 0; d < a.undone.length; d++) a.undone[d].ranges || ++c;
            return {
                undo: b,
                redo: c
            }
        },
        clearHistory: function() {
            this.history = new of (this.history.maxGeneration)
        },
        markClean: function() {
            this.cleanGeneration = this.changeGeneration(!0)
        },
        changeGeneration: function(a) {
            return a && (this.history.lastOp = this.history.lastSelOp = this.history.lastOrigin = null), this.history.generation
        },
        isClean: function(a) {
            return this.history.generation == (a || this.cleanGeneration)
        },
        getHistory: function() {
            return {
                done: zf(this.history.done),
                undone: zf(this.history.undone)
            }
        },
        setHistory: function(a) {
            var b = this.history = new of (this.history.maxGeneration);
            b.done = zf(a.done.slice(0), null, !0), b.undone = zf(a.undone.slice(0), null, !0)
        },
        addLineClass: fc(function(a, b, c) {
            return wd(this, a, "gutter" == b ? "gutter" : "class", function(a) {
                var d = "text" == b ? "textClass" : "background" == b ? "bgClass" : "gutter" == b ? "gutterClass" : "wrapClass";
                if (a[d]) {
                    if (vg(c).test(a[d])) return !1;
                    a[d] += " " + c
                } else a[d] = c;
                return !0
            })
        }),
        removeLineClass: fc(function(a, b, c) {
            return wd(this, a, "gutter" == b ? "gutter" : "class", function(a) {
                var d = "text" == b ? "textClass" : "background" == b ? "bgClass" : "gutter" == b ? "gutterClass" : "wrapClass",
                    e = a[d];
                if (!e) return !1;
                if (null == c) a[d] = null;
                else {
                    var f = e.match(vg(c));
                    if (!f) return !1;
                    var g = f.index + f[0].length;
                    a[d] = e.slice(0, f.index) + (f.index && g != e.length ? " " : "") + e.slice(g) || null
                }
                return !0
            })
        }),
        addLineWidget: fc(function(a, b, c) {
            return Be(this, a, b, c)
        }),
        removeLineWidget: function(a) {
            a.clear()
        },
        markText: function(a, b, c) {
            return Vd(this, Oa(this, a), Oa(this, b), c, "range")
        },
        setBookmark: function(a, b) {
            var c = {
                replacedWith: b && (null == b.nodeType ? b.widget : b),
                insertLeft: b && b.insertLeft,
                clearWhenEmpty: !1,
                shared: b && b.shared,
                handleMouseEvents: b && b.handleMouseEvents
            };
            return a = Oa(this, a), Vd(this, a, a, c, "bookmark")
        },
        findMarksAt: function(a) {
            a = Oa(this, a);
            var b = [],
                c = ff(this, a.line).markedSpans;
            if (c)
                for (var d = 0; d < c.length; ++d) {
                    var e = c[d];
                    (null == e.from || e.from <= a.ch) && (null == e.to || e.to >= a.ch) && b.push(e.marker.parent || e.marker)
                }
            return b
        },
        findMarks: function(a, b, c) {
            a = Oa(this, a), b = Oa(this, b);
            var d = [],
                e = a.line;
            return this.iter(a.line, b.line + 1, function(f) {
                var g = f.markedSpans;
                if (g)
                    for (var h = 0; h < g.length; h++) {
                        var i = g[h];
                        e == a.line && a.ch > i.to || null == i.from && e != a.line || e == b.line && i.from > b.ch || c && !c(i.marker) || d.push(i.marker.parent || i.marker)
                    }++e
            }), d
        },
        getAllMarks: function() {
            var a = [];
            return this.iter(function(b) {
                var c = b.markedSpans;
                if (c)
                    for (var d = 0; d < c.length; ++d) null != c[d].from && a.push(c[d].marker)
            }), a
        },
        posFromIndex: function(a) {
            var b, c = this.first;
            return this.iter(function(d) {
                var e = d.text.length + 1;
                return e > a ? (b = a, !0) : (a -= e, void++c)
            }), Oa(this, oa(c, b))
        },
        indexFromPos: function(a) {
            a = Oa(this, a);
            var b = a.ch;
            return a.line < this.first || a.ch < 0 ? 0 : (this.iter(this.first, a.line, function(a) {
                b += a.text.length + 1
            }), b)
        },
        copy: function(a) {
            var b = new af(hf(this, this.first, this.first + this.size), this.modeOption, this.first, this.lineSep);
            return b.scrollTop = this.scrollTop, b.scrollLeft = this.scrollLeft, b.sel = this.sel, b.extend = !1, a && (b.history.undoDepth = this.history.undoDepth, b.setHistory(this.getHistory())), b
        },
        linkedDoc: function(a) {
            a || (a = {});
            var b = this.first,
                c = this.first + this.size;
            null != a.from && a.from > b && (b = a.from), null != a.to && a.to < c && (c = a.to);
            var d = new af(hf(this, b, c), a.mode || this.modeOption, b, this.lineSep);
            return a.sharedHist && (d.history = this.history), (this.linked || (this.linked = [])).push({
                doc: d,
                sharedHist: a.sharedHist
            }), d.linked = [{
                doc: this,
                isParent: !0,
                sharedHist: a.sharedHist
            }], Zd(d, Yd(this)), d
        },
        unlinkDoc: function(a) {
            if (a instanceof v && (a = a.doc), this.linked)
                for (var b = 0; b < this.linked.length; ++b) {
                    var c = this.linked[b];
                    if (c.doc == a) {
                        this.linked.splice(b, 1), a.unlinkDoc(this), $d(Yd(this));
                        break
                    }
                }
            if (a.history == this.history) {
                var d = [a.id];
                df(a, function(a) {
                    d.push(a.id)
                }, !0), a.history = new of (null), a.history.done = zf(this.history.done, d), a.history.undone = zf(this.history.undone, d)
            }
        },
        iterLinkedDocs: function(a) {
            df(this, a)
        },
        getMode: function() {
            return this.mode
        },
        getEditor: function() {
            return this.cm
        },
        splitLines: function(a) {
            return this.lineSep ? a.split(this.lineSep) : Ig(a)
        },
        lineSeparator: function() {
            return this.lineSep || "\n"
        }
    }), af.prototype.eachLine = af.prototype.iter;
    var bf = "iter insert remove copy getEditor constructor".split(" ");
    for (var cf in af.prototype) af.prototype.hasOwnProperty(cf) && dg(bf, cf) < 0 && (v.prototype[cf] = function(a) {
        return function() {
            return a.apply(this.doc, arguments)
        }
    }(af.prototype[cf]));
    Sf(af);
    var Df = v.e_preventDefault = function(a) {
            a.preventDefault ? a.preventDefault() : a.returnValue = !1
        },
        Ef = v.e_stopPropagation = function(a) {
            a.stopPropagation ? a.stopPropagation() : a.cancelBubble = !0
        },
        Gf = v.e_stop = function(a) {
            Df(a), Ef(a)
        },
        Jf = v.on = function(a, b, c) {
            if (a.addEventListener) a.addEventListener(b, c, !1);
            else if (a.attachEvent) a.attachEvent("on" + b, c);
            else {
                var d = a._handlers || (a._handlers = {}),
                    e = d[b] || (d[b] = []);
                e.push(c)
            }
        },
        Kf = v.off = function(a, b, c) {
            if (a.removeEventListener) a.removeEventListener(b, c, !1);
            else if (a.detachEvent) a.detachEvent("on" + b, c);
            else {
                var d = a._handlers && a._handlers[b];
                if (!d) return;
                for (var e = 0; e < d.length; ++e)
                    if (d[e] == c) {
                        d.splice(e, 1);
                        break
                    }
            }
        },
        Lf = v.signal = function(a, b) {
            var c = a._handlers && a._handlers[b];
            if (c)
                for (var d = Array.prototype.slice.call(arguments, 2), e = 0; e < c.length; ++e) c[e].apply(null, d)
        },
        Mf = null,
        Tf = 30,
        Uf = v.Pass = {
            toString: function() {
                return "CodeMirror.Pass"
            }
        },
        Vf = {
            scroll: !1
        },
        Wf = {
            origin: "*mouse"
        },
        Xf = {
            origin: "+move"
        };
    Yf.prototype.set = function(a, b) {
        clearTimeout(this.id), this.id = setTimeout(b, a)
    };
    var Zf = v.countColumn = function(a, b, c, d, e) {
            null == b && (b = a.search(/[^\s\u00a0]/), -1 == b && (b = a.length));
            for (var f = d || 0, g = e || 0;;) {
                var h = a.indexOf("	", f);
                if (0 > h || h >= b) return g + (b - f);
                g += h - f, g += c - g % c, f = h + 1
            }
        },
        $f = v.findColumn = function(a, b, c) {
            for (var d = 0, e = 0;;) {
                var f = a.indexOf("	", d); - 1 == f && (f = a.length);
                var g = f - d;
                if (f == a.length || e + g >= b) return d + Math.min(g, b - e);
                if (e += f - d, e += c - e % c, d = f + 1, e >= b) return d
            }
        },
        _f = [""],
        cg = function(a) {
            a.select()
        };
    m ? cg = function(a) {
        a.selectionStart = 0, a.selectionEnd = a.value.length
    } : d && (cg = function(a) {
        try {
            a.select()
        } catch (b) {}
    });
    var qg, jg = /[\u00df\u0587\u0590-\u05f4\u0600-\u06ff\u3040-\u309f\u30a0-\u30ff\u3400-\u4db5\u4e00-\u9fcc\uac00-\ud7af]/,
        kg = v.isWordChar = function(a) {
            return /\w/.test(a) || a > "\x80" && (a.toUpperCase() != a.toLowerCase() || jg.test(a))
        },
        ng = /[\u0300-\u036f\u0483-\u0489\u0591-\u05bd\u05bf\u05c1\u05c2\u05c4\u05c5\u05c7\u0610-\u061a\u064b-\u065e\u0670\u06d6-\u06dc\u06de-\u06e4\u06e7\u06e8\u06ea-\u06ed\u0711\u0730-\u074a\u07a6-\u07b0\u07eb-\u07f3\u0816-\u0819\u081b-\u0823\u0825-\u0827\u0829-\u082d\u0900-\u0902\u093c\u0941-\u0948\u094d\u0951-\u0955\u0962\u0963\u0981\u09bc\u09be\u09c1-\u09c4\u09cd\u09d7\u09e2\u09e3\u0a01\u0a02\u0a3c\u0a41\u0a42\u0a47\u0a48\u0a4b-\u0a4d\u0a51\u0a70\u0a71\u0a75\u0a81\u0a82\u0abc\u0ac1-\u0ac5\u0ac7\u0ac8\u0acd\u0ae2\u0ae3\u0b01\u0b3c\u0b3e\u0b3f\u0b41-\u0b44\u0b4d\u0b56\u0b57\u0b62\u0b63\u0b82\u0bbe\u0bc0\u0bcd\u0bd7\u0c3e-\u0c40\u0c46-\u0c48\u0c4a-\u0c4d\u0c55\u0c56\u0c62\u0c63\u0cbc\u0cbf\u0cc2\u0cc6\u0ccc\u0ccd\u0cd5\u0cd6\u0ce2\u0ce3\u0d3e\u0d41-\u0d44\u0d4d\u0d57\u0d62\u0d63\u0dca\u0dcf\u0dd2-\u0dd4\u0dd6\u0ddf\u0e31\u0e34-\u0e3a\u0e47-\u0e4e\u0eb1\u0eb4-\u0eb9\u0ebb\u0ebc\u0ec8-\u0ecd\u0f18\u0f19\u0f35\u0f37\u0f39\u0f71-\u0f7e\u0f80-\u0f84\u0f86\u0f87\u0f90-\u0f97\u0f99-\u0fbc\u0fc6\u102d-\u1030\u1032-\u1037\u1039\u103a\u103d\u103e\u1058\u1059\u105e-\u1060\u1071-\u1074\u1082\u1085\u1086\u108d\u109d\u135f\u1712-\u1714\u1732-\u1734\u1752\u1753\u1772\u1773\u17b7-\u17bd\u17c6\u17c9-\u17d3\u17dd\u180b-\u180d\u18a9\u1920-\u1922\u1927\u1928\u1932\u1939-\u193b\u1a17\u1a18\u1a56\u1a58-\u1a5e\u1a60\u1a62\u1a65-\u1a6c\u1a73-\u1a7c\u1a7f\u1b00-\u1b03\u1b34\u1b36-\u1b3a\u1b3c\u1b42\u1b6b-\u1b73\u1b80\u1b81\u1ba2-\u1ba5\u1ba8\u1ba9\u1c2c-\u1c33\u1c36\u1c37\u1cd0-\u1cd2\u1cd4-\u1ce0\u1ce2-\u1ce8\u1ced\u1dc0-\u1de6\u1dfd-\u1dff\u200c\u200d\u20d0-\u20f0\u2cef-\u2cf1\u2de0-\u2dff\u302a-\u302f\u3099\u309a\ua66f-\ua672\ua67c\ua67d\ua6f0\ua6f1\ua802\ua806\ua80b\ua825\ua826\ua8c4\ua8e0-\ua8f1\ua926-\ua92d\ua947-\ua951\ua980-\ua982\ua9b3\ua9b6-\ua9b9\ua9bc\uaa29-\uaa2e\uaa31\uaa32\uaa35\uaa36\uaa43\uaa4c\uaab0\uaab2-\uaab4\uaab7\uaab8\uaabe\uaabf\uaac1\uabe5\uabe8\uabed\udc00-\udfff\ufb1e\ufe00-\ufe0f\ufe20-\ufe26\uff9e\uff9f]/;
    qg = document.createRange ? function(a, b, c, d) {
        var e = document.createRange();
        return e.setEnd(d || a, c), e.setStart(a, b), e
    } : function(a, b, c) {
        var d = document.body.createTextRange();
        try {
            d.moveToElementText(a.parentNode)
        } catch (e) {
            return d
        }
        return d.collapse(!0), d.moveEnd("character", c), d.moveStart("character", b), d
    };
    var tg = v.contains = function(a, b) {
        if (3 == b.nodeType && (b = b.parentNode), a.contains) return a.contains(b);
        do
            if (11 == b.nodeType && (b = b.host), b == a) return !0; while (b = b.parentNode)
    };
    d && 11 > e && (ug = function() {
        try {
            return document.activeElement
        } catch (a) {
            return document.body
        }
    });
    var Eg, Gg, wg = v.rmClass = function(a, b) {
            var c = a.className,
                d = vg(b).exec(c);
            if (d) {
                var e = c.slice(d.index + d[0].length);
                a.className = c.slice(0, d.index) + (e ? d[1] + e : "")
            }
        },
        xg = v.addClass = function(a, b) {
            var c = a.className;
            vg(b).test(c) || (a.className += (c ? " " : "") + b)
        },
        Ag = !1,
        Dg = function() {
            if (d && 9 > e) return !1;
            var a = pg("div");
            return "draggable" in a || "dragDrop" in a
        }(),
        Ig = v.splitLines = 3 != "\n\nb".split(/\n/).length ? function(a) {
            for (var b = 0, c = [], d = a.length; d >= b;) {
                var e = a.indexOf("\n", b); - 1 == e && (e = a.length);
                var f = a.slice(b, "\r" == a.charAt(e - 1) ? e - 1 : e),
                    g = f.indexOf("\r"); - 1 != g ? (c.push(f.slice(0, g)), b += g + 1) : (c.push(f), b = e + 1)
            }
            return c
        } : function(a) {
            return a.split(/\r\n?|\n/)
        },
        Jg = window.getSelection ? function(a) {
            try {
                return a.selectionStart != a.selectionEnd
            } catch (b) {
                return !1
            }
        } : function(a) {
            try {
                var b = a.ownerDocument.selection.createRange()
            } catch (c) {}
            return b && b.parentElement() == a ? 0 != b.compareEndPoints("StartToEnd", b) : !1
        },
        Kg = function() {
            var a = pg("div");
            return "oncopy" in a ? !0 : (a.setAttribute("oncopy", "return;"), "function" == typeof a.oncopy)
        }(),
        Lg = null,
        Ng = v.keyNames = {
            3: "Enter",
            8: "Backspace",
            9: "Tab",
            13: "Enter",
            16: "Shift",
            17: "Ctrl",
            18: "Alt",
            19: "Pause",
            20: "CapsLock",
            27: "Esc",
            32: "Space",
            33: "PageUp",
            34: "PageDown",
            35: "End",
            36: "Home",
            37: "Left",
            38: "Up",
            39: "Right",
            40: "Down",
            44: "PrintScrn",
            45: "Insert",
            46: "Delete",
            59: ";",
            61: "=",
            91: "Mod",
            92: "Mod",
            93: "Mod",
            106: "*",
            107: "=",
            109: "-",
            110: ".",
            111: "/",
            127: "Delete",
            173: "-",
            186: ";",
            187: "=",
            188: ",",
            189: "-",
            190: ".",
            191: "/",
            192: "`",
            219: "[",
            220: "\\",
            221: "]",
            222: "'",
            63232: "Up",
            63233: "Down",
            63234: "Left",
            63235: "Right",
            63272: "Delete",
            63273: "Home",
            63275: "End",
            63276: "PageUp",
            63277: "PageDown",
            63302: "Insert"
        };
    ! function() {
        for (var a = 0; 10 > a; a++) Ng[a + 48] = Ng[a + 96] = String(a);
        for (var a = 65; 90 >= a; a++) Ng[a] = String.fromCharCode(a);
        for (var a = 1; 12 >= a; a++) Ng[a + 111] = Ng[a + 63235] = "F" + a
    }();
    var Xg, ah = function() {
        function c(c) {
            return 247 >= c ? a.charAt(c) : c >= 1424 && 1524 >= c ? "R" : c >= 1536 && 1773 >= c ? b.charAt(c - 1536) : c >= 1774 && 2220 >= c ? "r" : c >= 8192 && 8203 >= c ? "w" : 8204 == c ? "b" : "L"
        }

        function j(a, b, c) {
            this.level = a, this.from = b, this.to = c
        }
        var a = "bbbbbbbbbtstwsbbbbbbbbbbbbbbssstwNN%%%NNNNNN,N,N1111111111NNNNNNNLLLLLLLLLLLLLLLLLLLLLLLLLLNNNNNNLLLLLLLLLLLLLLLLLLLLLLLLLLNNNNbbbbbbsbbbbbbbbbbbbbbbbbbbbbbbbbb,N%%%%NNNNLNNNNN%%11NLNNN1LNNNNNLLLLLLLLLLLLLLLLLLLLLLLNLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLLN",
            b = "rrrrrrrrrrrr,rNNmmmmmmrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrmmmmmmmmmmmmmmrrrrrrrnnnnnnnnnn%nnrrrmrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrmmmmmmmmmmmmmmmmmmmNmmmm",
            d = /[\u0590-\u05f4\u0600-\u06ff\u0700-\u08ac]/,
            e = /[stwN]/,
            f = /[LRr]/,
            g = /[Lb1n]/,
            h = /[1n]/,
            i = "L";
        return function(a) {
            if (!d.test(a)) return !1;
            for (var m, b = a.length, k = [], l = 0; b > l; ++l) k.push(m = c(a.charCodeAt(l)));
            for (var l = 0, n = i; b > l; ++l) {
                var m = k[l];
                "m" == m ? k[l] = n : n = m
            }
            for (var l = 0, o = i; b > l; ++l) {
                var m = k[l];
                "1" == m && "r" == o ? k[l] = "n" : f.test(m) && (o = m, "r" == m && (k[l] = "R"))
            }
            for (var l = 1, n = k[0]; b - 1 > l; ++l) {
                var m = k[l];
                "+" == m && "1" == n && "1" == k[l + 1] ? k[l] = "1" : "," != m || n != k[l + 1] || "1" != n && "n" != n || (k[l] = n), n = m
            }
            for (var l = 0; b > l; ++l) {
                var m = k[l];
                if ("," == m) k[l] = "N";
                else if ("%" == m) {
                    for (var p = l + 1; b > p && "%" == k[p]; ++p);
                    for (var q = l && "!" == k[l - 1] || b > p && "1" == k[p] ? "1" : "N", r = l; p > r; ++r) k[r] = q;
                    l = p - 1
                }
            }
            for (var l = 0, o = i; b > l; ++l) {
                var m = k[l];
                "L" == o && "1" == m ? k[l] = "L" : f.test(m) && (o = m)
            }
            for (var l = 0; b > l; ++l)
                if (e.test(k[l])) {
                    for (var p = l + 1; b > p && e.test(k[p]); ++p);
                    for (var s = "L" == (l ? k[l - 1] : i), t = "L" == (b > p ? k[p] : i), q = s || t ? "L" : "R", r = l; p > r; ++r) k[r] = q;
                    l = p - 1
                }
            for (var v, u = [], l = 0; b > l;)
                if (g.test(k[l])) {
                    var w = l;
                    for (++l; b > l && g.test(k[l]); ++l);
                    u.push(new j(0, w, l))
                } else {
                    var x = l,
                        y = u.length;
                    for (++l; b > l && "L" != k[l]; ++l);
                    for (var r = x; l > r;)
                        if (h.test(k[r])) {
                            r > x && u.splice(y, 0, new j(1, x, r));
                            var z = r;
                            for (++r; l > r && h.test(k[r]); ++r);
                            u.splice(y, 0, new j(2, z, r)), x = r
                        } else ++r;
                    l > x && u.splice(y, 0, new j(1, x, l))
                }
            return 1 == u[0].level && (v = a.match(/^\s+/)) && (u[0].from = v[0].length, u.unshift(new j(0, 0, v[0].length))), 1 == bg(u).level && (v = a.match(/\s+$/)) && (bg(u).to -= v[0].length, u.push(new j(0, b - v[0].length, b))), 2 == u[0].level && u.unshift(new j(1, u[0].to, u[0].to)), u[0].level != bg(u).level && u.push(new j(u[0].level, b, b)), u
        }
    }();
    return v.version = "5.6.1", v
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function b(a) {
        for (var b = {}, c = a.split(" "), d = 0; d < c.length; ++d) b[c[d]] = !0;
        return b
    }

    function e(a, b) {
        if (!b.startOfLine) return !1;
        for (;;) {
            if (!a.skipTo("\\")) {
                a.skipToEnd(), b.tokenize = null;
                break
            }
            if (a.next(), a.eol()) {
                b.tokenize = e;
                break
            }
        }
        return "meta"
    }

    function f(a, b) {
        return "variable-3" == b.prevToken ? "variable-3" : !1
    }

    function g(a, b) {
        if (a.backUp(1), a.match(/(R|u8R|uR|UR|LR)/)) {
            var c = a.match(/"([^\s\\()]{0,16})\(/);
            return c ? (b.cpp11RawStringDelim = c[1], b.tokenize = j, j(a, b)) : !1
        }
        return a.match(/(u8|u|U|L)/) ? a.match(/["']/, !1) ? "string" : !1 : (a.next(), !1)
    }

    function h(a) {
        var b = /(\w+)::(\w+)$/.exec(a);
        return b && b[1] == b[2]
    }

    function i(a, b) {
        for (var c; null != (c = a.next());)
            if ('"' == c && !a.eat('"')) {
                b.tokenize = null;
                break
            }
        return "string"
    }

    function j(a, b) {
        var c = b.cpp11RawStringDelim.replace(/[^\w\s]/g, "\\$&"),
            d = a.match(new RegExp(".*?\\)" + c + '"'));
        return d ? b.tokenize = null : a.skipToEnd(), "string"
    }

    function k(b, c) {
        function e(a) {
            if (a)
                for (var b in a) a.hasOwnProperty(b) && d.push(b)
        }
        "string" == typeof b && (b = [b]);
        var d = [];
        e(c.keywords), e(c.types), e(c.builtin), e(c.atoms), d.length && (c.helperType = b[0], a.registerHelper("hintWords", b[0], d));
        for (var f = 0; f < b.length; ++f) a.defineMIME(b[f], c)
    }

    function l(a, b) {
        for (var c = !1; !a.eol();) {
            if (!c && a.match('"""')) {
                b.tokenize = null;
                break
            }
            c = "\\" == a.next() && !c
        }
        return "string"
    }
    a.defineMode("clike", function(b, c) {
        function u(a, b) {
            var c = a.next();
            if (m[c]) {
                var d = m[c](a, b);
                if (d !== !1) return d
            }
            if ('"' == c || "'" == c) return b.tokenize = v(c), b.tokenize(a, b);
            if (/[\[\]{}\(\),;\:\.]/.test(c)) return s = c, null;
            if (/\d/.test(c)) return a.eatWhile(/[\w\.]/), "number";
            if ("/" == c) {
                if (a.eat("*")) return b.tokenize = w, w(a, b);
                if (a.eat("/")) return a.skipToEnd(), "comment"
            }
            if (r.test(c)) return a.eatWhile(r), "operator";
            if (a.eatWhile(/[\w\$_\xa1-\uffff]/), q)
                for (; a.match(q);) a.eatWhile(/[\w\$_\xa1-\uffff]/);
            var e = a.current();
            return g.propertyIsEnumerable(e) ? (j.propertyIsEnumerable(e) && (s = "newstatement"), k.propertyIsEnumerable(e) && (t = !0), "keyword") : h.propertyIsEnumerable(e) ? "variable-3" : i.propertyIsEnumerable(e) ? (j.propertyIsEnumerable(e) && (s = "newstatement"), "builtin") : l.propertyIsEnumerable(e) ? "atom" : "variable"
        }

        function v(a) {
            return function(b, c) {
                for (var e, d = !1, f = !1; null != (e = b.next());) {
                    if (e == a && !d) {
                        f = !0;
                        break
                    }
                    d = !d && "\\" == e
                }
                return (f || !d && !n) && (c.tokenize = null), "string"
            }
        }

        function w(a, b) {
            for (var d, c = !1; d = a.next();) {
                if ("/" == d && c) {
                    b.tokenize = null;
                    break
                }
                c = "*" == d
            }
            return "comment"
        }

        function x(a, b, c, d, e) {
            this.indented = a, this.column = b, this.type = c, this.align = d, this.prev = e
        }

        function y(a) {
            return "statement" == a || "switchstatement" == a || "namespace" == a
        }

        function z(a, b, c) {
            var d = a.indented;
            return a.context && y(a.context.type) && !y(c) && (d = a.context.indented), a.context = new x(d, b, c, null, a.context)
        }

        function A(a) {
            var b = a.context.type;
            return (")" == b || "]" == b || "}" == b) && (a.indented = a.context.indented), a.context = a.context.prev
        }

        function B(a, b) {
            return "variable" == b.prevToken || "variable-3" == b.prevToken ? !0 : /\S(?:[^- ]>|[*\]])\s*$|\*$/.test(a.string.slice(0, a.start)) ? !0 : void 0
        }

        function C(a) {
            for (;;) {
                if (!a || "top" == a.type) return !0;
                if ("}" == a.type && "namespace" != a.prev.type) return !1;
                a = a.prev
            }
        }
        var s, t, d = b.indentUnit,
            e = c.statementIndentUnit || d,
            f = c.dontAlignCalls,
            g = c.keywords || {},
            h = c.types || {},
            i = c.builtin || {},
            j = c.blockKeywords || {},
            k = c.defKeywords || {},
            l = c.atoms || {},
            m = c.hooks || {},
            n = c.multiLineStrings,
            o = c.indentStatements !== !1,
            p = c.indentSwitch !== !1,
            q = c.namespaceSeparator,
            r = /[+\-*&%=<>!?|\/]/;
        return {
            startState: function(a) {
                return {
                    tokenize: null,
                    context: new x((a || 0) - d, 0, "top", !1),
                    indented: 0,
                    startOfLine: !0,
                    prevToken: null
                }
            },
            token: function(a, b) {
                var d = b.context;
                if (a.sol() && (null == d.align && (d.align = !1), b.indented = a.indentation(), b.startOfLine = !0), a.eatSpace()) return null;
                s = t = null;
                var e = (b.tokenize || u)(a, b);
                if ("comment" == e || "meta" == e) return e;
                if (null == d.align && (d.align = !0), ";" == s || ":" == s || "," == s)
                    for (; y(b.context.type);) A(b);
                else if ("{" == s) z(b, a.column(), "}");
                else if ("[" == s) z(b, a.column(), "]");
                else if ("(" == s) z(b, a.column(), ")");
                else if ("}" == s) {
                    for (; y(d.type);) d = A(b);
                    for ("}" == d.type && (d = A(b)); y(d.type);) d = A(b)
                } else if (s == d.type) A(b);
                else if (o && (("}" == d.type || "top" == d.type) && ";" != s || y(d.type) && "newstatement" == s)) {
                    var f = "statement";
                    "newstatement" == s && p && "switch" == a.current() ? f = "switchstatement" : "keyword" == e && "namespace" == a.current() && (f = "namespace"), z(b, a.column(), f)
                }
                if ("variable" == e && ("def" == b.prevToken || c.typeFirstDefinitions && B(a, b) && C(b.context) && a.match(/^\s*\(/, !1)) && (e = "def"), m.token) {
                    var g = m.token(a, b, e);
                    void 0 !== g && (e = g)
                }
                return "def" == e && c.styleDefs === !1 && (e = "variable"), b.startOfLine = !1, b.prevToken = t ? "def" : e || s, e
            },
            indent: function(b, c) {
                if (b.tokenize != u && null != b.tokenize) return a.Pass;
                var g = b.context,
                    h = c && c.charAt(0);
                y(g.type) && "}" == h && (g = g.prev);
                var i = h == g.type,
                    j = g.prev && "switchstatement" == g.prev.type;
                return y(g.type) ? g.indented + ("{" == h ? 0 : e) : !g.align || f && ")" == g.type ? ")" != g.type || i ? g.indented + (i ? 0 : d) + (i || !j || /^(?:case|default)\b/.test(c) ? 0 : d) : g.indented + e : g.column + (i ? 0 : 1)
            },
            electricInput: p ? /^\s*(?:case .*?:|default:|\{\}?|\})$/ : /^\s*[{}]$/,
            blockCommentStart: "/*",
            blockCommentEnd: "*/",
            lineComment: "//",
            fold: "brace"
        }
    });
    var c = "auto if break case register continue return default do sizeof static else struct switch extern typedef float union for goto while enum const volatile",
        d = "int long char short double float unsigned signed void size_t ptrdiff_t";
    k(["text/x-csrc", "text/x-c", "text/x-chdr"], {
        name: "clike",
        keywords: b(c),
        types: b(d + " bool _Complex _Bool float_t double_t intptr_t intmax_t int8_t int16_t int32_t int64_t uintptr_t uintmax_t uint8_t uint16_t uint32_t uint64_t"),
        blockKeywords: b("case do else for if switch while struct"),
        defKeywords: b("struct"),
        typeFirstDefinitions: !0,
        atoms: b("null true false"),
        hooks: {
            "#": e,
            "*": f
        },
        modeProps: {
            fold: ["brace", "include"]
        }
    }), k(["text/x-c++src", "text/x-c++hdr"], {
        name: "clike",
        keywords: b(c + " asm dynamic_cast namespace reinterpret_cast try explicit new static_cast typeid catch operator template typename class friend private this using const_cast inline public throw virtual delete mutable protected alignas alignof constexpr decltype nullptr noexcept thread_local final static_assert override"),
        types: b(d + " bool wchar_t"),
        blockKeywords: b("catch class do else finally for if struct switch try while"),
        defKeywords: b("class namespace struct enum union"),
        typeFirstDefinitions: !0,
        atoms: b("true false null"),
        hooks: {
            "#": e,
            "*": f,
            u: g,
            U: g,
            L: g,
            R: g,
            token: function(a, b, c) {
                return "variable" != c || "(" != a.peek() || ";" != b.prevToken && null != b.prevToken && "}" != b.prevToken || !h(a.current()) ? void 0 : "def";
            }
        },
        namespaceSeparator: "::",
        modeProps: {
            fold: ["brace", "include"]
        }
    }), k("text/x-java", {
        name: "clike",
        keywords: b("abstract assert break case catch class const continue default do else enum extends final finally float for goto if implements import instanceof interface native new package private protected public return static strictfp super switch synchronized this throw throws transient try volatile while"),
        types: b("byte short int long float double boolean char void Boolean Byte Character Double Float Integer Long Number Object Short String StringBuffer StringBuilder Void"),
        blockKeywords: b("catch class do else finally for if switch try while"),
        defKeywords: b("class interface package enum"),
        typeFirstDefinitions: !0,
        atoms: b("true false null"),
        hooks: {
            "@": function(a) {
                return a.eatWhile(/[\w\$_]/), "meta"
            }
        },
        modeProps: {
            fold: ["brace", "import"]
        }
    }), k("text/x-csharp", {
        name: "clike",
        keywords: b("abstract as async await base break case catch checked class const continue default delegate do else enum event explicit extern finally fixed for foreach goto if implicit in interface internal is lock namespace new operator out override params private protected public readonly ref return sealed sizeof stackalloc static struct switch this throw try typeof unchecked unsafe using virtual void volatile while add alias ascending descending dynamic from get global group into join let orderby partial remove select set value var yield"),
        types: b("Action Boolean Byte Char DateTime DateTimeOffset Decimal Double Func Guid Int16 Int32 Int64 Object SByte Single String Task TimeSpan UInt16 UInt32 UInt64 bool byte char decimal double short int long object sbyte float string ushort uint ulong"),
        blockKeywords: b("catch class do else finally for foreach if struct switch try while"),
        defKeywords: b("class interface namespace struct var"),
        typeFirstDefinitions: !0,
        atoms: b("true false null"),
        hooks: {
            "@": function(a, b) {
                return a.eat('"') ? (b.tokenize = i, i(a, b)) : (a.eatWhile(/[\w\$_]/), "meta")
            }
        }
    }), k("text/x-scala", {
        name: "clike",
        keywords: b("abstract case catch class def do else extends false final finally for forSome if implicit import lazy match new null object override package private protected return sealed super this throw trait try type val var while with yield _ : = => <- <: <% >: # @ assert assume require print println printf readLine readBoolean readByte readShort readChar readInt readLong readFloat readDouble :: #:: "),
        types: b("AnyVal App Application Array BufferedIterator BigDecimal BigInt Char Console Either Enumeration Equiv Error Exception Fractional Function IndexedSeq Integral Iterable Iterator List Map Numeric Nil NotNull Option Ordered Ordering PartialFunction PartialOrdering Product Proxy Range Responder Seq Serializable Set Specializable Stream StringBuilder StringContext Symbol Throwable Traversable TraversableOnce Tuple Unit Vector Boolean Byte Character CharSequence Class ClassLoader Cloneable Comparable Compiler Double Exception Float Integer Long Math Number Object Package Pair Process Runtime Runnable SecurityManager Short StackTraceElement StrictMath String StringBuffer System Thread ThreadGroup ThreadLocal Throwable Triple Void"),
        multiLineStrings: !0,
        blockKeywords: b("catch class do else finally for forSome if match switch try while"),
        defKeywords: b("class def object package trait type val var"),
        atoms: b("true false null"),
        indentStatements: !1,
        indentSwitch: !1,
        hooks: {
            "@": function(a) {
                return a.eatWhile(/[\w\$_]/), "meta"
            },
            '"': function(a, b) {
                return a.match('""') ? (b.tokenize = l, b.tokenize(a, b)) : !1
            },
            "'": function(a) {
                return a.eatWhile(/[\w\$_\xa1-\uffff]/), "atom"
            }
        },
        modeProps: {
            closeBrackets: {
                triples: '"'
            }
        }
    }), k(["x-shader/x-vertex", "x-shader/x-fragment"], {
        name: "clike",
        keywords: b("sampler1D sampler2D sampler3D samplerCube sampler1DShadow sampler2DShadow const attribute uniform varying break continue discard return for while do if else struct in out inout"),
        types: b("float int bool void vec2 vec3 vec4 ivec2 ivec3 ivec4 bvec2 bvec3 bvec4 mat2 mat3 mat4"),
        blockKeywords: b("for while do if else struct"),
        builtin: b("radians degrees sin cos tan asin acos atan pow exp log exp2 sqrt inversesqrt abs sign floor ceil fract mod min max clamp mix step smoothstep length distance dot cross normalize ftransform faceforward reflect refract matrixCompMult lessThan lessThanEqual greaterThan greaterThanEqual equal notEqual any all not texture1D texture1DProj texture1DLod texture1DProjLod texture2D texture2DProj texture2DLod texture2DProjLod texture3D texture3DProj texture3DLod texture3DProjLod textureCube textureCubeLod shadow1D shadow2D shadow1DProj shadow2DProj shadow1DLod shadow2DLod shadow1DProjLod shadow2DProjLod dFdx dFdy fwidth noise1 noise2 noise3 noise4"),
        atoms: b("true false gl_FragColor gl_SecondaryColor gl_Normal gl_Vertex gl_MultiTexCoord0 gl_MultiTexCoord1 gl_MultiTexCoord2 gl_MultiTexCoord3 gl_MultiTexCoord4 gl_MultiTexCoord5 gl_MultiTexCoord6 gl_MultiTexCoord7 gl_FogCoord gl_PointCoord gl_Position gl_PointSize gl_ClipVertex gl_FrontColor gl_BackColor gl_FrontSecondaryColor gl_BackSecondaryColor gl_TexCoord gl_FogFragCoord gl_FragCoord gl_FrontFacing gl_FragData gl_FragDepth gl_ModelViewMatrix gl_ProjectionMatrix gl_ModelViewProjectionMatrix gl_TextureMatrix gl_NormalMatrix gl_ModelViewMatrixInverse gl_ProjectionMatrixInverse gl_ModelViewProjectionMatrixInverse gl_TexureMatrixTranspose gl_ModelViewMatrixInverseTranspose gl_ProjectionMatrixInverseTranspose gl_ModelViewProjectionMatrixInverseTranspose gl_TextureMatrixInverseTranspose gl_NormalScale gl_DepthRange gl_ClipPlane gl_Point gl_FrontMaterial gl_BackMaterial gl_LightSource gl_LightModel gl_FrontLightModelProduct gl_BackLightModelProduct gl_TextureColor gl_EyePlaneS gl_EyePlaneT gl_EyePlaneR gl_EyePlaneQ gl_FogParameters gl_MaxLights gl_MaxClipPlanes gl_MaxTextureUnits gl_MaxTextureCoords gl_MaxVertexAttribs gl_MaxVertexUniformComponents gl_MaxVaryingFloats gl_MaxVertexTextureImageUnits gl_MaxTextureImageUnits gl_MaxFragmentUniformComponents gl_MaxCombineTextureImageUnits gl_MaxDrawBuffers"),
        indentSwitch: !1,
        hooks: {
            "#": e
        },
        modeProps: {
            fold: ["brace", "include"]
        }
    }), k("text/x-nesc", {
        name: "clike",
        keywords: b(c + "as atomic async call command component components configuration event generic implementation includes interface module new norace nx_struct nx_union post provides signal task uses abstract extends"),
        types: b(d),
        blockKeywords: b("case do else for if switch while struct"),
        atoms: b("null true false"),
        hooks: {
            "#": e
        },
        modeProps: {
            fold: ["brace", "include"]
        }
    }), k("text/x-objectivec", {
        name: "clike",
        keywords: b(c + "inline restrict _Bool _Complex _Imaginery BOOL Class bycopy byref id IMP in inout nil oneway out Protocol SEL self super atomic nonatomic retain copy readwrite readonly"),
        types: b(d),
        atoms: b("YES NO NULL NILL ON OFF true false"),
        hooks: {
            "@": function(a) {
                return a.eatWhile(/[\w\$]/), "keyword"
            },
            "#": e
        },
        modeProps: {
            fold: "brace"
        }
    }), k("text/x-squirrel", {
        name: "clike",
        keywords: b("base break clone continue const default delete enum extends function in class foreach local resume return this throw typeof yield constructor instanceof static"),
        types: b(d),
        blockKeywords: b("case catch class else for foreach if switch try while"),
        defKeywords: b("function local class"),
        typeFirstDefinitions: !0,
        atoms: b("true false null"),
        hooks: {
            "#": e
        },
        modeProps: {
            fold: ["brace", "include"]
        }
    })
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function b(a) {
        for (var b = {}, c = 0; c < a.length; ++c) b[a[c]] = !0;
        return b
    }

    function x(a, b) {
        for (var d, c = !1; null != (d = a.next());) {
            if (c && "/" == d) {
                b.tokenize = null;
                break
            }
            c = "*" == d
        }
        return ["comment", "comment"]
    }
    a.defineMode("css", function(b, c) {
        function u(a, b) {
            return s = b, a
        }

        function v(a, b) {
            var c = a.next();
            if (f[c]) {
                var d = f[c](a, b);
                if (d !== !1) return d
            }
            return "@" == c ? (a.eatWhile(/[\w\\\-]/), u("def", a.current())) : "=" == c || ("~" == c || "|" == c) && a.eat("=") ? u(null, "compare") : '"' == c || "'" == c ? (b.tokenize = w(c), b.tokenize(a, b)) : "#" == c ? (a.eatWhile(/[\w\\\-]/), u("atom", "hash")) : "!" == c ? (a.match(/^\s*\w*/), u("keyword", "important")) : /\d/.test(c) || "." == c && a.eat(/\d/) ? (a.eatWhile(/[\w.%]/), u("number", "unit")) : "-" !== c ? /[,+>*\/]/.test(c) ? u(null, "select-op") : "." == c && a.match(/^-?[_a-z][_a-z0-9-]*/i) ? u("qualifier", "qualifier") : /[:;{}\[\]\(\)]/.test(c) ? u(null, c) : "u" == c && a.match(/rl(-prefix)?\(/) || "d" == c && a.match("omain(") || "r" == c && a.match("egexp(") ? (a.backUp(1), b.tokenize = x, u("property", "word")) : /[\w\\\-]/.test(c) ? (a.eatWhile(/[\w\\\-]/), u("property", "word")) : u(null, null) : /[\d.]/.test(a.peek()) ? (a.eatWhile(/[\w.%]/), u("number", "unit")) : a.match(/^-[\w\\\-]+/) ? (a.eatWhile(/[\w\\\-]/), a.match(/^\s*:/, !1) ? u("variable-2", "variable-definition") : u("variable-2", "variable")) : a.match(/^\w+-/) ? u("meta", "meta") : void 0
        }

        function w(a) {
            return function(b, c) {
                for (var e, d = !1; null != (e = b.next());) {
                    if (e == a && !d) {
                        ")" == a && b.backUp(1);
                        break
                    }
                    d = !d && "\\" == e
                }
                return (e == a || !d && ")" != a) && (c.tokenize = null), u("string", "string")
            }
        }

        function x(a, b) {
            return a.next(), a.match(/\s*[\"\')]/, !1) ? b.tokenize = null : b.tokenize = w(")"), u(null, "(")
        }

        function y(a, b, c) {
            this.type = a, this.indent = b, this.prev = c
        }

        function z(a, b, c, d) {
            return a.context = new y(c, b.indentation() + (d === !1 ? 0 : e), a.context), c
        }

        function A(a) {
            return a.context.prev && (a.context = a.context.prev), a.context.type
        }

        function B(a, b, c) {
            return E[c.context.type](a, b, c)
        }

        function C(a, b, c, d) {
            for (var e = d || 1; e > 0; e--) c.context = c.context.prev;
            return B(a, b, c)
        }

        function D(a) {
            var b = a.current().toLowerCase();
            t = p.hasOwnProperty(b) ? "atom" : o.hasOwnProperty(b) ? "keyword" : "variable"
        }
        var d = c;
        c.propertyKeywords || (c = a.resolveMode("text/css")), c.inline = d.inline;
        var s, t, e = b.indentUnit,
            f = c.tokenHooks,
            g = c.documentTypes || {},
            h = c.mediaTypes || {},
            i = c.mediaFeatures || {},
            j = c.mediaValueKeywords || {},
            k = c.propertyKeywords || {},
            l = c.nonStandardPropertyKeywords || {},
            m = c.fontProperties || {},
            n = c.counterDescriptors || {},
            o = c.colorKeywords || {},
            p = c.valueKeywords || {},
            q = c.allowNested,
            r = c.supportsAtComponent === !0,
            E = {};
        return E.top = function(a, b, c) {
            if ("{" == a) return z(c, b, "block");
            if ("}" == a && c.context.prev) return A(c);
            if (r && /@component/.test(a)) return z(c, b, "atComponentBlock");
            if (/^@(-moz-)?document$/.test(a)) return z(c, b, "documentTypes");
            if (/^@(media|supports|(-moz-)?document|import)$/.test(a)) return z(c, b, "atBlock");
            if (/^@(font-face|counter-style)/.test(a)) return c.stateArg = a, "restricted_atBlock_before";
            if (/^@(-(moz|ms|o|webkit)-)?keyframes$/.test(a)) return "keyframes";
            if (a && "@" == a.charAt(0)) return z(c, b, "at");
            if ("hash" == a) t = "builtin";
            else if ("word" == a) t = "tag";
            else {
                if ("variable-definition" == a) return "maybeprop";
                if ("interpolation" == a) return z(c, b, "interpolation");
                if (":" == a) return "pseudo";
                if (q && "(" == a) return z(c, b, "parens")
            }
            return c.context.type
        }, E.block = function(a, b, c) {
            if ("word" == a) {
                var d = b.current().toLowerCase();
                return k.hasOwnProperty(d) ? (t = "property", "maybeprop") : l.hasOwnProperty(d) ? (t = "string-2", "maybeprop") : q ? (t = b.match(/^\s*:(?:\s|$)/, !1) ? "property" : "tag", "block") : (t += " error", "maybeprop")
            }
            return "meta" == a ? "block" : q || "hash" != a && "qualifier" != a ? E.top(a, b, c) : (t = "error", "block")
        }, E.maybeprop = function(a, b, c) {
            return ":" == a ? z(c, b, "prop") : B(a, b, c)
        }, E.prop = function(a, b, c) {
            if (";" == a) return A(c);
            if ("{" == a && q) return z(c, b, "propBlock");
            if ("}" == a || "{" == a) return C(a, b, c);
            if ("(" == a) return z(c, b, "parens");
            if ("hash" != a || /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/.test(b.current())) {
                if ("word" == a) D(b);
                else if ("interpolation" == a) return z(c, b, "interpolation")
            } else t += " error";
            return "prop"
        }, E.propBlock = function(a, b, c) {
            return "}" == a ? A(c) : "word" == a ? (t = "property", "maybeprop") : c.context.type
        }, E.parens = function(a, b, c) {
            return "{" == a || "}" == a ? C(a, b, c) : ")" == a ? A(c) : "(" == a ? z(c, b, "parens") : "interpolation" == a ? z(c, b, "interpolation") : ("word" == a && D(b), "parens")
        }, E.pseudo = function(a, b, c) {
            return "word" == a ? (t = "variable-3", c.context.type) : B(a, b, c)
        }, E.documentTypes = function(a, b, c) {
            return "word" == a && g.hasOwnProperty(b.current()) ? (t = "tag", c.context.type) : E.atBlock(a, b, c)
        }, E.atBlock = function(a, b, c) {
            if ("(" == a) return z(c, b, "atBlock_parens");
            if ("}" == a || ";" == a) return C(a, b, c);
            if ("{" == a) return A(c) && z(c, b, q ? "block" : "top");
            if ("word" == a) {
                var d = b.current().toLowerCase();
                t = "only" == d || "not" == d || "and" == d || "or" == d ? "keyword" : h.hasOwnProperty(d) ? "attribute" : i.hasOwnProperty(d) ? "property" : j.hasOwnProperty(d) ? "keyword" : k.hasOwnProperty(d) ? "property" : l.hasOwnProperty(d) ? "string-2" : p.hasOwnProperty(d) ? "atom" : o.hasOwnProperty(d) ? "keyword" : "error"
            }
            return c.context.type
        }, E.atComponentBlock = function(a, b, c) {
            return "}" == a ? C(a, b, c) : "{" == a ? A(c) && z(c, b, q ? "block" : "top", !1) : ("word" == a && (t = "error"), c.context.type)
        }, E.atBlock_parens = function(a, b, c) {
            return ")" == a ? A(c) : "{" == a || "}" == a ? C(a, b, c, 2) : E.atBlock(a, b, c)
        }, E.restricted_atBlock_before = function(a, b, c) {
            return "{" == a ? z(c, b, "restricted_atBlock") : "word" == a && "@counter-style" == c.stateArg ? (t = "variable", "restricted_atBlock_before") : B(a, b, c)
        }, E.restricted_atBlock = function(a, b, c) {
            return "}" == a ? (c.stateArg = null, A(c)) : "word" == a ? (t = "@font-face" == c.stateArg && !m.hasOwnProperty(b.current().toLowerCase()) || "@counter-style" == c.stateArg && !n.hasOwnProperty(b.current().toLowerCase()) ? "error" : "property", "maybeprop") : "restricted_atBlock"
        }, E.keyframes = function(a, b, c) {
            return "word" == a ? (t = "variable", "keyframes") : "{" == a ? z(c, b, "top") : B(a, b, c)
        }, E.at = function(a, b, c) {
            return ";" == a ? A(c) : "{" == a || "}" == a ? C(a, b, c) : ("word" == a ? t = "tag" : "hash" == a && (t = "builtin"), "at")
        }, E.interpolation = function(a, b, c) {
            return "}" == a ? A(c) : "{" == a || ";" == a ? C(a, b, c) : ("word" == a ? t = "variable" : "variable" != a && "(" != a && ")" != a && (t = "error"), "interpolation")
        }, {
            startState: function(a) {
                return {
                    tokenize: null,
                    state: c.inline ? "block" : "top",
                    stateArg: null,
                    context: new y(c.inline ? "block" : "top", a || 0, null)
                }
            },
            token: function(a, b) {
                if (!b.tokenize && a.eatSpace()) return null;
                var c = (b.tokenize || v)(a, b);
                return c && "object" == typeof c && (s = c[1], c = c[0]), t = c, b.state = E[b.state](s, a, b), t
            },
            indent: function(a, b) {
                var c = a.context,
                    d = b && b.charAt(0),
                    f = c.indent;
                return "prop" != c.type || "}" != d && ")" != d || (c = c.prev), c.prev && ("}" != d || "block" != c.type && "top" != c.type && "interpolation" != c.type && "restricted_atBlock" != c.type ? (")" == d && ("parens" == c.type || "atBlock_parens" == c.type) || "{" == d && ("at" == c.type || "atBlock" == c.type)) && (f = Math.max(0, c.indent - e), c = c.prev) : (c = c.prev, f = c.indent)), f
            },
            electricChars: "}",
            blockCommentStart: "/*",
            blockCommentEnd: "*/",
            fold: "brace"
        }
    });
    var c = ["domain", "regexp", "url", "url-prefix"],
        d = b(c),
        e = ["all", "aural", "braille", "handheld", "print", "projection", "screen", "tty", "tv", "embossed"],
        f = b(e),
        g = ["width", "min-width", "max-width", "height", "min-height", "max-height", "device-width", "min-device-width", "max-device-width", "device-height", "min-device-height", "max-device-height", "aspect-ratio", "min-aspect-ratio", "max-aspect-ratio", "device-aspect-ratio", "min-device-aspect-ratio", "max-device-aspect-ratio", "color", "min-color", "max-color", "color-index", "min-color-index", "max-color-index", "monochrome", "min-monochrome", "max-monochrome", "resolution", "min-resolution", "max-resolution", "scan", "grid", "orientation", "device-pixel-ratio", "min-device-pixel-ratio", "max-device-pixel-ratio", "pointer", "any-pointer", "hover", "any-hover"],
        h = b(g),
        i = ["landscape", "portrait", "none", "coarse", "fine", "on-demand", "hover", "interlace", "progressive"],
        j = b(i),
        k = ["align-content", "align-items", "align-self", "alignment-adjust", "alignment-baseline", "anchor-point", "animation", "animation-delay", "animation-direction", "animation-duration", "animation-fill-mode", "animation-iteration-count", "animation-name", "animation-play-state", "animation-timing-function", "appearance", "azimuth", "backface-visibility", "background", "background-attachment", "background-clip", "background-color", "background-image", "background-origin", "background-position", "background-repeat", "background-size", "baseline-shift", "binding", "bleed", "bookmark-label", "bookmark-level", "bookmark-state", "bookmark-target", "border", "border-bottom", "border-bottom-color", "border-bottom-left-radius", "border-bottom-right-radius", "border-bottom-style", "border-bottom-width", "border-collapse", "border-color", "border-image", "border-image-outset", "border-image-repeat", "border-image-slice", "border-image-source", "border-image-width", "border-left", "border-left-color", "border-left-style", "border-left-width", "border-radius", "border-right", "border-right-color", "border-right-style", "border-right-width", "border-spacing", "border-style", "border-top", "border-top-color", "border-top-left-radius", "border-top-right-radius", "border-top-style", "border-top-width", "border-width", "bottom", "box-decoration-break", "box-shadow", "box-sizing", "break-after", "break-before", "break-inside", "caption-side", "clear", "clip", "color", "color-profile", "column-count", "column-fill", "column-gap", "column-rule", "column-rule-color", "column-rule-style", "column-rule-width", "column-span", "column-width", "columns", "content", "counter-increment", "counter-reset", "crop", "cue", "cue-after", "cue-before", "cursor", "direction", "display", "dominant-baseline", "drop-initial-after-adjust", "drop-initial-after-align", "drop-initial-before-adjust", "drop-initial-before-align", "drop-initial-size", "drop-initial-value", "elevation", "empty-cells", "fit", "fit-position", "flex", "flex-basis", "flex-direction", "flex-flow", "flex-grow", "flex-shrink", "flex-wrap", "float", "float-offset", "flow-from", "flow-into", "font", "font-feature-settings", "font-family", "font-kerning", "font-language-override", "font-size", "font-size-adjust", "font-stretch", "font-style", "font-synthesis", "font-variant", "font-variant-alternates", "font-variant-caps", "font-variant-east-asian", "font-variant-ligatures", "font-variant-numeric", "font-variant-position", "font-weight", "grid", "grid-area", "grid-auto-columns", "grid-auto-flow", "grid-auto-position", "grid-auto-rows", "grid-column", "grid-column-end", "grid-column-start", "grid-row", "grid-row-end", "grid-row-start", "grid-template", "grid-template-areas", "grid-template-columns", "grid-template-rows", "hanging-punctuation", "height", "hyphens", "icon", "image-orientation", "image-rendering", "image-resolution", "inline-box-align", "justify-content", "left", "letter-spacing", "line-break", "line-height", "line-stacking", "line-stacking-ruby", "line-stacking-shift", "line-stacking-strategy", "list-style", "list-style-image", "list-style-position", "list-style-type", "margin", "margin-bottom", "margin-left", "margin-right", "margin-top", "marker-offset", "marks", "marquee-direction", "marquee-loop", "marquee-play-count", "marquee-speed", "marquee-style", "max-height", "max-width", "min-height", "min-width", "move-to", "nav-down", "nav-index", "nav-left", "nav-right", "nav-up", "object-fit", "object-position", "opacity", "order", "orphans", "outline", "outline-color", "outline-offset", "outline-style", "outline-width", "overflow", "overflow-style", "overflow-wrap", "overflow-x", "overflow-y", "padding", "padding-bottom", "padding-left", "padding-right", "padding-top", "page", "page-break-after", "page-break-before", "page-break-inside", "page-policy", "pause", "pause-after", "pause-before", "perspective", "perspective-origin", "pitch", "pitch-range", "play-during", "position", "presentation-level", "punctuation-trim", "quotes", "region-break-after", "region-break-before", "region-break-inside", "region-fragment", "rendering-intent", "resize", "rest", "rest-after", "rest-before", "richness", "right", "rotation", "rotation-point", "ruby-align", "ruby-overhang", "ruby-position", "ruby-span", "shape-image-threshold", "shape-inside", "shape-margin", "shape-outside", "size", "speak", "speak-as", "speak-header", "speak-numeral", "speak-punctuation", "speech-rate", "stress", "string-set", "tab-size", "table-layout", "target", "target-name", "target-new", "target-position", "text-align", "text-align-last", "text-decoration", "text-decoration-color", "text-decoration-line", "text-decoration-skip", "text-decoration-style", "text-emphasis", "text-emphasis-color", "text-emphasis-position", "text-emphasis-style", "text-height", "text-indent", "text-justify", "text-outline", "text-overflow", "text-shadow", "text-size-adjust", "text-space-collapse", "text-transform", "text-underline-position", "text-wrap", "top", "transform", "transform-origin", "transform-style", "transition", "transition-delay", "transition-duration", "transition-property", "transition-timing-function", "unicode-bidi", "vertical-align", "visibility", "voice-balance", "voice-duration", "voice-family", "voice-pitch", "voice-range", "voice-rate", "voice-stress", "voice-volume", "volume", "white-space", "widows", "width", "word-break", "word-spacing", "word-wrap", "z-index", "clip-path", "clip-rule", "mask", "enable-background", "filter", "flood-color", "flood-opacity", "lighting-color", "stop-color", "stop-opacity", "pointer-events", "color-interpolation", "color-interpolation-filters", "color-rendering", "fill", "fill-opacity", "fill-rule", "image-rendering", "marker", "marker-end", "marker-mid", "marker-start", "shape-rendering", "stroke", "stroke-dasharray", "stroke-dashoffset", "stroke-linecap", "stroke-linejoin", "stroke-miterlimit", "stroke-opacity", "stroke-width", "text-rendering", "baseline-shift", "dominant-baseline", "glyph-orientation-horizontal", "glyph-orientation-vertical", "text-anchor", "writing-mode"],
        l = b(k),
        m = ["scrollbar-arrow-color", "scrollbar-base-color", "scrollbar-dark-shadow-color", "scrollbar-face-color", "scrollbar-highlight-color", "scrollbar-shadow-color", "scrollbar-3d-light-color", "scrollbar-track-color", "shape-inside", "searchfield-cancel-button", "searchfield-decoration", "searchfield-results-button", "searchfield-results-decoration", "zoom"],
        n = b(m),
        o = ["font-family", "src", "unicode-range", "font-variant", "font-feature-settings", "font-stretch", "font-weight", "font-style"],
        p = b(o),
        q = ["additive-symbols", "fallback", "negative", "pad", "prefix", "range", "speak-as", "suffix", "symbols", "system"],
        r = b(q),
        s = ["aliceblue", "antiquewhite", "aqua", "aquamarine", "azure", "beige", "bisque", "black", "blanchedalmond", "blue", "blueviolet", "brown", "burlywood", "cadetblue", "chartreuse", "chocolate", "coral", "cornflowerblue", "cornsilk", "crimson", "cyan", "darkblue", "darkcyan", "darkgoldenrod", "darkgray", "darkgreen", "darkkhaki", "darkmagenta", "darkolivegreen", "darkorange", "darkorchid", "darkred", "darksalmon", "darkseagreen", "darkslateblue", "darkslategray", "darkturquoise", "darkviolet", "deeppink", "deepskyblue", "dimgray", "dodgerblue", "firebrick", "floralwhite", "forestgreen", "fuchsia", "gainsboro", "ghostwhite", "gold", "goldenrod", "gray", "grey", "green", "greenyellow", "honeydew", "hotpink", "indianred", "indigo", "ivory", "khaki", "lavender", "lavenderblush", "lawngreen", "lemonchiffon", "lightblue", "lightcoral", "lightcyan", "lightgoldenrodyellow", "lightgray", "lightgreen", "lightpink", "lightsalmon", "lightseagreen", "lightskyblue", "lightslategray", "lightsteelblue", "lightyellow", "lime", "limegreen", "linen", "magenta", "maroon", "mediumaquamarine", "mediumblue", "mediumorchid", "mediumpurple", "mediumseagreen", "mediumslateblue", "mediumspringgreen", "mediumturquoise", "mediumvioletred", "midnightblue", "mintcream", "mistyrose", "moccasin", "navajowhite", "navy", "oldlace", "olive", "olivedrab", "orange", "orangered", "orchid", "palegoldenrod", "palegreen", "paleturquoise", "palevioletred", "papayawhip", "peachpuff", "peru", "pink", "plum", "powderblue", "purple", "rebeccapurple", "red", "rosybrown", "royalblue", "saddlebrown", "salmon", "sandybrown", "seagreen", "seashell", "sienna", "silver", "skyblue", "slateblue", "slategray", "snow", "springgreen", "steelblue", "tan", "teal", "thistle", "tomato", "turquoise", "violet", "wheat", "white", "whitesmoke", "yellow", "yellowgreen"],
        t = b(s),
        u = ["above", "absolute", "activeborder", "additive", "activecaption", "afar", "after-white-space", "ahead", "alias", "all", "all-scroll", "alphabetic", "alternate", "always", "amharic", "amharic-abegede", "antialiased", "appworkspace", "arabic-indic", "armenian", "asterisks", "attr", "auto", "avoid", "avoid-column", "avoid-page", "avoid-region", "background", "backwards", "baseline", "below", "bidi-override", "binary", "bengali", "blink", "block", "block-axis", "bold", "bolder", "border", "border-box", "both", "bottom", "break", "break-all", "break-word", "bullets", "button", "button-bevel", "buttonface", "buttonhighlight", "buttonshadow", "buttontext", "calc", "cambodian", "capitalize", "caps-lock-indicator", "caption", "captiontext", "caret", "cell", "center", "checkbox", "circle", "cjk-decimal", "cjk-earthly-branch", "cjk-heavenly-stem", "cjk-ideographic", "clear", "clip", "close-quote", "col-resize", "collapse", "column", "column-reverse", "compact", "condensed", "contain", "content", "content-box", "context-menu", "continuous", "copy", "counter", "counters", "cover", "crop", "cross", "crosshair", "currentcolor", "cursive", "cyclic", "dashed", "decimal", "decimal-leading-zero", "default", "default-button", "destination-atop", "destination-in", "destination-out", "destination-over", "devanagari", "disc", "discard", "disclosure-closed", "disclosure-open", "document", "dot-dash", "dot-dot-dash", "dotted", "double", "down", "e-resize", "ease", "ease-in", "ease-in-out", "ease-out", "element", "ellipse", "ellipsis", "embed", "end", "ethiopic", "ethiopic-abegede", "ethiopic-abegede-am-et", "ethiopic-abegede-gez", "ethiopic-abegede-ti-er", "ethiopic-abegede-ti-et", "ethiopic-halehame-aa-er", "ethiopic-halehame-aa-et", "ethiopic-halehame-am-et", "ethiopic-halehame-gez", "ethiopic-halehame-om-et", "ethiopic-halehame-sid-et", "ethiopic-halehame-so-et", "ethiopic-halehame-ti-er", "ethiopic-halehame-ti-et", "ethiopic-halehame-tig", "ethiopic-numeric", "ew-resize", "expanded", "extends", "extra-condensed", "extra-expanded", "fantasy", "fast", "fill", "fixed", "flat", "flex", "flex-end", "flex-start", "footnotes", "forwards", "from", "geometricPrecision", "georgian", "graytext", "groove", "gujarati", "gurmukhi", "hand", "hangul", "hangul-consonant", "hebrew", "help", "hidden", "hide", "higher", "highlight", "highlighttext", "hiragana", "hiragana-iroha", "horizontal", "hsl", "hsla", "icon", "ignore", "inactiveborder", "inactivecaption", "inactivecaptiontext", "infinite", "infobackground", "infotext", "inherit", "initial", "inline", "inline-axis", "inline-block", "inline-flex", "inline-table", "inset", "inside", "intrinsic", "invert", "italic", "japanese-formal", "japanese-informal", "justify", "kannada", "katakana", "katakana-iroha", "keep-all", "khmer", "korean-hangul-formal", "korean-hanja-formal", "korean-hanja-informal", "landscape", "lao", "large", "larger", "left", "level", "lighter", "line-through", "linear", "linear-gradient", "lines", "list-item", "listbox", "listitem", "local", "logical", "loud", "lower", "lower-alpha", "lower-armenian", "lower-greek", "lower-hexadecimal", "lower-latin", "lower-norwegian", "lower-roman", "lowercase", "ltr", "malayalam", "match", "matrix", "matrix3d", "media-controls-background", "media-current-time-display", "media-fullscreen-button", "media-mute-button", "media-play-button", "media-return-to-realtime-button", "media-rewind-button", "media-seek-back-button", "media-seek-forward-button", "media-slider", "media-sliderthumb", "media-time-remaining-display", "media-volume-slider", "media-volume-slider-container", "media-volume-sliderthumb", "medium", "menu", "menulist", "menulist-button", "menulist-text", "menulist-textfield", "menutext", "message-box", "middle", "min-intrinsic", "mix", "mongolian", "monospace", "move", "multiple", "myanmar", "n-resize", "narrower", "ne-resize", "nesw-resize", "no-close-quote", "no-drop", "no-open-quote", "no-repeat", "none", "normal", "not-allowed", "nowrap", "ns-resize", "numbers", "numeric", "nw-resize", "nwse-resize", "oblique", "octal", "open-quote", "optimizeLegibility", "optimizeSpeed", "oriya", "oromo", "outset", "outside", "outside-shape", "overlay", "overline", "padding", "padding-box", "painted", "page", "paused", "persian", "perspective", "plus-darker", "plus-lighter", "pointer", "polygon", "portrait", "pre", "pre-line", "pre-wrap", "preserve-3d", "progress", "push-button", "radial-gradient", "radio", "read-only", "read-write", "read-write-plaintext-only", "rectangle", "region", "relative", "repeat", "repeating-linear-gradient", "repeating-radial-gradient", "repeat-x", "repeat-y", "reset", "reverse", "rgb", "rgba", "ridge", "right", "rotate", "rotate3d", "rotateX", "rotateY", "rotateZ", "round", "row", "row-resize", "row-reverse", "rtl", "run-in", "running", "s-resize", "sans-serif", "scale", "scale3d", "scaleX", "scaleY", "scaleZ", "scroll", "scrollbar", "se-resize", "searchfield", "searchfield-cancel-button", "searchfield-decoration", "searchfield-results-button", "searchfield-results-decoration", "semi-condensed", "semi-expanded", "separate", "serif", "show", "sidama", "simp-chinese-formal", "simp-chinese-informal", "single", "skew", "skewX", "skewY", "skip-white-space", "slide", "slider-horizontal", "slider-vertical", "sliderthumb-horizontal", "sliderthumb-vertical", "slow", "small", "small-caps", "small-caption", "smaller", "solid", "somali", "source-atop", "source-in", "source-out", "source-over", "space", "space-around", "space-between", "spell-out", "square", "square-button", "start", "static", "status-bar", "stretch", "stroke", "sub", "subpixel-antialiased", "super", "sw-resize", "symbolic", "symbols", "table", "table-caption", "table-cell", "table-column", "table-column-group", "table-footer-group", "table-header-group", "table-row", "table-row-group", "tamil", "telugu", "text", "text-bottom", "text-top", "textarea", "textfield", "thai", "thick", "thin", "threeddarkshadow", "threedface", "threedhighlight", "threedlightshadow", "threedshadow", "tibetan", "tigre", "tigrinya-er", "tigrinya-er-abegede", "tigrinya-et", "tigrinya-et-abegede", "to", "top", "trad-chinese-formal", "trad-chinese-informal", "translate", "translate3d", "translateX", "translateY", "translateZ", "transparent", "ultra-condensed", "ultra-expanded", "underline", "up", "upper-alpha", "upper-armenian", "upper-greek", "upper-hexadecimal", "upper-latin", "upper-norwegian", "upper-roman", "uppercase", "urdu", "url", "var", "vertical", "vertical-text", "visible", "visibleFill", "visiblePainted", "visibleStroke", "visual", "w-resize", "wait", "wave", "wider", "window", "windowframe", "windowtext", "words", "wrap", "wrap-reverse", "x-large", "x-small", "xor", "xx-large", "xx-small"],
        v = b(u),
        w = c.concat(e).concat(g).concat(i).concat(k).concat(m).concat(s).concat(u);
    a.registerHelper("hintWords", "css", w), a.defineMIME("text/css", {
        documentTypes: d,
        mediaTypes: f,
        mediaFeatures: h,
        mediaValueKeywords: j,
        propertyKeywords: l,
        nonStandardPropertyKeywords: n,
        fontProperties: p,
        counterDescriptors: r,
        colorKeywords: t,
        valueKeywords: v,
        tokenHooks: {
            "/": function(a, b) {
                return a.eat("*") ? (b.tokenize = x, x(a, b)) : !1
            }
        },
        name: "css"
    }), a.defineMIME("text/x-scss", {
        mediaTypes: f,
        mediaFeatures: h,
        mediaValueKeywords: j,
        propertyKeywords: l,
        nonStandardPropertyKeywords: n,
        colorKeywords: t,
        valueKeywords: v,
        fontProperties: p,
        allowNested: !0,
        tokenHooks: {
            "/": function(a, b) {
                return a.eat("/") ? (a.skipToEnd(), ["comment", "comment"]) : a.eat("*") ? (b.tokenize = x, x(a, b)) : ["operator", "operator"]
            },
            ":": function(a) {
                return a.match(/\s*\{/) ? [null, "{"] : !1
            },
            $: function(a) {
                return a.match(/^[\w-]+/), a.match(/^\s*:/, !1) ? ["variable-2", "variable-definition"] : ["variable-2", "variable"]
            },
            "#": function(a) {
                return a.eat("{") ? [null, "interpolation"] : !1
            }
        },
        name: "css",
        helperType: "scss"
    }), a.defineMIME("text/x-less", {
        mediaTypes: f,
        mediaFeatures: h,
        mediaValueKeywords: j,
        propertyKeywords: l,
        nonStandardPropertyKeywords: n,
        colorKeywords: t,
        valueKeywords: v,
        fontProperties: p,
        allowNested: !0,
        tokenHooks: {
            "/": function(a, b) {
                return a.eat("/") ? (a.skipToEnd(), ["comment", "comment"]) : a.eat("*") ? (b.tokenize = x, x(a, b)) : ["operator", "operator"]
            },
            "@": function(a) {
                return a.eat("{") ? [null, "interpolation"] : a.match(/^(charset|document|font-face|import|(-(moz|ms|o|webkit)-)?keyframes|media|namespace|page|supports)\b/, !1) ? !1 : (a.eatWhile(/[\w\\\-]/), a.match(/^\s*:/, !1) ? ["variable-2", "variable-definition"] : ["variable-2", "variable"])
            },
            "&": function() {
                return ["atom", "atom"]
            }
        },
        name: "css",
        helperType: "less"
    }), a.defineMIME("text/x-gss", {
        documentTypes: d,
        mediaTypes: f,
        mediaFeatures: h,
        propertyKeywords: l,
        nonStandardPropertyKeywords: n,
        fontProperties: p,
        counterDescriptors: r,
        colorKeywords: t,
        valueKeywords: v,
        supportsAtComponent: !0,
        tokenHooks: {
            "/": function(a, b) {
                return a.eat("*") ? (b.tokenize = x, x(a, b)) : !1
            }
        },
        name: "css",
        helperType: "gss"
    })
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../xml/xml"), require("../javascript/javascript"), require("../css/css")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../xml/xml", "../javascript/javascript", "../css/css"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function c(a, b, c) {
        var d = a.current(),
            e = d.search(b);
        return e > -1 ? a.backUp(d.length - e) : d.match(/<\/?$/) && (a.backUp(d.length), a.match(b, !1) || a.match(d)), c
    }

    function e(a) {
        var b = d[a];
        return b ? b : d[a] = new RegExp("\\s+" + a + "\\s*=\\s*('|\")?([^'\"]+)('|\")?\\s*");
    }

    function f(a, b) {
        for (var d, c = a.pos; c >= 0 && "<" !== a.string.charAt(c);) c--;
        return 0 > c ? c : (d = a.string.slice(c, a.pos).match(e(b))) ? d[2] : ""
    }

    function g(a, b) {
        return new RegExp((b ? "^" : "") + "</s*" + a + "s*>", "i")
    }

    function h(a, b) {
        for (var c in a)
            for (var d = b[c] || (b[c] = []), e = a[c], f = e.length - 1; f >= 0; f--) d.unshift(e[f])
    }

    function i(a, b) {
        for (var c = 0; c < a.length; c++) {
            var d = a[c];
            if (!d[0] || d[1].test(f(b, d[0]))) return d[2]
        }
    }
    var b = {
            script: [
                ["lang", /(javascript|babel)/i, "javascript"],
                ["type", /^(?:text|application)\/(?:x-)?(?:java|ecma)script$|^$/i, "javascript"],
                ["type", /./, "text/plain"],
                [null, null, "javascript"]
            ],
            style: [
                ["lang", /^css$/i, "css"],
                ["type", /^(text\/)?(x-)?(stylesheet|css)$/i, "css"],
                ["type", /./, "text/plain"],
                [null, null, "css"]
            ]
        },
        d = {};
    a.defineMode("htmlmixed", function(d, e) {
        function n(b, e) {
            var m, h = e.htmlState.tagName,
                k = h && j[h.toLowerCase()],
                l = f.token(b, e.htmlState);
            if (k && /\btag\b/.test(l) && ">" === b.current() && (m = i(k, b))) {
                var o = a.getMode(d, m),
                    p = g(h, !0),
                    q = g(h, !1);
                e.token = function(a, b) {
                    return a.match(p, !1) ? (b.token = n, b.localState = b.localMode = null, null) : c(a, q, b.localMode.token(a, b.localState))
                }, e.localMode = o, e.localState = a.startState(o, f.indent(e.htmlState, ""))
            }
            return l
        }
        var f = a.getMode(d, {
                name: "xml",
                htmlMode: !0,
                multilineTagIndentFactor: e.multilineTagIndentFactor,
                multilineTagIndentPastTag: e.multilineTagIndentPastTag
            }),
            j = {},
            k = e && e.tags,
            l = e && e.scriptTypes;
        if (h(b, j), k && h(k, j), l)
            for (var m = l.length - 1; m >= 0; m--) j.script.unshift(["type", l[m].matches, l[m].mode]);
        return {
            startState: function() {
                var a = f.startState();
                return {
                    token: n,
                    localMode: null,
                    localState: null,
                    htmlState: a
                }
            },
            copyState: function(b) {
                var c;
                return b.localState && (c = a.copyState(b.localMode, b.localState)), {
                    token: b.token,
                    localMode: b.localMode,
                    localState: c,
                    htmlState: a.copyState(f, b.htmlState)
                }
            },
            token: function(a, b) {
                return b.token(a, b)
            },
            indent: function(b, c) {
                return !b.localMode || /^\s*<\//.test(c) ? f.indent(b.htmlState, c) : b.localMode.indent ? b.localMode.indent(b.localState, c) : a.Pass
            },
            innerMode: function(a) {
                return {
                    state: a.localState || a.htmlState,
                    mode: a.localMode || f
                }
            }
        }
    }, "xml", "javascript", "css"), a.defineMIME("text/html", "htmlmixed")
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../htmlmixed/htmlmixed"), require("../clike/clike")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../htmlmixed/htmlmixed", "../clike/clike"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function b(a) {
        for (var b = {}, c = a.split(" "), d = 0; d < c.length; ++d) b[c[d]] = !0;
        return b
    }

    function c(a, b, e) {
        return 0 == a.length ? d(b) : function(f, g) {
            for (var h = a[0], i = 0; i < h.length; i++)
                if (f.match(h[i][0])) return g.tokenize = c(a.slice(1), b), h[i][1];
            return g.tokenize = d(b, e), "string"
        }
    }

    function d(a, b) {
        return function(c, d) {
            return e(c, d, a, b)
        }
    }

    function e(a, b, d, e) {
        if (e !== !1 && a.match("${", !1) || a.match("{$", !1)) return b.tokenize = null, "string";
        if (e !== !1 && a.match(/^\$[a-zA-Z_][a-zA-Z0-9_]*/)) return a.match("[", !1) && (b.tokenize = c([
            [
                ["[", null]
            ],
            [
                [/\d[\w\.]*/, "number"],
                [/\$[a-zA-Z_][a-zA-Z0-9_]*/, "variable-2"],
                [/[\w\$]+/, "variable"]
            ],
            [
                ["]", null]
            ]
        ], d, e)), a.match(/\-\>\w/, !1) && (b.tokenize = c([
            [
                ["->", null]
            ],
            [
                [/[\w]+/, "variable"]
            ]
        ], d, e)), "variable-2";
        for (var f = !1; !a.eol() && (f || e === !1 || !a.match("{$", !1) && !a.match(/^(\$[a-zA-Z_][a-zA-Z0-9_]*|\$\{)/, !1));) {
            if (!f && a.match(d)) {
                b.tokenize = null, b.tokStack.pop(), b.tokStack.pop();
                break
            }
            f = "\\" == a.next() && !f
        }
        return "string"
    }
    var f = "abstract and array as break case catch class clone const continue declare default do else elseif enddeclare endfor endforeach endif endswitch endwhile extends final for foreach function global goto if implements interface instanceof namespace new or private protected public static switch throw trait try use var while xor die echo empty exit eval include include_once isset list require require_once return print unset __halt_compiler self static parent yield insteadof finally",
        g = "true false null TRUE FALSE NULL __CLASS__ __DIR__ __FILE__ __LINE__ __METHOD__ __FUNCTION__ __NAMESPACE__ __TRAIT__",
        h = "func_num_args func_get_arg func_get_args strlen strcmp strncmp strcasecmp strncasecmp each error_reporting define defined trigger_error user_error set_error_handler restore_error_handler get_declared_classes get_loaded_extensions extension_loaded get_extension_funcs debug_backtrace constant bin2hex hex2bin sleep usleep time mktime gmmktime strftime gmstrftime strtotime date gmdate getdate localtime checkdate flush wordwrap htmlspecialchars htmlentities html_entity_decode md5 md5_file crc32 getimagesize image_type_to_mime_type phpinfo phpversion phpcredits strnatcmp strnatcasecmp substr_count strspn strcspn strtok strtoupper strtolower strpos strrpos strrev hebrev hebrevc nl2br basename dirname pathinfo stripslashes stripcslashes strstr stristr strrchr str_shuffle str_word_count strcoll substr substr_replace quotemeta ucfirst ucwords strtr addslashes addcslashes rtrim str_replace str_repeat count_chars chunk_split trim ltrim strip_tags similar_text explode implode setlocale localeconv parse_str str_pad chop strchr sprintf printf vprintf vsprintf sscanf fscanf parse_url urlencode urldecode rawurlencode rawurldecode readlink linkinfo link unlink exec system escapeshellcmd escapeshellarg passthru shell_exec proc_open proc_close rand srand getrandmax mt_rand mt_srand mt_getrandmax base64_decode base64_encode abs ceil floor round is_finite is_nan is_infinite bindec hexdec octdec decbin decoct dechex base_convert number_format fmod ip2long long2ip getenv putenv getopt microtime gettimeofday getrusage uniqid quoted_printable_decode set_time_limit get_cfg_var magic_quotes_runtime set_magic_quotes_runtime get_magic_quotes_gpc get_magic_quotes_runtime import_request_variables error_log serialize unserialize memory_get_usage var_dump var_export debug_zval_dump print_r highlight_file show_source highlight_string ini_get ini_get_all ini_set ini_alter ini_restore get_include_path set_include_path restore_include_path setcookie header headers_sent connection_aborted connection_status ignore_user_abort parse_ini_file is_uploaded_file move_uploaded_file intval floatval doubleval strval gettype settype is_null is_resource is_bool is_long is_float is_int is_integer is_double is_real is_numeric is_string is_array is_object is_scalar ereg ereg_replace eregi eregi_replace split spliti join sql_regcase dl pclose popen readfile rewind rmdir umask fclose feof fgetc fgets fgetss fread fopen fpassthru ftruncate fstat fseek ftell fflush fwrite fputs mkdir rename copy tempnam tmpfile file file_get_contents stream_select stream_context_create stream_context_set_params stream_context_set_option stream_context_get_options stream_filter_prepend stream_filter_append fgetcsv flock get_meta_tags stream_set_write_buffer set_file_buffer set_socket_blocking stream_set_blocking socket_set_blocking stream_get_meta_data stream_register_wrapper stream_wrapper_register stream_set_timeout socket_set_timeout socket_get_status realpath fnmatch fsockopen pfsockopen pack unpack get_browser crypt opendir closedir chdir getcwd rewinddir readdir dir glob fileatime filectime filegroup fileinode filemtime fileowner fileperms filesize filetype file_exists is_writable is_writeable is_readable is_executable is_file is_dir is_link stat lstat chown touch clearstatcache mail ob_start ob_flush ob_clean ob_end_flush ob_end_clean ob_get_flush ob_get_clean ob_get_length ob_get_level ob_get_status ob_get_contents ob_implicit_flush ob_list_handlers ksort krsort natsort natcasesort asort arsort sort rsort usort uasort uksort shuffle array_walk count end prev next reset current key min max in_array array_search extract compact array_fill range array_multisort array_push array_pop array_shift array_unshift array_splice array_slice array_merge array_merge_recursive array_keys array_values array_count_values array_reverse array_reduce array_pad array_flip array_change_key_case array_rand array_unique array_intersect array_intersect_assoc array_diff array_diff_assoc array_sum array_filter array_map array_chunk array_key_exists pos sizeof key_exists assert assert_options version_compare ftok str_rot13 aggregate session_name session_module_name session_save_path session_id session_regenerate_id session_decode session_register session_unregister session_is_registered session_encode session_start session_destroy session_unset session_set_save_handler session_cache_limiter session_cache_expire session_set_cookie_params session_get_cookie_params session_write_close preg_match preg_match_all preg_replace preg_replace_callback preg_split preg_quote preg_grep overload ctype_alnum ctype_alpha ctype_cntrl ctype_digit ctype_lower ctype_graph ctype_print ctype_punct ctype_space ctype_upper ctype_xdigit virtual apache_request_headers apache_note apache_lookup_uri apache_child_terminate apache_setenv apache_response_headers apache_get_version getallheaders mysql_connect mysql_pconnect mysql_close mysql_select_db mysql_create_db mysql_drop_db mysql_query mysql_unbuffered_query mysql_db_query mysql_list_dbs mysql_list_tables mysql_list_fields mysql_list_processes mysql_error mysql_errno mysql_affected_rows mysql_insert_id mysql_result mysql_num_rows mysql_num_fields mysql_fetch_row mysql_fetch_array mysql_fetch_assoc mysql_fetch_object mysql_data_seek mysql_fetch_lengths mysql_fetch_field mysql_field_seek mysql_free_result mysql_field_name mysql_field_table mysql_field_len mysql_field_type mysql_field_flags mysql_escape_string mysql_real_escape_string mysql_stat mysql_thread_id mysql_client_encoding mysql_get_client_info mysql_get_host_info mysql_get_proto_info mysql_get_server_info mysql_info mysql mysql_fieldname mysql_fieldtable mysql_fieldlen mysql_fieldtype mysql_fieldflags mysql_selectdb mysql_createdb mysql_dropdb mysql_freeresult mysql_numfields mysql_numrows mysql_listdbs mysql_listtables mysql_listfields mysql_db_name mysql_dbname mysql_tablename mysql_table_name pg_connect pg_pconnect pg_close pg_connection_status pg_connection_busy pg_connection_reset pg_host pg_dbname pg_port pg_tty pg_options pg_ping pg_query pg_send_query pg_cancel_query pg_fetch_result pg_fetch_row pg_fetch_assoc pg_fetch_array pg_fetch_object pg_fetch_all pg_affected_rows pg_get_result pg_result_seek pg_result_status pg_free_result pg_last_oid pg_num_rows pg_num_fields pg_field_name pg_field_num pg_field_size pg_field_type pg_field_prtlen pg_field_is_null pg_get_notify pg_get_pid pg_result_error pg_last_error pg_last_notice pg_put_line pg_end_copy pg_copy_to pg_copy_from pg_trace pg_untrace pg_lo_create pg_lo_unlink pg_lo_open pg_lo_close pg_lo_read pg_lo_write pg_lo_read_all pg_lo_import pg_lo_export pg_lo_seek pg_lo_tell pg_escape_string pg_escape_bytea pg_unescape_bytea pg_client_encoding pg_set_client_encoding pg_meta_data pg_convert pg_insert pg_update pg_delete pg_select pg_exec pg_getlastoid pg_cmdtuples pg_errormessage pg_numrows pg_numfields pg_fieldname pg_fieldsize pg_fieldtype pg_fieldnum pg_fieldprtlen pg_fieldisnull pg_freeresult pg_result pg_loreadall pg_locreate pg_lounlink pg_loopen pg_loclose pg_loread pg_lowrite pg_loimport pg_loexport http_response_code get_declared_traits getimagesizefromstring socket_import_stream stream_set_chunk_size trait_exists header_register_callback class_uses session_status session_register_shutdown echo print global static exit array empty eval isset unset die include require include_once require_once json_decode json_encode json_last_error json_last_error_msg curl_close curl_copy_handle curl_errno curl_error curl_escape curl_exec curl_file_create curl_getinfo curl_init curl_multi_add_handle curl_multi_close curl_multi_exec curl_multi_getcontent curl_multi_info_read curl_multi_init curl_multi_remove_handle curl_multi_select curl_multi_setopt curl_multi_strerror curl_pause curl_reset curl_setopt_array curl_setopt curl_share_close curl_share_init curl_share_setopt curl_strerror curl_unescape curl_version mysqli_affected_rows mysqli_autocommit mysqli_change_user mysqli_character_set_name mysqli_close mysqli_commit mysqli_connect_errno mysqli_connect_error mysqli_connect mysqli_data_seek mysqli_debug mysqli_dump_debug_info mysqli_errno mysqli_error_list mysqli_error mysqli_fetch_all mysqli_fetch_array mysqli_fetch_assoc mysqli_fetch_field_direct mysqli_fetch_field mysqli_fetch_fields mysqli_fetch_lengths mysqli_fetch_object mysqli_fetch_row mysqli_field_count mysqli_field_seek mysqli_field_tell mysqli_free_result mysqli_get_charset mysqli_get_client_info mysqli_get_client_stats mysqli_get_client_version mysqli_get_connection_stats mysqli_get_host_info mysqli_get_proto_info mysqli_get_server_info mysqli_get_server_version mysqli_info mysqli_init mysqli_insert_id mysqli_kill mysqli_more_results mysqli_multi_query mysqli_next_result mysqli_num_fields mysqli_num_rows mysqli_options mysqli_ping mysqli_prepare mysqli_query mysqli_real_connect mysqli_real_escape_string mysqli_real_query mysqli_reap_async_query mysqli_refresh mysqli_rollback mysqli_select_db mysqli_set_charset mysqli_set_local_infile_default mysqli_set_local_infile_handler mysqli_sqlstate mysqli_ssl_set mysqli_stat mysqli_stmt_init mysqli_store_result mysqli_thread_id mysqli_thread_safe mysqli_use_result mysqli_warning_count";
    a.registerHelper("hintWords", "php", [f, g, h].join(" ").split(" ")), a.registerHelper("wordChars", "php", /[\w$]/);
    var i = {
        name: "clike",
        helperType: "php",
        keywords: b(f),
        blockKeywords: b("catch do else elseif for foreach if switch try while finally"),
        defKeywords: b("class function interface namespace trait"),
        atoms: b(g),
        builtin: b(h),
        multiLineStrings: !0,
        hooks: {
            $: function(a) {
                return a.eatWhile(/[\w\$_]/), "variable-2"
            },
            "<": function(a, b) {
                var c;
                if (c = a.match(/<<\s*/)) {
                    var e = a.eat(/['"]/);
                    a.eatWhile(/[\w\.]/);
                    var f = a.current().slice(c[0].length + (e ? 2 : 1));
                    if (e && a.eat(e), f) return (b.tokStack || (b.tokStack = [])).push(f, 0), b.tokenize = d(f, "'" != e), "string"
                }
                return !1
            },
            "#": function(a) {
                for (; !a.eol() && !a.match("?>", !1);) a.next();
                return "comment"
            },
            "/": function(a) {
                if (a.eat("/")) {
                    for (; !a.eol() && !a.match("?>", !1);) a.next();
                    return "comment"
                }
                return !1
            },
            '"': function(a, b) {
                return (b.tokStack || (b.tokStack = [])).push('"', 0), b.tokenize = d('"'), "string"
            },
            "{": function(a, b) {
                return b.tokStack && b.tokStack.length && b.tokStack[b.tokStack.length - 1]++, !1
            },
            "}": function(a, b) {
                return b.tokStack && b.tokStack.length > 0 && !--b.tokStack[b.tokStack.length - 1] && (b.tokenize = d(b.tokStack[b.tokStack.length - 2])), !1
            }
        }
    };
    a.defineMode("php", function(b, c) {
        function f(b, c) {
            var f = c.curMode == e;
            if (b.sol() && c.pending && '"' != c.pending && "'" != c.pending && (c.pending = null), f) return f && null == c.php.tokenize && b.match("?>") ? (c.curMode = d, c.curState = c.html, c.php.context.prev || (c.php = null), "meta") : e.token(b, c.curState);
            if (b.match(/^<\?\w*/)) return c.curMode = e, c.php || (c.php = a.startState(e, d.indent(c.html, ""))), c.curState = c.php, "meta";
            if ('"' == c.pending || "'" == c.pending) {
                for (; !b.eol() && b.next() != c.pending;);
                var g = "string"
            } else if (c.pending && b.pos < c.pending.end) {
                b.pos = c.pending.end;
                var g = c.pending.style
            } else var g = d.token(b, c.curState);
            c.pending && (c.pending = null);
            var j, h = b.current(),
                i = h.search(/<\?/);
            return -1 != i && ("string" == g && (j = h.match(/[\'\"]$/)) && !/\?>/.test(h) ? c.pending = j[0] : c.pending = {
                end: b.pos,
                style: g
            }, b.backUp(h.length - i)), g
        }
        var d = a.getMode(b, "text/html"),
            e = a.getMode(b, i);
        return {
            startState: function() {
                var b = a.startState(d),
                    f = c.startOpen ? a.startState(e) : null;
                return {
                    html: b,
                    php: f,
                    curMode: c.startOpen ? e : d,
                    curState: c.startOpen ? f : b,
                    pending: null
                }
            },
            copyState: function(b) {
                var i, c = b.html,
                    f = a.copyState(d, c),
                    g = b.php,
                    h = g && a.copyState(e, g);
                return i = b.curMode == d ? f : h, {
                    html: f,
                    php: h,
                    curMode: b.curMode,
                    curState: i,
                    pending: b.pending
                }
            },
            token: f,
            indent: function(a, b) {
                return a.curMode != e && /^\s*<\//.test(b) || a.curMode == e && /^\?>/.test(b) ? d.indent(a.html, b) : a.curMode.indent(a.curState, b)
            },
            blockCommentStart: "/*",
            blockCommentEnd: "*/",
            lineComment: "//",
            innerMode: function(a) {
                return {
                    state: a.curState,
                    mode: a.curMode
                }
            }
        }
    }, "htmlmixed", "clike"), a.defineMIME("application/x-httpd-php", "php"), a.defineMIME("application/x-httpd-php-open", {
        name: "php",
        startOpen: !0
    }), a.defineMIME("text/x-php", i)
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    "use strict";
    a.defineMode("xml", function(b, c) {
        function k(a, b) {
            function c(c) {
                return b.tokenize = c, c(a, b)
            }
            var d = a.next();
            if ("<" == d) return a.eat("!") ? a.eat("[") ? a.match("CDATA[") ? c(n("atom", "]]>")) : null : a.match("--") ? c(n("comment", "-->")) : a.match("DOCTYPE", !0, !0) ? (a.eatWhile(/[\w\._\-]/), c(o(1))) : null : a.eat("?") ? (a.eatWhile(/[\w\._\-]/), b.tokenize = n("meta", "?>"), "meta") : (i = a.eat("/") ? "closeTag" : "openTag", b.tokenize = l, "tag bracket");
            if ("&" == d) {
                var e;
                return e = a.eat("#") ? a.eat("x") ? a.eatWhile(/[a-fA-F\d]/) && a.eat(";") : a.eatWhile(/[\d]/) && a.eat(";") : a.eatWhile(/[\w\.\-:]/) && a.eat(";"), e ? "atom" : "error"
            }
            return a.eatWhile(/[^&<]/), null
        }

        function l(a, b) {
            var c = a.next();
            if (">" == c || "/" == c && a.eat(">")) return b.tokenize = k, i = ">" == c ? "endTag" : "selfcloseTag", "tag bracket";
            if ("=" == c) return i = "equals", null;
            if ("<" == c) {
                b.tokenize = k, b.state = s, b.tagName = b.tagStart = null;
                var d = b.tokenize(a, b);
                return d ? d + " tag error" : "tag error"
            }
            return /[\'\"]/.test(c) ? (b.tokenize = m(c), b.stringStartCol = a.column(), b.tokenize(a, b)) : (a.match(/^[^\s\u00a0=<>\"\']*[^\s\u00a0=<>\"\'\/]/), "word")
        }

        function m(a) {
            var b = function(b, c) {
                for (; !b.eol();)
                    if (b.next() == a) {
                        c.tokenize = l;
                        break
                    }
                return "string"
            };
            return b.isInAttribute = !0, b
        }

        function n(a, b) {
            return function(c, d) {
                for (; !c.eol();) {
                    if (c.match(b)) {
                        d.tokenize = k;
                        break
                    }
                    c.next()
                }
                return a
            }
        }

        function o(a) {
            return function(b, c) {
                for (var d; null != (d = b.next());) {
                    if ("<" == d) return c.tokenize = o(a + 1), c.tokenize(b, c);
                    if (">" == d) {
                        if (1 == a) {
                            c.tokenize = k;
                            break
                        }
                        return c.tokenize = o(a - 1), c.tokenize(b, c)
                    }
                }
                return "meta"
            }
        }

        function p(a, b, c) {
            this.prev = a.context, this.tagName = b, this.indent = a.indented, this.startOfLine = c, (g.doNotIndent.hasOwnProperty(b) || a.context && a.context.noIndent) && (this.noIndent = !0)
        }

        function q(a) {
            a.context && (a.context = a.context.prev)
        }

        function r(a, b) {
            for (var c;;) {
                if (!a.context) return;
                if (c = a.context.tagName, !g.contextGrabbers.hasOwnProperty(c) || !g.contextGrabbers[c].hasOwnProperty(b)) return;
                q(a)
            }
        }

        function s(a, b, c) {
            return "openTag" == a ? (c.tagStart = b.column(), t) : "closeTag" == a ? u : s
        }

        function t(a, b, c) {
            return "word" == a ? (c.tagName = b.current(), j = "tag", x) : (j = "error", t)
        }

        function u(a, b, c) {
            if ("word" == a) {
                var d = b.current();
                return c.context && c.context.tagName != d && g.implicitlyClosed.hasOwnProperty(c.context.tagName) && q(c), c.context && c.context.tagName == d ? (j = "tag", v) : (j = "tag error", w)
            }
            return j = "error", w
        }

        function v(a, b, c) {
            return "endTag" != a ? (j = "error", v) : (q(c), s)
        }

        function w(a, b, c) {
            return j = "error", v(a, b, c)
        }

        function x(a, b, c) {
            if ("word" == a) return j = "attribute", y;
            if ("endTag" == a || "selfcloseTag" == a) {
                var d = c.tagName,
                    e = c.tagStart;
                return c.tagName = c.tagStart = null, "selfcloseTag" == a || g.autoSelfClosers.hasOwnProperty(d) ? r(c, d) : (r(c, d), c.context = new p(c, d, e == c.indented)), s
            }
            return j = "error", x
        }

        function y(a, b, c) {
            return "equals" == a ? z : (g.allowMissing || (j = "error"), x(a, b, c))
        }

        function z(a, b, c) {
            return "string" == a ? A : "word" == a && g.allowUnquoted ? (j = "string", x) : (j = "error", x(a, b, c))
        }

        function A(a, b, c) {
            return "string" == a ? A : x(a, b, c)
        }
        var d = b.indentUnit,
            e = c.multilineTagIndentFactor || 1,
            f = c.multilineTagIndentPastTag;
        null == f && (f = !0);
        var i, j, g = c.htmlMode ? {
                autoSelfClosers: {
                    area: !0,
                    base: !0,
                    br: !0,
                    col: !0,
                    command: !0,
                    embed: !0,
                    frame: !0,
                    hr: !0,
                    img: !0,
                    input: !0,
                    keygen: !0,
                    link: !0,
                    meta: !0,
                    param: !0,
                    source: !0,
                    track: !0,
                    wbr: !0,
                    menuitem: !0
                },
                implicitlyClosed: {
                    dd: !0,
                    li: !0,
                    optgroup: !0,
                    option: !0,
                    p: !0,
                    rp: !0,
                    rt: !0,
                    tbody: !0,
                    td: !0,
                    tfoot: !0,
                    th: !0,
                    tr: !0
                },
                contextGrabbers: {
                    dd: {
                        dd: !0,
                        dt: !0
                    },
                    dt: {
                        dd: !0,
                        dt: !0
                    },
                    li: {
                        li: !0
                    },
                    option: {
                        option: !0,
                        optgroup: !0
                    },
                    optgroup: {
                        optgroup: !0
                    },
                    p: {
                        address: !0,
                        article: !0,
                        aside: !0,
                        blockquote: !0,
                        dir: !0,
                        div: !0,
                        dl: !0,
                        fieldset: !0,
                        footer: !0,
                        form: !0,
                        h1: !0,
                        h2: !0,
                        h3: !0,
                        h4: !0,
                        h5: !0,
                        h6: !0,
                        header: !0,
                        hgroup: !0,
                        hr: !0,
                        menu: !0,
                        nav: !0,
                        ol: !0,
                        p: !0,
                        pre: !0,
                        section: !0,
                        table: !0,
                        ul: !0
                    },
                    rp: {
                        rp: !0,
                        rt: !0
                    },
                    rt: {
                        rp: !0,
                        rt: !0
                    },
                    tbody: {
                        tbody: !0,
                        tfoot: !0
                    },
                    td: {
                        td: !0,
                        th: !0
                    },
                    tfoot: {
                        tbody: !0
                    },
                    th: {
                        td: !0,
                        th: !0
                    },
                    thead: {
                        tbody: !0,
                        tfoot: !0
                    },
                    tr: {
                        tr: !0
                    }
                },
                doNotIndent: {
                    pre: !0
                },
                allowUnquoted: !0,
                allowMissing: !0,
                caseFold: !0
            } : {
                autoSelfClosers: {},
                implicitlyClosed: {},
                contextGrabbers: {},
                doNotIndent: {},
                allowUnquoted: !1,
                allowMissing: !1,
                caseFold: !1
            },
            h = c.alignCDATA;
        return k.isInText = !0, {
            startState: function() {
                return {
                    tokenize: k,
                    state: s,
                    indented: 0,
                    tagName: null,
                    tagStart: null,
                    context: null
                }
            },
            token: function(a, b) {
                if (!b.tagName && a.sol() && (b.indented = a.indentation()), a.eatSpace()) return null;
                i = null;
                var c = b.tokenize(a, b);
                return (c || i) && "comment" != c && (j = null, b.state = b.state(i || c, a, b), j && (c = "error" == j ? c + " error" : j)), c
            },
            indent: function(b, c, i) {
                var j = b.context;
                if (b.tokenize.isInAttribute) return b.tagStart == b.indented ? b.stringStartCol + 1 : b.indented + d;
                if (j && j.noIndent) return a.Pass;
                if (b.tokenize != l && b.tokenize != k) return i ? i.match(/^(\s*)/)[0].length : 0;
                if (b.tagName) return f ? b.tagStart + b.tagName.length + 2 : b.tagStart + d * e;
                if (h && /<!\[CDATA\[/.test(c)) return 0;
                var m = c && /^<(\/)?([\w_:\.-]*)/.exec(c);
                if (m && m[1])
                    for (; j;) {
                        if (j.tagName == m[2]) {
                            j = j.prev;
                            break
                        }
                        if (!g.implicitlyClosed.hasOwnProperty(j.tagName)) break;
                        j = j.prev
                    } else if (m)
                        for (; j;) {
                            var n = g.contextGrabbers[j.tagName];
                            if (!n || !n.hasOwnProperty(m[2])) break;
                            j = j.prev
                        }
                for (; j && !j.startOfLine;) j = j.prev;
                return j ? j.indent + d : 0
            },
            electricInput: /<\/[\s\w:]+>$/,
            blockCommentStart: "<!--",
            blockCommentEnd: "-->",
            configuration: c.htmlMode ? "html" : "xml",
            helperType: c.htmlMode ? "html" : "xml"
        }
    }), a.defineMIME("text/xml", "xml"), a.defineMIME("application/xml", "xml"), a.mimeModes.hasOwnProperty("text/html") || a.defineMIME("text/html", {
        name: "xml",
        htmlMode: !0
    })
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function d(a) {
        for (var d = 0; d < a.state.activeLines.length; d++) a.removeLineClass(a.state.activeLines[d], "wrap", b), a.removeLineClass(a.state.activeLines[d], "background", c)
    }

    function e(a, b) {
        if (a.length != b.length) return !1;
        for (var c = 0; c < a.length; c++)
            if (a[c] != b[c]) return !1;
        return !0
    }

    function f(a, f) {
        for (var g = [], h = 0; h < f.length; h++) {
            var i = f[h];
            if (i.empty()) {
                var j = a.getLineHandleVisualStart(i.head.line);
                g[g.length - 1] != j && g.push(j)
            }
        }
        e(a.state.activeLines, g) || a.operation(function() {
            d(a);
            for (var e = 0; e < g.length; e++) a.addLineClass(g[e], "wrap", b), a.addLineClass(g[e], "background", c);
            a.state.activeLines = g
        })
    }

    function g(a, b) {
        f(a, b.ranges)
    }
    var b = "CodeMirror-activeline",
        c = "CodeMirror-activeline-background";
    a.defineOption("styleActiveLine", !1, function(b, c, e) {
        var h = e && e != a.Init;
        c && !h ? (b.state.activeLines = [], f(b, b.listSelections()), b.on("beforeSelectionChange", g)) : !c && h && (b.off("beforeSelectionChange", g), d(b), delete b.state.activeLines)
    })
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    function e(a, b, e, g) {
        var h = a.getLineHandle(b.line),
            i = b.ch - 1,
            j = i >= 0 && d[h.text.charAt(i)] || d[h.text.charAt(++i)];
        if (!j) return null;
        var k = ">" == j.charAt(1) ? 1 : -1;
        if (e && k > 0 != (i == b.ch)) return null;
        var l = a.getTokenTypeAt(c(b.line, i + 1)),
            m = f(a, c(b.line, i + (k > 0 ? 1 : 0)), k, l || null, g);
        return null == m ? null : {
            from: c(b.line, i),
            to: m && m.pos,
            match: m && m.ch == j.charAt(0),
            forward: k > 0
        }
    }

    function f(a, b, e, f, g) {
        for (var h = g && g.maxScanLineLength || 1e4, i = g && g.maxScanLines || 1e3, j = [], k = g && g.bracketRegex ? g.bracketRegex : /[(){}[\]]/, l = e > 0 ? Math.min(b.line + i, a.lastLine() + 1) : Math.max(a.firstLine() - 1, b.line - i), m = b.line; m != l; m += e) {
            var n = a.getLine(m);
            if (n) {
                var o = e > 0 ? 0 : n.length - 1,
                    p = e > 0 ? n.length : -1;
                if (!(n.length > h))
                    for (m == b.line && (o = b.ch - (0 > e ? 1 : 0)); o != p; o += e) {
                        var q = n.charAt(o);
                        if (k.test(q) && (void 0 === f || a.getTokenTypeAt(c(m, o + 1)) == f)) {
                            var r = d[q];
                            if (">" == r.charAt(1) == e > 0) j.push(q);
                            else {
                                if (!j.length) return {
                                    pos: c(m, o),
                                    ch: q
                                };
                                j.pop()
                            }
                        }
                    }
            }
        }
        return m - e == (e > 0 ? a.lastLine() : a.firstLine()) ? !1 : null
    }

    function g(a, d, f) {
        for (var g = a.state.matchBrackets.maxHighlightLineLength || 1e3, h = [], i = a.listSelections(), j = 0; j < i.length; j++) {
            var k = i[j].empty() && e(a, i[j].head, !1, f);
            if (k && a.getLine(k.from.line).length <= g) {
                var l = k.match ? "CodeMirror-matchingbracket" : "CodeMirror-nonmatchingbracket";
                h.push(a.markText(k.from, c(k.from.line, k.from.ch + 1), {
                    className: l
                })), k.to && a.getLine(k.to.line).length <= g && h.push(a.markText(k.to, c(k.to.line, k.to.ch + 1), {
                    className: l
                }))
            }
        }
        if (h.length) {
            b && a.state.focused && a.focus();
            var m = function() {
                a.operation(function() {
                    for (var a = 0; a < h.length; a++) h[a].clear()
                })
            };
            if (!d) return m;
            setTimeout(m, 800)
        }
    }

    function i(a) {
        a.operation(function() {
            h && (h(), h = null), h = g(a, !1, a.state.matchBrackets)
        })
    }
    var b = /MSIE \d/.test(navigator.userAgent) && (null == document.documentMode || document.documentMode < 8),
        c = a.Pos,
        d = {
            "(": ")>",
            ")": "(<",
            "[": "]>",
            "]": "[<",
            "{": "}>",
            "}": "{<"
        },
        h = null;
    a.defineOption("matchBrackets", !1, function(b, c, d) {
        d && d != a.Init && b.off("cursorActivity", i), c && (b.state.matchBrackets = "object" == typeof c ? c : {}, b.on("cursorActivity", i))
    }), a.defineExtension("matchBrackets", function() {
        g(this, !0)
    }), a.defineExtension("findMatchingBracket", function(a, b, c) {
        return e(this, a, b, c)
    }), a.defineExtension("scanForBracket", function(a, b, c, d) {
        return f(this, a, b, c, d)
    })
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror"), require("../fold/xml-fold")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror", "../fold/xml-fold"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function b(a) {
        a.state.tagHit && a.state.tagHit.clear(), a.state.tagOther && a.state.tagOther.clear(), a.state.tagHit = a.state.tagOther = null
    }

    function c(c) {
        c.state.failedTagMatch = !1, c.operation(function() {
            if (b(c), !c.somethingSelected()) {
                var d = c.getCursor(),
                    e = c.getViewport();
                e.from = Math.min(e.from, d.line), e.to = Math.max(d.line + 1, e.to);
                var f = a.findMatchingTag(c, d, e);
                if (f) {
                    if (c.state.matchBothTags) {
                        var g = "open" == f.at ? f.open : f.close;
                        g && (c.state.tagHit = c.markText(g.from, g.to, {
                            className: "CodeMirror-matchingtag"
                        }))
                    }
                    var h = "close" == f.at ? f.open : f.close;
                    h ? c.state.tagOther = c.markText(h.from, h.to, {
                        className: "CodeMirror-matchingtag"
                    }) : c.state.failedTagMatch = !0
                }
            }
        })
    }

    function d(a) {
        a.state.failedTagMatch && c(a)
    }
    a.defineOption("matchTags", !1, function(e, f, g) {
        g && g != a.Init && (e.off("cursorActivity", c), e.off("viewportChange", d), b(e)), f && (e.state.matchBothTags = "object" == typeof f && f.bothTags, e.on("cursorActivity", c), e.on("viewportChange", d), c(e))
    }), a.commands.toMatchingTag = function(b) {
        var c = a.findMatchingTag(b, b.getCursor());
        if (c) {
            var d = "close" == c.at ? c.open : c.close;
            d && b.extendSelection(d.to, d.from)
        }
    }
}),
function(a) {
    "object" == typeof exports && "object" == typeof module ? a(require("../../lib/codemirror")) : "function" == typeof define && define.amd ? define(["../../lib/codemirror"], a) : a(CodeMirror)
}(function(a) {
    "use strict";

    function c(a, b) {
        return a.line - b.line || a.ch - b.ch
    }

    function g(a, b, c, d) {
        this.line = b, this.ch = c, this.cm = a, this.text = a.getLine(b), this.min = d ? d.from : a.firstLine(), this.max = d ? d.to - 1 : a.lastLine()
    }

    function h(a, c) {
        var d = a.cm.getTokenTypeAt(b(a.line, c));
        return d && /\btag\b/.test(d)
    }

    function i(a) {
        return a.line >= a.max ? void 0 : (a.ch = 0, a.text = a.cm.getLine(++a.line), !0)
    }

    function j(a) {
        return a.line <= a.min ? void 0 : (a.text = a.cm.getLine(--a.line), a.ch = a.text.length, !0)
    }

    function k(a) {
        for (;;) {
            var b = a.text.indexOf(">", a.ch);
            if (-1 == b) {
                if (i(a)) continue;
                return
            } {
                if (h(a, b + 1)) {
                    var c = a.text.lastIndexOf("/", b),
                        d = c > -1 && !/\S/.test(a.text.slice(c + 1, b));
                    return a.ch = b + 1, d ? "selfClose" : "regular"
                }
                a.ch = b + 1
            }
        }
    }

    function l(a) {
        for (;;) {
            var b = a.ch ? a.text.lastIndexOf("<", a.ch - 1) : -1;
            if (-1 == b) {
                if (j(a)) continue;
                return
            }
            if (h(a, b + 1)) {
                f.lastIndex = b, a.ch = b;
                var c = f.exec(a.text);
                if (c && c.index == b) return c
            } else a.ch = b
        }
    }

    function m(a) {
        for (;;) {
            f.lastIndex = a.ch;
            var b = f.exec(a.text);
            if (!b) {
                if (i(a)) continue;
                return
            } {
                if (h(a, b.index + 1)) return a.ch = b.index + b[0].length, b;
                a.ch = b.index + 1
            }
        }
    }

    function n(a) {
        for (;;) {
            var b = a.ch ? a.text.lastIndexOf(">", a.ch - 1) : -1;
            if (-1 == b) {
                if (j(a)) continue;
                return
            } {
                if (h(a, b + 1)) {
                    var c = a.text.lastIndexOf("/", b),
                        d = c > -1 && !/\S/.test(a.text.slice(c + 1, b));
                    return a.ch = b + 1, d ? "selfClose" : "regular"
                }
                a.ch = b
            }
        }
    }

    function o(a, c) {
        for (var d = [];;) {
            var f, e = m(a),
                g = a.line,
                h = a.ch - (e ? e[0].length : 0);
            if (!e || !(f = k(a))) return;
            if ("selfClose" != f)
                if (e[1]) {
                    for (var i = d.length - 1; i >= 0; --i)
                        if (d[i] == e[2]) {
                            d.length = i;
                            break
                        }
                    if (0 > i && (!c || c == e[2])) return {
                        tag: e[2],
                        from: b(g, h),
                        to: b(a.line, a.ch)
                    }
                } else d.push(e[2])
        }
    }

    function p(a, c) {
        for (var d = [];;) {
            var e = n(a);
            if (!e) return;
            if ("selfClose" != e) {
                var f = a.line,
                    g = a.ch,
                    h = l(a);
                if (!h) return;
                if (h[1]) d.push(h[2]);
                else {
                    for (var i = d.length - 1; i >= 0; --i)
                        if (d[i] == h[2]) {
                            d.length = i;
                            break
                        }
                    if (0 > i && (!c || c == h[2])) return {
                        tag: h[2],
                        from: b(a.line, a.ch),
                        to: b(f, g)
                    }
                }
            } else l(a)
        }
    }
    var b = a.Pos,
        d = "A-Z_a-z\\u00C0-\\u00D6\\u00D8-\\u00F6\\u00F8-\\u02FF\\u0370-\\u037D\\u037F-\\u1FFF\\u200C-\\u200D\\u2070-\\u218F\\u2C00-\\u2FEF\\u3001-\\uD7FF\\uF900-\\uFDCF\\uFDF0-\\uFFFD",
        e = d + "-:.0-9\\u00B7\\u0300-\\u036F\\u203F-\\u2040",
        f = new RegExp("<(/?)([" + d + "][" + e + "]*)", "g");
    a.registerHelper("fold", "xml", function(a, c) {
        for (var d = new g(a, c.line, 0);;) {
            var f, e = m(d);
            if (!e || d.line != c.line || !(f = k(d))) return;
            if (!e[1] && "selfClose" != f) {
                var c = b(d.line, d.ch),
                    h = o(d, e[2]);
                return h && {
                    from: c,
                    to: h.from
                }
            }
        }
    }), a.findMatchingTag = function(a, d, e) {
        var f = new g(a, d.line, d.ch, e);
        if (-1 != f.text.indexOf(">") || -1 != f.text.indexOf("<")) {
            var h = k(f),
                i = h && b(f.line, f.ch),
                j = h && l(f);
            if (h && j && !(c(f, d) > 0)) {
                var m = {
                    from: b(f.line, f.ch),
                    to: i,
                    tag: j[2]
                };
                return "selfClose" == h ? {
                    open: m,
                    close: null,
                    at: "open"
                } : j[1] ? {
                    open: p(f, j[2]),
                    close: m,
                    at: "close"
                } : (f = new g(a, i.line, i.ch, e), {
                    open: m,
                    close: o(f, j[2]),
                    at: "open"
                })
            }
        }
    }, a.findEnclosingTag = function(a, b, c) {
        for (var d = new g(a, b.line, b.ch, c);;) {
            var e = p(d);
            if (!e) break;
            var f = new g(a, b.line, b.ch, c),
                h = o(f, e.tag);
            if (h) return {
                open: e,
                close: h
            }
        }
    }, a.scanForClosingTag = function(a, b, c, d) {
        var e = new g(a, b.line, b.ch, d ? {
            from: 0,
            to: d
        } : null);
        return o(e, c)
    }
});