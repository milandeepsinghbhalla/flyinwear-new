<template>
    <div class="col-2 pr-0 dash-list mt-3" style="border-right:5px solid  #7e7e7e;">
                    <ul class="dash-link pr-0 pl-3">
                        <li class="dash-buttons btn btn-dark col-12" v-on:click="controls.show_apmc=1">Add products</li>
                        <li class="dash-buttons btn btn-dark col-12">Delete products</li>
                        <li class="dash-buttons btn btn-dark col-12">edit products</li>
                        <li class="dash-buttons btn btn-dark col-12">Orders</li>
                        <li class="dash-buttons btn btn-dark col-12">Cancelled</li>

                    </ul>

    </div>
</template>

<script>
    export default{
        props: ["controls"]
    }
</script>
