
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./components/wordlist.js');
require('./components/paginator.js');
require('./components/history.js');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

// Vue.component('example', require('./components/Example.vue'));




const app = new Vue({
    el: '#app',
    data:{
    	words:[],
    	status:[],
    	disableSB:false,
        showSearchBar:false,
    },
    created:function() {
        var vm=this;
        bus.$on('ajax-loading',function(){
            console.log("loading..");
            vm.showLoading();
        });
        bus.$on('ajax-done',function(){
            console.log("loading done.");
            vm.hideLoading();
        });
    },
    methods:{
    	showLoading:function() {
            swal({
                title:"Loading please wait!",
                html:"<br><i class='fa fa-cog fa-3x fa-spin'></i><br>",
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
            }) ; 
        },
        hideLoading:function() {
            swal.close();
        },
        toggleSearchBar:function () {
            this.showSearchBar=!this.showSearchBar;
        },

        edit:function(key,word) {
            // console.log(key);
            // console.log(word);
            this.status[key]=true;
            this.words[key]=word.bodo_definition;
        }
    },
    computed:{
    	
    },
    ready:{

    }
});

