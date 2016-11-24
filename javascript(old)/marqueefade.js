
/* 
   Rotating Fade Marquee
   Version 1.0
   November 14, 2011

   Will Bontrager Software, LLC
   http://www.willmaster.com/
   Copyright 2011 Will Bontrager Software, LLC

   This software is provided "AS IS," without 
   any warranty of any kind, without even any 
   implied warranty such as merchantability 
   or fitness for a particular purpose.
   Will Bontrager Software, LLC grants 
   you a royalty free license to use this 
   software provided this notice appears on 
   all copies. 
*/

// Leave the next line as is (customization is further below):
var RM_content = new Array();

////////////////////////////////////////////////////////////
//
// Customization section.
//
// Three places to customize.
//
// Place One:
// Specify the content for each message, one per line, between 
//    quotation marks and parenthesis. Example (with ______ 
//    representing the content):
//       RM_content.push("______");
//    Content may contain HTML code (like links and CSS), even 
//    image tags.
// If the content itself contains quotation marks, precede 
//    each quotation mark with a backslash character. 
//    Example: He said, \"five!\"

RM_content.push("Join today for free!");
RM_content.push("Play competitively with people from around the globe!");

// Place Two:
// Specify the number of seconds to pause between displaying 
//    one marquee and the next. A decimal number is acceptable.

var RM_PauseBetweenEach = 2.5;


// Place Three:
// Transitions are from 100% opacity to 0%, then from 0% to 100%.
//
// Two transition preferences can be specified. The number of 
//    transition steps per fade and how fast the steps shall 
//    occur.
// For the steps, the larger the number, the smoother and slower 
//    the transition.
// For the speed, the lower the number the faster the transition.

var RM_TransitionSteps = 25; // Number of steps per fade.
var RM_TransitionSpeed = 40; // How fast the steps shall occur.


// End of customization section.
////////////////////////////////////////////////////////////
RM_TransitionSteps = parseInt( (100 / RM_TransitionSteps) + .5 );
var RMlastPointer = RM_content.length - 1;
var RMopacity = 100;
var RMpointer = 0;
var RMfader;
var RMdiv;
var RMie;

function RM_StartRotateMarquee() {
RMdiv = document.getElementById("RM_FadeInOutContentDiv");
RMie = (RMdiv.filters) ? true : false;
RMdiv.innerHTML = RM_content[RMpointer];
setTimeout( "RM_NextContent()", parseInt(RM_PauseBetweenEach*1000) );
}

function RM_NewOpacity() {
if( RMie ) { RMdiv.filters.alpha.opacity = RMopacity; }
else { RMdiv.style.opacity = RMopacity/100; }
}

function RM_FadeOut() {
RMopacity -= RM_TransitionSteps;
if( RMopacity < 1 ) { RMopacity = 0; }
RM_NewOpacity(RMopacity);
if( RMopacity < 1 ) { 
   clearInterval(RMfader);
   RM_SwitchContent();
   }
}

function RM_FadeIn() {
RMopacity += RM_TransitionSteps;
if( RMopacity > 99 ) { RMopacity = 100; }
RM_NewOpacity(RMopacity);
if( RMopacity > 99 ) {
   clearInterval(RMfader);
   setTimeout( "RM_NextContent()", parseInt(RM_PauseBetweenEach*1000) );
   }
}

function RM_NextContent() {
RMfader = setInterval( "RM_FadeOut()", parseInt(RM_TransitionSpeed) );
}

function RM_SwitchContent() {
RMpointer++;
if( RMpointer > RMlastPointer ) { RMpointer = 0; }
RMdiv.innerHTML = RM_content[RMpointer];
RMfader = setInterval( "RM_FadeIn()", parseInt(RM_TransitionSpeed) );
}

function RM_AddOnloadEvent(f) {
if(typeof window.onload != 'function') { window.onload = f; }
else {
   var cache = window.onload;
   window.onload = function() {
      if(cache) { cache(); }
      f();
      };
   }
}
RM_AddOnloadEvent(RM_StartRotateMarquee);

