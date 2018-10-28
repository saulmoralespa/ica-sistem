<template>
    <input type="text" v-datepicker name="date" id="date" class="form-control" @input="update($event.target.value)" required />
</template>

<script>
    export default {
        name: "datepicker",
        directives: {
            datepicker: {
                inserted (el, binding, vNode) {
                    $(document).ready(function(){
                        $(el).datepicker({
                         autoclose: true,
                         format: 'yyyy-mm-dd'
                     }).on('changeDate',function(e){
                         vNode.context.$emit('input', e.format(0))
                     })
                    });
                }
            }
        },
        props: ['value'],
        methods: {
            update (v){
                this.$emit('input', v)
            }
        }
    }
</script>

<style scoped>

</style>