<template>
    <select ref="addPay" :is="loadOptions()" v-selectstudent name="student_id[]" class="selectStudent form-control" data-live-search="true" data-size="2" required>
    </select>
</template>

<script>
    export default {
        directives: {
            selectstudent: {
                inserted(el, binding, vNode){
                    $(document).ready(function(){
                        //$(el).html(`<option value="1">Adriana</option>`);
                        (el).selectpicker({
                            noneSelectedText : 'Seleccione estudiante',
                            noneResultsText: 'No hay resultados {0}',
                        });
                    });
                }
            }
        },
        data(){
            return {
                students: ''
            }
        },
        methods: {
            loadOptions(){
                if (!this.students){
                    $(document).ready(function(){
                        $.ajax({
                            url: studentShow,
                            type: 'get',
                            dataType: 'json',
                            data: {
                                _token: $('meta[name=csrf-token]').attr('content')
                            }
                        }).then(function(res){
                            this.students = res;
                        }.bind(this));
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>