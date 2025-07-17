<?php
require_once __DIR__ . '/../Component.php';
require_once __DIR__ . '/../ui/Badge.php';

class ChallengeToast extends Component {
    public function render() {
        // Charger les métadonnées du challenge
        $metadata = json_decode(file_get_contents(__DIR__ . '/../../config/metadata.json'), true);
        $challenge = $metadata['challenge'];
        
        $isExpanded = $this->props['expanded'] ?? false;
        $expandedParam = $isExpanded ? 'true' : 'false';
        
        ob_start();
        ?>
        <div class="fixed bottom-4 left-4 z-50" id="challenge-toast">
            <!-- Bouton question mark (collapsed state) -->
            <button
                id="challenge-toggle"
                onclick="toggleChallenge()"
                class="w-12 h-12 bg-black border border-neutral-700 rounded-full shadow-xl flex items-center justify-center hover:bg-gray-800 transition-all duration-300 ease-out challenge-button"
                title="View Challenge"
                style="<?php echo $isExpanded ? 'display: none;' : ''; ?>"
            >
                <span class="text-white text-lg font-bold">?</span>
            </button>

            <!-- Détails du challenge (expanded state) -->
            <div
                id="challenge-details"
                class="w-80 bg-black border border-neutral-900 rounded-lg shadow-xl p-4 transition-all duration-300 ease-out challenge-details"
                style="<?php echo !$isExpanded ? 'display: none;' : ''; ?>"
            >
                <!-- Header avec titre et bouton fermer -->
                <div class="flex items-center justify-between gap-2 mb-3">
                    <div class="flex items-center gap-2 flex-1 min-w-0">
                        <span class="text-orange-400">🎯</span>
                        <h3 class="font-semibold text-sm text-white"><?php echo $this->escape($challenge['title']); ?></h3>
                    </div>
                    <button
                        onclick="toggleChallenge()"
                        class="flex items-center justify-center w-6 h-6 hover:bg-gray-700 rounded transition-colors"
                    >
                        <span class="text-gray-400 hover:text-white cursor-pointer">✕</span>
                    </button>
                </div>

                <!-- Description -->
                <p class="text-sm text-gray-300 leading-relaxed mb-3"><?php echo $this->escape($challenge['description']); ?></p>

                <!-- Skills -->
                <div class="flex flex-col gap-2 mb-3">
                    <div class="flex items-center gap-1">
                        <span class="text-blue-400">💾</span>
                        <span class="text-xs font-medium text-gray-400">Skills:</span>
                    </div>
                    <div class="flex flex-wrap gap-1">
                        <?php foreach ($challenge['skills'] as $skill): ?>
                            <?php echo Badge::make([
                                'variant' => 'skill',
                                'className' => 'text-xs',
                                'children' => $this->escape($skill)
                            ]); ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Points et Status -->
                <div class="flex items-center justify-between pt-2 border-t border-neutral-900">
                    <div class="flex items-center gap-2">
                        <span class="text-yellow-400">🏆</span>
                        <span class="text-sm font-semibold text-yellow-400"><?php echo $this->escape($challenge['points']); ?> points</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
        function toggleChallenge() {
            const button = document.getElementById('challenge-toggle');
            const details = document.getElementById('challenge-details');
            
            if (button.style.display === 'none') {
                button.style.display = 'flex';
                details.style.display = 'none';
            } else {
                button.style.display = 'none';
                details.style.display = 'block';
            }
        }
        </script>

        <style>
        .challenge-button {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.8;
            }
        }

        .challenge-details {
            animation: slideInFromBottom 0.3s ease-out;
        }

        @keyframes slideInFromBottom {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        </style>
        <?php
        return ob_get_clean();
    }
}

// Enregistrer le composant
ComponentManager::register('ChallengeToast', 'ChallengeToast'); 