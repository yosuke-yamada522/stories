import './bootstrap'
import Vue from 'vue'
import StoryLike from './components/StoryLike'
import StoryTagsInput from './components/StoryTagsInput'
import FollowButton from './components/FollowButton'

const app = new Vue({
  el: '#app',
  components: {
    StoryLike,
    StoryTagsInput,
    FollowButton,
  }
})