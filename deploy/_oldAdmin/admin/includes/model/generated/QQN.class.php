<?php
	class QQN {
		/**
		 * @return QQNodeNewsletter
		 */
		static public function Newsletter() {
			return new QQNodeNewsletter('newsletter', null, null);
		}
		/**
		 * @return QQNodeSamplesData
		 */
		static public function SamplesData() {
			return new QQNodeSamplesData('samplesData', null, null);
		}
	}
?>