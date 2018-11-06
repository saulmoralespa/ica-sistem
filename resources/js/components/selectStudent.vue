<template>
    <select ref="addPay" disabled @change="this.$parent.changeSelectStudent" v-selectstudent name="student_id[]" class="selectStudent form-control" data-live-search="true" data-size="2" required>
    </select>
</template>

<script>
    export default {
        name: "selectStudent",
        directives: {
            selectstudent: {
                inserted(el, binding, vNode){
                    $(document).ready(function(){
                        $.ajax({
                            url: studentsList,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: $('meta[name=csrf-token]').attr('content')
                            }
                        }).then(function(students){
                            let htmlStudents = `<option value="">${noneSelectedTextShow}</option>`;
                            students.forEach(function (student){
                                htmlStudents  += `<option value="${student.id}">${student.name}</option>`;
                            });
                            if($(el).html(htmlStudents)){
                                $(el).selectpicker({
                                    noneSelectedText: noneSelectedTextShow,
                                    noneResultsText: noneResultsTextShow,
                                }).on('shown.bs.select', function(e) {
                                    contractStudent.focusSelectStudent(e)
                                })
                            }
                        });
                    });
                }
            }
        }
    }
</script>

<style scoped>

</style>