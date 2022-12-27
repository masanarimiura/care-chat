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
const Balloon = {
  template: `<div class="conversation-balloon" :class="speaker">
  <div class="avatar">
    <img src="https://avatars3.githubusercontent.com/u/15647466?v=3&s=88">
    <p class="name">{{ name }}</p>
  </div>
  <p class="message">{{ message }}</p>
</div>`,
  props: {
    name: {
      type: String,
      required: true
    },
    speaker: {
      type: String,
      required: true,
      validator: value => {
        return ['my', 'other'].includes(value);
      }
    },
    message: {
      type: String,
      required: true
    }
  }
};

const ChatForm = {
  template: `<div class="chat-form">
  <div class="form-container">
    <input type="text" class="message" v-model="message">
    <button class="submit" @click="submit">送信</button>
  </div>
</div>`,
  props: {
    applyEvent: {
      type: String,
      required: true
    }
  },
  data () {
    return {
      message: ''
    }
  },
  methods: {
    submit () {
      this.$emit(this.applyEvent, this.message)
      this.message = '';
    }
  }
};

const app = new Vue({
  el: '#app',
  components: {
    balloon: Balloon,
    chatForm: ChatForm
  },
  data () {
    return {
    	chatLogs: [
         { name: 'わたしだよ', speaker: 'my', message: 'hello'.repeat(10) },
         { name: 'bot', speaker: 'other', message: 'hello world' }
      ]
    }
  },
  methods: {
    submit (value) {
      this.chatLogs.push({
        name: 'わたしだよ',
        speaker: 'my',
        message: value
      });
      
      this.botSubmit();
      this.scrollDown();
    },
    botSubmit () {
      setTimeout(() => {
        this.chatLogs.push({
          name: 'bot',
          speaker: 'other',
          message: 'hello world'
        });
        
        this.scrollDown();
      }, 1000);
    },
    scrollDown () {
      const target = this.$el.querySelector('.chat-timeline');
      setTimeout(() => {
      	const height = target.scrollHeight - target.offsetHeight;
        target.scrollTop += 10;

        if (height <= target.scrollTop) {
          return;
        } else {
          this.scrollDown();
        }
      }, 0);
    }
  }
});
</script>

<style>
body {
  font-size: 62.5%;
  box-sizing: border-box;
}
button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  outline: none;
  padding: 0;
  appearance: none;
}

/* timeline */
$tl-background-color: #88A4D4;
$my-balloon-color: #85FF49;
$other-balloon-color: #FFFFFF;

.chat-timeline {
  position: fixed;
  top: 0;
  bottom: 40px;
  left: 0;
  right: 0;
  
  min-width: 480px;
  padding: 30px;
  
  background-color: $tl-background-color;
  overflow-y: auto;

  display: flex;
  flex-direction: column;

  > .conversation-balloon {
    margin-bottom: 30px;
  }
}

.conversation-balloon {
  &.my {
    text-align: right;
    > .avatar {
      float: right;
    }
    > .message {
      margin-right: 20px;
      background-color: $my-balloon-color;
      text-align: left;

      &::before {
        right: -20px;
        transform: rotate(-25deg);
        border-left: 18px solid $my-balloon-color;
      }
    }
  }

  &.other {
    text-align: left;
    > .avatar {
      float: left;
    }
    > .message {
      margin-left: 20px;
      background-color: $other-balloon-color;
      
      &::before {
        left: -20px;
        transform: rotate(25deg);
        border-right: 18px solid $other-balloon-color;
      }
    }
  }
  
  >.avatar {
    width: 80px;
    
    // floatは各コンポーネントで定義
    &::after {
      clear: both;
    }
    
    > img {
      display: block;
      margin: 0 auto;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      
      margin-bottom: 5px;
    }
    > .name {
      width: 100%;
      text-align: center;
      color: white;
      font-size: 0.8rem;
      word-wrap: break-word;
    }
  }
  
  > .message {
    display: inline-block;
    max-width: 280px;
    padding: 10px 30px;
    border-radius: 30px;
    font-size: 1.3rem;
    min-height: 30px;
    word-wrap: break-word;
    
    position: relative;
    
    &::before {
      content: '';
      display: block;
      position: absolute;
      top: 5px;
      border: 8px solid transparent;
      // left/right, border-right, tranform は各コンポーネントで定義
    }
  }
}

/* form */
.chat-form {
  position: fixed;
  bottom: 0;
  right: 0;
  left: 0;

  background-color: white;
}
.form-container {
  position: relative;
  height: 40px;
  > .message {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 80px;
    width: 100%;
    
    font-size: 1.3rem;
    padding: 0 20px;
  }
  > .submit {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    
    width: 80px;
    text-align: center;
    background-color: #4F83E1;
    color: white;
    font-size: 1.6rem;
  }
}
</style>