/**
 * index.js
 */

var JILL10TH = {};

window.requestAnimationFrame = (function() {
    return window.requestAnimationFrame     ||
        window.webkitRequestAnimationFrame  ||
        window.mozRequestAnimationFrame     ||
        window.msRequestAnimationFrame      ||
        function( callback ) { return window.setTimeout( callback, 0); };
})();

window.cancelAnimationFrame = (function() {
    return window.cancelAnimationFrame      ||
        window.webkitCancelAnimationFrame   ||
        window.mozCancelAnimationFrame      ||
        window.msCancelAnimationFrame       ||
        function( intervalKey ) { window.clearTimeout( intervalKey ); };
})();

String.prototype.nl2br = function() {
	return this.toString().replace(/\\n/g, '<br>');
};

/*!

 * jQuery Templates Plugin 1.0.0pre

 * http://github.com/jquery/jquery-tmpl

 * Requires jQuery 1.4.2

 *

 * Copyright 2011, Software Freedom Conservancy, Inc.

 * Dual licensed under the MIT or GPL Version 2 licenses.

 * http://jquery.org/license

 */

(function( jQuery, undefined ){

	var oldManip = jQuery.fn.domManip, tmplItmAtt = "_tmplitem", htmlExpr = /^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,

		newTmplItems = {}, wrappedItems = {}, appendToTmplItems, topTmplItem = { key: 0, data: {} }, itemKey = 0, cloneIndex = 0, stack = [];



	function newTmplItem( options, parentItem, fn, data ) {

		// Returns a template item data structure for a new rendered instance of a template (a 'template item').

		// The content field is a hierarchical array of strings and nested items (to be

		// removed and replaced by nodes field of dom elements, once inserted in DOM).

		var newItem = {

			data: data || (data === 0 || data === false) ? data : (parentItem ? parentItem.data : {}),

			_wrap: parentItem ? parentItem._wrap : null,

			tmpl: null,

			parent: parentItem || null,

			nodes: [],

			calls: tiCalls,

			nest: tiNest,

			wrap: tiWrap,

			html: tiHtml,

			update: tiUpdate

		};

		if ( options ) {

			jQuery.extend( newItem, options, { nodes: [], parent: parentItem });

		}

		if ( fn ) {

			// Build the hierarchical content to be used during insertion into DOM

			newItem.tmpl = fn;

			newItem._ctnt = newItem._ctnt || newItem.tmpl( jQuery, newItem );

			newItem.key = ++itemKey;

			// Keep track of new template item, until it is stored as jQuery Data on DOM element

			(stack.length ? wrappedItems : newTmplItems)[itemKey] = newItem;

		}

		return newItem;

	}



	// Override appendTo etc., in order to provide support for targeting multiple elements. (This code would disappear if integrated in jquery core).

	jQuery.each({

		appendTo: "append",

		prependTo: "prepend",

		insertBefore: "before",

		insertAfter: "after",

		replaceAll: "replaceWith"

	}, function( name, original ) {

		jQuery.fn[ name ] = function( selector ) {

			var ret = [], insert = jQuery( selector ), elems, i, l, tmplItems,

				parent = this.length === 1 && this[0].parentNode;



			appendToTmplItems = newTmplItems || {};

			if ( parent && parent.nodeType === 11 && parent.childNodes.length === 1 && insert.length === 1 ) {

				insert[ original ]( this[0] );

				ret = this;

			} else {

				for ( i = 0, l = insert.length; i < l; i++ ) {

					cloneIndex = i;

					elems = (i > 0 ? this.clone(true) : this).get();

					jQuery( insert[i] )[ original ]( elems );

					ret = ret.concat( elems );

				}

				cloneIndex = 0;

				ret = this.pushStack( ret, name, insert.selector );

			}

			tmplItems = appendToTmplItems;

			appendToTmplItems = null;

			jQuery.tmpl.complete( tmplItems );

			return ret;

		};

	});



	jQuery.fn.extend({

		// Use first wrapped element as template markup.

		// Return wrapped set of template items, obtained by rendering template against data.

		tmpl: function( data, options, parentItem ) {

			return jQuery.tmpl( this[0], data, options, parentItem );

		},



		// Find which rendered template item the first wrapped DOM element belongs to

		tmplItem: function() {

			return jQuery.tmplItem( this[0] );

		},



		// Consider the first wrapped element as a template declaration, and get the compiled template or store it as a named template.

		template: function( name ) {

			return jQuery.template( name, this[0] );

		},



		domManip: function( args, table, callback, options ) {

			if ( args[0] && jQuery.isArray( args[0] )) {

				var dmArgs = jQuery.makeArray( arguments ), elems = args[0], elemsLength = elems.length, i = 0, tmplItem;

				while ( i < elemsLength && !(tmplItem = jQuery.data( elems[i++], "tmplItem" ))) {}

				if ( tmplItem && cloneIndex ) {

					dmArgs[2] = function( fragClone ) {

						// Handler called by oldManip when rendered template has been inserted into DOM.

						jQuery.tmpl.afterManip( this, fragClone, callback );

					};

				}

				oldManip.apply( this, dmArgs );

			} else {

				oldManip.apply( this, arguments );

			}

			cloneIndex = 0;

			if ( !appendToTmplItems ) {

				jQuery.tmpl.complete( newTmplItems );

			}

			return this;

		}

	});



	jQuery.extend({

		// Return wrapped set of template items, obtained by rendering template against data.

		tmpl: function( tmpl, data, options, parentItem ) {

			var ret, topLevel = !parentItem;

			if ( topLevel ) {

				// This is a top-level tmpl call (not from a nested template using {{tmpl}})

				parentItem = topTmplItem;

				tmpl = jQuery.template[tmpl] || jQuery.template( null, tmpl );

				wrappedItems = {}; // Any wrapped items will be rebuilt, since this is top level

			} else if ( !tmpl ) {

				// The template item is already associated with DOM - this is a refresh.

				// Re-evaluate rendered template for the parentItem

				tmpl = parentItem.tmpl;

				newTmplItems[parentItem.key] = parentItem;

				parentItem.nodes = [];

				if ( parentItem.wrapped ) {

					updateWrapped( parentItem, parentItem.wrapped );

				}

				// Rebuild, without creating a new template item

				return jQuery( build( parentItem, null, parentItem.tmpl( jQuery, parentItem ) ));

			}

			if ( !tmpl ) {

				return []; // Could throw...

			}

			if ( typeof data === "function" ) {

				data = data.call( parentItem || {} );

			}

			if ( options && options.wrapped ) {

				updateWrapped( options, options.wrapped );

			}

			ret = jQuery.isArray( data ) ?

				jQuery.map( data, function( dataItem ) {

					return dataItem ? newTmplItem( options, parentItem, tmpl, dataItem ) : null;

				}) :

				[ newTmplItem( options, parentItem, tmpl, data ) ];

			return topLevel ? jQuery( build( parentItem, null, ret ) ) : ret;

		},



		// Return rendered template item for an element.

		tmplItem: function( elem ) {

			var tmplItem;

			if ( elem instanceof jQuery ) {

				elem = elem[0];

			}

			while ( elem && elem.nodeType === 1 && !(tmplItem = jQuery.data( elem, "tmplItem" )) && (elem = elem.parentNode) ) {}

			return tmplItem || topTmplItem;

		},



		// Set:

		// Use $.template( name, tmpl ) to cache a named template,

		// where tmpl is a template string, a script element or a jQuery instance wrapping a script element, etc.

		// Use $( "selector" ).template( name ) to provide access by name to a script block template declaration.



		// Get:

		// Use $.template( name ) to access a cached template.

		// Also $( selectorToScriptBlock ).template(), or $.template( null, templateString )

		// will return the compiled template, without adding a name reference.

		// If templateString includes at least one HTML tag, $.template( templateString ) is equivalent

		// to $.template( null, templateString )

		template: function( name, tmpl ) {

			if (tmpl) {

				// Compile template and associate with name

				if ( typeof tmpl === "string" ) {

					// This is an HTML string being passed directly in.

					tmpl = buildTmplFn( tmpl );

				} else if ( tmpl instanceof jQuery ) {

					tmpl = tmpl[0] || {};

				}

				if ( tmpl.nodeType ) {

					// If this is a template block, use cached copy, or generate tmpl function and cache.

					tmpl = jQuery.data( tmpl, "tmpl" ) || jQuery.data( tmpl, "tmpl", buildTmplFn( tmpl.innerHTML ));

					// Issue: In IE, if the container element is not a script block, the innerHTML will remove quotes from attribute values whenever the value does not include white space.

					// This means that foo="${x}" will not work if the value of x includes white space: foo="${x}" -> foo=value of x.

					// To correct this, include space in tag: foo="${ x }" -> foo="value of x"

				}

				return typeof name === "string" ? (jQuery.template[name] = tmpl) : tmpl;

			}

			// Return named compiled template

			return name ? (typeof name !== "string" ? jQuery.template( null, name ):

				(jQuery.template[name] ||

					// If not in map, and not containing at least on HTML tag, treat as a selector.

					// (If integrated with core, use quickExpr.exec)

					jQuery.template( null, htmlExpr.test( name ) ? name : jQuery( name )))) : null;

		},



		encode: function( text ) {

			// Do HTML encoding replacing < > & and ' and " by corresponding entities.

			return ("" + text).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;");

		}

	});



	jQuery.extend( jQuery.tmpl, {

		tag: {

			"tmpl": {

				_default: { $2: "null" },

				open: "if($notnull_1){__=__.concat($item.nest($1,$2));}"

				// tmpl target parameter can be of type function, so use $1, not $1a (so not auto detection of functions)

				// This means that {{tmpl foo}} treats foo as a template (which IS a function).

				// Explicit parens can be used if foo is a function that returns a template: {{tmpl foo()}}.

			},

			"wrap": {

				_default: { $2: "null" },

				open: "$item.calls(__,$1,$2);__=[];",

				close: "call=$item.calls();__=call._.concat($item.wrap(call,__));"

			},

			"each": {

				_default: { $2: "$index, $value" },

				open: "if($notnull_1){$.each($1a,function($2){with(this){",

				close: "}});}"

			},

			"if": {

				open: "if(($notnull_1) && $1a){",

				close: "}"

			},

			"else": {

				_default: { $1: "true" },

				open: "}else if(($notnull_1) && $1a){"

			},

			"html": {

				// Unecoded expression evaluation.

				open: "if($notnull_1){__.push($1a);}"

			},

			"=": {

				// Encoded expression evaluation. Abbreviated form is ${}.

				_default: { $1: "$data" },

				open: "if($notnull_1){__.push($.encode($1a));}"

			},

			"!": {

				// Comment tag. Skipped by parser

				open: ""

			}

		},



		// This stub can be overridden, e.g. in jquery.tmplPlus for providing rendered events

		complete: function( items ) {

			newTmplItems = {};

		},



		// Call this from code which overrides domManip, or equivalent

		// Manage cloning/storing template items etc.

		afterManip: function afterManip( elem, fragClone, callback ) {

			// Provides cloned fragment ready for fixup prior to and after insertion into DOM

			var content = fragClone.nodeType === 11 ?

				jQuery.makeArray(fragClone.childNodes) :

				fragClone.nodeType === 1 ? [fragClone] : [];



			// Return fragment to original caller (e.g. append) for DOM insertion

			callback.call( elem, fragClone );



			// Fragment has been inserted:- Add inserted nodes to tmplItem data structure. Replace inserted element annotations by jQuery.data.

			storeTmplItems( content );

			cloneIndex++;

		}

	});



	//========================== Private helper functions, used by code above ==========================



	function build( tmplItem, nested, content ) {

		// Convert hierarchical content into flat string array

		// and finally return array of fragments ready for DOM insertion

		var frag, ret = content ? jQuery.map( content, function( item ) {

			return (typeof item === "string") ?

				// Insert template item annotations, to be converted to jQuery.data( "tmplItem" ) when elems are inserted into DOM.

				(tmplItem.key ? item.replace( /(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g, "$1 " + tmplItmAtt + "=\"" + tmplItem.key + "\" $2" ) : item) :

				// This is a child template item. Build nested template.

				build( item, tmplItem, item._ctnt );

		}) :

		// If content is not defined, insert tmplItem directly. Not a template item. May be a string, or a string array, e.g. from {{html $item.html()}}.

		tmplItem;

		if ( nested ) {

			return ret;

		}



		// top-level template

		ret = ret.join("");



		// Support templates which have initial or final text nodes, or consist only of text

		// Also support HTML entities within the HTML markup.

		ret.replace( /^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/, function( all, before, middle, after) {

			frag = jQuery( middle ).get();



			storeTmplItems( frag );

			if ( before ) {

				frag = unencode( before ).concat(frag);

			}

			if ( after ) {

				frag = frag.concat(unencode( after ));

			}

		});

		return frag ? frag : unencode( ret );

	}



	function unencode( text ) {

		// Use createElement, since createTextNode will not render HTML entities correctly

		var el = document.createElement( "div" );

		el.innerHTML = text;

		return jQuery.makeArray(el.childNodes);

	}



	// Generate a reusable function that will serve to render a template against data

	function buildTmplFn( markup ) {

		return new Function("jQuery","$item",

			// Use the variable __ to hold a string array while building the compiled template. (See https://github.com/jquery/jquery-tmpl/issues#issue/10).

			"var $=jQuery,call,__=[],$data=$item.data;" +



			// Introduce the data as local variables using with(){}

			"with($data){__.push('" +



			// Convert the template into pure JavaScript

			jQuery.trim(markup)

				.replace( /([\\'])/g, "\\$1" )

				.replace( /[\r\t\n]/g, " " )

				.replace( /\$\{([^\}]*)\}/g, "{{= $1}}" )

				.replace( /\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,

				function( all, slash, type, fnargs, target, parens, args ) {

					var tag = jQuery.tmpl.tag[ type ], def, expr, exprAutoFnDetect;

					if ( !tag ) {

						throw "Unknown template tag: " + type;

					}

					def = tag._default || [];

					if ( parens && !/\w$/.test(target)) {

						target += parens;

						parens = "";

					}

					if ( target ) {

						target = unescape( target );

						args = args ? ("," + unescape( args ) + ")") : (parens ? ")" : "");

						// Support for target being things like a.toLowerCase();

						// In that case don't call with template item as 'this' pointer. Just evaluate...

						expr = parens ? (target.indexOf(".") > -1 ? target + unescape( parens ) : ("(" + target + ").call($item" + args)) : target;

						exprAutoFnDetect = parens ? expr : "(typeof(" + target + ")==='function'?(" + target + ").call($item):(" + target + "))";

					} else {

						exprAutoFnDetect = expr = def.$1 || "null";

					}

					fnargs = unescape( fnargs );

					return "');" +

						tag[ slash ? "close" : "open" ]

							.split( "$notnull_1" ).join( target ? "typeof(" + target + ")!=='undefined' && (" + target + ")!=null" : "true" )

							.split( "$1a" ).join( exprAutoFnDetect )

							.split( "$1" ).join( expr )

							.split( "$2" ).join( fnargs || def.$2 || "" ) +

						"__.push('";

				}) +

			"');}return __;"

		);

	}

	function updateWrapped( options, wrapped ) {

		// Build the wrapped content.

		options._wrap = build( options, true,

			// Suport imperative scenario in which options.wrapped can be set to a selector or an HTML string.

			jQuery.isArray( wrapped ) ? wrapped : [htmlExpr.test( wrapped ) ? wrapped : jQuery( wrapped ).html()]

		).join("");

	}



	function unescape( args ) {

		return args ? args.replace( /\\'/g, "'").replace(/\\\\/g, "\\" ) : null;

	}

	function outerHtml( elem ) {

		var div = document.createElement("div");

		div.appendChild( elem.cloneNode(true) );

		return div.innerHTML;

	}



	// Store template items in jQuery.data(), ensuring a unique tmplItem data data structure for each rendered template instance.

	function storeTmplItems( content ) {

		var keySuffix = "_" + cloneIndex, elem, elems, newClonedItems = {}, i, l, m;

		for ( i = 0, l = content.length; i < l; i++ ) {

			if ( (elem = content[i]).nodeType !== 1 ) {

				continue;

			}

			elems = elem.getElementsByTagName("*");

			for ( m = elems.length - 1; m >= 0; m-- ) {

				processItemKey( elems[m] );

			}

			processItemKey( elem );

		}

		function processItemKey( el ) {

			var pntKey, pntNode = el, pntItem, tmplItem, key;

			// Ensure that each rendered template inserted into the DOM has its own template item,

			if ( (key = el.getAttribute( tmplItmAtt ))) {

				while ( pntNode.parentNode && (pntNode = pntNode.parentNode).nodeType === 1 && !(pntKey = pntNode.getAttribute( tmplItmAtt ))) { }

				if ( pntKey !== key ) {

					// The next ancestor with a _tmplitem expando is on a different key than this one.

					// So this is a top-level element within this template item

					// Set pntNode to the key of the parentNode, or to 0 if pntNode.parentNode is null, or pntNode is a fragment.

					pntNode = pntNode.parentNode ? (pntNode.nodeType === 11 ? 0 : (pntNode.getAttribute( tmplItmAtt ) || 0)) : 0;

					if ( !(tmplItem = newTmplItems[key]) ) {

						// The item is for wrapped content, and was copied from the temporary parent wrappedItem.

						tmplItem = wrappedItems[key];

						tmplItem = newTmplItem( tmplItem, newTmplItems[pntNode]||wrappedItems[pntNode] );

						tmplItem.key = ++itemKey;

						newTmplItems[itemKey] = tmplItem;

					}

					if ( cloneIndex ) {

						cloneTmplItem( key );

					}

				}

				el.removeAttribute( tmplItmAtt );

			} else if ( cloneIndex && (tmplItem = jQuery.data( el, "tmplItem" )) ) {

				// This was a rendered element, cloned during append or appendTo etc.

				// TmplItem stored in jQuery data has already been cloned in cloneCopyEvent. We must replace it with a fresh cloned tmplItem.

				cloneTmplItem( tmplItem.key );

				newTmplItems[tmplItem.key] = tmplItem;

				pntNode = jQuery.data( el.parentNode, "tmplItem" );

				pntNode = pntNode ? pntNode.key : 0;

			}

			if ( tmplItem ) {

				pntItem = tmplItem;

				// Find the template item of the parent element.

				// (Using !=, not !==, since pntItem.key is number, and pntNode may be a string)

				while ( pntItem && pntItem.key != pntNode ) {

					// Add this element as a top-level node for this rendered template item, as well as for any

					// ancestor items between this item and the item of its parent element

					pntItem.nodes.push( el );

					pntItem = pntItem.parent;

				}

				// Delete content built during rendering - reduce API surface area and memory use, and avoid exposing of stale data after rendering...

				delete tmplItem._ctnt;

				delete tmplItem._wrap;

				// Store template item as jQuery data on the element

				jQuery.data( el, "tmplItem", tmplItem );

			}

			function cloneTmplItem( key ) {

				key = key + keySuffix;

				tmplItem = newClonedItems[key] =

					(newClonedItems[key] || newTmplItem( tmplItem, newTmplItems[tmplItem.parent.key + keySuffix] || tmplItem.parent ));

			}

		}

	}



	//---- Helper functions for template item ----



	function tiCalls( content, tmpl, data, options ) {

		if ( !content ) {

			return stack.pop();

		}

		stack.push({ _: content, tmpl: tmpl, item:this, data: data, options: options });

	}



	function tiNest( tmpl, data, options ) {

		// nested template, using {{tmpl}} tag

		return jQuery.tmpl( jQuery.template( tmpl ), data, options, this );

	}



	function tiWrap( call, wrapped ) {

		// nested template, using {{wrap}} tag

		var options = call.options || {};

		options.wrapped = wrapped;

		// Apply the template, which may incorporate wrapped content,

		return jQuery.tmpl( jQuery.template( call.tmpl ), call.data, options, call.item );

	}



	function tiHtml( filter, textOnly ) {

		var wrapped = this._wrap;

		return jQuery.map(

			jQuery( jQuery.isArray( wrapped ) ? wrapped.join("") : wrapped ).filter( filter || "*" ),

			function(e) {

				return textOnly ?

					e.innerText || e.textContent :

					e.outerHTML || outerHtml(e);

			});

	}



	function tiUpdate() {

		var coll = this.nodes;

		jQuery.tmpl( null, null, null, this).insertBefore( coll[0] );

		jQuery( coll ).remove();

	}

})( jQuery );



/*
 * transform: A jQuery cssHooks adding cross-browser 2d transform capabilities to $.fn.css() and $.fn.animate()
 *
 * limitations:
 * - requires jQuery 1.4.3+
 * - Should you use the *translate* property, then your elements need to be absolutely positionned in a relatively positionned wrapper **or it will fail in IE678**.
 * - transformOrigin is not accessible
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery.transform.js
 *
 * Copyright 2011 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work?
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 *
 */
(function( $, window, document, Math, undefined ) {

/*
 * Feature tests and global variables
 */
var div = document.createElement("div"),
	divStyle = div.style,
	suffix = "Transform",
	testProperties = [
		"O" + suffix,
		"ms" + suffix,
		"Webkit" + suffix,
		"Moz" + suffix
	],
	i = testProperties.length,
	supportProperty,
	supportMatrixFilter,
	supportFloat32Array = "Float32Array" in window,
	propertyHook,
	propertyGet,
	rMatrix = /Matrix([^)]*)/,
	rAffine = /^\s*matrix\(\s*1\s*,\s*0\s*,\s*0\s*,\s*1\s*(?:,\s*0(?:px)?\s*){2}\)\s*$/,
	_transform = "transform",
	_transformOrigin = "transformOrigin",
	_translate = "translate",
	_rotate = "rotate",
	_scale = "scale",
	_skew = "skew",
	_matrix = "matrix";

// test different vendor prefixes of these properties
while ( i-- ) {
	if ( testProperties[i] in divStyle ) {
		$.support[_transform] = supportProperty = testProperties[i];
		$.support[_transformOrigin] = supportProperty + "Origin";
		continue;
	}
}
// IE678 alternative
if ( !supportProperty ) {
	$.support.matrixFilter = supportMatrixFilter = divStyle.filter === "";
}

// px isn't the default unit of these properties
$.cssNumber[_transform] = $.cssNumber[_transformOrigin] = true;

/*
 * fn.css() hooks
 */
if ( supportProperty && supportProperty != _transform ) {
	// Modern browsers can use jQuery.cssProps as a basic hook
	$.cssProps[_transform] = supportProperty;
	$.cssProps[_transformOrigin] = supportProperty + "Origin";

	// Firefox needs a complete hook because it stuffs matrix with "px"
	if ( supportProperty == "Moz" + suffix ) {
		propertyHook = {
			get: function( elem, computed ) {
				return (computed ?
					// remove "px" from the computed matrix
					$.css( elem, supportProperty ).split("px").join(""):
					elem.style[supportProperty]
				);
			},
			set: function( elem, value ) {
				// add "px" to matrices
				elem.style[supportProperty] = /matrix\([^)p]*\)/.test(value) ?
					value.replace(/matrix((?:[^,]*,){4})([^,]*),([^)]*)/, _matrix+"$1$2px,$3px"):
					value;
			}
		};
	/* Fix two jQuery bugs still present in 1.5.1
	 * - rupper is incompatible with IE9, see http://jqbug.com/8346
	 * - jQuery.css is not really jQuery.cssProps aware, see http://jqbug.com/8402
	 */
	} else if ( /^1\.[0-5](?:\.|$)/.test($.fn.jquery) ) {
		propertyHook = {
			get: function( elem, computed ) {
				return (computed ?
					$.css( elem, supportProperty.replace(/^ms/, "Ms") ):
					elem.style[supportProperty]
				);
			}
		};
	}
	/* TODO: leverage hardware acceleration of 3d transform in Webkit only
	else if ( supportProperty == "Webkit" + suffix && support3dTransform ) {
		propertyHook = {
			set: function( elem, value ) {
				elem.style[supportProperty] = 
					value.replace();
			}
		}
	}*/

} else if ( supportMatrixFilter ) {
	propertyHook = {
		get: function( elem, computed, asArray ) {
			var elemStyle = ( computed && elem.currentStyle ? elem.currentStyle : elem.style ),
				matrix, data;

			if ( elemStyle && rMatrix.test( elemStyle.filter ) ) {
				matrix = RegExp.$1.split(",");
				matrix = [
					matrix[0].split("=")[1],
					matrix[2].split("=")[1],
					matrix[1].split("=")[1],
					matrix[3].split("=")[1]
				];
			} else {
				matrix = [1,0,0,1];
			}

			if ( ! $.cssHooks[_transformOrigin] ) {
				matrix[4] = elemStyle ? parseInt(elemStyle.left, 10) || 0 : 0;
				matrix[5] = elemStyle ? parseInt(elemStyle.top, 10) || 0 : 0;

			} else {
				data = $._data( elem, "transformTranslate", undefined );
				matrix[4] = data ? data[0] : 0;
				matrix[5] = data ? data[1] : 0;
			}

			return asArray ? matrix : _matrix+"(" + matrix + ")";
		},
		set: function( elem, value, animate ) {
			var elemStyle = elem.style,
				currentStyle,
				Matrix,
				filter,
				centerOrigin;

			if ( !animate ) {
				elemStyle.zoom = 1;
			}

			value = matrix(value);

			// rotate, scale and skew
			Matrix = [
				"Matrix("+
					"M11="+value[0],
					"M12="+value[2],
					"M21="+value[1],
					"M22="+value[3],
					"SizingMethod='auto expand'"
			].join();
			filter = ( currentStyle = elem.currentStyle ) && currentStyle.filter || elemStyle.filter || "";

			elemStyle.filter = rMatrix.test(filter) ?
				filter.replace(rMatrix, Matrix) :
				filter + " progid:DXImageTransform.Microsoft." + Matrix + ")";

			if ( ! $.cssHooks[_transformOrigin] ) {

				// center the transform origin, from pbakaus's Transformie http://github.com/pbakaus/transformie
				if ( (centerOrigin = $.transform.centerOrigin) ) {
					elemStyle[centerOrigin == "margin" ? "marginLeft" : "left"] = -(elem.offsetWidth/2) + (elem.clientWidth/2) + "px";
					elemStyle[centerOrigin == "margin" ? "marginTop" : "top"] = -(elem.offsetHeight/2) + (elem.clientHeight/2) + "px";
				}

				// translate
				// We assume that the elements are absolute positionned inside a relative positionned wrapper
				elemStyle.left = value[4] + "px";
				elemStyle.top = value[5] + "px";

			} else {
				$.cssHooks[_transformOrigin].set( elem, value );
			}
		}
	};
}
// populate jQuery.cssHooks with the appropriate hook if necessary
if ( propertyHook ) {
	$.cssHooks[_transform] = propertyHook;
}
// we need a unique setter for the animation logic
propertyGet = propertyHook && propertyHook.get || $.css;

/*
 * fn.animate() hooks
 */
$.fx.step.transform = function( fx ) {
	var elem = fx.elem,
		start = fx.start,
		end = fx.end,
		pos = fx.pos,
		transform = "",
		precision = 1E5,
		i, startVal, endVal, unit;

	// fx.end and fx.start need to be converted to interpolation lists
	if ( !start || typeof start === "string" ) {

		// the following block can be commented out with jQuery 1.5.1+, see #7912
		if ( !start ) {
			start = propertyGet( elem, supportProperty );
		}

		// force layout only once per animation
		if ( supportMatrixFilter ) {
			elem.style.zoom = 1;
		}

		// replace "+=" in relative animations (-= is meaningless with transforms)
		end = end.split("+=").join(start);

		// parse both transform to generate interpolation list of same length
		$.extend( fx, interpolationList( start, end ) );
		start = fx.start;
		end = fx.end;
	}

	i = start.length;

	// interpolate functions of the list one by one
	while ( i-- ) {
		startVal = start[i];
		endVal = end[i];
		unit = +false;

		switch ( startVal[0] ) {

			case _translate:
				unit = "px";
			case _scale:
				unit || ( unit = "");

				transform = startVal[0] + "(" +
					Math.round( (startVal[1][0] + (endVal[1][0] - startVal[1][0]) * pos) * precision ) / precision + unit +","+
					Math.round( (startVal[1][1] + (endVal[1][1] - startVal[1][1]) * pos) * precision ) / precision + unit + ")"+
					transform;
				break;

			case _skew + "X":
			case _skew + "Y":
			case _rotate:
				transform = startVal[0] + "(" +
					Math.round( (startVal[1] + (endVal[1] - startVal[1]) * pos) * precision ) / precision +"rad)"+
					transform;
				break;
		}
	}

	fx.origin && ( transform = fx.origin + transform );

	propertyHook && propertyHook.set ?
		propertyHook.set( elem, transform, +true ):
		elem.style[supportProperty] = transform;
};

/*
 * Utility functions
 */

// turns a transform string into its "matrix(A,B,C,D,X,Y)" form (as an array, though)
function matrix( transform ) {
	transform = transform.split(")");
	var
			trim = $.trim
		, i = -1
		// last element of the array is an empty string, get rid of it
		, l = transform.length -1
		, split, prop, val
		, prev = supportFloat32Array ? new Float32Array(6) : []
		, curr = supportFloat32Array ? new Float32Array(6) : []
		, rslt = supportFloat32Array ? new Float32Array(6) : [1,0,0,1,0,0]
		;

	prev[0] = prev[3] = rslt[0] = rslt[3] = 1;
	prev[1] = prev[2] = prev[4] = prev[5] = 0;

	// Loop through the transform properties, parse and multiply them
	while ( ++i < l ) {
		split = transform[i].split("(");
		prop = trim(split[0]);
		val = split[1];
		curr[0] = curr[3] = 1;
		curr[1] = curr[2] = curr[4] = curr[5] = 0;

		switch (prop) {
			case _translate+"X":
				curr[4] = parseInt(val, 10);
				break;

			case _translate+"Y":
				curr[5] = parseInt(val, 10);
				break;

			case _translate:
				val = val.split(",");
				curr[4] = parseInt(val[0], 10);
				curr[5] = parseInt(val[1] || 0, 10);
				break;

			case _rotate:
				val = toRadian(val);
				curr[0] = Math.cos(val);
				curr[1] = Math.sin(val);
				curr[2] = -Math.sin(val);
				curr[3] = Math.cos(val);
				break;

			case _scale+"X":
				curr[0] = +val;
				break;

			case _scale+"Y":
				curr[3] = val;
				break;

			case _scale:
				val = val.split(",");
				curr[0] = val[0];
				curr[3] = val.length>1 ? val[1] : val[0];
				break;

			case _skew+"X":
				curr[2] = Math.tan(toRadian(val));
				break;

			case _skew+"Y":
				curr[1] = Math.tan(toRadian(val));
				break;

			case _matrix:
				val = val.split(",");
				curr[0] = val[0];
				curr[1] = val[1];
				curr[2] = val[2];
				curr[3] = val[3];
				curr[4] = parseInt(val[4], 10);
				curr[5] = parseInt(val[5], 10);
				break;
		}

		// Matrix product (array in column-major order)
		rslt[0] = prev[0] * curr[0] + prev[2] * curr[1];
		rslt[1] = prev[1] * curr[0] + prev[3] * curr[1];
		rslt[2] = prev[0] * curr[2] + prev[2] * curr[3];
		rslt[3] = prev[1] * curr[2] + prev[3] * curr[3];
		rslt[4] = prev[0] * curr[4] + prev[2] * curr[5] + prev[4];
		rslt[5] = prev[1] * curr[4] + prev[3] * curr[5] + prev[5];

		prev = [rslt[0],rslt[1],rslt[2],rslt[3],rslt[4],rslt[5]];
	}
	return rslt;
}

// turns a matrix into its rotate, scale and skew components
// algorithm from http://hg.mozilla.org/mozilla-central/file/7cb3e9795d04/layout/style/nsStyleAnimation.cpp
function unmatrix(matrix) {
	var
			scaleX
		, scaleY
		, skew
		, A = matrix[0]
		, B = matrix[1]
		, C = matrix[2]
		, D = matrix[3]
		;

	// Make sure matrix is not singular
	if ( A * D - B * C ) {
		// step (3)
		scaleX = Math.sqrt( A * A + B * B );
		A /= scaleX;
		B /= scaleX;
		// step (4)
		skew = A * C + B * D;
		C -= A * skew;
		D -= B * skew;
		// step (5)
		scaleY = Math.sqrt( C * C + D * D );
		C /= scaleY;
		D /= scaleY;
		skew /= scaleY;
		// step (6)
		if ( A * D < B * C ) {
			A = -A;
			B = -B;
			skew = -skew;
			scaleX = -scaleX;
		}

	// matrix is singular and cannot be interpolated
	} else {
		// In this case the elem shouldn't be rendered, hence scale == 0
		scaleX = scaleY = skew = 0;
	}

	// The recomposition order is very important
	// see http://hg.mozilla.org/mozilla-central/file/7cb3e9795d04/layout/style/nsStyleAnimation.cpp#l971
	return [
		[_translate, [+matrix[4], +matrix[5]]],
		[_rotate, Math.atan2(B, A)],
		[_skew + "X", Math.atan(skew)],
		[_scale, [scaleX, scaleY]]
	];
}

// build the list of transform functions to interpolate
// use the algorithm described at http://dev.w3.org/csswg/css3-2d-transforms/#animation
function interpolationList( start, end ) {
	var list = {
			start: [],
			end: []
		},
		i = -1, l,
		currStart, currEnd, currType;

	// get rid of affine transform matrix
	( start == "none" || isAffine( start ) ) && ( start = "" );
	( end == "none" || isAffine( end ) ) && ( end = "" );

	// if end starts with the current computed style, this is a relative animation
	// store computed style as the origin, remove it from start and end
	if ( start && end && !end.indexOf("matrix") && toArray( start ).join() == toArray( end.split(")")[0] ).join() ) {
		list.origin = start;
		start = "";
		end = end.slice( end.indexOf(")") +1 );
	}

	if ( !start && !end ) { return; }

	// start or end are affine, or list of transform functions are identical
	// => functions will be interpolated individually
	if ( !start || !end || functionList(start) == functionList(end) ) {

		start && ( start = start.split(")") ) && ( l = start.length );
		end && ( end = end.split(")") ) && ( l = end.length );

		while ( ++i < l-1 ) {
			start[i] && ( currStart = start[i].split("(") );
			end[i] && ( currEnd = end[i].split("(") );
			currType = $.trim( ( currStart || currEnd )[0] );

			append( list.start, parseFunction( currType, currStart ? currStart[1] : 0 ) );
			append( list.end, parseFunction( currType, currEnd ? currEnd[1] : 0 ) );
		}

	// otherwise, functions will be composed to a single matrix
	} else {
		list.start = unmatrix(matrix(start));
		list.end = unmatrix(matrix(end))
	}

	return list;
}

function parseFunction( type, value ) {
	var
		// default value is 1 for scale, 0 otherwise
		defaultValue = +(!type.indexOf(_scale)),
		scaleX,
		// remove X/Y from scaleX/Y & translateX/Y, not from skew
		cat = type.replace( /e[XY]/, "e" );

	switch ( type ) {
		case _translate+"Y":
		case _scale+"Y":

			value = [
				defaultValue,
				value ?
					parseFloat( value ):
					defaultValue
			];
			break;

		case _translate+"X":
		case _translate:
		case _scale+"X":
			scaleX = 1;
		case _scale:

			value = value ?
				( value = value.split(",") ) &&	[
					parseFloat( value[0] ),
					parseFloat( value.length>1 ? value[1] : type == _scale ? scaleX || value[0] : defaultValue+"" )
				]:
				[defaultValue, defaultValue];
			break;

		case _skew+"X":
		case _skew+"Y":
		case _rotate:
			value = value ? toRadian( value ) : 0;
			break;

		case _matrix:
			return unmatrix( value ? toArray(value) : [1,0,0,1,0,0] );
			break;
	}

	return [[ cat, value ]];
}

function isAffine( matrix ) {
	return rAffine.test(matrix);
}

function functionList( transform ) {
	return transform.replace(/(?:\([^)]*\))|\s/g, "");
}

function append( arr1, arr2, value ) {
	while ( value = arr2.shift() ) {
		arr1.push( value );
	}
}

// converts an angle string in any unit to a radian Float
function toRadian(value) {
	return ~value.indexOf("deg") ?
		parseInt(value,10) * (Math.PI * 2 / 360):
		~value.indexOf("grad") ?
			parseInt(value,10) * (Math.PI/200):
			parseFloat(value);
}

// Converts "matrix(A,B,C,D,X,Y)" to [A,B,C,D,X,Y]
function toArray(matrix) {
	// remove the unit of X and Y for Firefox
	matrix = /([^,]*),([^,]*),([^,]*),([^,]*),([^,p]*)(?:px)?,([^)p]*)(?:px)?/.exec(matrix);
	return [matrix[1], matrix[2], matrix[3], matrix[4], matrix[5], matrix[6]];
}

$.transform = {
	centerOrigin: "margin"
};

})( jQuery, window, document, Math );


