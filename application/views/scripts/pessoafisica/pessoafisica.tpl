{*
 * PessoaFisica => View de manipula��o de dados da classe 'PessoaFisica'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">

					<input type="hidden" id="pessoa_id" name="pessoa_id" value="{$object->getPessoaId()}" />
					
					<div class="line">
						<label class="label" for="cpf">CPF</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf_mask)" maxlength="14" value="{$object->getCpf()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nascimento">Data de Nascimento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nascimento" name="data_nascimento" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$object->getDataNascimento()}" />
						</div>
					</div>
				</div>