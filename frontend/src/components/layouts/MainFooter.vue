<script>
export default {
  name: 'MainFooter',
}
</script>

<template>
  <footer class="mainFooter">
    <div class="mainFooter__upper">
      <div class="mainFooter__upper-container">
        <div class="mainFooter__upper-col">
          <h3 class="mainFooter__upper-title">Contact the Publisher</h3>
          <p class="mainFooter__upper-subtitle">mike@runo.com</p>
          <p class="mainFooter__upper-subtitle">+944 450 904 505</p>
        </div>
        <div class="mainFooter__upper-col">
          <h3 class="mainFooter__upper-title">Explorate</h3>
          <p class="mainFooter__upper-subtitle">About</p>
          <p class="mainFooter__upper-subtitle">Partners</p>
          <p class="mainFooter__upper-subtitle">Job Opportunities</p>
          <p class="mainFooter__upper-subtitle">Advertise</p>
          <p class="mainFooter__upper-subtitle">Membership</p>
        </div>
        <div class="mainFooter__upper-col">
          <h3 class="mainFooter__upper-title">Headquarter</h3>
          <p class="mainFooter__upper-subtitle">
            191 Middleville Road, NY 1001, Sydney Australia
          </p>
        </div>
        <div class="mainFooter__upper-col">
          <h3 class="mainFooter__upper-title">Contact the Publisher</h3>
          <p class="mainFooter__upper-subtitle">mike@runo.com</p>
          <p class="mainFooter__upper-subtitle">+944 450 904 505</p>
        </div>
      </div>
    </div>
    <div class="mainFooter__bottom">
      <div class="mainFooter__bottom-container">
        <p class="mainFooter__bottom-textLeft">2021 | RUNO Publisher Studio</p>
        <p class="mainFooter__bottom-textRight">Subscribe Now</p>
      </div>
    </div>
  </footer>
</template>

<style scoped lang="scss">
@import '@/assets/sass/variables.scss';
@import '@/assets/sass/mixins.scss';
.mainFooter {
  .mainFooter__upper {
    padding: 0 15px;
    background: #212529;
    .mainFooter__upper-container {
      height: 400px;
      @include containerWidth;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      @include for-phone-only {
        grid-template-columns: repeat(2, 1fr);
      }
      .mainFooter__upper-col {
        display: flex;
        flex-direction: column;
        gap: 16px;
        height: 50%;
        margin: auto 0;
        .mainFooter__upper-title {
          @include text(18px, 700);
          font-family: $secondaryFontFamily;
          line-height: 25px;
        }
        .mainFooter__upper-subtitle {
          @include text(12px, 400);
          font-family: $secondaryFontFamily;
          color: $textColor3;
          max-width: 114px;
        }
      }
    }
  }
  .mainFooter__bottom {
    padding: 0 15px;
    background: #343a40;

    .mainFooter__bottom-container {
      @include containerWidth;
      height: 80px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      .mainFooter__bottom-textLeft {
        @include text(14px, 700);
        font-family: $secondaryFontFamily;
        color: $textColor3;
      }
      .mainFooter__bottom-textRight {
        @include text(14px, 400);
        font-family: $secondaryFontFamily;
        color: $textColor3;
      }
    }
  }
}
</style>
