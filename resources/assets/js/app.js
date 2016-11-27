
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data:{
    	words:[],
    	status:[],
    	disableSB:false,
        showSearchBar:false
    },
    methods:{
    	save:function(key,id) {
    		this.disableSB=true;
    		//send the words with id
    		console.log(this.words[key]);
    		self=this;
    		this.$http.post('/api/admin/word/save', {id:id,def:this.words[key]}	)
    		.then(

    			function(argument) {
    				console.log(argument);
    				this.disableSB=false;
    				self.status[key]=true;
    			},
    			function(argument) {
    				console.log(argument);
    				this.disableSB=false;
    			}
    		)
    		
    		//hide the form
    	},
        toggleSearchBar:function () {
            this.showSearchBar=!this.showSearchBar;
        },
        openModal:function() {
            alert("test");
        }
    },
    computed:{
    	
    },
    ready:{

    }
});

