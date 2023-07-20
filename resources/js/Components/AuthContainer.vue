<template lang="">
    <div class="authUserContainer flex items-center h-16 p-3 border-b-[2px] border-gray-100 bg-gray-900">
        <div class="mr-4">
            <img :src="authUser.icon" :alt="authUser.name" class="w-10 h-10 rounded-full">
        </div>
        <div>
            <h4 class="text-base font-semibold text-white">{{ authUser.name }}</h4>
        </div>
        <div class="buttons-container ml-auto text-2xl mr-2 grid grid-cols-2 gap-x-4">
            <svg fill="#48bb78" class="newChatButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
            <svg class="moreOptionButton" fill="white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
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
<style>

.newChatButton,
.moreOptionButton {
  /* Add shared styles for the buttons here */
  cursor: pointer;
  transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}


.newChatButton:hover {
  transform: translateY(-1px); /* Move icon up 1px on hover */
  /* Add any other styles you want on hover */
}

.moreOptionButton:hover {
  transform: translateY(-1px); /* Move icon up 1px on hover */
  /* Add any other styles you want on hover */
}

/* Add click effect if needed */
.newChatButton:active,
.moreOptionButton:active {
  transform: translateY(0); /* Reset the translation on click */
  /* Add any other styles you want on click */
}
</style>