<template>
  <section>
    <user-card style="margin-bottom: 12px"></user-card>
    <content-card></content-card>
  </section>
</template>
<script>
import UserCard from "./components/UserCard";
import ContentCard from "./components/ContentCard";
export default {
  components: { UserCard, ContentCard },
  data() {
    return {
      //
    };
  }
};
</script>
