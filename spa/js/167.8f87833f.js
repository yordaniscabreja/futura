(self["webpackChunkfutura"]=self["webpackChunkfutura"]||[]).push([[167],{4909:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>G});var s=n(3673);function o(e,t,n,o,i,a){const c=(0,s.up)("Movile"),l=(0,s.up)("Desktop");return(0,s.wg)(),(0,s.iD)(s.HY,null,["xs"===e.$q.screen.name?((0,s.wg)(),(0,s.j4)(c,{key:0,class:"movile"})):(0,s.kq)("",!0),"xs"!==e.$q.screen.name?((0,s.wg)(),(0,s.j4)(l,{key:1,class:"desktop"})):(0,s.kq)("",!0)],64)}function i(e,t,n,o,i,a){const c=(0,s.up)("MainContent");return(0,s.wg)(),(0,s.iD)("div",null,[(0,s.Wm)(c,{class:"main-content"})])}var a=n(2323);const c=e=>((0,s.dD)("data-v-7a2bdc74"),e=e(),(0,s.Cn)(),e),l={class:"container"},d=c((()=>(0,s._)("div",{class:"content-title"},[(0,s._)("p",{class:"title"},"Selecciona")],-1))),u=c((()=>(0,s._)("p",{class:"message"},"Cuéntanos lo que buscas",-1)));function r(e,t,n,o,i,c){const r=(0,s.up)("q-icon"),p=(0,s.up)("q-radio"),m=(0,s.up)("q-btn");return(0,s.wg)(),(0,s.iD)("div",l,[(0,s._)("div",null,[(0,s.Wm)(r,{class:"icon-back",name:"arrow_back",onClick:t[0]||(t[0]=t=>e.$router.push({path:"/register"}))})]),d,u,((0,s.wg)(!0),(0,s.iD)(s.HY,null,(0,s.Ko)(i.questionsList,(e=>((0,s.wg)(),(0,s.iD)("div",{class:"question-container",key:e.id},[(0,s.Wm)(p,{val:e.id,modelValue:i.selected,"onUpdate:modelValue":t[1]||(t[1]=e=>i.selected=e),color:"light-blue-13",dark:"",class:"term"},{default:(0,s.w5)((()=>[(0,s.Uk)((0,a.zw)(e.text),1)])),_:2},1032,["val","modelValue"])])))),128)),(0,s.Wm)(m,{disable:"selected === 0",loading:e.loading,label:"Continuar",type:"submit","icon-right":"chevron_right",onClick:t[2]||(t[2]=e=>c.next())},null,8,["loading"])])}const p=[{id:1,text:"Carreras universitarias o posgrados"},{id:2,text:"Diplomados, cursos cortos o certificaciones"},{id:3,text:"Financiación y créditos estudiantiles"},{id:4,text:"No tengo idea ¡necesito ayuda!"}],m={data(){return{questionsList:p,selected:0}},methods:{next(){1===this.selected?this.$router.push("/choose-2"):2===this.selected?this.$router.push("/objetivescourses"):this.selected=0}}};var v=n(4260),h=n(4554),b=n(7991),g=n(8240),k=n(6271),_=n(7518),C=n.n(_);const f=(0,v.Z)(m,[["render",r],["__scopeId","data-v-7a2bdc74"]]),w=f;C()(m,"components",{QIcon:h.Z,QRadio:b.Z,QBtn:g.Z,QCheckbox:k.Z});const q=[{to:"#",title:"Noticias"},{to:"#",title:"Contáctanos"},{to:"#",title:"Mi Cuenta",icon:"account_circle"}],x={name:"Module",data:function(){return{links:q}},components:{MainContent:w}},D=(0,v.Z)(x,[["render",i],["__scopeId","data-v-1ff48cd9"]]),Z=D,M={class:"left-section"};function W(e,t,o,i,a,c){const l=(0,s.up)("NavBar"),d=(0,s.up)("MainContent");return(0,s.wg)(),(0,s.iD)("div",null,[(0,s.Wm)(l,{links:e.links,image:n(8378),height:"60%",class:"bg-white"},null,8,["links","image"]),(0,s._)("div",M,[(0,s.Wm)(d)])])}var y=n(6056);const $=e=>((0,s.dD)("data-v-4a8d3b4c"),e=e(),(0,s.Cn)(),e),I={class:"main-content"},Q=$((()=>(0,s._)("div",{class:"content-title"},[(0,s._)("p",{class:"title"},"Selecciona")],-1))),N=$((()=>(0,s._)("p",{class:"question"},"Cuéntanos lo que buscas",-1))),V={class:"card shadow-2"},j={class:"buttons"},U=(0,s.Uk)(" Paso anterior "),B=(0,s.Uk)(" Continuar ");function H(e,t,n,o,i,a){const c=(0,s.up)("q-radio"),l=(0,s.up)("q-icon"),d=(0,s.up)("q-btn");return(0,s.wg)(),(0,s.iD)("div",I,[Q,N,(0,s._)("div",V,[((0,s.wg)(!0),(0,s.iD)(s.HY,null,(0,s.Ko)(e.questions,(n=>((0,s.wg)(),(0,s.j4)(c,{key:n.id,modelValue:e.selection,"onUpdate:modelValue":t[0]||(t[0]=t=>e.selection=t),val:n.id,label:n.text},null,8,["modelValue","val","label"])))),128))]),(0,s._)("div",j,[(0,s.Wm)(d,{class:"button btn1",onClick:t[1]||(t[1]=t=>e.$router.push("/register"))},{default:(0,s.w5)((()=>[(0,s.Wm)(l,{name:"chevron_left"}),U])),_:1}),(0,s.Wm)(d,{disable:0==e.selection,class:"button btn2",onClick:t[2]||(t[2]=e=>a.next())},{default:(0,s.w5)((()=>[B,(0,s.Wm)(l,{name:"chevron_right"})])),_:1},8,["disable"])])])}const Y=[{id:1,text:"Carreras universitarias o posgrados"},{id:2,text:"Diplomados, cursos cortos o certificaciones"},{id:3,text:"Financiación y créditos estudiantiles"},{id:4,text:"No tengo idea ¡necesito ayuda!"}],F={name:"MainContent",data:()=>({questions:Y,selection:0}),methods:{next(){1===this.selection?this.$router.push("/choose-2"):2===this.selection?this.$router.push("/objetivescourses"):this.selection=0}}},K=(0,v.Z)(F,[["render",H],["__scopeId","data-v-4a8d3b4c"]]),L=K;C()(F,"components",{QRadio:b.Z,QBtn:g.Z,QIcon:h.Z});const R=[{title:"Noticias",to:"#"},{title:"Contáctanos",to:"#"},{title:"Mi Cuenta",to:"#",icon:"account_circle"}],S={name:"Module",data:()=>({links:R}),components:{NavBar:y.Z,MainContent:L}},z=(0,v.Z)(S,[["render",W],["__scopeId","data-v-be161a70"]]),P=z,A=(0,s.aZ)({name:"Home",components:{Movile:Z,Desktop:P}}),E=(0,v.Z)(A,[["render",o],["__scopeId","data-v-b38d869e"]]),G=E},8378:(e,t,n)=>{e.exports=n.p+"img/image-3.e791b378.svg"}}]);