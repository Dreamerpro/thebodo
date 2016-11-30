Vue.component('paginator',{
    template:"#paginator",
    props:['data','extra'],
    data(){
        return {
           query:{},
        };
    },
    methods:{
        nextPage:function () {
            this.extra.page=this.data.current_page+1;
            this.fetch();
        },
        prevPage:function(){
            this.extra.page=this.data.current_page-1;
            this.fetch();
        },
        fetch:function() {
            bus.$emit('ajax-loading', true);
            this.$http.post("/api/get/getdictionary",this.extra)
            .then((data)=>{
                    bus.$emit('words-updated', data.body.words);
                    bus.$emit('ajax-done', true);
                },(error)=>{
                    console.log('Error fetching the query ~');
                });
        },
        gotoPage:function() {
            
            this.extra.page=this.data.current_page;
            this.fetch();
        }
    }
});