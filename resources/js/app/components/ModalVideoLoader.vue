<template>
    <div class="modal" :class="{active:openModal}">
	<div class="modal__wrapper">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-12 col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-8 offset-lg-2 offset-xl-1 col-xl-8 offset-xl-2">

					<div class="modal-body">
						<div class="modal__f-figure"></div>
						<div class="modal__s-figure"></div>
						<div class="modal-body__figure"></div>
						<div class="modal-body__cross" @click="$emit('close')">
							<div class="times-svg"></div>
						</div>
						<div class="modal__var">
							<div class="row">
								<div class="col-xl-6 offset-xl-3">
                                    <div class="modal__title">
										<span>Заргрузка видео</span>
									</div>
									<div class="modal__form">
										<form action="" @submit.prevent="send">
											<label class="modal__label" for="">
												<span class="modal__input-name">Ссылка на видео</span>
												<input type="text" v-model="link" placeholder="https://">
                                                <span class="validation" v-for="error in errors.link">{{ error }}</span>
											</label>
                                            <div class="pe-block__save-button pe-block__save-button_no-mt">
                                                <button type="submit" class="rectangle-btn rectangle-btn-green">
                                                    <span>Сохранить видео</span>
                                                </button>
                                            </div>
										</form>
									</div>
									<div class="modal__subtitle">
										<span>
											Вы можете указать ссылку на видеозапись на Youtube или Vimeo.
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
    import axios from "../modules/axios";

    export default {
        props:['openModal'],
        data() {
            return {
                link:'',
                active:true,
                errors: {
                    link:[]
                }
            }
        },
        methods: {
            send() {
                axios.post('/app/media/videos', {link:this.link})
                    .then(({data}) => {
                        this.errors.link = [];
                        this.$emit('save-video', data.video);
                        this.$emit('close');
                    })
                    .catch(({ response }) => {
                        if (response.status === 422) {
                            let errors = response.data.errors;
                            this.errors.link = errors.link || [];
                        }
                    });
                this.link = '';
            }
        }
    }
</script>
<style>
    .pe-block__save-button_no-mt {
        margin-top: 0;
        display: flex;
        justify-content: center;
    }
</style>
