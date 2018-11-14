<template>
    <div>
        <div style="display: none;" class="col-12 border-top mt-2 studentDetail">
            <div class="row justify-content-between">
                <div class="col-6 col-sm-4 mt-3">
                    <p class="h6"></p>
                </div>
                <div class="col-6 col-sm-4 mt-3">
                    <button class="btn btn-primary mr-3 mb-2 mb-lg-0 service-payment" type="button"><li class="fas fa-plus"></li> {{ servicetext }}</button>
                    <button class="btn btn-primary refund-payment" type="button"><li class="fas fa-plus"></li> {{ refundtext }}</button>
                </div>
            </div>
        </div>
        <div  style="display: none;" class="col-12 mt-2 tableDebt">
            <div class="table-responsive">
                <table class="table table-bordered mt-3" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col">{{ descriptiontext }}</th>
                        <th scope="col">{{ totaltext }}</th>
                        <th scope="col">{{ paytext }}</th>
                        <template v-for="n in 11">
                            <th scope="col">{{ feetext }} {{ n }}</th>
                        </template>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "mainContractStudent",
        props: {
            refundtext: String,
            servicetext: String,
            removetext: String,
            feetext: String,
            descriptiontext: String,
            totaltext: String,
            paytext: String
        }
    }
</script>

<style scoped>

</style>