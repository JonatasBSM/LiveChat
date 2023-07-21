<template>
  <div class="modal-container bg-gray-900">
    <div class="modal-content flex flex-col">

      <div @click="sendBackToChatList" class="back-button pb-1">
        <svg fill="white" xmlns="http://www.w3.org/2000/svg" class="text-2xl" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
      </div>

      <div id="masqueico" class="search-existent-friend-container flex items-center p-3 border-b border-gray-700">
        <input
          v-model="searchQuery"
          @input="searchFriends"
          placeholder="Search a friend"
          class="flex-grow p-2 bg-gray-800 text-white rounded-l-md focus:outline-none"
        />
        <button
          @click="addFriend"
          class="search-button rounded-r-md"
        >
          Search
        </button>
      </div>

      <div class="friend-list-container">
        <ul class="search-results">
          <li
            v-for="friend in filteredFriends"
            :key="friend.id"
            class="flex items-center justify-between p-3 border-b border-gray-700 text-white"
          >
            <span>{{ friend.name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchQuery: "",
      friendsList: [
        { id: 1, name: "John Doe" },
        { id: 2, name: "Jane Smith" },
        { id: 3, name: "Alice Johnson" },
        { id: 4, name: "Bob Anderson" },
        // Add more sample friends here if needed
      ],
    };
  },
  computed: {
    filteredFriends() {
      return this.friendsList.filter((friend) =>
        friend.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  methods: {
    searchFriends() {
      // No need to set searchResults; the filtered list is computed using filteredFriends()
    },
    addFriend() {
      // Implement adding new friend logic here
      // For example, you can call an API to add a new friend
      // and then refresh the friendsList or use a state management library like Vuex.
      console.log("Adding new friend:", this.searchQuery);
      this.searchQuery = "";
    },
    addFriendToSelected(friend) {
      // Implement adding the selected friend to the list of selected friends
      // For example, push it into the selectedFriends array.
      console.log("Adding friend to selected list:", friend.name);
    },

    sendBackToChatList() {
      this.$emit('back-to-chatList')
    }
  },
};
</script>

<style>
/* Add your modal styles here */
.modal-container {
  /* Your modal container styles */
}

.modal-content {
  /* Your modal content styles */
}

.new-friend-container,
.existent-friend-container {
  /* Add any custom styles for the containers */
}

/* Adjust the styles for the back SVG */
.back-button {
  margin-left: auto;
  padding-top: 1.2rem;
  padding-right: 1.2rem;
}

/* Adjust the styles for the search button */
.search-button {
  background-color: #48BB78;
  font-size: 1rem; /* Revert the font size to the original */
  line-height: 1.5rem; /* Revert the line height to the original */
  padding: 0.5rem 1rem; /* Adjust padding for the button */
  transition: background-color 0.2s ease-in-out;
}

/* Hover effect for the back SVG */
.back-button:hover svg {
  transform: scale(1.1); /* Scale up on hover */
  color: #FFB000; /* Change color on hover */
  cursor: pointer; /* Show pointer cursor on hover */
  transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}

/* Hover effect for the search button */
.search-button:hover {
  background-color: #34D399; /* Change background color on hover */
  cursor: pointer; /* Show pointer cursor on hover */
  transform: scale(1.05); /* Scale up on hover */
  transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out; /* Add transition */
}

.masqueico:focus {
  -webkit-appearance: none;
  outline: 0;
}
</style>
