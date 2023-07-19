<template lang="">
    <div class="authUserContainer flex items-center h-16 p-3 border-b-[2px] border-gray-100 bg-gray-900">
        <div class="mr-4">
            <img :src="authUser.icon" :alt="authUser.name" class="w-10 h-10 rounded-full">
        </div>
        <div>
            <h4 class="text-base font-semibold text-white">{{ authUser.name }}</h4>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            authUser: this.$page.props.user
        }
    }
}
</script>
<style lang="">
    
</style>