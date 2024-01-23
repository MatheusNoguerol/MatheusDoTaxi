/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from  'vue' 
import { BootstrapVue, IconsPlugin } from  'bootstrap-vue'


import VMask from 'v-mask'
Vue.use(VMask);
// Importa arquivos CSS Bootstrap e BootstrapVue (a ordem é importante) 
import  'bootstrap/dist/css/bootstrap.css' 
import  'bootstrap-vue/dist/bootstrap-vue.css'


// Disponibiliza o BootstrapVue em todo o seu projeto
Vue.use(BootstrapVue)
// Opcionalmente, instale o plug-in de componentes de ícone BootstrapVue 
Vue.use(IconsPlugin)

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('teste-component', require('./components/TesteComponent.vue').default);

Vue.component('home-component', require('./components/site/HomeComponent.vue').default);

Vue.component('quem-somos-component', require('./components/site/QuemSomosComponent.vue').default);

Vue.component('multimidia-component', require('./components/site/MultimidiaComponent.vue').default);

Vue.component('localizacao-component', require('./components/site/LocalizacaoComponent.vue').default);

Vue.component('fale-conosco-component', require('./components/site/FaleConoscoComponent.vue').default);

Vue.component('dashboard-component', require('./components/DashboardComponent.vue').default);

Vue.component('seguros-component', require('./components/SegurosComponent.vue').default);

Vue.component('estoque-component', require('./components/EstoqueComponent.vue').default);

Vue.component('cadastro-cliente-component', require('./components/cadastro/CadastroClienteComponent.vue').default);

Vue.component('cadastro-funcionario-component', require('./components/cadastro/CadastroFuncionarioComponent.vue').default);

Vue.component('adicionar-produto-component', require('./components/AdicionarProdutoComponent.vue').default);

Vue.component('consultar-cadastro-component', require('./components/cadastro/ConsultarCadastroComponent.vue').default);

Vue.component('painel-cadastro-component', require('./components/cadastro/PainelCadastroComponent.vue').default);


Vue.component('cadastrar-segurado-component', require('./components/area_securitaria/CadastrarSeguradoComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
