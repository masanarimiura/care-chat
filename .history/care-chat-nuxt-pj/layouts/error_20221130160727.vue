<template>
<div>
<div>エラー。</div>
<p>{{ error.statusCode }}</p>
<p>{{ error.message }}</p>
<p>{{ error.path }}</p>
</div>
</template>

<script>
export default {
props: ["error"],
};
</script>