<template>
    <div>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    watch: {
        $route() {
            $("#navbarCollapse").collapse("hide");
        },
    },
};
</script>

<style>
*{
    margin: 0;
    font-family: Roboto,sans-serif;
}
</style>
