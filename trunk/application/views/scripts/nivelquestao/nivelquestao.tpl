{*
 * NivelQuestao => View de manipula��o de dados da classe 'NivelQuestao'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}

				<div class="line">
					<label class="label" for="nivel">N�vel</label>
					<div class="innerLine">
						<input type="text" class="input pequeno" id="nivel" name="nivel" {if $usuario->getPapelId() != $usuario->ENUM('P_PROFESSOR')} readonly="readonly" {/if} onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$nivelQuestao->getNivel()}" />
					</div>
				</div>