<template>
  <div class="authUserContainer flex items-center h-16 p-3 border-b-[2px] border-gray-100 bg-gray-900">
    <div class="authUserDetails flex items-center">
      <div class="mr-4">
        <img :src="authUser.icon" :alt="authUser.name" class="w-10 h-10 rounded-full">
      </div>
      <div>
        <h4 class="text-base font-semibold text-white">{{ authUser.name }}</h4>
      </div>
    </div>
    <div class="buttons-container">
      <svg @click="openButtonModal" fill="#48bb78" class="newChatButton" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM200 344V280H136c-13.3 0-24-10.7-24-24s10.7-24 24-24h64V168c0-13.3 10.7-24 24-24s24 10.7 24 24v64h64c13.3 0 24 10.7 24 24s-10.7 24-24 24H248v64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/><title>New Chat</title></svg>
    </div>
  </div>
</template>
<script>
export default {
    data() {
        return {
            authUser: this.$page.props.auth.user
        }
    },

    methods: {
      openButtonModal() {
        const button = event.target.closest("svg").getAttribute("class");

        let state = null

        switch(button) {

          case 'newChatButton': {
            state = 'newChat'
            break
          }

          default: {
            console.log(event.target)
          }

        }

          this.$emit('mobile-screen-state', 'newChat')
          this.$emit('screen-state', 'newChat')
      }
    }
}
</script>
<style>

.buttons-container {
  margin-left: auto;
  font-size: 1.5rem/* 24px */;
  line-height: 2rem/* 32px */;
  margin-right: 0.5rem/* 8px */;
  display: grid;
  column-gap: 1rem/* 16px */;
}

.buttons-container svg {
  /* Add shared styles for the buttons here */
  cursor: pointer;
  transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}

.buttons-container svg:hover {
  transform: translateY(-1px); /* Move icon up 1px on hover */
  /* Add any other styles you want on hover */
}

/* Add click effect if needed */
.buttons-container svg {
  transform: translateY(0); /* Reset the translation on click */
  /* Add any other styles you want on click */
}

@media (max-width: 540px) {
  /* Media query for screens smaller than 540px */


  .authUserDetails {
    width: 100%;
    justify-content: center;
  }

}
</style>