/*!
 * jQuery hashchange event - v1.3 - 7/21/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */

// Script: jQuery hashchange event
//
// *Version: 1.3, Last updated: 7/21/2010*
//
// Project Home - http://benalman.com/projects/jquery-hashchange-plugin/
// GitHub       - http://github.com/cowboy/jquery-hashchange/
// Source       - http://github.com/cowboy/jquery-hashchange/raw/master/jquery.ba-hashchange.js
// (Minified)   - http://github.com/cowboy/jquery-hashchange/raw/master/jquery.ba-hashchange.min.js (0.8kb gzipped)
//
// About: License
//
// Copyright (c) 2010 "Cowboy" Ben Alman,
// Dual licensed under the MIT and GPL licenses.
// http://benalman.com/about/license/
//
// About: Examples
//
// These working examples, complete with fully commented code, illustrate a few
// ways in which this plugin can be used.
//
// hashchange event - http://benalman.com/code/projects/jquery-hashchange/examples/hashchange/
// document.domain - http://benalman.com/code/projects/jquery-hashchange/examples/document_domain/
//
// About: Support and Testing
//
// Information about what version or versions of jQuery this plugin has been
// tested with, what browsers it has been tested in, and where the unit tests
// reside (so you can test it yourself).
//
// jQuery Versions - 1.2.6, 1.3.2, 1.4.1, 1.4.2
// Browsers Tested - Internet Explorer 6-8, Firefox 2-4, Chrome 5-6, Safari 3.2-5,
//                   Opera 9.6-10.60, iPhone 3.1, Android 1.6-2.2, BlackBerry 4.6-5.
// Unit Tests      - http://benalman.com/code/projects/jquery-hashchange/unit/
//
// About: Known issues
//
// While this jQuery hashchange event implementation is quite stable and
// robust, there are a few unfortunate browser bugs surrounding expected
// hashchange event-based behaviors, independent of any JavaScript
// window.onhashchange abstraction. See the following examples for more
// information:
//
// Chrome: Back Button - http://benalman.com/code/projects/jquery-hashchange/examples/bug-chrome-back-button/
// Firefox: Remote XMLHttpRequest - http://benalman.com/code/projects/jquery-hashchange/examples/bug-firefox-remote-xhr/
// WebKit: Back Button in an Iframe - http://benalman.com/code/projects/jquery-hashchange/examples/bug-webkit-hash-iframe/
// Safari: Back Button from a different domain - http://benalman.com/code/projects/jquery-hashchange/examples/bug-safari-back-from-diff-domain/
//
// Also note that should a browser natively support the window.onhashchange
// event, but not report that it does, the fallback polling loop will be used.
//
// About: Release History
//
// 1.3   - (7/21/2010) Reorganized IE6/7 Iframe code to make it more
//         "removable" for mobile-only development. Added IE6/7 document.title
//         support. Attempted to make Iframe as hidden as possible by using
//         techniques from http://www.paciellogroup.com/blog/?p=604. Added
//         support for the "shortcut" format $(window).hashchange( fn ) and
//         $(window).hashchange() like jQuery provides for built-in events.
//         Renamed jQuery.hashchangeDelay to <jQuery.fn.hashchange.delay> and
//         lowered its default value to 50. Added <jQuery.fn.hashchange.domain>
//         and <jQuery.fn.hashchange.src> properties plus document-domain.html
//         file to address access denied issues when setting document.domain in
//         IE6/7.
// 1.2   - (2/11/2010) Fixed a bug where coming back to a page using this plugin
//         from a page on another domain would cause an error in Safari 4. Also,
//         IE6/7 Iframe is now inserted after the body (this actually works),
//         which prevents the page from scrolling when the event is first bound.
//         Event can also now be bound before DOM ready, but it won't be usable
//         before then in IE6/7.
// 1.1   - (1/21/2010) Incorporated document.documentMode test to fix IE8 bug
//         where browser version is incorrectly reported as 8.0, despite
//         inclusion of the X-UA-Compatible IE=EmulateIE7 meta tag.
// 1.0   - (1/9/2010) Initial Release. Broke out the jQuery BBQ event.special
//         window.onhashchange functionality into a separate plugin for users
//         who want just the basic event & back button support, without all the
//         extra awesomeness that BBQ provides. This plugin will be included as
//         part of jQuery BBQ, but also be available separately.

