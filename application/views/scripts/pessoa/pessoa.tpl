{*
 * Pessoa => View de manipula��o de dados da classe 'Pessoa'
 * Data de Crica��o - 17/05/2010
 * @author Leonardo Popik e Jo�o Marcos=> Classgen 1.0
 * @version 1.0
 *}
				<div class="content">
					<input type="hidden" id="id" name="id" value="{$object->getId()}" />
					<div class="line">
						<label class="label required" for="nome">Nome</label>
						<div class="innerLine">
							<input type="text" class="key input grande" id="nome" name="nome" maxlength="250" value="{$object->getNome()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="email">Email</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="email" name="email" maxlength="250" value="{$object->getEmail()}" />
						</div>
					</div>
					<div class="line">
						<label class="label" for="site">Site</label>
						<div class="innerLine">
							<input type="text" class="input grande" id="site" name="site" maxlength="250" value="{$object->getSite()}" />
						</div>
					</div>
				</div>