﻿(function(p){"object"==typeof exports&&"object"==typeof module?p(require("../../lib/codemirror")):"function"==typeof define&&define.amd?define(["../../lib/codemirror"],p):p(CodeMirror)})(function(p){p.defineMode("javascript",function(oa,t){function q(a,c,e){E=a;I=e;return c}function w(a,c){var e=a.next();if('"'==e||"'"==e)return c.tokenize=pa(e),c.tokenize(a,c);if("."==e&&a.match(/^\d+(?:[eE][+\-]?\d+)?/))return q("number","number");if("."==e&&a.match(".."))return q("spread","meta");if(/[\[\]{}\(\),;\:\.]/.test(e))return q(e);