(function($,window,undefined){
  '$:nomunge'; // Used by YUI compressor.

  // Reused string.
  var str_hashchange = 'hashchange',

    // Method / object references.
    doc = document,
    fake_onhashchange,
    special = $.event.special,

    // Does the browser support window.onhashchange? Note that IE8 running in
    // IE7 compatibility mode reports true for 'onhashchange' in window, even
    // though the event isn't supported, so also test document.documentMode.
    doc_mode = doc.documentMode,
    supports_onhashchange = 'on' + str_hashchange in window && ( doc_mode === undefined || doc_mode > 7 );

  // Get location.hash (or what you'd expect location.hash to be) sans any
  // leading #. Thanks for making this necessary, Firefox!
  function get_fragment( url ) {
    url = url || location.href;
    return '#' + url.replace( /^[^#]*#?(.*)$/, '$1' );
  };

  // Method: jQuery.fn.hashchange
  //
  // Bind a handler to the window.onhashchange event or trigger all bound
  // window.onhashchange event handlers. This behavior is consistent with
  // jQuery's built-in event handlers.
  //
  // Usage:
  //
  // > jQuery(window).hashchange( [ handler ] );
  //
  // Arguments:
  //
  //  handler - (Function) Optional handler to be bound to the hashchange
  //    event. This is a "shortcut" for the more verbose form:
  //    jQuery(window).bind( 'hashchange', handler ). If handler is omitted,
  //    all bound window.onhashchange event handlers will be triggered. This
  //    is a shortcut for the more verbose
  //    jQuery(window).trigger( 'hashchange' ). These forms are described in
  //    the <hashchange event> section.
  //
  // Returns:
  //
  //  (jQuery) The initial jQuery collection of elements.

  // Allow the "shortcut" format $(elem).hashchange( fn ) for binding and
  // $(elem).hashchange() for triggering, like jQuery does for built-in events.
  $.fn[ str_hashchange ] = function( fn ) {
    return fn ? this.bind( str_hashchange, fn ) : this.trigger( str_hashchange );
  };

  // Property: jQuery.fn.hashchange.delay
  //
  // The numeric interval (in milliseconds) at which the <hashchange event>
  // polling loop executes. Defaults to 50.

  // Property: jQuery.fn.hashchange.domain
  //
  // If you're setting document.domain in your JavaScript, and you want hash
  // history to work in IE6/7, not only must this property be set, but you must
  // also set document.domain BEFORE jQuery is loaded into the page. This
  // property is only applicable if you are supporting IE6/7 (or IE8 operating
  // in "IE7 compatibility" mode).
  //
  // In addition, the <jQuery.fn.hashchange.src> property must be set to the
  // path of the included "document-domain.html" file, which can be renamed or
  // modified if necessary (note that the document.domain specified must be the
  // same in both your main JavaScript as well as in this file).
  //
  // Usage:
  //
  // jQuery.fn.hashchange.domain = document.domain;

  // Property: jQuery.fn.hashchange.src
  //
  // If, for some reason, you need to specify an Iframe src file (for example,
  // when setting document.domain as in <jQuery.fn.hashchange.domain>), you can
  // do so using this property. Note that when using this property, history
  // won't be recorded in IE6/7 until the Iframe src file loads. This property
  // is only applicable if you are supporting IE6/7 (or IE8 operating in "IE7
  // compatibility" mode).
  //
  // Usage:
  //
  // jQuery.fn.hashchange.src = 'path/to/file.html';

  $.fn[ str_hashchange ].delay = 50;
  /*
  $.fn[ str_hashchange ].domain = null;
  $.fn[ str_hashchange ].src = null;
  */

  // Event: hashchange event
  //
  // Fired when location.hash changes. In browsers that support it, the native
  // HTML5 window.onhashchange event is used, otherwise a polling loop is
  // initialized, running every <jQuery.fn.hashchange.delay> milliseconds to
  // see if the hash has changed. In IE6/7 (and IE8 operating in "IE7
  // compatibility" mode), a hidden Iframe is created to allow the back button
  // and hash-based history to work.
  //
  // Usage as described in <jQuery.fn.hashchange>:
  //
  // > // Bind an event handler.
  // > jQuery(window).hashchange( function(e) {
  // >   var hash = location.hash;
  // >   ...
  // > });
  // >
  // > // Manually trigger the event handler.
  // > jQuery(window).hashchange();
  //
  // A more verbose usage that allows for event namespacing:
  //
  // > // Bind an event handler.
  // > jQuery(window).bind( 'hashchange', function(e) {
  // >   var hash = location.hash;
  // >   ...
  // > });
  // >
  // > // Manually trigger the event handler.
  // > jQuery(window).trigger( 'hashchange' );
  //
  // Additional Notes:
  //
  // * The polling loop and Iframe are not created until at least one handler
  //   is actually bound to the 'hashchange' event.
  // * If you need the bound handler(s) to execute immediately, in cases where
  //   a location.hash exists on page load, via bookmark or page refresh for
  //   example, use jQuery(window).hashchange() or the more verbose
  //   jQuery(window).trigger( 'hashchange' ).
  // * The event can be bound before DOM ready, but since it won't be usable
  //   before then in IE6/7 (due to the necessary Iframe), recommended usage is
  //   to bind it inside a DOM ready handler.

  // Override existing $.event.special.hashchange methods (allowing this plugin
  // to be defined after jQuery BBQ in BBQ's source code).
  special[ str_hashchange ] = $.extend( special[ str_hashchange ], {

    // Called only when the first 'hashchange' event is bound to window.
    setup: function() {
      // If window.onhashchange is supported natively, there's nothing to do..
      if ( supports_onhashchange ) { return false; }

      // Otherwise, we need to create our own. And we don't want to call this
      // until the user binds to the event, just in case they never do, since it
      // will create a polling loop and possibly even a hidden Iframe.
      $( fake_onhashchange.start );
    },

    // Called only when the last 'hashchange' event is unbound from window.
    teardown: function() {
      // If window.onhashchange is supported natively, there's nothing to do..
      if ( supports_onhashchange ) { return false; }

      // Otherwise, we need to stop ours (if possible).
      $( fake_onhashchange.stop );
    }

  });

  // fake_onhashchange does all the work of triggering the window.onhashchange
  // event for browsers that don't natively support it, including creating a
  // polling loop to watch for hash changes and in IE 6/7 creating a hidden
  // Iframe to enable back and forward.
  fake_onhashchange = (function(){
    var self = {},
      timeout_id,

      // Remember the initial hash so it doesn't get triggered immediately.
      last_hash = get_fragment(),

      fn_retval = function(val){ return val; },
      history_set = fn_retval,
      history_get = fn_retval;

    // Start the polling loop.
    self.start = function() {
      timeout_id || poll();
    };

    // Stop the polling loop.
    self.stop = function() {
      timeout_id && clearTimeout( timeout_id );
      timeout_id = undefined;
    };

    // This polling loop checks every $.fn.hashchange.delay milliseconds to see
    // if location.hash has changed, and triggers the 'hashchange' event on
    // window when necessary.
    function poll() {
      var hash = get_fragment(),
        history_hash = history_get( last_hash );

      if ( hash !== last_hash ) {
        history_set( last_hash = hash, history_hash );

        $(window).trigger( str_hashchange );

      } else if ( history_hash !== last_hash ) {
        location.href = location.href.replace( /#.*/, '' ) + history_hash;
      }

      timeout_id = setTimeout( poll, $.fn[ str_hashchange ].delay );
    };

    // vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
    // vvvvvvvvvvvvvvvvvvv REMOVE IF NOT SUPPORTING IE6/7/8 vvvvvvvvvvvvvvvvvvv
    // vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
    (document.documentMode != undefined) && !supports_onhashchange && (function(){
      // Not only do IE6/7 need the "magical" Iframe treatment, but so does IE8
      // when running in "IE7 compatibility" mode.

      var iframe,
        iframe_src;

      // When the event is bound and polling starts in IE 6/7, create a hidden
      // Iframe for history handling.
      self.start = function(){
        if ( !iframe ) {
          iframe_src = $.fn[ str_hashchange ].src;
          iframe_src = iframe_src && iframe_src + get_fragment();

          // Create hidden Iframe. Attempt to make Iframe as hidden as possible
          // by using techniques from http://www.paciellogroup.com/blog/?p=604.
          iframe = $('<iframe tabindex="-1" title="empty"/>').hide()

            // When Iframe has completely loaded, initialize the history and
            // start polling.
            .one( 'load', function(){
              iframe_src || history_set( get_fragment() );
              poll();
            })

            // Load Iframe src if specified, otherwise nothing.
            .attr( 'src', iframe_src || 'javascript:0' )

            // Append Iframe after the end of the body to prevent unnecessary
            // initial page scrolling (yes, this works).
            .insertAfter( 'body' )[0].contentWindow;

          // Whenever `document.title` changes, update the Iframe's title to
          // prettify the back/next history menu entries. Since IE sometimes
          // errors with "Unspecified error" the very first time this is set
          // (yes, very useful) wrap this with a try/catch block.
          doc.onpropertychange = function(){
            try {
              if ( event.propertyName === 'title' ) {
                iframe.document.title = doc.title;
              }
            } catch(e) {}
          };

        }
      };

      // Override the "stop" method since an IE6/7 Iframe was created. Even
      // if there are no longer any bound event handlers, the polling loop
      // is still necessary for back/next to work at all!
      self.stop = fn_retval;

      // Get history by looking at the hidden Iframe's location.hash.
      history_get = function() {
        return get_fragment( iframe.location.href );
      };

      // Set a new history item by opening and then closing the Iframe
      // document, *then* setting its location.hash. If document.domain has
      // been set, update that as well.
      history_set = function( hash, history_hash ) {
        var iframe_doc = iframe.document,
          domain = $.fn[ str_hashchange ].domain;

        if ( hash !== history_hash ) {
          // Update Iframe with any initial `document.title` that might be set.
          iframe_doc.title = doc.title;

          // Opening the Iframe's document after it has been closed is what
          // actually adds a history entry.
          iframe_doc.open();

          // Set document.domain for the Iframe document as well, if necessary.
          domain && iframe_doc.write( '<script>document.domain="' + domain + '"</script>' );

          iframe_doc.close();

          // Update the Iframe's hash, for great justice.
          iframe.location.hash = hash;
        }
      };

    })();
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    // ^^^^^^^^^^^^^^^^^^^ REMOVE IF NOT SUPPORTING IE6/7/8 ^^^^^^^^^^^^^^^^^^^
    // ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

    return self;
  })();

})(jQuery,this);


/**
 * PgwModal - Version 2.0
 *
 * Copyright 2014, Jonathan M. Piat
 * http://pgwjs.com - http://pagawa.com
 *
 * Released under the GNU GPLv3 license - http://opensource.org/licenses/gpl-3.0
 */
;(function($){
    $.pgwModal = function(obj, settings) {

        var pgwModal = {};
        var defaults = {
            mainClassName : 'pgwModal',
            backdropClassName : 'pgwModalBackdrop',
            maxWidth : 500,
            titleBar : true,
            closable : true,
            closeOnEscape : true,
            closeOnBackgroundClick : true,
            closeContent : '<span class="pm-icon"></span>',
            loadingContent : 'Loading in progress...',
            errorContent : 'An error has occured. Please try again in a few moments.',
            onOpen : null,
            onClose : null
        };

        if (typeof window.pgwModalObject != 'undefined') {
            pgwModal = window.pgwModalObject;
        }

        // Merge the defaults and the user's config
        if ((typeof obj == 'object') && (! obj.pushContent)) {
            if (! obj.url && ! obj.target && ! obj.content) {
                throw new Error('PgwModal - There is no content to display, please provide a config parameter : "url", "target" or "content"');
            }

            pgwModal.config = {};
            pgwModal.config = $.extend({}, defaults, obj);
            window.pgwModalObject = pgwModal;
        }

        // Create modal container
        var create = function() {
            // The backdrop must be outside the main container, otherwise Chrome displays the scrollbar of the modal below
            var appendBody = '<div id="pgwModalBackdrop"></div>'
                + '<div id="pgwModal">'
                + '<div class="pm-container">'
                + '<div class="pm-body">'
                + '<span class="pm-close"></span>'
                + '<div class="pm-title"></div>'
                + '<div class="pm-content"></div>'
                + '</div>'
                + '</div>'
                + '</div>';

            $('body').append(appendBody);
            $(document).trigger('PgwModal::Create');
            return true;
        };

        // Reset modal container
        var reset = function() {
            $('#pgwModal .pm-title, #pgwModal .pm-content').html('');
            $('#pgwModal .pm-close').html('').unbind('click');
            return true;
        };

        // Angular compilation
        var angularCompilation = function() {
            angular.element('body').injector().invoke(function($compile) {
                var scope = angular.element($('#pgwModal .pm-content')).scope();
                $compile($('#pgwModal .pm-content'))(scope);
                scope.$digest();
            });
            return true;
        };

        // Push content into the modal
        var pushContent = function(content) {
            $('#pgwModal .pm-content').html(content);

            // Angular
            if (pgwModal.config.angular) {
                angularCompilation();
            }

            reposition();

            $(document).trigger('PgwModal::PushContent');
            return true;
        };

        // Repositions the modal
        var reposition = function(opt) {
            // Elements must be visible before height calculation
            $('#pgwModal, #pgwModalBackdrop').show();
            if(opt && opt.maxWidth){
              // if (pgwModal.config.maxWidth) {
              $('#pgwModal .pm-body').css('max-width', opt.maxWidth);
              // }
            }
            var windowHeight = $(window).height();
            var modalHeight = $('#pgwModal .pm-body').height();
            var marginTop = Math.round((windowHeight - modalHeight) / 3);
            if (marginTop <= 0) {
                marginTop = 0;
            }

            $('#pgwModal .pm-body').css('margin-top', marginTop);
            return true;
        };

        // Returns the modal data
        var getData = function() {
            return pgwModal.config.modalData;
        };

        // Returns the scrollbar width
        var getScrollbarWidth = function() {
            var container = $('<div style="width:50px;height:50px;overflow:auto"><div></div></div>').appendTo('body');
            var child = container.children();

            // Check for Zepto
            if (typeof child.innerWidth != 'function') {
                return 0;
            }

            var width = child.innerWidth() - child.height(90).innerWidth();
            container.remove();

            return width;
        };

        // Returns the modal status
        var isOpen = function() {
            return $('body').hasClass('pgwModalOpen');
        };

        // Close the modal
        var close = function() {
            $('#pgwModal, #pgwModalBackdrop').removeClass().hide();
            $('body').css('padding-right', '').removeClass('pgwModalOpen');

            // Reset modal
            reset();

            // Disable events
            $(window).unbind('resize.PgwModal');
            $(document).unbind('keyup.PgwModal');
            $('#pgwModal').unbind('click.PgwModalBackdrop');

            try {
                delete window.pgwModalObject;
            } catch(e) {
                window['pgwModalObject'] = undefined;
            }

            if(pgwModal.config.onClose) pgwModal.config.onClose();
            $(document).trigger('PgwModal::Close');
            return true;
        };

        // Open the modal
        var open = function() {
            if ($('#pgwModal').length == 0) {
                create();
            } else {
                reset();
            }

            // Set CSS classes
            $('#pgwModal').removeClass().addClass(pgwModal.config.mainClassName);
            $('#pgwModalBackdrop').removeClass().addClass(pgwModal.config.backdropClassName);

            // Close button
            if (! pgwModal.config.closable) {
                $('#pgwModal .pm-close').html('').unbind('click').hide();
            } else {
                $('#pgwModal .pm-close').html(pgwModal.config.closeContent).click(function(e) {
                    close();
                }).show();
            }

            // Title bar
            if (! pgwModal.config.titleBar) {
                $('#pgwModal .pm-title').hide();
            } else {
                $('#pgwModal .pm-title').show();
            }

            if (pgwModal.config.title) {
                $('#pgwModal .pm-title').text(pgwModal.config.title);
            }

            if (pgwModal.config.maxWidth) {
                $('#pgwModal .pm-body').css('max-width', pgwModal.config.maxWidth);
            }

            // Content loaded by Ajax
            if (pgwModal.config.url) {
                if (pgwModal.config.loadingContent) {
                    $('#pgwModal .pm-content').html(pgwModal.config.loadingContent);
                }

                var ajaxOptions = {
                    'url' : obj.url,
                    'success' : function(data) {
                        pushContent(data);
                    },
                    'error' : function() {
                        $('#pgwModal .pm-content').html(pgwModal.config.errorContent);
                    }
                };

                if (pgwModal.config.ajaxOptions) {
                    ajaxOptions = $.extend({}, ajaxOptions, pgwModal.config.ajaxOptions);
                }

                $.ajax(ajaxOptions);

            // Content loaded by a html element
            } else if (pgwModal.config.target) {
                pushContent($(pgwModal.config.target).html());

            // Content loaded by a html object
            } else if (pgwModal.config.content) {
                pushContent(pgwModal.config.content);
            }

            // Close on escape
            if (pgwModal.config.closeOnEscape && pgwModal.config.closable) {
                $(document).bind('keyup.PgwModal', function(e) {
                    if (e.keyCode == 27) {
                        close();
                    }
                });
            }

            // Close on background click
            if (pgwModal.config.closeOnBackgroundClick && pgwModal.config.closable) {
                $('#pgwModal').bind('click.PgwModalBackdrop', function(e) {
                    var targetClass = $(e.target).hasClass('pm-container');
                    var targetId = $(e.target).attr('id');
                    if (targetClass || targetId == 'pgwModal') {
                        close();
                    }
                });
            }

            // Add CSS class on the body tag
            $('body').addClass('pgwModalOpen');

            var currentScrollbarWidth = getScrollbarWidth();
            if (currentScrollbarWidth > 0) {
                $('body').css('padding-right', currentScrollbarWidth);
            }

            // Resize event for reposition
            $(window).bind('resize.PgwModal', function() {
                reposition();
            });

            if(pgwModal.config.onOpen) pgwModal.config.onOpen();
            $(document).trigger('PgwModal::Open');
            return true;
        };

        // Choose the action
        if ((typeof obj == 'string') && (obj == 'close')) {
            return close();

        } else if ((typeof obj == 'string') && (obj == 'reposition')) {
            if(settings){
              return reposition(settings);
            } else {
              return reposition();
            }

        } else if ((typeof obj == 'string') && (obj == 'getData')) {
            return getData();

        } else if ((typeof obj == 'string') && (obj == 'isOpen')) {
            return isOpen();

        } else if ((typeof obj == 'object') && (obj.pushContent)) {
            return pushContent(obj.pushContent);

        } else if (typeof obj == 'object') {
            return open();
        }
    }
})(window.Zepto || window.jQuery);


/* photo.js */

/**
 * JILL10TH.photo
 */
JILL10TH.photo = function(elem, callback){
  this.elem = elem;
  this.callback = callback;
  this.init();
}

JILL10TH.photo.prototype = {

  init : function(){
    var self = this,
        img = new Image(),
        $this = $(self.elem);

    img.src = $('img', $this).attr('src');

    if(img.complete){
      imageLoaded();
    } else {
      $(img).load(imageLoaded);
    }

    function imageLoaded(){
      self.resize(function(){
        if(self.callback) self.callback();
      });
    }

  },

  resize : function(callback){
    var self = this,
        $this = $(self.elem),
        $img = $('img', $this),
        width = Number($img.attr('data-width')),
        height = Number($img.attr('data-height'));

    if(JILL10TH.top.isSP){
        width = '100%';
        height = 'auto';
    }
    $img.attr({'width':width, 'height':height});
    if(callback) callback();

  }
}


/**
 * JILL10TH.photos
 */
JILL10TH.photos = {

  data : [],

  isSP : null,

  total : 0,

  inc : 0,

  callback : null,

  init : function(callback){
    var self = this;
    if(callback) self.callback = callback;
    if(self.isSP == JILL10TH.top.isSP) return false;

    self.total = $('.photo', '#brandHistory').length;

    self.isSP = JILL10TH.top.isSP;
    $('.photo', $('#brandHistory')).each(function(i){
      self.data[i] = new JILL10TH.photo(this, self.photoLoaded);
    });
  },

  photoLoaded : function(){
    JILL10TH.photos.inc++;
    if(JILL10TH.photos.total <= JILL10TH.photos.inc){
      if(JILL10TH.photos.callback) JILL10TH.photos.callback();
    }
  },

  resize : function(){
    var self = this;
    for(var i=0, len=self.data.length; i < len; i++){
      self.data[i].resize();
    }
  }
}



JILL10TH.scrollNavi = {

  init : function(callback){
    var self = this;
    self.generateHTML(function(){
      self.setEvent();
      if(callback) callback();
    });
  },

  setEvent : function(){
    var self = this,
        $this = $('#scrollNavi');
    $('#scrollNavicon', $this).off('click').click(function(){
      $(this).is('.open') ? self.close() : self.open();
      return false;
    });
  },

  open : function(){
    var self = this,
        $this = $('#scrollNavi'),
        $navicon = $('#scrollNavicon'),
        $toggle = $('div', $this);
    $navicon.addClass('open');
    $toggle.stop().slideDown();
  },

  close : function(){
    var self = this,
        $this = $('#scrollNavi'),
        $navicon = $('#scrollNavicon'),
        $toggle = $('div', $this);
    $navicon.removeClass('open');
    $toggle.stop().slideUp();
  },

  resize : function(){
    var self = this,
        $this = $('#scrollNavi'),
        $navicon = $('#scrollNavicon'),
        $toggle = $('div', $this);
    if(JILL10TH.top.isSP){
      $navicon.is('.open') ? $toggle.css({'display':'block'}) : $toggle.css({'display':'none'});
    } else {
      $toggle.css({'display':'table'});
    }
  },

  generateHTML : function(callback){
    var $this = $('#scrollNavi'),
        $container = $('#container');
    $('.section', $container).each(function(){
      var id = $(this).attr('id'),
          title = $(this).attr('data-title'),
          forSpMenu = $(this).attr('data-for-sp-menu');
      $('ul', $this).append($('#tmpl-scroll-navi').tmpl({id:id, title:title?title:"", forSpMenu:forSpMenu}));
    });
    if(callback) callback();
  },

  changeClass : function(newClassName){
    $('#scrollNavi').removeClass(function(index, className) {
      return (className.match(/\bnaviColor-\S+/g) || []).join(' ');
    }).addClass(newClassName);
  }
}


/* section.js */

/**
 * JILL10TH.Section
 */

JILL10TH.Section = function(elem, logoColor){
  this.elem = elem ? elem : null;
  this.$scroller = null;
  this.id = '';
  this.diff = 100;
  this.height = 0;
  this.offsetTop = 0;
  this.is_inview = false;
  this.has_scroller = false;
  this.scrollerHeight = 0;
  this.scrollHeight = 0;  // スクロール量
  this.stopHeight = 0;    // 停止量
  this.delay = 0;
  this.logoColor = logoColor ? logoColor : '#fff';
  this.status = null;
}

JILL10TH.Section.prototype = {

  init : function(){
    var self = this,
        $this = $(self.elem);
    self.$scroller = $('.sectionScroller', $this);
    self.id = $this.attr('id');
    self.has_scroller = $('.sectionScroller', $this).length ? true : false;
    self.delay = $this.attr('data-delay') ? Number($this.attr('data-delay')) : 0;
    self.scrollerHeight = self.has_scroller ? self.$scroller.outerHeight() : 0;
    // self.update();
  },

  update : function(){
    var self = this,
        $this = $(self.elem);
    self.height = $this.height();
    self.scrollHeight = self.has_scroller && self.height < self.scrollerHeight ? self.scrollerHeight+self.delay : self.height+self.delay;
    self.stopHeight = self.scrollHeight -self.height;
  },

  moveY : function($elem, y){
    if($('html').is('.csstransforms')){
      $elem.css({'transform' : 'translateY(' + y + ')'});
    } else {
      $elem.css({'top' : y});
    }
  },

  moveScroller : function(myScrollTop){
    var self = this,
        $scroller = self.$scroller;
    // スクロール中（ストップ量の範囲内）
    if(myScrollTop <= 0 && -self.stopHeight < myScrollTop){
      self.moveY($scroller, myScrollTop + 'px');
    // スクロール済み
    } else if(myScrollTop <= 0) {
      self.moveY($scroller, -self.stopHeight + 'px');
    // 未スクロール
    } else {
      self.moveY($scroller, 0);
    }
  },

  inview : function(myScrollTop){
    var self = this,
        $this = $(self.elem);
    if(!$this.is('.inview')){
      $this.removeClass('outofview').addClass('inview')
      $this.show();
    }
    if(self.has_scroller) self.moveScroller(myScrollTop);
    if(self.scroll) self.scroll(myScrollTop);
    if(self.inviewCallback) self.inviewCallback();
  },

  outOfView : function(myScrollTop){
    var self = this,
        $this = $(self.elem);
    if(!$this.is('.outofview')){
      $this.removeClass('inview').addClass('outofview');
      if(self.outOfViewCallback) self.outOfViewCallback();
      $this.hide();
    }
    self.status = 'outofview';
  }
}


/**
 * JILL10TH.Sections
 */

JILL10TH.Sections = function(elem, readyFn){
  this.elem = elem;
  this.total = $('.section', $(this.elem)).length;
  this.data = [];
  this.requestID = null;
  this.height = 0;
  this.logoColor = null;
  this.sectionArray = [];
  this.isGenerated = false;
  this.isSP = JILL10TH.top.isSP;
  this.current = null;
  this.svg = null;
  this.scrollTop = null;
  this.scrolling = false;
  this.timer = null;
  this.readyFn = readyFn ? readyFn : null;
  this.init();
}

JILL10TH.Sections.prototype = {

  init : function(){
    var self = this;
    self.setDepth();
    self.setLayout();
    // self.setEvent();
  },

  clickAnchor : function(target, callback){
    var self = this,
        $target = $(target),
        $inview = $target.siblings('.inview'),
        $window = $(window),
        offsetTop = Number($target.attr('data-offset-top')),
        scrollTop = $(window).scrollTop();

    if(!$target.length) return false;

    // console.log('offsetTop : ' + offsetTop);
    // console.log('scrollTop : ' + scrollTop);

    function moved(){
      $window.scrollTop(offsetTop);
      self.startAnimationFrame();
      if(callback) callback();
    }

    self.stopAnimationFrame();
    $target.stop().show();

    if(offsetTop <= scrollTop){
      self.moveY($target, 0, true, moved);
    } else {
      self.moveY($inview, -$window.height() + 'px', true, moved);
    }
  },

  setEvent : function(){
    var self = this;
    // $(window).resize(function(){self.resize(self)});
  },

  setLayout : function(){
    var self = this;
    // for SP
    if(JILL10TH.top.isSP){
      if(self.readyFn) self.readyFn();
    // for PC
    } else {
      var self = this,
          $this = $(self.elem),
          $navi = $('#scrollNavi');

      $('.section', $this).each(function(index){
        var id = $(this).attr('id'),
            title = $(this).attr('data-title'),
            key = JILL10TH.top.getKeyByID(id);

        JILL10TH[key].init();
        // データに格納
        self.data.push(JILL10TH[key]);
      });
      self.resize(self, function(){
        if(self.readyFn) self.readyFn();
      });
    }
  },


  resize : function(self, callback){
    var self = self ? self : this,
        $this = $(self.elem);
    self.stopAnimationFrame();
    if(JILL10TH.top.isSP != self.isSP){
      self.isSP = JILL10TH.top.isSP;
      self.destroy();
      self.setDepth();
    }
    // for PC
    if(!JILL10TH.top.isSP){
      // PC 版のレイアウトを生成済み
      if(self.data.length){
        self.height = 0;
        $('.section', $this).each(function(index){
          var id = $(this).attr('id'),
              key = JILL10TH.top.getKeyByID(id),
              offsetTop = self.height;

          JILL10TH[key].update();
          JILL10TH[key].offsetTop = offsetTop;
          // データセット
          $(this).attr({'data-offset-top':self.height, 'data-scroll-height':JILL10TH[key].scrollHeight});
          // 高さを加算
          self.height += JILL10TH[key].scrollHeight;
        });
        $('#scroller').css({'height':self.height});
        self.startAnimationFrame(true);
        if(callback) callback();
      // PC 版のレイアウトをする
      } else {
        self.setLayout();
      }
    }
  },

  setDepth : function(){
    var self = this,
        $this = $(self.elem);
    $('.section', $this).each(function(index){
      $(this).css({'z-index':self.total - index});
    });
  },

  stopAnimationFrame : function(){
    var self = this;
    $('body').addClass('stop');
    cancelAnimationFrame(self.requestID);
    self.requestID = null;
  },

  startAnimationFrame : function(resize){
    var self = this,
        resize = resize ? true : false;
    self.stopAnimationFrame();
    $('body').removeClass('stop');
    self.scroll(self, resize);
  },

  moveY : function($elem, y, animation, callback){
    if($('html').is('.csstransforms')){
      style = {'transform' : 'translateY(' + y + ')'};
    } else {
      style = {'top' : y};
    }
    if(animation){
      $elem.stop().animate(style, 'fast', 'linear', function(){
        if(callback) callback();
      });
    } else {
      $elem.css(style);
    }
  },

  scroll : function(self, resize){
    var self = self ? self : this,
        $window = $(window),
        $navi = $('#scrollNavi'),
        winH = $window.height(),
        scrollTop = $window.scrollTop(),
        current = null,
        logoColor = '#fff',
        naviClass = '',
        resize = resize ? true : false;

    if($('body').is('.stop')) return false;

    // スクロール中の処理
    if(scrollTop != self.scrollTop || resize){
      self.scrollTop = scrollTop;
      self.scrolling = true;
      JILL10TH.tooltip.hide();
      $('.scrollBtn').css({'opacity':0});

      if(winH < scrollTop + 100){
        $('#header #footer').removeClass('hide');
      } else {
        $('#header #footer').addClass('hide');
      }

      for(var i=0, len=self.total; i < len; i++){
        var obj = self.data[i],
            myScrollTop = obj.offsetTop - scrollTop,
            $elem = $(obj.elem);

        // スクロール中（ストップ量を超えた && スクロール量の範囲内）
        if(myScrollTop < -obj.stopHeight && -obj.scrollHeight < myScrollTop){
          self.moveY($elem, (myScrollTop + obj.stopHeight) + 'px');
        // 待機（未スクロール〜ストップ量の範囲内）
        } else if(-obj.scrollHeight < myScrollTop){
          self.moveY($elem, 0);
        // スクロール済み
        } else {
          self.moveY($elem, -(winH+obj.diff) + 'px');
        }

        // inview
        if(myScrollTop < winH && -obj.scrollHeight < myScrollTop){
          obj.inview(myScrollTop);
        // outofview
        } else {
          $elem.removeClass('animation');
          obj.outOfView(myScrollTop);
        }

        // start animation
        if((myScrollTop < winH/2/* && 0 <= myScrollTop*/)/* || (-winH/2 - obj.stopHeight < myScrollTop  && myScrollTop <= 0)*/){
          // current = obj.id;
          if(!$elem.is('.animation')) $(obj.elem).addClass('animation');
        } else {
          if($elem.is('.animation')) $(obj.elem).removeClass('animation');
        }

        // set logo color
        if(myScrollTop <= 0){
          logoColor = obj.logoColor;
          naviClass = 'naviColor-' + obj.id;
        }
      }

      if(logoColor != self.logoColor){
        JILL10TH.top.changeLogoColor(logoColor);
        JILL10TH.scrollNavi.changeClass(naviClass);
        self.logoColor = logoColor;
      }

    // スクロールが止まったら行う処理
    } else if(self.scrolling) {
      self.scrolling = false;
      clearTimeout(self.timer);

      for(var i=0, len=self.total; i < len; i++){
        var obj = self.data[i],
            myScrollTop = obj.offsetTop - scrollTop,
            $elem = $(obj.elem);
        // start animation
        if((myScrollTop < winH/2/* && 0 <= myScrollTop*/)/* || (-winH/2 - obj.stopHeight < myScrollTop  && myScrollTop <= 0)*/){
          current = obj.id;
          // if(!$elem.is('.animation')) $(obj.elem).addClass('animation');
        } //else {
          //if($elem.is('.animation')) $(obj.elem).removeClass('animation');
        //}
      }

      if(self.current != current){
        $('.current', $navi).removeClass('current');
        $('a[href="#' + current + '"]', $navi).addClass('current');
        self.current = current;
      }
      // スクロール停止後、すこし後に行う処理
      // self.timer = setTimeout(function(){
      //   clearTimeout(self.timer);
      //   $('.scrollBtn').css({'opacity':.8});
      // }, 100);
    }

    self.requestID = requestAnimationFrame(function(){
      self.scroll(self)
    });
  },

  destroy : function(){
    var self = self ? self : this,
        $this = $(self.elem);
    $('.section', $this).each(function(){
      $(this).removeClass('inview').removeClass('outofview').removeClass('animation').attr({'style':""});
      $('.sectionScroller', $(this)).attr({'style':""});
    })
  }

}


JILL10TH.video = {

  player : null,

  ytID : "",

  init : function(){
    var self = this;

    self.ytID = $('#playerWrapper').attr('data-id');

    $('a', $('#playerWrapper')).click(function(){
      if(!JILL10TH.video.player){
        self.loadScript();
      }
      return false;
    })
  },

  loadScript : function(){
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  },

  setPlayer : function(){
    JILL10TH.video.player = new YT.Player('player', {
      height: '100%',
      width: '100%',
      videoId: JILL10TH.video.ytID,
      events: {
        'onReady': onPlayerReady
      },
      playerVars: {
        'rel': 0,
        'showinfo': 0
      }
    });
  },

  removeThumb : function(){
    var $a = $('a', $('#playerWrapper'));
    $a.stop().fadeTo('fast', 0, function(){
      $a.remove();
    });
  },

  stop : function(){
    // if(JILL10TH.video.player){
    //   JILL10TH.video.player.stopVideo();
    // }
  }
}

function onYouTubeIframeAPIReady() {
  JILL10TH.video.setPlayer();
}

function onPlayerReady(event) {
  event.target.playVideo();
  JILL10TH.video.removeThumb();
}


/**
 * JILL10th.tooltip
 */

JILL10TH.tooltip = {

  init : function(){
    var self = this;
    self.setEvent();
  },

  resize : function(){
    var self = this;
    self.setEvent();
  },

  setEvent : function(){
    var self = this,
        distance = 20,
        $body = $('body');
    $('.photo').off();
    // for SP
    if(JILL10TH.top.isSP){
      $('.photo').on({
        'click' : function(){
          var $img = $('img', $(this));
          $.pgwModal({
            content: $('#tmpl-sp-dialog').tmpl({title:$img.attr('alt'), thumb:$img.attr('src')}),
            closeContent: '×',
            maxWidth: 280
          });
          return false;
        }
      });
    // for PC
    } else {
      if($.pgwModal('isOpen')) $.pgwModal('close');
      $('.photo').on({
        'mouseenter' : function(e){
          var title = $('img', $(this)).attr('alt');
          if($('#tooltip').length){
            $('#tooltip').html($('#tmpl-tooltip').tmpl({title:title}).html());
          } else {
            $body.append($('#tmpl-tooltip').tmpl({title:title}));
          }
          $('#tooltip').stop().fadeTo('fast', 1).css({'top': e.clientY+distance, 'left': e.clientX+distance});
        },
        'mousemove' : function(e){
          $('#tooltip').stop().fadeTo(1,1).css({'top': e.clientY+distance, 'left': e.clientX+distance});
        },
        'mouseleave' : function(e){
          $('#tooltip').stop().fadeTo('fast', 0, function(){$(this).hide()});
        }
      });
    }
  },

  hide : function() {
    if($('#tooltip:visible').length) $('#tooltip').hide();
  }
}



/**
 * JILL10TH.Home
 */
JILL10TH.Home = new JILL10TH.Section('#home');


/**
 * JILL10TH.Introduction
 */
JILL10TH.Introduction = new JILL10TH.Section('#introduction');

/**
 * JILL10TH.Movie
 */
JILL10TH.Movie = new JILL10TH.Section('#movie');

JILL10TH.Movie.outOfViewCallback = function(){
  // console.log('callback');
  JILL10TH.video.stop();
}


/**
 * JILL10TH.Jill
 */
JILL10TH.Jill = new JILL10TH.Section('#jill');

/**
 * JILL10TH.Lindsey
 */
JILL10TH.Lindsey = new JILL10TH.Section('#lindsey', '#999');


/**
 * JILL10TH.Satoshi
 */
JILL10TH.Satoshi = new JILL10TH.Section('#satoshi', '#999');

/**
 * JILL10TH.Michiru
 */
JILL10TH.Michiru = new JILL10TH.Section('#michiru', '#999');


/**
 * JILL10TH.HistoryTitle
 */
 JILL10TH.HistoryTitle = new JILL10TH.Section('#historyTitle');


/**
 * JILL10TH.BrandHistory
 */
JILL10TH.BrandHistory = new JILL10TH.Section('#brandHistory');


/**
 * JILL10TH.Lip
 */
JILL10TH.Lip = new JILL10TH.Section('#lip');


/**
 * JILL10TH.Eyeshadow
 */
JILL10TH.Eyeshadow = new JILL10TH.Section('#eyeshadow');


/**
 * JILL10TH.Cheeek
 */
JILL10TH.Cheek = new JILL10TH.Section('#cheek');

/**
 * JILL10TH.Fragrance
 */
JILL10TH.Fragrance = new JILL10TH.Section('#fragrance');


/**
 * JILL10TH.ProductTitle
 */
JILL10TH.ProductTitle = new JILL10TH.Section('#productTitle');


/**
 * JILL10TH.Product
 */
JILL10TH.Product = new JILL10TH.Section('#product', '#999');


/**
 * JILL10TH.SpecialDesign
 */
JILL10TH.SpecialDesign = new JILL10TH.Section('#specialDesign', '#999');


/**
 * JILL10TH.Last
 */
JILL10TH.Last = new JILL10TH.Section('#last', '#fff');


/**
 * JILL10TH.top
 */
JILL10TH.top = {

  preloadImages : ['img_loading_logo.gif', 'ajax-loader.gif', 'img_home_main.jpg'],

  sections : null,

  resizeTimer : null,

  isSP : null,

  init : function(){
    var self = this,
        loadContents = ['preloadImages', 'setScroller', 'generateNavigation'],
        loaded = 0;

    function complete(){
      var $bar = $('.bar span', $('#loading'));
      loaded++;
      $bar.stop().animate({'width':(loaded / loadContents.length * 100) + '%'}, 'slow', function(){
        if(loadContents.length <= loaded) JILL10TH.top.loadComplete();
      });
    }

    self.isSP = self.checkDevice();
    self.loadImages(JILL10TH.top.preloadImages, complete);

    $(function(){
      JILL10TH.photos.init(function(){
        self.sections = new JILL10TH.Sections('#container', complete);
      });
      JILL10TH.scrollNavi.init(complete);
      JILL10TH.tooltip.init();
      JILL10TH.video.init();
    });
  },

  hashchange : function(callback){
    var self = this,
        hash = location.hash,
        target = (hash && hash.match(/#\/[a-z0-9]+/)) ? hash.replace(/\//g, '') : null;
    if(target){
      JILL10TH.top.sections.clickAnchor(target, callback);
    } else {
      if(callback) callback();
    }
  },

  loadComplete : function(){
    var self = this,
        $loading = $('#loading'),
        timer = null,
        delay = 500,
        hash = location.hash,
        scrollTarget = '';

    function showContents(){
      $loading.fadeTo('slow', 0, function(){
        $loading.remove();
      });
    }

    self.setEvent();

    timer = setTimeout(function(){
      $('body').removeClass('isLoading');
      self.hashchange(showContents);
    }, delay);
  },

  loadImages : function(array, callback){
    var total = array.length,
        loaded = 0,
        path = '/common/special/10th/img/';

    function complete(){
      loaded++;
      if(total <= loaded){
        if(callback) callback();
      }
    }

    for(var i=0, len=array.length; i<len; i++){
      var img = new Image();
      img.src = path + array[i];
      if(img.complete){
        complete();
      } else {
        $(img).load(function(){
          complete();
        });
      }
    }
  },

  checkOS : function(){
    if(navigator.platform.indexOf("Win") != -1){
      return 'win'
    } else {
      return 'mac';
    }
  },

  checkDevice : function(){
    if($(window).width() <= 768){
      return true;
    } else {
      return false;
    }
  },

  checkBrowser : function(){
    var ua = window.navigator.userAgent.toLowerCase();
    var ver = window.navigator.appVersion.toLowerCase();
    var name = 'unknown';

    if (ua.indexOf("msie") != -1){
        if (ver.indexOf("msie 6.") != -1){
            name = 'ie6';
        }else if (ver.indexOf("msie 7.") != -1){
            name = 'ie7';
        }else if (ver.indexOf("msie 8.") != -1){
            name = 'ie8';
        }else if (ver.indexOf("msie 9.") != -1){
            name = 'ie9';
        }else if (ver.indexOf("msie 10.") != -1){
            name = 'ie10';
        }else{
            name = 'ie';
        }
    }else if(ua.indexOf('trident/7') != -1){
        name = 'ie11';
    }else if (ua.indexOf('chrome') != -1){
        name = 'chrome';
    }else if (ua.indexOf('safari') != -1){
        name = 'safari';
    }else if (ua.indexOf('opera') != -1){
        name = 'opera';
    }else if (ua.indexOf('firefox') != -1){
        name = 'firefox';
    }
    return name;
  },

  setEvent : function(){
    var self = this;

    $('a.pageLink').click(function(){
      var target = $(this).attr('href');
      // for SP
      if(JILL10TH.top.isSP){
        var headerHeight = $('#header').outerHeight();
        $('html,body').stop().animate({'scrollTop':$(target).offset().top - headerHeight}, 'fast');
        JILL10TH.scrollNavi.close();
      // for PC
      } else {
        JILL10TH.top.sections.clickAnchor(target);
      }
      return false;
    });

    $(window).on({
      'hashchange' : function(){
        self.hashchange()
      },
      'resize' : function(){
        var isSP;
        clearTimeout(JILL10TH.top.resizeTimer);
        JILL10TH.top.resizeTimer = setTimeout(function(){
          isSP = self.checkDevice();
          if(isSP != self.isSP) self.isSP = isSP;
          JILL10TH.photos.resize();
          JILL10TH.top.sections.resize();
          JILL10TH.scrollNavi.resize();
          JILL10TH.tooltip.resize();
        }, 300);
      }
    });

    if(navigator.userAgent.match(/Trident\/7\./)) {
      $('body').on("mousewheel", function(event, delta){
          event.preventDefault();
          // var wheelDelta = event.wheelDelta;
          var wheelDelta = event.originalEvent.wheelDelta;
          var currentScrollPosition = window.pageYOffset;
          window.scrollTo(0, currentScrollPosition - wheelDelta);
      });
    }
  },

  changeLogoColor : function(color){
    var $headerLogo = $('#header .logo'),
        $footerLogo = $('#footer .logo'),
        color = color.replace('#', ''),
        timer = null;
    $('a', $headerLogo).append($('#tmpl-header-logo').tmpl({color:color}));
    $('span.logo-' + color, $headerLogo).stop().fadeTo('fast', 1, function(){
      $('span.logo-' + color, $headerLogo).siblings().remove();
    });

    $('a', $footerLogo).append($('#tmpl-footer-logo').tmpl({color:color}));
    $('span.logo-' + color, $footerLogo).stop().fadeTo('fast', 1, function(){
      $('span.logo-' + color, $footerLogo).siblings().remove();
    });
  },

  getKeyByID : function(id){
    return id.charAt(0).toUpperCase() + id.slice(1);
  }
}

JILL10TH.top.init();
