<template>
    
        <div class="row" style="margin-top:4em">
            <vendor-panel-component :controls="controls"></vendor-panel-component>
            <!-- <add-product-main-component :controls="controls" v-if="controls.show_apmc==1"></add-product-main-component>
            <add-clothing-product-component v-if="controls.show_acpc==1" :controls="controls"></add-clothing-product-component>
            <add-other-product-component v-if="controls.show_aopc==1" :controls="controls"></add-other-product-component> -->
            <edit-stock-component v-if="controls.show_edit==1 && $route.path=='/vendor'" :controls="controls"></edit-stock-component>
            <product-panel v-if="controls.show_product_pannel==1 && $route.path=='/vendor'" :controls="controls"></product-panel>
            <orders-panel v-if="controls.show_orders_pannel==1 && $route.path=='/vendor-orders'" :controls="controls"></orders-panel>
        </div>

    
</template>

<script>
    import vendor_panel_component from "./vendor_panel_component.vue"
    import add_product_main_component from "./add_product_main_component.vue"
    import add_clothing_product_component from "./add_clothing_product_component.vue"
    import add_other_product_component from "./add_other_product_component.vue"
    import edit_stock_component from "./edit_stock_component.vue"
    import product_panel from "./product_panel.vue"
    import orders_panel from "./orders_panel.vue"

export default{
        data: function(){
            return {
                controls: {
                    show_others: 0,
                   show_product_pannel: 0,
                   show_orders_pannel: 0,
                   add_product: 0,
                    show_aopc:0,
                    show_acpc:0,
                    show_edit: 0
                }
            }
        },
        components: {
            "vendor-panel-component": vendor_panel_component,
            "add-clothing-product-component": add_clothing_product_component,
            "add-product-main-component": add_product_main_component,
            "add-other-product-component": add_other_product_component,
            "edit-stock-component": edit_stock_component,
            "product-panel": product_panel,
            "orders-panel": orders_panel
        },
        created(){
                    this.$scrollTo("#my_nav");

        }
    }
</script>
