<template>
  <div>
    <div id="app">
      <main class="main-container">
        <div class="chat-timeline">
          <balloon 
            v-for="chat in chatLogs"
            :speaker="chat.speaker"
            :name="chat.name"
            :message="chat.message">
          </balloon>
        </div>
        <chat-form
          @submit-message="submit"
          apply-event="submit-message">
        </chat-form>
      </main>
    </div>
  </div>
</template>

<script>
</script>

<style>
</style>