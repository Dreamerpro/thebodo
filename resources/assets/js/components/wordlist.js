Vue.component('wordlist',{
    template:"#wordlist",
    data:function() {
        return {
            query:{},
            words:[],
            status:[],
            disableSB:false,
            showSearchBar:false,
            editWord:""
        }
    },
    created:function() {
        // this.words=JSON.parse(this.words);
        
        this.fetchData();
        bus.$on('words-updated', (words)=>{ this.words=words; });
        // console.log(this.words.data);
    },
    methods: {
        
        fetchData:function() {
            bus.$emit('ajax-loading', true);
            this.$http.post("/api/get/getdictionary",this.query)
            .then((response)=>{
                this.words=response.body.words;
                bus.$emit('ajax-done', true);
            },(response)=>{
                console.log(response);
            });
        },
        save:function(key,id) {
            this.disableSB=true;
            //send the words with id
            console.log(this.words[key]);
            self=this;
            this.$http.post('/api/admin/word/save', {id:id,def:this.words[key]} )
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
        editModal:function(key) {

            let vm=this;
            let word=this.words.data[key];
            vm.editWord=word.bodo_definition;
            console.log(word);
           swal({
            title:"Edit "+word.word,
            input:"textarea",
            showCancelButton: true,
            confirmButtonText: 'Save',
            inputValue:vm.editWord,
            showLoaderOnConfirm: true,
            preConfirm: function (newword) {
            
            return new Promise(function (resolve, reject) {
              
                if (!newword) {
                  reject('You must type something ~');
                } else {
                    vm.editWord=newword;
                    vm.$http.post("/api/admin/word/save",{id:word.id,def:vm.editWord})
                    .then((data)=>{
                         resolve(newword);
                    },(error)=>{
                        reject('Error fetching the newword ~');
                    })
                }
              
            })
           },
           allowOutsideClick: false
            })
           .then(function (newword) {
              
              vm.words.data[key].bodo_definition=newword;
              console.log(vm.words,key);
              vm.editWord=null;
              swal("Succes","Edit saved succesfully",'success');
            },function() {});
        },
        search:function() {
            let vm=this;
           swal({
            title:"Search english word",
            input:"text",
            showCancelButton: true,
            confirmButtonText: 'Search',
            showLoaderOnConfirm: true,
            preConfirm: function (query) {
            
            return new Promise(function (resolve, reject) {
              
                if (!query) {
                  reject('You must type something ~');
                } else {
                    vm.$http.post("/api/dictionary/search",{query:query})
                    .then((data)=>{
                         resolve(data);
                    },(error)=>{
                        reject('Error fetching the query ~');
                    })
                 
                }
              
            })
           },
           allowOutsideClick: false
            })
           .then(function (data) {
              console.log(data);
              vm.words=data.body.words;
            },function() {});
        },
        showinputhelper:function() {
            swal({
                title:"INFO",
                html:"<div class=\"alert alert-info\">Please download Jquery Ime input tool extensions for Firefox or Chrome .<br><a target=\"_blank\" href=\"https://addons.mozilla.org/en-US/firefox/addon/wikimedia-input-tools/\">Firefox extension</a><br><a target=\"_blank\" href=\"https://chrome.google.com/webstore/detail/wikimedia-input-tools/fjnfifedbeeeibikgpggddmfbaeccaoh\">Chrome extension</a></div>",
                type:'info'
            });
        }
    }
    

});
