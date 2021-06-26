<template>
  <h1 :id="msgId">{{ dynamicMsg }}</h1>

  <button :id="duplicateMsgId" @click="duplicateMsg">Double Message</button>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import { duplicateMsgId, msgId } from "./hello-word";

export default defineComponent({
  props: {
    msg: String,
  },
  setup(props, context) {
    const dynamicMsg = ref(props.msg);
    function duplicateMsg() {
      const { value } = dynamicMsg;
      dynamicMsg.value = `${value}-${value}`;
    }

    return {
      dynamicMsg,
      duplicateMsg,
      duplicateMsgId,
      msgId,
    };
  },
});
</script>
