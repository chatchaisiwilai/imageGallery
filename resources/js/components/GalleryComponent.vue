<template>
    <div class="container">
        <div class="row mb-2">
            <dropzone-component></dropzone-component>
        </div>
        <div class="row">
            <image-component></image-component>
            <image-component></image-component>
            <image-component></image-component>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
