<template>
    <div class="panel panel-default">
    <div class="panel-heading">History<button class="btn btn-default pull-right" @click="showCreateForm()"><i class="fa fa-plus"></i></button></div>

    <div class="panel-body">   
        
        <div class="list-group">
            <div class="list-group-item" v-for="event in history">
                <p>@{{event.year}}@{{event.month?'-'+event.month:''}}@{{event.date?'-'+event.date:''}}</p>
                <p >@{{event.details}}</p>
            </div>
        </div>                   
    </div>
</div>    
</template>
<script >
    export default{
        name:'history',
        data:function() {
            return {
                history:[]
            };  
        },
        created:function () {
            this.fetch();
        },
        methods:{
            fetch:function() {
                var vm=this;
                vm.$http.get('/api/history/all')
                .then((response)=>{
                    console.log(response.body);
                    vm.history=response.body;
                },(error)=>{
                    console.log(error.body);
                })
            },
            validate:function(year,month,date,time,place,details) {
                if(year>2016){return {isValid:false,msg:'Year can\'t be '+year};}
                if(month && month>12){return {isValid:false,msg:'Invalid month'};}
                if(month===0){return {isValid:false,msg:'Invalid month'};}

                if(date && date>31){return {isValid:false,msg:'Invalid date!'};}
                if(date===0){return {isValid:false,msg:'Invalid date!'};}
                if(!details){return {isValid:false,msg:'Details can\'t be empty'};}
                
                return {isValid:true};
            },
            showCreateForm:function() {
                var vm =this;
                swal({
                    title:"Add new event",
                    html:"<div class='form-group'><input id='year' type='number' max='2017' class='form-control' placeholder='Year'/></div>"+
                         "<div class='form-group'><input id='month' type='number' min='1' max='12' class='form-control' placeholder='Month'/></div>"+
                         "<div class='form-group'><input id='date' type='number' min='1' max='31' class='form-control' placeholder='Date'/></div>"+
                         "<div class='form-group'><input id='time' type='time' class='form-control' placeholder='Time'/></div>"+
                         "<div class='form-group'><input id='place' type='text' class='form-control' placeholder='Place'/></div>"+
                         "<div class='form-group'><textarea id='details' class='form-control' required placeholder='Description'></textarea></div>",
                    preConfirm:function () {
                        
                        return new Promise(function (resolve, reject) {
                            let year=$('#year').val(),
                                month=$('#month').val(),
                                date=$('#date').val(),
                                time=$('#time').val(),
                                place=$('#place').val(),
                                details=$("#details").val();
                            var validity=vm.validate(year,month,date,time,place,details);
                            if(validity.isValid){
                                resolve();
                                vm.$http.post("/api/history/create",
                                    {   year:year,
                                        month:month,
                                        date:date,
                                        time:time,
                                        place:place,
                                        details:details
                                    }
                                    )
                                .then(function(data) {
                                    vm.history.push(data.body);
                                    resolve(data.body);
                                },function(error) {
                                    reject(error.data);
                                })
                            }
                            else{
                                reject(validity.msg);
                            }
                        });
                    }
                }).then(function(data) {
                    swal('Success','The event added successfully','success');
                    // console.log(data, vm.history)
                }, function() {
                    swal('Error','There was error adding event','error');
                });
            }
        }//methods end
    }
</script>
