"use strict";(self["webpackChunkfutura"]=self["webpackChunkfutura"]||[]).push([[511],{9394:(e,t,n)=>{n.r(t),n.d(t,{default:()=>G});var o=n(3673);function s(e,t,n,s,i,a){const l=(0,o.up)("Movile"),c=(0,o.up)("Desktop");return(0,o.wg)(),(0,o.iD)(o.HY,null,["xs"===e.$q.screen.name?((0,o.wg)(),(0,o.j4)(l,{key:0,class:"movile"})):(0,o.kq)("",!0),"xs"!==e.$q.screen.name?((0,o.wg)(),(0,o.j4)(c,{key:1,class:"desktop"})):(0,o.kq)("",!0)],64)}function i(e,t,n,s,i,a){const l=(0,o.up)("MainContent");return(0,o.wg)(),(0,o.iD)("div",null,[(0,o.Wm)(l,{class:"main-content"})])}var a=n(2323);const l=e=>((0,o.dD)("data-v-9330a9fe"),e=e(),(0,o.Cn)(),e),c={class:"container"},u=l((()=>(0,o._)("div",{class:"content-title"},[(0,o._)("p",{class:"title"},"Dínos que quieres hacer")],-1))),d=l((()=>(0,o._)("p",{class:"message"},"¿Qué buscas? ¿Cuál es tu objetivo?",-1)));function r(e,t,n,s,i,l){const r=(0,o.up)("q-icon"),m=(0,o.up)("q-radio"),p=(0,o.up)("q-btn");return(0,o.wg)(),(0,o.iD)("div",c,[(0,o._)("div",null,[(0,o.Wm)(r,{class:"icon-back",name:"arrow_back",onClick:t[0]||(t[0]=t=>e.$router.push({path:"/choose"}))})]),u,d,((0,o.wg)(!0),(0,o.iD)(o.HY,null,(0,o.Ko)(e.questionsList,(n=>((0,o.wg)(),(0,o.iD)("div",{class:"question-container",key:n.id},[(0,o.Wm)(m,{val:n.id,modelValue:e.selection,"onUpdate:modelValue":t[1]||(t[1]=t=>e.selection=t),color:"light-blue-13",dark:"",class:"term"},{default:(0,o.w5)((()=>[(0,o.Uk)((0,a.zw)(n.text),1)])),_:2},1032,["val","modelValue"])])))),128)),(0,o.Wm)(p,{disable:"selection === 0",loading:e.loading,label:"Continuar",type:"submit","icon-right":"chevron_right",onClick:t[2]||(t[2]=e=>l.next())},null,8,["loading"])])}const m=[{id:1,text:"Aprender una habilidad"},{id:2,text:"Mentorías y tutores"},{id:3,text:"Ofrecer mis propios cursos"}],p={data:()=>({questionsList:m,selection:0}),methods:{next(){1===this.selection?alert("En desarrollo"):(2===this.selection||this.selection,this.selection=0)}}};var v=n(4260),h=n(4554),k=n(7991),_=n(8240),b=n(6271),f=n(7518),g=n.n(f);const C=(0,v.Z)(p,[["render",r],["__scopeId","data-v-9330a9fe"]]),w=C;g()(p,"components",{QIcon:h.Z,QRadio:k.Z,QBtn:_.Z,QCheckbox:b.Z});const q=[{to:"#",title:"Noticias"},{to:"#",title:"Contáctanos"},{to:"#",title:"Mi Cuenta",icon:"account_circle"}],x={name:"Module",data:function(){return{links:q}},components:{MainContent:w}},D=(0,v.Z)(x,[["render",i],["__scopeId","data-v-597e8e42"]]),Z=D,M={class:"left-section"};function W(e,t,s,i,a,l){const c=(0,o.up)("NavBar"),u=(0,o.up)("MainContent");return(0,o.wg)(),(0,o.iD)("div",null,[(0,o.Wm)(c,{links:e.links,image:n(9629),height:"60%",class:"bg-white"},null,8,["links","image"]),(0,o._)("div",M,[(0,o.Wm)(u)])])}var y=n(6056);const Q=e=>((0,o.dD)("data-v-935f99ac"),e=e(),(0,o.Cn)(),e),I={class:"main-content"},V=Q((()=>(0,o._)("div",{class:"content-title"},[(0,o._)("p",{class:"title"},"Cursos y Diplomados")],-1))),j=Q((()=>(0,o._)("p",{class:"question"},"Dinos, ¿qué buscas? ¿cuál es tu objetivo?",-1))),U={class:"card shadow-2"},B={class:"buttons"},H=(0,o.Uk)(" Paso anterior "),N=(0,o.Uk)(" Continuar ");function $(e,t,n,s,i,a){const l=(0,o.up)("q-radio"),c=(0,o.up)("q-icon"),u=(0,o.up)("q-btn");return(0,o.wg)(),(0,o.iD)("div",I,[V,j,(0,o._)("div",U,[((0,o.wg)(!0),(0,o.iD)(o.HY,null,(0,o.Ko)(e.questions,(n=>((0,o.wg)(),(0,o.j4)(l,{key:n.id,modelValue:e.selection,"onUpdate:modelValue":t[0]||(t[0]=t=>e.selection=t),val:n.id,label:n.text},null,8,["modelValue","val","label"])))),128))]),(0,o._)("div",B,[(0,o.Wm)(u,{class:"button btn1",onClick:t[1]||(t[1]=t=>e.$router.push("/choose"))},{default:(0,o.w5)((()=>[(0,o.Wm)(c,{name:"chevron_left"}),H])),_:1}),(0,o.Wm)(u,{disable:0===e.selection,class:"button btn2",onClick:t[2]||(t[2]=e=>a.next())},{default:(0,o.w5)((()=>[N,(0,o.Wm)(c,{name:"chevron_right"})])),_:1},8,["disable"])])])}const Y=[{id:1,text:"Aprender una habilidad"},{id:2,text:"Mentorías y tutores"},{id:3,text:"Ofrecer mis propios cursos"}],A={name:"MainContent",data:()=>({questions:Y,selection:0}),methods:{next(){1===this.selection?alert("En desarrollo"):(2===this.selection||this.selection,this.selection=0)}}},E=(0,v.Z)(A,[["render",$],["__scopeId","data-v-935f99ac"]]),K=E;g()(A,"components",{QRadio:k.Z,QBtn:_.Z,QIcon:h.Z});const L=[{title:"Noticias",to:"#"},{title:"Contáctanos",to:"#"},{title:"Mi Cuenta",to:"#",icon:"account_circle"}],O={name:"Module",data:()=>({links:L}),components:{NavBar:y.Z,MainContent:K}},R=(0,v.Z)(O,[["render",W],["__scopeId","data-v-bea7f77e"]]),z=R,P=(0,o.aZ)({name:"Home",components:{Movile:Z,Desktop:z}}),F=(0,v.Z)(P,[["render",s],["__scopeId","data-v-13fd6342"]]),G=F}}]);