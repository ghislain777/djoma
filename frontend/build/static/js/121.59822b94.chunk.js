(this["webpackJsonpmatx-react-pro"]=this["webpackJsonpmatx-react-pro"]||[]).push([[121],{3078:function(e,a,t){"use strict";t.r(a);var m=t(12),r=t(0),s=t.n(r),l=t(46),c=t(1201),n=t(2302),i=t(144),p=t(95),o=t(44),E=t.n(o);a.default=()=>{const e=Object(r.useState)(!0),a=Object(m.a)(e,2),t=a[0],o=a[1],b=Object(r.useState)([]),u=Object(m.a)(b,2),d=u[0],g=u[1];return Object(r.useEffect)(()=>(E.a.get("/api/user/all").then(({data:e})=>{t&&g(e)}),()=>o(!1)),[t]),s.a.createElement("div",{className:"m-sm-30"},s.a.createElement("div",{className:"mb-sm-30"},s.a.createElement(p.b,{routeSegments:[{name:"Pages",path:"/pages"},{name:"User List 2"}]})),s.a.createElement(l.a,{container:!0,spacing:3},d.map((e,a)=>{var t;return s.a.createElement(l.a,{key:e.id,item:!0,sm:6,xs:12},s.a.createElement(c.a,null,s.a.createElement("div",{className:"p-6 flex flex-wrap justify-between items-center m--2"},s.a.createElement("div",{className:"flex items-center m-2"},s.a.createElement(n.a,{className:"h-48 w-48",src:e.imgUrl}),s.a.createElement("div",{className:"ml-4"},s.a.createElement("h5",{className:"m-0"},e.name),s.a.createElement("p",{className:"mb-0 mt-2 text-muted font-normal capitalize"},null===(t=e.company)||void 0===t?void 0:t.toLowerCase()))),s.a.createElement("div",{className:"flex m-2"},s.a.createElement(i.a,{size:"small",className:"bg-light-primary hover-bg-primary text-primary px-5 mr-1"},"CHAT"),s.a.createElement(i.a,{size:"small",className:"bg-light-primary hover-bg-primary text-primary px-5"},"PROFILE")))))})))}}}]);