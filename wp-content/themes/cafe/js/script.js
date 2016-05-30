( function( $ ) {

	$(document).ready(function() {
		/*== Scroll to top ==*/
		$( 'a[href="#cafe-content"]' ).on( 'click', function( e ) {
			e.preventDefault();
			/* html - IE, FF, body - Chrome, Safari */
			$( 'html, body' ).animate({
				scrollTop: $( '#cafe-content' ).offset().top
			}, 555);
		});

		/*== Create custom select-menu ==*/
		$( 'select' ).each( function( key, val ) {
			var selectDiv = document.createElement( 'div' ); /* create div element */
			selectDiv.className = 'cafe-select-block';
			$( selectDiv ).mousemove( function() { /* reset selected class from choosed element */
				$( this ).find( '.cafe-option.cafe-selected' ).removeClass( 'selected' );
			});
			var mainSelect = $( val ); /* get select element */
			mainSelect.hide(); /* hide all options */
			var fakeSelect = document.createElement( 'div' );
			fakeSelect.className = 'cafe-select';
			fakeSelect.setAttribute( 'name', $( mainSelect ).attr( 'name' ) );
			var header = document.createElement( 'h1' );
			header.innerHTML = $( mainSelect ).find( 'option:selected' ).text();
			header.className = 'cafe-index-' + $( mainSelect )[0].selectedIndex;
			fakeSelect.appendChild( header ); /* add h1 element to select instrument */
			var counterOptions = 0;
			mainSelect.find( '*' ).each( function( k, v ) {
				var elem = document.createElement( 'div' );
				if ( v.tagName == 'OPTGROUP' ) {
					elem.className = 'cafe-optgroup'; /* create optgroup div */
					/* create headings for option group */
					var h1 = document.createElement( 'h1' );
					h1.innerHTML = $( v ).attr( 'label' );
					h1.className = 'cafe-optgroup-h1';
					elem.appendChild( h1 );
				} else {
					elem.className = 'cafe-option'; /* create option div */
					$( elem ).addClass( 'cafe-index-' + counterOptions++ );
					elem.innerHTML = $( v ).text(); /* set content of select item */
					elem.setAttribute( 'title', elem.innerHTML );
					elem.setAttribute( 'value', $( v ).attr( 'value' ) );
					/* options to do when click on elements */
					elem.onclick = function() {
						if ( ! ( $( this ).attr( 'class' ).indexOf( $( fakeSelect ).children( 'h1' ).attr( 'class' ) ) > 0 ) ) {
							/* h1 changes */
							$( fakeSelect ).children( 'h1' ).text( $( this ).text() );
							$( fakeSelect ).children( 'h1' ).attr( 'value', $( this ).attr( 'value' ) );
							$( fakeSelect ).children( 'h1' ).get( 0 ).className = $( this ).attr( 'class' ).match( /cafe-index-\d + /, 'g' ); /* get index */
							mainSelect.prop( 'selectedIndex', $( this ).attr( 'class' ).split( '-' )[1] ).change();
						}
						$( selectDiv ).hide();
					}
				}
				if ( $( v ).parent().get( 0 ).tagName == 'SELECT' ) { /* fisrt childs of select */
					selectDiv.appendChild( elem );
				} else {
					$( selectDiv ).children().last().append( elem );
				}
			});
			var hider = function( event ) {
					event = event || window.event; /* crossbrowser event */
				if ( ( event.target || event.srcElement ).className != 'cafe-optgroup-h1' && /* crossbrowser event.target */
				( event.target || event.srcElement ).className != 'cafe-optgroup' && 
				( event.target || event.srcElement ).className != 'cafe-select-block' ) {
					if ( clickCleaner ) {
						/* Hide select div */
						$( selectDiv ).fadeOut( 200 );
						$( this ).off( 'click', hider );
						/* Reset all selected elements */
						$( selectDiv ).trigger( 'mousemove' );
					}
					clickCleaner = true;
					event.preventDefault();
				}
			}
			var clickCleaner;
			$( fakeSelect ).on( 'mousedown', function() {
				/* Show/hide scripts */
				clickCleaner = false;
				$( selectDiv ).fadeIn( 200 );
				$( 'html' ).on( 'click', hider);
			});				
			fakeSelect.appendChild( selectDiv );
			$( val ).after( fakeSelect );
			$( selectDiv ).hide();
			/* archive-dropdown widget functional */
			$( '[name=archive-dropdown]' ).next( '.cafe-select' ).find( '.cafe-option' ).click( function () {
				location.href = $( this ).attr( 'value' );
			});
			/* category-dropdown widget functional */
			$( '#cat' ).next( '.cafe-select' ).find( '.cafe-option' ).click( function () {
				location.href = '?cat=' + $( this ).attr( 'value' );
			});
			$( '.cafe-select .cafe-option' ).click( function () {
				/*remove active option from init select*/
				$( this ).parent().parent().prev().find( 'option' ).removeAttr( 'selected' );
				/*add atrr selected to select*/
				var index = $(this).index();
				$( this ).parent().parent().prev().find( 'option' ).eq( index ).attr( 'selected', 'selected' );
			});
		});	

		/*== Radiobuttons ==*/
		$( 'input[type="radio"]' ).each( function() {
			$this = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {/* This input has a label associated with it */
				$label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="radio"]' ).addClass( 'radio1' );
		$( '.radio1' ).wrap( '<div class="cafe-radio">' );
		$( '.cafe-radio' ).click( function() {
			/* Reads the value of the selected item */
			$( '.cafe-radio' ).removeClass( 'active' );
			/* Remove all of the selection */
			if ( $( this ).attr( 'class' ) == 'cafe-radio' ) {
				$( this ).addClass( 'active' );
			}
			else {
				$( this ).removeClass( 'active' );
				$( this ).find( 'input' ).removeAttr( 'checked' );
			}
		});
		/* Hides default radiobuttons with css */
		$( 'input[type=radio]' ).css({'cursor':'pointer'});
		$( 'input[type=radio]' ).css({'opacity': 0});
		$( '.cafe-radio' ).wrap( '<div class="clear"></div>' );

		/*== Checkboxes ==*/
		$( 'input[type="checkbox"]' ).each( function() {
			$this = $( this );
			var $label = $( 'label[for="' + $this.attr( 'id' ) + '"]' );
			if ( $label.length > 0 ) {/* This input has a label associated with it */
				$label.after( '<div class="clear"></div>' );
			};
		});
		$( 'input[type="checkbox"]' ).addClass( 'check1' )
		$( '.check1' ).wrap( '<div class="cafe-check">' );
			$( '.cafe-check' ).click( function() {
			/*Reads the value of the selected item */
			if ( $( this ).attr( 'class' ) == 'cafe-check' ) {
				$( this ).addClass( 'active' );
			}
			else {
				$( this ).removeClass( 'active' );
			}
		});
		/* Hides default radiobuttons with css */
		$( 'input[type=checkbox]' ).css({'opacity': 0});
		$( 'input[type=checkbox]' ).css({'cursor':'pointer'});
		$( '.cafe-check' ).wrap( '<div class="clear"></div>' );

		/*== Clearbutton ==*/
		$( 'input[type="reset"]' ).click( function() {
			/* Clear all textfields and selects */
			$( 'input[type="text"]' ).each( function() {$( this ).val( '' );} );
			$( 'textarea' ).each( function() {$( this ).val( '' );} );
			$( 'select' ).each( function() { 
				$( this ).val( '' );
				$( '.cafe-seltext' ).text( 'Selected' ); 
			});
			/* Clear radiobuttons */
			$( 'input[type="radio"]' ).each( function() {
				$( this ).checked = false;
				if ( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			/* Clear checkboxes */
			$( 'input[type="checkbox"]' ).each( function() { 
				if ( $( this ).parent().hasClass( 'active' ) ) {
					$( this ).parent().removeClass( 'active' );
					$( this ).removeAttr( 'active' );
				}
			});
			/* Clear file input */
			$( 'input[type="file"]' ).each( function() {
				if ( $.browser.msie ) {
					$( this ).after( $( this ).clone( true ) ).remove(); /* create clone for ie as val ( '' )  doesn't work in it  */
				}
				 else {  
					$( this ).val( '' );
				}
				$( '.cafe-upload-file-status' ).text( script_loc.file_is_not_selected );
				$( '.cafe-upload-file-input' ).text( script_loc.choose_file );
			});
		});

		/*== Upload file ==*/
		if ( $( this ).find( 'input[type="file"]' ) ) {
			$( this ).find( 'input[type="file"]' ).each( function() {
				/* Create fake cafe-upload-file instrument */
				var fileInstrument = this;
				$( fileInstrument ).hide();
				$( fileInstrument ).after( '<div class="cafe-upload-file" name="' + $( fileInstrument ).attr( 'name' ) + '">' + 
					'<div class="cafe-upload-file-input" />' + '<div class="cafe-upload-file-status" /></div>' );
				/* Set starting values for file-input and file-status */
				var fileInput = $( fileInstrument ).next().find( '.cafe-upload-file-input' );
				var fileStatus = $( fileInstrument ).next().find( '.cafe-upload-file-status' );
				$( fileInput ).text( script_loc.choose_file );
				$( fileStatus ).text( $( fileInstrument ).val() == '' ? script_loc.file_is_not_selected : $( fileInstrument ).val() );
				/* Change file path when file is loaded */
				$( fileInstrument ).on( 'change', function() {
					var filePathText = this;
					/* contain text of file path to fake cafe-upload-file instrument */
					$( fileStatus ).text( $( this ).val() == '' ? 'File is not selected.' : function() {
						var filePath = $( filePathText ).val().split( '\\' ).pop();
						if ( filePath.length > 26 ) {
							return filePath.substring( 0, 15 ) + '...' + filePath.substring( filePath.length-8, filePath.length );
						} else {
							return filePath;
						}
					});
				});
				$( fileInput.parent() ).on( 'mousedown', function() {
					$( fileInstrument ).trigger( 'click' );
				});
			});
		}	
	});
} )( jQuery );		

( function( $ ) {
	$(document).ready(function() {
		/* Clear select elements */
		$( 'input:reset' ).click( function() {
			/* Clear original selects. */
			$( 'select' ).each(function() {
				/* set path */
				var clear_select = $( this ).find( "option:first" );
				var clear_selected_select = $( this ).find( "option[selected]" );
				/* clear active opt */
				$( clear_selected_select ).removeAttr( 'selected' );
				$( clear_select ).attr( 'selected', 'selected' );
			});
			/* Clear custom selects. */
			$( 'select' ).each(function() {
				/* set path */
				var clear_select = $( this ).find( "option:first" );
				var clear_selected_select = $( this ).next( ".cafe-select" ).find( "h1:first" );
				/* clear active opt */
				$( clear_selected_select ).text( clear_select.text() );
			});
		});
	});
} )( jQuery );