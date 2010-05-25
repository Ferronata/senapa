{*
 * NivelQuestao => View de manipulação de dados da classe 'NivelQuestao'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}

				<div class="line">
					<label class="label" for="nivel">Nível</label>
					<div class="innerLine">
						<input type="text" class="input pequeno" id="nivel" name="nivel" onkeypress="mascara(this,soNumeros)" maxlength="10" value="{$nivel_questao->getNivel()}" />
					</div>
				</div>