import{o as e,c as a,w as n,a as t,e as o,F as d,h as u,b as h,u as g,i as p,t as c,O as m}from"./app-JsxQVuK5.js";import{_}from"./ProfileLayout-Dx4qE_-S.js";import"./AppLayout-RL1yZ6o4.js";import"./FooterSection-B3qla_kT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./ExclamationCircleIcon-Deok98lu.js";import"./Bars3Icon-CiW0Tf8T.js";import"./UserIcon-C5xJ_kCf.js";import"./HomeIcon-CX7JyigJ.js";const x={class:"bg-white"},v={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},y=t("h1",{class:"text-3xl font-bold tracking-tight text-gray-900"},"Your Wishlist",-1),f=t("p",{class:"mt-2 text-sm text-gray-500"},"Check your wishlist products.",-1),w={class:"mt-12 space-y-16 sm:mt-16"},k={key:0,class:"text-center text-gray-500"},b={key:1,class:"grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"},S={class:"aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7"},B=["src","alt"],C={class:"relative z-20"},j={class:"mt-4 text-sm text-gray-700"},F={class:"mt-1 text-lg font-medium text-gray-900"},O=["onClick"],R={__name:"Index",props:{wishlist:Array,siteSettings:Object},setup(i){function l(r){m.delete(route("wishlist.destroy",{id:r}),{preserveScroll:!0,onSuccess:()=>{}})}return(r,$)=>(e(),a(_,{siteSettings:i.siteSettings},{default:n(()=>[t("div",x,[t("div",v,[y,f,t("div",w,[i.wishlist.length===0?(e(),o("div",k," You have no items in your wishlist. ")):(e(),o("div",b,[(e(!0),o(d,null,u(i.wishlist,s=>(e(),o("div",{key:s.id,class:"group relative"},[h(g(p),{href:r.route("products.show",{slug:s.product.slug}),class:"absolute inset-0 z-10"},null,8,["href"]),t("div",S,[t("img",{src:s.product.image_url,alt:s.product.name,class:"h-full w-full object-cover object-center group-hover:opacity-75"},null,8,B)]),t("div",C,[t("h3",j,c(s.product.name),1),t("p",F,"$"+c(s.product.price),1),t("button",{onClick:z=>l(s.id),class:"mt-2 text-sm text-red-500 hover:text-red-700"},"Remove",8,O)])]))),128))]))])])])]),_:1},8,["siteSettings"]))}};export{R as default};
