(this["webpackJsonpxxx-swap"]=this["webpackJsonpxxx-swap"]||[]).push([[3],{803:function(t,e,n){"use strict";n.d(e,"a",(function(){return r})),n.d(e,"f",(function(){return x})),n.d(e,"g",(function(){return C})),n.d(e,"d",(function(){return k})),n.d(e,"e",(function(){return m})),n.d(e,"c",(function(){return D}));var r,c=n(3),a=n.n(c),u=n(1),o=n(9),s=n(12),i=n(2),b=n(15),f=n.n(b),O=n(39),j=n(57),l=n(64),d=n(17),p=n(37),v=n(133),S=n(113),h=n(398),w=function(){var t=Object(i.useState)(Date.now()),e=Object(s.a)(t,2),n=e[0],r=e[1];return{lastUpdated:n,previousLastUpdated:Object(h.a)(n),setLastUpdated:Object(i.useCallback)((function(){r(Date.now())}),[r])}};!function(t){t.NOT_FETCHED="not-fetched",t.SUCCESS="success",t.FAILED="failed"}(r||(r={}));var E=function(t,e){var n=r.NOT_FETCHED,c=r.SUCCESS,b=r.FAILED,O=Object(i.useState)({balance:p.c,fetchStatus:n}),d=Object(s.a)(O,2),v=d[0],h=d[1],w=Object(j.c)().account,E=Object(S.a)().fastRefresh;return Object(i.useEffect)((function(){(w||e)&&function(){var n=Object(o.a)(a.a.mark((function n(){var r,o;return a.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return r=Object(l.b)(t),n.prev=1,n.next=4,r.balanceOf(e||w);case 4:o=n.sent,h({balance:new f.a(o.toString()),fetchStatus:c}),n.next=12;break;case 8:n.prev=8,n.t0=n.catch(1),console.error(n.t0),h((function(t){return Object(u.a)(Object(u.a)({},t),{},{fetchStatus:b})}));case 12:case"end":return n.stop()}}),n,null,[[1,8]])})));return function(){return n.apply(this,arguments)}}()()}),[w,t,E,e,c,b]),v},x=function(){var t=Object(S.a)().slowRefresh,e=Object(i.useState)(),n=Object(s.a)(e,2),c=n[0],b=n[1],j=function(){var t=Object(d.e)(),e=r.NOT_FETCHED,n=r.SUCCESS,c=r.FAILED,b=Object(i.useState)({balance:p.c,fetchStatus:e}),j=Object(s.a)(b,2),v=j[0],h=j[1],w=Object(S.a)().fastRefresh;return Object(i.useEffect)((function(){!function(){var e=Object(o.a)(a.a.mark((function e(){var r,o,s,i;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:return r=Object(l.b)(t),e.prev=1,o=O.o.map((function(t){return r.balanceOf(t)})),e.next=5,Promise.all(o);case 5:s=e.sent,i=new f.a(0),s.forEach((function(t){i=i.plus(t.toString())})),h({balance:i,fetchStatus:n}),e.next=15;break;case 11:e.prev=11,e.t0=e.catch(1),console.error(e.t0),h((function(t){return Object(u.a)(Object(u.a)({},t),{},{fetchStatus:c})}));case 15:case"end":return e.stop()}}),e,null,[[1,11]])})));return function(){return e.apply(this,arguments)}}()()}),[w,n,c,t]),v}(),v=j.balance,h=j.fetchStatus;return Object(i.useEffect)((function(){function t(){return(t=Object(o.a)(a.a.mark((function t(){var e,n;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=Object(l.d)(),t.next=3,e.totalSupply();case 3:n=t.sent,h===r.SUCCESS&&b(new f.a(n.toString()).minus(v));case 5:case"end":return t.stop()}}),t)})))).apply(this,arguments)}!function(){t.apply(this,arguments)}()}),[t,h,v]),c},C=function(){var t=Object(S.a)().slowRefresh,e=Object(i.useState)(),n=Object(s.a)(e,2),r=n[0],c=n[1];return Object(i.useEffect)((function(){function t(){return(t=Object(o.a)(a.a.mark((function t(){var e,n;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=Object(l.w)(),t.next=3,e.totalSupply();case 3:n=t.sent,c(new f.a(n.toString()));case 5:case"end":return t.stop()}}),t)})))).apply(this,arguments)}!function(){t.apply(this,arguments)}()}),[t]),r},k=function(){var t=Object(i.useState)(p.c),e=Object(s.a)(t,2),n=e[0],r=e[1],c=Object(S.a)().slowRefresh;return Object(i.useEffect)((function(){(function(){var t=Object(o.a)(a.a.mark((function t(){var e,n;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=Object(l.d)(),t.next=3,e.totalBurned();case 3:n=t.sent,r(new f.a(n.toString()));case 5:case"end":return t.stop()}}),t)})));return function(){return t.apply(this,arguments)}})()()}),[c]),n},m=function(){var t=Object(i.useState)(r.NOT_FETCHED),e=Object(s.a)(t,2),n=e[0],c=e[1],u=Object(i.useState)(p.c),b=Object(s.a)(u,2),O=b[0],l=b[1],d=Object(j.c)().account,S=w(),h=S.lastUpdated,E=S.setLastUpdated;return Object(i.useEffect)((function(){d&&function(){var t=Object(o.a)(a.a.mark((function t(){var e;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,v.a.getBalance(d);case 3:e=t.sent,l(new f.a(e.toString())),c(r.SUCCESS),t.next=11;break;case 8:t.prev=8,t.t0=t.catch(0),c(r.FAILED);case 11:case"end":return t.stop()}}),t,null,[[0,8]])})));return function(){return t.apply(this,arguments)}}()()}),[d,h,l,c]),{balance:O,fetchStatus:n,refresh:E}},D=function(){return E(Object(d.e)())};e.b=E},804:function(t,e,n){"use strict";n.d(e,"f",(function(){return m})),n.d(e,"e",(function(){return D})),n.d(e,"i",(function(){return L})),n.d(e,"j",(function(){return N})),n.d(e,"h",(function(){return y})),n.d(e,"g",(function(){return _})),n.d(e,"a",(function(){return F})),n.d(e,"b",(function(){return T})),n.d(e,"d",(function(){return U})),n.d(e,"c",(function(){return I}));var r=n(1),c=n(3),a=n.n(c),u=n(11),o=n(9),s=n(12),i=n(2),b=n(32),f=n(96),O=n(65),j=n(7),l=n(132),d=n(67),p=n(57),v=n(40),S=n(229),h=n(224),w=n(113),E=n(395),x=n(22),C=n(256),k=n(228),m=function(){var t=Object(d.b)(),e=Object(w.a)().slowRefresh,n=Object(p.c)().account;Object(i.useEffect)((function(){n&&t(Object(E.d)(n))}),[t,e,n])},D=function(t){var e=Object(d.b)(),n=Object(w.a)().slowRefresh,r=Object(p.c)().account;Object(i.useEffect)((function(){r&&t&&e(Object(E.d)(r))}),[e,n,r,t])},L=function(){return Object(b.c)((function(t){return t.nfts}))},N=function(){var t=L().user;return{loaded:t.loaded,data:t.data.filter((function(t){return t.properties.owner_status===x.b.NORMAL}))}},y=function(t,e){return L().market.data.find((function(n){var r,c;return Number(null===(r=n.metadata)||void 0===r||null===(c=r.properties)||void 0===c?void 0:c.token_id)===Number(t)&&"".concat(e).toLowerCase()===n.nft.toLowerCase()}))},_=function(t,e){var n=L().user;return(null===n||void 0===n?void 0:n.data)?n.data.find((function(n){return Number(n.properties.token_id)===Number(t)&&"".concat(e).toLowerCase()===n.properties.token.toLowerCase()})):null},F=function(t,e){var n=Object(p.c)().account,r=Object(d.b)(),c=L().market,b=Object(i.useState)(""),f=Object(s.a)(b,2),O=f[0],j=f[1],l=Object(i.useState)(h.b.NOT_FETCHED),S=Object(s.a)(l,2),w=S[0],x=S[1],k=Object(i.useCallback)(function(){var e=Object(o.a)(a.a.mark((function e(o){var i,b,f,O,j,l,d,p,S,w,k,m,D,L,N,y,_,F,T,A,g,U;return a.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(x(h.b.LOADING),b=(i=c||{}).data,f=i.limit,O=i.loadEnd,j=i.total,l=JSON.parse(t),d=l.sort,p=l.currency,S=l.search,w=l.nft,k=l.isOwner,m=l.contract,D=l.contracts,!o){e.next=7;break}r(Object(E.f)({refresh:o,data:[],total:j})),e.next=10;break;case 7:if(!O){e.next=10;break}return x(h.b.DATA_END),e.abrupt("return");case 10:return L=o?0:(null===b||void 0===b?void 0:b.length)||0,N=k?"".concat(n).toLowerCase():"",r(Object(E.h)(!0)),y=S?Object(v.h)(S)?["seller",S.toLowerCase()]:(Number(S),["token_id",S]):["",""],_=Object(s.a)(y,2),F=_[0],T=_[1],e.prev=14,e.next=17,Object(C.a)(Object(u.a)({limit:f,sort:d,contract:null===m||void 0===m?void 0:m.toLowerCase(),"metadata.properties.nft":null===w||void 0===w?void 0:w.toLowerCase(),currency:null===p||void 0===p?void 0:p.toLowerCase(),offset:L,seller:N,contracts:null===D||void 0===D?void 0:D.map((function(t){return null===t||void 0===t?void 0:t.toLowerCase()}))},F,T));case 17:A=e.sent,g=A.data,U=A.total,r(Object(E.f)({data:g,total:U,refresh:o})),x(h.b.SUCCESS),e.next=27;break;case 24:e.prev=24,e.t0=e.catch(14),x(h.b.FAILED);case 27:n&&r(Object(E.b)(n));case 28:case"end":return e.stop()}}),e,null,[[14,24]])})));return function(t){return e.apply(this,arguments)}}(),[c,t,n,r]);return Object(i.useEffect)((function(){if(w===h.b.NOT_FETCHED||t!==O){if(j(t),!e)return;x(h.b.LOADING),k(!0)}}),[w,t,O,e,k]),{fetchData:k,fetchState:w,setFetchState:x}},T=function(t){var e=Object(p.c)().account,n=Object(d.b)(),r=L().marketHistory,c=Object(i.useState)(""),u=Object(s.a)(c,2),b=u[0],f=u[1],O=Object(i.useState)(h.b.NOT_FETCHED),j=Object(s.a)(O,2),l=j[0],S=j[1],w=Object(i.useCallback)(function(){var c=Object(o.a)(a.a.mark((function c(u){var o,i,b,f,O,j,l,d,p,w,x,k,m,D,L,N,y,_,F,T;return a.a.wrap((function(c){for(;;)switch(c.prev=c.next){case 0:if(S(h.b.LOADING),i=(o=r||{}).data,b=o.limit,f=o.loadEnd,O=o.total,j=JSON.parse(t),l=j.sort,d=j.currency,p=j.search,w=j.nft,x=j.isOwner,k=j.time,m=j.contract,D=j.contracts,!u){c.next=7;break}n(Object(E.g)({refresh:u,data:[],total:O})),c.next=10;break;case 7:if(!f){c.next=10;break}return S(h.b.DATA_END),c.abrupt("return");case 10:return L=u?0:(null===i||void 0===i?void 0:i.length)||0,x?e:"",n(Object(E.h)(!0)),N=p?Object(v.h)(p)?["seller",p]:(Number(p),["token_id",p]):["",""],y=Object(s.a)(N,2),y[0],y[1],c.prev=14,c.next=17,Object(C.a)({limit:b,sort:l,contract:null===m||void 0===m?void 0:m.toLowerCase(),"metadata.properties.nft":null===w||void 0===w?void 0:w.toLowerCase(),currency:null===d||void 0===d?void 0:d.toLowerCase(),contracts:null===D||void 0===D?void 0:D.map((function(t){return null===t||void 0===t?void 0:t.toLowerCase()})),offset:L,final_time_gt:k,state:1});case 17:_=c.sent,F=_.data,T=_.total,n(Object(E.g)({data:F,total:T,refresh:u})),S(h.b.SUCCESS),c.next=27;break;case 24:c.prev=24,c.t0=c.catch(14),S(h.b.FAILED);case 27:e&&n(Object(E.b)(e));case 28:case"end":return c.stop()}}),c,null,[[14,24]])})));return function(t){return c.apply(this,arguments)}}(),[r,t,e,n]);return Object(i.useEffect)((function(){(l===h.b.NOT_FETCHED||t!==b)&&(f(t),S(h.b.LOADING),w(!0))}),[l,t,b,w]),{fetchData:w,fetchState:l,setFetchState:S}},A=function(){var t=Object(o.a)(a.a.mark((function t(e,n,c){var u,o,i,b,O,l,d;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Object(C.a)({contract:null===e||void 0===e?void 0:e.toLowerCase(),token_id:n});case 2:if((o=t.sent).total){t.next=5;break}return t.abrupt("return",null);case 5:if(c){t.next=7;break}return t.abrupt("return",o.data[0]);case 7:return t.next=9,Object(k.d)(c);case 9:return i=t.sent,t.next=12,Object(k.b)(c,[null===(u=o.data[0])||void 0===u?void 0:u.metadata]);case 12:return b=t.sent,O=Object(s.a)(b,1),l=O[0],d=i.find((function(t){return o.data[0].currency.toLowerCase()===t.currency.toLowerCase()}))||{allowance:f.a.constants.MaxUint256.toHexString(),currencySymbol:j.e.symbol},t.abrupt("return",Object(r.a)(Object(r.a)(Object(r.a)({},o.data[0]),d),l));case 17:case"end":return t.stop()}}),t)})));return function(e,n,r){return t.apply(this,arguments)}}(),g=function(){var t=Object(o.a)(a.a.mark((function t(e,n,c){var u,o,i,b,f,j,l,d;return a.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:if(u=Object(O.e)(e),o=null,!u){t.next=8;break}return t.next=5,Object(S.b)(e,[n]);case 5:o=t.sent,t.next=11;break;case 8:return t.next=10,Object(S.a)(e,[n]);case 10:o=t.sent;case 11:if(!o||!o.length){t.next=25;break}if(c){t.next=14;break}return t.abrupt("return",o[0]);case 14:return t.next=16,Object(k.b)(c,[o[0]]);case 16:return i=t.sent,b=Object(s.a)(i,1),f=b[0],t.next=21,Object(C.d)([o[0]]);case 21:return j=t.sent,l=Object(s.a)(j,1),d=l[0],t.abrupt("return",Object(r.a)(Object(r.a)(Object(r.a)({},o[0]),f),d));case 25:return t.abrupt("return",null);case 26:case"end":return t.stop()}}),t)})));return function(e,n,r){return t.apply(this,arguments)}}(),U=function(t,e,n){var r=Object(i.useState)(h.b.NOT_FETCHED),c=Object(s.a)(r,2),u=c[0],b=c[1],f=Object(i.useState)(null),O=Object(s.a)(f,2),j=O[0],d=O[1],v=Object(i.useState)(null),S=Object(s.a)(v,2),E=S[0],x=S[1],C=Object(i.useState)(null),k=Object(s.a)(C,2),m=k[0],D=k[1],L=Object(p.c)().account,N=Object(i.useState)(""),y=Object(s.a)(N,2),_=y[0],F=y[1],T=Object(w.a)().fastRefresh,U=Object(i.useCallback)(Object(o.a)(a.a.mark((function n(){var r,c;return a.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return u===h.b.SUCCESS?b(h.b.REFRESH):b(h.b.LOADING),n.prev=1,n.next=4,A(t,e,L);case 4:if(!(r=n.sent)){n.next=10;break}return x(r),d(l.a.MARKET),b(h.b.SUCCESS),n.abrupt("return");case 10:return n.next=12,g(t,e,L);case 12:if(!(c=n.sent)){n.next=18;break}return D(c),d(l.a.INFO),b(h.b.SUCCESS),n.abrupt("return");case 18:n.next=24;break;case 20:n.prev=20,n.t0=n.catch(1),console.error(n.t0),b(h.b.FAILED);case 24:case"end":return n.stop()}}),n,null,[[1,20]])}))),[u,t,e,L]);return Object(i.useEffect)((function(){var r="".concat(e,"_").concat(t,"_").concat(n,"_").concat(T,"_").concat(L);e&&t&&r!==_&&(F(r),U())}),[U,t,e,n,_,T,L]),{fetchData:U,dataType:j,marketNftInfo:E,nftInfo:m,fetchState:u,setFetchState:b}},I=function(t,e){var n=Object(i.useState)(h.b.NOT_FETCHED),r=Object(s.a)(n,2),c=r[0],u=r[1],b=Object(i.useState)(null),f=Object(s.a)(b,2),O=f[0],j=f[1],l=Object(i.useCallback)(Object(o.a)(a.a.mark((function n(){var r,c;return a.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return u(h.b.LOADING),n.prev=1,n.next=4,Object(C.a)({limit:500,sort:"final_time",contract:null===t||void 0===t?void 0:t.toLowerCase(),token_id:e,state:1});case 4:r=n.sent,c=r.data,r.total,j(c),u(h.b.SUCCESS),n.next=15;break;case 11:n.prev=11,n.t0=n.catch(1),console.error(n.t0),u(h.b.FAILED);case 15:case"end":return n.stop()}}),n,null,[[1,11]])}))),[t,e]);return Object(i.useEffect)((function(){e&&t&&l()}),[l,t,e]),{fetchData:l,historyData:O,fetchState:c,setFetchState:u}}},814:function(t,e,n){"use strict";n.d(e,"b",(function(){return i})),n.d(e,"e",(function(){return b})),n.d(e,"d",(function(){return f})),n.d(e,"a",(function(){return O})),n.d(e,"c",(function(){return j})),n.d(e,"f",(function(){return l})),n.d(e,"g",(function(){return d}));var r=n(2),c=n(57),a=n(32),u=n(67),o=n(401),s=n(22),i=function(){var t=Object(u.b)(),e=Object(c.c)().account;Object(r.useEffect)((function(){e&&t(Object(o.c)(e))}),[t,e])},b=function(){var t=Object(u.b)(),e=Object(c.c)().account;Object(r.useEffect)((function(){e&&t(Object(o.e)(e))}),[t,e])},f=function(){var t=Object(u.b)();Object(r.useEffect)((function(){t(Object(o.f)())}),[t])},O=function(){var t=Object(u.b)();Object(r.useEffect)((function(){t(Object(o.b)())}),[t])},j=function(t){var e=Object(u.b)();Object(r.useEffect)((function(){t===s.c.DSGAV&&e(Object(o.d)()),t===s.c.DSGYC&&e(Object(o.g)())}),[e,t])},l=function(){return Object(a.c)((function(t){return t.pickNft}))},d=function(t){var e=l();return e[t]?e[t]:e[s.c.DSGAV]}},932:function(t,e,n){"use strict";n.d(e,"a",(function(){return i}));var r=n(3),c=n.n(r),a=n(9),u=n(2),o=n(96),s=(n(17),n(56)),i=function(t){var e=Object(s.f)(t);return{onApprove:Object(u.useCallback)(function(){var t=Object(a.a)(c.a.mark((function t(n){var r,a;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.prev=0,t.next=3,e.approve(n,o.a.constants.MaxUint256);case 3:return r=t.sent,t.next=6,r.wait();case 6:return a=t.sent,t.abrupt("return",a.status);case 10:return t.prev=10,t.t0=t.catch(0),t.abrupt("return",!1);case 13:case"end":return t.stop()}}),t,null,[[0,10]])})));return function(e){return t.apply(this,arguments)}}(),[e])}}}}]);
//# sourceMappingURL=3.99a07a80.chunk.js.map