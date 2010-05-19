{*
 * PessoaFisica => View de manipulação de dados da classe 'PessoaFisica'
 * Data de Cricação - 17/05/2010
 * @author Leonardo Popik e João Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">

					<input type="hidden" id="pessoa_id" name="pessoa_id" value="{$professor->getPessoaId()}" />
					
					<div class="line">
						<label class="label" for="cpf">cpf</label>
						<div class="innerLine">
							<input type="text" class="input normal" id="cpf" name="cpf" onkeypress="mascara(this,cpf)" maxlength="11" value="{$professor->getCpf()}" />
						</div>
					</div>
					<div class="line">
						<label class="label required" for="data_nascimento">data_nascimento</label>
						<div class="innerLine">
							<input type="text" class="key input normal" id="data_nascimento" name="data_nascimento" onkeypress="mascara(this,data)" maxlength="10" value="{html_data values=$professor->getDataNascimento()}" />
						</div>
					</div>
				</div>