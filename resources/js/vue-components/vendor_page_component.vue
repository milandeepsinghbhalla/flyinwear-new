<template>
    
        <div class="row" style="margin-top:4em">
            <vendor-panel-component :controls="controls"></vendor-panel-component>
            <add-product-main-component :controls="controls" v-if="controls.show_apmc==1"></add-product-main-component>
            <add-clothing-product-component v-if="controls.show_acpc==1" :controls="controls"></add-clothing-product-component>
        </div>

    
</template>

<script>
    import vendor_panel_component from "./vendor_panel_component.vue"
    import add_product_main_component from "./add_product_main_component.vue"
    import add_clothing_product_component from "./add_clothing_product_component.vue"

export default{
        data: function(){
            return {
                controls: {
                    show_apmc: 0,
                    show_acpc: 0
                }
            }
        },
        components: {
            "vendor-panel-component": vendor_panel_component,
            "add-clothing-product-component": add_clothing_product_component,
            "add-product-main-component": add_product_main_component
        }
    }
</script>
