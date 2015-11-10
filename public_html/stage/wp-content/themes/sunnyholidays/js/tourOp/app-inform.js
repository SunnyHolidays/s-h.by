(function(f, g) {
	function h(a) {
		this._uid = a;
		this._uriShow = this._uriClick = null
	}
	function i(a, d) {
		return a.replace("{rnd}", Math.random()).replace("{location}",
				encodeURIComponent(doc.location.href)).replace("{uid}", d)
	}
	var doc = f.document, b = {};
	f.tophotels = f.tophotels || {};
	var c = f.tophotels.inform = {};
	c.init = function(a) {
		doc.write('<span id="' + a + '"></span>');
		return b[a] = new h(a)
	};
	c.out = function(a, d, c) {
		doc.getElementById(a).innerHTML = d;
		c(a);
		a = doc.getElementById("out_" + a);
		a.parentNode.removeChild(a)
	};
	c.loadJS = function(a, d) {
		var c = doc.head || doc.getElementsByTagName("head")[0]
				|| doc.documentElement, b = doc.createElement("script");
		b.setAttribute("type", "text/javascript");
		b.setAttribute("src", a);
		d && b.setAttribute("id", d);
		c.appendChild(b)
	};
	c.loadCSS = function(a) {
		var d = doc.head || doc.getElementsByTagName("head")[0]
				|| doc.documentElement, b = doc.createElement("link");
		b.setAttribute("type", "text/css");
		b.setAttribute("rel", "stylesheet");
		b.setAttribute("href", a);
		d.appendChild(b)
	};
	c.uriClick = function(a, d) {
		a in b && b[a].uriClick(d)
	};
	c.uriShow = function(a, d) {
		a in b && b[a].uriShow(d)
	};
	c.click = function(a) {
		a in b && b[a].click()
	};
	c.show = function(a) {
		a in b && b[a].show()
	};
	c.ready = function(a) {
		setTimeout(a, 2E3)
	};
	h.prototype = {
		_uid : null,
		_uriClick : null,
		_uriShow : null,
		load : function(a) {
			var b = this._uid;
			setTimeout(function() {
				c.loadJS(a ? "http://" + g + "/informer_consultant/out/" + b
						: "http://" + g + "/informer/out/" + b, "out_" + b)
			}, 1);
			return this
		},
		uriClick : function(a) {
			this._uriClick = a;
			return this
		},
		uriShow : function(a) {
			this._uriShow = a;
			return this
		},
		click : function() {
			this._uriClick && ((new Image).src = i(this._uriClick, this._uid));
			return this
		},
		show : function() {
			this._uriShow && ((new Image).src = i(this._uriShow, this._uid));
			return this
		}
	}
})(window, "tophotels.ru");