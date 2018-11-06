<template>
    <div>
        <div style="display: none;" class="col-12 border-top mt-2 studentDetail">
            <div class="col-4">
                <div class="float-left mt-3">
                    <p class="h6"></p>
                </div>
            </div>
            <div class="float-right mt-3">
                <div class="col-4">
                    <button class="btn btn-danger"><li class="fas fa-minus"></li> {{ removetext }}</button>
                </div>
            </div>
            <div class="float-right mt-3">
                <div class="col-4">
                    <button class="btn btn-primary"><li class="fas fa-plus"></li> {{ servicetext }}</button>
                </div>
            </div>
            <div class="float-right mt-3">
                <div class="col-4">
                    <button class="btn btn-primary"><li class="fas fa-plus"></li> {{ refundtext }}</button>
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
                    <tr class="obligatoryServices">
                    </tr>
                    <tr class="enrollment">
                    </tr>
                    <tr class="contract">
                    </tr>
                    <tr class="surcharge-15" style="display:none;">
                    </tr>
                    <tr class="surcharge-1" style="display:none;">
                    </tr>
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