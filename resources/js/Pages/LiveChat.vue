<template lang="">
    <div class="flex flex-row w-full h-full">
        <ChatList class="w-[25%] h-full border-r-4"/>
        <ChatBox class="w-[75%] h-full"/>
    </div>
</template>
<script>

import ChatList from '@/Components/ChatList.vue';
import ChatBox from '@/Components/ChatBox.vue'

export default {
    components: {
        ChatList,
        ChatBox
    }
}
</script>
<style lang="">

</style>
